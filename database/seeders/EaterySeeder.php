<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Eatery;
use App\Models\Feature;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EaterySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districts = District::pluck('id', 'name');
        $features = Feature::pluck('id', 'name');

        $handmade = Eatery::create([
            'district_id' => $districts['Poblacion'],
            'name' => 'Carinderia ni Braulio',
            'slug' => Str::slug('Carinderia ni Braulio'),
            'address' => 'San Pedro St., Poblacion, Davao City',
            'price_range' => 'budget',
            'specialty' => 'Tinolang Manok',
            'is_open' => true,
        ]);

        $handmade->dishes()->createMany([
            ['name' => 'Tinolang Manok', 'price' => 85.00, 'is_bestseller' => true],
            ['name' => 'Kinilaw na Tuna', 'price' => 120.00, 'is_bestseller' => false],
            ['name' => 'Durian Shake', 'price' => 75.00, 'is_bestseller' => false],
        ]);

        $handmade->features()->sync([
            $features['Suki ni Braulio'],
            $features['Budget Meal'],
        ]);

        $handmade->permit()->create([
            'permit_no' => 'DVO-2026-0624',
            'expires_on' => '2027-06-24',
        ]);

        foreach (range(1, 14) as $index) {
            $name = 'Davao Table ' . $index;

            $eatery = Eatery::create([
                'district_id' => $districts->values()->random(),
                'name' => $name,
                'slug' => Str::slug($name),
                'address' => fake()->streetAddress(),
                'price_range' => fake()->randomElement(['budget', 'mid', 'splurge']),
                'specialty' => fake()->randomElement([
                    'Grilled favorites',
                    'Home-style meals',
                    'Davao comfort food',
                ]),
                'is_open' => $index > 3,
            ]);

            foreach (range(1, fake()->numberBetween(2, 5)) as $dishNumber) {
                $eatery->dishes()->create([
                    'name' => fake()->randomElement([
                        'Adobo', 'Pancit', 'Grilled chicken', 'Sinuglaw', 'Tinola',
                    ]),
                    'price' => fake()->randomFloat(2, 60, 350),
                    'is_bestseller' => fake()->boolean(25),
                ]);
            }

            $eatery->features()->attach(
                $features->random(fake()->numberBetween(1, 3))->values()
            );

            $eatery->permit()->create([
                'permit_no' => 'DVO-2026-' . str_pad((string) ($index + 624), 4, '0', STR_PAD_LEFT),
                'expires_on' => $index === 1
                    ? '2025-01-01'
                    : fake()->dateTimeBetween('now', '+2 years')->format('Y-m-d'),
            ]);
        }
    }
}
