<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portefeuille;
use App\Models\Programme;
use App\Models\Action;
use App\Models\SousProgramme;
use App\Models\ConstruireDPIA;
use App\Models\ConstruireDPIC;
use Carbon\Carbon;
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
            'file' => 'required|file|mimes:jpg,png,pdf|max:2048', // Validation du fichier
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
/*
// Enregistrer le fichier et le lier au portefeuille
if ($request->hasFile('file')) {
    dd($request);
    // Vérifier si le fichier est valide
    if ($request->file('file')->isValid()) {
        // Stocker le fichier dans le dossier `public/files/portefeuilles` et obtenir le chemin
        $path = $request->file('file')->store('public/files/portefeuilles');
        $filePath = Storage::url($path);

        // Récupérer les informations du fichier
        $nomFichier = $request->file('file')->getClientOriginalName();
        $fileType = $request->file('file')->getClientOriginalExtension();
        $fileSize = $request->file('file')->getSize();

        // Créer un nouvel enregistrement dans `multimedia`
        $media = new Multimedia();
        $media->nom_fichier = $nomFichier;
        $media->filepath = $filePath;
        $media->filetype = $fileType;
        $media->size = $fileSize;
        $media->description = $request->input('description', ''); // Ajoutez une description si fournie
        //$media->uploaded_by = auth()->id(); // ID de l'utilisateur connecté
        $media->uploaded_by = 1; // ID de l'utilisateur connecté, ou utilisez `auth()->id()` si disponible
        $media->related_id = $portefeuille->num_portefeuil; // Lier l'ID du portefeuille
        $media->related_name = "portefeuille"; // pour distinguer les fichiers liés

        // Sauvegarder le fichier dans la base de données
        $media->save();

        return response()->json(['message' => 'Fichier enregistré avec succès.']);
    } else {
        return response()->json(['error' => 'Le fichier téléchargé est invalide.'], 400);
    }
} else {
    return response()->json(['error' => 'Aucun fichier n\'a été téléchargé.'], 400);
}
*/

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
    if ($request->hasFile('file')) {
        // Stocker le fichier dans le dossier `public/files` et obtenir le chemin
        $path = $request->file('file')->store('public/files/portefeuilles');
        $filePath = Storage::url($path);

        // Récupérer les informations du fichier
        $nomFichier = $request->file('file')->getClientOriginalName();
        $fileType = $request->file('file')->getClientOriginalExtension();
        $fileSize = $request->file('file')->getSize();

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
    function show_prsuiv(Request $request)
    {

      //  dd($request);
        $path=$request->all();
        $leng=count($path);
        return view('Portfail-in.prsuiv',compact('path','leng'));
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
