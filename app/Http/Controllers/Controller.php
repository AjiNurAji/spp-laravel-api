<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => Auth::factory()->getTTL() * 60 * 24
        ], 200);
    }

    public function me()
    {
        return response()->json(Auth::user());
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'message' => 'Berhasil logout'
        ]);
    }
}
