<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Diagnosis;

class DiagnosisController extends Controller
{
    public function index()
    {
        $data['diagnoses'] = Diagnosis::all();
        return view('admin.diagnoses.index', $data);
    }

    public function show($id)
    {


        return view('admin.orders.show', compact('order_items'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $diagnoses = Diagnosis::where('name', 'like', "%{$query}%")->get();

        return view('admin.diagnosess.index', compact('diagnoses'));
    }

}
