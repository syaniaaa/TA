<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuzzySet extends Model
{
    protected $fillable = [
        'kategori',
        'domain',
        'symptom_id',
    ];
}
