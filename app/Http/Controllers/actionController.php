<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class actionController extends Controller
{
    public function afficher_detail()
    {
        return view('Action-in.index');
    }

    public function insertDPA(Request $request, $t1, $t2, $t3, $t4)
{   if($t1==1)
    {
    $montants = $request->input('montants');

    foreach ($montants as $code => $montant) {
        // Vérifier si le code représente un groupe d'opération
        if ($code % 1000 == 0) {
            // Insérer dans la table groupoperation
            GroupOperation::updateOrCreate(
                ['code_gp' => $code],
                ['montant' => $montant]
            );
        }
        // Vérifier si le code représente une opération
        elseif ($code % 100 == 0) {
            // Récupérer le code du groupe d'opération (par exemple 11000 pour le code 11100)
            $codeGp = floor($code / 1000) * 1000;

            // Insérer dans la table operation
            Operation::updateOrCreate(
                ['code_op' => $code],
                ['code_gp' => $codeGp, 'montant' => $montant]
            );
        }
        // Sinon, il s'agit d'une sous-opération
        else {
            // Récupérer le code de l'opération parent (par exemple 11100 pour le code 11110)
            $codeOp = floor($code / 100) * 100;

            // Insérer dans la table sousoperation
            SousOperation::updateOrCreate(
                ['code_sop' => $code],
                ['code_op' => $codeOp, 'montant' => $montant]
            );
        }
    }

    return back()->with('success', 'Données insérées avec succès !');
}elseif($t2==2)
{
    $montants = $request->input('montants');

    foreach ($montants as $code => $montant) {
        // Vérifier si le code représente un groupe d'opération
        if ($code % 1000 == 0) {
            // Insérer dans la table groupoperation
            GroupOperation::updateOrCreate(
                ['code_gp' => $code],
                ['montant' => $montant]
            );
        }
        // Vérifier si le code représente une opération
        elseif ($code % 100 == 0) {
            // Récupérer le code du groupe d'opération (par exemple 11000 pour le code 11100)
            $codeGp = floor($code / 1000) * 1000;

            // Insérer dans la table operation
            Operation::updateOrCreate(
                ['code_op' => $code],
                ['code_gp' => $codeGp, 'montant' => $montant]
            );
        }
        // Sinon, il s'agit d'une sous-opération
        else {
            // Récupérer le code de l'opération parent (par exemple 11100 pour le code 11110)
            $codeOp = floor($code / 100) * 100;

            // Insérer dans la table sousoperation
            SubOperation::updateOrCreate(
                ['code_sop' => $code],
                ['code_op' => $codeOp, 'montant' => $montant]
            );
        }
    }

    return back()->with('success', 'Données insérées avec succès !');

}elseif ($t3==3) {
    $montants = $request->input('montants');

    foreach ($montants as $code => $montant) {
        // Vérifier si le code représente un groupe d'opération
        if ($code % 1000 == 0) {
            // Insérer dans la table groupoperation
            GroupOperation::updateOrCreate(
                ['code_gp' => $code],
                ['montant' => $montant]
            );
        }
        // Vérifier si le code représente une opération
        elseif ($code % 100 == 0) {
            // Récupérer le code du groupe d'opération (par exemple 11000 pour le code 11100)
            $codeGp = floor($code / 1000) * 1000;

            // Insérer dans la table operation
            Operation::updateOrCreate(
                ['code_op' => $code],
                ['code_gp' => $codeGp, 'montant' => $montant]
            );
        }
        // Sinon, il s'agit d'une sous-opération
        else {
            // Récupérer le code de l'opération parent (par exemple 11100 pour le code 11110)
            $codeOp = floor($code / 100) * 100;

            // Insérer dans la table sousoperation
            SubOperation::updateOrCreate(
                ['code_sop' => $code],
                ['code_op' => $codeOp, 'montant' => $montant]
            );
        }
    }

    return back()->with('success', 'Données insérées avec succès !');
}elseif (t4==4) {
    $montants = $request->input('montants');

    foreach ($montants as $code => $montant) {
        // Vérifier si le code représente un groupe d'opération
        if ($code % 1000 == 0) {
            // Insérer dans la table groupoperation
            GroupOperation::updateOrCreate(
                ['code_gp' => $code],
                ['montant' => $montant]
            );
        }
        // Vérifier si le code représente une opération
        elseif ($code % 100 == 0) {
            // Récupérer le code du groupe d'opération (par exemple 11000 pour le code 11100)
            $codeGp = floor($code / 1000) * 1000;

            // Insérer dans la table operation
            Operation::updateOrCreate(
                ['code_op' => $code],
                ['code_gp' => $codeGp, 'montant' => $montant]
            );
        }
        // Sinon, il s'agit d'une sous-opération
        else {
            // Récupérer le code de l'opération parent (par exemple 11100 pour le code 11110)
            $codeOp = floor($code / 100) * 100;

            // Insérer dans la table sousoperation
            SubOperation::updateOrCreate(
                ['code_sop' => $code],
                ['code_op' => $codeOp, 'montant' => $montant]
            );
        }
    }

    return back()->with('success', 'Données insérées avec succès !');
}
}
}
