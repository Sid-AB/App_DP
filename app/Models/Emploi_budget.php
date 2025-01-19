<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emploi_budget extends Model
{
    //
    use HasFactory;
    protected $table = 'emploi_budgets';
    protected $primaryKey = 'id_emp';
    public $incrementing = true; 
    protected $keyType = 'integer'; 
    public $timestamps = false;

    protected $fillable = [
       'id_emp','EmploiesOuverts','EmploiesOccupes','EmploiesVacants','TRAITEMENT_ANNUEL','PRIMES_INDEMNITES','DEPENSES_ANNUELLES',
      'code_t1',
    ];

    public function Emplois()
    {
        return $this->belongsTo(T1::class,'code_t1','code_t1');
    }

    public function PostCommun()
    {
        return $this->hasMany(Post_commun::class ,'id_emp','id_emp');
    }

    public function PostContrat()
    {
        return $this->hasMany(Post_contrat::class ,'id_emp','id_emp');
    }

    public function PostSup()
    {
        return $this->hasMany(Post_sup::class ,'id_emp','id_emp');
    }

    public function Focntions()
    {
        return $this->hasMany(Focntions::class ,'id_emp','id_emp');
    }
}

