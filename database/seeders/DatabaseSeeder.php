<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@example.com'
        ]);

        $categories = [
            'Tech',
            'Science',
            'Health',
            'Cars',
            'Politics',
            'Cars'
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }

        //Post::factory(100)->create();
    }
}
