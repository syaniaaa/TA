<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuzzyInput extends Model
{
    protected $fillable = [
        'kategori',
        'min',
        'max',
        'unit',
        'symptom_id',
    ];

    public function symptom()
    {
        return $this->belongsTo(Symptom::class, 'symptom_id');
    }
}
