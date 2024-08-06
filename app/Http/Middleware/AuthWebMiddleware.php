<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;

class AuthWebMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$guard): Response
    {
        /* try {
            $token = JWTAuth::parseToken()->authenticate();
            if (!$token) {
                return redirect()->route("login")->with("status","User not found!");
            }
        } catch (JWTException $e) {
                return redirect()->route("login")->with("status","You haven't log in!");
        } */
        
        try{
            $jwtCookie = $request->cookie("jwt");
            if($jwtCookie == null) {
                return redirect()->route("login");
         }
        }catch (JWTException $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
        
        //INI PENTING BANGET JANGAN AMPE KELEWAT
        $request->headers->set('Authorization', "Bearer " . $jwtCookie);

        return $next($request);
    }
}
