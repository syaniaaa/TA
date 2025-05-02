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
        $data['fuzzy_inputs'] = FuzzyInput::pluck('kategori', 'id');
        return view('admin.FuzzyInputs.create', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori' => 'required|max:50',
            'min' => 'required|numeric',
            'max' => 'required|numeric|gte:min',
            'unit' => 'required|max:50',
            'symptom_id' => 'required|exists:symptoms,id',
        ]);

        FuzzyInput::create($validated);

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
        $data['fuzzy_input'] = FuzzyInput::find($id);
        $data['symptoms'] = Symptom::pluck('nama', 'id');

        return view('admin.FuzzyInputs.edit', $data);
    }

    public function update(Request $request, string $id)
    {

        $validated = $request->validate([
            'kategori' => 'required|max:50',
            'min' => 'required|numeric',
            'max' => 'required|numeric|gte:min',
            'unit' => 'required|max:50',
            'symptom_id' => 'required|exists:symptoms,id',
        ]);
        FuzzyInput::where('id', $id)->update($validated);
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

        $fuzzy_inputs = FuzzyInput::where('kategori', 'like', "%{$query}%")->get();

        return view('admin.FuzzyInputs.index', compact('fuzzy_inputs'));
    }
}
