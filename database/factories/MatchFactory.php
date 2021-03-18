<?php

namespace Database\Factories;

use App\Models\Club;
use App\Models\Competition;
use App\Models\Department;
use App\Models\DivisionsDepartment;
use App\Models\DivisionsRegion;
use App\Models\Group;
use App\Models\Match;
use App\Models\Region;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class MatchFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Match::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::all()->pluck('id');
        $clubs = Club::all()->pluck('id');
        // $regions = Region::all()->pluck('id');
        $competitions = Competition::all()->pluck('name');
        // dd($competitions);
        if($competitions == "Championnat régional"){
            $districts = null;
            $dDepartment = null;
            $dRegions = DivisionsRegion::all()->pluck('id');
            $regions = Region::all()->pluck('id');
            $groups = Group::all()->pluck('id');
        }
        if($competitions == "Championnat départemental"){
            $districts = Department::all()->pluck('id');
            $dDepartment = DivisionsDepartment::all()->pluck('id');
            $dRegions = null;
            $regions = Region::all()->pluck('id');
            $groups = Group::all()->pluck('id');
        }
        if($competitions == "Coupe de France"){
            $districts = null;
            $dDepartment = null;
            $dRegions = null;
            $regions = Region::all()->pluck('id');
            $groups = null;
        }
        if($competitions == "Coupe régionale"){
            $districts = null;
            $dDepartment = null;
            $dRegions = null;
            $regions = Region::all()->pluck('id');
            $groups = null;
        }
        if($competitions == "Coupe départementale"){
            $districts = Department::all()->pluck('id');
            $dDepartment = null;
            $dRegions = null;
            $regions = Region::all()->pluck('id');
            $groups = null;
        }
        if($competitions == "Match amical"){
            $districts = null;
            $dDepartment = null;
            $dRegions = null;
            $regions = Region::all()->pluck('id');
            $groups = null;
        }

        return [
            'home_team_id' => $this->faker->randomElement($clubs),
            'away_team_id' => $this->faker->randomElement($clubs),
            'date_match' => $this->faker->dateTimeBetween($startDate = 'now', $endDate = "+1 year"),
            'competition_id' => $this->faker->randomElement($competitions),
            'region_id' => $this->faker->randomElement($regions),
            'department_id' => $this->faker->randomElement($districts),
            'division_region_id' => $this->faker->randomElement($dRegions),
            'division_department_id' => $this->faker->randomElement($dDepartment),
            'group_id' => $this->faker->randomElement($groups),
            'user_id' =>$this->faker->randomElement($users),
        ];
    }
}
