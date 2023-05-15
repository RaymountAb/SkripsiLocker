<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\MQrcode;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Yajra\DataTables\Facades\DataTables;

class QRCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = [
            'title'=> 'Tabel Qrcode',
            'page'=>'qrcode',
            'pegawai'=>Pegawai::all(),
        ];
        
        if ($request->ajax()) {
            //$q_qrcodes = Qrcode::select('*')->orderByDesc('pegawai');
            $q_qrcodes = MQrcode::join('m_pegawai', 'm_pegawai.id', 'm_qrcode.pegawai')
                ->select('m_qrcode.*', 'm_pegawai.nama as pegawai')
                ->get();
            return DataTables::of($q_qrcodes)
                ->addIndexColumn()
                ->addColumn('qrcode', function($q_qrcodes) {
                    return QrCode::size(150)->generate($q_qrcodes->qrcode);
                })
                ->rawColumns(['qrcode'])
                ->make(true);
        }
        return view('content.qrcode', $data);
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
    public function show(Qrcode $qrcode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Qrcode $qrcode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Qrcode $qrcode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Qrcode $qrcode)
    {
        //
    }
}
