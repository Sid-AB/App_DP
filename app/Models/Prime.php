<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prime extends Model
{
    use HasFactory;


    protected $table = 'prime';

    // Champs modifiables (évite les erreurs de mass assignment)
    protected $fillable = ['nom', 'aep', 'cpp', 'num_sous_action'];

    // Relation avec la table sous_actions
    public function sousAction()
    {
        return $this->belongsTo(SousAction::class, 'num_sous_action', 'num_sous_action');
    }
    protected $attributes = [
        'aep' => 0,
        'cpp' => 0,
    ];
    
}