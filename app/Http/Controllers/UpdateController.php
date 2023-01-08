<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class UpdateController extends Controller
{
    public function update()
    {
        $version =  DB::table('app_setting')
            ->where('key', 'version')
            ->value('value');

        return Redirect::to('http://www.farzintavanesh.com/download/' . $version . '/app.apk');
    }
}
