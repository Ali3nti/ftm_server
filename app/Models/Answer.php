<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'name_family','email','mobile','subject','massage','publish','active','answer','visit','time_answer','date_answer','time','date','ip',
    ];
}
