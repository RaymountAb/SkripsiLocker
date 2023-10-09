<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class PegawaiAuthController extends Controller
{
    public function login(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required',
        ]);

        // If validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Check and auth process
        $pegawai = Pegawai::where('username', $request->username)->first();

        if (!$pegawai || !Hash::check($request->password, $pegawai->password)) {
            return response()->json(['message' => 'Username atau password salah'], 401);
        }

        $token = $pegawai->createToken('auth_token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'pegawai' => [
                'id' => $pegawai->id,
                'nama' => $pegawai->nama,
            ]
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logout berhasil'], 200);
    }
}
