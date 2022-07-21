<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'slider_img','slider_img_one','slider_img_two','slider_text','slider_text_two','active','control'
    ];
}
