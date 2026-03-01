<?php

namespace Database\Seeders;

use App\Models\Sites;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first cours d'appuie
        $coursdappuie = DB::table('coursdappuies')->first();

        $sites = [
            [
                'nom' => 'Ouagadougou',
                'localisation' => 'Kadiogo',
                'idCoursDappuie' => $coursdappuie->id ?? null,
            ],
            [
                'nom' => 'Bobo-Dioulasso',
                'localisation' => 'Houet',
                'idCoursDappuie' => $coursdappuie->id ?? null,
            ],
            [
                'nom' => 'Koudougou',
                'localisation' => 'Boulkiemdé',
                'idCoursDappuie' => $coursdappuie->id ?? null,
            ],
        ];

        foreach ($sites as $site) {
            if ($site['idCoursDappuie']) {
                Sites::create($site);
            }
        }
    }
}
