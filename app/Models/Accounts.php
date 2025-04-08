<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    //
    use HasFactory;

    protected $fillable = [
 
        'nome',
        'prenom',
        'email',
        'post_occupe',
        'sous_direction',
        'privilege',
        'responable',
        'code_generated',
        'id_min',
        'id_rp',
        'id_ra'
    ];

    protected $hidden = [
        'code_generated',
    ];

      public function multimedias()
    {
        return $this->morphMany(Multimedia::class, 'related');
    }
}
