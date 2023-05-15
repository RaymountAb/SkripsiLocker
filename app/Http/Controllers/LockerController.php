<?php

namespace App\Http\Controllers;

use App\Models\Locker;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Qrcode;
use Illuminate\Http\Request;

class LockerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = [
            'title' => 'Tabel Locker',
            'page' => 'locker',
        ];

        if ($request->ajax()) {
            $q_locker = Locker::select('*')->orderByDesc('id');
            return Datatables::of($q_locker)
                ->addIndexColumn()
                ->addColumn('status', function($data) {
                    return $this->getStatus($data->status);
                })
                ->addColumn('action', function ($row) {
                    $btn = '    <div class="btn-group " role="group" aria-label="Toolbar with button groups">
                        <div  data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="btn btn-warning btn-sm edit editLocker" data-toggle="modal"><i class="fa fa-edit"></i> Edit</div> ';


                    $btn = $btn . '  <div data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-sm btn-danger deleteLocker"><i class="fa fa-trash"></i> Hapus</div> </div>';

                    return $btn;
                })
                ->rawColumns(['action'])
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
