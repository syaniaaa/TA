<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DiseaseController;
use App\Http\Controllers\Admin\SymptomController;
use App\Http\Controllers\Admin\FuzzyInputController;
use App\Http\Controllers\Admin\FuzzyOutputController;
use App\Http\Controllers\Admin\RuleController;
use App\Http\Controllers\Admin\RiskController;
use App\Http\Controllers\Admin\DiagnosisController;
use App\Http\Controllers\Patient\DiagnosisController as PatientDiagnosisController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/', function () {
    return view('home');
})->name('homepage');

Route::get('/question', function () {
    return view('patient.question');
})->name('question');

Route::get('/aboutUs', function () {
    return view('patient.aboutUs');
})->name('aboutUs');

Route::middleware('auth')->group(function () {
    Route::get('/history', function () {
        return view('patient.diagnosisHistory.history');
    })->name('history');

    Route::get('/result', function () {
        return view('patient.diagnosis.result');
    })->name('diagnosis.result');

    Route::get('/symptomTest', [PatientDiagnosisController::class, 'create'])->name('diagnosis.symptomTest');
    Route::post('/symptomTest', [PatientDiagnosisController::class, 'store'])->name('diagnosis.symptomTest.store');
    Route::get('/riskTest', [PatientDiagnosisController::class, 'create2'])->name('diagnosis.riskTest');
    Route::post('/riskTest', [PatientDiagnosisController::class, 'store2'])->name('diagnosis.riskTest.store2');
    Route::get('/result', [PatientDiagnosisController::class, 'showResult'])->name('diagnosis.result');
    Route::get('/diagnosisHistory/history', [PatientDiagnosisController::class, 'history'])->name('diagnosis.history');
    Route::get('/patient/diagnosis-history/{id}', [PatientDiagnosisController::class, 'show'])
        ->name('patient.diagnosisHistory.show');
    Route::get('/diagnosis-history/{id}/print', [PatientDiagnosisController::class, 'print'])->name('patient.diagnosisHistory.print');

});



// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
Route::middleware(['auth', 'role:Staf Puskesmas'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('user');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/users', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::match(['put', 'patch'], '/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/user/search', [UserController::class, 'search'])->name('user.search');


    Route::get('/diseases', [DiseaseController::class, 'index'])->name('disease');
    Route::get('/disease/create', [DiseaseController::class, 'create'])->name('disease.create');
    Route::post('/diseases', [DiseaseController::class, 'store'])->name('disease.store');
    Route::get('/disease/{id}/edit', [DiseaseController::class, 'edit'])->name('disease.edit');
    Route::match(['put', 'patch'], '/disease/{id}', [DiseaseController::class, 'update'])->name('disease.update');
    Route::delete('/disease/{id}', [DiseaseController::class, 'destroy'])->name('disease.destroy');
    Route::get('/disease/search', [DiseaseController::class, 'search'])->name('disease.search');

    Route::get('/symptoms', [SymptomController::class, 'index'])->name('symptom');
    Route::get('/symptom/create', [SymptomController::class, 'create'])->name('symptom.create');
    Route::post('/symptoms', [SymptomController::class, 'store'])->name('symptom.store');
    Route::get('/symptom/{id}/edit', [SymptomController::class, 'edit'])->name('symptom.edit');
    Route::match(['put', 'patch'], '/symptom/{id}', [SymptomController::class, 'update'])->name('symptom.update');
    Route::delete('/symptom/{id}', [SymptomController::class, 'destroy'])->name('symptom.destroy');
    Route::get('/symptom/search', [SymptomController::class, 'search'])->name('symptom.search');

    Route::get('/fuzzyInputs', [FuzzyInputController::class, 'index'])->name('fuzzy_input');
    Route::get('/fuzzy_input/create', [FuzzyInputController::class, 'create'])->name('fuzzy_input.create');
    Route::post('/fuzzy_inputs', [FuzzyInputController::class, 'store'])->name('fuzzy_input.store');
    Route::get('/fuzzy_input/{id}/edit', [FuzzyInputController::class, 'edit'])->name('fuzzy_input.edit');
    Route::match(['put', 'patch'], '/fuzzy_input/{id}', [FuzzyInputController::class, 'update'])->name('fuzzy_input.update');
    Route::delete('/fuzzy_input/{id}', [FuzzyInputController::class, 'destroy'])->name('fuzzy_input.destroy');
    Route::get('/fuzzy_input/search', [FuzzyInputController::class, 'search'])->name('fuzzy_input.search');

    Route::get('/fuzzyOutputs', [FuzzyOutputController::class, 'index'])->name('fuzzy_output');
    Route::get('/fuzzy_output/create', [FuzzyOutputController::class, 'create'])->name('fuzzy_output.create');
    Route::post('/fuzzy_outputs', [FuzzyOutputController::class, 'store'])->name('fuzzy_output.store');
    Route::get('/fuzzy_output/{id}/edit', [FuzzyOutputController::class, 'edit'])->name('fuzzy_output.edit');
    Route::match(['put', 'patch'], '/fuzzy_output/{id}', [FuzzyOutputController::class, 'update'])->name('fuzzy_output.update');
    Route::delete('/fuzzy_output/{id}', [FuzzyOutputController::class, 'destroy'])->name('fuzzy_output.destroy');
    Route::get('/fuzzy_output/search', [FuzzyOutputController::class, 'search'])->name('fuzzy_output.search');

    Route::get('/rules', [RuleController::class, 'index'])->name('rule');
    Route::get('/rule/create', [RuleController::class, 'create'])->name('rule.create');
    Route::post('/rules', [RuleController::class, 'store'])->name('rule.store');
    Route::get('/rule/{id}/edit', [RuleController::class, 'edit'])->name('rule.edit');
    Route::match(['put', 'patch'], '/rule/{id}', [RuleController::class, 'update'])->name('rule.update');
    Route::delete('/rule/{id}', [RuleController::class, 'destroy'])->name('rule.destroy');
    Route::get('/rule/search', [RuleController::class, 'search'])->name('rule.search');


    Route::get('/risks', [RiskController::class, 'index'])->name('risk');
    Route::get('/risk/create', [RiskController::class, 'create'])->name('risk.create');
    Route::post('/risks', [RiskController::class, 'store'])->name('risk.store');
    Route::get('/risk/{id}/edit', [RiskController::class, 'edit'])->name('risk.edit');
    Route::match(['put', 'patch'], '/risk/{id}', [RiskController::class, 'update'])->name('risk.update');
    Route::delete('/risk/{id}', [RiskController::class, 'destroy'])->name('risk.destroy');
    Route::get('/risk/search', [RiskController::class, 'search'])->name('risk.search');

    Route::get('/diagnoses', [DiagnosisController::class, 'index'])->name('diagnoses');
    Route::get('/diagnosis/search', [DiagnosisController::class, 'search'])->name('diagnosis.search');
    Route::get('/diagnosis/{id}', [DiagnosisController::class, 'show'])->name('diagnosis.show');


    Route::get('/reports', [ReportController::class, 'index'])->name('report');
    Route::get('/reports/print', [ReportController::class, 'print'])->name('reports.print');
});
