<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CDI extends Model
{
    //
    protected $table = 'c_d_i_s';
    protected $primaryKey = 'id_c_d_i_s';
    public $incrementing = true; 
    protected $keyType = 'integer'; 
    public $timestamps = false;

    protected $fillable=['id_c_d_i_s',	'Nom_c_d_i_s',	'Nom_c_d_i_s_ar','CATEGORIE_c_d_i_s','MOYENNE_c_d_i_s','id_emp','date_insert_cdi','date_update_cdi'];

    public function emplois_budget ()
    {
        return $this->belongsTo(Emploi_budget::class,'id_emp','id_emp');
    }
}     