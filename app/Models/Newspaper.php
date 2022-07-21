<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Newspaper extends Model
{
    protected $fillable = [
        'code','title','subject','description_one','description_two','date','time','type','link','whatsApp','telegram','instagram','visit','img','img1','img2','img3','img4','img5','img6','img7','img8','img9','img10',
        ];
}
