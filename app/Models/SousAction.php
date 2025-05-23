<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SousAction extends Model
{
    use HasFactory;
    protected $table = 'sous_actions';
    protected $primaryKey = 'num_sous_action';
    public $incrementing = false; 
    protected $keyType = 'string'; 
    public $timestamps = false;

    protected $fillable = [
       'num_sous_action','num_action','nom_sous_action','nom_sous_action_ar','AE_sous_action',
       'CP_sous_action','date_insert_sous_action','date_update_sous_action','AE_sousaction_NONREPARTIS',
       'CP_sousaction_NONREPARTIS','num_action'
 ];
   
 
    public function Action()
    {
        return $this->belongsTo(Action::class,'num_action','num_action');
    }

    public function GroupOperation()
    {
        return $this->hasMany(GroupOperation::class,'num_sous_action','num_sous_action');
    }


    public function ModificationT()
    {
        return $this->hasMany(ModificationT::class,'num_sous_action','num_sous_action');
    }

    public function emploibudg()
    {
        return $this->hasMany(Emploi_budget::class,'num_sous_action','num_sous_action');
    }
   
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($parent) {
            $parent->GroupOperation()->delete(); // Supprime les enfants
            $parent->emploibudg()->delete(); // Supprime les enfants
            $parent->ModificationT()->delete(); // Supprime les enfants
            
        });
        
        
    }
   
}
