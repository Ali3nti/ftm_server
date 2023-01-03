<?php

namespace App\Http\Controllers\Dev;

use app\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use mysqli;

class DevController extends Controller
{
    public function Test()
    {
        //    $res =  DB::table('app_users')
        //     ->select('devices_info')
        //     ->get();
        //     foreach($res as $row){
        //         echo $row->devices_info;
        //     }
        //     return 1;


    }

    public function ChangeDate()
    {
        $all = DB::table('app_shift_data')
            ->get();
        for ($i = 0; $i < count($all); $i++) {
            $req = DB::table('app_shift_data')
                ->where('id', $all[$i]->id)
                ->update([
                    'start_shift_at' => jdate($all[$i]->start_shift_at), // jdate($article->created_at)->format('Y-m-d H:i:s');
                    'end_shift_at' => jdate($all[$i]->end_shift_at)
                ]);
        }
        return 'ok';
    }

    public function SerializeOperators()
    {
        $all = DB::table('app_shift_data')
            ->get();
        for ($i = 0; $i < count($all); $i++) {
            $operator = $all[$i]->operators_id;
            $operators = array($operator, $operator);
            $opt = serialize($operators);
            $req = DB::table('app_shift_data')
                ->where('id', $all[$i]->id)
                ->update(['operators_id' => $opt]);
        }
        return 'ok';
    }

    public function TranformToReportTable()
    {
        $all = DB::table('app_shift_data')
            ->get();
        $idList = array();
        for ($i = 0; $i < count($all); $i++) {
            $row = array();
            $operators["creator"] = $all[$i]->user_id;
            $operators["assistant"] = $all[$i]->user_id;
            $row["users"] = json_encode($operators);
            $dispenserNum = DB::table('app_stations')
                ->where('id', $all[$i]->station_id)
                ->value('dispenser');
            for ($j = 1; $j <= $dispenserNum; $j++) {
                if ($j == 1) {
                    $row["dispensers"][$j]["start_1"] = $all[$i]->nozzle_1 - $all[$i]->result_1;
                    $row["dispensers"][$j]["start_2"] = $all[$i]->nozzle_2 - $all[$i]->result_2;
                    $row["dispensers"][$j]["end_1"] = (int) $all[$i]->nozzle_1;
                    $row["dispensers"][$j]["end_2"] = (int) $all[$i]->nozzle_2;
                }
                if ($j == 2) {
                    $row["dispensers"][$j]["start_1"] = $all[$i]->nozzle_3 - $all[$i]->result_3;
                    $row["dispensers"][$j]["start_2"] = $all[$i]->nozzle_4 - $all[$i]->result_4;
                    $row["dispensers"][$j]["end_1"] = (int) $all[$i]->nozzle_3;
                    $row["dispensers"][$j]["end_2"] = (int) $all[$i]->nozzle_4;
                }
                if ($j == 3) {
                    $row["dispensers"][$j]["start_1"] = $all[$i]->nozzle_5 - $all[$i]->result_5;
                    $row["dispensers"][$j]["start_2"] = $all[$i]->nozzle_6 - $all[$i]->result_6;
                    $row["dispensers"][$j]["end_1"] = (int) $all[$i]->nozzle_5;
                    $row["dispensers"][$j]["end_2"] = (int) $all[$i]->nozzle_6;
                }
                if ($j == 4) {
                    $row["dispensers"][$j]["start_1"] = $all[$i]->nozzle_7 - $all[$i]->result_7;
                    $row["dispensers"][$j]["start_2"] = $all[$i]->nozzle_8 - $all[$i]->result_8;
                    $row["dispensers"][$j]["end_1"] = (int) $all[$i]->nozzle_7;
                    $row["dispensers"][$j]["end_2"] = (int) $all[$i]->nozzle_8;
                }
            }
            $row["dispensers"] = json_encode($row["dispensers"]);
            $req = DB::table('app_report')
                ->insertGetId([
                    'station_id' => $all[$i]->station_id,
                    'users' => $row["users"],
                    'start_at' => $all[$i]->start_shift_at,
                    'end_at' => $all[$i]->end_shift_at,
                    'dispensers' => $row["dispensers"],
                    'cash' => $all[$i]->card_cash,
                    'contradiction' => $all[$i]->contradiction,
                    'contradiction_flag' => $all[$i]->contradiction_flag,
                    'modified_flag' => $all[$i]->modified_flag,
                    'confirm' => $all[$i]->confirm,
                ]);
            $idList[$i] = $req;
        }
        return $idList;
    }

    public function TranformToTimesheetTable()
    {
        $all = DB::table('app_report')
            ->get();
        $idList = array();
        for ($i = 0; $i < count($all); $i++) {
            $users = json_decode($all[$i]->users);
            $req = DB::table('app_timesheet')
                ->insertGetId([
                    'station_id' => $all[$i]->station_id,
                    'user_id' => $users->creator,
                    'shift_id' => $all[$i]->id,
                    'start' => $all[$i]->start_at,
                    'end' => $all[$i]->end_at,
                    'status' => 2,
                ]);
            $idList[$i] = $req;
        }
        return $idList;
    }

    public function IdChanger()
    {
        $all = DB::table('app_timesheet')
            ->get();

        for ($i = 0; $i < count($all); $i++) {
            $req = DB::table('app_timesheet')
                ->where('user_id', 4)
                ->update([
                    'user_id' => 10
                ]);
        }
        return "ok";
    }

    public function IdReportChanger()
    {
        $all = DB::table('app_report')
            ->get();

        for ($i = 0; $i < count($all); $i++) {

            $users = json_decode($all[$i]->users);
            if ($users->creator == 4) {
                $users->creator = 10;
                $users->assistant = 10;

                $user = json_encode($users);

                $req = DB::table('app_report')
                    ->where('id', $all[$i]->id)
                    ->update([
                        'users' => $user
                    ]);
            }
        }
        return "ok";
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
            header("Content-Type: application/vnd.ms-excel; charset=utf-8");
            ini_set("default_charset", "UTF-8");
            mb_internal_encoding("UTF-8");
            iconv_set_encoding("internal_encoding", "UTF-8");
            iconv_set_encoding("output_encoding", "UTF-8");
            header("Content-Disposition: attachment; filename=\"$filename\"");
    
            echo $excelData;
        }


        // exit;
    }
}
