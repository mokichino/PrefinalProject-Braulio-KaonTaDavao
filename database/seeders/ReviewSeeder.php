<?php

namespace Database\Seeders;

use App\Models\Eatery;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eatery = Eatery::where('slug', 'carinderia-ni-braulio')->firstOrFail();
        $tita = User::where('email', 'tita.braulio@kaonta.test')->firstOrFail();
        $alessandra = User::where('email', 'braulio@kaonta.test')->firstOrFail();

        $eatery->reviews()->createMany([
            ['user_id' => $tita->id, 'rating' => 5, 'body' => 'Lami kaayo! Balik-balikan ni Tita Braulio.'],
            ['user_id' => $alessandra->id, 'rating' => 5, 'body' => 'Comfort food that tastes like home.'],
            ['user_id' => User::whereNotIn('id', [$tita->id, $alessandra->id])->firstOrFail()->id, 'rating' => 4, 'body' => 'Sulit and warm service.'],
        ]);

        foreach (Eatery::where('is_open', true)->whereKeyNot($eatery->id)->get() as $openEatery) {
            foreach (range(1, fake()->numberBetween(0, 6)) as $reviewNumber) {
                $openEatery->reviews()->create([
                    'user_id' => User::inRandomOrder()->firstOrFail()->id,
                    'rating' => fake()->numberBetween(1, 5),
                    'body' => fake()->sentence(12),
                ]);
            }
        }
    }
}
