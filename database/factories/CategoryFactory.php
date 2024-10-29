<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            "Electronics",
            "Fashion and Accessories",
            "Home and Decor",
            "Books",
            "Sports and Leisure",
            "Beauty and Personal Care",
            "Toys and Games",
            "Food and Beverages",
            "Tools and Construction",
            "Health and Wellness"
        ];

        return [
            'name' => fake()->unique()->randomElement($categories),
            'description' => fake()->paragraph(),
        ];
    }
}
