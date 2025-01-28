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

class EmploiBudgetController extends Controller
{
    //la fonction insert 
    public function insertemploi(Request $request){
        dd($request);

        $emploi=Emploi_budget::updateOrCreate(
            [
                'EmploiesOuverts'=>$request->bg_overt,
                'EmploiesOccupes'=>$request->bg_occup,
                'EmploiesVacants'=>$request->bg_vacant,
                'TRAITEMENT_ANNUEL'=>$request->tr_annuel,
                'PRIMES_INDEMNITES'=>$request->pr_ind,
                'DEPENSES_ANNUELLES'=>$request->depn_annuel,
                'date_insert_emploi'=>now(),
                'date_update_emploi'=>now(),
            ]
            );
        if ($request->type_pos === 'funt') {

            Fonctions::updateOrCreate([
                'Nom_fonction' => $request->funt_sup,
                'CATEGORIE' => $request->cl_cat,
                'Moyenne' => $request->cl_moy,
                'id_emp' => $emploi->id_emp,
                'date_insert_fonct'=>now(),
                'date_update_fonct'=>now(),
            ]);

        } elseif($request->type_pos === 'post_sup'){
            
                Post_sup::updateOrCreate([
                    'Nom_postsup' => $request->funt_sup,
                    'Niveau_sup' => $request->cl_cat,
                    'point_indsup' => $request->cl_moy,
                    'id_emp' => $emploi->id_emp,
                    'date_insert_postsup'=>now(),
                    'date_update_postsup'=>now(),
                ]);
            } elseif($request->type_pos === 'corcom'){
               
                    Post_commun::updateOrCreate([
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


    //la fonction get pour afficher les resultats 
  
}

    

