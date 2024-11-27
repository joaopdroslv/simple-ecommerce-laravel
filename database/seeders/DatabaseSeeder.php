<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(50)->create();
        Category::factory(10)->create();
        Product::factory(500)->create();
        Review::factory(1000)->create();
        Address::factory(50)->create();

        /* User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */
    }
}
