<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Action;
use App\Models\SousAction;

class actionController extends Controller
{
//===================================================================================
                            // affichage de l'action
//===================================================================================
    public function affich_action($num_sous_prog)
    {
        // Récupérer les action qui ont le même num_sous_prog
        $action = action::where('num_sous_prog', $num_sous_prog)->get();

    // Vérifier si des action existent
        if ($action->isEmpty()) {
             return response()->json([
                'success' => false,
                'message' => 'Aucune action trouvée pour ce sous programme.',
            ]);
        }

    // Retourner les action à la vue
        return view('Action-in.index', compact('action'));
    }


//===================================================================================
                            // creation de l'action
//===================================================================================
    function create_action(Request $request)
    {
        // Validation des données
        $request->validate([
            'num_action' => 'required',
            'nom_action' => 'required',
            //'AE_action' => 'required',
            //'CP_action' => 'required',
            'date_insert_action' => 'required|date',
        ]);

        // Vérifier si le action existe déjà en fonction du numéro et des dates
        $existing = Action::where('num_action', $request->num_action)
                             ->whereNotNull('date_insert_action')
                             ->exists(); // Vérifie s'il y a un enregistrement existant

        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'L\'action avec ce numéro existe déjà.',
                'code' => 302, // Utiliser un code 302 pour redirection (redirection implicite)
                'data' => $existing, // Inclure les données du portefeuille existant
            ]);
        }

        // Créer une nouvelle action et sous action
        $action = new Action();
        $action->num_action = intval($request->num_action);
        $action->num_sous_prog = intval($request->id_sous_prog);
        $action->nom_action = $request->nom_action;
       // $action->AE_action = floatval($request->AE_action);
        //$action->CP_action = floatval($request->CP_action);
        $action->id_ra = 1;//periodiquement
        $action->date_insert_action = $request->date_insert_action;

        $action->save();

        // Copie dans sousaction
        SousAction::create([
            'num_sous_action' => $action->num_action,  // égal à numaction
            'nom_action' => $action->num_action,
            'nom_sous_action' => $action->nom_action,
            'date_insert_sous_action' => $action->date_insert_action,      // clé étrangère
        ]);

      //  dd(vars: $action);
        if ($action && $sousaction) {
            return response()->json([
                'success' => true,
                'message' => 'Action ajouté avec succès.',
                'code' => 200,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'ajout de l\'action.',
                'code' => 500,
            ]);
        }
    }


}
