<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emploi_budget;
use App\Models\Fonctions;
use App\Models\Post_sup;
use App\Models\Post_commun;
use App\Models\OpConducteur;
use App\Models\CDI;
use App\Models\CDD;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmploiBudgetController extends Controller
{
    //la fonction insert 
    public function insertemploi(Request $request){
        //dd($request);
        $emploi=Emploi_budget::updateOrCreate(
            [
                'EmploiesOuverts'=>$request->bg_overt,
                'EmploiesOccupes'=>$request->bg_occup,
                'EmploiesVacants'=>$request->bg_vacant,
                'TRAITEMENT_ANNUEL'=>$request->tr_annuel,
                'PRIMES_INDEMNITES'=>$request->pr_ind,
                'DEPENSES_ANNUELLES'=>$request->depn_annuel,
                'code_t1'=>$request->code_t1,
                'date_insert_emploi'=>now(),
                'date_update_emploi'=>now(),
            ]
            );
        if ($request->type_pos === 'funt') {

            Fonctions::updateOrCreate([
                'id_fonction'=>$request->funt_sup.'_'.$request->cl_cat,
                'Nom_fonction' => $request->funt_sup,
                'CATEGORIE' => $request->cl_cat,
                'Moyenne' => $request->cl_moy,
                'id_emp' => $emploi->id_emp,
                'date_insert_fonct'=>now(),
                'date_update_fonct'=>now(),
            ]);

        } elseif($request->type_pos === 'post_sup'){
            
                Post_sup::updateOrCreate([
                    //'id_postsup'=>$request->funt_sup.'_'.$request->cl_cat,
                    'Nom_postsup' => $request->funt_sup,
                    'Niveau_sup' => $request->cl_cat,
                    'point_indsup' => $request->cl_moy,
                    'id_emp' => $emploi->id_emp,
                    'date_insert_postsup'=>now(),
                    'date_update_postsup'=>now(),
                ]);
            } elseif($request->type_pos === 'corcom'){
               
                    Post_commun::updateOrCreate([
                        //'id_post'=>$request->funt_sup.'_'.$request->cl_cat,
                        'Nom_post' => $request->funt_sup,
                        'CATEGORIE_post' => $request->cl_cat,
                        'MOYENNE_post' => $request->cl_moy,
                        'id_emp' => $emploi->id_emp,
                        'date_insert_postcommun'=>now(),
                        'date_update_postcommun'=>now(),
                    ]);

            }elseif($request->type_pos === 'opconducteur'){
            
                    OpConducteur::updateOrCreate([
                        'Nom_opconducteurs' => $request->funt_sup,
                        'CATEGORIE_opconducteurs' => $request->cl_cat,
                        'MOYENNE_opconducteurs' => $request->cl_moy,
                        'id_emp' => $emploi->id_emp,
                        'date_insert_opconducteur'=>now(),
                        'date_update_opconducteur'=>now(),
                    ]);
                }elseif($request->type_pos === 'cdi'){
                  
                        CDI::updateOrCreate([
                            'Nom_c_d_i_s' => $request->funt_sup,
                            'CATEGORIE_c_d_i_s' => $request->cl_cat,
                            'MOYENNE_c_d_i_s' => $request->cl_moy,
                            'id_emp' => $emploi->id_emp,
                            'date_insert_cdi'=>now(),
                            'date_update_cdi'=>now(),
                        ]);
                    }elseif($request->type_pos === 'cdd'){
                       
                            CDD::updateOrCreate([
                                'Nom_c_d_d_s' => $request->funt_sup,
                                'CATEGORIE_c_d_d_s' => $request->cl_cat,
                                'MOYENNE_c_d_d_s' => $request->cl_moy,
                                'id_emp' => $emploi->id_emp,
                                'date_insert_cdd'=>now(),
                                'date_update_cdd'=>now(),
                            ]);
                        } else {
                            return response()->json([
                                'code' => 500,
                                'message' => 'erreur']);
                        }
                    
                        return response()->json([
                            'code' => 200,
                            'message' => 'Données insérées ou mises à jour avec succès',
                            'id_emp' => $emploi->id_emp,
                        ]);
    }
    public function index()
    {
        // Récupérer toutes les données de la table Fonctions

        $fonctions = Fonctions::select('Nom_fonction', 'Moyenne', 'CATEGORIE')->get();
        $emplois = Emploi_budget::select('EmploiesOuverts', 'EmploiesOccupes', 'EmploiesVacants','TRAITEMENT_ANNUEL','PRIMES_INDEMNITES','DEPENSES_ANNUELLES')->get();
        $posts =Post_Sup::select('Nom_postsup', 'Niveau_sup', 'point_indsup')->get();
        $communs= Post_commun::select('Nom_post','CATEGORIE_post','MOYENNE_post')->get();
        // Calcul des totaux des colonnes
       $totalOuverts = $emplois->sum('EmploiesOuverts');
       $totalOccupes = $emplois->sum('EmploiesOccupes');
       $totalVacants = $emplois->sum('EmploiesVacants');
        $pdf=SnappyPdf::loadView
        ('impression.impression_emplois_budgetaire', compact(
           'fonctions',
           'emplois',
           'totalOuverts',
           'totalOccupes',
          'totalVacants',
          'posts',
          'communs'

        ))->setPaper("A4","landscape")
          ->setOption('dpi', 300) 
          ->setOption('zoom', 1.75);  // Augmenter la résolution pour améliorer la lisibilité du texte
          return $pdf->stream('liste_budgetaires.pdf');
        // Passer les données à la vue sans les afficher directement
       // return view('impression_emplois_budgetaire', compact('fonctions'));
    }
    public function post_superieur()
{
    // Récupérer toutes les données de la table Post_sup
    $posts = PostSup::all();

    // Passer les données à la vue
    return view('votre_vue', compact('posts'));
}
   


function get_list_postsup()

{

    $postssup=Emploi_budget::join('post_sups','post_sups.id_emp','=','emploi_budgets.id_emp')->get();
    if(!empty($postssup))
    {
        $totalOuverts = $postssup->sum('EmploiesOuverts');
       $totalOccupes = $postssup->sum('EmploiesOccupes');
       $totalVacants = $postssup->sum('EmploiesVacants');
         return response()->json([
            'code' => 200,
            'message' => 'Données insérées ou mises à jour avec succès',
            'postsup' => $postssup,
            'totalOuverts'=>$totalOuverts,
            'totalOccupes'=>$totalOccupes,
            'totalVacants'=>$totalVacants,
        ]);
    }
    else
    {
         return response()->json([
            'code' => 500,
            'message' => 'Function Errors',
            
        ]);
    }

} //la fonction get pour afficher les resultats 

function get_list_post_communs()

{

    $postssup=Emploi_budget::join('post_communs','post_communs.id_emp','=','emploi_budgets.id_emp')->get();
    if(!empty($postssup))
    {
        $totalOuverts = $postssup->sum('EmploiesOuverts');
       $totalOccupes = $postssup->sum('EmploiesOccupes');
       $totalVacants = $postssup->sum('EmploiesVacants');
         return response()->json([
            'code' => 200,
            'message' => 'Données insérées ou mises à jour avec succès',
            'postsup' => $postssup,
            'totalOuverts'=>$totalOuverts,
            'totalOccupes'=>$totalOccupes,
            'totalVacants'=>$totalVacants,
        ]);
    }
    else
    {
         return response()->json([
            'code' => 500,
            'message' => 'Function Errors',
            
        ]);
    }

}

function get_list_fonction()

{


   
    $postssup=Emploi_budget::join('fonctions','fonctions.id_emp','=','emploi_budgets.id_emp')->get();
    if(!empty($postssup))
    { $totalOuverts = $postssup->sum('EmploiesOuverts');
        $totalOccupes = $postssup->sum('EmploiesOccupes');
        $totalVacants = $postssup->sum('EmploiesVacants');
         return response()->json([
            'code' => 200,
            'message' => 'Données insérées ou mises à jour avec succès',
            'postsup' => $postssup,
            'totalOuverts'=>$totalOuverts,
            'totalOccupes'=>$totalOccupes,
            'totalVacants'=>$totalVacants,
        ]);
    }
    else
    {
         return response()->json([
            'code' => 500,
            'message' => 'Function Errors',
            
        ]);
    }

}

function del_emplois(Request $request)
{
    $request->validate([
        'type_pos' => 'required',
        'delID' => 'required',
    ]);
    //dd($request);
    if($request->type_pos == 'funt')
    {
      if(  Fonctions::where('id_emp',$request->delID)->delete() &&
        Emploi_budget::where('id_emp',$request->delID)->delete()
    )
    {
        return response()->json(['code'=>200]);
    }
}
}
  
}

    

