<?php

namespace App\Repositories;

use App\Models\Personne;
use App\Repositories\BaseRepository;

class PersonneRepository extends BaseRepository
{
    protected $fieldSearchable = [
        
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Personne::class;
    }
}
