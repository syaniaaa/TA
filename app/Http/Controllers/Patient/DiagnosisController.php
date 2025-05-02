<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Symptom;
use App\Models\FuzzyInput;


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


        foreach ($jawaban as $id_gejala => $kategori_ids) {
            foreach ($kategori_ids as $id_kategori) {
                // Lakukan proses, misalnya hitung dengan fuzzy logic, atau simpan ke database
            }
        }

        // Lakukan pengolahan lebih lanjut (misalnya, hitung diagnosis menggunakan metode fuzzy, dsb.)
    }

}
