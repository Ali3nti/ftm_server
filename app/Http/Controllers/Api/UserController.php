<?php

namespace App\Http\Controllers\Api;

use app\Http\Controllers\Controller;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    function getUser(int $id)
    {
        $user = DB::table('app_users')
            ->where('id', $id)
            ->first();

        $user->role = DB::table('app_roles')->where('id', $user->role)->first();
        $station = DB::table('app_stations')->where('id', $user->station)->first();
        $station->supervisor = DB::table('app_users')->select('id', 'first_name', 'last_name')
            ->where('id', $station->supervisor)->first();
        $user->station = $station;
        $user->city = DB::table('app_city')->where('id', $user->city)->first();
        $user->status = DB::table('app_status')->where('id', $user->status)->first();

        return $user;
    }

    public function addUser(Request $request)
    {

        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $role_id = $request->role_id;
        $phone = $request->phone;
        $id_card = $request->id_card;
        $id_personnel = $request->id_personnel;
        $city_id = $request->city_id;
        $station_id = $request->station_id;

        $create_date = jdate();

        $filePath = "";

        if ($request->image) {

            $image = $request->image;
            $image->move('images/avatar/', $phone . '.jpg');
            $filePath = 'images/avatar/' . $phone . '.jpg';
        } else {
            $filePath = 'N/A';
        }

        $checkUserCardID = DB::table('app_users')
            ->where('id_card', $id_card)
            ->first();

        if ($checkUserCardID) {
            return $message = array(
                "status" => "0",
                "message" => "User already exists",
                "data" => [
                    "user_id" => $checkUserCardID->id
                ]
            );
        } else {
            $checkUserPhone = DB::table('app_users')
                ->where('phone', $phone)
                ->first();
            if ($checkUserPhone) {
                return $message = array(
                    "status" => "0",
                    "message" => "This phone number already exists",
                    "data" => [
                        "user_id" => $checkUserPhone->id
                    ]
                );
            } else {
                $checkUserPersonnelID = DB::table('app_users')
                    ->where('id_personnel', $id_personnel)
                    ->first();
                if ($checkUserPersonnelID) {
                    return $message = array(
                        "status" => "0",
                        "message" => "This personnel id already exists",
                        "data" => [
                            "user_id" => $checkUserPersonnelID->id
                        ]
                    );
                } else {

                    $addUser = DB::table('app_users')
                        ->insertGetId([
                            'first_name' => $first_name,
                            'last_name' => $last_name,
                            'role' => $role_id,
                            'phone' => $phone,
                            'id_card' => $id_card,
                            'id_personnel' => $id_personnel,
                            'station' => $station_id,
                            'city' => $city_id,
                            'avatar' => $filePath,
                            'created_at' => $create_date,
                            'update_at' => $create_date
                        ]);

                    if ($addUser) {
                        return $message = array(
                            "status" => "1",
                            "message" => "User added successfully",
                            "data" => [
                                "user_id" => $addUser
                            ]
                        );
                    } else {
                        return $message = array(
                            "status" => "0",
                            "message" => "Error in add User",
                            "data" => []
                        );
                    }
                }
            }
        }
    }

    public function allUser(Request $request)
    {

        // $req = DB::table('app_users')
        // ->join('app_roles', 'app_roles.id','=','app_users.role')
        // ->select('app_users.*', 'app_roles.id', 'app_roles.name')
        // ->get();

        $req = DB::table('app_users')
            ->get();
        $users = array();

        foreach ($req as $row) {


            $row->role = DB::table('app_roles')
                ->where('id', $row->role)->first();

            $station = DB::table('app_stations')
                ->where('id', $row->station)
                ->first();

            $station->supervisor = DB::table('app_users')
                ->select('id', 'first_name', 'last_name')
                ->where('id', $station->supervisor)
                ->first();

            $row->station = $station;
            $row->city = DB::table('app_city')
                ->where('id', $row->city)
                ->first();

            $row->status = DB::table('app_status')
                ->where('id', $row->status)
                ->first();

            $users[] = $row;
        }

        if ($req) {
            return $message = array('status' => '1', 'message' => 'Users return', 'data' => $users);
        } else {
            return $message = array('status' => '0', 'message' => 'Users does not found', 'data' => []);
        }
    }

    public function userInfo(Request $request)
    {

        $id_personnel = $request->id_personnel;
        $user = DB::table('app_users')
            ->where('id_personnel', $id_personnel)
            ->first();

        if ($user) {

            $user->role = DB::table('app_roles')
                ->where('id', $user->role)
                ->first();

            $station = DB::table('app_stations')
                ->where('id', $user->station)
                ->first();

            $station->supervisor = DB::table('app_users')
                ->select('id', 'first_name', 'last_name')
                ->where('id', $station->supervisor)
                ->first();

            $user->station = $station;

            // $user->tbl_shift = DB::table('app_shifts')->where('id', $user->tbl_shift)->first();
            $user->city = DB::table('app_city')
                ->where('id', $user->city)
                ->first();

            $user->status = DB::table('app_status')
                ->where('id', $user->status)
                ->first();

            return $message = array('status' => '1', 'message' => $user);

            // $response = array('status' => '1','message' => $user);
            // return $message = response()->json($response,200,[],JSON_UNESCAPED_UNICODE);
        } else {
            return $message = array('status' => '0', 'message' => 'User Not Found');
        }
    }

    public function userVerify(Request $request)
    {

        $user_id = $request->user_id;
        $verified_date = jdate();

        $user = DB::table('app_users')
            ->where('id', $user_id)
            ->update([
                'is_verified' => 1,
                'verified_at' => $verified_date,
                'update_at' => $verified_date,
                'block' => 0,
                'status' => 1
            ]);

        if ($user) {
            return $message = array(
                'status' => '1',
                'message' => 'User verified'
            );
        } else {
            return $message = array(
                'status' => '0',
                'message' => 'Something was wrong'
            );
        }
    }

    public function addTimesheet(Request $request)
    {

        $user_id = $request->user_id;
        $location = $request->location;

        $current_time = jdate();

        $station = DB::table('app_users')
            ->where('id', $user_id)
            ->first();

        $checkLastTime = DB::table('app_timesheet')
            ->orderByDesc('id')
            ->where('user_id', $user_id)
            ->first();

        if ($checkLastTime != null && $checkLastTime->end == 0) {

            $updateTimeSheet = DB::table('app_timesheet')
                ->where('id', $checkLastTime->id)
                ->update([
                    'end' => $current_time,
                    'location' => $location,
                    'status' => 2,
                ]);

            $updateUserStatus = DB::table('app_users')
                ->where('id', $user_id)
                ->update([
                    'status' => 1
                ]);

            return $message = array(
                'status' => '1',
                'message' => 'Timesheet is Close!'
            );
        } else {
            $addTimeSheet = DB::table('app_timesheet')
                ->insertGetId([
                    'user_id' => $user_id,
                    'station_id' => $station->station,
                    'shift_id' => 0,
                    'start' => $current_time,
                    'location' => $location,
                    'status' => 1,
                ]);

            $updateUserStatus = DB::table('app_users')
                ->where('id', $user_id)
                ->update([
                    'status' => 3
                ]);

            return $message = array(
                'status' => '2',
                'message' => 'Timesheet is Open!'
            );
        }
    }

    public function getTimeSheet(Request $request)
    {

        $user_id = $request->user_id;
        $month = jdate()->format('m');

        $getTimesheet = DB::table('app_timesheet')
            ->orderByDesc('id')
            ->where('user_id', $user_id)
            ->limit(31)
            ->get();
        $stationId = DB::table('app_users')
            ->where('id' , $user_id)
            ->value('station');
        
        $stationLocation = DB::table('app_stations')
            ->where('id', $stationId)
            ->value('location');
            
        $stationLatitude = substr($stationLocation, 0, 9);
        $stationLongitude = substr($stationLocation, 10, 9);

        $timesheets = array();

        if ($getTimesheet->isNotEmpty()) {

            foreach ($getTimesheet as $row) {
                if ($month == substr($row->start, 5, 2)) {
                $timesheet["id"] = $row->id;
                $timesheet["user"] = $this->getUser($row->user_id);
                $timesheet["start"] = $row->start;
                $timesheet["end"] = $row->end;
                $timesheet["status"] = $row->status;
                

                    $userLatitude = substr($row->location, 0, 7);
                    $userLongitude = substr($row->location, 8, 7);

                    $inLoc = false;

                    if (
                        $userLatitude > $stationLatitude - 0.0012 &&
                        $userLatitude < $stationLatitude + 0.0012
                    ) {
                        if (
                            $userLongitude > $stationLongitude - 0.0012 &&
                            $userLongitude < $stationLongitude + 0.0012
                        ) {
                            $inLoc = true;
                        }
                    }                
                $timesheet["location"] = $inLoc;
                
                $timesheets[] = $timesheet;
                }
            }

            return $message = array(
                'status' => '1',
                'message' => 'Timesheet is returned',
                'data' => array_reverse($timesheets)
            );
        } else {
            return $message = array(
                'status' => '2',
                'message' => 'Timesheet for this user is Empty',
                'data' => []
            );
        }
    }

    public function getUserTimeSheet()
    {

        $month = jdate()->format('m');
        $data = array();

        $stations = DB::table('app_stations')
            ->get();

        foreach ($stations as $station) {

            $users = DB::table('app_users')
                ->where('station', $station->id)
                ->get();

            $userList = array();

            foreach ($users as $user) {

                $getTimeSheet = DB::table('app_timesheet')
                    ->orderByDesc('id')
                    ->where('user_id', $user->id)
                    ->limit(31)
                    ->get();

                $total = 0;
                if ($getTimeSheet->isNotEmpty()) {

                    if ($month == substr($getTimeSheet[0]->start, 5, 2)) {

                        $last_timesheet["id"] = $getTimeSheet[0]->id;
                        $last_timesheet["user"] = $this->getUser($getTimeSheet[0]->user_id);
                        $last_timesheet["start"] = $getTimeSheet[0]->start;
                        $last_timesheet["end"] = $getTimeSheet[0]->end;
                        $last_timesheet["status"] = $getTimeSheet[0]->status;

                    } else {
                        $last_timesheet = null;
                    }

                    foreach ($getTimeSheet as $row) {

                        if ($month == substr($row->start, 5, 2)) {
                            $start = new DateTime($row->start);
                            $end = new DateTime(($row->end != 0) ? $row->end : $row->start);
                            $result = $end->diff($start);

                            $total += $result->d * 24;
                            $total += $result->h;
                            $total += $result->i/60;
                        }
                        $userList[$user->id] = [
                            'last_timesheet' => $last_timesheet,
                            'total' => round($total,1)
                        ];
                    }
                }
            }
            $data[$station->id] = $userList;
        }

        return $message = array(
            'status' => '1',
            'message' => 'Timesheet is returned',
            'data' => $data
        );
        // else {
        //     return $message = array(
        //         'status' => '2',
        //         'message' => 'Timesheet for this user is Empty',
        //         'data' => []
        //     );
        // }
    }
}
