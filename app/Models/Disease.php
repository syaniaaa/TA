<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    protected $fillable = [
        'nama',
        'deskripsi',
        'solusi',
    ];

}
