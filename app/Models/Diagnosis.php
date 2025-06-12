<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    protected $fillable = [
        'tanggal',
        'hasil',
        'hasil_fuzzy',
        'user_id',
        'fuzzy_output_id',
    ];
}
