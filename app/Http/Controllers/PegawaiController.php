<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\PegawaiDetail;
use App\Models\MQrcode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use Yajra\DataTables\Facades\DataTables;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = [
            'title'=> 'Tabel Pegawai',
            'page'=>'pegawai',
            'pegawai'=>Pegawai::all(),
        ];
        
        if ($request->ajax()) {
            $q_pegawaidetail = PegawaiDetail::join('m_pegawai', 'm_pegawai.id', 'm_pegawaidetail.pegawai')
                ->select('m_pegawaidetail.*', 'm_pegawai.nama as pegawai_nama', 'm_pegawai.nip as pegawai_nip')
                ->get();
            return DataTables::of($q_pegawaidetail)
                ->addIndexColumn()
                ->addColumn('jenis_kelamin', function($data) {
                    return $this->getJK($data->jenis_kelamin);
                })
                ->addColumn('action', function ($row) {
                    $btn = '    <div class="btn-group " role="group" aria-label="Toolbar with button groups">
                        <div  data-toggle="tooltip"  data-id="' . $row->pegawai . '" data-original-title="Edit" class="btn btn-warning btn-sm edit editPegawai" data-toggle="modal"><i class="fa fa-edit"></i> Edit</div> ';
                    $btn = $btn . '  <div data-toggle="tooltip"  data-id="' . $row->pegawai . '" data-original-title="Delete" class="btn btn-sm btn-danger deletePegawai"><i class="fa fa-trash"></i> Delete</div> </div>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('content.pegawai', $data);
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
        $validator = Validator::make(
            $request->all(),
            [
                'nip' => 'required|integer',
                'password'=>'required',
                'nama'=>'required|string|unique:m_pegawai,nama'.$request->id,
            ],[
                'nip.required'=>'NIP tidak boleh kosong',
                'nip.integer'=>'NIP harus berupa angka',
                'password.required'=>'Password tidak boleh kosong',
                'nama.required'=>'Nama tidak boleh kosong',
                'nama.string'=>'Nama harus berupa string',
                'name.unique'=>'Nama sudah ada'
            ]
        );
        if($validator->fails()){
            return response()->json(['message'=>$validator->errors()->first()]);
        }else{
            try{
                $uuid = Uuid::uuid4()->toString();

                $pegawai = new Pegawai();
                $pegawai->nip = $request->input('nip');
                $pegawai->nama=$request->input('nama');
                $pegawai->password=Hash::make($request->input('password'));
                $pegawai->save();

                $qrcode = new MQrcode();
                $qrcode->pegawai=$pegawai->id;
                $qrcode->qrcode= $uuid;
                $qrcode->save();

                $pegawaidetail = new PegawaiDetail();
                $pegawaidetail->pegawai=$pegawai->id;
                $pegawaidetail->jenis_kelamin = $request->input('jenis_kelamin');
                $pegawaidetail->no_hp = $request->input('no_hp');
                $pegawaidetail->alamat = $request->input('alamat');
                $pegawaidetail->save();
                
                return response()->json(["message" => "Pegawai berhasil diperbarui"]);
            }catch(\Exception $e){
                return response()->json(["message" => $e->getMessage()]);
            }
        }
        
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
    public function edit($id)
    {
        $Pegawaidetail = PegawaiDetail::find($id);
        return response()->json($Pegawaidetail);
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
    public function destroy($pegawai)
    {
        $pegawais = Pegawai::find($pegawai); 

        try {
            $pegawaidetails = PegawaiDetail::where('pegawai', $pegawai)->get();
            $pegawaidetails->delete();
            $qrcodes = MQrcode::where('pegawai', $pegawai)->get();
            $qrcodes->delete();
            $pegawais->delete();
            return response()->json(["message" => "Data berhasil dihapus!"]);
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()]);
        }
    }

    public function getJK($jenis_kelamin)
    {
    if ($jenis_kelamin == 1) {
        return 'Laki-laki';
    } else {
        return 'Perempuan';
    }}
}
