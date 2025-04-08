<?php

namespace App\Http\Controllers;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 


use App\Services\CalculDpia;
use App\Models\SousOperation;
use App\Models\Portefeuille;
use App\Models\Programme;
use App\Models\SousProgramme;
use App\Models\Action;
use App\Models\SousAction;
use App\Models\initPort;
use App\Models\Emploi_budget;
use App\Models\Fonctions;
use App\Models\Post_sup;
use App\Models\Post_commun;
use App\Models\OpConducteur;
use App\Models\CDI;
use App\Models\CDD;
use App\Models\Accounts;

use Barryvdh\DomPDF\Facade\pdf;
use Illuminate\Support\Facades\Storage;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Mpdf\Mpdf;
use Carbon\Carbon;
use App\Jobs\GeneratePDFJob;
class sousOperationController extends Controller
{

    protected $CalculDpia;

    public function __construct(CalculDpia $CalculDpia)
    {
        $this->CalculDpia = $CalculDpia;
    }


    function modif_handler($id,Request $request)
    {
        $oprt=$id;
        $chek=explode("_",$oprt);
        $ae_glob=0;
        $cp_glob=0;
        $nom="";
        $code="";
        $codes=$request['code'];
        
        if(!isset($codes))
        {
            return back()->with('unsuccess', 'User registered indefined!');
        }
        $init_value=['ae_T1'=>0,
        'cp_T1'=>0,
        'ae_T2'=>0,
        'cp_T2'=>0,
        'ae_T3'=>0,
        'cp_T3'=>0,
        'ae_T4'=>0,
        'cp_T4'=>0,];
        $date="";
        if(count($chek) > 0)
        {
            if($chek[1] == 'portf')
            {
                $leng=2;
                $progms=Portefeuille::where('num_portefeuil',$chek[0])->first();
                $ae_glob=$progms->AE_portef;
                $cp_glob=$progms->CP_portef;
                $nom=$progms->nom_journal;
                $code=$progms->num_portefeuil;
                $date=$progms->Date_portefeuille;
                $ref=$progms->num_journal;
                $paths=['code_port'=>$progms->num_portefeuil];
                $getcode=explode('-',$code);
                $code=$getcode[0];
                $account =Accounts::join('portefeuilles','portefeuilles.id_min','accounts.id_min')->where('code_generated',$codes)->where('portefeuilles.num_portefeuil',$progms->num_portefeuil)->first();
                // dd($act,$account,$code);
                  if(!isset($account))
                 {
                     return back()->with('unsuccess', 'User registered indefined!');
                 }
                //dd($progms);
                    return view('Portfail-in.modif',compact('ae_glob','cp_glob','nom','code','date','init_value','leng','paths','ref'));
            }
                if($chek[1] =='prog')
                {
                    $leng=count(explode('-',$chek[0]));
                    //dd($leng);
                    $progms=Programme::where('num_prog',$chek[0])->first();
                $ae_glob=$progms->AE_prog;
                $cp_glob=$progms->CP_prog;
                $nom=$progms->nom_prog;
                $code=$progms->num_prog;
                $date=$progms->date_insert_portef;
                $paths=['code_port'=>$progms->num_portefeuil,'programme'=>$code];
                $getcode=explode('-',$code);
                $code=$getcode[count(explode('-',$code))-1];

                $account =Accounts::join('programmes','programmes.id_rp','accounts.id_rp')->where('code_generated',$codes)->where('programmes.num_prog',$progms->num_prog)->first();
                // dd($act,$account,$code);
                  if(!isset($account))
                 {
                     return back()->with('unsuccess', 'User registered indefined!');
                 }
                //dd($progms);
                    return view('Portfail-in.modif',compact('ae_glob','cp_glob','nom','code','date','init_value','leng','paths'));
                   
                }
                if($chek[1] =='sprog')
                {
                    $sprog=SousProgramme::where('num_sous_prog',$chek[0])->first();
                    $progms=Programme::where('num_prog',$sprog->num_prog)->first();
                    $leng=count(explode('-',$chek[0]));
                    //dd($sprog);
                    $ae_glob=$sprog->AE_sous_prog;
                    $cp_glob=$sprog->CP_sous_prog;
                    $nom=$sprog->nom_sous_prog;
                    $code=$sprog->num_sous_prog;
                    $date=$sprog->date_insert_sousProg;
                    $paths=['code_port'=>$progms->num_portefeuil,'programme'=>$progms->num_prog,'sous Programme'=>$code];
                  
                    $init=initPort::where('num_sous_prog',$code)->first();
                    if(empty($init->num_action)){
                    $init_value['ae_T1']=$init->AE_init_t1;
                    $init_value['cp_T1']=$init->CP_init_t1;
                    $init_value['ae_T2']=$init->AE_init_t2;
                    $init_value['cp_T2']=$init->CP_init_t2;
                    $init_value['ae_T3']=$init->AE_init_t3;
                    $init_value['cp_T3']=$init->CP_init_t3;
                    $init_value['ae_T4']=$init->AE_init_t4;
                    $init_value['cp_T4']=$init->CP_init_t4;}
                   // dd($init_value);
                    $getcode=explode('-',$code);
                    $code=$getcode[count(explode('-',$code))-1];
                    $account =Accounts::join('programmes','programmes.id_rp','accounts.id_rp')->where('code_generated',$codes)->where('programmes.num_prog',$progms->num_prog)->first();
                    // dd($act,$account,$code);
                      if(!isset($account))
                     {
                         return back()->with('unsuccess', 'User registered indefined!');
                     }
                    return view('Portfail-in.modif',compact('ae_glob','cp_glob','nom','code','date','init_value','leng','paths'));

                }
                else
                {
                   
                    $leng=count(explode('-',$chek[1]));
                    $act=Action::where('num_action',$chek[1])->first();
                    //dd($act);
                    $sprog=SousProgramme::where('num_sous_prog',$act->num_sous_prog)->first();
                    $progms=Programme::where('num_prog',$sprog->num_prog)->first();
                   // dd($act);
                    $ae_glob=$act->AE_action;
                    $cp_glob=$act->CP_action;
                    $nom=$act->nom_action;
                    $code=$act->num_action;
                    $date=$act->date_insert_action;

                    $init=initPort::where('num_action',$code)->first();
                    if(!empty($init->num_action)){
                    $init_value['ae_T1']=$init->AE_init_t1;
                    $init_value['cp_T1']=$init->CP_init_t1;
                    $init_value['ae_T2']=$init->AE_init_t2;
                    $init_value['cp_T2']=$init->CP_init_t2;
                    $init_value['ae_T3']=$init->AE_init_t3;
                    $init_value['cp_T3']=$init->CP_init_t3;
                    $init_value['ae_T4']=$init->AE_init_t4;
                    $init_value['cp_T4']=$init->CP_init_t4;}
                    //dd($init_value);
                    $paths=['code_port'=>$progms->num_portefeuil,'programme'=>$progms->num_prog,'sous Programme'=>$sprog->num_sous_prog,'Action'=>$code];
                    $getcode=explode('-',$code);
                    $code=$getcode[count(explode('-',$code))-1];
                    $account =Accounts::join('actions','actions.id_ra','accounts.id_ra')->where('code_generated',$codes)->where('actions.num_action',$act->num_action)->first();
                     //dd($act,$account,$codes);
                      if(!isset($account))
                     {
                         return back()->with('unsuccess', 'User registered indefined!');
                     }
                    return view('Portfail-in.modif',compact('ae_glob','cp_glob','nom','code','date','init_value','leng','paths'));
                }
        }
        else
        {
            return response()->view('errors.404', [], 404); 
        }
        dd($chek);
    }


