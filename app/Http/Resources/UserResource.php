<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;





class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    // public static $wrap = "user";

    public function toArray($request)
    {
        return parent::toArray($request);

        // return [
        //     'data' => $this->collection,
        //     'links' => [
        //         'self' => 'link-value',
        //     ],
        // ];
    }
}
