<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class programmeControlleur extends Controller
{
    //affichage du programme
    function affich_prog()
    {
        return view('Portfail-in.index');
    }


    // creation du programme
    function create_prog(Request $request, $num_port)
    {
        // Validation des données
        $request->validate([
            'num_prog' => 'required',
            'nom_prog' => 'required',
            'AE_prog' => 'required',
            'CP_prog' => 'required',
            'date_insert_portef' => 'required|date',
        ]);

        // Vérifier si le programme existe déjà en fonction du numéro et des dates
        $existing = programme::where('num_prog', $request->num_prog)
                             ->whereNotNull('date_insert_portef')
                             ->whereNotNull('date_update_portef')
                             ->exists(); // Vérifie s'il y a un enregistrement existant

        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'Le programme avec ce numéro existe déjà.',
                'code' => 404,
            ]);
        }

        // Créer un nouveau programme
        $programme = new programme();
        $programme->num_prog = $request->num_prog;
        $programme->num_portefeuil = $num_port;
        $programme->nom_prog = $request->nom_prog;
        $programme->AE_prog = $request->AE_prog;
        $programme->CP_prog = $request->CP_prog;
        $programme->date_insert_portef = $request->date_insert_portef;
        $programme->id_rp = 1; // Assurez-vous que cela est correct pour votre cas
        $programme->save();

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
