<?php

namespace App\Http\Controllers;

use App\Models\Locker;
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
                        return ' <button class="btn btn-sm btn-success addQrCode" data-locker-id="' . $q_locker->id . '">Tambah QR Code</button>';
                    }
                })
                ->rawColumns(['qrcode'])
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
        return 'Aktif';
    } else {
        return 'Tidak Aktif';
    }}
}
