<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AppController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ShiftEndController;
use App\Http\Controllers\Api\ShiftStartController;
use App\Http\Controllers\Api\SupervisorController;
use App\Http\Controllers\Api\OperatorController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Dev\DevController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace("Api")->prefix('')->group(function () {

    Route::get('app_info',          [AppController::class, 'appInfo']);
    Route::post('send_notification', [AppController::class, 'SendNotification']);
    Route::post('station_operators', [AppController::class, 'StationOperators']);

    Route::post('login',            [LoginController::class, 'login']);

    Route::get('all_user',         [UserController::class, 'allUser']);
    Route::get('get_timesheet',    [UserController::class, 'getTimesheet']);
    Route::post('add_user',         [UserController::class, 'addUser']);
    Route::post('user_verify',      [UserController::class, 'userVerify']);
    Route::post('add_timesheet',    [UserController::class, 'addTimesheet']);

    Route::post('add_station',      [AdminController::class, 'addStation']);
    Route::post('all_shift_data',   [AdminController::class, 'allShiftData']);

    Route::post('supervisor_shift_data', [SupervisorController::class, 'supervisorShiftData']);
    Route::post('supervisor_report',     [SupervisorController::class, 'SupervisorReport']);
    Route::post('unaccepted_report',     [SupervisorController::class, 'UnacceptedReport']);
    Route::post('accepted_report',     [SupervisorController::class, 'AcceptedReport']);

    Route::post('operator_report',     [OperatorController::class, 'OperatorReport']);
    Route::post('operator_shift_data', [OperatorController::class, 'operatorShiftData']);

    Route::post('employee_status',  [EmployeeController::class, 'EmployeeStatus']);

    Route::post('shift_data',       [ShiftStartController::class, 'ShiftData']);
    Route::post('start_shift',      [ShiftStartController::class, 'start']);

    Route::post('end_shift',        [ShiftEndController::class, 'end']);
    Route::post('failure_shift',        [ShiftEndController::class, 'FailureShift']);
});

Route::namespace("Dev")->prefix('')->group(function () {

    Route::get('change_date',                 [DevController::class, 'ChangeDate']);
    Route::get('id_changer',                 [DevController::class, 'IdChanger']);
    Route::get('id_report_changer',                 [DevController::class, 'IdReportChanger']);
    Route::get('serialize_operators',         [DevController::class, 'SerializeOperators']);
    Route::get('tranform_to_report_table',    [DevController::class, 'TranformToReportTable']);
    Route::get('tranform_to_timesheet_table', [DevController::class, 'TranformToTimesheetTable']);
});
