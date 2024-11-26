<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class initPort extends Model
{
    use HasFactory;
    protected $table = 'init_ports';
    protected $primaryKey = 'id_init';
    public $incrementing = false; 
    protected $keyType = 'integer'; 
    public $timestamps = false;

    protected $fillable = [
       'id_init','date_init','AE_init_t1','CP_init_t1','AE_init_t2'
,'CP_init_t2','AE_init_t3','CP_init_t3','AE_init_t4','CP_init_t4','code_t1','code_t2','code_t3','code_t4','num_sous_prog'
 ];
   
 
    public function sousProgramme()
    {
        return $this->belongsTo(SousProgramme::class,'num_sous_prog','num_sous_prog');
    }

    public function T1()
    {
        return $this->belongsTo(T1::class,'code_t1','code_t1');
    }

    public function T2()
    {
        return $this->belongsTo(T2::class,'code_t2','code_t2');
    }

    public function T3()
    {
        return $this->belongsTo(T3::class,'code_t3','code_t3');
    }
    public function T4()
    {
        return $this->belongsTo(T4::class,'code_t4','code_t4');
    }

   
}
