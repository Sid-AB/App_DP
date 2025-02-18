<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post_commun extends Model
{
    use HasFactory;
    protected $table = 'post_communs';
    protected $primaryKey = 'id_post';
    public $incrementing = true; 
    protected $keyType = 'integer'; 
    public $timestamps = false;

    protected $fillable=['id_post',	'Nom_post',	'CATEGORIE_post','Nom_post_ar','MOYENNE_post','id_emp','date_insert_postcommun','date_update_postcommun'];

    public function emplois_budget ()
    {
        return $this->belongsTo(Emploi_budget::class,'id_emp','id_emp');
    }

}