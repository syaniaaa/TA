<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Diagnosis;

class DiagnosisController extends Controller
{
    public function index()
    {
        $data['diagnoses'] = diagnosis::all();
        return view('admin.diagnoses.index', $data);
    }

    public function show($id)
    {


        return view('admin.orders.show', compact('order_items'));
    }

}
