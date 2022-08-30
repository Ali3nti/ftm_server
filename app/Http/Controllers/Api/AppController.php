<?php

namespace App\Http\Controllers\Api;

use app\Http\Controllers\Controller;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{

    public function appInfo()
    {

        $server_time = new DateTime('now', new DateTimeZone('Asia/Tehran'));


        $roles = DB::table('app_roles')
            ->get();

        $cities = DB::table('app_city')
            ->get();

        $stations = DB::table('app_stations')
            ->get();

        return $message = array(
            'status' => '1',
            'message' => 'Connected seccesfully',
            'data' => [
                'server_time' => $server_time,
                'roles' => $roles,
                'cities' => $cities,
                'stations' => $stations
            ]
        );
    }
}
