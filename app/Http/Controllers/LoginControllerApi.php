<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class LoginControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required',
            'password'  => 'required'
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 422);
        }

        //get credentials from request
        $credentials = $request->only('email', 'password');

        //if auth failed
        if(!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau Password Anda salah'
            ], 401);
        }

        $cookie = cookie('jwt' ,$token, 60);
        $request->headers->set('Authorization', "Bearer " . $token);

        /* return response()->json([
            'success' => true,
            'user'    => auth()->guard('api')->user(),    
            'token'   => $token
        ], 200)->withCookie($cookie); */
        return $this->newToken($token);
    }

    public function newToken($token){
        return response()->json([
            'success' => true,
            'user'    => auth()->user(),    
            'token'   => $token,
            'token_type'   => 'bearer',
        ], 200);
    }

    public function regis(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email'     => 'required',
            'password'  => 'required',
            'role'  => 'required',
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 422);
        }

        $user = User::create([
            'name'     => $request->name,
            'email'     => $request->email,
            'password'   => Hash::make($request->password),
            'role'  => $request->role,
        ]);
        return response()->json(['message' => 'Successfully created an account']);
    }

    public function logout(){
        /* try {
            $cookie = cookie('jwt' , NULL);
            return response()->json(['message' => 'Successfully logged out'])->withCookie($cookie);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not log out'], 500);
        } */
       
        try {
            // Parse the token from the request
            $token = JWTAuth::parseToken();
            
            // Invalidate the token
            $token->invalidate();
            
            return response()->json(['message' => 'Successfully logged out']);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not log out'], 500);
        }
    }

}
