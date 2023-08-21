<?php

use App\Http\Controllers\ApiControlController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ManualController;
use Illuminate\Cache\Lock;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Web Login
Route::get('login',[LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('login',[LoginController::class,'authenticate']);
Route::post('logout',[LoginController::class,'logout']);

//Web Content
Route::get("/", function () {return view('login');});
Route::resource('qrcode', QRCodeController::class)->middleware('auth');
Route::resource('pegawai', PegawaiController::class)->middleware('auth');
Route::resource('lockers', LockerController::class)->middleware('auth');
Route::resource('history', HistoryController::class)->middleware('auth');
Route::get('dashboard',[DashboardController::class, 'index'])->middleware('auth');
Route::get('controls', [ManualController::class,'index'] )->middleware('auth');
Route::post('controls/{id}', [ManualController::class,'update'] )->middleware('auth');
Route::patch('lockers/{id}/delete-akses-qrcode', [LockerController::class, 'deleteAkses'])->name('lockers.deleteAkses');
//Route::patch('/pegawai/{id}', [PegawaiController::class, 'update'])->name('pegawai.update');
Route::patch('lockers/{id}/add-akses-qrcode', [LockerController::class, 'addAkses'])->name('lockers.addAkses');
//Web API Alat
Route::get('api/get-status/loker/{id}', [ApiControlController::class,'getStatusLoker'] );
Route::get('api/check-qrcode/{payload}', [ApiControlController::class,'check_qrcode'] );
Route::get('api/end-session/{id}', [ApiControlController::class,'endsession'] );
Route::post('api/update-status/loker/{lockerNumber}',[ApiControlController::class,'updateStatusLoker']);
