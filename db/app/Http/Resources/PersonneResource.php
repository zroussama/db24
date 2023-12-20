<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonneResource extends JsonResource
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
            'personne_id' => $this->personne_id,
            'firstName'=>$this->firstName,
            'lastName' => $this->lastname,
            'email' => $this->email,
            'genre'=>$this->genre,
            'phone'=>$this->phonenumber,
            'avatar'=>$this->avatar,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at'=> $this->deleted_at,
        ];
    }
}
