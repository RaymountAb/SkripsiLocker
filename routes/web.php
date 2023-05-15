<?php
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

Route::get('dashboard', function () {
    return view('content.dashboard');
});
Route::get('controls', function () {
    return view('content.controls');
})->middleware('auth');
Route::resource('qrcode', QRCodeController::class)->middleware('auth');
Route::resource('pegawai', PegawaiController::class)->middleware('auth');
Route::resource('lockers', LockerController::class)->middleware('auth');
Route::resource('history', HistoryController::class)->middleware('auth');