<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Symptom;
use App\Models\Risk;
use App\Models\FuzzyInput;
use App\Models\Rule;
use App\Models\Diagnosis;
use Barryvdh\DomPDF\Facade\Pdf;


class DiagnosisController extends Controller
{
    public function create()
    {
        $symptoms = Symptom::with('FuzzyInputs')->get();
        return view('patient.diagnosis.symptomTest', compact('symptoms'));
    }

    public function store(Request $request)
    {
        session()->forget(['diagnosis_id', 'hasil_fuzzy', 'fuzzy_output_id']);

        // Ambil input dan filter nilai kosong/null
        $jawaban = $request->input('gejala', []);
        $validJawaban = array_filter($jawaban, function ($v) {
            return $v !== null && $v !== '';
        });

        // 1. Validasi jumlah gejala dan gejala khusus
        if (count($validJawaban) < 3 || count($validJawaban) > 8) {
            return back()->with([
                'alert-type' => 'error',
                'message' => 'Pilih minimal 3 dan maksimal 8 gejala dengan nilai yang diisi.'
            ]);
        }

        $gejalaKhusus = Symptom::whereIn('id', array_keys($validJawaban))
            ->where('jenis_gejala', 'Khusus')
            ->exists();

        if (!$gejalaKhusus) {
            return back()->with([
                'alert-type' => 'error',
                'message' => 'Minimal satu gejala khusus harus dipilih.'
            ]);
        }

        // 2. Fuzzifikasi
        $fuzzifikasi = [];
        foreach ($validJawaban as $symptomId => $nilaiInput) {
            $nilai = floatval($nilaiInput);
            $fuzzyInputs = FuzzyInput::where('symptom_id', $symptomId)->get();

            foreach ($fuzzyInputs as $fi) {
                $mu = 0;
                $min = $fi->min;
                $max = $fi->max;

                if ($fi->himpunan == 'Ringan') {
                    if ($nilai <= $min)
                        $mu = 1;
                    elseif ($nilai <= $max)
                        $mu = ($max - $nilai) / ($max - $min);
                    else
                        $mu = 0;
                } else { // Berat
                    if ($nilai <= $min)
                        $mu = 0;
                    elseif ($nilai <= $max)
                        $mu = ($nilai - $min) / ($max - $min);
                    else
                        $mu = 1;
                }

                $fuzzifikasi[] = [
                    'fuzzy_input_id' => $fi->id,
                    'symptom_id' => $symptomId,
                    'mu' => round($mu, 4),
                ];
            }
        }

        // 3. Inferensi
        $activeRules = [];
        foreach (Rule::with(['fuzzyInputs.symptom', 'fuzzyOutput'])->get() as $rule) {
            $muList = [];
            $gejalaKhususTerpilih = false;

            foreach ($rule->fuzzyInputs as $fuzzyInput) {
                $symptomId = $fuzzyInput->symptom_id;
                $match = collect($fuzzifikasi)->firstWhere('fuzzy_input_id', $fuzzyInput->id);
                if ($match) {
                    $muList[] = $match['mu'];

                    // Cek apakah gejala ini jenisnya "Khusus"
                    if ($fuzzyInput->symptom->jenis_gejala == 'Khusus') {
                        $gejalaKhususTerpilih = true;
                    }
                }
            }

            // Syarat minimal 3 gejala dari rule cocok DAN minimal 1 gejala khusus
            if (count($muList) >= 3 && $gejalaKhususTerpilih) {
                $alpha = min($muList);
                $output = $rule->fuzzyOutput;

                if ($alpha > 0) {
                    if ($output->arah == 'Turun') {
                        $z = $output->max - $alpha * ($output->max - $output->min);
                    } elseif ($output->arah == 'Naik') {
                        $z = $output->min + $alpha * ($output->max - $output->min);
                    } elseif ($output->arah == 'Segitiga') {
                        $mid = $output->mid;
                        if ($alpha <= 0.5) {
                            $z = $output->min + 2 * $alpha * ($mid - $output->min);
                        } else {
                            $z = $output->max - 2 * (1 - $alpha) * ($output->max - $mid);
                        }
                    }

                    $activeRules[] = [
                        'alpha' => $alpha,
                        'z' => $z,
                        'fuzzy_output_id' => $output->id,
                    ];
                }
            }
        }


        if (empty($activeRules)) {
            return back()->with([
                'alert-type' => 'error',
                'message' => 'Tidak ada rule yang cocok. Coba pilih gejala lain.'
            ]);
        }

        // 4. Defuzzifikasi
        $numerator = collect($activeRules)->sum(fn($r) => $r['alpha'] * $r['z']);
        $denominator = collect($activeRules)->sum('alpha');
        $zFinal = $denominator > 0 ? $numerator / $denominator : 0;

        $terkuat = collect($activeRules)->sortByDesc('alpha')->first();

        // 5. Simpan hasil diagnosis
        $diagnosis = Diagnosis::create([
            'tanggal' => now(),
            'hasil_fuzzy' => round($zFinal, 1),
            'user_id' => auth()->id(),
            'fuzzy_output_id' => $terkuat['fuzzy_output_id'],
        ]);

        // 6. Simpan ke tabel pivot symptom_diagnosis
        foreach ($validJawaban as $symptomId => $value) {
            $diagnosis->symptoms()->attach($symptomId, ['nilai' => $value]);
        }

        // 7. Simpan ke session untuk langkah berikutnya
        session([
            'diagnosis_id' => $diagnosis->id,
            'hasil_fuzzy' => $zFinal,
            'fuzzy_output_id' => $terkuat['fuzzy_output_id'],
        ]);

        return redirect()->route('diagnosis.riskTest')->with([
            'alert-type' => 'success',
            'message' => 'Fuzzifikasi berhasil, lanjut ke risiko.'
        ]);
    }

