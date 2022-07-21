<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class General extends Model
{
    protected $fillable = [
        'title','description','keywords_fa','keywords_en','company','company_code','last_name','first_name','address',
        'address_two','postal_code','mobile','mobile_two',
        'telephone','link','email','logo','img','favicon','country','province','city','village','website','maps'
    ];
}
