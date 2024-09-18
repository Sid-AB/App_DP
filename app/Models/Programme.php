<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    use HasFactory;
    protected $table = 'programmes';
    protected $primaryKey = 'num_prog';
    public $incrementing = false; 
    protected $keyType = 'integer'; 
    public $timestamps = false;

    protected $fillable = [
       'num_prog','nom_prog','nom_prog_ar','date_update_portef'
,'AE_prog','CP_prog','id_rp','num_portefeuil','date_insert_portef' 
 ];
   
 
    public function Respo_Prog()
    {
        return $this->belongsTo(Respo_Prog::class);
    }

    public function Portefeuille()
    {
        return $this->belongsTo(Portefeuille::class);
    }

    public function SousProgramme()
    {
        return $this->hasMany(SousProgramme::class);
    }
}
