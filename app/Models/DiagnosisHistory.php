<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiagnosisHistory extends Model
{
    protected $fillable = [
        'nama_pasien',
        'tgl_lahir',
        'kelamin',
        'tanggal',
        'hasil',
        'user_id',
        'disease_id',
    ];
}
