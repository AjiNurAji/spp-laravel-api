<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        $user = User::where('username', $request->username)->where('password', $request->password)->first();
        
        if($user === null) {
            return response()->json([
                'message' => 'Tidak bisa menemukan data!, mungkin ada yang salah silahkan cek kembali!'
            ], 422);
        
        }
        $token = Auth::login($user);
        
        return $this->respondWithToken($token);
    }
}
