<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SousProgramme;
use App\Models\initPort;
use App\Http\Controllers\Controller;

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
                                //DEBUT CHECK
//===================================================================================

public function check_sous_prog(Request $request)
{
    $sousprog = SousProgramme::where('num_sous_prog', $request->num_sous_prog)->first();

    if ($sousprog) {
        return response()->json([
            'exists' => true,
            'nom_sous_prog' => $sousprog->nom_sous_prog,
            'date_insert_sousProg' => $sousprog->date_insert_sousProg,
            'AE_sous_prog'=>$sousprog->AE_sous_prog,
            'CP_sous_prog'=>$sousprog->CP_sous_prog,
        ]);
    }

    return response()->json(['exists' => false]);
}
//===================================================================================
                            //FIN CHECK
//===================================================================================

//===================================================================================
                            // creation du SousProgramme
//===================================================================================
    function create_sou_prog(Request $request)
    {
        // Validation des données
        $request->validate([
            'num_sous_prog' => 'required',
            'nom_sous_prog' => 'required',
            'date_insert_sousProg' => 'required|date',

            'T1_AE_sous_prog' => 'required',
            'T1_CP_sous_prog' => 'required',

            'T2_AE_sous_prog' => 'required',
            'T2_CP_sous_prog' => 'required',

            'T3_AE_sous_prog' => 'required',
            'T3_CP_sous_prog' => 'required',

            'T4_AE_sous_prog' => 'required',
            'T4_CP_sous_prog' => 'required',
        ]);
        //si le portefeuiille existe donc le modifier
        $SousProgramme = SousProgramme::where('num_sous_prog', $request->num_sous_prog)->first();
        if ($SousProgramme) {
            $SousProgramme->nom_sous_prog = $request->nom_sous_prog;
            $SousProgramme->AE_sous_prog=floatval($request->AE_sous_prog);
            $SousProgramme->CP_sous_prog=floatval($request->CP_sous_prog);
            $SousProgramme->date_insert_sousProg = $request->date_insert_sousProg;
            $SousProgramme->save();
            return response()->json([
                'success' => true,
                'message' => 'Sous programme ajouté avec succès.',
                'code' => 404,
            ]);
        }
        else{
            $SousProgramme = new SousProgramme();
            $SousProgramme->num_sous_prog = $request->num_sous_prog;
            $SousProgramme->num_prog = $request->id_program;
            $SousProgramme->nom_sous_prog = $request->nom_sous_prog;
            $SousProgramme->AE_sous_prog=floatval($request->AE_sous_prog);
            $SousProgramme->CP_sous_prog=floatval($request->CP_sous_prog);
            $SousProgramme->date_insert_sousProg = $request->date_insert_sousProg;
            $SousProgramme->save();


            //insertion des T
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
            $initPort->date_init = $request->date_insert_sousProg;
            $initPort->num_sous_prog = $request->num_sous_prog;


            $initPort->save();

        }
        dd($request);
        //  dd($SousProgramme);
        if ($SousProgramme && $initPort) {
            return response()->json([
                'success' => true,
                'message' => 'Sous programme ajouté avec succès.',
                'code' => 200,
            ]);
            //dd($SousProgramme);

        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'ajout du sous programme.',
                'code' => 500,
            ]);
        }


    }
}
