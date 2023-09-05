<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Locker;
use App\Models\MQrcode;
use App\Models\Pegawai;
use App\Models\RekapPenggunaan;
use Yajra\DataTables\Facades\DataTables;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;

class LockerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = [
            'title' => 'Tabel Loker',
            'page' => 'locker',
            'pegawai'=> Pegawai::all(),
            'qrcode' => MQrcode::all(),
        ];
        if ($request->ajax()) {
            $q_locker = Locker::select('*')->orderBy('id');
            return Datatables::of($q_locker)
                ->addIndexColumn()
                ->addColumn('status', function($data) {
                    return $this->getStatus($data->status);
                })
                ->addColumn('qrcode', function($q_locker) {
                    if ($q_locker->qrcode) {
                        return QrCode::size(150)->generate($q_locker->qrcode);
                    } else {
                        return '<button data-toggle="tooltip" data-id="' . $q_locker->id . '" data-original-title="Tambah" class="btn btn-sm btn-success addAksesLocker"> Tambah QR Code </button>';
                    }
                })
                ->addColumn('action', function($q_locker){
                    $btn = '<button data-toggle="tooltip" data-id="' . $q_locker->id . '" data-original-title="Delete" class="btn btn-sm btn-danger deleteLocker"> Hapus </button>';
                    return $btn;
                })
                ->rawColumns(['qrcode', 'action'])
                ->make(true);
        }
        return view('content.lockers', $data);
    }

    public function getStatus($status)
    {
    if ($status == 1) {
        return 'Buka';
    } else {
        return 'Tutup';
    }}

    public function deleteAkses($id)
    {
        try {
            $locker = Locker::findOrFail($id);
            $pegawai = MQrcode::where('qrcode', $locker->qrcode)->first();

            History::create([
                'date' => date('Y-m-d'),
                'time' => date('H:i:s'),
                'loker' => $locker->id,
                'pegawai' => $pegawai->pegawai,
                'activity' => '3'
            ]);

            $locker->update([
                'qrcode' => null,
            ]);

            $activity1 = History::where('pegawai', $pegawai->pegawai)
                ->where('loker',$locker->id)
                ->where('activity', '1')
                ->orderBy('id', 'desc')
                ->first();

            $activity2 = History::where('pegawai', $pegawai->pegawai)
                ->where('loker',$locker->id)
                ->where('activity', '3')
                ->orderBy('id', 'desc')
                ->first();

                $time1 = \Carbon\Carbon::createFromFormat('H:i:s', $activity1->time);
                $time3 = \Carbon\Carbon::createFromFormat('H:i:s', $activity2->time);
                $waktupenggunaan = $time1->diffInMinutes($time3);

            RekapPenggunaan::create([
                'pegawai' => $pegawai->pegawai,
                'loker' => $locker->id,
                'waktu' => $waktupenggunaan,
                'date' => date('Y-m-d'),
            ]);

            return response()->json(['message' => 'Akses berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan menghapus akses', 'error' => $e->getMessage()], 500);
        }
    }


    public function addAkses(Request $request)
    {
        try {
            $lockerId = $request->lockerId;
            $pegawaiId = $request->pegawaiId;

            $locker = Locker::findOrFail($lockerId);
            $qrcode = MQrcode::where('pegawai', $pegawaiId)->first();

            if (!$qrcode) {
                return response()->json(['message' => 'QR Code tidak ditemukan'], 404);
            }

            History::create([
                'date' => date('Y-m-d'),
                'time' => date('H:i:s'),
                'loker' => $locker->id,
                'pegawai' => $pegawaiId,
                'activity' => '1'
            ]);

            $locker->update([
                'qrcode' => $qrcode->qrcode,
            ]);

            return response()->json(['message' => 'Akses berhasil ditambahkan'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan menambahkan akses', 'error' => $e->getMessage()], 500);
        }
    }


}
