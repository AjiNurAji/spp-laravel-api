<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:siswa', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        $user = Siswa::where('nisn', $request->nisn)->where('nis', $request->nis)->first();
        
        if($user === null) {
            return response()->json([
                'message' => 'Tidak bisa menemukan data!, mungkin ada yang salah silahkan cek kembali!'
            ], 422);
        }

        $token = Auth::guard('siswa')->login($user);

        return $this->respondWithToken($token);
    }
}
