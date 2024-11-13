<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portefeuille;
use App\Models\Programme;
use App\Models\Action;
use App\Models\SousAction;
use App\Models\SousProgramme;
use App\Models\ConstruireDPIA;
use App\Models\ConstruireDPIC;
use Carbon\Carbon;

use App\Services\CalculDpia;
class portfeuilleController extends Controller
{

    protected $CalculDpia;

    public function __construct(CalculDpia $CalculDpia)
    {
        $this->CalculDpia = $CalculDpia;
    }

    //================================= Pour suivi Methode =====================//

    function show_prsuiv($path)
    {
        //$path=$request->all();
       
        $id=explode('-',$path);
        $num=$id[0];    
        $cat=$id[1];
       // dd($id);
        $paths=[];
        if($cat == "all")
        {
            
            $por=Portefeuille::findOrFail($num);
           
            $paths=['code_port'=>$por->num_portefeuil];
           
        }
       if($cat == 'prog' )
       {
        $progms=Programme::where('num_prog',intval($num))->get();
       // dd($progms);
        $paths=['code_port'=>$progms[0]->num_portefeuil,'programme'=>$progms[0]->num_prog];
       // dd($paths);
       }
       
        if($cat == 'sprog')
        {
                $sprog=SousProgramme::where('num_sous_prog',intval($num))->first();
                $progms=Programme::where('num_prog',$sprog->num_prog)   ->first();
                $paths=['code_port'=>$progms->num_portefeuil,'programme'=>$progms->num_prog,'sous Programme'=>$sprog->num_sous_prog];
             //    dd($paths);
        }
        if($cat == 'act' )
        {   
            $act=Action::where('num_action',intval($num))->first();
            $sprog=SousProgramme::where('num_sous_prog',$act->num_sous_prog)->first();
            $progms=Programme::where('num_prog',$sprog->num_prog)->first();
            $paths=['code_port'=>$progms->num_portefeuil,'programme'=>$progms->num_prog,'sous Programme'=>$sprog->num_sous_prog,'Action'=>$act->num_action];
             //   dd($paths);
        }
        $leng=count($paths);
      //  dd($leng);
      if($leng > 0)
      {
        return view('Portfail-in.prsuiv',compact('paths','leng'));
      }
      else
      {
        return redirect()->back()->withErrors(['error' => 'Your error message here']);
      }
    }
    //================================= End ====================================//
//===================================================================================
                                //affichage du portrefeuille
//===================================================================================

