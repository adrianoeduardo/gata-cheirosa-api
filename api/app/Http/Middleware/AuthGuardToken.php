<?php

namespace App\Http\Middleware;

use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Facades\JWTAuth;

use Closure;

class AuthGuardToken extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try{
            $user = JWTAuth::parseToken()->authenticate();
            
        }
        catch(\Execption $e){
            if($e instanceof Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(["error"=>"Token Inválido"]);
            }
            elseif($e instanceof Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(["error"=>"Token Expirado"]);
            }
            elseif($e instanceof Tymon\JWTAuth\Exceptions\JWTException){
                return response()->json(["error"=>"Token Não Informado"]);
            }
            else{
                return response()->json(["error"=>"Token Não Encontrado"]);
            }
        }
        return $next($request);
    }
}
