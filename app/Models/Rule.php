<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $fillable = [
        'nama',
        'disease_id',
    ];

    public function disease()
    {
        return $this->belongsTo(Disease::class);
    }

    public function symptoms()
    {
        return $this->belongsToMany(Symptom::class, 'rule_symptom');
    }

    public function fuzzyOutputs()
    {
        return $this->hasManyThrough(FuzzyOutput::class, Disease::class); 
    }
    public function ruleSymptoms()
    {
        return $this->hasMany(RuleSymptom::class);
    }

    public function fuzzy_set()
    {
        return $this->belongsTo(FuzzySet::class);
    }

}
