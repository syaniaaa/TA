<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Risk;

class RiskController extends Controller
{
    public function index()
    {
        $data['risks'] = Risk::all();
        return view('admin.risks.index', $data);
    }

    public function create()
    {
        $data['risks'] = Risk::pluck('nama', 'id');
        return view('admin.risks.create', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_risiko' => 'required|max:10|unique:risks,kode_risiko',
            'nama' => 'required|max:200',
            'bobot' => 'required|numeric|min:0',

        ]);

        Risk::create($validated);

        $notification = array(
            'message' => 'Data Risiko berhasil ditambahkan',
            'alert-type' => 'success'
        );

        if ($request->save == true) {
            return redirect()->route('risk')->with($notification);
        } else {
            return redirect()->route('risk.create')->with($notification);
        }
    }

    public function edit(string $id)
    {
        $data['risk'] = Risk::find($id);
        $data['risks'] = Risk::pluck('nama', 'id');

        return view('admin.risks.edit', $data);
    }

    public function update(Request $request, string $id)
    {

        $validated = $request->validate([
            'kode_risiko' => 'required|max:10|unique:risks,kode_risiko',
            'nama' => 'required|max:200',
            'bobot' => 'required|numeric|min:0',

        ]);
        Risk::where('id', $id)->update($validated);
        $notification = array(
            'message' => 'Data Risiko berhasil diperbaharui',
            'alert-type' => 'success'
        );
        return redirect()->route('risk')->with($notification);
    }


    public function destroy(string $id)
    {
        $Risk = Risk::findOrFail($id);

        $Risk->delete();
        $notification = array(
            'message' => 'Data Risiko berhasil dihapus',
            'alert-type' => 'success'
        );
        return redirect()->route('risk')->with($notification);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $risks = Risk::where('nama', 'like', "%{$query}%")->get();

        return view('admin.risks.index', compact('risks'));
    }
}
