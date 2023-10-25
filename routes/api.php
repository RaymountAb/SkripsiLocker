<?php

use App\Http\Controllers\ApiMobileController;
use App\Http\Controllers\ApiControlController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiAuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(['prefix' => 'v1'], function () {
    Route::post('/login', [PegawaiAuthController::class, 'login']);
});

Route::middleware('auth:api')->group(function () {
    Route::get('/pegawai/profile/{userId}',[ApiMobileController::class,'profile']);
    Route::get('/pegawai/qrcode/{userId}',[ApiMobileController::class,'qrcode']);
    Route::get('/pegawai/history/{userId}',[ApiMobileController::class,'history']);
    Route::get('/pegawai/home/{userId}',[ApiMobileController::class,'home']);
    Route::post('/logout', [PegawaiAuthController::class, 'logout']);
});

//API Alat
Route::get('/get-status/loker/{id}', [ApiControlController::class,'getStatusLoker'] );
Route::get('/check-qrcode/{payload}', [ApiControlController::class,'check_qrcode'] );
Route::get('/end-session/{id}', [ApiControlController::class,'endsession'] );
Route::post('/update-status/loker/{lockerNumber}',[ApiControlController::class,'updateStatusLoker']);
Route::get('/addAkses/{userId}',[ApiMobileController::class,'addAkses']);
Route::get('/checkakses/{qrcode}',[ApiMobileController::class,'checkakses']);
