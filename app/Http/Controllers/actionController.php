<?php

namespace App\Http\Controllers;

use App\Models\Action;
use Illuminate\Http\Request;
use App\Models\SousAction;

class actionController extends Controller
{
//===================================================================================
                            // affichage de l'action
//===================================================================================
    public function affich_action($num_action)
    {
        // Récupérer les action qui ont le même num_action
        $action = action::where('num_action', $num_action)->get();
    //    dd($action);

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
                                //DEBUT CHECK
//===================================================================================

public function check_action(Request $request)
    {
        $action = Action::where('num_action', $request->num_action)->first();

        if ($action) {
            return response()->json([
                'exists' => true,
                'nom_action' => $action->nom_action,
                'date_insert_action' => $action->date_insert_action,
                'AE_act'=>$action->AE_action,
                'CP_act'=>$action->CP_action,
            ]);
        }

        return response()->json(['exists' => false]);
    }

//===================================================================================
                            //FIN CHECK
//===================================================================================

//===================================================================================
                            // creation de l'action
//===================================================================================
    function create_action(Request $request)
    {
        // Validation des données
        $request->validate([
            'num_action' => 'required',
            'nom_action' => 'required',
            'date_insert_action' => 'required|date',
        ]);
       // dd($request);
             //si le sous PROG existe donc le modifier
    $action = action::where('num_action', $request->num_action)->first();
    if ($action) {
        $action->nom_action = $request->nom_action;
        $action->AE_action=floatval($request->AE_act);
        $action->CP_action=floatval($request->CP_act);
        $action->id_ra = 1;//periodiquement
        $action->date_insert_action = $request->date_insert_action;
        $action->save();
        

          // Créer une nouvelle sous action
          $sousaction = new sousAction();
          $sousaction->num_action = $request->num_action;
          $sousaction->num_sous_action = $request->num_action;
          $sousaction->nom_sous_action = $request->nom_action;
          $sousaction->AE_sous_action=floatval($request->AE_act);
          $sousaction->CP_sous_action=floatval($request->CP_act);
          $sousaction->date_insert_sous_action = $request->date_insert_action;
          $sousaction->save();

            // Enregistrer le fichier et le lier au portefeuille
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('public/files/');
            $filePath = Storage::url($path);

            // Créer un nouvel enregistrement dans multi_media avec le chemin du fichier et l'ID du portefeuille
            $media = new MultiMedia();
            $media->action_id = $action_id->id;
            $media->file_path = $filePath;
            $media->save();
        }
    }
        else{
        // Créer une nouvelle action
        $action = new action();
        $action->num_action = $request->num_action;
        $action->num_sous_prog =$request->id_sous_prog;
        $action->nom_action = $request->nom_action;
        $action->AE_action=floatval($request->AE_act);
        $action->CP_action=floatval($request->CP_act);
        $action->id_ra = 1;//periodiquement
        $action->date_insert_action = $request->date_insert_action;
        $action->save();


         // Créer une nouvelle sous action
         $sousaction = new sousAction();
         $sousaction->num_action = $request->num_action;
         $sousaction->num_sous_action = $request->num_action;
         $sousaction->nom_sous_action = $request->nom_action;
         $sousaction->AE_sous_action=floatval($request->AE_act);
         $sousaction->CP_sous_action=floatval($request->CP_act);
         $sousaction->date_insert_sous_action = $request->date_insert_action;
         $sousaction->save();

              // Enregistrer le fichier et le lier au portefeuille
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('public/files/');
            $filePath = Storage::url($path);

            // Créer un nouvel enregistrement dans multi_media avec le chemin du fichier et l'ID du portefeuille
            $media = new MultiMedia();
            $media->action_id = $action_id->id;
            $media->file_path = $filePath;
            $media->save();
        }
    }

        if ( $sousaction) {
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
