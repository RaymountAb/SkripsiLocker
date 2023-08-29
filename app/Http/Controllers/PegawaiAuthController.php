<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Auth;


class PegawaiAutController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('nip', 'password');

        if (Auth::guard('pegawai')->attempt($credentials)) {
            $user = Auth::guard('pegawai')->user();
            $token = $user->createToken('pegawai-token')->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'user' => $user
            ]);
        } else {
            return response()->json([
                'message' => 'Invalid login credentials'
            ], 401);
        }
    }

}
