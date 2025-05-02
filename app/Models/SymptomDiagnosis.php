<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SymptomDiagnosis extends Model
{
    protected $fillable = [

        'symptom_id',
        'diagnosis_id',
        'hasil',
    ];
}
