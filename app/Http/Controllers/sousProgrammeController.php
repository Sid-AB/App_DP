<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\initPort;
use Illuminate\Http\Request;
use App\Models\SousProgramme;
use App\Models\SousAction;
use App\Models\Programme;

use App\Http\Controllers\Controller;

class sousProgrammeController extends Controller
{

//===================================================================================
                            //affichage du SousProgramme
//===================================================================================
    function affich_sou_prog()
    {
        // Récupérer les SousProgramme qui ont le même num_prog
            $SousProgramme = SousProgramme::get();
           // dd($SousProgramme);
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
           //  return view('Portfail-in.index', compact('SousProgramme'));
    }

//===================================================================================
                                //DEBUT CHECK
//===================================================================================

public function check_sous_prog(Request $request)
{
    $sousprog = SousProgramme::where('num_sous_prog', $request->num_sous_prog)->first();
    $initPort = initPort::where('num_sous_prog', $request->num_sous_prog)->first();
    // Vérification des données
    //dd($request);
    if ($sousprog && $initPort) {
        return response()->json([
            'exists' => true,

            'num_sous_prog'=>$sousprog->num_sous_prog,
            'nom_sous_prog' => $sousprog->nom_sous_prog,
            'date_insert_sousProg' => $sousprog->date_insert_sousProg,
            'num_prog' =>$sousprog->num_prog,

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
    else
    {
       
        if(isset($initPort) )
        {
           // dd($initPort);
            return response()->json([
                'exists' => true,
    
                'num_sous_prog'=>$sousprog->num_sous_prog,
                'nom_sous_prog' => $sousprog->nom_sous_prog,
                'date_insert_sousProg' => $sousprog->date_insert_sousProg,
                'num_prog' =>$sousprog->num_prog,
    
                'AE_sous_prog' =>$sousprog->AE_sous_prog,
                'CP_sous_prog' => $sousprog->CP_sous_prog,
    
                'T1_AE_init' => 0,
                'T1_CP_init' => 0,
    
                'T2_AE_init' => 0,
                'T2_CP_init' =>0,
    
                'T3_AE_init' => 0,
                'T3_CP_init' => 0,
    
                'T4_AE_init' => 0,
                'T4_CP_init' =>0,
            ]);
        }


    }


    return response()->json(['exists' => false]);
}
//===================================================================================
                            //FIN CHECK
//===================================================================================

//===================================================================================
                            // creation du SousProgramme
//===================================================================================
public function create_sou_prog(Request $request)
{
    // Validation des données
    $request->validate([
        'num_sous_prog' => 'required',
        'nom_sous_prog' => 'required',
        'date_insert_sousProg' => 'required|date',
        'AE_sous_prog' => 'nullable',
        'CP_sous_prog' => 'nullable',
        'T1_AE_init' => 'nullable',
        'T1_CP_init' => 'nullable',
        'T2_AE_init' => 'nullable',
        'T2_CP_init' => 'nullable',
        'T3_AE_init' => 'nullable',
        'T3_CP_init' => 'nullable',
        'T4_AE_init' => 'nullable',
        'T4_CP_init' => 'nullable',
        'code_t1' => 'nullable',
        'code_t2' => 'nullable',
        'code_t3' => 'nullable',
        'code_t4' => 'nullable',
        'id_program' => 'required',
    ]);

    // Vérifier si le sous-programme existe
    $sousProgramme = SousProgramme::where('num_sous_prog', $request->num_sous_prog)->first();
    $initPort = initPort::where('num_sous_prog', $request->num_sous_prog)->first();
 
    if ($sousProgramme) {
        // Mise à jour du sous-programme existant
        $sousProgramme->update([
            'nom_sous_prog' => $request->nom_sous_prog,
            'AE_sous_prog' =>floatval(str_replace(',', '', $request->AE_sous_prog)),
            'CP_sous_prog' => floatval(str_replace(',', '', $request->CP_sous_prog)),
            'date_update_sousProg' => now(),
        ]);

        if ($initPort) {
            // Mise à jour des données dans init_ports
            $initPort->update([
                'AE_init_t1' => floatval(str_replace(',', '', $request->T1_AE_init)),
                'CP_init_t1' => floatval(str_replace(',', '', $request->T1_CP_init)),
                'AE_init_t2' => floatval(str_replace(',', '', $request->T2_AE_init)),
                'CP_init_t2' => floatval(str_replace(',', '', $request->T2_CP_init)),
                'AE_init_t3' => floatval(str_replace(',', '', $request->T3_AE_init)),
                'CP_init_t3' => floatval(str_replace(',', '', $request->T3_CP_init)),
                'AE_init_t4' => floatval(str_replace(',', '', $request->T4_AE_init)),
                'CP_init_t4' => floatval(str_replace(',', '', $request->T4_CP_init)),
                'date_update_init' => now(),
            ]);
        }
        else
        {
              // Création des données dans init_ports
        initPort::create([
            'num_sous_prog' => $request->num_sous_prog,
            'date_init' => $request->date_insert_sousProg,
            'code_t1' => $request->code_t1,
            'code_t2' => $request->code_t2,
            'code_t3' => $request->code_t3,
            'code_t4' => $request->code_t4,
            'AE_init_t1' => floatval(str_replace(',', '', $request->T1_AE_init)),
            'CP_init_t1' => floatval(str_replace(',', '', $request->T1_CP_init)),
            'AE_init_t2' => floatval(str_replace(',', '', $request->T2_AE_init)),
            'CP_init_t2' => floatval(str_replace(',', '', $request->T2_CP_init)),
            'AE_init_t3' => floatval(str_replace(',', '', $request->T3_AE_init)),
            'CP_init_t3' => floatval(str_replace(',', '', $request->T3_CP_init)),
            'AE_init_t4' => floatval(str_replace(',', '', $request->T4_AE_init)),
            'CP_init_t4' => floatval(str_replace(',', '', $request->T4_CP_init)),
        ]);  
        }
    } else {
        // Création d'un nouveau sous-programme
        $sousProgramme = SousProgramme::create([
            'num_sous_prog' => $request->num_sous_prog,
            'num_prog' => $request->id_program,
            'nom_sous_prog' => $request->nom_sous_prog,
            'AE_sous_prog' => floatval(str_replace(',', '', $request->AE_sous_prog)),
            'CP_sous_prog' => floatval(str_replace(',', '', $request->CP_sous_prog)),
            'date_insert_sousProg' => $request->date_insert_sousProg,
        ]);
    // Création des données dans init_ports
    initPort::create([
        'num_sous_prog' => $request->num_sous_prog,
        'date_init' => $request->date_insert_sousProg,
        'code_t1' => $request->code_t1,
        'code_t2' => $request->code_t2,
        'code_t3' => $request->code_t3,
        'code_t4' => $request->code_t4,
        'AE_init_t1' => floatval(str_replace(',', '', $request->T1_AE_init)),
        'CP_init_t1' => floatval(str_replace(',', '', $request->T1_CP_init)),
        'AE_init_t2' => floatval(str_replace(',', '', $request->T2_AE_init)),
        'CP_init_t2' => floatval(str_replace(',', '', $request->T2_CP_init)),
        'AE_init_t3' => floatval(str_replace(',', '', $request->T3_AE_init)),
        'CP_init_t3' => floatval(str_replace(',', '', $request->T3_CP_init)),
        'AE_init_t4' => floatval(str_replace(',', '', $request->T4_AE_init)),
        'CP_init_t4' => floatval(str_replace(',', '', $request->T4_CP_init)),
    ]);
    
    }

    // Vérification finale
    if ($sousProgramme && (!$initPort || $initPort->exists)) {
        return response()->json([
            'success' => true,
            'message' => 'Sous programme mis à jour avec succès.',
            'code' => 200,
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'Erreur lors de l\'ajout ou de la mise à jour des données.',
        'code' => 500,
    ]);
}

function getprog($num_sous_prog)
{
    $prog=Programme::where('num_sous_prog',$num_sous_prog)
            ->join('sous_programmes','programmes.num_prog',"=","sous_programmes.num_prog")
            ->firstOrFail();
            //dd($prog);
    $act=SousAction::join('actions','actions.num_action','=',"sous_actions.num_action")->where('num_sous_prog',$num_sous_prog)->select('sous_actions.num_sous_action','sous_actions.nom_sous_action','actions.num_action','actions.nom_action')->get();
    //dd($act);
            if(isset($prog))
            {
                
            return response()->json( ['exists'=> true,'prog'=>$prog,'act'=>$act]);
            }else
            {

                return response()->json( ['exist'=> false]);
            }
}

}
