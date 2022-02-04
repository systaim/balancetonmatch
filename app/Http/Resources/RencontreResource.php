<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RencontreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' =>$this->id,
            'live' =>$this->live,
            'home_team' =>$this->homeClub,
            'home_score' =>$this->home_score,
            'away_team' => $this->awayClub,
            'away_score' =>$this->away_score,
            'date_match' =>$this->date_match,
            'location' =>$this->location,
            'competition_id' =>$this->competition,
            'region' =>$this->region,
            'department' =>$this->department,
            'division_region' =>$this->division_region,
            'division_department' =>$this->division_department,
            'group' =>$this->group,
        ];
    }
}
