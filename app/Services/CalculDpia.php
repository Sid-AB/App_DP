<?php
namespace App\Services;

use App\Models\Portefeuille;
use Illuminate\Support\Facades\Log;

class CalculDpia
{
    public function calculdpiaFromPath($port, $prog, $sous_prog, $act, $s_act)
    {
        // Charger le portefeuille avec les relations
        $portefeuille = Portefeuille::where('num_portefeuil', $port)
            ->whereHas('Programme.SousProgramme.Action.SousAction', function ($query) use ($s_act) {
                $query->where('num_sous_action', $s_act);
            })
            ->with([
                'Programme.SousProgramme.Action.SousAction.GroupOperation.Operation.SousOperation'
            ])->first();

        if (!$portefeuille) {
            Log::error("Portefeuille introuvable pour num_portefeuil: {$port}, num_sous_action: {$s_act}");
            throw new \Exception("Portefeuille introuvable");
        }

        // Initialisation des calculs
        $calculs = [
            'centrale' => [
                'T1' => ['sousOperation' => [], 'operation' => [], 'group' => [], 'total' => []],
                'T2' => ['sousOperation' => [], 'operation' => [], 'group' => [], 'total' => []],
                'T3' => ['sousOperation' => [], 'operation' => [], 'group' => [], 'total' => []],
                'T4' => ['sousOperation' => [], 'operation' => [], 'group' => [], 'total' => []]
            ],
            'delegation' => [
                'T1' => ['sousOperation' => [], 'operation' => [], 'group' => [], 'total' => []],
                'T2' => ['sousOperation' => [], 'operation' => [], 'group' => [], 'total' => []],
                'T3' => ['sousOperation' => [], 'operation' => [], 'group' => [], 'total' => []],
                'T4' => ['sousOperation' => [], 'operation' => [], 'group' => [], 'total' => []]
            ]
        ];

        // Initialisation des totaux globaux
        $totauxGlobaux = [
            'centrale' => [
                'T1' => ['totalAE' => 0, 'totalCP' => 0],
                'T2' => ['totalAEouvrtvertical' => 0, 'totalAEattenduvertical' => 0, 'totalCPouvrtvertical' => 0, 'totalCPattenduvertical' => 0, 'totalAE' => 0, 'totalCP' => 0],
                'T3' => ['totalAEreportevertical' => 0, 'totalAEnotifievertical' => 0, 'totalAEengagevertical' => 0, 'totalCPreportevertical' => 0, 'totalCPnotifievertical' => 0, 'totalCPconsomevertical' => 0, 'totalAE' => 0, 'totalCP' => 0],
                'T4' => ['totalAE' => 0, 'totalCP' => 0]
            ],
            'delegation' => [
                'T1' => ['totalAE' => 0, 'totalCP' => 0],
                'T2' => ['totalAEouvrtvertical' => 0, 'totalAEattenduvertical' => 0, 'totalCPouvrtvertical' => 0, 'totalCPattenduvertical' => 0, 'totalAE' => 0, 'totalCP' => 0],
                'T3' => ['totalAEreportevertical' => 0, 'totalAEnotifievertical' => 0, 'totalAEengagevertical' => 0, 'totalCPreportevertical' => 0, 'totalCPnotifievertical' => 0, 'totalCPconsomevertical' => 0, 'totalAE' => 0, 'totalCP' => 0],
                'T4' => ['totalAE' => 0, 'totalCP' => 0]
            ]
        ];

        // Liste pour déboguer les groupes
        $groupesTrouves = [];

        // Parcourir les programmes
        foreach ($portefeuille->Programme as $programme) {
            foreach ($programme->SousProgramme as $sousProgramme) {
                foreach ($sousProgramme->Action as $action) {
                    $typeAction = $action->type_action;
                    foreach ($action->SousAction as $sousAction) {
                        foreach ($sousAction->GroupOperation as $groupe) {
                            if ($groupe->num_sous_action == $s_act) {
                                // Enregistrer le groupe pour débogage
                                $groupesTrouves[] = [
                                    'code' => $groupe->code_grp_operation,
                                    'nom' => $groupe->nom_grp_operation,
                                    'type_action' => $typeAction
                                ];

                                // Initialiser les totaux du groupe
                                $groupeTotals = [
                                    'T1' => ['ae' => 0, 'cp' => 0],
                                    'T2' => ['ae_ouvert' => 0, 'ae_attendu' => 0, 'cp_ouvert' => 0, 'cp_attendu' => 0, 'total_ae' => 0, 'total_cp' => 0],
                                    'T3' => ['ae_reporte' => 0, 'ae_notifie' => 0, 'ae_engage' => 0, 'cp_reporte' => 0, 'cp_notifie' => 0, 'cp_consome' => 0],
                                    'T4' => ['ae' => 0, 'cp' => 0]
                                ];

                                $hasGroupT1 = false;
                                $hasGroupT2 = false;
                                $hasGroupT3 = false;
                                $hasGroupT4 = false;

                                foreach ($groupe->Operation as $operation) {
                                    // Log des opérations pour débogage
                                    Log::info("Operation: {$operation->code_operation}", [
                                        'groupe' => $groupe->code_grp_operation,
                                        'sous_action' => $s_act
                                    ]);

                                    $operationTotals = [
                                        'T1' => ['ae' => 0, 'cp' => 0],
                                        'T2' => ['ae_ouvert' => 0, 'ae_attendu' => 0, 'cp_ouvert' => 0, 'cp_attendu' => 0, 'total_ae' => 0, 'total_cp' => 0],
                                        'T3' => ['ae_reporte' => 0, 'ae_notifie' => 0, 'ae_engage' => 0, 'cp_reporte' => 0, 'cp_notifie' => 0, 'cp_consome' => 0],
                                        'T4' => ['ae' => 0, 'cp' => 0]
                                    ];

                                    $hasT1 = false;
                                    $hasT2 = false;
                                    $hasT3 = false;
                                    $hasT4 = false;

                                    $codeParts = explode('-', $operation->code_operation);
                                    $operationCode = end($codeParts);
                                    $prefix = substr($operationCode, 0, 1);

                                    foreach ($operation->SousOperation as $sousOperation) {
                                        // Log des sous-opérations pour débogage
                                        Log::info("SousOperation: {$sousOperation->code_sous_operation}", [
                                            'code_operation' => $operation->code_operation,
                                            'prefix' => $prefix,
                                            'code_t1' => $sousOperation->code_t1,
                                            'code_t2' => $sousOperation->code_t2,
                                            'code_t3' => $sousOperation->code_t3,
                                            'code_t4' => $sousOperation->code_t4
                                        ]);

                                        // T1: Préfixe 1
                                        if ($sousOperation->code_t1 == 10000 && $prefix == '1') {
                                            $calculs[$typeAction]['T1']['sousOperation'][] = [
                                                'code' => $sousOperation->code_sous_operation,
                                                'nom' => $sousOperation->nom_sous_operation,
                                                'values' => [
                                                    'ae_sousop' => $sousOperation->AE_sous_operation,
                                                    'cp_sousop' => $sousOperation->CP_sous_operation,
                                                    'ae_sousop_nonrepartis' => $sousOperation->AE_sous_operation_NONREPARTIS ?? $sousOperation->AE_sous_operation,
                                                    'cp_sousop_nonrepartis' => $sousOperation->CP_sous_operation_NONREPARTIS ?? $sousOperation->CP_sous_operation
                                                ]
                                            ];
                                            $operationTotals['T1']['ae'] += $sousOperation->AE_sous_operation;
                                            $operationTotals['T1']['cp'] += $sousOperation->CP_sous_operation;
                                            $hasT1 = true;
                                            $hasGroupT1 = true;
                                        }

                                        // T2: Préfixe 2
                                        if ($sousOperation->code_t2 == 20000 && $prefix == '2') {
                                            $totalSousAe = $sousOperation->AE_ouvert + $sousOperation->AE_atendu;
                                            $totalSousCp = $sousOperation->CP_ouvert + $sousOperation->CP_atendu;
                                            $calculs[$typeAction]['T2']['sousOperation'][] = [
                                                'code' => $sousOperation->code_sous_operation,
                                                'nom' => $sousOperation->nom_sous_operation,
                                                'values' => [
                                                    'ae_ouvert' => $sousOperation->AE_ouvert,
                                                    'ae_attendu' => $sousOperation->AE_atendu,
                                                    'cp_ouvert' => $sousOperation->CP_ouvert,
                                                    'cp_attendu' => $sousOperation->CP_atendu,
                                                    'total_ae' => $totalSousAe,
                                                    'total_cp' => $totalSousCp,
                                                    'ae_ouvert_nonrepartis' => $sousOperation->AE_ouvert_NONREPARTIS,
                                                    'ae_attendu_nonrepartis' => $sousOperation->AE_atendu_NONREPARTIS,
                                                    'cp_ouvert_nonrepartis' => $sousOperation->CP_ouvert_NONREPARTIS,
                                                    'cp_attendu_nonrepartis' => $sousOperation->CP_atendu_NONREPARTIS,
                                                    'total_ae_nonrepartis' => $sousOperation->AE_ouvert_NONREPARTIS + $sousOperation->AE_atendu_NONREPARTIS,
                                                    'total_cp_nonrepartis' => $sousOperation->CP_ouvert_NONREPARTIS + $sousOperation->CP_atendu_NONREPARTIS
                                                ]
                                            ];
                                            $operationTotals['T2']['ae_ouvert'] += $sousOperation->AE_ouvert;
                                            $operationTotals['T2']['ae_attendu'] += $sousOperation->AE_atendu;
                                            $operationTotals['T2']['cp_ouvert'] += $sousOperation->CP_ouvert;
                                            $operationTotals['T2']['cp_attendu'] += $sousOperation->CP_atendu;
                                            $operationTotals['T2']['total_ae'] += $totalSousAe;
                                            $operationTotals['T2']['total_cp'] += $totalSousCp;
                                            $hasT2 = true;
                                            $hasGroupT2 = true;
                                        }

                                        // T3: Préfixe 3
                                        if ($sousOperation->code_t3 == 30000 && $prefix == '3') {
                                            $calculs[$typeAction]['T3']['sousOperation'][] = [
                                                'code' => $sousOperation->code_sous_operation,
                                                'nom' => $sousOperation->nom_sous_operation,
                                                'values' => [
                                                    'ae_reporte' => $sousOperation->AE_reporte,
                                                    'ae_notifie' => $sousOperation->AE_notifie,
                                                    'ae_engage' => $sousOperation->AE_engage,
                                                    'cp_reporte' => $sousOperation->CP_reporte,
                                                    'cp_notifie' => $sousOperation->CP_notifie,
                                                    'cp_consome' => $sousOperation->CP_consome,
                                                    'ae_reporte_nonrepartis' => $sousOperation->AE_reporte_NONREPARTIS,
                                                    'ae_notifie_nonrepartis' => $sousOperation->AE_notifie_NONREPARTIS,
                                                    'ae_engage_nonrepartis' => $sousOperation->AE_engage_NONREPARTIS,
                                                    'cp_reporte_nonrepartis' => $sousOperation->CP_reporte_NONREPARTIS,
                                                    'cp_notifie_nonrepartis' => $sousOperation->CP_notifie_NONREPARTIS,
                                                    'cp_consome_nonrepartis' => $sousOperation->CP_consome_NONREPARTIS,
                                                    'total_ae_nonrepartis' => $sousOperation->AE_reporte_NONREPARTIS + $sousOperation->AE_notifie_NONREPARTIS + $sousOperation->AE_engage_NONREPARTIS,
                                                    'total_cp_nonrepartis' => $sousOperation->CP_reporte_NONREPARTIS + $sousOperation->CP_notifie_NONREPARTIS + $sousOperation->CP_consome_NONREPARTIS
                                                ]
                                            ];
                                            $operationTotals['T3']['ae_reporte'] += $sousOperation->AE_reporte;
                                            $operationTotals['T3']['ae_notifie'] += $sousOperation->AE_notifie;
                                            $operationTotals['T3']['ae_engage'] += $sousOperation->AE_engage;
                                            $operationTotals['T3']['cp_reporte'] += $sousOperation->CP_reporte;
                                            $operationTotals['T3']['cp_notifie'] += $sousOperation->CP_notifie;
                                            $operationTotals['T3']['cp_consome'] += $sousOperation->CP_consome;
                                            $hasT3 = true;
                                            $hasGroupT3 = true;
                                        }

                                        // T4: Préfixe 4
                                        if ($sousOperation->code_t4 == 40000 && $prefix == '4') {
                                            $calculs[$typeAction]['T4']['sousOperation'][] = [
                                                'code' => $sousOperation->code_sous_operation,
                                                'nom' => $sousOperation->nom_sous_operation,
                                                'values' => [
                                                    'ae_sousop' => $sousOperation->AE_sous_operation,
                                                    'cp_sousop' => $sousOperation->CP_sous_operation,
                                                    'ae_sousop_nonrepartis' => $sousOperation->AE_sous_operation_NONREPARTIS ?? $sousOperation->AE_sous_operation,
                                                    'cp_sousop_nonrepartis' => $sousOperation->CP_sous_operation_NONREPARTIS ?? $sousOperation->CP_sous_operation
                                                ]
                                            ];
                                            $operationTotals['T4']['ae'] += $sousOperation->AE_sous_operation;
                                            $operationTotals['T4']['cp'] += $sousOperation->CP_sous_operation;
                                            $hasT4 = true;
                                            $hasGroupT4 = true;
                                        }
                                    }

                                    // Ajouter les opérations aux résultats
                                    if ($hasT1) {
                                        $calculs[$typeAction]['T1']['operation'][] = [
                                            'code' => $operation->code_operation,
                                            'nom' => $operation->nom_operation,
                                            'values' => [
                                                'ae_op' => $operationTotals['T1']['ae'],
                                                'cp_op' => $operationTotals['T1']['cp']
                                            ]
                                        ];
                                        $groupeTotals['T1']['ae'] += $operationTotals['T1']['ae'];
                                        $groupeTotals['T1']['cp'] += $operationTotals['T1']['cp'];
                                    }

                                    if ($hasT2) {
                                        $calculs[$typeAction]['T2']['operation'][] = [
                                            'code' => $operation->code_operation,
                                            'nom' => $operation->nom_operation,
                                            'values' => [
                                                'ae_ouvert' => $operationTotals['T2']['ae_ouvert'],
                                                'ae_attendu' => $operationTotals['T2']['ae_attendu'],
                                                'cp_ouvert' => $operationTotals['T2']['cp_ouvert'],
                                                'cp_attendu' => $operationTotals['T2']['cp_attendu'],
                                                'total_ae' => $operationTotals['T2']['total_ae'],
                                                'total_cp' => $operationTotals['T2']['total_cp']
                                            ]
                                        ];
                                        $groupeTotals['T2']['ae_ouvert'] += $operationTotals['T2']['ae_ouvert'];
                                        $groupeTotals['T2']['ae_attendu'] += $operationTotals['T2']['ae_attendu'];
                                        $groupeTotals['T2']['cp_ouvert'] += $operationTotals['T2']['cp_ouvert'];
                                        $groupeTotals['T2']['cp_attendu'] += $operationTotals['T2']['cp_attendu'];
                                        $groupeTotals['T2']['total_ae'] += $operationTotals['T2']['total_ae'];
                                        $groupeTotals['T2']['total_cp'] += $operationTotals['T2']['total_cp'];
                                    }

                                    if ($hasT3) {
                                        $calculs[$typeAction]['T3']['operation'][] = [
                                            'code' => $operation->code_operation,
                                            'nom' => $operation->nom_operation,
                                            'values' => [
                                                'ae_reporte' => $operationTotals['T3']['ae_reporte'],
                                                'ae_notifie' => $operationTotals['T3']['ae_notifie'],
                                                'ae_engage' => $operationTotals['T3']['ae_engage'],
                                                'cp_reporte' => $operationTotals['T3']['cp_reporte'],
                                                'cp_notifie' => $operationTotals['T3']['cp_notifie'],
                                                'cp_consome' => $operationTotals['T3']['cp_consome']
                                            ]
                                        ];
                                        $groupeTotals['T3']['ae_reporte'] += $operationTotals['T3']['ae_reporte'];
                                        $groupeTotals['T3']['ae_notifie'] += $operationTotals['T3']['ae_notifie'];
                                        $groupeTotals['T3']['ae_engage'] += $operationTotals['T3']['ae_engage'];
                                        $groupeTotals['T3']['cp_reporte'] += $operationTotals['T3']['cp_reporte'];
                                        $groupeTotals['T3']['cp_notifie'] += $operationTotals['T3']['cp_notifie'];
                                        $groupeTotals['T3']['cp_consome'] += $operationTotals['T3']['cp_consome'];
                                    }

                                    if ($hasT4) {
                                        $calculs[$typeAction]['T4']['operation'][] = [
                                            'code' => $operation->code_operation,
                                            'nom' => $operation->nom_operation,
                                            'values' => [
                                                'ae_op' => $operationTotals['T4']['ae'],
                                                'cp_op' => $operationTotals['T4']['cp']
                                            ]
                                        ];
                                        $groupeTotals['T4']['ae'] += $operationTotals['T4']['ae'];
                                        $groupeTotals['T4']['cp'] += $operationTotals['T4']['cp'];
                                    }
                                }

                                // Ajouter les groupes aux sections où ils ont des opérations
                                if ($hasGroupT1) {
                                    $calculs[$typeAction]['T1']['group'][] = [
                                        'code' => $groupe->code_grp_operation,
                                        'nom' => $groupe->nom_grp_operation,
                                        'values' => [
                                            'ae_grpop' => $groupeTotals['T1']['ae'],
                                            'cp_grpop' => $groupeTotals['T1']['cp']
                                        ]
                                    ];
                                    $totauxGlobaux[$typeAction]['T1']['totalAE'] += $groupeTotals['T1']['ae'];
                                    $totauxGlobaux[$typeAction]['T1']['totalCP'] += $groupeTotals['T1']['cp'];
                                }

                                if ($hasGroupT2) {
                                    $calculs[$typeAction]['T2']['group'][] = [
                                        'code' => $groupe->code_grp_operation,
                                        'nom' => $groupe->nom_grp_operation,
                                        'values' => [
                                            'ae_ouvert' => $groupeTotals['T2']['ae_ouvert'],
                                            'ae_attendu' => $groupeTotals['T2']['ae_attendu'],
                                            'cp_ouvert' => $groupeTotals['T2']['cp_ouvert'],
                                            'cp_attendu' => $groupeTotals['T2']['cp_attendu'],
                                            'total_ae' => $groupeTotals['T2']['total_ae'],
                                            'total_cp' => $groupeTotals['T2']['total_cp']
                                        ]
                                    ];
                                    $totauxGlobaux[$typeAction]['T2']['totalAEouvrtvertical'] += $groupeTotals['T2']['ae_ouvert'];
                                    $totauxGlobaux[$typeAction]['T2']['totalAEattenduvertical'] += $groupeTotals['T2']['ae_attendu'];
                                    $totauxGlobaux[$typeAction]['T2']['totalCPouvrtvertical'] += $groupeTotals['T2']['cp_ouvert'];
                                    $totauxGlobaux[$typeAction]['T2']['totalCPattenduvertical'] += $groupeTotals['T2']['cp_attendu'];
                                    $totauxGlobaux[$typeAction]['T2']['totalAE'] += $groupeTotals['T2']['total_ae'];
                                    $totauxGlobaux[$typeAction]['T2']['totalCP'] += $groupeTotals['T2']['total_cp'];
                                }

                                if ($hasGroupT3) {
                                    $calculs[$typeAction]['T3']['group'][] = [
                                        'code' => $groupe->code_grp_operation,
                                        'nom' => $groupe->nom_grp_operation,
                                        'values' => [
                                            'ae_reporte' => $groupeTotals['T3']['ae_reporte'],
                                            'ae_notifie' => $groupeTotals['T3']['ae_notifie'],
                                            'ae_engage' => $groupeTotals['T3']['ae_engage'],
                                            'cp_reporte' => $groupeTotals['T3']['cp_reporte'],
                                            'cp_notifie' => $groupeTotals['T3']['cp_notifie'],
                                            'cp_consome' => $groupeTotals['T3']['cp_consome']
                                        ]
                                    ];
                                    $totauxGlobaux[$typeAction]['T3']['totalAEreportevertical'] += $groupeTotals['T3']['ae_reporte'];
                                    $totauxGlobaux[$typeAction]['T3']['totalAEnotifievertical'] += $groupeTotals['T3']['ae_notifie'];
                                    $totauxGlobaux[$typeAction]['T3']['totalAEengagevertical'] += $groupeTotals['T3']['ae_engage'];
                                    $totauxGlobaux[$typeAction]['T3']['totalCPreportevertical'] += $groupeTotals['T3']['cp_reporte'];
                                    $totauxGlobaux[$typeAction]['T3']['totalCPnotifievertical'] += $groupeTotals['T3']['cp_notifie'];
                                    $totauxGlobaux[$typeAction]['T3']['totalCPconsomevertical'] += $groupeTotals['T3']['cp_consome'];
                                    $totauxGlobaux[$typeAction]['T3']['totalAE'] += $groupeTotals['T3']['ae_reporte'] + $groupeTotals['T3']['ae_notifie'] + $groupeTotals['T3']['ae_engage'];
                                    $totauxGlobaux[$typeAction]['T3']['totalCP'] += $groupeTotals['T3']['cp_reporte'] + $groupeTotals['T3']['cp_notifie'] + $groupeTotals['T3']['cp_consome'];
                                }

                                if ($hasGroupT4) {
                                    $calculs[$typeAction]['T4']['group'][] = [
                                        'code' => $groupe->code_grp_operation,
                                        'nom' => $groupe->nom_grp_operation,
                                        'values' => [
                                            'ae_grpop' => $groupeTotals['T4']['ae'],
                                            'cp_grpop' => $groupeTotals['T4']['cp']
                                        ]
                                    ];
                                    $totauxGlobaux[$typeAction]['T4']['totalAE'] += $groupeTotals['T4']['ae'];
                                    $totauxGlobaux[$typeAction]['T4']['totalCP'] += $groupeTotals['T4']['cp'];
                                }
                            }
                        }
                    }
                }
            }
        }

        // Journaliser les groupes trouvés
        Log::info("Groupes trouvés pour num_sous_action {$s_act}", $groupesTrouves);

        // Ajouter les totaux globaux
        foreach (['centrale', 'delegation'] as $typeAction) {
            $calculs[$typeAction]['T1']['total'] = [['values' => $totauxGlobaux[$typeAction]['T1']]];
            $calculs[$typeAction]['T2']['total'] = [['values' => $totauxGlobaux[$typeAction]['T2']]];
            $calculs[$typeAction]['T3']['total'] = [['values' => $totauxGlobaux[$typeAction]['T3']]];
            $calculs[$typeAction]['T4']['total'] = [['values' => $totauxGlobaux[$typeAction]['T4']]];
        }

        // Débogage final
        // dd($calculs);

        return $calculs;
    }
}