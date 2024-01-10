<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fiche extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'fiches';

    protected $primaryKey = 'fiche_id';


    public $fillable = [
        'raison_social',
        'nom_compte',
        'gerant_nom',
        'gerant_prenom',
        'gerant_tel',
        'gerant_mail',
        'gerant_genre',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($contact) {
            $contact->fonction = 'gerant';
        });
    }
    protected $casts = [];

    public static array $rules = [];

    public function contact()
    {
        return $this->hasMany(Contact::class,'contact_id','contact_id');
    }
    public function gerantContact()
    {
        return $this->hasOne(Contact::class,'fiche_id','fiche_id');
    }
}
