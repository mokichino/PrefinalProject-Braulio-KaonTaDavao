<?php

namespace Database\Factories;

use App\Models\Dish;
use App\Models\Eatery;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Dish>
 */
class DishFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'eatery_id' => Eatery::factory(),
            'name' => fake()->randomElement(['Adobo', 'Pancit', 'Grilled chicken', 'Sinuglaw', 'Tinola']),
            'price' => fake()->randomFloat(2, 60, 350),
            'is_bestseller' => fake()->boolean(25),
        ];
    }
}
