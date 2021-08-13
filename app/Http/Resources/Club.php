<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Club extends JsonResource
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
            'abbreviation' => $this->abbreviation,
            'nom' => $this->name,
            'background' => $this->bg_path,
            'color1' => $this->primary_color,
            'color2' => $this->secondary_color,
            'nbrEquipes' => $this->number_teams,
            'adress' => $this->adress,
            'CP' => $this->zip_code,
            'city' => $this->city,
        ];
    }
}