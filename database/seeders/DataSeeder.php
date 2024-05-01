<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Data;

class DataSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Data::factory()->count(20)->create();

    }
}
