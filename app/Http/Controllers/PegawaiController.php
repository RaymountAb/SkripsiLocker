<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\PegawaiDetail;
use App\Models\MQrcode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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
            'title' => 'Tabel Pegawai',
            'page' => 'pegawai',
            'pegawai' => Pegawai::all(),
        ];

        if ($request->ajax()) {
            $q_pegawaidetail = PegawaiDetail::join('m_pegawai', 'm_pegawai.id', 'm_pegawaidetail.pegawai')
                ->select('m_pegawaidetail.*', 'm_pegawai.nama as pegawai_nama', 'm_pegawai.nip as pegawai_nip')
                ->get();
            return DataTables::of($q_pegawaidetail)
                ->addIndexColumn()
                ->addColumn('jenis_kelamin', function ($data) {
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
                'username' => 'required|string|unique:m_pegawai,username',
                'nip' => 'required|integer',
                'password' => 'required',
                'nama' => [
                    'required',
                    'string',
                    Rule::unique('m_pegawai', 'nama')->ignore($request->id),
                ],
                'jenis_kelamin' => 'required', // Pastikan kolom ini sesuai dengan model PegawaiDetail
                'no_hp' => 'required', // Pastikan kolom ini sesuai dengan model PegawaiDetail
                'alamat' => 'required', // Pastikan kolom ini sesuai dengan model PegawaiDetail
            ],
            [
                'username.required' => 'Username tidak boleh kosong',
                'username.string' => 'Username harus berupa string',
                'username.unique' => 'Username sudah ada',
                'nip.required' => 'NIP tidak boleh kosong',
                'nip.integer' => 'NIP harus berupa angka',
                'password.required' => 'Password tidak boleh kosong',
                'nama.required' => 'Nama tidak boleh kosong',
                'nama.string' => 'Nama harus berupa string',
                'nama.unique' => 'Nama sudah ada',
                'jenis_kelamin.required' => 'Jenis kelamin tidak boleh kosong',
                'no_hp.required' => 'Nomor HP tidak boleh kosong',
                'alamat.required' => 'Alamat tidak boleh kosong',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }

        try {
            $uuid = Uuid::uuid4()->toString();

            $pegawai = new Pegawai();
            $pegawai->username = $request->input('username');
            $pegawai->nip = $request->input('nip');
            $pegawai->nama = $request->input('nama');
            $pegawai->password = Hash::make($request->input('password'));
            $pegawai->save();

            $qrcode = new MQrcode();
            $qrcode->pegawai = $pegawai->id;
            $qrcode->qrcode = $uuid;
            $qrcode->save();

            $pegawaidetail = new PegawaiDetail();
            $pegawaidetail->pegawai = $pegawai->id;
            $pegawaidetail->jenis_kelamin = $request->input('jenis_kelamin');
            $pegawaidetail->no_hp = $request->input('no_hp');
            $pegawaidetail->alamat = $request->input('alamat');
            $pegawaidetail->save();

            return response()->json(["message" => "Pegawai berhasil ditambahkan"], 200);
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 500);
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
        $pegawais = Pegawai::find($id);
        $pegawaidetails = PegawaiDetail::where('pegawai', $id)->first();
        $data = [
            'pegawai' => $pegawais,
            'pegawaidetail' => $pegawaidetails
        ];
        return response()->json($data);
    }

    public function update(Request $request, $pegawai)
    {
        try {
            // Validasi request data
            $validator = Validator::make($request->all(), [
                'editusername' => 'required|string',
                'editnip' => 'required|integer',
                'editnama' => 'required|string',
                'editjenis_kelamin' => 'required',
                'editno_hp' => 'required',
                'editalamat' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(["message" => $validator->errors()->first()], 422);
            }

            $pegawais = Pegawai::find($pegawai);
            $pegawaidetails = PegawaiDetail::where('pegawai', $pegawai)->first();

            if (!$pegawais || !$pegawaidetails) {
                return response()->json(["message" => "Pegawai tidak ditemukan"], 404);
            }

            // Update data pegawai
            $pegawais->update([
                'username' => $request->editusername,
                'nip' => $request->editnip,
                'nama' => $request->editnama,
            ]);

            // Update detail pegawai
            $pegawaidetails->update([
                'jenis_kelamin' => $request->editjenis_kelamin,
                'no_hp' => $request->editno_hp,
                'alamat' => $request->editalamat,
            ]);

            return response()->json(["message" => "Pegawai berhasil diperbarui"], 200);
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pegawais = Pegawai::find($id);
        try {
            $pegawais->delete();
            $pegawaidetails = PegawaiDetail::where('pegawai', $id)->get();
            $pegawaidetails->delete();
            $qrcodes = MQrcode::where('pegawai', $id)->get();
            $qrcodes->delete();
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
        }
    }
}
