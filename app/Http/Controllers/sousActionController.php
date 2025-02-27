<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\pdf;
use App\Models\Portefeuille;
use App\Models\Programme;
use App\Models\Action;
use App\Models\initPort;
use App\Models\SousAction;
use App\Models\SousProgramme;
use App\Models\ModificationT;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Services\CalculDpia;
use Illuminate\Support\Facades\DB;
use Barryvdh\Snappy\Facades\SnappyPdf;
class sousActionController extends Controller
{
    protected $CalculDpia;

    public function __construct(CalculDpia $CalculDpia)
    {
        $this->CalculDpia = $CalculDpia;
    }
//===================================================================================
                            // affichage sous action
//===================================================================================
public function affich_sous_action($num_action)
{
    // Récupérer les action qui ont le même num_action
    $sousaction = SousAction::where('num_action', $num_action)->get();
    //dd($sousaction);
// Vérifier si des action existent
    if ($sousaction->isEmpty()) {
         return response()->json([
            'success' => false,
            'message' => 'Aucune sous action trouvée pour cette action.',
        ]);
    }

// Retourner les action à la vue
    return view('Action-in.index', compact('SousAction'));
}


// ======================= get all action of portfial ===============================///


function allact($numport)
{
    $allaction=[];
    $allsous_prog=[];
    $all_prog=[];
    $progms=Programme::where("num_portefeuil",$numport)->get();
    foreach($progms as $progm)
    {
        $sousprog=SousProgramme::where('num_prog',$progm->num_prog)->get();
        foreach($sousprog as $sprog)
        {


                $act=Action::where('num_sous_prog',$sprog->num_sous_prog)->get();
            //    dd($act);
                foreach($act as $listact)
                {
                    if(isset($listact))
                    {
                        $sous_act=SousAction::where('num_action',$listact->num_action)->get();
                      //  dd($sous_act);
                        foreach($sous_act as $listsousact)
                        {

                            if(isset($listsousact))
                            {

                                $resultats = $this->CalculDpia->calculdpiaFromPath($numport, $progm->num_prog, $sprog->num_sous_prog, $listact->num_action,$listsousact->num_sous_action);
                             //   dd($resultats);
                                array_push($allaction,['actions'=>['actions_num'=>$listsousact->num_sous_action,"actions_name"=>$listsousact->nom_sous_action]]);

                            }

                        }
                    }
                }
                array_push($allsous_prog,['sous_programs'=>['sous_progs_num'=>$sprog->num_sous_prog,"sous_progs_name"=>$sprog->nom_sous_prog]]);
            }
            array_push($all_prog,['programs'=>['progs_num'=>$progm->num_prog,"progs_name"=>$progm->nom_prog]]);
        }
      //  dd($allaction,$allsous_prog,$all_prog);
        if(count($allaction)>0)
        {
        return response()->json([
            'exists' => true,
            'actions'=>$allaction,
            'sous_programs'=>$allsous_prog,
            'programs'=>$all_prog,
        ]);
        }
        else
        {
            response()->json(['exists' => false]);
        }
}

// ================================= dpa withour operations only init =========================

function print_dpa($numport)
{
    $ttall_ini=[];
    $act_ini=[];
    $all_act_ini=[];
    $sousprog_ini=[];
    $allaction=[];
    $all_act=[];
    $allsous_prog=[];
    $programmes=[];
    $ttall=[];
    $TtAE1=0;
    $TtCP1=0;
    $TtAE2=0;
    $TtCP2=0;
    $TtAE3=0;
    $TtCP3=0;
    $TtAE4=0;
    $TtCP4=0;
    $TtportT1AE=0;
    $TtportT1CP=0;
    $TtportT2AE=0;
    $TtportT2CP=0;
    $TtportT3AE=0;
    $TtportT3CP=0;
    $TtportT4AE=0;
    $TtportT4CP=0;
    $TtAE1_act=0;
       $TtCP1_act=0;
       $TtAE2_act=0;
       $TtCP2_act=0;
       $TtAE3_act=0;
       $TtCP3_act=0;
       $TtAE4_act=0;
       $TtCP4_act=0;
    $Ttportglob=[];

    $progms=Programme::where("num_portefeuil",$numport)->get();
    foreach($progms as $progm)
    {
        $sousprog=SousProgramme::where('num_prog',$progm->num_prog)->get();
        foreach($sousprog as $sprog)
        {
            $initsprog=initPort::where('num_sous_prog',$sprog->num_sous_prog)->get();
           //dd($initsprog);
            foreach($initsprog as $init)
            {
                $ttall=[];
               
               if (isset($init->num_action))
            {

                $actsect=Action::where('num_action',$init->num_action)->firstOrFail();
                $TtAE1+=$init['AE_init_t1'];
                $TtCP1+=$init['CP_init_t1'];
    
                $TtAE2+=$init['AE_init_t2'];
                $TtCP2+=$init['CP_init_t2'];
    
                $TtAE3+=$init['AE_init_t3'];
                $TtCP3+=$init['CP_init_t3'];
    
                $TtAE4+=$init['AE_init_t4'];
                $TtCP4+=$init['CP_init_t4'];

                $TtAE1_act+=$init['AE_init_t1'];
                $TtCP1_act+=$init['CP_init_t1'];

                $TtAE2_act+=$init['AE_init_t2'];
                $TtCP2_act+=$init['CP_init_t2'];

                $TtAE3_act+=$init['AE_init_t3'];
                $TtCP3_act+=$init['CP_init_t3'];

                $TtAE4_act+=$init['AE_init_t4'];
                $TtCP4_act+=$init['CP_init_t4'];
                $ttall=['TotalT1_AE_ini'=>$init['AE_init_t1'],'TotalT1_CP_ini'=>$init['CP_init_t1'],
                'TotalT2_AE_ini'=>$init['AE_init_t2'],'TotalT2_CP_ini'=>$init['CP_init_t2'],
                'TotalT3_AE_ini'=>$init['AE_init_t3'],'TotalT3_CP_ini'=>$init['CP_init_t3'],
                'TotalT4_AE_ini'=>$init['AE_init_t4'],'TotalT4_CP_ini'=>$init['CP_init_t4'],
            ];
                array_push($act_ini,['actions'=>['code'=>$actsect->num_action,"nom"=>$actsect->nom_action,'TotalT'=>$ttall]]);
               // dd($act_ini); 
               $ttall_ini=['TotalT1_AE'=>$TtAE1_act,'TotalT1_CP'=>$TtCP1_act,
               'TotalT2_AE'=>$TtAE2_act,'TotalT2_CP'=>$TtCP2_act,
               'TotalT3_AE'=>$TtAE3_act,'TotalT3_CP'=>$TtCP3_act,
               'TotalT4_AE'=>$TtAE4_act,'TotalT4_CP'=>$TtCP4_act,];
               }
            else
            {
                $all_act_ini=['TotalT1_AE_ini'=>$init['AE_init_t1'],'TotalT1_CP_ini'=>$init['CP_init_t1'],
                'TotalT2_AE_ini'=>$init['AE_init_t2'],'TotalT2_CP_ini'=>$init['CP_init_t2'],
                'TotalT3_AE_ini'=>$init['AE_init_t3'],'TotalT3_CP_ini'=>$init['CP_init_t3'],
                'TotalT4_AE_ini'=>$init['AE_init_t4'],'TotalT4_CP_ini'=>$init['CP_init_t4'],
                
            ];
           
            }
            $ttall_ini=['TotalT1_AE'=>$TtAE1,'TotalT1_CP'=>$TtCP1,
            'TotalT2_AE'=>$TtAE2,'TotalT2_CP'=>$TtCP2,
            'TotalT3_AE'=>$TtAE3,'TotalT3_CP'=>$TtCP3,
            'TotalT4_AE'=>$TtAE4,'TotalT4_CP'=>$TtCP4,];
       }
       array_push($sousprog_ini,['sous_programmes'=>['code'=>$sprog->num_sous_prog,"nom"=>$sprog->nom_sous_prog,'actions'=>$act_ini,"Total_sp"=>$all_act_ini,"Total"=>$ttall_ini]]);
       $act_ini=[];
       $TtAE1_act=0;
       $TtCP1_act=0;
       $TtAE2_act=0;
       $TtCP2_act=0;
       $TtAE3_act=0;
       $TtCP3_act=0;
       $TtAE4_act=0;
       $TtCP4_act=0;
       
            }

           
         // dd($sousprog_ini);
           
                   
        //array_push();
        array_push($programmes,['programmes'=>['code'=>$progm->num_prog,"nom"=>$progm->nom_prog,"sous_programmes"=>$sousprog_ini,'Total_p'=>$all_act_ini,"Total"=>$ttall_ini]]);
        $TtAE1=0;
        $TtCP1=0;
        $TtAE2=0;
        $TtCP2=0;
        $TtAE3=0;
        $TtCP3=0;
        $TtAE4=0;
        $TtCP4=0;
        $ttall_ini=[];
        $sousprog_ini=[];
        $act_ini=[];
      
    }
    //dd($programmes);
        for ($i=0; $i < count($programmes) ; $i++)
    {
        foreach($programmes[$i] as $prog)
        {//dd($prog['Total']['TotalT1_AE']);
            if(!empty($prog['Total']))
            {
            $TtportT1AE+=$prog['Total']['TotalT1_AE'];
            $TtportT1CP+=$prog['Total']['TotalT1_CP'];
            $TtportT2AE+=$prog['Total']['TotalT2_AE'];
            $TtportT2CP+=$prog['Total']['TotalT2_CP'];
            $TtportT3AE+=$prog['Total']['TotalT3_AE'];
            $TtportT3CP+=$prog['Total']['TotalT3_CP'];
            $TtportT4AE+=$prog['Total']['TotalT4_AE'];
            $TtportT4CP+=$prog['Total']['TotalT4_CP'];
            }
            //dd($TtportT1AE);
        };

    };

    array_push($Ttportglob,['TotalPortT1_AE'=>$TtportT1AE,'TotalPortT1_CP'=>$TtportT1CP,
    'TotalPortT2_AE'=>$TtportT2AE,'TotalPortT2_CP'=>$TtportT2CP,
    'TotalPortT3_AE'=>$TtportT3AE,'TotalPortT3_CP'=>$TtportT3CP,
    'TotalPortT4_AE'=>$TtportT4AE,'TotalPortT4_CP'=>$TtportT4CP]);
    //dd($Ttportglob);
    //modification et article 
    $art = Article::selectRaw("id_art, CONCAT(nom_art, ' (', code_art, ')') as nom")->get();
   // dd($art);
    $modif = DB::table('modification_t_s as m1')
    ->join('articles', 'm1.id_art', '=', 'articles.id_art')
    ->select(
        'm1.*',
        DB::raw("CONCAT(articles.nom_art, ' (', articles.code_art, ')') as nom")
    )
    ->orderBy('m1.date_modif', 'desc') 
    ->first(); 
    //$modif = collect([$modif]);
        //dd($modif);
    $result = []; 
   // dd($art);
    foreach($art as $article){
        $lastM =($modif && $modif->id_art == $article->id_art) ? $modif : null;
        if($lastM != null){
            $lastModif= $lastM;
        }
    }
        //dd($article);

    //dd($lastModif);
//dd($article,$lastModif,$modif);
if($lastModif){ 
//mm prog et mm sousprog


if ($lastModif->num_prog == $lastModif->num_prog_retire && $lastModif->num_sous_prog == $lastModif->num_sous_prog_retire) {


$result['t1']=$this->compareT($lastModif, 't1');
$result['t2']=$this->compareT($lastModif, 't2');
$result['t3']=$this->compareT($lastModif, 't3');
$result['t4']=$this->compareT($lastModif, 't4');
  //dd($result);
//dd($lastModif);
} elseif ($lastModif->num_prog == $lastModif->num_prog_retire && $lastModif->num_sous_prog != $lastModif->num_sous_prog_retire) {

    $result['t1']=$this->compareT($lastModif, 't1');
  
    $result['t2']=$this->compareT($lastModif, 't2');
    $result['t3']=$this->compareT($lastModif, 't3');
    $result['t4']=$this->compareT($lastModif, 't4');
   //dd($lastModif); 
  //dd($result);
}elseif ($lastModif->num_prog_retire != $lastModif->num_prog && $lastModif->num_sous_prog == $lastModif->num_sous_prog_retire) {
    //le cas diffrnt prog et mm sous prog
   
    $result['t1']=$this->compareT($lastModif, 't1');
  
    $result['t2']=$this->compareT($lastModif, 't2');
    $result['t3']=$this->compareT($lastModif, 't3');
    $result['t4']=$this->compareT($lastModif, 't4');
 //  dd($result);
} elseif ($lastModif->num_prog_retire != $lastModif->num_prog && $lastModif->num_sous_prog != $lastModif->num_sous_prog_retire) {
  
    $result['t1']=$this->compareT($lastModif, 't1');
  
    $result['t2']=$this->compareT($lastModif, 't2');
    $result['t3']=$this->compareT($lastModif, 't3');
    $result['t4']=$this->compareT($lastModif, 't4');
  // dd($result);
} elseif ($lastModif->num_prog_retire && $lastModif->num_prog == null && $lastModif->num_sous_prog_retire && $lastModif->num_sous_prog==null) {
    // Si envoi 

    $result['t1']=$this->compareT($lastModif, 't1');
  
    $result['t2']=$this->compareT($lastModif, 't2');
    $result['t3']=$this->compareT($lastModif, 't3');
    $result['t4']=$this->compareT($lastModif, 't4');
  //  dd($result);
} elseif ($lastModif->num_prog  && $lastModif->num_prog_retire == null && $lastModif->num_sous_prog && $lastModif->num_sous_prog_retire==null) {
    // Si reçoit
 
    $result['t1']=$this->compareT($lastModif, 't1');
  
    $result['t2']=$this->compareT($lastModif, 't2');
    $result['t3']=$this->compareT($lastModif, 't3');
    $result['t4']=$this->compareT($lastModif, 't4');
  //  dd($result);
}else{
    return ('erreur');
}


}


$portefeuilles = Portefeuille::with(['Programme.SousProgramme.Action.SousAction'])->get();

$resultData = [];

foreach ($portefeuilles as $portefeuille) {
$progdata = [];

foreach ($portefeuille->Programme as $programme) {
$sousprogdata = [];

foreach ($programme->SousProgramme as $sousProgramme) {
$actiondata = [];

foreach ($sousProgramme->Action as $action) {
    $sousactiondata = []; 

    foreach ($action->SousAction as $SousAction) {
        $sousactiondata[] = [
            'num_sous_action' => $SousAction->num_sous_action,
            'nom_sous_action' => $SousAction->nom_sous_action,
            'AE_sous_action' => $SousAction->AE_sous_action,
            'CP_sous_action' => $SousAction->CP_sous_action,
        ];
    }

    $actiondata[] = [
        'num_action' => $action->num_action,
        'nom_action' => $action->nom_action,
        'AE_action' => $action->AE_action,
        'CP_action' => $action->CP_action,
        'sousactions' => $sousactiondata,
    ];
}

$sousprogdata[] = [
    'num_sous_prog' => $sousProgramme->num_sous_prog,
    'nom_sous_prog' => $sousProgramme->nom_sous_prog,
    'AE_sous_prog' => $sousProgramme->AE_sous_prog,
    'CP_sous_prog' => $sousProgramme->CP_sous_prog,
    'actions' => $actiondata,
];
}

$progdata[] = [
'num_prog' => $programme->num_prog,
'nom_prog' => $programme->nom_prog,
'AE_prog' => $programme->AE_prog,
'CP_prog' => $programme->CP_prog,
'sous_programmes' => $sousprogdata,
];
}

$resultData[] = [
'num_portefeuil' => $portefeuille->num_portefeuil,
'nom_portefeuil' => $portefeuille->nom_portefeuil,
'programmes' => $progdata, 
];
}
//dd($result);

$newArray = []; 

foreach (['t1', 't2', 't3', 't4'] as $tKey) {
if (isset($result[$tKey])) {
$progData = $result[$tKey];
//dd( $progData );
if ($progData !== null) {
foreach ($resultData as $data) {
    $programs = $data['programmes'];
   //dd( $programs);
    foreach ($programs as $progr) {
        $num_prog = $progr['num_prog'] ?? null;
        //dd($num_prog);
    //prog retire
        if (isset($progData['tabsousprogretir']) && !empty($progData['tabsousprogretir'])) {
            //dd($progData);
            foreach ($progData['tabsousprogretir'] as $retir) {
           //  dd($retir);
                if ($retir['prog'] === $num_prog) {
                    // els sous prog
                    if (isset($progr['sous_programmes']) && is_array($progr['sous_programmes'])) {
                        //dd($progr);
                        foreach ($progr['sous_programmes'] as $sousProgramme) {
                            if ($sousProgramme['num_sous_prog'] === $retir['num_sous_prog']) {
                                if (isset($sousProgramme['actions']) && is_array($sousProgramme['actions'])) {
                                    //dd($sousProgramme);
                                    foreach ($sousProgramme['actions'] as $actions) {
                                        //dd($actions);
                                        if ($actions['num_action'] === $retir['num_action']){
                                            if (isset($actions['sousactions']) && is_array($actions['sousactions'])) {
                                                //dd($actions);
                                                foreach ($actions['sousactions'] as $sousactions) {
                                                    if ($sousactions['num_sous_action'] === $retir['num_sous_action'] ){
                                        

                                                        $newArray[] = [
                                                            'num_prog' => $num_prog,
                                                            'valeur_prog_ae' => $progr['AE_prog'] ?? 0,
                                                            'valeur_prog_cp' => $progr['CP_prog'] ?? 0,
                                                            'tKey' => $tKey,
                                                            'sous_programme' => $retir['num_sous_prog'],
                                                            'valeur_sous_prog_ae' => $sousProgramme['AE_sous_prog'] ?? 0,
                                                            'valeur_sous_prog_cp' => $sousProgramme['CP_sous_prog'] ?? 0,

                                                            'action' => $retir['num_action'],
                                                            'valeur_action_ae' => $actions['AE_action'] ?? 0,
                                                            'valeur_action_cp' => $actions['CP_action'] ?? 0,

                                                            'sousaction' => $retir['num_sous_action'],
                                                            'valeur_sousaction_ae' => $sousactions['AE_sous_action'] ?? 0,
                                                            'valeur_sousaction_cp' => $sousactions['CP_sous_action'] ?? 0,


                                                        ];

                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                            
                                            //tabsousprog recoit 
                                                if (isset($progData['tabsousprogrecoit']) && !empty($progData['tabsousprogrecoit'])) {
                                                    foreach ($progData['tabsousprogrecoit'] as $recoit) {
                                                        if ($recoit['prog'] === $num_prog) {
                                                            if (isset($progr['sous_programmes']) && is_array($progr['sous_programmes'])) {
                                                                foreach ($progr['sous_programmes'] as $sousProgramme) {
                                                                    if ($sousProgramme['num_sous_prog'] === $recoit['num_sous_prog']) {
                                                                        if (isset($sousProgramme['actions']) && is_array($sousProgramme['actions'])) {
                                                                            //dd($sousProgramme);
                                                                            foreach ($sousProgramme['actions'] as $actions) {
                                                                                //dd($actions);
                                                                                if ($actions['num_action'] === $recoit['num_action']){
                                                                                    if (isset($actions['sousactions']) && is_array($actions['sousactions'])) {
                                                                                        //dd($actions);
                                                                                        foreach ($actions['sousactions'] as $sousactions) {
                                                                                            if ($sousactions['num_sous_action'] === $recoit['num_sous_action']){
                                                                                
                                                                       
                                                                       
                                                                        $newArray[] = [
                                                                            'num_prog' => $num_prog,
                                                                            'valeur_prog_ae' => $progr['AE_prog'] ?? 0,
                                                                            'valeur_prog_cp' => $progr['CP_prog'] ?? 0,
                                                                            'tKey' => $tKey,
                                                                            'sous_programme' => $recoit['num_sous_prog'],
                                                                            'valeur_sous_prog_ae' => $sousProgramme['AE_sous_prog'] ?? 0,
                                                                            'valeur_sous_prog_cp' => $sousProgramme['CP_sous_prog'] ?? 0,

                                                                            'action' => $recoit['num_action'],
                                                                            'valeur_action_ae' => $actions['AE_action'] ?? 0,
                                                                            'valeur_action_cp' => $actions['CP_action'] ?? 0,

                                                                            'sousaction' => $recoit['num_sous_action'],
                                                                            'valeur_sousaction_ae' => $sousactions['AE_sous_action'] ?? 0,
                                                                            'valeur_sousaction_cp' => $sousactions['CP_sous_action'] ?? 0,
                                                                        ];
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
 //dd($newArray);    
//pour eviter les 2 clés en mm temsp 
$progg = [];
foreach ($newArray as $item) {
// Créer une clé unique basée sur les valeurs de l'élément
$cleprog = $item['num_prog'] . '|' . $item['valeur_prog_ae'] . '|' . $item['valeur_prog_cp'] . '|' . $item['tKey'] . '|'
.$item['sous_programme']. $item['valeur_sous_prog_ae'] . '|' . $item['valeur_sous_prog_cp'];

if (!isset($progg[$cleprog])) {
$progg[$cleprog] = $item;
}
}

// Réindexer le tableau
$progg = array_values($progg);

//dd($progg);
//afficher les t qui n'ont pas une valeur 
$resultT=[];
$allT = ["t1", "t2", "t3", "t4"];

foreach ($progg as $programme) {
    
    $ActuelT = $programme['tKey']; 
    $restT = array_diff($allT, [$ActuelT]); 
    $resultT[]=[
        'num_prog'=> $programme['num_prog'],
        'sous_programme'=>$programme['sous_programme'],
        'action'=>$programme['action'],
        'sousaction'=>$programme['sousaction'], 
        'rest'=> $restT ,
    ];
}
//dd($resultT);
 
// dd($resultData);
//dd($article,$lastModif,$modif);


//dd($result);
//dd($programmes);

return view('impression.impression_dpic_init', compact('programmes','Ttportglob','art','modif','lastModif','result','resultData','progg'));
$pdf=SnappyPdf::loadView('impression.impression_dpic_init', compact('programmes','Ttportglob','art','modif','lastModif','result','resultData','progg'))
->setPaper("A4","landscape")->setOption('dpi', 300) ->setOption('zoom', 1);//lanscape mean orentation
return $pdf->stream('impression_dpic.pdf');

}

//==============================fct compareT====================================================*
function compareT($lastModif, $t) {

$envoiAE = 'AE_envoi_' . $t;
//dd($envoiAE );
$recoitAE = 'AE_recoit_' . $t;
$envoiCP = 'CP_envoi_' . $t;
$recoitCP = 'CP_recoit_' . $t;
$tabsousprogretir=[];
$tabsousprogrecoit=[];

$num_actionret = $lastModif->num_sous_action_retire;
$partsret = explode('-', $num_actionret);
$num_action_retire = implode('-', array_slice($partsret, 0, 5));
// dd($num_action_retire);

$num_actionrec=$lastModif->num_sous_action;
$partsrec= explode('-', $num_actionrec);
$num_action_recoit = implode('-', array_slice($partsrec, 0, 5));
// dd($num_action_recoit);

// si ae et cp du mm t
//dd($lastModif);
//dd('avant boucle', $tabsousprogretir);
if ($lastModif->$envoiAE == $lastModif->$recoitAE && $lastModif->$envoiCP == $lastModif->$recoitCP) {
    if ($lastModif->$envoiAE !=0 && $lastModif->$recoitAE!=0 && $lastModif->$envoiCP !=0 && $lastModif->$recoitCP!=0){

    
    $lastModif->$recoitAE = 0;
    $lastModif->$recoitCP = 0;

    $tabsousprogretir[] = [
        'valeurAE' => $lastModif->$envoiAE,
        'valeurCP' => $lastModif->$envoiCP,
        'num_sous_prog' => $lastModif->num_sous_prog_retire,
        'prog' => $lastModif->num_prog_retire,
        'num_action' => $num_action_retire,
        'num_sous_action' => $lastModif->num_sous_action_retire,
       
    ];
}
   
    //dd($tabsousprogretir, $tabsousprogrecoit);
} else {
    if (isset($lastModif->$envoiAE) && $lastModif->$envoiAE > 0) {
        $lastModif->$envoiAE = -$lastModif->$envoiAE;

        $tabsousprogretir[] = [
            'valeurAE' => $lastModif->$envoiAE,
            'num_sous_prog' => $lastModif->num_sous_prog_retire,
            'prog' => $lastModif->num_prog_retire,
            'num_action' => $num_action_retire,
            'num_sous_action' => $lastModif->num_sous_action_retire,
        ];
    
       // dd($tabsousprogretir);
    }

    if (isset($lastModif->$envoiCP) && $lastModif->$envoiCP > 0) {
        $lastModif->$envoiCP = -$lastModif->$envoiCP;

        $tabsousprogretir[] = [
            'valeurCP' => $lastModif->$envoiCP,
            'num_sous_prog' => $lastModif->num_sous_prog_retire,
            'prog' => $lastModif->num_prog_retire,
            'num_action' => $num_action_retire,
            'num_sous_action' => $lastModif->num_sous_action_retire,
        ];
    
      //  dd($tabsousprogretir);
    }


 
    if (isset($lastModif->$recoitAE) && $lastModif->$recoitAE > 0) {
        $tabsousprogrecoit[] = [
            'valeurAE' => $lastModif->$recoitAE,
            'num_sous_prog' => $lastModif->num_sous_prog,
            'prog' => $lastModif->num_prog,
            'num_action' => $num_action_recoit,
            'num_sous_action' => $lastModif->num_sous_action,
        ];
    }

    if (isset($lastModif->$recoitCP) && $lastModif->$recoitCP > 0) {
        $tabsousprogrecoit[] = [
            'valeurCP' => $lastModif->$recoitCP,
            'num_sous_prog' => $lastModif->num_sous_prog,
            'prog' => $lastModif->num_prog,
            'num_action' => $num_action_recoit,
            'num_sous_action' => $lastModif->num_sous_action,
        ];
    }
    //dd($tabsousprogretir, $tabsousprogrecoit);
  
}


//dd($lastModif, $tabsousprogretir, $tabsousprogrecoit);


return [
    'tabsousprogretir' => $tabsousprogretir,
    'tabsousprogrecoit' => $tabsousprogrecoit,
    'lastModif' => $lastModif,
];

}

//================================== dipc with  operatiionss =====================================*

function printdpic($numport)
{   
    $act_ini=[];
    $sousprog_ini=[];
    $allaction=[];
    $all_act=[];
    $allsous_prog=[];
    $programmes=[];
    $ttall=[];
    $TtAE1=0;
    $TtCP1=0;
    $TtAE2=0;
    $TtCP2=0;
    $TtAE3=0;
    $TtCP3=0;
    $TtAE4=0;
    $TtCP4=0;
    $TtportT1AE=0;
    $TtportT1CP=0;
    $TtportT2AE=0;
    $TtportT2CP=0;
    $TtportT3AE=0;
    $TtportT3CP=0;
    $TtportT4AE=0;
    $TtportT4CP=0;
    $Ttportglob=[];

    $progms=Programme::where("num_portefeuil",$numport)->get();
    foreach($progms as $progm)
    {
        $sousprog=SousProgramme::where('num_prog',$progm->num_prog)->get();
        foreach($sousprog as $sprog)
        {


                $act=Action::where('num_sous_prog',$sprog->num_sous_prog)->get();
            //    dd($act);
                foreach($act as $listact)
                {
                    if(isset($listact))
                    {
                        $sous_act=SousAction::where('num_action',$listact->num_action)->get();
                      //  dd($sous_act);
                        foreach($sous_act as $listsousact)
                        {
                           
                            if(isset($listsousact))
                            {

                                $resultats = $this->CalculDpia->calculdpiaFromPath($numport, $progm->num_prog, $sprog->num_sous_prog, $listact->num_action,$listsousact->num_sous_action);
                                //dd( $resultats);
                                array_push($allaction,['actions'=>['code'=>$listsousact->num_sous_action,"nom"=>$listsousact->nom_sous_action,'TotalT'=>$resultats]]);
                                $all_act= $allaction;

                            }

                        }
                    }


                }

               // dd($allaction);
                for($i=0 ;$i<count($allaction);$i++)
                {
                foreach($allaction[$i] as $actsect)
                {
                    $TtAE1+=$actsect['TotalT']['T1']['total'][0]['values']['totalAE'];
                    $TtCP1+=$actsect['TotalT']['T1']['total'][0]['values']['totalCP'];
             
                    $TtAE2+=$actsect['TotalT']['T2']['total'][0]['values']['totalAE'];
                    $TtCP2+=$actsect['TotalT']['T2']['total'][0]['values']['totalCP'];

                    $TtAE3+=$actsect['TotalT']['T3']['total'][0]['values']['totalAE'];
                    $TtCP3+=$actsect['TotalT']['T3']['total'][0]['values']['totalCP'];

                    $TtAE4+=$actsect['TotalT']['T4']['total'][0]['values']['totalAE'];
                    $TtCP4+=$actsect['TotalT']['T4']['total'][0]['values']['totalCP'];

                };

                };

                $ttall=['TotalT1_AE'=>$TtAE1,'TotalT1_CP'=>$TtCP1,
                    'TotalT2_AE'=>$TtAE2,'TotalT2_CP'=>$TtCP2,
                    'TotalT3_AE'=>$TtAE3,'TotalT3_CP'=>$TtCP3,
                    'TotalT4_AE'=>$TtAE4,'TotalT4_CP'=>$TtCP4,
                ];

                array_push($allsous_prog,['sous_programmes'=>['code'=>$sprog->num_sous_prog,"nom"=>$sprog->nom_sous_prog,'actions'=>$all_act,"Total"=>$ttall]]);
                $all_sous_prog= $allsous_prog;
                $TtAE1=0;
                $TtCP1=0;
                $TtAE2=0;
                $TtCP2=0;
                $TtAE3=0;
                $TtCP3=0;
                $TtAE4=0;
                $TtCP4=0;
                $ttall=[];
                $allaction=[];
                $all_act=[];



            }
            for ($i=0; $i < count($allsous_prog) ; $i++)
            {
            foreach($allsous_prog[$i] as $sousprog)
             {
                # code...
                $TtAE1+=$sousprog['Total']['TotalT1_AE'];
                $TtCP1+=$sousprog['Total']['TotalT1_CP'];

                $TtAE2+=$sousprog['Total']['TotalT2_AE'];
                $TtCP2+=$sousprog['Total']['TotalT2_CP'];

                $TtAE3+=$sousprog['Total']['TotalT3_AE'];
                $TtCP3+=$sousprog['Total']['TotalT3_CP'];

                $TtAE4+=$sousprog['Total']['TotalT4_AE'];
                $TtCP4+=$sousprog['Total']['TotalT4_CP'];
            }
        }
            $ttall=['TotalT1_AE'=>$TtAE1,'TotalT1_CP'=>$TtCP1,
            'TotalT2_AE'=>$TtAE2,'TotalT2_CP'=>$TtCP2,
            'TotalT3_AE'=>$TtAE3,'TotalT3_CP'=>$TtCP3,
            'TotalT4_AE'=>$TtAE4,'TotalT4_CP'=>$TtCP4,
        ];
            array_push($programmes,['programmes'=>['code'=>$progm->num_prog,"nom"=>$progm->nom_prog,"sous_programmes"=>$all_sous_prog,"Total"=>$ttall]]);
            $TtAE1=0;
            $TtCP1=0;
            $TtAE2=0;
            $TtCP2=0;
            $TtAE3=0;
            $TtCP3=0;
            $TtAE4=0;
            $TtCP4=0;
            $allsous_prog=[];
        }
             // dd($programmes);
             for ($i=0; $i < count($programmes) ; $i++)
             {
        foreach($programmes[$i] as $prog)
        {
            $TtportT1AE+=$prog['Total']['TotalT1_AE'];
            $TtportT1CP+=$prog['Total']['TotalT1_CP'];
            $TtportT2AE+=$prog['Total']['TotalT2_AE'];
            $TtportT2CP+=$prog['Total']['TotalT2_CP'];
            $TtportT3AE+=$prog['Total']['TotalT3_AE'];
            $TtportT3CP+=$prog['Total']['TotalT3_CP'];
            $TtportT4AE+=$prog['Total']['TotalT4_AE'];
            $TtportT4CP+=$prog['Total']['TotalT4_CP'];
        };
    };
    
 
       // dd($TtportT4AE,$TtportT1AE,$TtportT1CP);      
        array_push($Ttportglob,['TotalPortT1_AE'=>$TtportT1AE,'TotalPortT1_CP'=>$TtportT1CP,
                                'TotalPortT2_AE'=>$TtportT2AE,'TotalPortT2_CP'=>$TtportT2CP,
                                'TotalPortT3_AE'=>$TtportT3AE,'TotalPortT3_CP'=>$TtportT3CP,
                                'TotalPortT4_AE'=>$TtportT4AE,'TotalPortT4_CP'=>$TtportT4CP]);

                              
  
   // dd($Ttportglob);
   // return view('impression.impression_dpic2tableaux', compact('programmes','Ttportglob'));
    $pdf=SnappyPdf::loadView('impression.impression_dpic2tableaux', compact('programmes','Ttportglob'))
    ->setPaper("A4","landscape")->setOption('dpi', 300) ->setOption('zoom', 1);//lanscape mean orentation
          return $pdf->stream('impression_dpic.pdf');
    $programmes=[];
    
    if(count($Ttportglob) <= 0)
    { 
    }
   
        if(count($programmes)>0)
        {
        /*return response()->json([
            'exists' => true,
            'actions'=>$allaction,
            'sous_programs'=>$allsous_prog,
            'programs'=>$all_prog,
        ]);*/
       /*  $pdf=SnappyPdf::loadView('impression.programmes', compact('programmes','Ttportglob'))
         ->setPaper("A4","landscape")->setOption('dpi', 300) ->setOption('zoom', 1.5);//lanscape mean orentation
               return $pdf->stream('impression_dpic.pdf');*/

       /* $pdf=SnappyPdf::loadView('impression.impression_dpicprgsousprog', compact('programmes','Ttportglob'))
         ->setPaper("A4","landscape")->setOption('dpi', 300) ->setOption('zoom', 1.5);//lanscape mean orentation
               return $pdf->stream('impression_dpic.pdf');*/
       //return view('impression.programmes',compact('programmes','Ttportglob'));
        }
        else
        {
            response()->json(['exists' => false]);
        }

}

//===================================================================================
                                //DEBUT CHECK
//===================================================================================

public function check_sousaction(Request $request)
    {
        $sousaction = sousAction::where('num_sous_action', $request->num_sous_action)->first();
       // dd($request);
        if ($sousaction) {
            return response()->json([
                'exists' => true,
                'nom_sous_action' => $sousaction->nom_sous_action,
                'date_insert_sous_action' => $sousaction->date_insert_sous_action,
                'AE_sous_act'=>$sousaction->AE_sous_action,
                'CP_sous_act'=>$sousaction->CP_sous_action,
            ]);
        }

        return response()->json(['exists' => false]);
    }

//===================================================================================
                            //FIN CHECK
//===================================================================================

//===================================================================================
                        // creation sous action
//===================================================================================
function create_sousaction(Request $request)
{
    //dd($request);
 // Récupérer la ligne de la table en fonction de 'numsouaction'
 $sousaction = SousAction::where('num_sous_action', $request->num_act)->first(); // Utilisation de 'numsouaction' pour trouver l'élément
 $sousaction3 = SousAction::where('num_sous_action', $request->num_sous_action)->first(); // Utilisation de 'numsouaction' pour trouver l'élément
 if ($sousaction || $sousaction3) {
     if(isset($sousaction3)){
         $sousaction=$sousaction3;
        }
        //dd($sousaction);
    // Mise à jour des autres champs
    $sousaction->num_sous_action = $request->num_sous_action;
    $sousaction->nom_sous_action = $request->nom_sous_action;
    $sousaction->AE_sous_action=floatval(str_replace(',', '', $request->AE_sous_act));
    $sousaction->CP_sous_action=floatval(str_replace(',', '', $request->CP_sous_act));
   // $sousaction->num_action = $request->num_act;
    $sousaction->date_update_sous_action = now();

    // Enregistrer les modifications dans la base de données
    $sousaction->save();

}
else{
      //dd($request);
    // creer une nouvelle  sous action
    $sousaction = new sousAction();
    $sousaction->num_action = $request->num_act;
    $sousaction->num_sous_action = $request->num_sous_action;
    $sousaction->nom_sous_action = $request->nom_sous_action;
    $sousaction->AE_sous_action=floatval(str_replace(',', '', $request->AE_sous_act));
    $sousaction->CP_sous_action=floatval(str_replace(',', '', $request->CP_sous_act));
    $sousaction->date_insert_sous_action = $request->date_insert_sous_action;
    $sousaction->save();
}

if ( $sousaction) {
    return response()->json([
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

}
}
