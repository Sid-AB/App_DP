<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class opeartionController extends Controller
{
    /***************************************tableau t1************************************************** */

    public function afficherT1($portefeuille, $programme, $sousprogramme, $action, $sousaction = null)
    {
        // récupérer les details du path 
        $portefeuille = Portefeuille::findOrFail($portefeuille);
        $programme = Programme::findOrFail($programme);
        $sousProgramme = SousProgramme::findOrFail($sousprogramme);
        $action = Action::findOrFail($action);

        // si ya sous-action  on la récupère
        $sousAction = $sousaction ? SousAction::findOrFail($sousaction) : null;

        // récupérer les opérations de T1
        $operationsT1 = Operation::where('code_t1', 'T1')
            ->when($sousAction, function ($query) use ($sousAction) {
                return $query->where('num_sous_action', $sousAction->id);
            }, function ($query) use ($action) {
                return $query->where('num_action', $action->id);  //id var de l'action du path
            })
            ->with('sousOperations') // Charger les sous opérations si elles existent
            ->get();
          //dd($operationsT1);

        // initialiser les sommes totales AE et CP pour T1
        $totalAeT1 = 0;
        $totalCpT1 = 0;
        $groupOperationsAe = [];
        $groupOperationsCp = [];

        // Calcul des AE et CP par sous-opération, opération et groupe d'opération
        foreach ($operationsT1 as $operation) {
            $aeOperation = 0;
            $cpOperation = 0;

            // Si l'opération a des sous-opérations
            if ($operation->sousOperations->isNotEmpty()) {
                foreach ($operation->sousOperations as $sousOperation) {
                    $aeOperation += $sousOperation->ae; // AE de la sous-opération
                    $cpOperation += $sousOperation->cp; // CP de la sous-opération
                }
            } else {
                // Si l'opération n'a pas de sous-opérations, on utilise directement ses valeurs AE et CP
                $aeOperation = $operation->ae;
                $cpOperation = $operation->cp;
            }

            // Ajouter les AE et CP de l'opération dans les groupes d'opérations
            $groupOperationsAe[$operation->group_operation_id] = ($groupOperationsAe[$operation->group_operation_id] ?? 0) + $aeOperation;
            $groupOperationsCp[$operation->group_operation_id] = ($groupOperationsCp[$operation->group_operation_id] ?? 0) + $cpOperation;

            // Ajouter à la somme totale AE et CP de T1
            $totalAeT1 += $aeOperation;
            $totalCpT1 += $cpOperation;
        }

        // Passer les résultats à la vue
        return view('portefeuilles.t1', compact('portefeuille', 'programme', 'sousProgramme', 'action', 'sousAction', 'operationsT1', 'totalAeT1', 'totalCpT1', 'groupOperationsAe', 'groupOperationsCp'));
    }
}
