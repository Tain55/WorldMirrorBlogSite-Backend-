<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blog;
use Illuminate\Support\Str;  

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         for ($i = 1; $i <= 10; $i++) {
            Blog::create([
                'title' => "Sample Blog Title $i",
                'content' => "This is the content of blog number $i.",
                'slug' => Str::slug("Sample Blog Title $i"),
                'image' => null,
                'is_published' => true,
                'user_id' => 1,        // user id যাকে assign করবে
                'category_id' => 1,    // category id
            ]);
        }
    }
}
