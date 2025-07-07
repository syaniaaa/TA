<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuzzyOutput extends Model
{
    protected $fillable = [
        'himpunan',
        'min',
        'max',
        'mid',
        'arah',
        'disease_id',
    ];

    public function disease()
    {
        return $this->belongsTo(disease::class, 'disease_id');
    }
}
