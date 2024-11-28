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
        'T1_AE_sous_prog' => 'required',
        'T1_CP_sous_prog' => 'required',

        'T2_AE_sous_prog' => 'required',
        'T2_CP_sous_prog' => 'required',

        'T3_AE_sous_prog' => 'required',
        'T3_CP_sous_prog' => 'required',

        'T4_AE_sous_prog' => 'required',
        'T4_CP_sous_prog' => 'required',

    ]);
    //dd(floatval(floatval($request->T1_AE_sous_prog)));

    $initPort = new initPort();
    $initPort->AE_init_t1 = floatval($request->T1_AE_sous_prog);
    $initPort->CP_init_t1 = floatval($request->T1_CP_sous_prog);

    $initPort->AE_init_t2 = floatval($request->T2_AE_sous_prog);
    $initPort->CP_init_t2 = floatval($request->T2_CP_sous_prog);

    $initPort->AE_init_t3 = floatval($request->T3_AE_sous_prog);
    $initPort->CP_init_t3 = floatval($request->T3_CP_sous_prog);

    $initPort->AE_init_t4 = floatval($request->T4_AE_sous_prog);
    $initPort->CP_init_t4 = floatval($request->T4_CP_sous_prog);

    $initPort->code_t1 = $request->code_t1;
    $initPort->code_t2 = $request->code_t2;
    $initPort->code_t3 = $request->code_t3;
    $initPort->code_t4 = $request->code_t4;
    $initPort->date_init = $request->date_init;
    $initPort->num_sous_prog = $request->numsouprog_year;


    $initPort->save();



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
