<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ftm_new extends Model
{
    protected $fillable = [
        'code','title','description_one','description_two','img_one','img_two','img_three','ip','date','time'
    ];
}