    function AffichePortsAction ($port,$prog,$sous_prog,$act,Request $request)
    {

        $act1=explode('_',$act);
        if(count($act1) > 1)
        {
            $act=$act1[1];
        }
        $code=$request['code'];
        
        if(!isset($code))
        {
            return back()->with('unsuccess', 'User registered indefined!');
        }
        $account =Accounts::join('actions','actions.id_ra','accounts.id_ra')->where('code_generated',$code)->where('actions.num_action',$act)->first();
        $account =Accounts::join('actions','actions.id_ra','accounts.id_ra')
        ->join('sous_actions','sous_actions.num_action','actions.num_action')
        ->where('code_generated',$code)->where('sous_actions.num_action',$act)->first();
       // dd($act,$account,$code);
         if(!isset($account))
        {
            $account =Accounts::join('programmes','programmes.id_rp','accounts.id_rp')
                                ->join('sous_programmes','sous_programmes.num_prog','programmes.num_prog')
                                ->join('actions','actions.num_sous_prog','sous_programmes.num_sous_prog')
                                ->where('code_generated',$code)
                                ->where('actions.num_action',$act)
                                ->first();
            if(!isset($account))
            {
                $account =Accounts::join('programmes','programmes.id_rp','accounts.id_rp')
                ->join('portefeuilles','portefeuilles.num_portefeuil','programmes.num_portefeuil')
                ->join('sous_programmes','sous_programmes.num_prog','programmes.num_prog')
                ->join('actions','actions.num_sous_prog','sous_programmes.num_sous_prog')
                ->where('code_generated',$code)
                ->where('actions.num_action',$act)
                ->first();
            }
      
        // dd($act,$account);
         if(!isset($account))
         {
            return back()->with('unsuccess', 'User registered indefined!');
        }
        }
   
            $act=Action::where('num_action',$act)->first();
            $s_act=SousAction::where('num_action',$act)->first();
            $sprog=SousProgramme::where('num_sous_prog',$act->num_sous_prog)->first();
            $sact=SousAction::where('num_action',$act->num_action)->first();
            $progms=Programme::where('num_prog',$sprog->num_prog)->first();
            $act=$act->num_action;
            $sact=$sact->num_sous_action;
            $sous_prog=$sprog->num_sous_prog;
            $prog=$progms->num_prog;
            $port=$progms->num_portefeuil;


            $allEmploisBug=Emploi_budget::select('TRAITEMENT_ANNUEL', 'PRIMES_INDEMNITES', 'DEPENSES_ANNUELLES','EmploiesOuverts','EmploiesOccupes','EmploiesVacants')->get();

            $totaltrait = $allEmploisBug->sum('TRAITEMENT_ANNUEL');
            $totalprimes = $allEmploisBug->sum('PRIMES_INDEMNITES');
            $totaldepense = $allEmploisBug->sum('DEPENSES_ANNUELLES');
            $totalOuverts = $allEmploisBug->sum('EmploiesOuverts');
            $totalOccupes = $allEmploisBug->sum('EmploiesOccupes');
            $totalVacants = $allEmploisBug->sum('EmploiesVacants');
          //dd($totaltrait,$totalprimes,$totaldepense);
        $years=Portefeuille::where('num_portefeuil',$port)->firstOrFail();
        $years = Carbon::parse($years->Date_portefeuille)->year;
         if(!isset($sact)){
            $sact=$act;
         }
         //dd($port, $prog, $sous_prog, $act,$sact);
            try{
                $resultats = $this->CalculDpia->calculdpiaFromPath($port, $prog, $sous_prog, $act,$sact);
                //dd($port, $prog, $sous_prog, $act,$act);
       
        //dd($resultats);
           return view('Action-in.index',compact('port','prog','sous_prog','act','sact','resultats','years','totaltrait','totalprimes','totaldepense','totalOuverts','totalOccupes','totalVacants'));
   
       } catch (\Exception $e) {
           // en cas d'erreur retourner un message d'erreur 
           return response()->view('errors.not_found', [], 404);
       }
   
   
    }

