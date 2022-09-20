<?php

namespace App\Http\Controllers\Api;

use app\Http\Controllers\Controller;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OperatorController extends Controller
{ 
    
    public function operatorShiftData(Request $request)
    {
        $station = $request->station_id;
        $user = $request->user_id;

        $row = DB::table('app_shift_data')
            ->orderBy('id', 'desc')
            ->join('app_stations', 'app_stations.id', '=', 'app_shift_data.station_id')
            ->select('app_shift_data.*', 'app_stations.name as station_name')
            ->where('station_id', $station)
            ->where('user_id', $user)
            ->get();

        if ($row) {

        foreach($row as $edit) {

            $name = DB::table('app_users')->select('first_name','last_name')->where('id', $edit->user_id)->first();
            $edit->user_name = $name->first_name . ' ' . $name->last_name;

        }

            return $message = array(
                "status" => "1",
                "message" => "Data returned successfully.",
                "data" => $row

            );
        } else {
            return $message = array(
                "status" => "0",
                "message" => "Error",
                "data" => []
            );
        }
    }
}
