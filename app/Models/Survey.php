<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class survey extends Model
{
    protected $fillable = [

        'question','answer_one','answer_two','answer_three','answer_four','date','active'
    ];
}
