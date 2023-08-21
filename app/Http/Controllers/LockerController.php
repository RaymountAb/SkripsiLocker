<?php

namespace App\Http\Controllers;

use App\Models\Locker;
use App\Models\MQrcode;
use App\Models\Pegawai;
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Locker $locker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Locker $locker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Locker $locker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Locker $locker)
    {
        //
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
            $locker->update([
                'qrcode' => null,
            ]);

            return response()->json(['message' => 'Kolom diubah menjadi null dengan sukses'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat mengubah kolom', 'error' => $e->getMessage()], 500);
        }
    }

    public function addAkses(Request $request)
    {
        try {
            $lockerId = $request->lockerId;
            $pegawaiId = $request->pegawaiId;

            $locker = Locker::findOrFail($lockerId);
            $qrcode = MQrcode::where('pegawai', $pegawaiId)->first(); // Tambahkan tanda kurung pada 'first'

            if (!$qrcode) {
                return response()->json(['message' => 'QR Code tidak ditemukan'], 404);
            }

            $locker->update([
                'qrcode' => $qrcode->qrcode,
            ]);

            return response()->json(['message' => 'Kolom diubah menjadi null dengan sukses'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat mengubah kolom', 'error' => $e->getMessage()], 500);
        }
    }

}
