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
                                //DEBUT CHECK
//===================================================================================

public function check_action(Request $request)
    {
        $sousaction = Action::where('num_sous_action', $request->num_sous_action)->first();

        if ($sousaction) {
            return response()->json([
                'exists' => true,
                'nom_sous_action' => $sousaction->nom_sous_action,
                'date_insert_sous_action' => $sousaction->date_insert_sous_action
            ]);
        }

        return response()->json(['exists' => false]);
    }

//===================================================================================
                            //FIN CHECK
//===================================================================================
//===================================================================================
                        // creation sous action
//===================================================================================
function create_sousaction(Request $request)
{//dd($request);
    // Validation des données
    $request->validate([
        'num_sous_action' => 'required',
        'nom_sous_action' => 'required',
        'date_insert_sous_action' => 'required|date',
    ]);

    $year = date('Y'); // Récupérer l'année actuelle
   $num= intval($request->num_act).intval($request->id_sous_prog).intval($request->id_prog).intval($request->id_porte).$year;

 // Récupérer la ligne de la table en fonction de 'numsouaction'
 $sousAction = SousAction::where('num_sous_action', $num)->first(); // Utilisation de 'numsouaction' pour trouver l'élément
 if ($sousAction) {
    // Concaténation des valeurs pour num_sous_action

    $sousAction->num_sous_action = $request->num_sous_action
        . $request->num_act
        . $request->id_sous_prog
        . $request->id_prog
        . $request->id_porte
        . $year;

    // Mise à jour des autres champs
    $sousAction->nom_sous_action = $request->nom_sous_action;
    $sousAction->date_insert_sous_action = $request->date_insert_sous_action;

    // Enregistrer les modifications dans la base de données
    $sousAction->save();

    return response()->json([
        'success' => true,
        'message' => 'Sous-Action ajouté avec succès.',
        'code' => 200,
    ]);
} else {
    // Gérer le cas où la sous-action n'est pas trouvée
    return response()->json([
        'success' => false,
        'message' => 'Erreur lors de l\'ajout de la sous action.',
        'code' => 500,
    ]);

}


}
}
