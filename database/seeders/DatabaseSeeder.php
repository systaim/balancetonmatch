<?php

namespace Database\Seeders;

use App\Models\Club;
use App\Models\Competition;
use App\Models\Department;
use Illuminate\Database\Seeder;
use App\Models\Region;
use App\Models\Player;
use App\Models\Match;
use App\Models\Division;
use App\Models\DivisionsDepartment;
use App\Models\Group;
use App\Models\DivisionsRegion;
use App\Models\Role;
use App\Models\User;
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
        // envoi des départements
        DB::unprepared(file_get_contents('database/seeders/departments.sql'));
        
        //liste des clubs
        DB::unprepared(file_get_contents('database/seeders/clubs.sql'));

        //nom de compétitions
        $competitions = ['Championnat régional', 'Championnat départemental', 'Coupe de France', 'Coupe régionale', 'Coupe départementale', 'Match amical'];

        foreach ($competitions as $competition) {
            Competition::create([
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

        Schema::enableForeignKeyConstraints();

        $users = \App\Models\User::factory()->count(10)->create();
        $players = \App\Models\Player::factory()->count(100)->create();

        $competitions = Competition::all();
        $users = User::all()->pluck('id');
        $clubs = Club::all()->pluck('id');

        foreach($competitions as $competition){
            if($competition->id == 1){
                $districts = null;
                $dDepartment = null;
                $dRegions = DivisionsRegion::all()->pluck('id');
                $regions = Region::all()->pluck('id');
                $groups = Group::all()->pluck('id');
            }
            if($competition->id == 2){
                $districts = Department::all()->pluck('id');
                $dDepartment = DivisionsDepartment::all()->pluck('id');
                $dRegions = null;
                $regions = Region::all()->pluck('id');
                $groups = Group::all()->pluck('id');
            }
            if($competition->id == 3){
                $districts = null;
                $dDepartment = null;
                $dRegions = null;
                $regions = null;
                $groups = null;
            }
            if($competition->id == 4){
                $districts = null;
                $dDepartment = null;
                $dRegions = null;
                $regions = Region::all()->pluck('id');
                $groups = null;
            }
            if($competition->id == 5){
                $districts = Department::all()->pluck('id');
                $dDepartment = null;
                $dRegions = null;
                $regions = Region::all()->pluck('id');
                $groups = null;
            }
            if($competition->id == 6){
                $districts = null;
                $dDepartment = null;
                $dRegions = null;
                $regions = Region::all()->pluck('id');
                $groups = null;
            }

            Match::create([
                'home_team_id' => shuffle($this->clubs),
                'away_team_id' => shuffle($this->clubs),
                'date_match' => Carbon::now()->subDays(rand(1, 365)),
                'competition_id' => $this->competition->id,
                'region_id' => isset($this->regions) ? shuffle($this->regions) : null,
                'department_id' => isset($this->districts) ? shuffle($this->districts) : null,
                'division_region_id' => isset($this->dRegions) ? shuffle($this->dRegions) : null,
                'division_department_id' => isset($this->dDepartment) ? shuffle($this->dDepartment) : null,
                'group_id' => isset($this->groups) ? shuffle($this->groups) : null,
                'user_id' =>shuffle($this->users),
            ]);
        }

        
    }
}
