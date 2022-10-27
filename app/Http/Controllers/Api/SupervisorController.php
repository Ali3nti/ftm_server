<?php

namespace App\Http\Controllers\Api;

use app\Http\Controllers\Controller;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupervisorController extends Controller
{
    public function supervisorShiftData(Request $request)
    {
        $station = $request->station_id;

        $row = DB::table('app_shift_data')
            ->orderBy('id', 'desc')
            ->join('app_stations', 'app_stations.id', '=', 'app_shift_data.station_id')
            ->select('app_shift_data.*', 'app_stations.name as station_name')
            ->where('station_id', $station)
            ->get();

            if ($row) {

                foreach ($row as $edit) {
    
                    $name = DB::table('app_users')->select('first_name', 'last_name')->where('id', $edit->user_id)->first();
                    $edit->user_name = $name->first_name . ' ' . $name->last_name;
                    $operators = unserialize($edit->operators_id);
                    $edit->operators_id = $operators[1];
    
                    $user = DB::table('app_users')
                    ->where('id', $operators[1])
                    ->first();
    
                if ($user) {
    
                    $user->role = DB::table('app_roles')->where('id', $user->role)->first();
    
                    $station = DB::table('app_stations')->where('id', $user->station)->first();
                    $station->supervisor = DB::table('app_users')->select('id', 'first_name', 'last_name')->where('id', $station->supervisor)->first();
                    $user->station = $station;
        
                    // $user->tbl_shift = DB::table('app_shifts')->where('id', $user->tbl_shift)->first();
                    $user->city = DB::table('app_city')->where('id', $user->city)->first();
                    $user->status = DB::table('app_status')->where('id', $user->status)->first();
    
                    $edit->operators = $user;
        
                }else{
    
                    return $message = array(
                        'status' => '0',
                        'message' => 'User is blocked.',
                        'data' => 'null'
                    );
                }
    
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
