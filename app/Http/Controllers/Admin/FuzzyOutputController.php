<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Disease;
use App\Models\FuzzyOutput;

class FuzzyOutputController extends Controller
{
    public function index()
    {
        $data['fuzzy_outputs'] = FuzzyOutput::all();
        return view('admin.fuzzyOutputs.index', $data);
    }

    public function create()
    {
        $data['diseases'] = Disease::pluck('nama', 'id');
        $data['fuzzy_outputs'] = FuzzyOutput::pluck('himpunan', 'id');
        return view('admin.fuzzyOutputs.create', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'himpunan' => 'required|max:50',
            'min' => 'required|numeric',
            'max' => 'required|numeric|gte:min',
            'disease_id' => 'required|exists:diseases,id',
        ]);

        FuzzyOutput::create($validated);

        $notification = array(
            'message' => 'Data Penyakit berhasil ditambahkan',
            'alert-type' => 'success'
        );

        if ($request->save == true) {
            return redirect()->route('fuzzy_output')->with($notification);
        } else {
            return redirect()->route('fuzzy_output.create')->with($notification);
        }
    }

    public function edit(string $id)
    {
        $data['fuzzy_output'] = FuzzyOutput::find($id);
        $data['diseases'] = Disease::pluck('nama', 'id');

        return view('admin.fuzzyOutputs.edit', $data);
    }

    public function update(Request $request, string $id)
    {

        $validated = $request->validate([
            'himpunan' => 'required|max:50',
            'min' => 'required|numeric',
            'max' => 'required|numeric|gte:min',
            'disease_id' => 'required|exists:diseases,id',
        ]);
        FuzzyOutput::where('id', $id)->update($validated);
        $notification = array(
            'message' => 'Data Penyakit berhasil diperbaharui',
            'alert-type' => 'success'
        );
        return redirect()->route('fuzzy_output')->with($notification);
    }


    public function destroy(string $id)
    {
        $fuzzy_output = FuzzyOutput::findOrFail($id);

        $fuzzy_output->delete();
        $notification = array(
            'message' => 'Data Penyakit berhasil dihapus',
            'alert-type' => 'success'
        );
        return redirect()->route('fuzzy_output')->with($notification);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $fuzzy_outputs = FuzzyOutput::where('himpunan', 'like', "%{$query}%")->get();

        return view('admin.fuzzyOutputs.index', compact('fuzzy_outputs'));
    }
}
