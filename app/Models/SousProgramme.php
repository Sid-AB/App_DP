<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SousProgramme extends Model
{
    use HasFactory;
    protected $table = 'sous_programmes';
    protected $primaryKey = 'num_sous_prog';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
      'num_sous_prog','nom_sous_prog','nom_sous_prog_ar','AE_sous_prog','CP_sous_prog'
,'date_insert_sousProg','date_update_sousProg','num_prog','AE_sousprog_NONREPARTIS','CP_sousprog_NONREPARTIS'
];

    public function Programme()
    {
        return $this->belongsTo(Programme::class,'num_prog','num_prog');
    }

    public function Action()
    {
        return $this->hasMany(Action::class,'num_sous_prog','num_sous_prog');
    }

    public function ModificationT()
    {
        return $this->hasMany(ModificationT::class,'num_sous_prog','num_sous_prog');
    }

    public function multimedias()
    {
        return $this->morphMany(Multimedia::class, 'related');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($parent) {
            $parent->Action()->delete(); // Supprime les enfants
            $parent->ModificationT()->delete(); // Supprime les enfants
            $parent->multimedias()->delete(); // Supprime les enfants
            $parent->InitPorts()->delete(); // Supprime les enfants
          //  $parent->multimedias()->delete();
        });
    }
    public function InitPorts()
    {
        return $this->hasMany(initPort::class,'num_sous_prog','num_sous_prog');
 
    }

   
}
