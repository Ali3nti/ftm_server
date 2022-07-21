<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    protected $fillable = [
        'name_menu','link_menu','icon_menu','background_menu'
    ];
}
