<?php

namespace Database\Seeders;

use App\Models\Club;
use App\Models\Competition;
use App\Models\Department;
use Illuminate\Database\Seeder;
use App\Models\Region;
use App\Models\Player;
use App\Models\Division;
use App\Models\DivisionsDepartment;
use App\Models\Group;
use App\Models\DivisionsRegion;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();

        //Table groupes régions
        $divisions = ['Régional 1', 'Régional 2', 'Régional 3'];

        foreach ($divisions as $division) {
            DivisionsRegion::create([
                'name' => $division,
            ]);
        }

        //tables nom de groupes
        for ($i = 65; $i <= 90; $i++) {
            Group::create([
                'name' => 'Groupe ' . chr($i),
            ]);
        }

        // tables players numéros génériques

        for ($i = 1; $i <= 16; $i++) {
            Player::create([
                'last_name' => $i,
                'first_name' => 'numéro',

            ]);
        }


        //tables noms de régions
        $regions = ['Auvergne - Rhones-Alpes', 'Bourgogne - Franche Comté', 'Bretagne', 'Centre Val de Loire', 'Corse', 'Grand Est', 'Guadeloupe', 'Guyane', 'Hauts de France', 'Martinique', 'Mayotte', 'Mediterrannée', 'Normandie', 'Nouvelle Aquitaine', 'Occitanie', 'Paris IDF', 'Pays de la Loire', 'Réunion', 'St Pierre & Miquelon'];

        foreach ($regions as $region) {
            Region::create([
                'name' => $region,
            ]);
        }

        DB::unprepared(file_get_contents('database/seeders/departments.sql'));
        DB::unprepared(file_get_contents('database/seeders/clubs.sql'));

        //nom de compétitions
        $competitions = ['Championnat régional', 'Championnat départemental', 'coupe de France', 'Coupe régionale', 'Coupe départementale', 'Match amical'];

        foreach ($competitions as $competition) {
            Region::create([
                'name' => $competition,
            ]);
        }

        //table nom division par départements
        $districts = ['Division 1', 'Division 2', 'Division 3', 'Division 4', 'Division 5'];

        foreach ($districts as $district) {
            DivisionsDepartment::create([
                'name' => $district,

            ]);
        }
        // }

        //table nom de competitions
        $competitions = ['Championnat régional', 'Championnat départemental', 'Coupe de France', 'Coupe régionale', 'Coupe départementale'];

        foreach ($competitions as $competition) {
            Competition::create([
                'name' => $competition,
                'season' => '2020/2021'
            ]);
        }

        Schema::enableForeignKeyConstraints();



        // $users = \App\Models\User::factory()->count(10)->create();
        // $players = \App\Models\Player::factory()->count(100)->create();
    }
}
