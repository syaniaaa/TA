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
            'keputusan' => 'required|max:50',
            'disease_id' => 'required|exists:diseases,id',
        ]);

        Rule::create($validated);

        $notification = array(
            'message' => 'Data Aturan berhasil ditambahkan',
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
            'keputusan' => 'required|max:50',
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
