<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $states = [
            "Bahia",
            "Minas Gerais",
            "Mato Grosso do Sul",
            "Pernambuco",
            "Rio Grande do Sul",
            "Rio Grande do Norte",
            "Rio de Janeiro",
            "São Paulo",
            "Sergipe",
        ];

        return [
            'street' => fake()->streetName(),
            'number' => fake()->numberBetween(100, 999),
            'city' => fake()->city(),
            'state' => fake()->randomElement($states),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
