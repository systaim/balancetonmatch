<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Commentaire extends JsonResource
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
            'type_action' => $this->type_action,
            'type_comments' => $this->type_comments,
            'comments' => $this->comments,
            'team_action' => $this->team_action,
            'minute' => $this->minute,
            'images' => $this->images,
        ];
    }
}
