<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Personne extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $table = 'personnes';

    protected $primaryKey = 'personne_id';


    public $fillable = [
        'firstName',
        'lastName',
        'genre',
        'email',
        'phonenumber',
        'avatar',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [];

    public static array $rules = [];


    public function contact()
    {
        return $this->hasOne(Contact::class);
    }


    // public function contact()
    // {
    //     return $this->hasOne(Contact::class,'personne_id', 'personne_id');
    // }
}
