<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (['Suki ni Braulio', 'Budget Meal', 'Halal', 'Open 24 Hours', 'Aircon', 'Live Music'] as $name) {
            \App\Models\Feature::create(compact('name'));
        }
    }
}
