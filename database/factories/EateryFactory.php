<?php

namespace Database\Factories;

use App\Models\Eatery;
use App\Models\District;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Eatery>
 */
class EateryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'district_id' => District::factory(),
            'name' => fake()->unique()->company(),
            'slug' => fn (array $attributes) => str($attributes['name'])->slug(),
            'address' => fake()->streetAddress(),
            'price_range' => fake()->randomElement(['budget', 'mid', 'splurge']),
            'specialty' => fake()->randomElement(['Grilled favorites', 'Home-style meals', 'Davao comfort food']),
            'is_open' => true,
        ];
    }

    public function closed(): static
    {
        return $this->state(fn (array $attributes) => ['is_open' => false]);
    }
}
