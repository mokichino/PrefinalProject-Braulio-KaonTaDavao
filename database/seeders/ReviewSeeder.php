<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eatery = \App\Models\Eatery::where('slug', 'carinderia-ni-braulio')->firstOrFail();
        $tita = \App\Models\User::where('email', 'tita.braulio@kaonta.test')->firstOrFail();
        $alessandra = \App\Models\User::where('email', 'braulio@kaonta.test')->firstOrFail();
        $eatery->reviews()->createMany([
            ['user_id' => $tita->id, 'rating' => 5, 'body' => 'Lami kaayo! Balik-balikan ni Tita Braulio.'],
            ['user_id' => $alessandra->id, 'rating' => 5, 'body' => 'Comfort food that tastes like home.'],
            ['user_id' => \App\Models\User::whereNotIn('id', [$tita->id, $alessandra->id])->first()->id, 'rating' => 4, 'body' => 'Sulit and warm service.'],
        ]);
        foreach (\App\Models\Eatery::where('is_open', true)->whereKeyNot($eatery->id)->get() as $openEatery) {
            foreach (range(1, fake()->numberBetween(0, 6)) as $reviewNumber) {
                $openEatery->reviews()->create(['user_id' => \App\Models\User::inRandomOrder()->first()->id, 'rating' => fake()->numberBetween(1, 5), 'body' => fake()->sentence(12)]);
            }
        }
    }
}
