<?php
namespace App\Services;

use App\Models\Portefeuille;
use App\Models\SousAction;
use Illuminate\Support\Facades\DB;  
class CalculDpia
{
    public function calculdpiaFromPath($port, $prog, $sous_prog, $act,$s_act)
    {
      /*  // décomposer le chemin (portefeuille, programme, sous-programme, action, sous-action)
        $chemin = explode('/', $path);
        if (count($chemin) < 1) {
            throw new \Exception("Le chemin n'est pas valide");
        }*/
       // dd($port);
       /* $port = intval($port);
       // dd($port);
        $prog = intval($prog);
        $sous_prog = intval($sous_prog);
        $act = intval($act);
        $s_act = ($s_act);*/
      
      //dd($port, $prog, $sous_prog, $act,$s_act);
      
      $portefeuille = Portefeuille::where('num_portefeuil', $port)
        ->whereHas('Programme.SousProgramme.Action.SousAction', function ($query) use ($s_act) {
            $query->where('num_sous_action', $s_act) ;
        })
        ->with([
            'Programme.SousProgramme.Action.SousAction.GroupOperation.Operation.SousOperation'
        ])->first();
  //dd($portefeuille);
   $portefeuille=$portefeuille;
    //dd($portefeuille);
        // récupérer le portefeuille à partir du chemin
    /*  $portefeuille = Portefeuille::where('num_portefeuil', $port)
        ->with([
            'Programme.SousProgramme.Action.SousAction',
            'Programme.SousProgramme.Action.SousAction.GroupOperation',
            'Programme.SousProgramme.Action.SousAction.GroupOperation.Operation'
        ])
        ->first();

        if ($portefeuille) {
            $sousActions = $portefeuille->Programme
                ->flatMap(fn($programme) => $programme->SousProgramme)
                ->flatMap(fn($sousProgramme) => $sousProgramme->Action)
                ->flatMap(fn($action) => $action->SousAction)
                ->where('num_sous_action', $s_act);
        
         //  dd($sousActions);
        } else {
            dd('Aucun portefeuille trouvé pour ce numéro');
        }
     */
  
/*$portefeuille = DB::select("
SELECT sa.*
FROM sous_actions sa
JOIN actions a ON sa.num_action = a.num_action
JOIN sous_programmes sp ON a.num_sous_prog = sp.num_sous_prog
JOIN programmes p ON sp.num_prog = p.num_prog
JOIN portefeuilles pf ON p.num_portefeuil = pf.num_portefeuil
WHERE pf.num_portefeuil = :port
AND sa.num_sous_action = :s_act
", ['port' => $port, 's_act' => $s_act]);
if (!empty($portefeuille)) {
    // $results contient un tableau d'objets
    //dd($portefeuille);
} else {
    dd('Aucun sous-action trouvé pour ce portefeuille et ce sous-action.');
}
//dd($portefeuille);
       
           /*$portefeuille = DB::table('portefeuilles as p')
    ->join('programmes as pr', 'pr.num_portefeuil', '=', 'p.num_portefeuil')
    ->join('sous_programmes as sp', 'sp.num_prog', '=', 'pr.num_prog')
    ->join('actions as a', 'a.num_sous_prog', '=', 'sp.num_sous_prog')
    ->join('sous_actions as sa', 'sa.num_action', '=', 'a.num_action')
    ->join('group_operations as go', 'go.num_sous_action', '=', 'sa.num_sous_action')
    ->join('operations as o', 'o.code_grp_operation', '=', 'go.code_grp_operation')
    ->join('sous_operations as so', 'so.code_operation', '=', 'o.code_operation')
    ->where('p.num_portefeuil', $port)
    ->first(); // Pour récupérer un seul résultat*/

        //dd($portefeuille->Programme->get()->SousProgramme->get()->Action->get()->SousAction->get()->GroupOperation->get()); 
     // dd( $portefeuille);
        if (!$portefeuille) {
            throw new \Exception("Portefeuille introuvable");
        }
         //dd( $portefeuille);
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

   //initialisation des totaux globaaux
        $totauxGlobaux = [
            'centrale' => [
                'T1' => ['totalAE' => 0, 'totalCP' => 0],
                'T2' => [
                    'totalAEouvrtvertical' => 0, 'totalAEattenduvertical' => 0,
                    'totalCPouvrtvertical' => 0, 'totalCPattenduvertical' => 0,
                    'totalAE' => 0, 'totalCP' => 0
                ],
                'T3' => [
                    'totalAEreportevertical' => 0, 'totalAEnotifievertical' => 0, 'totalAEengagevertical' => 0,
                    'totalCPreportevertical' => 0, 'totalCPnotifievertical' => 0, 'totalCPconsomevertical' => 0,
                    'totalAE' => 0, 'totalCP' => 0
                ],
                'T4' => ['totalAE' => 0, 'totalCP' => 0]
            ],
            'delegation' => [
                'T1' => ['totalAE' => 0, 'totalCP' => 0],
                'T2' => [
                    'totalAEouvrtvertical' => 0, 'totalAEattenduvertical' => 0,
                    'totalCPouvrtvertical' => 0, 'totalCPattenduvertical' => 0,
                    'totalAE' => 0, 'totalCP' => 0
                ],
                'T3' => [
                    'totalAEreportevertical' => 0, 'totalAEnotifievertical' => 0, 'totalAEengagevertical' => 0,
                    'totalCPreportevertical' => 0, 'totalCPnotifievertical' => 0, 'totalCPconsomevertical' => 0,
                    'totalAE' => 0, 'totalCP' => 0
                ],
                'T4' => ['totalAE' => 0, 'totalCP' => 0]
            ]
        ];

        // parcourir tous les programmes du portefeuille
        foreach ($portefeuille->Programme as $programme) {
           // dd($programme);
            foreach ($programme->SousProgramme as $sousProgramme) {
              //  dd($sousProgramme);
                foreach ($sousProgramme->Action as $action) {
                   // dd($action);
                   $typeAction = $action->type_action;
                   //dd($typeAction);
                    foreach ($action->SousAction as $sousAction) {
                       // dd($sousAction);
                        foreach ($sousAction->GroupOperation as $groupe) {
                            if($groupe->num_sous_action==$s_act)
                            {
                              //  dd($groupe);
                              $groupeTotals = [
                                'T2' => [
                                    'ae_ouvert' => 0, 'ae_attendu' => 0, 'cp_ouvert' => 0, 'cp_attendu' => 0,
                                    'total_ae' => 0, 'total_cp' => 0
                                ],
                                'T3' => [
                                    'ae_reporte' => 0, 'ae_notifie' => 0, 'ae_engage' => 0,
                                    'cp_reporte' => 0, 'cp_notifie' => 0, 'cp_consome' => 0
                                ],
                                'T1' => ['ae' => 0, 'cp' => 0],
                                'T4' => ['ae' => 0, 'cp' => 0]
                            ];
                                foreach ($groupe->Operation as $operation) {
                                  // dd($operation);
                                  $operationTotals = [
                                    'T2' => [
                                        'ae_ouvert' => 0, 'ae_attendu' => 0, 'cp_ouvert' => 0, 'cp_attendu' => 0,
                                        'total_ae' => 0, 'total_cp' => 0
                                    ],
                                    'T3' => [
                                        'ae_reporte' => 0, 'ae_notifie' => 0, 'ae_engage' => 0,
                                        'cp_reporte' => 0, 'cp_notifie' => 0, 'cp_consome' => 0
                                    ],
                                    'T1' => ['ae' => 0, 'cp' => 0],
                                    'T4' => ['ae' => 0, 'cp' => 0]
                                ];
                                        // calculer la somme de chaque sous op
                                        foreach ($operation->SousOperation as $sousOperation) {
                                          //dd($sousOperation);
                         /***************************************** T2 ********************************************************** */
                                        
                                          if($sousOperation->code_t2==20000) {
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
                                            // dd($calculs[$typeAction]['T2']['sousOperation']);
                                            $operationTotals['T2']['ae_ouvert'] += $sousOperation->AE_ouvert;
                                            $operationTotals['T2']['ae_attendu'] += $sousOperation->AE_atendu;
                                            $operationTotals['T2']['cp_ouvert'] += $sousOperation->CP_ouvert;
                                            $operationTotals['T2']['cp_attendu'] += $sousOperation->CP_atendu;
                                            $operationTotals['T2']['total_ae'] += $totalSousAe;
                                            $operationTotals['T2']['total_cp'] += $totalSousCp;
                                            // dd( $operationTotals['T2']['ae_ouvert']);
                                            
                                        }
    
                          /****************************************T3******************************************************************* */
    
                                        if ($sousOperation->code_t3 == 30000) {
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
                                                //dd( $calculs[$typeAction]['T3']['sousOperation']);
                                            $operationTotals['T3']['ae_reporte'] += $sousOperation->AE_reporte;
                                            $operationTotals['T3']['ae_notifie'] += $sousOperation->AE_notifie;
                                            $operationTotals['T3']['ae_engage'] += $sousOperation->AE_engage;
                                            $operationTotals['T3']['cp_reporte'] += $sousOperation->CP_reporte;
                                            $operationTotals['T3']['cp_notifie'] += $sousOperation->CP_notifie;
                                            $operationTotals['T3']['cp_consome'] += $sousOperation->CP_consome;
                                        }
                                       
                            /************************************T1********************************************************** */
    
                                            if ($sousOperation->code_t1 == 10000) {
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
                                            }
                /*****************************************T4********************************************************** */
                                                if ($sousOperation->code_t4 == 40000) {
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
                                                }
                                        }
    
                                   // dd($operationAeOuvert,$operationAeAttendu,$operationCPOuvert , $operationCPAttendu);
                                    //dd($totalOPAeGlobal,$totalOPCpGlobal);
                                // Ajouter les opérations aux résultats
                                if ($operationTotals['T2']['total_ae'] > 0 || $operationTotals['T2']['total_cp'] > 0) {
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
                                }
                                        // ajouter les valeurs de l'operation au groupe d'op
                                     
    
                                     
                /********************************************************************* T3******************************************************* */
                                        if ($operationTotals['T3']['ae_reporte'] > 0 || $operationTotals['T3']['cp_reporte'] > 0) {
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
                                        }
                                             // ajouter les valeurs de l'operation au groupe d'op
                                      
    
                                       
           /********************************************************************* T1******************************************************* */
                                        if ($operationTotals['T1']['ae'] > 0 || $operationTotals['T1']['cp'] > 0) {
                                            $calculs[$typeAction]['T1']['operation'][] = [
                                                'code' => $operation->code_operation,
                                                'nom' => $operation->nom_operation,
                                                'values' => [
                                                    'ae_op' => $operationTotals['T1']['ae'],
                                                    'cp_op' => $operationTotals['T1']['cp']
                                                ]
                                            ];
                                        }
                                                     // ajouter les valeurs de l'operation au groupe d'op
                                           
    
            /********************************************************************* T4******************************************************* */
                                        if ($operationTotals['T4']['ae'] > 0 || $operationTotals['T4']['cp'] > 0) {
                                            $calculs[$typeAction]['T4']['operation'][] = [
                                                'code' => $operation->code_operation,
                                                'nom' => $operation->nom_operation,
                                                'values' => [
                                                    'ae_op' => $operationTotals['T4']['ae'],
                                                    'cp_op' => $operationTotals['T4']['cp']
                                                ]
                                            ];
                                        }
    
                                                // ajouter les valeurs de l'operation au groupe d'op
                                        
                                                foreach ($operationTotals as $t => $totals) {
                                                    foreach ($totals as $aecp => $value) {
                                                        $groupeTotals[$t][$aecp] += $value;
                                                    }
                                                   
                                                }
                                               
                                            }
                                            //dd($groupeTotals[$t][$aecp]);
    
                                            if ($groupeTotals['T2']['total_ae'] > 0 || $groupeTotals['T2']['total_cp'] > 0) {
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
             /*************************************************T3*********************************************************************** */
                                            if ($groupeTotals['T3']['ae_reporte'] > 0 || $groupeTotals['T3']['cp_reporte'] > 0) {
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
            /*********************************************************************T1***************************************************** ********/
                                            if ($groupeTotals['T1']['ae'] > 0 || $groupeTotals['T1']['cp'] > 0) {
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
         /*********************************************************************T1/T4***************************************************** ********/
                                        if ($groupeTotals['T4']['ae'] > 0 || $groupeTotals['T4']['cp'] > 0) {
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
            
             //  dd($operationT4);
                 // dd($totalAe,$totalCp);
                 foreach (['centrale', 'delegation'] as $typeAction) {
                    $calculs[$typeAction]['T1']['total'] = [['values' => $totauxGlobaux[$typeAction]['T1']]];
                    $calculs[$typeAction]['T2']['total'] = [['values' => $totauxGlobaux[$typeAction]['T2']]];
                    $calculs[$typeAction]['T3']['total'] = [['values' => $totauxGlobaux[$typeAction]['T3']]];
                    $calculs[$typeAction]['T4']['total'] = [['values' => $totauxGlobaux[$typeAction]['T4']]];
                }

                     // retourner les résultats

                    // dd($operationT4);
                    return $calculs;

                            }
}
