<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respo_Prog extends Model
{
    use HasFactory;
    protected $table = 'respo__progs';
    protected $primaryKey = 'id_rp';
    public $incrementing = false; 
    protected $keyType = 'integer'; 
    public $timestamps = false;

    protected $fillable = [
       'id_rp','Date_installation_rp','id_nin' 
    ];
   
    public function Personne()
    {
        return $this->belongsTo(Personne::class);
    }

    public function Programme()
    {
        return $this->hasOne(Programme::class);
    }
}
