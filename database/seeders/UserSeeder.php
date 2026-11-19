<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create(['name' => 'Alessandra Veronica Braulio', 'email' => 'braulio@kaonta.test', 'password' => 'kaonta2026']);
        \App\Models\User::factory()->create(['name' => 'Tita Braulio', 'email' => 'tita.braulio@kaonta.test', 'password' => 'kaonta2026']);
        \App\Models\User::factory(10)->create();
    }
}
