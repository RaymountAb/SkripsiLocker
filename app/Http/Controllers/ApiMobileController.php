<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Locker;
use App\Models\MQrcode;
use App\Models\Pegawai;
use App\Models\PegawaiDetail;
use Illuminate\Http\Request;

class ApiMobileController extends Controller
{
    public function profile($userId)
    {
        $pegawaidata = Pegawai::where('id', $userId)->get();
        $pegawaiprofile = PegawaiDetail::where('pegawai', $userId)->get();

        return response()->json([
            'pegawai' => $pegawaidata,
            'pegawaidetail' => $pegawaiprofile
        ], 200);
    }

    public function qrcode($userId)
    {
        $qrcodepegawai = MQrcode::where('pegawai', $userId)->get();

        return response()->json([
            'qrcode' => $qrcodepegawai
        ], 200);
    }

    public function home($userId)
    {
        $qrcodedata = MQrcode::where('pegawai', $userId)->first();

        $lokerAkses = null;

        if ($qrcodedata) {
            $lokerAkses = Locker::where('qrcode', $qrcodedata->qrcode)->first();
        }
        $history = History::where('pegawai', $userId)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
        $response = [];

        if ($lokerAkses) {
            $response['locker'] = $lokerAkses;
        }
        if (!$history->isEmpty()) {
            $response['histories'] = $history;
        } else {
            $response['message'] = 'Data tidak ditemukan';
        }

        return response()->json($response, 200);
    }

    public function addAkses($userId)
    {
        $locker = Locker::whereNull('qrcode')->inRandomOrder()->first();
        if ($locker) {
            $qrcodedata = MQrcode::where('pegawai', $userId)->first();
            return response()->json([
                'qrcode' => $qrcodedata->qrcode,
                'status' => 'success',
                'message' => 'Berhasil mendapatkan loker kosong',
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Tidak ada loker yang tersedia'
            ]);
        }
    }

}
