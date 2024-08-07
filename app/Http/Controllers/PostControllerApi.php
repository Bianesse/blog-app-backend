<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Post::with(['users' , 'comments'])->get();//->findOrFail(2);
        return PostResource::collection($query);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'     => 'required',
            'author'     => 'required', 
            'content'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $post = Post::create([
            'title'     => $request->title,
            'author'     => $request->author,
            'content'   => $request->content,
        ]);

        return response()->json($post);
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title'     => 'required',
            'content'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $post = Post::find($id);
        $post->update([
            'title'     => $request->title,
            'content'   => $request->content,
        ]);

        return response()->json($post);
    }

    public function destroy($id)
    {
        try
        {
            Post::findOrFail($id)->delete();
            return response()->json([
                'message' => 'Post deleted successfully.',
            ], 200);

        }catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Post not found.',
            ], 404);
        }
    }

    public function commentInsert(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'comment'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $post = Comment::create([
            'post_id' => $id,
            'author' => auth()->user()->id,
            'comment'   => $request->comment,
        ]);

        return response()->json($post);
    }
}
