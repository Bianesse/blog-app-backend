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
        $data = $contentArray['token'];

        $cookie = cookie('jwt', $data, 60);

        return redirect()->route('home')->with('success','Successfully Login')->withCookie($cookie);
    }

    public function logout(Request $request){
        $token = $request->cookie('jwt');
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '. $token
        ];
        $client = new Client();
        $url = "http://blog-app.test/api/logout";
        $respond = $client->post($url, [
            "headers" => $headers
        ]);
        $cookie = cookie('jwt' , NULL);
        return redirect()->route('login')->with('success','Successfully Logout')->withCookie($cookie);
    }
}
