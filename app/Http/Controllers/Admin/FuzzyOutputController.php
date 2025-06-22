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
        $data['fuzzy_outputs'] = FuzzyOutput::with('disease')->get();
        return view('admin.fuzzyOutputs.index', $data);
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
            'himpunan' => 'required|in:Rendah,Sedang,Tinggi',
            'min' => 'required|numeric',
            'max' => 'required|numeric|gte:min',
            'arah' => 'required|in:Naik,Turun,Segitiga',
            'disease_id' => 'required|exists:diseases,id',
        ]);
        FuzzyOutput::where('id', $id)->update($validated);
        $notification = array(
            'message' => 'Data Penyakit berhasil diperbaharui',
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
