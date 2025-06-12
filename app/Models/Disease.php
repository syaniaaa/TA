<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    protected $fillable = [
        'kode_penyakit',
        'nama',
        'deskripsi',
        'solusi',
    ];

}
