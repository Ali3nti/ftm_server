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

        $server_time = new DateTime('now', new DateTimeZone("Asia/Tehran"));


        $roles = DB::table('app_roles')
            ->get();

        $cities = DB::table('app_city')
            ->get();

        $stationsList = DB::table('app_stations')
            ->get();

        $stations = array();

        foreach ($stationsList as $row) {


            $row->supervisor = DB::table('app_users')->select('id', 'first_name', 'last_name')
                ->where('id', $row->supervisor)->first();


            $stations[] = $row;
        }



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

    public function StationOperators(Request $request)
    {

        $station_id = $request->station_id;

        $getOperators = DB::table('app_users')
            ->where('station', $station_id)
            ->where('role', 4)
            ->get();

        if ($getOperators) {

            return $message = array(
                'status' => '1',
                'message' => 'Return operators seccesfully',
                'data' => $getOperators
            );
        } else {
            return $message = array(
                'status' => '2',
                'message' => 'Return operators has error',
                'data' => []
            );
        }
    }

    public function SendNotification(Request $request)
    {

        $role_id = $request->role_id;

        $notif = DB::table('app_notif')
        ->orderByDesc('id')
            ->where([
                ['visibility', 'show'],
                ['contact', $role_id],
            ])->orWhere([
                ['visibility', 'show'],
                ['contact', 0],
            ])
            // ->where('visibility', 'show')
            // ->where('contact', $role_id)
            // ->where('contact', 0)
            ->get();

        if ($notif) {

            return $message = array(
                'status' => '1',
                'message' => 'Notification existing',
                'data' => $notif
            );
        }else{
            return $message = array(
                'status' => '0',
                'message' => 'Notification not exist',
                'data' => []
            );
        }
    }
}