    function AffichePortsSousAct ($port,$prog,$sous_prog,$act,$s_act,Request $request)
    {
        $s_act1=explode('_',$s_act);
        //dd($act1);

        $years=Portefeuille::where('num_portefeuil',$port)->firstOrFail();
        $years = Carbon::parse($years->Date_portefeuille)->year;
        if(count($s_act1) > 1)
        {
            $s_act=$s_act1[1];
        }
        $code=$request['code'];
        
        if(!isset($code))
        {
            return back()->with('unsuccess', 'User registered indefined!');
        }
        $account =Accounts::join('actions','actions.id_ra','accounts.id_ra')->where('code_generated',$code)->where('actions.num_action',$s_act)->first();
       // dd($act,$account,$code);
         if(!isset($account))
        {
         $account =Accounts::join('actions','actions.id_ra','accounts.id_ra')
         ->join('sous_actions','sous_actions.num_action','actions.num_action')
         ->where('code_generated',$code)->where('sous_actions.num_action',$s_act)->first();
         //dd($act,$account);
         if(!isset($account))
         {
            return back()->with('unsuccess', 'User registered indefined!');
         }
        }
        $s_act=SousAction::where('num_sous_action',$s_act)->first();
        $act=Action::where('num_action',$s_act->num_action)->first();
        $sprog=SousProgramme::where('num_sous_prog',$act->num_sous_prog)->first();
        $progms=Programme::where('num_prog',$sprog->num_prog)->first();

        $s_act=$s_act->num_sous_action;
        $act=$act->num_action;
        $sous_prog=$sprog->num_sous_prog;
        $prog=$progms->num_prog;
        $port=$progms->num_portefeuil;
    
        $years=Portefeuille::where('num_portefeuil',$port)->firstOrFail();
        $years = Carbon::parse($years->Date_portefeuille)->year;
        $allEmploisBug=Emploi_budget::select('TRAITEMENT_ANNUEL', 'PRIMES_INDEMNITES', 'DEPENSES_ANNUELLES','EmploiesOuverts','EmploiesOccupes','EmploiesVacants')->get();

        $totaltrait = $allEmploisBug->sum('TRAITEMENT_ANNUEL');
        $totalprimes = $allEmploisBug->sum('PRIMES_INDEMNITES');
        $totaldepense = $allEmploisBug->sum('DEPENSES_ANNUELLES');
        $totalOuverts = $allEmploisBug->sum('EmploiesOuverts');
        $totalOccupes = $allEmploisBug->sum('EmploiesOccupes');
        $totalVacants = $allEmploisBug->sum('EmploiesVacants');
      //dd($port,$prog,$sous_prog,$act,$s_act);
      //$resultats = $this->CalculDpia->calculdpiaFromPath($port, $prog, $sous_prog, $act,$s_act);
     // dd($resultats);
        try{
            $resultats = $this->CalculDpia->calculdpiaFromPath($port, $prog, $sous_prog, $act,$s_act);
               return view('Action-in.index',compact('port','prog','sous_prog','act','s_act','resultats','years','totaltrait','totalprimes','totaldepense','totalOuverts','totalOccupes','totalVacants'));
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
           // dd($resultats );
           
          //pour t3 
          $years=Portefeuille::where('num_portefeuil',$port)->firstOrFail();
          $years = Carbon::parse($years->Date_portefeuille)->year;

          // Chargement du fichier JSON
        $jsonData = file_get_contents(public_path('assets/Titre/dataT1.json')); //la fonction file_get_contents() lire directement depuis le système de fichiers :
       // dd($jsonData);  
        $operations = json_decode($jsonData, true); // décoder en tableau 
        //dd($operations);  

        $jsonDataT2 = file_get_contents(public_path('assets/Titre/dataT2.json'));
        $operationsT2 = json_decode($jsonDataT2, true);
    
        $jsonDataT3 = file_get_contents(public_path('assets/Titre/dataT3.json'));
        $operationsT3 = json_decode($jsonDataT3, true);
    
        $jsonDataT4 = file_get_contents(public_path('assets/Titre/dataT4.json'));
        $operationsT4 = json_decode($jsonDataT4, true);
    
        // fonction prepareer names
        $names= $this->prepareNames($operations);
       // dd($names);
        $namesT2 = $this->prepareNames($operationsT2);
        $namesT3 = $this->prepareNames($operationsT3);
        $namesT4 = $this->prepareNames($operationsT4);
            //dd($namesT3);
        //envoyer le sousprogramme dans compact avec son code  
           $sousProgramme = SousProgramme::where('num_sous_prog', $sous_prog)->first();
          //dd($sousProgramme );
           // vérifier si le sous programme existe
           if (!$sousProgramme) {
            throw new \Exception("Sous programme introuvable");
        }

            // envoyer tous le chemin 
            $portefeuille = Portefeuille::with(['Programme.SousProgramme.Action.SousAction'])
            ->where('num_portefeuil', $port) 
            ->first();
                   //dd($portefeuille);
        if (!$portefeuille) {
            throw new \Exception("Programme introuvable");
        }

        $prog=$portefeuille->Programme->first();
        //dd($prog);

        $action=$sousProgramme->Action->first();
      //  dd($action);
            // pour bien structurer les données de resultats (calcul dpia)
           
         $resultstructur = [];
         foreach (['T1', 'T2', 'T3', 'T4'] as $t) {
             if (isset($resultats[$t])) {
            // dd($resultats);
                 $tdata = $resultats[$t];
                 
                 // chaque grp avec leurs sous operations
                 $groupedData = [];
                 foreach ($tdata['group'] as $group) {
                     $groupCode = $group['code'];
                    //dd($groupCode);
                    $groupedData[$groupCode] = [
                        'group' => $group,
                        'operations' => [],
                    
                    ];//dd( $groupedData);
                 }
               // dd( $groupedData);
               foreach ($tdata['operation'] as $operation) {
               // $groupCode = substr($operation['code'], 0, strlen($operation['code']) - 6); //extraire depuis l'op jusqu'à grp 
               $operationCode = $operation['code'];
               //dd($operationCode);
               // extraire les parties du code op
                $operationsParts = explode('-', $operationCode);
                //dd($operationsParts);
                $groupCode = implode('-', array_slice($operationsParts, 0, 7)); // extraire la partie groupe ppour savooir quel grp appartient op
               // dd(  $operationsParts,$groupCode);
           
                if (isset($groupedData[$groupCode])) {
                    //ajouter les op au grp
                    $groupedData[$groupCode]['operations'][] = [
                        'operation' => $operation,
                        'sousOperations' => [], 
                    ];       //dd( $groupedData);
                    } 
            } 
             //dd( $groupedData);
            // les sous operations dans operations 
            foreach ($tdata['sousOperation'] as $sousOp) {
                //dd($tdata['sousOperation'] );
               /* $sousOpCodeLength = strlen($sousOp['code']);
                //dd($sousOpCodeLength );
                if ($sousOpCodeLength > 34) { //operation =35
                    // extraire  la dernière partie du code apres 35 -...
                    $lastPartOfCode = substr($sousOp['code'], 34);
                   // dd($lastPartOfCode);
                    if (strlen($lastPartOfCode) > 6) {
                        // récupérer le nom 
                        $nomComplet = DB::table('sous_operations')
                            ->where('code_sous_operation', 'like', "%-$lastPartOfCode")
                            ->value('nom_sous_operation');
                       //dd($nomComplet);
                        
                        if ($nomComplet) {
                            // la chaine avec -
                            $nom_sepa = explode('_', $nomComplet);
                
                            // récupérer le 1er "intitule" et last  "décision"
                            $intitule = reset($nom_sepa);
                            $decision = end($nom_sepa);
                
                        
                           //dd( $intitule, $decision);
                        }
                    }
                    elseif (strlen($lastPartOfCode) > 1 && strlen($lastPartOfCode) < 5) {
                        $nomComplet = DB::table('sous_operations')
                        ->where('code_sous_operation', 'like', "%-$lastPartOfCode")
                        ->value('nom_sous_operation');
                         // dd($nomComplet);
                        if ($nomComplet) {
                            // la chaine avec -
                            $nom_sepa = explode('_', $nomComplet);
                
                            // récupérer le 1er "intitule" et last  "décision"
                            $intitule = reset($nom_sepa);
                            $decision = end($nom_sepa);
             
                     
                       //  dd( $intitule, $decision);
                     }
                     }   

                    }*/  
                    $sousOpCode = $sousOp['code'];
                    //dd( $sousOpCode );
                    $sousOpParts = explode('-', $sousOpCode);
                    //dd($sousOpParts);
                    $operationCode = implode('-', array_slice($sousOpParts, 0, 8)); // extrait la partie opération
                    //dd($operationCode);
                   
                    foreach ($groupedData as $groupCode => $groupData) {
                        foreach ($groupData['operations'] as $code => $operationData) {
                            // Extrait les 5 chiffres de l'opération
                            $opCode = $operationData['operation']['code'];
                            //dd( $opCode);
                            if (substr($opCode, 0, strlen($operationCode)) === $operationCode) {
                                // Ajouter la sous-opération si elle appartient à l'opération
                                $groupedData[$groupCode]['operations'][$code]['sousOperations'][] = $sousOp;
                                break;
                            }
                        } 
                    }
                }
                                 //dd($sousOpCode);
           // dd( $operationData['operation']['code'] );
            $resultstructur[$t] = [
                'groupedData' => $groupedData,
                'total' => $tdata['total'] ?? [], 
                // Ajoute le total (si disponible)
            ];
             }
         }
      // dd($resultstructur['T4']);
      
        if (isset($resultstructur)) {
           /*return view   ('impression.liste_impression_dpia_4tables_combinées', compact(
                'resultstructur', 
                'sousProgramme', 
                'names', 
                'namesT2', 
                'namesT3', 
                'namesT4', 
                'portefeuille', 
                'prog', 
                'action', 
                'years',
            ));*/
         $pdf=SnappyPdf::loadView
            ('impression.liste_impression_dpia_4tables_combinées', compact(
                'resultstructur', 
                'sousProgramme', 
                'names', 
                'namesT2', 
                'namesT3', 
                'namesT4', 
                'portefeuille', 
                'prog', 
                'action', 
                'years',
            ))->setPaper("A4","landscape");  // Augmenter la résolution pour améliorer la lisibilité du texte
              return $pdf->stream('liste_impression.pdf');
        } else {
                throw new \Exception("Aucune donnée trouvée");
            }
           
         /*if (isset($resultstructur['T1'])) {
                return view('impression.liste_impression', compact('resultstructur', 'sousProgramme', 'names','portefeuille','prog','action'));
                  /*$pdf=pdf::loadView('impression.liste_impression', compact('resultstructur','sousProgramme','names'));
               return $pdf->download('liste_impression.pdf');
          }
             elseif (isset($resultstructur['T2'])) {
               //return view('impression.liste_impression_t2', compact('resultstructur', 'sousProgramme', 'namesT2','portefeuille','prog','action'));
                 $pdf=pdf::loadView('impression.liste_impression_t2', compact('resultstructur', 'sousProgramme', 'namesT2','portefeuille','prog','action'))->setPaper("A4","landscape");
               return $pdf->stream('liste_impression.pdf');
            }
                elseif (isset($resultstructur['T3'])) {
                return view('impression.liste_impression_t3', compact('resultstructur', 'sousProgramme', 'namesT3','portefeuille','prog','action','years'));
                  /*$pdf=pdf::loadView('impression.liste_impression', compact('resultstructur','sousProgramme','names'));
               return $pdf->download('liste_impression.pdf');
            } 
             elseif (isset($resultstructur['T4'])) {
                return view('impression.liste_impression_t4', compact('resultstructur', 'sousProgramme', 'namesT4','portefeuille','prog','action'));
                  /*$pdf=pdf::loadView('impression.liste_impression', compact('resultstructur','sousProgramme','names'));
               return $pdf->download('liste_impression.pdf');
            } else {
                throw new \Exception("Aucune donnée trouvée ");
            }*/
        
        } catch (\Exception $e) { 
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
   
    private function prepareNames($operations)
    {
        $names = [];
        foreach ($operations as $code => $name) {
            $code_separer = explode('-', $code);  // Séparer le code
            $code_part = end($code_separer);      // la derniere partie du code pour que soit adaptable au code_sous_op
            $names[$code_part] = $name;
        }
        return $names;
    }

    function getdef_sop($id)
    {
        $ops=SousOperation::where('code_sous_operation',$id)->firstOrFail();
      //      dd($ops);
       if(isset($ops)) 
       {
        return response()->json([
            'code'=>200,
            'result'=>$ops
        ]);
        }else
        {
            return response()->json([
                'code'=>404,
            ]);
        }
    }

   }


        
   

