<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Disease;

class DiseaseController extends Controller
{
    public function index()
    {
        $data['diseases'] = Disease::all();
        return view('admin.diseases.index', $data);
    }

    public function create()
    {
        $data['diseases'] = Disease::pluck('nama', 'id');
        return view('admin.diseases.create', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|max:50',
            'deskripsi' => 'required|max:200',
            'solusi' => 'required|max:200',
        ]);

        Disease::create($validated);

        $notification = array(
            'message' => 'Data Penyakit berhasil ditambahkan',
            'alert-type' => 'success'
        );

        if ($request->save == true) {
            return redirect()->route('disease')->with($notification);
        } else {
            return redirect()->route('disease.create')->with($notification);
        }
    }

    public function edit(string $id)
    {
        $data['disease'] = Disease::find($id);
        $data['diseases'] = Disease::pluck('nama', 'id');

        return view('admin.diseases.edit', $data);
    }

    public function update(Request $request, string $id)
    {

        $validated = $request->validate([
            'nama' => 'required|max:50',
            'deskripsi' => 'required|max:200',
            'solusi' => 'required|max:200',
        ]);
        Disease::where('id', $id)->update($validated);
        $notification = array(
            'message' => 'Data Penyakit berhasil diperbaharui',
            'alert-type' => 'success'
        );
        return redirect()->route('disease')->with($notification);
    }


    public function destroy(string $id)
    {
        $disease = Disease::findOrFail($id);

        $disease->delete();
        $notification = array(
            'message' => 'Data Penyakit berhasil dihapus',
            'alert-type' => 'success'
        );
        return redirect()->route('disease')->with($notification);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $diseases = Disease::where('nama', 'like', "%{$query}%")->get();

        return view('admin.diseases.index', compact('diseases'));
    }
}
