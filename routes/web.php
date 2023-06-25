<?php

use App\Http\Controllers\ApiControlController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\PegawaiController;
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
Route::get('login',[LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('login',[LoginController::class,'authenticate']);
Route::post('logout',[LoginController::class,'logout']);
//Route::get('controls', function () {return view('content.controls');})->middleware('auth');
Route::resource('qrcode', QRCodeController::class)->middleware('auth');
Route::resource('pegawai', PegawaiController::class)->middleware('auth');
Route::resource('lockers', LockerController::class)->middleware('auth');
Route::resource('history', HistoryController::class)->middleware('auth');
Route::get('dashboard',[DashboardController::class, 'index'])->middleware('auth');

Route::get('controls', [ApiControlController::class,'index'] )->middleware('auth');
Route::post('controls/{id}', [ApiControlController::class,'update'] )->middleware('auth');
//Route::get('get-status/loker1/kode1',[ApiControlController::class, 'Loker1']);
//Route::get('kirim-status/loker1/{id}/{status}',[ApiControlController::class, 'kirim_Loker1']);