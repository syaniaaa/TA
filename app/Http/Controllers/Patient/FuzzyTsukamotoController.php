<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Symptom;
use App\Models\FuzzyInput;
use App\Models\Rule;
use App\Models\Diagnosis;
use Illuminate\Http\Request;

class FuzzyTsukamotoController extends Controller
{
    public function create()
    {
        $symptoms = Symptom::with('FuzzyInputs')->get();
        return view('patient.diagnosis.symptomTest', compact('symptoms'));
    }

    public function store(Request $request)
    {
        session()->forget(['diagnosis_id', 'hasil_fuzzy', 'fuzzy_output_id']);

        $jawaban = $request->input('gejala', []);
        $validJawaban = array_filter($jawaban, fn($v) => $v !== null && $v !== '');

        if (count($validJawaban) < 3 || count($validJawaban) > 8) {
            return back()->with('error', 'Pilih minimal 3 dan maksimal 8 gejala.');
        }

        $gejalaKhusus = Symptom::whereIn('id', array_keys($validJawaban))
            ->where('jenis_gejala', 'Khusus')->exists();

        if (!$gejalaKhusus) {
            return back()->with('error', 'Minimal satu gejala khusus harus dipilih.');
        }

        // Fuzzifikasi
        $fuzzifikasi = [];
        foreach ($validJawaban as $symptomId => $nilaiInput) {
            $nilai = floatval($nilaiInput);
            $fuzzyInputs = FuzzyInput::where('symptom_id', $symptomId)->get();

            foreach ($fuzzyInputs as $fi) {
                $mu = 0;
                $min = $fi->min;
                $max = $fi->max;

                if ($fi->himpunan == 'Ringan') {
                    $mu = $nilai <= $min ? 1 : ($nilai <= $max ? ($max - $nilai) / ($max - $min) : 0);
                } else {
                    $mu = $nilai <= $min ? 0 : ($nilai <= $max ? ($nilai - $min) / ($max - $min) : 1);
                }

                $fuzzifikasi[] = [
                    'fuzzy_input_id' => $fi->id,
                    'symptom_id' => $symptomId,
                    'mu' => round($mu, 4),
                ];
            }
        }

        // Inferensi
        $activeRules = [];
        foreach (Rule::with(['fuzzyInputs.symptom', 'fuzzyOutput'])->get() as $rule) {
            $muList = [];
            $gejalaKhususTerpilih = false;

            foreach ($rule->fuzzyInputs as $fuzzyInput) {
                $match = collect($fuzzifikasi)->firstWhere('fuzzy_input_id', $fuzzyInput->id);
                if ($match) {
                    $muList[] = $match['mu'];
                    if ($fuzzyInput->symptom->jenis_gejala == 'Khusus') {
                        $gejalaKhususTerpilih = true;
                    }
                }
            }

            if (count($muList) >= 3 && $gejalaKhususTerpilih) {
                $alpha = min($muList);
                $output = $rule->fuzzyOutput;
                $z = match($output->arah) {
                    'Turun' => $output->max - $alpha * ($output->max - $output->min),
                    'Naik' => $output->min + $alpha * ($output->max - $output->min),
                    'Segitiga' => $alpha <= 0.5
                        ? $output->min + 2 * $alpha * ($output->mid - $output->min)
                        : $output->max - 2 * (1 - $alpha) * ($output->max - $output->mid),
                    default => 0
                };

                $activeRules[] = [
                    'alpha' => $alpha,
                    'z' => $z,
                    'fuzzy_output_id' => $output->id,
                ];
            }
        }

        if (empty($activeRules)) {
            return back()->with('error', 'Tidak ada rule yang cocok.');
        }

        // Defuzzifikasi
        $numerator = collect($activeRules)->sum(fn($r) => $r['alpha'] * $r['z']);
        $denominator = collect($activeRules)->sum('alpha');
        $zFinal = $denominator > 0 ? $numerator / $denominator : 0;

        $terkuat = collect($activeRules)->sortByDesc('alpha')->first();

        $diagnosis = Diagnosis::create([
            'tanggal' => now(),
            'hasil_fuzzy' => round($zFinal, 1),
            'user_id' => auth()->id(),
            'fuzzy_output_id' => $terkuat['fuzzy_output_id'],
        ]);

        foreach ($validJawaban as $symptomId => $value) {
            $diagnosis->symptoms()->attach($symptomId, ['nilai' => $value]);
        }

        session([
            'diagnosis_id' => $diagnosis->id,
            'hasil_fuzzy' => $zFinal,
            'fuzzy_output_id' => $terkuat['fuzzy_output_id'],
        ]);

        return redirect()->route('ds.create')->with('success', 'Fuzzy berhasil, lanjut ke risiko.');
    }
}
