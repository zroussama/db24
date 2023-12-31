<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
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

            'idContact' => $this->contact_id,

            'personne' => new PersonneResource($this->whenLoaded('personne')),
            'fonction' => $this->fonction,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
