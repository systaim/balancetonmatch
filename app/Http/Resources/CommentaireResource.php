<?php

namespace App\Http\Resources;

use App\Models\Commentaire;
use App\Models\Statistic;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentaireResource extends JsonResource
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
            'match' => $this->match,
            'type_action' => $this->type_action,
            'type_comments' => $this->type_comments,
            'comments' => $this->comments,
            'team_action' => $this->team_action,
            'minute' => $this->minute,
            'images' => $this->images,
            'buteur' => $this->buteur,
            'icon' => $this->icon
        ];
    }
}
