<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuzzyOutput extends Model
{
    protected $fillable = [
        'kategori',
        'min',
        'max',
        'disease_id',
    ];

    public function diseases()
    {
        return $this->belongsTo(disease::class, 'disease_id');
    }
}
