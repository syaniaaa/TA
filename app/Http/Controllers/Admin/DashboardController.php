<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rule;
use App\Models\Disease;
use App\Models\Symptom;
use App\Models\Diagnosis;
use App\Models\Risk;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $disease_count = Disease::count();
        $symptom_count = Symptom::count();
        $rule_count = Rule::count();
        $risk_count = Risk::count();
        $diagnosis_count = Diagnosis::count();
        $user_count = User::count();

        // Ambil data update terakhir
        $last_disease_update = Disease::orderBy('updated_at', 'desc')->first();
        $last_symptom_update = Symptom::orderBy('updated_at', 'desc')->first();
        $last_rule_update = Rule::orderBy('updated_at', 'desc')->first();
        $last_risk_update = Risk::orderBy('updated_at', 'desc')->first();
        $last_diagnosis_update = Diagnosis::orderBy('updated_at', 'desc')->first();
        $last_user_update = User::orderBy('updated_at', 'desc')->first();

        // Ambil waktu pembaruan terbaru dari semua model
        $latest_update_times = [
            optional($last_disease_update)->updated_at,
            optional($last_symptom_update)->updated_at,
            optional($last_rule_update)->updated_at,
            optional($last_risk_update)->updated_at,
            optional($last_diagnosis_update)->updated_at,
            optional($last_user_update)->updated_at,
        ];

        $last_updated_time = collect($latest_update_times)->filter()->max();

        Carbon::setLocale('id');
        $last_updated = $last_updated_time ? Carbon::parse($last_updated_time)->diffForHumans() : 'Belum ada pembaruan';

        return view('admin.dashboard', compact(
            'disease_count',
            'symptom_count',
            'risk_count',
            'rule_count',
            'diagnosis_count',
            'user_count',
            'last_updated'
        )
        );
    }
}
