<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;
    protected $table = 'operations';
    protected $primaryKey = 'code_operation';
    public $incrementing = false;
    protected $keyType = 'integer';
    public $timestamps = false;

    protected $fillable = [
       'code_operation','nom_operation','nom_operation_ar','AE_operation','CP_operation','AE_engage','CP_reporte'
,'date_insert_operation','date_update_operation','AE_ouvert','AE_atendu','CP_ouvert','CP_atendu','AE_reporte','AE_notifie','CP_notifie','CP_consome'
 ,'code_grp_operation','code_t1','code_t2','code_t3','code_t4'];


    public function GroupOperation()
    {
        return $this->belongsTo(GroupOperation::class);
    }

    public function SousOperation()
    {
        return $this->hasMany(SousOperation::class);
    }
    public function T1()
    {
        return $this->belongsTo(T1::class);
    }

    public function T2()
    {
        return $this->belongsTo(T2::class);
    }

    public function T3()
    {
        return $this->belongsTo(T3::class);
    }
    public function T4()
    {
        return $this->belongsTo(T4::class);
    }
}
