<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  
use App\Services\CalculDpia;
use App\Models\SousOperation;
use App\Models\SousProgramme;
use Barryvdh\DomPDF\Facade\pdf;
use Illuminate\Support\Facades\Storage;
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
        //dd($act1);
        if(count($act1) > 1)
        {
            $act=$act1[1];
        }
      //  dd($port,$prog,$sous_prog,$act);
            try{
        $resultats = $this->CalculDpia->calculdpiaFromPath($port, $prog, $sous_prog, $act,$act);
        //dd($resultats);
           return view('Action-in.index',compact('port','prog','sous_prog','act','resultats'));
   
       } catch (\Exception $e) {
           // en cas d'erreur retourner un message d'erreur 
           return response()->view('errors.not_found', [], 404);
       }
   
   
    }

    function AffichePortsSousAct ($port,$prog,$sous_prog,$act,$s_act)
    {
        $s_act1=explode('_',$s_act);
        //dd($act1);
        if(count($s_act1) > 1)
        {
            $s_act=$s_act1[1];
        }
      //dd($port,$prog,$sous_prog,$act,$s_act);
      //$resultats = $this->CalculDpia->calculdpiaFromPath($port, $prog, $sous_prog, $act,$s_act);
     // dd($resultats);
        try{
            $resultats = $this->CalculDpia->calculdpiaFromPath($port, $prog, $sous_prog, $act,$s_act);
               return view('Action-in.index',compact('port','prog','sous_prog','act','s_act','resultats'));
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
         // Vérification de la présence des clés 'sousOperation', 'operation', 'group' et 'total'
         $resultstructur = [];
         foreach (['T1', 'T2', 'T3', 'T4'] as $t) {
             if (isset($resultats[$t])) {
                 $tdata = $resultats[$t];
 
                // dump($tdata);
                 $resultstructur[$t] = [
                     'sousOperation' => $tdata['sousOperation'] ?? [], 
                     'operation' => $tdata['operation'] ?? [],
                     'group' => $tdata['group'] ?? [],
                     'total' => $tdata['total'] ?? [],
                 ];
               
             }
         } 
         //dd($tdata);
               // envoyer les résultats en JSON
               $pdf=pdf::loadView('impression.liste_impression', compact('resultstructur','sousProgramme','names'));
               return $pdf->download('liste_impression.pdf');
           // return response()->json($resultats);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        }
   
 
   }


        
   

