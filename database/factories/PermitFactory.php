<?php

namespace Database\Factories;

use App\Models\Permit;
use App\Models\Eatery;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Permit>
 */
class PermitFactory extends Factory
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
            'permit_no' => 'DVO-' . fake()->unique()->numerify('####-#####'),
            'expires_on' => fake()->dateTimeBetween('now', '+2 years')->format('Y-m-d'),
        ];
    }
}
