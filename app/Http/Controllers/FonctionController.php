<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emploi_budget;
use App\Models\Fonctions;
use Barryvdh\Snappy\Facades\SnappyPdf;

class FonctionController extends Controller
{
    
function get_list_fonction(Request $request)

{

    $fonction=Emploi_budget::join('fonctions','fonctions.id_emp','=','emploi_budgets.id_emp') ->orderBy('num_sous_action') 
    ->get()
    ->groupBy('num_sous_action');
    dd( $fonction);

    if ($fonction->isEmpty()) {
        return back()->with('erreur', 'Aucune donnée disponible');
    }

    
    $totalOuverts = $postssup->sum('EmploiesOuverts');
    $totalOccupes = $postssup->sum('EmploiesOccupes');
    $totalVacants = $postssup->sum('EmploiesVacants');

    $pdf = SnappyPdf::loadView('', compact('fonction', 'totalOuverts', 'totalOccupes', 'totalVacants'));

    return $pdf->download('emploi_budget_fonction.pdf');

}
}
