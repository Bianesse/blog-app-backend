<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comment::insert([
            ['post_id' => 1, 'author' => '1', 'comment' => 'This is a comment for the first post.'],
            ['post_id' => 1, 'author' => '2','comment' => 'Another comment for the first post.'],
            ['post_id' => 2, 'author' => '3','comment' => 'Comment for the second post.'],
            ['post_id' => 3, 'author' => '2','comment' => 'Comment for the third post.'],
            ['post_id' => 3, 'author' => '3','comment' => 'third post.'],
        ]);
    }
}
