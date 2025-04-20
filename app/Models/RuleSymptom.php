<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RuleSymptom extends Model
{
    protected $fillable = [
        'rule_id',
        'symptom_id',

    ];

    public function symptom()
    {
        return $this->belongsTo(Symptom::class, 'symptom_id');
    }

}
