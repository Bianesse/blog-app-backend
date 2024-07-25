<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::insert([
            ["title" => "1st Post", "content" => "This is the content of the 1st Post", "author" => "1"],
            ["title" => "2nd Post", "content" => "This is the content of the 2nd Post", "author" => "2"],
            ["title" => "3rd Post", "content" => "This is the content of the 3rd Post", "author" => "3"],
        ]);
    }
}
