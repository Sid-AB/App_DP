<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portefeuille;
use App\Models\Programme;
use App\Models\Action;
use App\Models\SousProgramme;
use App\Models\ConstruireDPIA;
use App\Models\ConstruireDPIC;
class portfeuilleController extends Controller
{

//===================================================================================
                                //affichage du portrefeuille
//===================================================================================
    function affich_portef($id)
    {
        // Récupérer tous les portefeuilles de la base de données
          //  $portefeuilles = Portefeuille::all();

    // Passer les données à la vue
        return view('Portfail-in.index', /*compact('portefeuilles')*/);
    }
    //affichage formulaire
    function form_portef()
    {
        return view('Portfail-in.creation');
    }
//===================================================================================
                                // creation du portefeuille
//===================================================================================
    function creat_portef(Request $request)
    {

        //dd($request);
         // Validation des données
         $request->validate([
            'num_portefeuil' => 'required|unique:portefeuilles,num_portefeuil',
            'num_journal' => 'required',
            'nom_journal' => 'required',
            'AE_portef' => 'required',
            'CP_portef' => 'required',
            'Date_portefeuille' => 'required|date',
        ]);

        // Vérifier si le portefeuille existe déjà
        $year = date('Y'); // Récupérer l'année actuelle
        $num=$request->num_portefeuil.$year;
        $existing = Portefeuille::where('num_portefeuil', $num)->first();

        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'Le portefeuille avec ce numéro  existe déjà.',
                'code' => 302, // Utiliser un code 302 pour redirection (redirection implicite)
                'data' => $existing, // Inclure les données du portefeuille existant
            ]);
        }

        // Créer un nouveau portefeuille
        $portefeuille = new Portefeuille();
        $portefeuille->num_portefeuil = $num;
        $portefeuille->nom_journal = $request->nom_journal;
        $portefeuille->num_journal = $request->num_journal;
        $portefeuille->AE_portef = $request->AE_portef;
        $portefeuille->CP_portef = $request->CP_portef;
        $portefeuille->Date_portefeuille = $request->Date_portefeuille;
        $portefeuille->id_min =1;//periodiquement
        $portefeuille->save();
       // dd($portefeuille);


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
                'message' => 'Portefeuille ajouté avec succès.',
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

}
