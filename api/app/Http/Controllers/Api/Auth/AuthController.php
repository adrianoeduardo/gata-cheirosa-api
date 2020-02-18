<?php

namespace App\Http\Controllers\Api\Auth;
 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $credencial = $request->only('vc_login', 'vc_senha');

        $credentials['vc_login']=$credencial['vc_login'];
        $credentials['password']=$credencial['vc_senha'];
        $credentials['ch_excluido']='0';

        if ($token = $this->guard('api')->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard('api')->factory()->getTTL() * 60*24
        ]);
    }
    public function guard()
    {
        return Auth::guard();
    }

}
