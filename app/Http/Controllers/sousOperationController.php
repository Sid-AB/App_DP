<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  

class sousOperationController extends Controller
{

    function AffichePortsAction ($port,$prog,$sous_prog,$act)
    {


  try {
            // dd($s_act, $T);
       //get toutes les données des 3 tables 
       $groupOperations = DB::table('group_operations as go')
       ->leftJoin('operations as o', 'go.code_grp_operation', '=', 'o.code_grp_operation')
       ->leftJoin('sous_operations as so', 'o.code_operation', '=', 'so.code_operation')
       ->select('go.*', 'o.*', 'so.*')
       ->where('go.num_sous_action',$act)
       ->get();
    //   dd($groupOperations);

       // creer un tableau pour structurer les données 
       $results = [
           'T1' => [],
           'T2' => [],
           'T3' => [],
           'T4' => []
       ];
       $someT1AE=0;
       $someT1CP=0;
       $someT2AE=0;
       $someT2CP=0;
       $someT3AE=0;
       $someT3CP=0;
       $someT4AE=0;
       $someT4CP=0;
       //parcourir les resultats 
       foreach ($groupOperations as $grpoperation) {
           //initialiser t pour dire quel t appartient les ae et cp
           $t= '';

           if ($grpoperation->code_t1==10000) {
               $t = 'T1';
           } elseif ($grpoperation->code_t2==20000) {
               $t = 'T2';
           } elseif ($grpoperation->code_t3==30000) {
               $t = 'T3';
           } elseif ($grpoperation->code_t4==40000) {
               $t = 'T4';
           }else{ $t = 'Non défini';}

           if ($t  ) {
            $someT1AE+=$grpoperation->AE_sous_operation;
            $someT1CP+=$grpoperation->CP_sous_operation;
            $someT2AE+=$grpoperation->AE_ouvert+$grpoperation->AE_atendu;
            $someT2CP+=$grpoperation->CP_ouvert + $grpoperation->CP_atendu;
            $someT3AE+=$grpoperation->AE_notifie+$grpoperation->AE_reporte+$grpoperation->AE_engage;
            $someT3CP+=$grpoperation->CP_reporte + $grpoperation->CP_notifie+ $grpoperation->CP_consome;
           $data = [
               'AE_sous_operation' => $grpoperation->AE_sous_operation,
               'CP_sous_operation' => $grpoperation->CP_sous_operation,
               'AE_ouvert' => $grpoperation->AE_ouvert,
               'AE_attendu' => $grpoperation->AE_atendu,
               'CP_ouvert' => $grpoperation->CP_ouvert,
               'CP_attendu' => $grpoperation->CP_atendu,
               'AE_notifie' => $grpoperation->AE_notifie,
               'AE_reporte' => $grpoperation->AE_reporte,
               'AE_engage' => $grpoperation->AE_engage,
               'CP_reporte' => $grpoperation->CP_reporte,
               'CP_notifie' => $grpoperation->CP_notifie,
               'CP_consomme' => $grpoperation->CP_consome,
               'SomeT1AE'=> $someT1AE,
               'SomeT1CP'=>   $someT1CP,
               'SomeT2AE'=> $someT2AE,
               'SomeT2CP'=>   $someT2CP,
               'SomeT3AE'=> $someT3AE,
               'SomeT3CP'=>   $someT3CP,
               'SomeT4AE'=> $someT4AE,
               'SomeT4CP'=>   $someT4CP
           ];

           // supprimer les champs avec des valeurs null pour eviter t1 avec d'autres ae et  cp 
           $data = array_filter($data, function ($value) {
               return !is_null($value);
           });

           // ajouter les données dans le tableau results
           if (!empty($data)) {
               $results[$t][] = [
                   'code_grp_operation' => $grpoperation->code_grp_operation,
                   'code_operation' => $grpoperation->code_operation,
                   'code_sous_operation' => $grpoperation->code_sous_operation,
                   'AE_CP' => $data
               ];

           
           }
              
       } 
       }
      /* dd($someT1AE,
       $someT1CP,
       $someT2AE,
       $someT2CP,
       $someT3AE,
       $someT3CP,
       $someT4AE,
       $someT4CP,);*/
       $someall=['T1AE'=>$someT1AE,
       'T1CP'=>$someT1CP,
       'T2AE'=>$someT2AE,
       'T2CP'=>$someT2CP,
       'T3AE'=>$someT3AE,
       'T3CP'=>$someT3CP,
       'T4AE'=>$someT4AE,
       'T4CP'=>$someT4CP,];
     //  dd($someall);
           //retourner results
           return view('Action-in.index',compact('port','prog','sous_prog','act','someall'));
   
       } catch (\Exception $e) {
           // en cas d'erreur retourner un message d'erreur 
           return response()->view('errors.not_found', [], 404);
       }
   
   
    }

