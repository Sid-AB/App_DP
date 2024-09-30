<?php

namespace App\Http\Controllers;

use App\Models\Programme;
use Illuminate\Http\Request;

class programmeControlleur extends Controller
{
    //===================================================================================
                                //affichage du programme
    //===================================================================================
    function affich_prog( $num_portefeuil)
    {
           // Récupérer les programmes qui ont le même num_port
    $programmes = Programme::where('num_portefeuil', $num_portefeuil)->get();

    // Vérifier si des programmes existent
    if ($programmes->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => 'Aucun programme trouvé pour ce portefeuille.',
        ]);
    }

    // Retourner les programmes à la vue
        return view('Portfail-in.index', compact('programmes'));
    }

 //===================================================================================
                                // creation du programme
//===================================================================================
    function creat_prog(Request $request)
    {
        // Validation des données
        $request->validate([
            'num_prog' => 'required|unique:programmes,num_prog',
            'nom_prog' => 'required',
        /*    'AE_prog' => 'required',
            'CP_prog' => 'required',*/
            'date_insert_portef' => 'required|date',
        ]);

        // Vérifier si le programme existe déjà en fonction du numéro et des dates
        $year = date('Y'); // Récupérer l'année actuelle
        $num=intval($request->num_prog).intval($request->num_portefeuil).$year;
//dd($num);
        $existing = programme::where('num_prog', $num)
                             ->whereNotNull('date_insert_portef')
                             ->exists(); // Vérifie s'il y a un enregistrement existant

        if ($existing) {
           // dd($ex)
            return response()->json([
                'success' => false,
                'message' => 'Le programme avec ce numéro existe déjà.',
                'code' => 302, // Utiliser un code 302 pour redirection (redirection implicite)
                'data' => $existing, // Inclure les données du portefeuille existant
            ]);
        }

        // Créer un nouveau programme
        $programme = new Programme();
        $programme->num_prog = $num;
        $programme->num_portefeuil = intval($request->num_portefeuil).$year;
        $programme->nom_prog = $request->nom_prog;
        //$programme->AE_porg =floatval($request->AE_prog);
        //$programme->CP_prog = floatval($request->CP_prog);
        $programme->date_insert_portef = $request->date_insert_portef;
        $programme->id_rp = 1; //periodiquement

        $programme->save();
        //dd($programme);
        if ($programme) {
            return response()->json([
                'success' => true,
                'message' => 'Programme ajouté avec succès.',
                'code' => 200,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'ajout du programme.',
                'code' => 500,
            ]);
        }
    }

}