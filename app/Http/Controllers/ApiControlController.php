<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Locker;
use App\Models\MQrcode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class ApiControlController extends Controller
{
    public function getStatusLoker1($id)
    {
        /*$locker = Locker::findOrFail($id);
        return response()->json([
            'status' => $locker->status,
        ]);*/
        $data = Locker::where('id', $id)->first()->status;
        return $data;
    }

    public function getStatusLoker2($id)
    {
        /*$locker = Locker::findOrFail($id);
        return response()->json([
            'status' => $locker->status,
        ]);*/
        $data = Locker::where('id', $id)->first()->status;
        return $data;
    }

    public function getStatusLoker3($id)
    {
        /*$locker = Locker::findOrFail($id);
        return response()->json([
            'status' => $locker->status,
        ]);*/
        $data = Locker::where('id', $id)->first()->status;
        return $data;
    }

    public function getStatusLoker4($id)
    {
        /*$locker = Locker::findOrFail($id);
        return response()->json([
            'status' => $locker->status,
        ]);*/
        $data = Locker::where('id', $id)->first()->status;
        return $data;
    }

    /*public function send_qrcode(Request $request)
    {
        $qrCodeResult = $request->input('payload');

        $locker = Locker::where('qrcode', $qrCodeResult)->first();

        if ($locker){
            Locker::where('id', $locker->id)->update([
                'status' => '1'
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Loker berhasil dibuka'
            ]);
        } else{
            return response()->json([
                'status' => 'failed',
                'message' => 'QR Code tidak ditemukan'
            ]);
        }
    }*/

    /*public function check_qrcode(Request $request){

        $qrcode = $request->input('payload');

        //Cek apakah qrcode sudah terdaftar di database
        $qrcodes = MQrcode::where('qrcode', $qrcode)->first();

        if($qrcodes){
            //Ada Pegawai dengan qrcode tersebut
            $locker = Locker::where('qrcode', $qrcode)->first();

            if ($locker){
                //Ada loker dengan qrcode tersebut
                DB::beginTransaction();

                try{
                    Locker::where('id', $locker->id)->update([
                        'status' => '1'
                    ]);

                    $history = History::create([
                        'date' => date('Y-m-d'),
                        'time' => date('H:i:s'),
                        'loker' => $locker->id,
                        'pegawai' => $qrcodes->pegawai,
                        'activity' => '2'
                    ]);

                    $newqrcode = Uuid::uuid4()->toString();
                    $qrcodes->update(['qrcode' => $newqrcode]);

                    DB::commit();

                    return response()->json([
                        'status' => 'success',
                        'message' => 'Loker berhasil dibuka'
                    ]);
                }catch(\Exception $e){
                    DB::rollback();
                    return response()->json([
                        'status' => 'failed',
                        'message' => 'Terjadi kesalahan saat membuka Loker'
                    ]);
                }
            } else {
                // Loker dengan QR Code tidak ditemukan
                return response()->json([
                    'status' => 'failed',
                    'message' => 'QR Code tidak valid'
                ]);
            }            
        } else{
            //Tidak ada loker dengan qrcode tersebut
            $locker = Locker::whereNull('qrcode')->inRandomOrder()->first();
            if($locker){
                $locker->update(['qrcode' => $qrcode]);
                History::create([
                    'date' => date('Y-m-d'),
                    'time' => date('H:i:s'),
                    'loker' => $locker->id,
                    'pegawai' => $qrcodes->pegawai,
                    'activity' => '1'
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Qr Code berhasil ditambahkan pada loker yang tidak memiliki QR Code'
                ]);
            }else{
                return response()->json([
                    'status' => 'failed',
                    'message' => 'QR Code tidak ditemukan dan tidak ada loker yang tidak memiliki QR Code'
                ]);
            }
        }
    }*/

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
                    $qrcodeData->update(['qrcode' => $newqrcode]);
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
        $pegawais = MQrcode::find($id);
        if($pegawais){
            //cari loker yang sedang digunakan oleh pegawai
            $locker = Locker::where('qrcode', $pegawais->qrcode)->first();

            if($locker){
                //Mengosongkan qrcode pada loker
                $locker->update(['qrcode' => null]);

                History::create([
                    'date' => date('Y-m-d'),
                    'time' => date('H:i:s'),
                    'loker' => $locker->id,
                    'pegawai' => $pegawais->pegawai,
                    'activity' => '3'
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Sesi berhasil diakhiri'
                ]);
            }else{
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Sesi gagal diakhiri'
                ],404);
            }
        }
    }
    
}
