<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuzzySet extends Model
{
    protected $fillable = [
        'kategori',
        'min',
        'max',
        'unit',
        'symptom_id',
    ];

    public function symptoms()
    {
        return $this->belongsTo(Symptom::class, 'symptom_id');
    }
}
