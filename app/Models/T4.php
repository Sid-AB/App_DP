<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T4 extends Model
{
    use HasFactory;
    protected $table = 't4_s';
    protected $primaryKey = 'code_t4';
    public $incrementing = false; 
    protected $keyType = 'integer'; 
    public $timestamps = false;

    protected $fillable = [
       'code_t4','nom_t4','nom_t4_ar' 
    ];
    
    public function Operation()
    {
        return $this->hasMany(Operation::class);
    }
}
