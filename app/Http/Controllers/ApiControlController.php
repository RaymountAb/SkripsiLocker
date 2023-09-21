<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Locker;
use App\Models\MQrcode;
use App\Models\RekapPenggunaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class ApiControlController extends Controller
{
    public function getStatusLoker($id)
    {
        $data = Locker::where('id', $id)->first()->status;
        return $data;
    }

    public function updateStatusloker(Request $request, $lockerNumber)
    {
        $status = $request->input('status', 0);
        $locker = Locker::where('id', $lockerNumber)->firstOrFail();
        if ($locker) {
            $locker->update(['status' => $status]);
            /*$locker->status = $status;
            $locker->save();*/
            return response()->json([
                'status' => 'success',
                'message' => 'Status loker berhasil diupdate'
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Loker tidak ditemukan'
            ]);
        }
    }

    public function check_qrcode(Request $request, $payload)
    {
        $qrcode = $request->input('payload', $payload);
        // Cek apakah qrcode sudah terdaftar di database
        $qrcodeData = MQrcode::where('qrcode', $qrcode)->first();

        if ($qrcodeData) {
             // Ada Pegawai dengan qrcode tersebut
             $locker = Locker::where('qrcode', $qrcode)->first();
             if ($locker) {
                // Ada loker dengan qrcode tersebut
                DB::beginTransaction();
                try {

                    $newqrcode = Uuid::uuid4()->toString();
                    //$qrcodeData->update(['qrcode' => $newqrcode]);
                    $locker->update([
                        'status' => '1',
                        'qrcode' => $newqrcode
                    ]);

                    History::create([
                        'date' => date('Y-m-d'),
                        'time' => date('H:i:s'),
                        'loker' => $locker->id,
                        'pegawai' => $qrcodeData->pegawai,
                        'activity' => '2'
                    ]);


                    DB::commit();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Loker berhasil dibuka'
                    ]);
                } catch (\Exception $e) {
                    DB::rollback();
                    return response()->json([
                        'status' => 'failed',
                        'message' => 'Terjadi kesalahan saat membuka Loker'
                    ]);
                }
            } else {
                // Tidak ada loker dengan qrcode tersebut
                $locker = Locker::whereNull('qrcode')->inRandomOrder()->first();
                if ($locker) {
                    $locker->update(['qrcode' => $qrcode]);

                    History::create([
                        'date' => date('Y-m-d'),
                        'time' => date('H:i:s'),
                        'loker' => $locker->id,
                        'pegawai' => $qrcodeData->pegawai,
                        'activity' => '1'
                    ]);
                    return response()->json([
                        'status' => 'success',
                        'message' => 'QR Code berhasil ditambahkan pada loker yang tidak memiliki QR Code'
                    ]);
                } else {
                    return response()->json([
                        'status' => 'failed',
                        'message' => 'QR Code tidak ada loker yang tidak memiliki QR Code'
                    ]);
                }
            }
        } else {
            // Loker dengan QR Code tidak ditemukan
            return response()->json([
                'status' => 'failed',
                'message' => 'QR Code tidak ditemukan'
            ]);
        }
    }

    public function endsession($id)
    {
        // Temukan pegawai dengan ID yang diberikan
        $pegawai = MQrcode::where('pegawai', $id)->first();


        // Cari loker yang sedang digunakan oleh pegawai
        $locker = Locker::where('qrcode', $pegawai->qrcode)->first();

        if ($locker) {
            // Mengosongkan qrcode pada loker
            $locker->update(['qrcode' => null]);

            // Buat history
            History::create([
                'date' => now(),
                'time' => now()->format('H:i:s'),
                'loker' => $locker->id,
                'pegawai' => $pegawai->pegawai,
                'activity' => '3'
            ]);

            // Temukan history activity 1
            $activity1 = History::where('pegawai', $pegawai->pegawai)
                ->where('loker', $locker->id)
                ->where('activity', '1')
                ->orderBy('id', 'desc')
                ->first();

            // Temukan history activity 3
            $activity2 = History::where('pegawai', $pegawai->pegawai)
                ->where('loker', $locker->id)
                ->where('activity', '3')
                ->orderBy('id', 'desc')
                ->first();

            if ($activity1 && $activity2) {
                $time1 = \Carbon\Carbon::createFromFormat('H:i:s', $activity1->time);
                $time2 = \Carbon\Carbon::createFromFormat('H:i:s', $activity2->time);
                $waktupenggunaan = $time1->diffInMinutes($time2);

                // Buat rekap penggunaan
                RekapPenggunaan::create([
                    'pegawai' => $pegawai->pegawai,
                    'loker' => $locker->id,
                    'waktu' => $waktupenggunaan,
                    'date' => now(),
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Sesi berhasil diakhiri'
                ]);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Sesi gagal diakhiri'
                ], 404);
            }
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Loker tidak ditemukan'
            ], 404);
        }
    }
}
