<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    protected $fillable = [
        'nama',
    ];

    public function fuzzySets()
    {
        return $this->hasMany(FuzzySet::class, 'symptom_id');
    }

    public function rules()
    {
        return $this->belongsToMany(Rule::class, 'rule_symptoms');
    }



}
