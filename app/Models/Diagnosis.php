<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    protected $fillable = [
        'nama_pasien',
        'tgl_lahir',
        'kelamin',
        'tanggal',
        'hasil',
        'user_id',
        'fuzzy_output_id',
    ];
}
