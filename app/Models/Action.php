<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;
    protected $table = 'actions';
    protected $primaryKey = 'num_action';
    public $incrementing = false; 
    protected $keyType = 'integer'; 
    public $timestamps = false;

    protected $fillable = [
       'num_action','nom_action','nom_action_ar','AE_action'
,'CP_action','date_insert_action','date_update_action','id_ra','num_sous_prog' 
 ];
   
 
    public function Respo_Action()
    {
        return $this->belongsTo(Respo_Action::class);
    }

    public function SousProgramme()
    {
        return $this->belongsTo(SousProgramme::class);
    }

    public function SousAction()
    {
        return $this->hasMany(SousAction::class);
    }
}
