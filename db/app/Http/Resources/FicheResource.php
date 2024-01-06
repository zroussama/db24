<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FicheResource extends JsonResource
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
            'fiche_id' => $this->fiche_id,
            'gerant' => new ContactResource($this->whenLoaded('contacts')->firstWhere('fonction', 'gerant')),
            'raison_sociale' => $this->raison_sociale,
            'nom_compte	' => $this->nom_compte,
            'code_client' => $this->code_client,
            'code_sous_client' => $this->code_sous_client,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
