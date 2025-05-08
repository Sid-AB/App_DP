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
                'num_sous_action'=>$request->id_s_act,
                'EmploiesOuverts'=>$request->bg_overt,
                'EmploiesOccupes'=>$request->bg_occup,
                'EmploiesVacants'=>$request->bg_vacant,
                'TRAITEMENT_ANNUEL'=>$request->tr_annuel,
                'PRIMES_INDEMNITES'=>$request->pr_ind,
                'DEPENSES_ANNUELLES'=>$request->depn_annuel,
                'code_t1'=>$request->code_t1,
                'date_insert_emploi'=>now(),
                'date_update_emploi'=>now(),
                'num_sous_action'=>$request->id_s_act,
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
    public function printallemploi($id)
    {
       
            //recuperer toutes les données des tables 
        $fonctions = Emploi_budget::join('fonctions','fonctions.id_emp','=','emploi_budgets.id_emp')->where('emploi_budgets.num_sous_action',$id)->orderBy('fonctions.id_fonction')->get();
      
        $posts = Emploi_budget::join('post_sups','post_sups.id_emp','=','emploi_budgets.id_emp')->where('emploi_budgets.num_sous_action',$id)->orderBy('post_sups.id_postsup')->get();
        //dd( $posts);
        $communs=  Emploi_budget::join('post_communs','post_communs.id_emp','=','emploi_budgets.id_emp')->where('emploi_budgets.num_sous_action',$id)->orderBy('post_communs.id_post')->get();
        
        $op= Emploi_budget::join('opconducteurs','opconducteurs.id_emp','=','emploi_budgets.id_emp')->where('emploi_budgets.num_sous_action',$id)->orderBy('opconducteurs.id_opconducteurs')->get();
        //dd($op);
        $cdd=  Emploi_budget::join('c_d_d_s','c_d_d_s.id_emp','=','emploi_budgets.id_emp')->where('emploi_budgets.num_sous_action',$id)->orderBy('c_d_d_s.id_c_d_d_s')->get();
        $cdi=  Emploi_budget::join('c_d_i_s','c_d_i_s.id_emp','=','emploi_budgets.id_emp')->where('emploi_budgets.num_sous_action',$id)->orderBy('c_d_i_s.id_c_d_i_s')->get();
        
        // calcul des totaux des colonnes
       $totalOuvertsfct = $fonctions->sum('EmploiesOuverts');
       $totalOccupesfct = $fonctions->sum('EmploiesOccupes');
       $totalVacantsfct = $fonctions->sum('EmploiesVacants');

       $totalOuvertspost = $posts->sum('EmploiesOuverts');
       $totalOccupespost = $posts->sum('EmploiesOccupes');
       $totalVacantspost = $posts->sum('EmploiesVacants');

       $totalOuvertscomm = $communs->sum('EmploiesOuverts');
       $totalOccupescomm = $communs->sum('EmploiesOccupes');
       $totalVacantscomm = $communs->sum('EmploiesVacants');

       $totalOuvertsfct = $op->sum('EmploiesOuverts');
       $totalOccupesfct = $op->sum('EmploiesOccupes');
       $totalVacantsfct = $op->sum('EmploiesVacants');

       $totalOuvertspost = $cdd->sum('EmploiesOuverts');
       $totalOccupespost = $cdd->sum('EmploiesOccupes');
       $totalVacantspost = $cdd->sum('EmploiesVacants');

       $totalOuvertscomm = $cdi->sum('EmploiesOuverts');
       $totalOccupescomm = $cdi->sum('EmploiesOccupes');
       $totalVacantscomm = $cdi->sum('EmploiesVacants');
        $pdf=SnappyPdf::loadView
        ('impression.impression_emplois_budgetaire', compact(
           'fonctions',
           'totalOuvertsfct',
           'totalOccupesfct',
           'totalVacantsfct',
          'totalOuvertspost',
          'totalOccupespost',
          'totalVacantspost',
          'totalOuvertscomm', 'totalOccupescomm','totalVacantscomm',
          'posts',
          'communs','op','cdd','cdi'

        ))->setPaper("A4","landscape");
           // Augmenter la résolution pour améliorer la lisibilité du texte
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
   


function get_list_postsup($id)

{

    $postssup=Emploi_budget::join('post_sups','post_sups.id_emp','=','emploi_budgets.id_emp')->orderBy('post_sups.id_postsup')->get();
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

function get_list_post_communs($id)

{

    $postssup=Emploi_budget::join('post_communs','post_communs.id_emp','=','emploi_budgets.id_emp')->orderBy('post_communs.id_post')->get();
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


function get_list_cdd($id)

{

    $postssup=Emploi_budget::join('c_d_d_s','c_d_d_s.id_emp','=','emploi_budgets.id_emp')->orderBy('c_d_d_s.id_c_d_d_s')->get();
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


function get_list_cdi($id)

{

    $postssup=Emploi_budget::join('c_d_i_s','c_d_i_s.id_emp','=','emploi_budgets.id_emp')->orderBy('c_d_i_s.id_c_d_i_s')->get();
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


function get_list_OAC($id)

{

    $postssup=Emploi_budget::join('opconducteurs','opconducteurs.id_emp','=','emploi_budgets.id_emp')->orderBy('opconducteurs.id_opconducteurs')->get();
   // dd($postssup);
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

function get_list_fonction($id)

{
    $postssup=Emploi_budget::join('fonctions','fonctions.id_emp','=','emploi_budgets.id_emp')->orderBy('fonctions.id_fonction')->get();
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
    if($request->type_pos == 'corcom')
    {
      if(  Post_commun::where('id_emp',$request->delID)->delete() &&
        Emploi_budget::where('id_emp',$request->delID)->delete()
    )
    {
        return response()->json(['code'=>200]);
    }
}
    if($request->type_pos == 'post_sup')
    {
      if(  Post_sup::where('id_emp',$request->delID)->delete() &&
        Emploi_budget::where('id_emp',$request->delID)->delete()
    )
    {
        return response()->json(['code'=>200]);
    }
    }
    if($request->type_pos == 'cdi')
    {
      if(  CDI::where('id_emp',$request->delID)->delete() &&
        Emploi_budget::where('id_emp',$request->delID)->delete()
    )
    {
        return response()->json(['code'=>200]);
    }
    }
    if($request->type_pos == 'cdd')
    {
      if(  CDD::where('id_emp',$request->delID)->delete() &&
        Emploi_budget::where('id_emp',$request->delID)->delete()
    )
    {
        return response()->json(['code'=>200]);
    }
    
}
if($request->type_pos == 'opconducteur')
{
  if(  OpConducteur::where('id_emp',$request->delID)->delete() &&
    Emploi_budget::where('id_emp',$request->delID)->delete()
)
{
    return response()->json(['code'=>200]);
}

}
}



function print_list_fonction($id)
 {   
  
    $data= Emploi_budget::join('fonctions','fonctions.id_emp','=','emploi_budgets.id_emp')->where('emploi_budgets.num_sous_action',$id)->orderBy('fonctions.id_fonction')->get();
   
   // dd($fonction);

   return $this->imprimer($data, 'fonction'); 
}

function print_list_postsup($id)
{
    //dd($id);
    $data=Emploi_budget::join('post_sups','post_sups.id_emp','=','emploi_budgets.id_emp')->where('emploi_budgets.num_sous_action',$id)->orderBy('post_sups.id_postsup')->get();
   // dd($data);
    return $this->imprimer($data, 'postsup');
} //la fonction get pour afficher les resultats 

function print_list_post_communs($id)

{
    $data=Emploi_budget::join('post_communs','post_communs.id_emp','=','emploi_budgets.id_emp')->where('emploi_budgets.num_sous_action',$id)->orderBy('post_communs.id_post')->get();
   //dd($data);
    return $this->imprimer($data, 'post_communs');
}

function print_list_OAP($id)

{
    $data=Emploi_budget::join('opconducteurs','opconducteurs.id_emp','=','emploi_budgets.id_emp')->where('emploi_budgets.num_sous_action',$id)->orderBy('opconducteurs.id_opconducteurs')->get();
   //dd($data);
    return $this->imprimer($data, 'OAP');
}

function print_list_CDD($id)

{
    $data=Emploi_budget::join('c_d_d_s','c_d_d_s.id_emp','=','emploi_budgets.id_emp')->where('emploi_budgets.num_sous_action',$id)->orderBy('c_d_d_s.id_c_d_d_s')->get();
   //dd($data);
    return $this->imprimer($data, 'cdd');
}

function print_list_CDI($id)

{
    $data=Emploi_budget::join('c_d_i_s','c_d_i_s.id_emp','=','emploi_budgets.id_emp')->where('emploi_budgets.num_sous_action',$id)->orderBy('c_d_i_s.id_c_d_i_s')->get();
   //dd($data);
    return $this->imprimer($data, 'cdi');
}
function imprimer($data, $type)
{
    if(!empty($data))
    {
        $totalOuverts = $data->sum('EmploiesOuverts');
       $totalOccupes = $data->sum('EmploiesOccupes');
       $totalVacants = $data->sum('EmploiesVacants');
        
       $pdf=SnappyPdf::loadView('impression.emploibudgetchaqetable', compact('data', 'type','totalOuverts', 'totalOccupes', 'totalVacants'))
       ->setPaper("A4","landscape")->setOption('dpi', 300) ->setOption('zoom', 1);//lanscape mean orentation
             return $pdf->stream('emploi_budget_fonction.pdf');
    }
    else
    {
         return response()->json([
            'code' => 500,
            'message' => 'Aucune donnée trouvée',
            
        ]);
    }

}


  
}

    

