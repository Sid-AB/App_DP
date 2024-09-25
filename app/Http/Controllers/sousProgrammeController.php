<?php

namespace App\Http\Controllers;

use App\Models\SousProgramme;
use Illuminate\Http\Request;

class sousProgrammeController extends Controller
{

//===================================================================================
                            //affichage du SousProgramme
//===================================================================================
    function affich_sou_prog($num_prog)
    {
        // Récupérer les SousProgramme qui ont le même num_prog
            $SousProgramme = SousProgramme::where('num_prog', $num_prog)->get();

        // Vérifier si des SousProgramme existent
            if ($SousProgramme->isEmpty()) {
                 return response()->json([
                    'success' => false,
                    'message' => 'Aucun Sous programme trouvé pour ce programme.',
                ]);
            }

        // Retourner les SousProgramme à la vue
             return view('Portfail-in.index', compact('SousProgramme'));
    }

//===================================================================================
                            // creation du SousProgramme
//===================================================================================
    function create_sou_prog(Request $request)
    {
        // Validation des données
        $request->validate([
            'num_sous_prog' => 'required|unique:sous_programmes,num_sous_prog',
            'nom_sous_prog' => 'required',
         /*   'AE_sous_porg' => 'required',
            'CP_sous_prog' => 'required',*/
            'date_insert_sousProg' => 'required|date',
        ]);

        // Vérifier si le SousProgramme existe déjà en fonction du numéro et des dates
        $year = date('Y'); // Récupérer l'année actuelle
        $num= intval($request->num_sous_prog).intval($request->id_porte).intval($request->id_program).$year;
        $existing = SousProgramme::where('num_sous_prog', $num)
                             ->whereNotNull('date_insert_sousProg')
                             ->exists(); // Vérifie s'il y a un enregistrement existant

        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'Le SousProgramme avec ce numéro existe déjà.',
               'code' => 302, // Utiliser un code 302 pour redirection (redirection implicite)
                'data' => $existing, // Inclure les données du portefeuille existant
            ]);
        }
//dd($request);

        // Créer un nouveau SousProgramme
        $SousProgramme = new SousProgramme();
        $SousProgramme->num_sous_prog = $num;
        $SousProgramme->num_prog = intval($request->id_porte).intval($request->id_program).$year;
        $SousProgramme->nom_sous_prog = $request->nom_sous_prog;
        //$SousProgramme->AE_sous_prog = floatval($request->AE_sous_prog);
        //$SousProgramme->CP_sous_prog = floatval($request->CP_sous_prog);
        $SousProgramme->date_insert_sousProg = $request->date_insert_sousProg;

        $SousProgramme->save();
      //  dd($SousProgramme);
        if ($SousProgramme) {
            return response()->json([
                'success' => true,
                'message' => 'Sous programme ajouté avec succès.',
                'code' => 200,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'ajout du sous programme.',
                'code' => 500,
            ]);
        }

}
}
