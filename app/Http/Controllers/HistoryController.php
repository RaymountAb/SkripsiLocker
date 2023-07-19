<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Locker;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = [
            'title'=> 'Log History',
            'page'=>'qrcode',
            'loker'=>Locker::all(),
            'pegawai'=>Pegawai::all(),
        ];

        if ($request->ajax()) {
            $q_history = History::join('m_locker','m_locker.id','loghistory.loker')
                ->join('m_pegawai','m_pegawai.id','loghistory.pegawai')
                ->select('loghistory.*','m_locker.name_loker as loker','m_pegawai.nama as pegawai')
                ->get();
            return DataTables::of($q_history)
                ->addIndexColumn()
                ->addColumn('activity', function($data) {
                    return $this->getActivity($data->activity);
                })
                ->make(true);
        }
        return view('content.history', $data);
    }

    public function getActivity($activity)
    {
    if ($activity == 1) {
        return 'Tambah Akses';
    } if ($activity == 2) {
        return 'Titip Barang';
    } else {
        return 'Akhiri Akses';
    }}
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
    public function show(History $history)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(History $history)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, History $history)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(History $history)
    {
        //
    }
}
