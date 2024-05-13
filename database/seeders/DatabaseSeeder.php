<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'ram@gmail.com',
            'password'=>bcrypt('ram@gmail.com'),
            'role'=>1
        ]);
        \App\Models\Category::factory(10)->create();
        \App\Models\Post::factory(100)->create();
    }
    
}
