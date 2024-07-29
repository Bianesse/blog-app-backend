<?php

namespace App\Http\Controllers;

use App\Models\Post;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    public function webShow(Request $request)
    {
        $token = $request->bearerToken();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];
        $client = new Client();
        $url = "http://blog-app.test/api/post";
        $respond = $client->get($url, [
            'headers' => $headers
        ]);
        $content = $respond->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];
        return view('welcome', ['postList' => $data])->with("success","");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $token = $request->bearerToken();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];
        $parameter = 
        [
            'title' => $request->title,
            'author' => $request->author,
            'content' => $request->content,
        ];
        $client = new Client();
        $url = "http://blog-app.test/api/post/insert";
        $respond = $client->post($url, [
            'headers' => $headers,
            'json' => $parameter,
        ]);
        return redirect()->back()->with('success','Successfully inputed data');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post, string $id)
    {
        $data = Post::findOrFail($id);
        return view('formEdit', ['placeholder' => $data])->with("success","");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $token = $request->bearerToken();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];
        $parameter = 
        [
            'title' => $request->title,
            'content' => $request->content,
        ];
        $client = new Client();
        $url = "http://blog-app.test/api/post/edit/$request->id";
        $respond = $client->post($url, [
            'headers' => $headers,
            'json' => $parameter,
        ]);
        return redirect()->route('home')->with('success','Successfully Edited data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, string $id)
    {
        $client = new Client();
        $url = "http://blog-app.test/api/post/delete/$id";
        $respond = $client->delete($url);
        return redirect()->back()->with('success','Successfully deleted data');
    }
}
