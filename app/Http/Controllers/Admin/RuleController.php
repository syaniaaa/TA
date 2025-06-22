<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rule;
use App\Models\FuzzyInput;
use App\Models\FuzzyOutput;
use App\Models\FuzzyInputRule;

class RuleController extends Controller
{
    public function index()
    {
        $rules = Rule::with(['fuzzyInputs.symptom', 'fuzzyOutput.disease'])->get();
        return view('admin.rules.index', compact('rules'));
    }

    public function create()
    {
        $fuzzy_inputs = FuzzyInput::all();
        $fuzzy_outputs = FuzzyOutput::all();
        $fuzzy_inputs = FuzzyInput::with('symptom')->get();
        $fuzzy_outputs = FuzzyOutput::with('disease')->get();

        return view('admin.rules.create', compact('fuzzy_inputs', 'fuzzy_outputs'));

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_aturan' => 'required|max:10|unique:rules,kode_aturan',
            'fuzzy_output_id' => 'required|exists:fuzzy_outputs,id',
            'fuzzy_input_ids' => 'required|array|min:1',
            'fuzzy_input_ids.*' => 'exists:fuzzy_inputs,id',
        ]);

        $rule = Rule::create([
            'kode_aturan' => $validated['kode_aturan'],
            'fuzzy_output_id' => $validated['fuzzy_output_id'],
        ]);

        $rule->fuzzyInputs()->attach($validated['fuzzy_input_ids']);

        $notification = [
            'message' => 'Rule berhasil ditambahkan',
            'alert-type' => 'success'
        ];

        if ($request->save == true) {
            return redirect()->route('rule')->with($notification);
        } else {
            return redirect()->route('rule.create')->with($notification);
        }
    }



    public function edit($id)
    {
        $rule = Rule::with('fuzzyInputs')->findOrFail($id);
        $fuzzy_inputs = FuzzyInput::all();
        $fuzzy_outputs = FuzzyOutput::all();

        return view('admin.rules.edit', compact('rule', 'fuzzy_inputs', 'fuzzy_outputs'));
    }


    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'kode_aturan' => 'required|max:10|unique:rules,kode_aturan,' . $id,
            'fuzzy_output_id' => 'required|exists:fuzzy_outputs,id',
            'fuzzy_input_ids' => 'required|array|min:1',
            'fuzzy_input_ids.*' => 'exists:fuzzy_inputs,id',
        ]);

        $rule = Rule::findOrFail($id);

        $rule->update([
            'kode_aturan' => $validated['kode_aturan'],
            'fuzzy_output_id' => $validated['fuzzy_output_id'],
        ]);

        $rule->fuzzyInputs()->sync($validated['fuzzy_input_ids']);

        $notification = [
            'message' => 'Rule berhasil diperbarui',
            'alert-type' => 'success',
        ];

        return redirect()->route('rule')->with($notification);
    }



    public function destroy(string $id)
    {
        $rule = Rule::findOrFail($id);
        $rule->fuzzyInputs()->detach();
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

        $rules = Rule::where('kode_aturan', 'like', "%{$query}%")->get();

        return view('admin.rules.index', compact('rules'));
    }
}
