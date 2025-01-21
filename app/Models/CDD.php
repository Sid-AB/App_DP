<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CDD extends Model
{
    //
    protected $table = 'c_d_d_s';
    protected $primaryKey = 'id_c_d_d_s';
    public $incrementing = true; 
    protected $keyType = 'integer'; 
    public $timestamps = false;

    protected $fillable=['id_c_d_d_s',	'Nom_c_d_d_s',	'Nom_c_d_d_s_ar','CATEGORIE_c_d_d_s','MOYENNE_c_d_d_s','id_emp','date_insert_cdd','date_update_cdd'];

    public function emplois_budget ()
    {
        return $this->belongsTo(Emploi_budget::class,'id_emp','id_emp');
    }
}       
