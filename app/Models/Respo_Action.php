<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respo_Action extends Model
{
    use HasFactory;
    protected $table = 'respo__actions';
    protected $primaryKey = 'id_rp';
    public $incrementing = false; 
    protected $keyType = 'integer'; 
    public $timestamps = false;

    protected $fillable = [
       'id_ra','Date_installation_ra','id_nin' 
    ];
   
    public function Personne()
    {
        return $this->belongsTo(Personne::class);
    }

    public function Action()
    {
        return $this->hasOne(Action::class);
    }
    
    public function Realiser()
    {
        return $this->hasMany(Realiser::class);
    }

    
}

