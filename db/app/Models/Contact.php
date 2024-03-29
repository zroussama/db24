<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $primaryKey = 'contact_id';
    public $table = 'contacts';

    public function personne()
    {
        return $this->belongsTo(Personne::class,'personne_id');
        //return $this->belongsTo(Personne::class);
    }
    public function gerantFiche()
    {
        return $this->belongsTo(Fiche::class,'fiche_id');
    }

    public $fillable = [
        'fonction',
    ];

    protected $casts = [];

    public static array $rules = [];
}
