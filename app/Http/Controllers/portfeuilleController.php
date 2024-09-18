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

// creation de le portefeuille
    function creat_portef(Request $request)
    {
         // Validation des données
         $request->validate([
            'num_portefeuil' => 'required|unique:portefeuille,num_portefeuil',
            'Nom_journal' => 'required',
            'AE_portef' => 'required',
            'CP_portef' => 'required',
            'Date_portefeuille' => 'required|date',
        ]);

        // Vérifier si le portefeuille existe déjà
        $existing = Portefeuille::where('num_portefeuil', $request->num_port)->first();

        if ($existing) {
            return back()->with('error', 'Le portefeuille avec ce numéro existe déjà.');
        }

        // Créer un nouveau portefeuille
        $portefeuille = new Portefeuille();
        $portefeuille->num_portefeuil = $request->num_port;
        $portefeuille->Nom_journal = $request->nom;
        $portefeuille->AE_portef = $request->AE_portef;
        $portefeuille->CP_portef = $request->CP_portef;
        $portefeuille->Date_portefeuille = $request->date;
        $portefeuille->save();

        return redirect()->back()->with('success', 'Portefeuille ajouté avec succès.');
    }

}
