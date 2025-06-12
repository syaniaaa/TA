<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Risk extends Model
{
    protected $fillable = [
        'kode_risiko',
        'nama',
        'bobot',
    ];
}
