<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rule;
use App\Models\RuleSymptom;
use App\Models\Disease;
use App\Models\Symptom;

class RuleController extends Controller
{
    public function index()
    {
        $data['rules'] = Rule::all();
        return view('admin.rules.index', $data);
    }

    public function create()
    {
        $data['rules'] = Rule::pluck('nama', 'id');
        return view('admin.rules.create', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|max:50',
            'deskripsi' => 'required|max:200',
            'solusi' => 'required|max:200',
        ]);

        Rule::create($validated);

        $notification = array(
            'message' => 'Data Penyakit berhasil ditambahkan',
            'alert-type' => 'success'
        );

        if ($request->save == true) {
            return redirect()->route('rule')->with($notification);
        } else {
            return redirect()->route('rule.create')->with($notification);
        }
    }

    public function edit(string $id)
    {
        $data['rule'] = Rule::find($id);
        $data['rules'] = Rule::pluck('nama', 'id');

        return view('admin.rules.edit', $data);
    }

    public function update(Request $request, string $id)
    {

        $validated = $request->validate([
            'nama' => 'required|max:50',
            'deskripsi' => 'required|max:200',
            'solusi' => 'required|max:200',
        ]);
        Rule::where('id', $id)->update($validated);
        $notification = array(
            'message' => 'Data Penyakit berhasil diperbaharui',
            'alert-type' => 'success'
        );
        return redirect()->route('rule')->with($notification);
    }


    public function destroy(string $id)
    {
        $rule = Rule::findOrFail($id);

        $rule->delete();
        $notification = array(
            'message' => 'Data Penyakit berhasil dihapus',
            'alert-type' => 'success'
        );
        return redirect()->route('rule')->with($notification);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $rules = Rule::where('nama', 'like', "%{$query}%")->get();

        return view('admin.rules.index', compact('rules'));
    }
}
