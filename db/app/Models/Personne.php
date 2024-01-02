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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($personne) {
            // Set the default value for 'avatar' based on 'genre'
            $personne->avatar = $personne->genre === 'male' ? 'public/images/male.jpg' : 'public/images/female.jpg';
        });
    }
    protected $casts = [];

    public static array $rules = [];

    public function contact()
    {
        return $this->hasOne(Contact::class,'personne_id', 'personne_id');
    }
}
