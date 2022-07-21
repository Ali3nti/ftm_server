<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillable = [
        'main_one','main_two','main_three','pen','background','pen_footer','back_footer','pen_footer_two','back_footer_two','icon','borders','pen_panel','back_panel','title_panel'
    ];
}
