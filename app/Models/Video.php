<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'code','title','description','video','visit','date','time','ip'
    ];
}
