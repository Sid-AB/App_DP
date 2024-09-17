<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class actionController extends Controller
{
    public function afficher_detail()
    {
        return view('Action-in.index');
    }

    public function insertDPA(Request $request, $t1, $t2, $t3, $t4, $sousAction)
{   if($t1==1)
    {
    $montantAe = $request->input('montantAe');
    $montantCp = $request->input('montantCp');

    foreach ($montantAe as $code => $montantAe) {
        // Si le montant AE n'a pas été saisi, on lui attribue la valeur par défaut de 0.00
        $montantCp = $montantCp ?? 0.00;

        // Récupérer Montant CP pour chaque code, et s'il est vide, on lui attribue 0.00
        $montantCp = $montantsCp[$code] ?? 0.00;

        // Récupérer le nom associé à chaque code (optionnel si présent dans la requête)
        $nom = $request->input("noms[$code]");

        // Vérifier si le code représente un groupe d'opérations
        if ($code % 1000 == 0) {
            // Insertion dans la table groupoperation
            GroupOperation::updateOrCreate(
                ['code_grp_operation' => $code],
                ['nom_grp_operation' => $nom, 'AE_grp_operation' => $montantAe, 'CP_grp_operation' => $montantCp]
            );
        }
        // Vérifier si le code représente une opération
        elseif ($code % 100 == 0) {
            $codeGp = floor($code / 1000) * 1000;

            // Insertion dans la table operation
            Operation::updateOrCreate(
                ['code_operation' => $code],
                ['code_grp_operation' => $codeGp, 'nom_operation' => $nom, 'AE_operation' => $montantAe, 'CP_operation' => $montantCp]
            );
        }
        // Sinon, il s'agit d'une sous-opération
        else {
            $codeOp = floor($code / 100) * 100;

            // Insertion dans la table sousoperation
            SubOperation::updateOrCreate(
                ['code_sous_operation' => $code],
                ['code_operation' => $codeOp, 'nom_sous_operation' => $nom, 'AE_sous_operation' => $montantAe, 'CP_sous_operation' => $montantCp]
            );
        }
    }

    return back()->with('success', 'Données insérées avec succès !');

}
elseif($t2==2)
{
    $montantAe_ouvert = $request->input('montantAe_ouvert');
    $montantCp_ouvert = $request->input('montantCp_ouvert');

    $montantCp_atendu = $request->input('montantCp_atendu');
    $montantCp_atendu = $request->input('montantCp_atendu');

    foreach ($montantAe_ouvert as $code => $montantAe_ouvert) {
        // Si le montant AE n'a pas été saisi, on lui attribue la valeur par défaut de 0.00
        $montantCp_atendu = $montantCp_atendu ?? 0.00;

        // Récupérer Montant CP pour chaque code, et s'il est vide, on lui attribue 0.00
        $montantCp = $montantsCp[$code] ?? 0.00;

        // Récupérer le nom associé à chaque code (optionnel si présent dans la requête)
        $nom = $request->input("noms[$code]");

        // Vérifier si le code représente un groupe d'opérations
        if ($code % 1000 == 0) {
            // Insertion dans la table groupoperation
            GroupOperation::updateOrCreate(
                ['code_grp_operation' => $code],
                ['nom_grp_operation' => $nom, 'AE_grp_operation' => $montantAe, 'CP_grp_operation' => $montantCp]
            );
        }
        // Vérifier si le code représente une opération
        elseif ($code % 100 == 0) {
            $codeGp = floor($code / 1000) * 1000;

            // Insertion dans la table operation
            Operation::updateOrCreate(
                ['code_operation' => $code],
                ['code_grp_operation' => $codeGp, 'nom_operation' => $nom, 'AE_operation' => $montantAe, 'CP_operation' => $montantCp]
            );
        }
        // Sinon, il s'agit d'une sous-opération
        else {
            $codeOp = floor($code / 100) * 100;

            // Insertion dans la table sousoperation
            SubOperation::updateOrCreate(
                ['code_sous_operation' => $code],
                ['code_operation' => $codeOp, 'nom_sous_operation' => $nom, 'AE_sous_operation' => $montantAe, 'CP_sous_operation' => $montantCp]
            );
        }
    }

    return back()->with('success', 'Données insérées avec succès !');

}elseif ($t3==3) {
    $montants = $request->input('montants');

    foreach ($montantAe as $code => $montantAe) {
        // Si le montant AE n'a pas été saisi, on lui attribue la valeur par défaut de 0.00
        $montantAe = $montantAe ?? 0.00;

        // Récupérer Montant CP pour chaque code, et s'il est vide, on lui attribue 0.00
        $montantCp = $montantsCp[$code] ?? 0.00;

        // Récupérer le nom associé à chaque code (optionnel si présent dans la requête)
        $nom = $request->input("noms[$code]");

        // Vérifier si le code représente un groupe d'opérations
        if ($code % 1000 == 0) {
            // Insertion dans la table groupoperation
            GroupOperation::updateOrCreate(
                ['code_grp_operation' => $code],
                ['nom_grp_operation' => $nom, 'AE_grp_operation' => $montantAe, 'CP_grp_operation' => $montantCp]
            );
        }
        // Vérifier si le code représente une opération
        elseif ($code % 100 == 0) {
            $codeGp = floor($code / 1000) * 1000;

            // Insertion dans la table operation
            Operation::updateOrCreate(
                ['code_operation' => $code],
                ['code_grp_operation' => $codeGp, 'nom_operation' => $nom, 'AE_operation' => $montantAe, 'CP_operation' => $montantCp]
            );
        }
        // Sinon, il s'agit d'une sous-opération
        else {
            $codeOp = floor($code / 100) * 100;

            // Insertion dans la table sousoperation
            SubOperation::updateOrCreate(
                ['code_sous_operation' => $code],
                ['code_operation' => $codeOp, 'nom_sous_operation' => $nom, 'AE_sous_operation' => $montantAe, 'CP_sous_operation' => $montantCp]
            );
        }
    }

    return back()->with('success', 'Données insérées avec succès !');
}elseif (t4==4) {
    $montants = $request->input('montants');

    foreach ($montantAe as $code => $montantAe) {
        // Si le montant AE n'a pas été saisi, on lui attribue la valeur par défaut de 0.00
        $montantAe = $montantAe ?? 0.00;

        // Récupérer Montant CP pour chaque code, et s'il est vide, on lui attribue 0.00
        $montantCp = $montantsCp[$code] ?? 0.00;

        // Récupérer le nom associé à chaque code (optionnel si présent dans la requête)
        $nom = $request->input("noms[$code]");

        // Vérifier si le code représente un groupe d'opérations
        if ($code % 1000 == 0) {
            // Insertion dans la table groupoperation
            GroupOperation::updateOrCreate(
                ['code_grp_operation' => $code],
                ['nom_grp_operation' => $nom, 'AE_grp_operation' => $montantAe, 'CP_grp_operation' => $montantCp]
            );
        }
        // Vérifier si le code représente une opération
        elseif ($code % 100 == 0) {
            $codeGp = floor($code / 1000) * 1000;

            // Insertion dans la table operation
            Operation::updateOrCreate(
                ['code_operation' => $code],
                ['code_grp_operation' => $codeGp, 'nom_operation' => $nom, 'AE_operation' => $montantAe, 'CP_operation' => $montantCp]
            );
        }
        // Sinon, il s'agit d'une sous-opération
        else {
            $codeOp = floor($code / 100) * 100;

            // Insertion dans la table sousoperation
            SubOperation::updateOrCreate(
                ['code_sous_operation' => $code],
                ['code_operation' => $codeOp, 'nom_sous_operation' => $nom, 'AE_sous_operation' => $montantAe, 'CP_sous_operation' => $montantCp]
            );
        }
    }

    return back()->with('success', 'Données insérées avec succès !');
}
}
}
