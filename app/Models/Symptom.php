<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    protected $fillable = [
        'kode_gejala',
        'nama',
        'jenis_gejala'
    ];

    public function fuzzyInputs()
    {
        return $this->hasMany(FuzzyInput::class);
    }


}
