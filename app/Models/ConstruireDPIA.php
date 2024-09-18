<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConstruireDPIA extends Model
{
    use HasFactory;
    protected $table = 'construire_d_p_i_a_s';
    protected $primaryKey = 'id_dpia';
    public $incrementing = false; 
    protected $keyType = 'integer'; 
    public $timestamps = false;

    protected $fillable = [
       'id_dpia','date_creation_dpia','date_modification_dpia','motif_dpia','AE_dpia_nv'
,'CP_dpia_nv','code_operation','id_rp','id_ra'
 ];
   
 
    public function Respo_Action()
    {
        return $this->belongsTo(Respo_Action::class);
    }

    public function Operation()
    {
        return $this->belongsTo(Operation::class);
    }

    public function Respo_Prog()
    {
        return $this->belongsTo(Respo_Prog::class);
    }
}