    function affich_portef($id)
    {
        // Récupérer tous les portefeuilles de la base de données
          //  $portefeuilles = Portefeuille::all();
         
          $por=Portefeuille::findOrFail($id);
          $progms=Programme::where('num_portefeuil',$id)->get();
          $allprogram=[];
          $allsous_prog=[];
          $allaction=[];
          $allsous_action=[];
          $resultats=0;
           $allresult=0;
           $AE_All_sous_act=0;
           $CP_All_sous_act=0;
           $AE_All_act=0;
           $CP_All_act=0;
           $AE_All_sous_prog=0;
           $CP_All_sous_prog=0;
           $AE_All_prog=0;
           $CP_All_prog=0;
  
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
                              //dd($sous_act);
                              foreach($sous_act as $listsousact)
                              {
                               
                                  if(isset($listsousact))
                                  {
                                     // $resultats = $this->CalculDpia->calculdpiaFromPath($id, $progm->num_prog, $sprog->num_sous_prog, $listact->num_action,$listsousact->num_sous_action);
                                     
                                      try {
                                          $resultats = $this->CalculDpia->calculdpiaFromPath($id, $progm->num_prog, $sprog->num_sous_prog, $listact->num_action,$listsousact->num_sous_action);
                                      } catch (\Exception $e) {
                                         
                                          $resultats="null";
                                      }
                                      if($resultats != "null")
                                      {
                                        foreach($resultats as $Tresult)
                                        {
                                            $AE_All_sous_act+=$Tresult['total'][0]['values']['totalAE'];
                                            $CP_All_sous_act+=$Tresult['total'][0]['values']['totalCP'];
                                        }
                                      }
                                      //dd($resultats);
                                    
                                      array_push($allsous_action,['num_act'=>$listsousact->num_sous_action,'init_AE'=>$listsousact->AE_sous_action,'init_CP'=>$listsousact->CP_sous_action,'TotalAE'=>$AE_All_sous_act,'TotalCP'=>$CP_All_sous_act,'data'=>$listsousact,'Tports'=>$resultats]);
                                    
                                  }
                                 
                              } 
                              foreach($allsous_action as $sact)
                              {
                                $AE_All_act+=$sact['TotalAE'];
                                $CP_All_act+=$sact['TotalCP'];
                              }
                          array_push($allaction,['num_act'=>$listact->num_action,'init_AE'=>$listact->AE_action,'init_CP'=>$listact->CP_action,'TotalAE'=>$AE_All_act,'TotalCP'=>$CP_All_act,'data'=>$listact,'sous_action'=>$allsous_action]);
                          $allsous_action=[];
                          }
                      }
                      foreach($allaction as $sact)
                              {
                                $AE_All_sous_prog+=$sact['TotalAE'];
                                $CP_All_sous_prog+=$sact['TotalCP'];
                                
                              }
                              
                      array_push($allsous_prog,['id_sous_prog'=>$sprog->num_sous_prog,'init_AE'=>$sprog->AE_sous_prog,'init_CP'=>$sprog->CP_sous_prog,'TotalAE'=>$AE_All_sous_prog,'TotalCP'=>$CP_All_sous_prog,'data'=>$sprog,'Action'=>$allaction]);
               //      dd($allsous_prog);
                      $allaction=[];
              }  
              
              foreach($allsous_prog as $sact)
                              {
                                $AE_All_prog+=$sact['TotalAE'];
                                $CP_All_prog+=$sact['TotalCP'];
                              }
              array_push($allprogram,['id_prog'=>$progm->num_prog,'init_AE'=>$progm->AE_prog,'init_CP'=>$progm->CP_prog,'TotalAE'=>$AE_All_prog,'TotalCP'=>$CP_All_prog, 'data'=>$progm,'sous_program'=>$allsous_prog]);
              $allsous_prog=[];
          }
       //   dd($por);
          $allport=[
              'id'=>$id,
              'TotalAE'=>$por->AE_portef,
              'TotalCP'=>$por->CP_portef,
              'prgrammes'=>$allprogram,
          ];
         //     dd($allport);
      // Passer les données à la vue
      return view('test.tree', compact('allport'));


    // Passer les données à la vue
     
    }
    //affichage formulaire
    function form_portef()
    {
        return view('Portfail-in.creation');
    }
//===================================================================================
                                //DEBUT CHECK
//===================================================================================

public function check_portef(Request $request)
{
    // Validation de la requête
    $request->validate([
        'num_portefeuil' => 'required',
        'Date_portefeuille' => 'required|date'
    ]);

    // Concatenation du numéro de portefeuille avec l'année
    $num = $request->num_portefeuil;

    // Vérification si le portefeuille existe dans la base de données
    $portefeuille = Portefeuille::where('num_portefeuil', $num)->first();

    if ($portefeuille) {
        return response()->json([
            'exists' => true,
            'nom_journal' => $portefeuille->nom_journal,
            'num_journal' => $portefeuille->num_journal,
            'AE_portef' => $portefeuille->AE_portef,
            'CP_portef' => $portefeuille->CP_portef,
            'Date_portefeuille' => $portefeuille->Date_portefeuille,
        ]);
    }

    return response()->json(['exists' => false]);
}

//===================================================================================
                                //FIN CHECK
//===================================================================================
//===================================================================================
                                // creation du portefeuille