    function AffichePortsSousAct ($port,$prog,$sous_prog,$act,$s_act)
    {
        try {
            // dd($s_act, $T);
       //get toutes les données des 3 tables 
       $groupOperations = DB::table('group_operations as go')
       ->leftJoin('operations as o', 'go.code_grp_operation', '=', 'o.code_grp_operation')
       ->leftJoin('sous_operations as so', 'o.code_operation', '=', 'so.code_operation')
       ->select('go.*', 'o.*', 'so.*')
       ->where('go.num_sous_action',$s_act)
       ->get();
    //   dd($groupOperations);

       // creer un tableau pour structurer les données 
       $results = [
           'T1' => [],
           'T2' => [],
           'T3' => [],
           'T4' => []
       ];
       $someT1AE=0;
       $someT1CP=0;
       $someT2AE=0;
       $someT2CP=0;
       $someT3AE=0;
       $someT3CP=0;
       $someT4AE=0;
       $someT4CP=0;
       //parcourir les resultats 
       foreach ($groupOperations as $grpoperation) {
           //initialiser t pour dire quel t appartient les ae et cp
           $t= '';

           if ($grpoperation->code_t1==10000) {
               $t = 'T1';
           } elseif ($grpoperation->code_t2==20000) {
               $t = 'T2';
           } elseif ($grpoperation->code_t3==30000) {
               $t = 'T3';
           } elseif ($grpoperation->code_t4==40000) {
               $t = 'T4';
           }else{ $t = 'Non défini';}

           if ($t  ) {
            $someT1AE+=$grpoperation->AE_sous_operation;
            $someT1CP+=$grpoperation->CP_sous_operation;
            $someT2AE+=$grpoperation->AE_ouvert+$grpoperation->AE_atendu;
            $someT2CP+=$grpoperation->CP_ouvert + $grpoperation->CP_atendu;
            $someT3AE+=$grpoperation->AE_notifie+$grpoperation->AE_reporte+$grpoperation->AE_engage;
            $someT3CP+=$grpoperation->CP_reporte + $grpoperation->CP_notifie+ $grpoperation->CP_consome;
           $data = [
               'AE_sous_operation' => $grpoperation->AE_sous_operation,
               'CP_sous_operation' => $grpoperation->CP_sous_operation,
               'AE_ouvert' => $grpoperation->AE_ouvert,
               'AE_attendu' => $grpoperation->AE_atendu,
               'CP_ouvert' => $grpoperation->CP_ouvert,
               'CP_attendu' => $grpoperation->CP_atendu,
               'AE_notifie' => $grpoperation->AE_notifie,
               'AE_reporte' => $grpoperation->AE_reporte,
               'AE_engage' => $grpoperation->AE_engage,
               'CP_reporte' => $grpoperation->CP_reporte,
               'CP_notifie' => $grpoperation->CP_notifie,
               'CP_consomme' => $grpoperation->CP_consome,
               'SomeT1AE'=> $someT1AE,
               'SomeT1CP'=>   $someT1CP,
               'SomeT2AE'=> $someT2AE,
               'SomeT2CP'=>   $someT2CP,
               'SomeT3AE'=> $someT3AE,
               'SomeT3CP'=>   $someT3CP,
               'SomeT4AE'=> $someT4AE,
               'SomeT4CP'=>   $someT4CP
           ];

           // supprimer les champs avec des valeurs null pour eviter t1 avec d'autres ae et  cp 
           $data = array_filter($data, function ($value) {
               return !is_null($value);
           });

           // ajouter les données dans le tableau results
           if (!empty($data)) {
               $results[$t][] = [
                   'code_grp_operation' => $grpoperation->code_grp_operation,
                   'code_operation' => $grpoperation->code_operation,
                   'code_sous_operation' => $grpoperation->code_sous_operation,
                   'AE_CP' => $data
               ];

           
           }
              
       } 
       }
      /* dd($someT1AE,
       $someT1CP,
       $someT2AE,
       $someT2CP,
       $someT3AE,
       $someT3CP,
       $someT4AE,
       $someT4CP,);*/
       $someall=['T1AE'=>$someT1AE,
       'T1CP'=>$someT1CP,
       'T2AE'=>$someT2AE,
       'T2CP'=>$someT2CP,
       'T3AE'=>$someT3AE,
       'T3CP'=>$someT3CP,
       'T4AE'=>$someT4AE,
       'T4CP'=>$someT4CP,];
           //retourner results
           return view('Action-in.index',compact('port','prog','sous_prog','act','s_act','someall'));
   
       } catch (\Exception $e) {
           // en cas d'erreur retourner un message d'erreur 
           return response()->view('errors.not_found', [], 404);
       }
   
   }

        
   
}
