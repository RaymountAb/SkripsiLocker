<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Locker;
use App\Models\Pegawai;
use App\Models\RekapPenggunaan;
use App\Models\Result;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $jmlhpegawai = Pegawai::count();
        $jmlhlocker = Locker::count();
        $jmlhkosong = Locker::whereNull('qrcode')->count();
        $today = Carbon::today()->toDateString();
        $penggunaanharian = RekapPenggunaan::where('date', $today)->count();

        //$lockerUsages = RekapPenggunaan::orderBy('created_at', 'desc')->take(4)->get();
        $lockerUsages = DB::table('rekap_penggunaan')
            ->join('m_pegawai', 'rekap_penggunaan.pegawai','=','m_pegawai.id')
            ->select('m_pegawai.nama as pegawai','rekap_penggunaan.waktu')
            ->orderBy('rekap_penggunaan.created_at', 'desc')
            ->take(4)
            ->get();

        $labels = $lockerUsages->pluck('pegawai');
        $data = $lockerUsages->pluck('waktu');

        //$locker1 = History::orderBy('created_at', 'desc')->where('loker', 1)->take(1)->get();
        $locker1 = DB::table('loghistory')
            ->select('m_pegawai.nama  as pegawai','m_locker.name_loker as loker', 'date', 'time', 'activity')
            ->join('m_pegawai', 'loghistory.pegawai','=','m_pegawai.id')
            ->join('m_locker', 'loghistory.loker','=','m_locker.id')
            ->where('loker', 1)
            ->orderBy('loghistory.created_at', 'desc')
            ->take(1)
            ->get();

        $locker2 = DB::table('loghistory')
            ->select('m_pegawai.nama  as pegawai','m_locker.name_loker as loker', 'date', 'time', 'activity')
            ->join('m_pegawai', 'loghistory.pegawai','=','m_pegawai.id')
            ->join('m_locker', 'loghistory.loker','=','m_locker.id')
            ->where('loker', 2)
            ->orderBy('loghistory.created_at', 'desc')
            ->take(1)
            ->get();

        $locker3 = DB::table('loghistory')
            ->select('m_pegawai.nama  as pegawai','m_locker.name_loker as loker', 'date', 'time', 'activity')
            ->join('m_pegawai', 'loghistory.pegawai','=','m_pegawai.id')
            ->join('m_locker', 'loghistory.loker','=','m_locker.id')
            ->where('loker', 3)
            ->orderBy('loghistory.created_at', 'desc')
            ->take(1)
            ->get();

        $locker4 = DB::table('loghistory')
            ->select('m_pegawai.nama  as pegawai','m_locker.name_loker as loker', 'date', 'time', 'activity')
            ->join('m_pegawai', 'loghistory.pegawai','=','m_pegawai.id')
            ->join('m_locker', 'loghistory.loker','=','m_locker.id')
            ->where('loker', 4)
            ->orderBy('loghistory.created_at', 'desc')
            ->take(1)
            ->get();
        return view('content.dashboard',['jmlhpegawai'=>$jmlhpegawai,'jmlhlocker'=>$jmlhlocker,'jmlhkosong'=>$jmlhkosong,'penggunaanharian'=>$penggunaanharian, 'data' => $data, 'labels' => $labels, 'locker1' => $locker1, 'locker2' => $locker2, 'locker3' => $locker3, 'locker4' => $locker4]);
    }
}
