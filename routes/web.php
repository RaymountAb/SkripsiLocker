<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ManualController;
use App\Http\Controllers\RekapController;

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

// Web Login
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate']);
});

Route::post('logout', [LoginController::class, 'logout']);

// Web Content
Route::get("/", function () {
    return view('login');
});

Route::middleware('auth')->group(function () {
    Route::resource('qrcode', QRCodeController::class);
    Route::resource('pegawai', PegawaiController::class);
    Route::resource('lockers', LockerController::class);
    Route::resource('history', HistoryController::class);
    Route::resource('activity', RekapController::class);

    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::get('controls', [ManualController::class, 'index']);
    Route::post('controls/{id}', [ManualController::class, 'update']);
    Route::patch('lockers/{id}/delete-akses-qrcode', [LockerController::class, 'deleteAkses'])->name('lockers.deleteAkses');
    Route::post('lockers/addAkses', [LockerController::class, 'addAkses'])->name('lockers.addAkses');
});

