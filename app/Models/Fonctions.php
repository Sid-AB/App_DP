<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fonctions extends Model
{
    //
    protected $table = 'fonctions';
    protected $primaryKey = 'id_fonction';
    public $incrementing = true; 
    protected $keyType = 'integer'; 
    public $timestamps = false;

    protected $fillable=['id_fonction',	'Nom_fonction',	'Nom_fonction_ar','Moyenne','CATEGORIE','id_emp','date_insert_fonct','date_update_fonct'];

    public function emplois_budget ()
    {
        return $this->belongsTo(Emploi_budget::class,'id_emp','id_emp');
    }

  
}

