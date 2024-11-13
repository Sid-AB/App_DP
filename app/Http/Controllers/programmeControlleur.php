<?php

namespace App\Http\Controllers;

use App\Models\Programme;
use Illuminate\Http\Request;

class programmeControlleur extends Controller
{
    //===================================================================================
                                //affichage du programme
    //===================================================================================
    function affich_prog( $num_portefeuil)
    {
           // Récupérer les programmes qui ont le même num_port
    $programmes = Programme::where('num_portefeuil', $num_portefeuil)->get();

    // Vérifier si des programmes existent
    if ($programmes->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => 'Aucun programme trouvé pour ce programme.',
        ]);
    }

    // Retourner les programmes à la vue
        return view('Portfail-in.index', compact('programmes'));
    }

    //===================================================================================
                                //DEBUT CHECK
//===================================================================================

    public function check_prog(Request $request)
    {
        // Validation de la requête
    $request->validate([
        'num_prog' => 'required',
    ]);

        $prog = programme::where('num_prog', $request->num_prog)->first();

        if ($prog) {
            return response()->json([
                'exists' => true,
                'nom_prog' => $prog->nom_prog,
                'num_prog' => $prog->num_prog,
                'AE_prog'=>$prog->AE_prog,
                'CP_prog'=>$prog->CP_prog,
                'date_insert_portef' => $prog->date_insert_portef,
            ]);
        }

        return response()->json(['exists' => false]);
    }
//===================================================================================
                                //FIN CHECK
//===================================================================================

 //===================================================================================
                                // creation du programme
//===================================================================================
    function creat_prog(Request $request)
    {
        // Validation des données
        $request->validate([
            'num_prog' => 'required',
            'nom_prog' => 'required',
            'date_insert_portef' => 'required|date',
        ]);
        //dd(floatval($request->ae_prog));
  //     dd($request);
        // Créer un nouveau programme
        $prog=Programme::where('num_prog',intval($request->num_prog))->first();
      //  dd($prog);
        if(isset($prog))
        {
            return response()->json([
                'success' => true,
                'message' => 'Exist programme .',
                'code' => 200,
            ]);
        }
        else{
        $programme = new Programme();
        $programme->num_prog = $request->num_prog;
        $programme->cp_prog = $request->cp_prog;
        $programme->ae_prog = $request->ae_prog;
        $programme->num_portefeuil = $request->num_portefeuil;
        $programme->nom_prog = $request->nom_prog;
        $programme->ae_prog=floatval($request->ae_prog);
        $programme->cp_prog=floatval($request->cp_prog);
        $programme->date_insert_portef = $request->date_insert_portef;
        $programme->id_rp = 1; //periodiquement

        $programme->save();

        // Enregistrer le fichier et le lier au portefeuille
    if ($request->hasFile('file')) {
        $path = $request->file('file')->store('public/files');
        $filePath = Storage::url($path);

        // Créer un nouvel enregistrement dans multi_media avec le chemin du fichier et l'ID du portefeuille
        $media = new MultiMedia();
        $media->prog_id = $prog_id->id;
        $media->file_path = $filePath;
        $media->save();
    }
    
        //dd($programme);
        if ($programme) {
            return response()->json([
                'success' => true,
                'message' => 'Programme ajouté avec succès.',
                'code' => 200,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'ajout du programme.',
                'code' => 500,
            ]);
        }
    }
    }

}
