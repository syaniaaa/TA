<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rule;
use App\Models\RuleSymptom;
use App\Models\Disease;
use App\Models\Symptom;
use App\Models\FuzzyOutput;

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
        $data['diseases'] = Disease::with('fuzzyOutputs')->get();
        $data['symptoms'] = Symptom::with('fuzzySets')->get();
        $data['fuzzyOutput'] = FuzzyOutput::all();
        return view('admin.rules.create', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|max:255',
            'disease_id' => 'required|exists:diseases,id',
            'fuzzy_output_id' => 'required|exists:fuzzy_outputs,id',
        ]);

        // Simpan rule baru
        $rule = Rule::create([
            'nama' => $request->nama,
            'disease_id' => $request->disease_id,
            // Relasi ke penyakit
            'fuzzy_output_id' => $request->fuzzy_output_id, // Relasi ke fuzzy output
        ]);

        // Simpan gejala jika ada
        if ($request->has('symptom_ids')) {
            foreach ($request->symptom_ids as $symptom_id) {
                RuleSymptom::create([
                    'rule_id' => $rule->id,
                    'symptom_id' => $symptom_id,
                ]);
            }
        }

        // Simpan notifikasi dan arahkan
        $notification = array(
            'message' => 'Data Aturan berhasil ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('rule.index')->with($notification);
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
            'disease_id' => 'required|exists:diseases,id',
        ]);
        Rule::where('id', $id)->update($validated);
        $notification = array(
            'message' => 'Data Aturan berhasil diperbaharui',
            'alert-type' => 'success'
        );
        return redirect()->route('rule')->with($notification);
    }


    public function destroy(string $id)
    {
        $rule = Rule::findOrFail($id);

        $rule->delete();
        $notification = array(
            'message' => 'Data Aturan berhasil dihapus',
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
