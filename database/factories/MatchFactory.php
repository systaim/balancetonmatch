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
        // $competition_id = Competition::all();

        
        // dd($competitions);
        if($competition_id == 1){
            $districts = null;
            $dDepartment = null;
            $dRegions = DivisionsRegion::all()->pluck('id');
            $regions = Region::all()->pluck('id');
            $groups = Group::all()->pluck('id');
        }
        if($competition_id == 2){
            $districts = Department::all()->pluck('id');
            $dDepartment = DivisionsDepartment::all()->pluck('id');
            $dRegions = null;
            $regions = Region::all()->pluck('id');
            $groups = Group::all()->pluck('id');
        }
        if($competition_id == 3){
            $districts = null;
            $dDepartment = null;
            $dRegions = null;
            $regions = null;
            $groups = null;
        }
        if($competition_id == 4){
            $districts = null;
            $dDepartment = null;
            $dRegions = null;
            $regions = Region::all()->pluck('id');
            $groups = null;
        }
        if($competition_id == 5){
            $districts = Department::all()->pluck('id');
            $dDepartment = null;
            $dRegions = null;
            $regions = Region::all()->pluck('id');
            $groups = null;
        }
        if($competition_id == 6){
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
            'competition_id' => $this->faker->randomElement($competition_id),
            'region_id' => isset($regions) ? $this->faker->randomElement($regions) : null,
            'department_id' => isset($districts) ? $this->faker->randomElement($districts) : null,
            'division_region_id' => isset($dRegions) ? $this->faker->randomElement($dRegions) : null,
            'division_department_id' => isset($dDepartment) ? $this->faker->randomElement($dDepartment) : null,
            'group_id' => isset($groups) ? $this->faker->randomElement($groups) : null,
            'user_id' =>$this->faker->randomElement($users),
        ];
    }
}
