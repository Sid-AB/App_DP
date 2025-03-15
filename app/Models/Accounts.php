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
        'code_generated'
    ];

    protected $hidden = [
        'code_generated',
    ];

      public function multimedias()
    {
        return $this->morphMany(Multimedia::class, 'related');
    }
}
