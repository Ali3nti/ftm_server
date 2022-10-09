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
            
        // $supervisors = DB::table('app_users')
        // ->select('id','first_name','last_name')
        // ->where('role', 3 )
        //     ->get();

        return $message = array(
            'status' => '1',
            'message' => 'Connected seccesfully',
            'data' => [
                'server_time' => $server_time,
                'roles' => $roles,
                'cities' => $cities,
                'stations' => $stations,
                // 'supervisors' => $supervisors
            ]
        );
    }

    public function StationOperators(Request $request){

        $station_id = $request->station_id;

        $getOperators = DB::table('app_users')
        ->where('station', $station_id)
        ->where('role', 4)
        ->get();

        if($getOperators){

            return $message = array(
                'status' => '1',
                'message' => 'Return operators seccesfully',
                'data' => $getOperators
            );
        }else{
            return $message = array(
                'status' => '2',
                'message' => 'Return operators has error',
                'data' => []
            );
        }
    }
}
