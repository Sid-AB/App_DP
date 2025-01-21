<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post_sup extends Model
{
    use HasFactory;
    protected $table = 'post_sups';
    protected $primaryKey = 'id_postsup';
    public $incrementing = true; 
    protected $keyType = 'integer'; 
    public $timestamps = false;

    protected $fillable=['id_postsup',	'Nom_postsup',	'Nom_postsup_ar','Niveau_sup','point_indsup','id_emp'];

    public function emplois_budget ()
    {
        return $this->belongsTo(Emploi_budget::class,'id_emp','id_emp');
    }
}
