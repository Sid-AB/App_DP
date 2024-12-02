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
            //dd($SousProgramme);
        // Vérifier si des SousProgramme existent
            if ($SousProgramme->isEmpty()) {
                 return response()->json([
                    'success' => false,
                    'message' => 'Aucun Sous programme trouvé pour ce programme.',
                ]);
            }
            else
            {
                return response()->json([
                    'success' => true,
                    'result'=>$SousProgramme,
                    'message' => 'Sous programme trouvé pour ce programme.',
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
    $initPort = initPort::where('num_sous_prog', $request->num_sous_prog)->first();
    // Vérification des données
    if ($sousprog && $initPort) {
        return response()->json([
            'exists' => true,
            'nom_sous_prog' => $sousprog->nom_sous_prog,
            'date_insert_sousProg' => $sousprog->date_insert_sousProg,
            'AE_sous_prog' => $sousprog->AE_sous_prog,
            'CP_sous_prog' => $sousprog->CP_sous_prog,

            'T1_AE_init' => $initPort->AE_init_t1,
            'T1_CP_init' => $initPort->CP_init_t1,

            'T2_AE_init' => $initPort->AE_init_t2,
            'T2_CP_init' => $initPort->CP_init_t2,

            'T3_AE_init' => $initPort->AE_init_t3,
            'T3_CP_init' => $initPort->CP_init_t3,

            'T4_AE_init' => $initPort->AE_init_t4,
            'T4_CP_init' => $initPort->CP_init_t4,
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


    ]);
   // dd($request);
   $num_sous_prog=$request->num_sous_prog;
    // Vérifier si le sous-programme existe
    $SousProgramme = SousProgramme::where('num_sous_prog', $request->num_sous_prog)->first();
    $initPort = initPort::where('num_sous_prog', $request->num_sous_prog)->first();

    if ($SousProgramme) {
        // Mise à jour du sous-programme existant
        $SousProgramme->nom_sous_prog = $request->nom_sous_prog;
        $SousProgramme->AE_sous_prog = floatval($request->AE_sous_prog);
        $SousProgramme->CP_sous_prog = floatval($request->CP_sous_prog);
        $SousProgramme->date_insert_sousProg = $request->date_insert_sousProg;
        $SousProgramme->save();

        if ($initPort) {
            // update des données dans init_ports

                 $initPort->T1_AE_init= $request->T1_AE_init;
                 $initPort->T1_CP_init= $request->T1_CP_init;

                 $initPort->T2_AE_init= $request->T2_AE_init;
                 $initPort->T2_CP_init= $request->T2_CP_init;

                 $initPort->T3_AE_init= $request->T3_AE_init;
                 $initPort->T3_CP_init= $request->T3_CP_init;

                 $initPort->T4_AE_init=$request->T4_AE_init;
                 $initPort->T4_CP_init=$request->T4_CP_init;


            $initPort->save();


        }

    }
else {

    // Création d'un nouveau sous-programme
    $SousProgramme = SousProgramme::create([
        'num_sous_prog' => $request->num_sous_prog,
        'num_prog' => $request->id_program,
        'nom_sous_prog' => $request->nom_sous_prog,
        'AE_sous_prog' => floatval($request->AE_sous_prog),
        'CP_sous_prog' => floatval($request->CP_sous_prog),
        'date_insert_sousProg' => $request->date_insert_sousProg,
    ]);
    $SousProgramme->save();

     // Insertion des données dans init_ports
     $initPort = initPort::create([
        'num_sous_prog' =>$request->num_sous_prog,
        'date_init' => $request->date_insert_sousProg,
        'date_init' => $request->date_insert_sousProg,

        'code_t1' => $request->code_t1,
        'code_t2' => $request->code_t2,
        'code_t3' => $request->code_t3,
        'code_t4' => $request->code_t4,
        'AE_init_t1' => $request->T1_AE_init,
        'CP_init_t1' => $request->T1_CP_init,

        'AE_init_t2' => $request->T2_AE_init,
        'CP_init_t2' => $request->T2_CP_init,

        'AE_init_t3' => $request->T3_AE_init,
        'CP_init_t3' => $request->T3_CP_init,

        'AE_init_t4' => $request->T4_AE_init,
        'CP_init_t4' => $request->T4_CP_init,

    ]);
    $initPort->save();
}

// Vérifier si le sous-programme existe
/*$exist = initPort::where('num_sous_prog', $request->num_sous_prog)->first();
if (!$exist) {
    // Insertion des données dans init_ports
    $initPort = initPort::create([
        'num_sous_prog' =>$request->num_sous_prog,
        'date_init' => $request->date_insert_sousProg,
        'date_init' => $request->date_insert_sousProg,

        'code_t1' => $request->code_t1,
        'code_t2' => $request->code_t2,
        'code_t3' => $request->code_t3,
        'code_t4' => $request->code_t4,
        'AE_init_t1' => $request->T1_AE_init,
        'CP_init_t1' => $request->T1_CP_init,

        'AE_init_t2' => $request->T2_AE_init,
        'CP_init_t2' => $request->T2_CP_init,

        'AE_init_t3' => $request->T3_AE_init,
        'CP_init_t3' => $request->T3_CP_init,

        'AE_init_t4' => $request->T4_AE_init,
        'CP_init_t4' => $request->T4_CP_init,

    ]);
    $initPort->save();


}*/

if ($SousProgramme || $initPort) {
    return response()->json([
        'success' => true,
        'message' => 'Sous programme mis à jour avec succès.',
        'code' => 200,
    ]);
} else {
    return response()->json([
        'success' => false,
        'message' => 'Erreur lors de l\'ajout des données initiales.',
        'code' => 500,
    ]);
}


}

}
