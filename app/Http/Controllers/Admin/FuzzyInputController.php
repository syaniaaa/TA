<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Symptom;
use App\Models\FuzzyInput;

class FuzzyInputController extends Controller
{
    public function index()
    {
        $data['fuzzy_inputs'] = FuzzyInput::all();
        return view('admin.FuzzyInputs.index', $data);
    }

    public function create()
    {
        $data['symptoms'] = Symptom::pluck('nama', 'id');
        $data['fuzzy_inputs'] = FuzzyInput::pluck('himpunan', 'id');
        return view('admin.FuzzyInputs.create', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'min' => 'required|numeric',
            'max' => 'required|numeric|gt:min',
            'unit' => 'required|in:Hari,Kg,Cm,Skala',
            'symptom_id' => 'required|exists:symptoms,id',
        ]);

        $min = $validated['min'];
        $max = $validated['max'];
        $unit = $validated['unit'];
        $symptom_id = $validated['symptom_id'];


        $ringan = [
            'himpunan' => 'Ringan',
            'min' => $min,
            'max' => $max,
            'unit' => $unit,
            'arah' => 'Turun',
            'symptom_id' => $symptom_id,
        ];

        $berat = [
            'himpunan' => 'Berat',
            'min' => $min,
            'max' => $max,
            'unit' => $unit,
            'arah' => 'Naik',
            'symptom_id' => $symptom_id,
        ];

        FuzzyInput::create($ringan);
        FuzzyInput::create($berat);

        $notification = array(
            'message' => 'Data Gejala berhasil ditambahkan',
            'alert-type' => 'success'
        );

        if ($request->save == true) {
            return redirect()->route('fuzzy_input')->with($notification);
        } else {
            return redirect()->route('fuzzy_input.create')->with($notification);
        }
    }

    public function edit(string $id)
    {
        $fuzzy_input = FuzzyInput::findOrFail($id);

        $data['fuzzy_inputs'] = FuzzyInput::where('symptom_id', $fuzzy_input->symptom_id)->get();
        $data['symptoms'] = Symptom::pluck('nama', 'id');

        return view('admin.FuzzyInputs.edit', $data);
    }


    public function update(Request $request, string $id)
    {

        $validated = $request->validate([
            'min' => 'required|numeric',
            'max' => 'required|numeric|gt:min',
            'unit' => 'required|in:Hari,Kg,Cm,Skala',
            'symptom_id' => 'required|exists:symptoms,id',
        ]);

        $min = $validated['min'];
        $max = $validated['max'];
        $unit = $validated['unit'];
        $symptom_id = $validated['symptom_id'];

        FuzzyInput::where('symptom_id', $symptom_id)->where('himpunan', 'Ringan')->update([
            'min' => $min,
            'max' => $max,
            'unit' => $unit,
            'arah' => 'Turun',
        ]);

        FuzzyInput::where('symptom_id', $symptom_id)->where('himpunan', 'Berat')->update([
            'min' => $min,
            'max' => $max,
            'unit' => $unit,
            'arah' => 'Naik',
        ]);
        $notification = array(
            'message' => 'Data Gejala berhasil diperbaharui',
            'alert-type' => 'success'
        );
        return redirect()->route('fuzzy_input')->with($notification);
    }


    public function destroy(string $id)
    {
        $fuzzy_input = FuzzyInput::findOrFail($id);

        $fuzzy_input->delete();
        $notification = array(
            'message' => 'Data Gejala berhasil dihapus',
            'alert-type' => 'success'
        );
        return redirect()->route('fuzzy_input')->with($notification);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $fuzzy_inputs = FuzzyInput::where('himpunan', 'like', "%{$query}%")->get();

        return view('admin.FuzzyInputs.index', compact('fuzzy_inputs'));
    }
}
