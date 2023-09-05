<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Locker;
use App\Models\Pegawai;
use App\Models\RekapPenggunaan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RekapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = [
            'title'=> 'Rekap Penggunaan',
            'page'=>'rekap',
            'loker'=>Locker::all(),
            'pegawai'=>Pegawai::all(),
        ];

        if ($request->ajax()) {
            $q_rekappenggunaan = RekapPenggunaan::join('m_locker','m_locker.id','rekap_penggunaan.loker')
                ->join('m_pegawai','m_pegawai.id','rekap_penggunaan.pegawai')
                ->select('rekap_penggunaan.*','m_locker.name_loker as loker','m_pegawai.nama as pegawai')
                ->orderBy('rekap_penggunaan.id', 'desc')
                ->get();
            return DataTables::of($q_rekappenggunaan)
                ->addIndexColumn()
                ->make(true);
        }
        return view('content.rekap', $data);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