//===================================================================================
    function creat_portef(Request $request)
    {

         // Validation des données
         $request->validate([
           // 'inputFile' => 'required|file|mimes:jpg,png,pdf|max:2048', // Validation du fichier
            'num_journal' => 'required',
            'nom_journal' => 'required',
            'AE_portef' => 'required',
            'CP_portef' => 'required',
            'Date_portefeuille' => 'required|date',
        ]);
//dd($request);
        //si le portefeuiille existe donc le modifier
    $portefeuille = Portefeuille::where('num_portefeuil', $request->num_portefeuil)->first();
    if ($portefeuille) {
        $portefeuille->nom_journal = $request->nom_journal;
        $portefeuille->num_journal = $request->num_journal;
        $portefeuille->AE_portef = $request->AE_portef;
        $portefeuille->CP_portef = $request->CP_portef;
        $portefeuille->Date_portefeuille = $request->Date_portefeuille;
        $portefeuille->id_min =1;//periodiquement
        $portefeuille->save();

// Enregistrer le fichier et le lier au portefeuille
//if ($request->hasFile('inputFile')) {
//    // Vérifier si le fichier est valide
//    if ($request->file('inputFile')->isValid()) {
//        // Stocker le fichier dans le dossier `public/files/portefeuilles` et obtenir le chemin
//        $path = $request->file('inputFile')->store('public/files/portefeuilles');
//        $filePath = Storage::url($path);
//
//        // Récupérer les informations du fichier
//        $nomFichier = $request->file('inputFile')->getClientOriginalName();
//        $fileType = $request->file('inputFile')->getClientOriginalExtension();
//        $fileSize = $request->file('inputFile')->getSize();
//
//        // Créer un nouvel enregistrement dans `multimedia`
//        $media = new Multimedia();
//        $media->nom_fichier = $nomFichier;
//        $media->filepath = $filePath;
//        $media->filetype = $fileType;
//        $media->size = $fileSize;
//        $media->description = $request->input('description', ''); // Ajoutez une description si fournie
//        //$media->uploaded_by = auth()->id(); // ID de l'utilisateur connecté
//        $media->uploaded_by = 1; // ID de l'utilisateur connecté, ou utilisez `auth()->id()` si disponible
//        $media->related_id = $portefeuille->num_portefeuil; // Lier l'ID du portefeuille
//        $media->related_name = "portefeuille"; // pour distinguer les fichiers liés
//
//        // Sauvegarder le fichier dans la base de données
//        $media->save();
//
//        return response()->json(['message' => 'Fichier enregistré avec succès.']);
//    } else {
//        return response()->json(['error' => 'Le fichier téléchargé est invalide.'], 400);
//    }
//} else {
//    return response()->json(['error' => 'Aucun fichier n\'a été téléchargé.'], 400);
//}



    }else{


        // Créer un nouveau portefeuille
        $portefeuille = new Portefeuille();
        $portefeuille->num_portefeuil = $request->num_portefeuil;
        $portefeuille->nom_journal = $request->nom_journal;
        $portefeuille->num_journal = $request->num_journal;
        $portefeuille->AE_portef = $request->AE_portef;
        $portefeuille->CP_portef = $request->CP_portef;
        $portefeuille->Date_portefeuille = $request->Date_portefeuille;
        $portefeuille->id_min =1;//periodiquement
        $portefeuille->save();

          // Enregistrer le fichier et le lier au portefeuille
    if ($request->hasFile('inputFile')) {
        // Stocker le fichier dans le dossier `public/files` et obtenir le chemin
        $path = $request->file('inputFile')->store('public/files/portefeuilles');
        $filePath = Storage::url($path);

        // Récupérer les informations du fichier
        $nomFichier = $request->file('inputFile')->getClientOriginalName();
        $fileType = $request->file('inputFile')->getClientOriginalExtension();
        $fileSize = $request->file('inputFile')->getSize();

        // Créer un nouvel enregistrement dans `multimedia`
        $media = new Multimedia();
        $media->nom_fichier = $nomFichier;
        $media->filepath = $filePath;
        $media->filetype = $fileType;
        $media->size = $fileSize;
        $media->description = $request->input('description', ''); // Ajoutez une description si fournie
        //$media->uploaded_by = auth()->id(); // ID de l'utilisateur connecté
        $media->uploaded_by = 1; // ID de l'utilisateur connecté
        $media->related_id = $portefeuille->num_portefeuil; // Lier l'ID du portefeuille
        $media->related_name = "portefeuille"; // pour distinguer

        // Sauvegarder le fichier dans la base de données
        $media->save();

        return response()->json(['message' => 'Fichier enregistré avec succès.']);
    }else{

        return response()->json(['error' => 'Aucun fichier n\'a été téléchargé.'], 400);
    }

    }

        // creation de la table  construireDPIA
        $DPIA = new ConstruireDPIA();

        $DPIA->date_creation_dpia = $portefeuille->Date_portefeuille; // elle prend la date de creation du portfeuille
        $DPIA->date_modification_dpia = $DPIA->date_creation_dpia;
        $DPIA->motif_dpia = 'Création de DPIA à partir du portefeuille';

        $DPIA->AE_dpia_nv = null;
        $DPIA->CP_dpia_nv = null;

        $DPIA->AE_ouvert_dpia = null;
        $DPIA->AE_atendu_dpia = null;
        $DPIA->CP_ouvert_dpia = null;
        $DPIA->CP_atendu_dpia = null;

        $DPIA->AE_reporte_dpia = null;
        $DPIA->AE_notifie_dpia = null;
        $DPIA->AE_engage_dpia = null;
        $DPIA->CP_reporte_dpia = null;
        $DPIA->CP_notifie_dpia = null;
        $DPIA->CP_consome_dpia = null;

        $DPIA->code_sous_operation = null;
        $DPIA->id_rp = 1;
        $DPIA->id_ra = 1;
        $DPIA->save();

        //dd( $DPIA);

        //creation de la table  construireDPic
        $DPIC = new ConstruireDPIC();

        $DPIC->date_creation_dpic = $portefeuille->Date_portefeuille; // elle prend la date de creation du portfeuille

        $DPIC->AE_dpic_nv = null;
        $DPIC->CP_dpic_nv = null;

        $DPIC->id_rff = 1; //apres elle sera avec auth:user il prend le compte qui est deja authentifié
        $DPIC->id_rp = 1;
        $DPIC->save();

        //dd( $DPIC);

        if($portefeuille)
        {
            return response()->json([
                'success' => true,
                'message' => 'Portefeuille ajouté ou modifié avec succès.',
                'code' => 200,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'ajout du portefeuille.',
                'code' => 500,
            ]);
        }


    }
