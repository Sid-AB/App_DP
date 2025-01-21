<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmploiBudgetController extends Controller
{
    //la fonction insert 
    public function insertemploi(Request $request){
        dd($request);

        if ($request->type_pos === 'funt') {

            Emploi_budget::updateOrCreate(
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


            Fonctions::updateOrCreate([
                'Nom_fonction' => $request->funt_sup,
                'Moyenne' => $request->cl_moy,
                'CATEGORIE' => $request->cl_cat,
             
                'date_insert_fonct'=>now(),
                'date_update_fonct'=>now(),
            ]);
        }

    }
}
