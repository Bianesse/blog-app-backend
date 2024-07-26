<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request){
        $headers = [
            'Content-Type' => 'application/json',
        ];
        $parameter = 
        [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $client = new Client();
        $url = "http://blog-app.test/api/login";
        $respond = $client->post($url, [
            'headers' => $headers,
            'json' => $parameter,
        ]);
        $content = $respond->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['user'];
        return redirect()->route('home')->with('success','Successfully Login');
    }

    public function logout(Request $request){
        $token = $request->bearerToken();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorizaton' => 'Bearer '. $token
        ];
        $client = new Client();
        $url = "http://blog-app.test/api/logout";
        $respond = $client->post($url, [
            "headers" => $headers
        ]);
        return redirect()->route('/login')->with('success','Successfully Logout');
    }
}
