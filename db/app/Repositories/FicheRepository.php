<?php

namespace App\Repositories;

use App\Models\Fiche;
use App\Repositories\BaseRepository;

class FicheRepository extends BaseRepository
{
    protected $fieldSearchable = [

    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Fiche::class;
    }
}
