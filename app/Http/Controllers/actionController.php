<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    function create_action(Request $request, $num_sous_prog)
    {
        // Validation des données
        $request->validate([
            'num_action' => 'required',
            'nom_action' => 'required',
            'AE_action' => 'required',
            'CP_action' => 'required',
            'date_insert_action' => 'required|date',
        ]);

        // Vérifier si le action existe déjà en fonction du numéro et des dates
        $existing = action::where('num_action', $request->num_action)
                             ->whereNotNull('date_insert_action')
                             ->exists(); // Vérifie s'il y a un enregistrement existant

        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'L\'action avec ce numéro existe déjà.',
                'code' => 404,
            ]);
        }

        // Créer une nouvelle action
        $action = new action();
        $action->num_action = $request->num_action;
        $action->num_sous_prog = $num_sous_prog;
        $action->nom_sous_prog = $request->nom_sous_prog;
        $action->AE_action = $request->AE_action;
        $action->CP_action = $request->CP_action;
        $action->id_ra = 1;//periodiquement
        $action->date_insert_action = $request->date_insert_action;
        $action->save();

        if ($action) {
            return response()->json([
                'success' => true,
                'message' => 'Action ajouté avec succès.',
                'code' => 200,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'ajout du Action.',
                'code' => 500,
            ]);
        }
    }


}
