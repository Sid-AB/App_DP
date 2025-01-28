<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post_contrat extends Model
{
    use HasFactory;
    protected $table = 'post_contrats';
    protected $primaryKey = 'id_postContrat';
    public $incrementing = true; 
    protected $keyType = 'integer'; 
    public $timestamps = false;

    protected $fillable=['id_postContrat',	'Nom_postContrat',	'CATEGORIE_postContrat','Nom_postContrat_ar','MOYENNE_postContrat','id_emp'];

    public function emplois_budget ()
    {
        return $this->belongsTo(Emploi_budget::class,'id_emp','id_emp');
    }

}
