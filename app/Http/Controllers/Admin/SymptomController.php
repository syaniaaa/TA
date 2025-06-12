<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Symptom;

class SymptomController extends Controller
{
    public function index()
    {
        $data['symptoms'] = Symptom::all();
        return view('admin.symptoms.index', $data);
    }

    public function create()
    {
        $data['symptoms'] = Symptom::pluck('nama', 'id');
        return view('admin.symptoms.create', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_gejala' => 'required|max:10|unique:symptoms,kode_gejala',
            'nama' => 'required|max:50',
            'jenis_gejala' => ['required', 'string', 'in:Khusus,Umum', 'max:50'],

        ]);

        Symptom::create($validated);

        $notification = array(
            'message' => 'Data Gejala berhasil ditambahkan',
            'alert-type' => 'success'
        );

        if ($request->save == true) {
            return redirect()->route('symptom')->with($notification);
        } else {
            return redirect()->route('symptom.create')->with($notification);
        }
    }

    public function edit(string $id)
    {
        $data['symptom'] = Symptom::find($id);
        $data['symptoms'] = Symptom::pluck('nama', 'id');

        return view('admin.symptoms.edit', $data);
    }

    public function update(Request $request, string $id)
    {

        $validated = $request->validate([
            'kode_gejala' => 'required|max:10|unique:symptoms,kode_gejala',
            'nama' => 'required|max:50',
            'jenis_gejala' => ['required', 'string', 'in:Khusus,Umum', 'max:50'],

        ]);
        Symptom::where('id', $id)->update($validated);
        $notification = array(
            'message' => 'Data Gejala berhasil diperbaharui',
            'alert-type' => 'success'
        );
        return redirect()->route('symptom')->with($notification);
    }


    public function destroy(string $id)
    {
        $symptom = Symptom::findOrFail($id);

        $symptom->delete();
        $notification = array(
            'message' => 'Data Gejala berhasil dihapus',
            'alert-type' => 'success'
        );
        return redirect()->route('symptom')->with($notification);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $symptoms = Symptom::where('nama', 'like', "%{$query}%")->get();

        return view('admin.symptoms.index', compact('symptoms'));
    }
}
