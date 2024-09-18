<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SousOperation extends Model
{
    use HasFactory;
    protected $table = 'sous_operations';
    protected $primaryKey = 'code_sous_operation';
    public $incrementing = false; 
    protected $keyType = 'integer'; 
    public $timestamps = false;

    protected $fillable = [
       'code_sous_operation','nom_sous_operation','nom_sous_operation_ar','AE_sous_operation','CP_sous_operation'
,'code_operation'
 ];
   
 
    public function Operation()
    {
        return $this->belongsTo(Operation::class);
    }


}
