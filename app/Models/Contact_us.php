<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact_us extends Model
{
    protected $fillable = [
        'name_family','email','mobile','subject','massage','publish','active','answer','visit','time_answer','date_answer','time','date', 'ip'
    ];
}
