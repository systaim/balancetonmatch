<?php

namespace App\Http\Resources;

use App\Models\Commentaire;
use App\Models\Statistic;
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
        // dd(Statistic::where('action', 'goal')->get());
        // $stat = Statistic::where('action', 'goal')->where('rencontre_id', $this->id);
        
        return [
            'id' =>$this->id,
            'live' =>$this->live,
            'home_team' =>$this->homeClub,
            'home_score' =>$this->home_score,
            'away_team' => $this->awayClub,
            'away_score' =>$this->away_score,
            'date_match' =>$this->date_match,
            'location' =>$this->location,
            'competition' =>$this->competition,
            'region' =>$this->region,
            'department' =>$this->department,
            'division_region' =>$this->divisionRegion,
            'division_department' =>$this->divisionDepartment,
            'group' =>$this->group,
            'comments' =>CommentaireResource::collection($this->commentaires),
            // 'comments' =>$this->commentaires,
        ];
    }
}
