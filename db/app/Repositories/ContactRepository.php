<?php

namespace App\Repositories;

use App\Models\Contact;
use App\Repositories\BaseRepository;

class ContactRepository extends BaseRepository
{
    protected $fieldSearchable = [
        
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Contact::class;
    }
}
