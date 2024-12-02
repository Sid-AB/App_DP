<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  
use App\Services\CalculDpia;
use App\Models\SousOperation;
use App\Models\SousProgramme;
use App\Models\Portefeuille;
use Barryvdh\DomPDF\Facade\pdf;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
class sousOperationController extends Controller
{

    protected $CalculDpia;

    public function __construct(CalculDpia $CalculDpia)
    {
        $this->CalculDpia = $CalculDpia;
    }


    function AffichePortsAction ($port,$prog,$sous_prog,$act)
    {

        $act1=explode('_',$act);
        $years=Portefeuille::where('num_portefeuil',$port)->firstOrFail();
        $years = Carbon::parse($years->Date_portefeuille)->year;
        //dd($act1);
        if(count($act1) > 1)
        {
            $act=$act1[1];
        }
      //  dd($port,$prog,$sous_prog,$act);
            try{
        $resultats = $this->CalculDpia->calculdpiaFromPath($port, $prog, $sous_prog, $act,$act);
        //dd($resultats);
           return view('Action-in.index',compact('port','prog','sous_prog','act','resultats','years'));
   
       } catch (\Exception $e) {
           // en cas d'erreur retourner un message d'erreur 
           return response()->view('errors.not_found', [], 404);
       }
   
   
    }

    function AffichePortsSousAct ($port,$prog,$sous_prog,$act,$s_act)
    {
        $s_act1=explode('_',$s_act);
        //dd($act1);

        $years=Portefeuille::where('num_portefeuil',$port)->firstOrFail();
        $years = Carbon::parse($years->Date_portefeuille)->year;
        if(count($s_act1) > 1)
        {
            $s_act=$s_act1[1];
        }
      //dd($port,$prog,$sous_prog,$act,$s_act);
      //$resultats = $this->CalculDpia->calculdpiaFromPath($port, $prog, $sous_prog, $act,$s_act);
     // dd($resultats);
        try{
            $resultats = $this->CalculDpia->calculdpiaFromPath($port, $prog, $sous_prog, $act,$s_act);
               return view('Action-in.index',compact('port','prog','sous_prog','act','s_act','resultats','years'));
           } catch (\Exception $e) {
               // en cas d'erreur retourner un message d'erreur 
               return response()->view('errors.not_found', [], 404);
           }


       
   }
 

   

   public function impressionpdf($port, $prog, $sous_prog, $act,$s_act)
   {
        try {
            //dd($port, $prog, $sous_prog, $act,$s_act);
            $resultats = $this->CalculDpia->calculdpiaFromPath($port, $prog, $sous_prog, $act,$s_act);
          //dd($resultats );

          // Chargement du fichier JSON
        $jsonData = file_get_contents(public_path('assets/titre/dataT1.json')); //la fonction file_get_contents() lire directement depuis le système de fichiers :
      //dd($jsonData);  
        $operations = json_decode($jsonData, true); // décoder en tableau 
        //dd($operations);  

        $names = [];
        foreach ($operations as $code => $name) {
            $code_separer = explode('-', $code);  // séparer le code
            $code_part = end($code_separer);  // la derniere partie du code pour que soit adaptable au code_sous_op
            $names[$code_part] = $name;  
        }
       // dd( $names);
        //envoyer le sousprogramme dans compact avec son code  
           $sousProgramme = SousProgramme::where('num_sous_prog', $sous_prog)->first();
           //dd($sousProgramme );
           // vérifier si le sous programme existe
           if (!$sousProgramme) {
            throw new \Exception("Sous programme introuvable");
        }

            // pour bien structurer les données de resultats (calcul dpia)
         $resultstructur = [];
         foreach (['T1', 'T2', 'T3', 'T4'] as $t) {
             if (isset($resultats[$t])) {
                 $tdata = $resultats[$t];
 
                 // chaque grp avec leurs sous operations
                 $groupedData = [];
                 foreach ($tdata['group'] as $group) {
                     $groupCode = $group['code'];
                    // dd($groupCode);
                    $groupedData[$groupCode] = [
                        'group' => $group,
                        'operations' => [],
                    ];
                 }
               // dd( $groupedData);
               foreach ($tdata['operation'] as $operation) {
                $groupCode = substr($operation['code'], 0, strlen($operation['code']) - 6); //extraire depuis l'op jusqu'à grp 
                //dd($groupCode);
                if (isset($groupedData[$groupCode])) {
                    //ajouter les op au grp
                    $groupedData[$groupCode]['operations'][] = [
                        'operation' => $operation,
                        'sousOperations' => [],  
                    ];
                }
            } 
          // dd( $groupedData);
            // les sous operations dans operations 
            foreach ($tdata['sousOperation'] as $sousOp) {
                $operationCode = substr($sousOp['code'], 0, strlen($sousOp['code']) - 6); // extraire depuis sousOp jusqu'à opération
                $sousOpSuffix = substr($sousOp['code'], -5); //extraire les 5 chiffres de sousop
                $sousOpThird = substr($sousOpSuffix, 2, 1); //extraire le 3eme chiffre commencé par la fin 

               //dd($operationCode ,$sousOpSuffix,$sousOpThird);
                foreach ($groupedData as $groupCode => $groupData) {
                    foreach ($groupData['operations'] as $code => $operationData) { //0=>operationdata
                         // extraire les 5  chiffres de l'op
                    $operationSuffix = substr($operationData['operation']['code'], -5); 
                    $operationThird = substr($operationSuffix, 2, 1); // extraire le 3eme chiffre
                      //dd($operationSuffix ,$operationThird);
                        if (substr($operationData['operation']['code'], 0, strlen($operationCode)) === $operationCode) {
                            if ($sousOp['code'] === $operationData['operation']['code']) {
                                //si sousop = code op on l'affiche pas 
                                continue;
                               
                            } 
                             if  ($sousOpThird === $operationThird){
                           //ajouter sous op
                            $groupedData[$groupCode]['operations'][$code]['sousOperations'][] = $sousOp;
                            }
                        }
                    } 
                }
            }
            //dd($sousOp['code'] );
           // dd( $operationData['operation']['code'] );
            $resultstructur[$t] = [
                'groupedData' => $groupedData,
                'total' => $tdata['total'] ?? [], 
                // Ajoute le total (si disponible)
            ];//dd($resultstructur ['T1']); 
             }
         }
    
        
               // envoyer les résultats en JSON
               /*$pdf=pdf::loadView('impression.liste_impression', compact('resultstructur','sousProgramme','names'));
               return $pdf->download('liste_impression.pdf');*/
               return view('impression.liste_impression', compact('resultstructur','sousProgramme','names'));
           // return response()->json($resultats);
        } catch (\Exception $e) { 
            return response()->json(['error' => $e->getMessage()], 400);
        }
        }
   
 
   }


        
   

