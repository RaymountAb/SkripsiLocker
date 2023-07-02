<?php

namespace App\Http\Controllers;

use App\Models\Locker;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $jmlhpegawai = Pegawai::count();
        $jmlhlocker = Locker::count();
        $qrcodeResult = $request->input('qrcode_result');
        return view('content.dashboard',['jmlhpegawai'=>$jmlhpegawai,'jmlhlocker'=>$jmlhlocker,'qrcodeResult'=>$qrcodeResult]);
    }
}
