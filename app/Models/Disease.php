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

    public function fuzzyOutputs()
    {
        return $this->hasMany(FuzzyOutput::class, 'disease_id');
    }

    public function rules() {
        return $this->hasMany(Rule::class);
    }


}
