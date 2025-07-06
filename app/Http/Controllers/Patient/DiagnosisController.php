<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Symptom;
use App\Models\Risk;
use App\Models\FuzzyInput;
use App\Models\Diagnosis;


class DiagnosisController extends Controller
{
    public function create()
    {
        $symptoms = Symptom::with('FuzzyInputs')->get();
        return view('patient.diagnosis.symptomTest', compact('symptoms'));
    }



    public function store(Request $request)
    {
        $jawaban = $request->input('jawaban');

        // 1. Validasi jumlah gejala dan gejala khusus
        if (count($jawaban) < 3 || count($jawaban) > 8) {
            return back()->with('error', 'Pilih minimal 3 dan maksimal 8 gejala.');
        }

        $gejalaKhususTerpilih = Symptom::whereIn('id', array_keys($jawaban))
            ->where('jenis_gejala', 'Khusus')
            ->exists();

        if (!$gejalaKhususTerpilih) {
            return back()->with('error', 'Minimal satu gejala khusus harus dipilih.');
        }

        // 2. Fuzzifikasi input gejala
        $fuzzifikasi = [];
        foreach ($jawaban as $symptomId => $nilaiInput) {
            $nilai = floatval($nilaiInput);

            // Ambil semua fungsi keanggotaan untuk gejala ini
            $fuzzyInputs = FuzzyInput::where('symptom_id', $symptomId)->get();

            foreach ($fuzzyInputs as $fi) {
                $mu = 0;
                $min = $fi->min;
                $max = $fi->max;

                if ($fi->himpunan == 'Ringan') {
                    if ($nilai <= $min)
                        $mu = 1;
                    elseif ($nilai > $min && $nilai <= $max)
                        $mu = ($max - $nilai) / ($max - $min);
                    else
                        $mu = 0;
                } else { // Berat
                    if ($nilai <= $min)
                        $mu = 0;
                    elseif ($nilai > $min && $nilai <= $max)
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

        // 3. Ambil semua rule yang relevan
        $activeRules = [];
        foreach (\App\Models\Rule::with('fuzzyInputs')->get() as $rule) {
            $ruleInputs = $rule->fuzzyInputs->pluck('id')->toArray();

            // cek apakah semua input rule tersedia di hasil fuzzifikasi
            $matchingMus = [];
            foreach ($ruleInputs as $fuzzyInputId) {
                $match = collect($fuzzifikasi)->firstWhere('fuzzy_input_id', $fuzzyInputId);
                if ($match) {
                    $matchingMus[] = $match['mu'];
                }
            }

            // hanya jika semua input dalam rule ada
            if (count($matchingMus) == count($ruleInputs)) {
                $alpha = min($matchingMus);

                // 4. Hitung Z dari output rule
                $output = $rule->fuzzyOutput;
                if ($output->arah == 'Turun') {
                    // contoh: (max - z)/(max - min) = α → z = max - α*(max - min)
                    $z = $output->max - $alpha * ($output->max - $output->min);
                } elseif ($output->arah == 'Naik') {
                    $z = $output->min + $alpha * ($output->max - $output->min);
                } else { // Segitiga → ambil puncaknya = (min+max)/2, rumus sesuai α
                    $tengah = ($output->min + $output->max) / 2;
                    if ($alpha <= 0.5) {
                        $z = $output->min + 2 * $alpha * ($tengah - $output->min);
                    } else {
                        $z = $output->max - 2 * (1 - $alpha) * ($output->max - $tengah);
                    }
                }

                $activeRules[] = [
                    'alpha' => $alpha,
                    'z' => $z,
                    'fuzzy_output_id' => $output->id,
                ];
            }
        }

        if (empty($activeRules)) {
            return back()->with('error', 'Tidak ada rule yang dapat dieksekusi.');
        }

        // 5. Defuzzifikasi (z = Σαz / Σα)
        $numerator = collect($activeRules)->sum(fn($r) => $r['alpha'] * $r['z']);
        $denominator = collect($activeRules)->sum('alpha');
        $zFinal = $numerator / $denominator;

        // Ambil output dengan nilai alpha terbesar (atau bisa juga pakai z terbesar)
        $terkuat = collect($activeRules)->sortByDesc('alpha')->first();

        // 6. Simpan ke diagnoses
        $diagnosis = \App\Models\Diagnosis::create([
            'tanggal' => now(),
            'hasil' => $zFinal,
            'hasil_fuzzy' => $terkuat['alpha'],
            'user_id' => auth()->id(),
            'fuzzy_output_id' => $terkuat['fuzzy_output_id'],
        ]);

        // Simpan gejala yang dipilih ke tabel pivot symptom_diagnosis
        $diagnosis = \App\Models\Diagnosis::create([
            'tanggal' => now(),
            'hasil' => $zFinal,
            'hasil_fuzzy' => $terkuat['alpha'],
            'user_id' => auth()->id(),
            'fuzzy_output_id' => $terkuat['fuzzy_output_id'],
        ]);

        // Simpan ke tabel pivot
        $diagnosis->symptoms()->attach(array_keys($jawaban));



        return redirect()->route('dashboard')->with('success', 'Diagnosis berhasil dihitung.');
    }


    public function create3()
    {
        $risks = Risk::all();
        return view('patient.diagnosis.riskTest', compact('risks'));
    }

    public function store3(Request $request)
    {
        $user = auth()->user();
        $risikoDipilih = $request->input('jawaban.risiko'); // inputan user

        // Ambil hasil fuzzy dan output ID dari session (harus sudah dihitung sebelumnya)
        $hasilFuzzy = session('hasil_fuzzy'); // contoh: 47
        $fuzzyOutputId = session('fuzzy_output_id'); // ID fuzzy_output hasil rule

        if (!$hasilFuzzy || !$fuzzyOutputId) {
            return back()->with('error', 'Hasil fuzzy belum tersedia.');
        }

        // Inisialisasi M1 (hasil fuzzy)
        $M_TB = $hasilFuzzy / 100; // normalisasi ke 0-1
        $M_Theta = 1 - $M_TB;

        // Proses risiko yang dipilih
        if ($risikoDipilih && count($risikoDipilih) > 0) {
            foreach ($risikoDipilih as $id_risiko) {
                $risk = Risk::find($id_risiko);
                if (!$risk)
                    continue;

                $alpha = 0.1; // kepercayaan 10%
                $M2_TB = $alpha * $risk->bobot;
                $M2_Theta = (1 - $alpha) + ($alpha * (1 - $risk->bobot));

                // Kombinasi Dempster
                $M_TB_new = ($M_TB * $M2_TB) + ($M_TB * $M2_Theta) + ($M_Theta * $M2_TB);
                $M_Theta_new = $M_Theta * $M2_Theta;

                $M_TB = $M_TB_new;
                $M_Theta = $M_Theta_new;
            }
        }

        // Simpan diagnosis akhir
        $diagnosis = Diagnosis::create([
            'tanggal' => now(),
            'hasil' => round($M_TB * 100, 2),
            'hasil_fuzzy' => round($hasilFuzzy, 2),
            'user_id' => $user->id,
            'fuzzy_output_id' => $fuzzyOutputId,
        ]);

        foreach ($risikoDipilih as $riskId) {
            DB::table('risk_diagnosis')->insert([
                'risk_id' => $riskId,
                'diagnosis_id' => $diagnosis->id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Simpan hubungan diagnosis <-> risiko
        if ($risikoDipilih) {
            foreach ($risikoDipilih as $id_risiko) {
                $diagnosis->risks()->attach($id_risiko);
            }
        }

        return redirect()->route('diagnosis.riskTest')->with('success', 'Diagnosis berhasil disimpan.');
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
        $diagnosis = Diagnosis::with('fuzzyOutput.disease')
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
            'symptoms',
            'risks'
        ])->findOrFail($id);

        return view('patient.diagnosisHistory.show', compact('diagnosis'));
    }



}
