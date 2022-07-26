<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ShiftEndController;
use App\Http\Controllers\Api\ShiftStartController;
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
    Route::post('login', [LoginController::class,'login']);
    Route::post('last_shift', [ShiftStartController::class,'lastShift']);
    Route::post('start_shift', [ShiftStartController::class,'start']);
    Route::post('contradiction', [ShiftStartController::class,'contradiction']);
    Route::post('end_shift', [ShiftEndController::class,'end']);
});

