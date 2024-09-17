<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Construit extends Model
{
    use HasFactory;
    protected $table = 'construits';
    protected $primaryKey = 'id_construit';
    public $incrementing = false; 
    protected $keyType = 'integer'; 
    public $timestamps = false;

    protected $fillable = [
       'id_construit','id_extrait','id_rff','num_action'
 ];
   
 
    public function RFF()
    {
        return $this->belongsTo(RFF::class);
    }

    public function Action()
    {
        return $this->belongsTo(Action::class);
    }

    public function Extrait_DPIC()
    {
        return $this->belongsTo(Extrait_DPIC::class);
    }
}