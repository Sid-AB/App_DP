<?php

namespace App\Http\Controllers;

use App\Models\SousAction;
use Illuminate\Http\Request;

class sousActionController extends Controller
{
//===================================================================================
                            // affichage sous action
//===================================================================================
public function affich_sous_action($num_action)
{
    // Récupérer les action qui ont le même num_action
    $SousAction = SousAction::where('num_action', $num_action)->get();

// Vérifier si des action existent
    if ($SousAction->isEmpty()) {
         return response()->json([
            'success' => false,
            'message' => 'Aucune sous action trouvée pour cette action.',
        ]);
    }

// Retourner les action à la vue
    return view('Action-in.index', compact('SousAction'));
}


//===================================================================================
                        // creation sous action
//===================================================================================
function create_sous_action(Request $request)
{
    // Validation des données
    $request->validate([
        'num_sous_action' => 'required',
        'nom_sous_action' => 'required',

        'date_insert_sous_action' => 'required|date',
    ]);

    // Vérifier si sous action existe déjà en fonction du numéro et des dates
  /*  $existing = sousaction::where('num_action', $request->num_action)
                         ->whereNotNull('date_insert_sous_action')
                         ->exists(); // Vérifie s'il y a un enregistrement existant

    if ($existing) {
        return response()->json([
            'success' => false,
            'message' => 'La sous action avec ce numéro existe déjà.',
            'code' => 404,
        ]);
    }
*/
$year = date('Y'); // Récupérer l'année actuelle
    // Créer une nouvelle action
    $action = new SousAction();
    $action->num_sous_action = intval($request->num_sous_action).intval($request->num_act).intval($request->id_sous_prog).intval($request->id_prog).intval($request->id_porte).$year;
    $action->num_action = intval($request->num_act).intval($request->id_sous_prog).intval($request->id_prog).intval($request->id_porte).$year;
    $action->nom_sous_action = $request->nom_sous_action;
    $action->date_insert_sous_action = $request->date_insert_sous_action;
    $action->save();

    if ($action) {
        return response()->json([
            'success' => true,
            'message' => 'Sous action ajouté avec succès.',
            'code' => 200,
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Erreur lors de l\'ajout de sous action.',
            'code' => 500,
        ]);
    }
}


}
