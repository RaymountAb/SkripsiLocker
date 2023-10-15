<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Locker;
use App\Models\MQrcode;
use App\Models\RekapPenggunaan;
use Carbon\Carbon;
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
        // Menggunakan $payload sebagai nilai default jika 'payload' tidak ada di input
        $qrcode = $request->input('payload', $payload);

        // Mencari data QR Code di tabel MQrcode
        $qrcodeData = MQrcode::where('qrcode', $qrcode)->first();

        if (!$qrcodeData) {
            return response()->json([
                'status' => 'failed',
                'message' => 'QR Code tidak ditemukan'
            ]);
        }

        // Transaksi database dimulai
        DB::beginTransaction();

        try {
            // Cari locker berdasarkan QR Code
            $locker = Locker::where('qrcode', $qrcode)->first();

            if ($locker) {
                // Generate QR Code baru
                $newQrcode = Uuid::uuid4()->toString();
                $qrcodeData->update(['qrcode' => $newQrcode]);

                // Perbarui status locker
                $locker->updateOrFail([
                    'status' => '1',
                    'qrcode' => $newQrcode
                ]);

                // Buat entri riwayat
                $historyEntry = [
                    'date' => now()->toDateString(),
                    'time' => now()->toTimeString(),
                    'loker' => $locker->id,
                    'pegawai' => $qrcodeData->pegawai,
                    'activity' => '2',
                ];

                History::create($historyEntry);

                // Commit transaksi
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Loker berhasil dibuka'
                ]);
            } else {
                // Cari locker yang belum digunakan secara acak
                $locker = Locker::whereNull('qrcode')->inRandomOrder()->first();

                // Generate QR Code baru
                $newQrcode = Uuid::uuid4()->toString();
                $qrcodeData->update(['qrcode' => $newQrcode]);
                $locker->update(['qrcode' => $newQrcode]);

                // Buat entri riwayat
                $historyEntry = [
                    'date' => now()->toDateString(),
                    'time' => now()->toTimeString(),
                    'loker' => $locker->id,
                    'pegawai' => $qrcodeData->pegawai,
                    'activity' => '1',
                ];

                History::create($historyEntry);

                // Commit transaksi
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'QR Code berhasil ditambahkan ke ' . $locker->name_loker
                ]);
            }
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, rollback transaksi
            DB::rollback();
            return response()->json([
                'status' => 'failed',
                'message' => 'Terjadi kesalahan saat membuka Loker'
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
                $time1 = Carbon::createFromFormat('H:i:s', $activity1->time);
                $time2 = Carbon::createFromFormat('H:i:s', $activity2->time);
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
