<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Risk;
use App\Models\Diagnosis;
use Illuminate\Http\Request;

class DempsterShaferController extends Controller
{
    public function create()
    {
        $risks = Risk::all();
        return view('patient.diagnosis.riskTest', compact('risks'));
    }

    public function store(Request $request)
    {
        $risikoDipilih = $request->input('jawaban.risiko');
        $hasilFuzzy = session('hasil_fuzzy');
        $fuzzyOutputId = session('fuzzy_output_id');
        $diagnosisId = session('diagnosis_id');

        if (!$hasilFuzzy || !$fuzzyOutputId || !$diagnosisId) {
            return back()->with('error', 'Hasil fuzzy tidak ditemukan.');
        }

        if (!$risikoDipilih || count($risikoDipilih) === 0) {
            $belief = $hasilFuzzy / 100;
            $hasilDST = round($belief * 100, 1);
        } else {
            if (count($risikoDipilih) > 4) {
                return back()->with('error', 'Maksimal 4 risiko.');
            }

            $M_TB = $hasilFuzzy / 100;
            $M_Theta = 1 - $M_TB;
            $alpha = 0.1;

            foreach ($risikoDipilih as $riskId) {
                $risk = Risk::find($riskId);
                if (!$risk)
                    continue;

                $m2_TB = $alpha * $risk->bobot;
                $m2_Theta = 1 - $m2_TB;

                $m_tb_tb = $M_TB * $m2_TB;
                $m_tb_theta = $M_TB * $m2_Theta;
                $m_theta_tb = $M_Theta * $m2_TB;
                $m_theta_theta = $M_Theta * $m2_Theta;

                $M_TB = ($m_tb_tb + $m_tb_theta + $m_theta_tb);
                $M_Theta = $m_theta_theta;
            }

            $hasilDST = round($M_TB * 100, 1);
        }

        $tingkatKemungkinan = match (true) {
            $hasilDST <= 50 => 'Kemungkinan Rendah',
            $hasilDST <= 79 => 'Kemungkinan Sedang',
            $hasilDST <= 99 => 'Besar Kemungkinan',
            default => 'Sangat Yakin',
        };

        $diagnosis = Diagnosis::findOrFail($diagnosisId);
        $diagnosis->update([
            'hasil' => $hasilDST,
            'tingkat_kemungkinan' => $tingkatKemungkinan,
        ]);

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

        return redirect()->route('patient.diagnosis.result')->with('success', 'Diagnosis berhasil disimpan.');
    }
}
