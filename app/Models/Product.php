<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = [

        'code','title','image_one','image_two','image_three','description','date','time','active','ip'
    ];
}
