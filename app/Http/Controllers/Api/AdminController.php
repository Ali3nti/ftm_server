<?php

namespace App\Http\Controllers\Api;

use app\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function TableData(Request $request)
    {
        $title = $request->title;
        $data = DB::table($title)
            ->get();

        if ($data) {
            return $message = array(
                "status" => "1",
                "message" => "data is exist",
                "data" => $data
            );
        } else {
            return $message = array(
                "status" => "0",
                "message" => "Error in database",
                "data" => []
            );
        }
    }

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
                } else {

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

    public function addStation(Request $request)
    {

        $station_name = $request->station_name;
        $location = $request->location;
        $station_code = $request->station_code;
        $city_id = $request->city_id;
        $number_of_dispenser = $request->number_of_dispenser;

        $create_date = jdate();

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
    public function getStationTimesheet()
    {
        $users = DB::table('app_users')
            ->where('station', 1)
            ->orderByDesc('id')
            ->get();

        foreach ($users as $col) {

            $all = DB::table('app_timesheet')
                ->where([['station_id', 1], ['user_id', $col->id]])
                ->get();

            $station = DB::table('app_stations')
                ->where('id', 1)
                ->first();

            $stationLatitude = substr($station->location, 0, 9);
            $stationLongitude = substr($station->location, 10, 9);


            $delimiter = ",";
            $filename = "members-data_" . date('Y-m-d') . ".csv";
            $f = fopen('php://memory', 'w');
            $fields1 = array($station->name, '    ', $col->first_name, ' ', $col->last_name);
            $fields2 = array('تاریخ', 'شروع', 'پایان', 'کارکرد', 'در محل');
            fputcsv($f, $fields1, $delimiter);
            fputcsv($f, $fields2, $delimiter);
            $line = array();
            foreach ($all as $row) {
                $start = strtotime(date($row->start));
                $end = strtotime(date($row->end));
                if (substr($row->start, 5, 2) == '09') {
                    $function = round((($end - $start) / 3600), 2);


                    $userLatitude = substr($row->location, 0, 7);
                    $userLongitude = substr($row->location, 8, 7);

                    $inLoc = 'خیر';

                    if (
                        $userLatitude > $stationLatitude - 0.0012 &&
                        $userLatitude < $stationLatitude + 0.0012
                    ) {
                        if (
                            $userLongitude > $stationLongitude - 0.0012 &&
                            $userLongitude < $stationLongitude + 0.0012
                        ) {
                            $inLoc = 'بله';
                        }
                    }

                    $lineData = array(
                        substr($row->start, 0, 10),
                        substr($row->start, 11, 8),
                        substr($row->end, 11, 8),
                        $function,
                        $inLoc
                    );
                    fputcsv($f, $lineData, $delimiter);
                }
            }
            fseek($f, 0);
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '";');

            fpassthru($f);
        }
    }

    public function getUsersTimesheet()
    {

        function filterData(&$str)
        {
            $str = preg_replace("/\t/", "\\t", $str);
            $str = preg_replace("/\r?\n/", "\\n", $str);
            if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
        }

        $filename = "members-data_" . date('Y-m-d') . ".xls";

        $users = DB::table('app_users')
            ->where('station', 1)
            // ->orderByDesc('id')
            ->get();

        foreach ($users as $col) {

            $all = DB::table('app_timesheet')
                ->where([['station_id', 1], ['user_id', $col->id]])
                ->get();

            $station = DB::table('app_stations')
                ->where('id', 1)
                ->first();

            $stationLatitude = substr($station->location, 0, 9);
            $stationLongitude = substr($station->location, 10, 9);

            $fields1 = array($station->name, '    ', $col->first_name, ' ', $col->last_name);
            $fields2 = array('تاریخ', 'شروع', 'پایان', 'کارکرد', 'در محل');
            $excelData = implode("\t", array_values($fields2)) . "\n";
            $excelData = implode("\t", array_values($fields1)) . "\n";

            foreach ($all as $row) {
                $start = strtotime(date($row->start));
                $end = strtotime(date($row->end));
                if (substr($row->start, 5, 2) == '09') {
                    $function = round((($end - $start) / 3600), 2);


                    $userLatitude = substr($row->location, 0, 7);
                    $userLongitude = substr($row->location, 8, 7);

                    $inLoc = 'خیر';

                    if (
                        $userLatitude > $stationLatitude - 0.0012 &&
                        $userLatitude < $stationLatitude + 0.0012
                    ) {
                        if (
                            $userLongitude > $stationLongitude - 0.0012 &&
                            $userLongitude < $stationLongitude + 0.0012
                        ) {
                            $inLoc = 'بله';
                        }
                    }

                    $lineData = array(
                        substr($row->start, 0, 10),
                        substr($row->start, 11, 8),
                        substr($row->end, 11, 8),
                        $function,
                        $inLoc
                    );
                    // array_walk($lineData, 'filterData');
                    $excelData .= implode("\t", array_values($lineData)) . "\n";
                }
            }

            header('Content-Encoding: UTF-8');
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=\"$filename\"");
            echo "\xEF\xBB\xBF";

            echo $excelData;
        }


        // exit;
    }
}
