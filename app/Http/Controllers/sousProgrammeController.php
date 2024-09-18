<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class sousSousProgrammeController extends Controller
{
    //affichage du SousProgramme
    function affich_sou_prog()
    {
        return view('Portfail-in.index');
    }


    // creation du SousProgramme
    function create_sou_prog(Request $request, $num_prog)
    {
        // Validation des données
        $request->validate([
            'num_sous_prog' => 'required',
            'nom_sous_prog' => 'required',
            'AE_sous_porg' => 'required',
            'CP_sous_prog' => 'required',
            'date_insert_sousProg' => 'required|date',
        ]);

        // Vérifier si le SousProgramme existe déjà en fonction du numéro et des dates
        $existing = SousProgramme::where('num_sous_prog', $request->num_sous_prog)
                             ->whereNotNull('date_insert_sousProg')
                             ->whereNotNull('date_update_sousProg')
                             ->exists(); // Vérifie s'il y a un enregistrement existant

        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'Le SousProgramme avec ce numéro existe déjà.',
                'code' => 404,
            ]);
        }

        // Créer un nouveau SousProgramme
        $SousProgramme = new SousProgramme();
        $SousProgramme->num_sous_prog = $request->num_sous_prog;
        $SousProgramme->num_prog = $num_prog;
        $SousProgramme->nom_sous_prog = $request->nom_sous_prog;
        $SousProgramme->AE_sous_porg = $request->AE_sous_porg;
        $SousProgramme->CP_sous_prog = $request->CP_sous_prog;
        $SousProgramme->date_insert_sousProg = $request->date_insert_sousProg;
        $SousProgramme->save();

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
