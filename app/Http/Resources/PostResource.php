<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $cRaw = $this->comments()->select('id','author','comment')->get();
        return 
        [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'author' => $this->users->name,
            'comments' => $cRaw->map(function ($comment) {
        return [
            'id' => $comment->id,
            'author' => $comment->users->name,
            'comment' => $comment->comment,
        ];
    }),
        ];
    }
}
