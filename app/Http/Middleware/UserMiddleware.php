<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $jwt =$request->bearerToken(); //ambil token
    
            $decoded =JWT::decode($jwt,new Key(env('JWT_SECRET_KEY'),'HS256'));
    
            // kondisi jika role pada token adalah admin,maka lanjut proses selanjutnya
            if($decoded->role =='user'){
                return $next($request);
    
            } else{
                //jika bukan role admin
                return response()->json("unauthorized",401);
            }

        }
            catch (ExpiredException $e){
                return response()->json($e->getMessage(),400);
            }
    }
}
