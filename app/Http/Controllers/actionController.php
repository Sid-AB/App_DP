<?php

namespace App\Http\Controllers;

use App\Models\Action;
use Illuminate\Http\Request;
use App\Models\SousAction;
use App\Models\SousProgramme;
use App\Models\Programme;
use App\Models\initPort;

class actionController extends Controller
{
//===================================================================================
                            // affichage de l'action
//===================================================================================
    public function affich_action($num_action)
    {
        // Récupérer les action qui ont le même num_action
        $action = action::where('num_action', $num_action)->get();
    //    dd($action);

    // Vérifier si des action existent
        if ($action->isEmpty()) {
             return response()->json([
                'success' => false,
                'message' => 'Aucune action trouvée pour ce sous programme.',
            ]);
        }

    // Retourner les action à la vue
        return view('Action-in.index', compact('action'));
    }


//===================================================================================
                                //DEBUT CHECK
//===================================================================================

public function check_action(Request $request)
    {
        $action = Action::where('num_action', $request->num_action)->first();
        $initPort = initPort::where('num_action', $request->num_action)->first();
      //dd($initPort);
       //dd($request);
        if ($action  && $initPort) {
            return response()->json([
                'exists' => true,
                'num_action' => $action->num_action,
                'nom_action' => $action->nom_action,
                'type_action' => $action->type_action,
                'date_insert_action' => $action->date_insert_action,
                'AE_act'=>$action->AE_action,
                'CP_act'=>$action->CP_action,


                
                'T1_AE_init' => $initPort->AE_init_t1,
                'T1_CP_init' => $initPort->CP_init_t1,

                'T2_AE_init' => $initPort->AE_init_t2,
                'T2_CP_init' => $initPort->CP_init_t2,

                'T3_AE_init'    => $initPort->AE_init_t3,
                'T3_CP_init' => $initPort->CP_init_t3,

                'T4_AE_init' => $initPort->AE_init_t4,
                'T4_CP_init' => $initPort->CP_init_t4,
            ]);
          
        }
        else
        {
            if(!isset($initPort))
            {
                return response()->json([
                    'exists' => true,
        
                    'num_action' => $action->num_action,
                    'nom_action' => $action->nom_action,
                    'type_action' => $action->type_action,
                    'date_insert_action' => $action->date_insert_action,
                    'AE_act'=>$action->AE_action,
                    'CP_act'=>$action->CP_action,
            
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
                            // creation de l'action
//===================================================================================
    function create_action(Request $request)
    {
       //dd($request);
        // Validation des données
        $request->validate([
            'num_action' => 'required',
            'nom_action' => 'required',
            'date_insert_action' => 'required|date',
        ]);
        //si l action existe donc le modifier
        $action = action::where('num_action', $request->num_action)->first();
        $num_act= $request->num_action .'-01';
        //dd($num_act);
        $initPort = initPort::where('num_action', $request->num_action)->first();
        // dd($initPort);
        $sousaction = sousaction::where('num_sous_action', $request->num_act)->first();
        //dd($sousaction);
    if ($action) {
        $action->nom_action = $request->nom_action;
        $action->AE_action=floatval(str_replace(',', '', $request->AE_act));
        $action->CP_action=floatval(str_replace(',', '', $request->CP_act));
        $action->type_action = $request->action_delege;
        $action->id_ra = 1;//periodiquement
        $action->date_update_action = now();
        $action->save();

        if ($sousaction) {
            $sousaction->nom_sous_action = $request->nom_action;
            $sousaction->AE_sous_action=floatval(str_replace(',', '', $request->AE_act));
            $sousaction->CP_sous_action=floatval(str_replace(',', '', $request->CP_act));
            $sousaction->date_update_sous_action = now();
            $sousaction->save();
        }
            if ($initPort) {
                // Mise à jour des données dans init_ports
                //dd($request->T1_AE_init_AC);
                $initPort->update([
                    'AE_init_t1' =>floatval(str_replace (',', '', $request->T1_AE_init_AC)),
                    'CP_init_t1' => floatval(str_replace (',', '', $request->T1_CP_init_AC)),
                    'AE_init_t2' => floatval(str_replace (',', '', $request->T2_AE_init_AC)),
                    'CP_init_t2' => floatval(str_replace (',', '', $request->T2_CP_init_AC)),
                    'AE_init_t3' => floatval(str_replace (',', '', $request->T3_AE_init_AC)),
                    'CP_init_t3' => floatval(str_replace (',', '', $request->T3_CP_init_AC)),
                    'AE_init_t4' => floatval(str_replace (',', '', $request->T4_AE_init_AC)),
                    'CP_init_t4' => floatval(str_replace (',', '', $request->T4_CP_init_AC)),
                    'date_update_init' => now(),
                ]);
            }
            else
            {
                // Création des données dans init_ports
            initPort::create([
                'num_sous_prog' => $request->id_sous_prog,
                'num_action' => $request->num_action,
                'date_init' => $request->date_insert_action,
                'date_update_init' => now(),
                'code_t1' => $request->code_t1,
                'code_t2' => $request->code_t2,
                'code_t3' => $request->code_t3,
                'code_t4' => $request->code_t4,
                'AE_init_t1' => floatval(str_replace (',', '',$request->T1_AE_init_AC)),
                'CP_init_t1' => floatval(str_replace (',', '',$request->T1_CP_init_AC)),
                'AE_init_t2' => floatval(str_replace (',', '',$request->T2_AE_init_AC)),
                'CP_init_t2' => floatval(str_replace (',', '',$request->T2_CP_init_AC)),
                'AE_init_t3' => floatval(str_replace (',', '',$request->T3_AE_init_AC)),
                'CP_init_t3' =>floatval(str_replace (',', '', $request->T3_CP_init_AC)),
                'AE_init_t4' => floatval(str_replace (',', '',$request->T4_AE_init_AC)),
                'CP_init_t4' => floatval(str_replace (',', '',$request->T4_CP_init_AC)),
            ]);  
            }
                                   
         $num_sousact = sousaction::where('num_action', $request->num_action)->value('num_sous_action');
         //dd($num_sousact);
            // Récupérer l'action en chargeant les relations nécessaires
                $action = Action::with('SousProgramme.Programme')
                ->where('num_action', $request->num_action)
                ->first();
         $numPortef = $action->sousProgramme->programme->num_portefeuil ?? null;
         $count_sousact = sousaction::where('num_action', $request->num_action)->count();
        //dd($num_sousact);
         if ($action && $num_sousact) {
             return response()->json([
                 'num_sous_action' => $num_sousact,
                 'count_sous_action' => $count_sousact,
                 'numPortef' => $numPortef,
                 'success' => true,
                 'message' => 'Action ajouté avec succès.',
                 'code' => 404,
             ]);
         } else {
             return response()->json([
                 'success' => false,
                 'message' => 'Erreur lors de l\'ajout de l\'action.',
                 'code' => 500,
             ]);
         }


    }
        else{
        // Créer une nouvelle action
        $action = new action();
        $action->num_action = $request->num_action;
        $action->num_sous_prog =$request->id_sous_prog;
        $action->nom_action = $request->nom_action;
        $action->type_action = $request->action_delege;
        $action->AE_action=floatval(str_replace(',', '', $request->AE_act));
        $action->CP_action=floatval(str_replace(',', '', $request->CP_act));
        $action->id_ra = 1;//periodiquement
        $action->date_insert_action = $request->date_insert_action;

        $action->save();


         // Créer une nouvelle sous action
         $sousaction = new sousAction();
         $num_act= $request->num_action .'-01';
        //dd($num_act);
         $sousaction->num_action = $request->num_action;
         $sousaction->num_sous_action = $num_act;
         $sousaction->nom_sous_action = $request->nom_action;
         $sousaction->AE_sous_action=floatval(str_replace(',', '', $request->AE_act));
         $sousaction->CP_sous_action=floatval(str_replace(',', '', $request->CP_act));
         $sousaction->date_insert_sous_action = $request->date_insert_action;

        // dd($sousaction);
         $sousaction->save();

         $num_sousact = sousaction::where('num_action', $request->num_action)->value('num_sous_action');
         //dd($num_sousact);

         
            // Récupérer l'action en chargeant les relations nécessaires
                $action = Action::with('SousProgramme.Programme')
                ->where('num_action', $request->num_action)
                ->first();
         $numPortef = $action->sousProgramme->programme->num_portefeuil ?? null;
         $count_sousact = sousaction::where('num_action', $request->num_action)->count();
        //dd($num_sousact);

          // Création des données dans init_ports
          initPort::create([
            'num_sous_prog' => $request->id_sous_prog,
            'num_action' => $request->num_action,
            'date_init' => $request->date_insert_action,
            'date_update_init' => now(),
            'code_t1' => $request->code_t1,
            'code_t2' => $request->code_t2,
            'code_t3' => $request->code_t3,
            'code_t4' => $request->code_t4,
            'AE_init_t1' => floatval(str_replace (',', '',$request->T1_AE_init_AC)),
            'CP_init_t1' => floatval(str_replace (',', '',$request->T1_CP_init_AC)),
            'AE_init_t2' => floatval(str_replace (',', '',$request->T2_AE_init_AC)),
            'CP_init_t2' => floatval(str_replace (',', '',$request->T2_CP_init_AC)),
            'AE_init_t3' => floatval(str_replace (',', '',$request->T3_AE_init_AC)),
            'CP_init_t3' => floatval(str_replace (',', '',$request->T3_CP_init_AC)),
            'AE_init_t4' => floatval(str_replace (',', '',$request->T4_AE_init_AC)),
            'CP_init_t4' =>floatval(str_replace (',', '', $request->T4_CP_init_AC)),

        ]);
    
              if ( $action && $sousaction) {
                  return response()->json([
                        'num_sous_action' => $num_sousact,
                        'count_sous_action' => $count_sousact,
                        'numPortef' => $numPortef,
                      'success' => true,
                      'message' => 'Action ajouté avec succès.',
                      'code' => 200,
                  ]);
              } else {
                  return response()->json([
                      'success' => false,
                      'message' => 'Erreur lors de l\'ajout de l\'action.',
                      'code' => 500,
                  ]);
              }

              if ($action && (!$initPort || $initPort->exists)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Action mis à jour avec succès.',
                    'code' => 200,
                ]);
            }
          }
    }



}
