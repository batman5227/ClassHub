<?php

namespace Database\Seeders;

use App\Models\Coursdappuie;
use Illuminate\Database\Seeder;

class CoursdappuieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coursdappuies = [
            [
                'nom' => 'Cours de Soutien',
            ],
            [
                'nom' => 'Cours Particuliers',
            ],
            [
                'nom' => 'Formation Professionnelle',
            ],
        ];

        foreach ($coursdappuies as $coursdappuie) {
            Coursdappuie::create($coursdappuie);
        }
    }
}
