<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        Category::create(['category_name' => 'Tech']);
        Category::create(['category_name' => 'Lifestyle']);
        Category::create(['category_name' => 'Travel']);

        $this->call([
            BlogSeeder::class,
        ]);


        // User::factory(2)->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
