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
    public function webShow(Request $request)
    {
        $token = $request->cookie('jwt');
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

    public function create(Request $request)
    {
        $token = $request->header("Authorization");
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

    public function edit(string $id)
    {
        $data = Post::findOrFail($id);
        return view('formEdit', ['placeholder' => $data])->with("success","");
    }

    public function update(Request $request)
    {
        $token = $request->header("Authorization");
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
        $respond = $client->put($url, [
            'headers' => $headers,
            'json' => $parameter,
        ]);
        return redirect()->route('home')->with('success','Successfully Edited data');
    }

    public function destroy(Request $request, string $id)
    {
        $token = $request->header("Authorization");
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];
        $client = new Client();
        $url = "http://blog-app.test/api/post/delete/$id";
        $respond = $client->delete($url, [
            'headers' => $headers,
        ]);
        return redirect()->back()->with('success','Successfully deleted data');
    }

    public function commentInsert(Request $request)
    {
        $token = $request->header("Authorization");
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];
        $parameter = 
        [
            //'post_id' => $request->id,
            //'author' => auth()->user()->id,
            'comment' => $request->comment,
        ];
        $client = new Client();
        $url = "http://blog-app.test/api/comment/insert/$request->id";
        $respond = $client->post($url, [
            'headers' => $headers,
            'json' => $parameter,
        ]);
        return redirect()->back()->with('success','Successfully inputed data');
    }
}