    public function create2()
    {
        $risks = Risk::all();
        return view('patient.diagnosis.riskTest', compact('risks'));
    }

    public function store2(Request $request)
    {
        $user = auth()->user();
        $risikoDipilih = $request->input('jawaban.risiko');

        // Ambil hasil fuzzy dari session
        $hasilFuzzy = session('hasil_fuzzy');
        $fuzzyOutputId = session('fuzzy_output_id');
        $diagnosisId = session('diagnosis_id'); // Ambil diagnosis ID dari store() sebelumnya

        // Validasi
        if (!$hasilFuzzy || !$fuzzyOutputId || !$diagnosisId) {
            return back()->with('error', 'Hasil diagnosis gejala belum tersedia.');
        }

        // Tanpa risiko: hasil dari fuzzy langsung dijadikan DST
        if (!$risikoDipilih || count($risikoDipilih) === 0) {
            $belief = $hasilFuzzy / 100;
            $plausibility = 1;
            $hasilDST = round($belief * 100, 1);
        } else {
            if (count($risikoDipilih) > 4) {
                return back()->with('error', 'Pilih maksimal 4 faktor risiko.');
            }

            $M_TB = $hasilFuzzy / 100;
            $M_Theta = 1 - $M_TB;
            $alpha = 0.1;

            foreach ($risikoDipilih as $riskId) {
                $risk = Risk::find($riskId);
                if (!$risk)
                    continue;

                $m2_TB = $alpha * $risk->bobot;
                $m2_Theta = (1 - $alpha) + ($alpha * (1 - $risk->bobot));

                $m_tb_tb = $M_TB * $m2_TB;
                $m_tb_theta = $M_TB * $m2_Theta;
                $m_theta_tb = $M_Theta * $m2_TB;
                $m_theta_theta = $M_Theta * $m2_Theta;

                $denominator = 1;

                $M_TB = ($m_tb_tb + $m_tb_theta + $m_theta_tb) / $denominator;
                $M_Theta = $m_theta_theta / $denominator;
            }

            $belief = $M_TB;
            $plausibility = 1 - $M_Theta;
            $hasilDST = round($belief * 100, 1);
        }

        // Klasifikasi tingkat kemungkinan
        if ($hasilDST <= 50) {
            $tingkatKemungkinan = 'Kemungkinan Rendah';
        } elseif ($hasilDST <= 79) {
            $tingkatKemungkinan = 'Kemungkinan Sedang';
        } elseif ($hasilDST <= 99) {
            $tingkatKemungkinan = 'Besar Kemungkinan';
        } else {
            $tingkatKemungkinan = 'Sangat Yakin';
        }

        // 🔄 UPDATE diagnosis yang sudah ada
        $diagnosis = Diagnosis::findOrFail($diagnosisId);
        $diagnosis->update([
            'hasil' => $hasilDST,
            'tingkat_kemungkinan' => $tingkatKemungkinan
        ]);

        // Simpan ke pivot table risk_diagnosis
        if ($risikoDipilih && count($risikoDipilih) > 0) {
            foreach ($risikoDipilih as $riskId) {
                DB::table('risk_diagnosis')->insert([
                    'risk_id' => $riskId,
                    'diagnosis_id' => $diagnosisId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->route('diagnosis.result')->with([
            'success' => 'Diagnosis berhasil disimpan.',
            'hasilDST' => $hasilDST,
            'tingkatKemungkinan' => $tingkatKemungkinan,
        ]);
    }

    public function showResult()
    {
        $diagnosis = Diagnosis::with(['user', 'fuzzyOutput.disease'])
            ->where('user_id', auth()->id())
            ->latest()
            ->firstOrFail();

        return view('patient.diagnosis.result', compact('diagnosis'));
    }

    public function history()
    {
        $diagnosis = Diagnosis::with(['fuzzyOutput.disease'])
            ->where('user_id', auth()->id())
            ->orderByDesc('tanggal')
            ->get();

        return view('patient.diagnosisHistory.history', compact('diagnosis'));
    }

    public function show($id)
    {
        $diagnosis = Diagnosis::with([
            'user',
            'fuzzyOutput.disease',
            'symptoms.fuzzyInputs',
            'risks'
        ])->findOrFail($id);

        return view('patient.diagnosisHistory.show', compact('diagnosis'));
    }
    public function print($id)
    {
        $diagnosis = Diagnosis::findOrFail($id);

        $pdf = PDF::loadView('patient.diagnosisHistory.print', ['report' => $diagnosis]);

        return $pdf->stream('hasil_diagnosis.pdf');
    }
}
