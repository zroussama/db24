<?php

namespace App\Repositories;

use App\Models\Contact;
use App\Repositories\BaseRepository;

class ContactRepository extends BaseRepository
{
    protected $fieldSearchable = [

    ];
    public function search($query)
    {
        return Contact::where('fonction', 'like', "%{$query}%")
            ->orWhereHas('personne', function ($q) use ($query) {
                $q->where('firstName', 'like', "%{$query}%")
                    ->orWhere('lastName', 'like', "%{$query}%");
            })
            ->get(['fonction']);
    }
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Contact::class;
    }
}
