<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (['Poblacion', 'Talomo', 'Agdao', 'Buhangin', 'Toril', 'Bunawan'] as $name) {
            \App\Models\District::create(compact('name'));
        }
    }
}
