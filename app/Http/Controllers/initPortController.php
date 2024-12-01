<?php

namespace App\Http\Controllers;

use App\Models\initPort;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class initPortController extends Controller
{
//===================================================================================
                            // creation du initPort
//===================================================================================
function create_sou_prog(Request $request)
{
    // Validation des données
    $request->validate([
        'T1_AE_init' => 'required',
        'T1_CP_init' => 'required',

        'T2_AE_init' => 'required',
        'T2_CP_init' => 'required',

        'T3_AE_init' => 'required',
        'T3_CP_init' => 'required',

        'T4_AE_init' => 'required',
        'T4_CP_init' => 'required',

    ]);
    //dd(floatval(floatval($request->T1_AE_init)));

    $codes = [
        't1' => 10000,
        't2' => 20000,
        't3' => 30000,
        't4' => 40000,
    ];

    // Parcourir chaque clé (t1, t2, etc.) pour insérer les valeurs initiales et finales dans une même ligne
    foreach ($codes as $id => $codeT) {
        // Récupérer les valeurs initiales et finales
        $AE_init = $request->input("{$id}_AE_init");
        $CP_init = $request->input("{$id}_CP_init");

        // Insérer une ligne dans la table
        $initPort=initPort::create([
            //'T' => $id, // Identifiant de la donnée (par exemple, 't1', 't2', etc.)
            'codeT' => $codeT,
            'AE_init' => $AE_init,
            'CP_init' => $CP_init,
        ]);
    }



  //  dd($initPort);
    if ($initPort) {
        return response()->json([
            'success' => true,
            'message' => 'Sous programme ajouté avec succès.',
            'code' => 200,
        ]);
 //dd($initPort);

    } else {
        return response()->json([
            'success' => false,
            'message' => 'Erreur lors de l\'ajout du sous programme.',
            'code' => 500,
        ]);
    }


}
}
