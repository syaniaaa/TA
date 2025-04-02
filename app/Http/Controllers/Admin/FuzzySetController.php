<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Symptom;
use App\Models\FuzzySet;

class FuzzySetController extends Controller
{
    public function index()
    {
        $data['fuzzy_sets'] = FuzzySet::all();
        return view('admin.fuzzySets.index', $data);
    }

    public function create()
    {
        $data['symptoms'] = Symptom::pluck('nama', 'id');
        $data['fuzzy_sets'] = FuzzySet::pluck('nama', 'id');
        return view('admin.fuzzySets.create', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori' => 'required|max:50',
            'domain' => 'required|max:50',
            'symptom_id' => 'required|exists:symptoms,id',
        ]);

        FuzzySet::create($validated);

        $notification = array(
            'message' => 'Data Gejala berhasil ditambahkan',
            'alert-type' => 'success'
        );

        if ($request->save == true) {
            return redirect()->route('fuzzy_set')->with($notification);
        } else {
            return redirect()->route('fuzzy_set.create')->with($notification);
        }
    }

    public function edit(string $id)
    {
        $data['fuzzy_set'] = FuzzySet::find($id);
        $data['fuzzy_sets'] = FuzzySet::pluck('nama', 'id');

        return view('admin.fuzzySets.edit', $data);
    }

    public function update(Request $request, string $id)
    {

        $validated = $request->validate([
            'kategori' => 'required|max:50',
            'domain' => 'required|max:50',
            'symptom_id' => 'required|exists:symptoms,id',
        ]);
        FuzzySet::where('id', $id)->update($validated);
        $notification = array(
            'message' => 'Data Gejala berhasil diperbaharui',
            'alert-type' => 'success'
        );
        return redirect()->route('fuzzy_set')->with($notification);
    }


    public function destroy(string $id)
    {
        $fuzzy_set = FuzzySet::findOrFail($id);

        $fuzzy_set->delete();
        $notification = array(
            'message' => 'Data Gejala berhasil dihapus',
            'alert-type' => 'success'
        );
        return redirect()->route('fuzzy_set')->with($notification);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $fuzzy_sets = FuzzySet::where('nama', 'like', "%{$query}%")->get();

        return view('admin.fuzzySets.index', compact('fuzzy_sets'));
    }
}
