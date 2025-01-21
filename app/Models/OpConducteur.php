<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpConducteur extends Model
{
    //
    protected $table = 'opconducteurs';
    protected $primaryKey = 'id_opconducteurs';
    public $incrementing = true; 
    protected $keyType = 'integer'; 
    public $timestamps = false;

    protected $fillable=['id_opconducteurs',	'Nom_opconducteurs',	'Nom_opconducteurs_ar','CATEGORIE_opconducteurs','MOYENNE_opconducteurs','id_emp','date_insert_opconducteur'
,'date_update_opconducteur'];

    public function emplois_budget ()
    {
        return $this->belongsTo(Emploi_budget::class,'id_emp','id_emp');
    }

}
    