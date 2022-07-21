<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Panel_admin extends Model
{
    protected $fillable = [
        'name_panel','link_panel','icon_panel','background_panel'
    ];
}
