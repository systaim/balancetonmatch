<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MatchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'live' =>$this->live,
            'home_team_id' =>$this->home_team_id,
            'home_score' =>$this->home_score,
            'away_team_id' =>$this->away_team_id,
            'away_score' =>$this->away_score,
            'date_match' =>$this->date_match,
            'location' =>$this->location,
            'competition_id' =>$this->competition_id,
            'region_id' =>$this->region_id,
            'department_id' =>$this->department_id,
            'division_region_id' =>$this->division_region_id,
            'division_department_id' =>$this->division_department_id,
            'group_id' =>$this->group_id,
        ];
    }
}
