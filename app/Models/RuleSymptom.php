<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RuleSymptom extends Model
{
    protected $fillable = [
        'rule_id',
        'symptom_id',

    ];


    public function rule() {
        return $this->belongsTo(Rule::class);
    }

    public function symptoms()
    {
        return $this->belongsToMany(Symptom::class, 'rule_symptom');
    }

}
