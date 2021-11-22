<?php

namespace Database\Seeders;

use App\Models\Club;
use App\Models\Competition;
use App\Models\Department;
use Illuminate\Database\Seeder;
use App\Models\Region;
use App\Models\Player;
use App\Models\Rencontre;
use App\Models\Division;
use App\Models\DivisionsDepartment;
use App\Models\Group;
use App\Models\DivisionsRegion;
use App\Models\Journee;
use App\Models\Reaction;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

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
            $slug = Str::slug($division, '-');
            DivisionsRegion::create([
                'slug' => $slug,
                'name' => $division,
            ]);
        }

        //tables nom de groupes
        for ($i = 65; $i <= 90; $i++) {
            Group::create([
                'name' => 'Groupe ' . chr($i),
            ]);
        }

        // // tables players numéros génériques

        // for ($i = 1; $i <= 16; $i++) {
        //     $slug = Str::slug('numero ' . $i, '-');
        //     Player::create([
        //         'slug' => $slug,
        //         'last_name' => $i,
        //         'first_name' => 'numéro',

        //     ]);
        // }

        // // tables journees

        // for ($i = 1; $i <= 30; $i++) {
        //     Journee::create([
        //         'name' => $i,
        //     ]);
        // }


        //tables noms de régions
        $regions = ['Auvergne - Rhones-Alpes', 'Bourgogne - Franche Comté', 'Bretagne', 'Centre Val de Loire', 'Corse', 'Grand Est', 'Guadeloupe', 'Guyane', 'Hauts de France', 'Martinique', 'Mayotte', 'Mediterrannée', 'Normandie', 'Nouvelle Aquitaine', 'Occitanie', 'Paris IDF', 'Pays de la Loire', 'Réunion', 'St Pierre & Miquelon'];

        foreach ($regions as $region) {
            $slug = Str::slug($region, '-');

            Region::create([
                'slug' => $slug,
                'name' => $region,
            ]);
        }
        // envoi des départements
        DB::unprepared(file_get_contents('database/seeders/departments.sql'));

        //liste des clubs
        // DB::unprepared(file_get_contents('database/seeders/clubs.sql'));

        //nom de compétitions
        $competitions = ['Championnat régional', 'Championnat départemental', 'Coupe de France', 'Coupe régionale', 'Coupe départementale', 'Match amical'];

        foreach ($competitions as $competition) {
            $slug = Str::slug($competition, '-');
            Competition::create([
                'slug' => $slug,
                'name' => $competition,
            ]);
        }

        //table nom division par départements
        $districts = ['Division 1', 'Division 2', 'Division 3', 'Division 4', 'Division 5'];

        foreach ($districts as $district) {
            $slug = Str::slug($district, '-');

            DivisionsDepartment::create([
                'slug' => $slug,
                'name' => $district,

            ]);
        }

        $reactions = ['ok', 'heart', 'applause'];

        foreach ($reactions as $reaction) {
            Reaction::create([
                'type' => $reaction,
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
