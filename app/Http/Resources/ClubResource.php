<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClubResource extends JsonResource
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
            'id' => $this->id,
            'abbreviation' => $this->abbreviation,
            'name' => $this->name,
            'bg_path' => $this->bg_path,
            'color1' => $this->primary_color,
            'color2' => $this->secondary_color,
            'nbrEquipes' => $this->number_teams,
            'adress' => $this->adress,
            'CP' => $this->zip_code,
            'city' => $this->city,
            'players' => $this->players,
            'region' => $this->region,
            'department' => $this->department
        ];
    }
}
