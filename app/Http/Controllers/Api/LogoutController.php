<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //menghapus token
        $removeToken = JWTAuth::invalidate(JWTAuth::getToken());
        //mengembalikan response apabila berhasil
        if ($removeToken) {
            return response()->json([
                'success' => true,
                'message' => 'Logout Berhasil!'
            ]);
        }


    }
}
