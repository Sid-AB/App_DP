<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrimeController extends Controller
{
    public function edit($id)
    {
        // Trouver l'enregistrement de la prime par son ID
        $prime = Prime::findOrFail($id);

        // Récupérer toutes les sous-actions pour remplir le sélecteur dans le formulaire
        $sousActions = SousAction::all();

        // Retourner la vue 'edit' avec la prime et les sous-actions
        return view('prime.edit', compact('prime', 'sousActions'));
    }

    // Mettre à jour une prime dans la base de données
    public function update(Request $request, $id)
    {
        // Validation des données envoyées dans le formulaire
        $validated = $request->validate([
            'nom' => 'required|string|max:255',  // Valider le champ 'nom'
            'aep' => 'nullable|integer',  // Le champ 'aep' peut être un entier
            'cpp' => 'nullable|integer',  // Le champ 'cpp' peut être un entier
            'num_sous_action' => 'required|exists:sous_actions,num_sous_action',  // Validation de la clé étrangère 'num_sous_action'
        ]);

        // Trouver la prime à mettre à jour
        $prime = Prime::findOrFail($id);

        // Mettre à jour les données dans la table
        $prime->update([
            'nom' => $validated['nom'],
            'aep' => $validated['aep'] ?? 0,  // Si 'aep' n'est pas envoyé, le définir à 0
            'cpp' => $validated['cpp'] ?? 0,  // Si 'cpp' n'est pas envoyé, le définir à 0
            'num_sous_action' => $validated['num_sous_action'],
        ]);

        // Rediriger vers la liste des primes avec un message de succès
        return redirect()->route('prime.index')->with('success', 'Prime mise à jour avec succès.');
    }
}
