<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModificationT extends Model
{
    use HasFactory;
    protected $table = 'modification_t_s';
    protected $primaryKey = 'id_modif';
    public $incrementing = false; 
    protected $keyType = 'integer'; 
    public $timestamps = false;

    protected $fillable = [
       'id_modif','date_modif','AE_modif_t1','CP_modif_t1','AE_modif_t2'
,'CP_modif_t2','AE_modif_t3','CP_modif_t3','AE_modif_t4','CP_modif_t4','code_t1','code_t2','code_t3','code_t4','id_art'
 ];
   
 
    public function articles()
    {
        return $this->belongsTo(Article::class,'id_art','id_art');
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