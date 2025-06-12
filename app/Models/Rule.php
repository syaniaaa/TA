<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $fillable = [
        'kode_aturan',
        'fuzzy_output_id',
    ];

    public function fuzzyInputs()
    {
        return $this->belongsToMany(FuzzyInput::class, 'fuzzy_input_rule');
    }

    public function fuzzyOutput()
    {
        return $this->belongsTo(FuzzyOutput::class);
    }


}