//======================================================================================
                                // FIN creation du portefeuille
//===================================================================================

//======================================================================================
                                // Modification du portefeuille
//===================================================================================
function update_portef(Request $request)
{

     // Validation des données
     $request->validate([
        'num_journal' => 'required',
        'nom_journal' => 'required',
        'AE_portef' => 'required',
        'CP_portef' => 'required',
        'Date_portefeuille' => 'required|date',
    ]);


    // Récupérer la ligne de la table en fonction de 'numsouaction'
    $portefeuille = Portefeuille::where('num_portefeuil', $request->num_portefeuil)->first();
    $portefeuille = new Portefeuille();
    $portefeuille->nom_journal = $request->nom_journal;
    $portefeuille->num_journal = $request->num_journal;
    $portefeuille->AE_portef = $request->AE_portef;
    $portefeuille->CP_portef = $request->CP_portef;
    $portefeuille->Date_portefeuille = $request->Date_portefeuille;
    $portefeuille->id_min =1;//periodiquement
    $portefeuille->save();

    if($portefeuille)
        {
            return response()->json([
                'success' => true,
                'message' => 'Portefeuille modifié avec succès.',
                'code' => 200,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'ajout du portefeuille.',
                'code' => 500,
            ]);
        }
}
//======================================================================================
                                // FIN Modification du portefeuille
//===================================================================================


}
