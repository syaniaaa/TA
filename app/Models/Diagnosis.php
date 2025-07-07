<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    protected $fillable = [
        'tanggal',
        'hasil',
        'hasil_fuzzy',
        'tingkat_kemungkinan',
        'user_id',
        'fuzzy_output_id',
    ];

    // Diagnosis.php
    public function symptoms()
    {
        return $this->belongsToMany(Symptom::class, 'symptom_diagnosis')->withTimestamps();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fuzzyOutput()
    {
        return $this->belongsTo(FuzzyOutput::class, 'fuzzy_output_id');
    }


    public function risks()
    {
        return $this->belongsToMany(Risk::class, 'risk_diagnosis');
    }

    
}
