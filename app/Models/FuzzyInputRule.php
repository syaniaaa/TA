<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuzzyInputRule extends Model
{
    protected $fillable = [
        'rule_id',
        'fuzzy_input_id',
    ];
}
