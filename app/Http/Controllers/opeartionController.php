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
use App\Http\Controllers\AeCpController;

Route::get('/path/{path}/t1', [AeCpController::class, 'showT1'])->name('showT1');
Route::get('/path/{path}/t2', [AeCpController::class, 'showT2'])->name('showT2');
Route::get('/path/{path}/t3', [AeCpController::class, 'showT3'])->name('showT3');
Route::get('/path/{path}/t4', [AeCpController::class, 'showT4'])->name('showT4');
namespace App\Http\Controllers;

use App\Services\AeCpService;
use Illuminate\Http\Request;

class AeCpController extends Controller
{
    protected $aeCpService;

    public function __construct(AeCpService $aeCpService)
    {
        $this->aeCpService = $aeCpService;
    }

    /**
     * Affiche les données pour la période t1.
     */
    public function showT1($path)
    {
        $data = $this->aeCpService->getAeCpDataFromPath($path, 't1');
        return view('resultat_t1', compact('data'));
    }

    /**
     * Affiche les données pour la période t2.
     */
    public function showT2($path)
    {
        $data = $this->aeCpService->getAeCpDataFromPath($path, 't2');
        return view('resultat_t2', compact('data'));
    }

    /**
     * Affiche les données pour la période t3.
     */
    public function showT3($path)
    {
        $data = $this->aeCpService->getAeCpDataFromPath($path, 't3');
        return view('resultat_t3', compact('data'));
    }

    /**
     * Affiche les données pour la période t4.
     */
    public function showT4($path)
    {
        $data = $this->aeCpService->getAeCpDataFromPath($path, 't4');
        return view('resultat_t4', compact('data'));
    }
}
