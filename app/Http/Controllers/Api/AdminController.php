<?php

namespace App\Http\Controllers\Api;

use app\Http\Controllers\Controller;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function allShiftData(Request $request)
    {
        $station = $request->station_id;

        $row = DB::table('app_shift_data')
            ->orderBy('id', 'desc')
            ->join('app_stations', 'app_stations.id', '=', 'app_shift_data.station_id')
            ->select('app_shift_data.*', 'app_stations.name as station_name')
            // ->where('station_id', $station)
            ->get();

        if ($row) {

            foreach ($row as $edit) {

                $name = DB::table('app_users')->select('first_name', 'last_name')->where('id', $edit->user_id)->first();
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

    public function addStation(Request $request)
    {

        $station_name = $request->station_name;
        $location = $request->location;
        $station_code = $request->station_code;
        $city_id = $request->city_id;
        $number_of_dispenser = $request->number_of_dispenser;

        $create_date = new DateTime('now', new DateTimeZone('Asia/Tehran'));

        // $checkStationCode = DB::table('app_stations')
        //     ->where('code', $stationCode)
        //     ->get();

        // if ($checkStationCode) {
        //     return $message = array(
        //         "status" => "0",
        //         "message" => "Station already exists",
        //         "data" => [
        //             "station_id" => $checkStationCode->id
        //         ]
        //     );
        // } else {
            $addStation = DB::table('app_stations')
                ->insertGetId([
                    'name' => $station_name,
                    'location' => $location,
                    // 'code' => $station_code,
                    // 'city' => $city_id,
                    'dispenser' => $number_of_dispenser,
                    // 'supervisor' => $supervisor,
                    // 'created_at' => $create_date
                ]);

            if ($addStation) {
                return $message = array(
                    "status" => "1",
                    "message" => "Station added successfully",
                    "data" => [
                        "station_id" => $addStation
                    ]
                );
            } else {
                return $message = array(
                    "status" => "0",
                    "message" => "Error in add Station",
                    "data" => []
                );
            // }
        }
    }
}
