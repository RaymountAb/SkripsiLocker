<?php

namespace App\Http\Controllers;

use App\Models\Locker;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jmlhpegawai = Pegawai::count();
        $jmlhlocker = Locker::count();
        return view('content.dashboard',['jmlhpegawai'=>$jmlhpegawai,'jmlhlocker'=>$jmlhlocker]);
    }
}
