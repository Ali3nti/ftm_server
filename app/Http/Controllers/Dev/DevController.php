<?php

namespace App\Http\Controllers\Dev;

use app\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DevController extends Controller
{
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
                if($users->creator == 4){
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
}
