<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Diagnosis;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($startDate && $endDate) {

            try {
                $startDate = \Carbon\Carbon::parse($startDate)->startOfDay();
                $endDate = \Carbon\Carbon::parse($endDate)->endOfDay();
            } catch (\Exception $e) {
                return redirect()->route('report')->withErrors('Tanggal tidak valid');
            }


            $diagnoses = Diagnosis::whereBetween('created_at', [$startDate, $endDate])->get();
        } else {
            $diagnoses = Diagnosis::all();
        }

        return view('admin.reports.index', compact('diagnoses'));
    }

}
