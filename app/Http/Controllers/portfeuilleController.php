<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class portfeuilleController extends Controller
{

//===================================================================================
                                //affichage du portrefeuille
//===================================================================================
    function affich_portef()
    {
        // Récupérer tous les portefeuilles de la base de données
            $portefeuilles = Portefeuille::all();

    // Passer les données à la vue
        return view('Portfail-in.index', compact('portefeuilles'));
    }
    function create_vportef()
    {
        return view('Portfail-in.creation');
    }
//===================================================================================
                                // creation du portefeuille
//===================================================================================
    function creat_portef(Request $request)
    {
         // Validation des données
         $request->validate([
            'num_portefeuil' => 'required|unique:portefeuille,num_portefeuil',
            'num_journal' => 'required',
            'nom_journal' => 'required',
            'AE_portef' => 'required',
            'CP_portef' => 'required',
            'Date_portefeuille' => 'required|date',
        ]);

        // Vérifier si le portefeuille existe déjà
        $existing = Portefeuille::where('num_portefeuil', $request->num_port)->first();

        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'Le portefeuille avec ce numéro existe déjà.',
                'code'=>404,
            ]);
        }

        // Créer un nouveau portefeuille
        $portefeuille = new Portefeuille();
        $portefeuille->num_portefeuil = $request->num_port;
        $portefeuille->nom_journal = $request->nom_journal;
        $portefeuille->num_journal = $request->num_journal;
        $portefeuille->AE_portef = $request->AE_portef;
        $portefeuille->CP_portef = $request->CP_portef;
        $portefeuille->Date_portefeuille = $request->date;
        $portefeuille->id_nin =1;//periodiquement
        $portefeuille->save();

        if($portefeuille)
        {
            return response()->json([
                'success' => true,
                'message' => 'Portefeuille ajouté avec succès.',
                'code' => 200,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'ajout du portefeuille.',
                'code' => 500,
            ]);
        }


    }

}
