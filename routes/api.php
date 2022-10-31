<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AppController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ShiftEndController;
use App\Http\Controllers\Api\ShiftStartController;
use App\Http\Controllers\Api\SupervisorController;
use App\Http\Controllers\Api\OperatorController;
use App\Http\Controllers\Api\UserController;
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
    Route::get('app_info', [AppController::class,'appInfo']);
    Route::post('login', [LoginController::class,'login']);
    Route::post('station_operators', [AppController::class,'StationOperators']);
    Route::post('add_user', [UserController::class,'addUser']);
    Route::post('add_station', [AdminController::class,'addStation']);
    Route::get('all_user', [UserController::class,'allUser']);
    Route::post('user_verify', [UserController::class,'userVerify']);
    Route::post('shift_data', [ShiftStartController::class,'ShiftData']);
    Route::post('start_shift', [ShiftStartController::class,'start']);
    Route::post('contradiction', [ShiftStartController::class,'contradiction']);
    Route::post('end_shift', [ShiftEndController::class,'end']);
    Route::post('all_shift_data', [AdminController::class,'allShiftData']);
    Route::post('supervisor_shift_data', [SupervisorController::class,'supervisorShiftData']);
    Route::post('supervisor_report', [SupervisorController::class,'SupervisorReport']);
    Route::post('operator_shift_data', [OperatorController::class,'operatorShiftData']);
    Route::post('timesheet', [UserController::class,'Timesheet']);
    Route::post('get_timesheet', [UserController::class,'getTimesheet']);

});

