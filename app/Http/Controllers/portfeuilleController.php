<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class portfeuilleController extends Controller
{

//affichage de le portrefeuilleS
    function affich_portefs()
    {
        return view('Portfail-in.index');
    }

//affichage de le portrefeuille
    function affich_portef()
    {
        return view('Portfail-in.index');
    }

   /* function creat_portef()
    {
        return view('Portfail-in.creation');
    }*/

    // creation de le portefeuille
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
                'success'=> 'Le portefeuille avec ce numéro existe déjà.',
                'code'=>404,
            ]);
        }

        // Créer un nouveau portefeuille
        $portefeuille = new Portefeuille();
        $portefeuille->num_portefeuil = $request->num_port;
        $portefeuille->nom_journal = $request->nom;
        $portefeuille->num_journal = $request->num_journal;
        $portefeuille->AE_portef = $request->AE_portef;
        $portefeuille->CP_portef = $request->CP_portef;
        $portefeuille->Date_portefeuille = $request->date;
        $portefeuille->id_nin =1;
        $portefeuille->save();

        if($portefeuille)
        {
            return response()->json([
                'success'=>'Portefeuille ajouté avec succès.',
                'code'=>200,
            ]);
        }
        else
        {
            return response()->json([
                'success'=> 'erreur.',
                'code'=>404,
            ]);
        }

        //return redirect()->back()->with('success', 'Portefeuille ajouté avec succès.');
        //return view('Portfail-in.index');
    }

}
