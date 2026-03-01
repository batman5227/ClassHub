<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed the cours d'appuie first, then sites
        $this->call([
            CoursdappuieSeeder::class,
            SitesSeeder::class,
        ]);
    }
}
