<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fiche extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $table = 'fiches';

    protected $primaryKey = 'fiche_id';
    public $fillable = [
        'raison_sociale',
        'nom_compte',
        'code_client',
        'code_sous_client',
    ];


    public function contacts()
    {
        return $this->hasMany(Contact::class,'fiche_id');
    }

    public function gerantContact()
    {
        return $this->contacts()->where('fonction', 'gerant');
    }
    protected $casts = [];

    public static array $rules = [];
}
