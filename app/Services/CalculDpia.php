<?php
namespace App\Services;

use App\Models\Portefeuille;

class CalculDpia
{
    public function calculdpiaFromPath($port, $prog, $sous_prog, $act)
    {
      /*  // décomposer le chemin (portefeuille, programme, sous-programme, action, sous-action)
        $chemin = explode('/', $path);
        if (count($chemin) < 1) {
            throw new \Exception("Le chemin n'est pas valide");
        }*/
        $port = intval($port);
        $prog = intval($prog);
        $sous_prog = intval($sous_prog);
        $act = intval($act);
        $s_act = intval($s_act);
          //dd($port, $prog, $sous_prog, $act);
        // récupérer le portefeuille à partir du chemin
        $portefeuille = Portefeuille::where('num_portefeuil',$port)
            ->with([
                'Programme.SousProgramme.Action.SousAction.GroupOperation.Operation.SousOperation'
            ])->first();
       // dd( $portefeuille);
        if (!$portefeuille) {
            throw new \Exception("Portefeuille introuvable");
        }

        $totalAeT2 = 0; 
        $totalCpT2 = 0; 
        $totalAeT3 = 0;
        $totalCpT3 = 0;
        $groupedResultsT2 = [];
        $totalt2= [];

        // parcourir tous les programmes du portefeuille
        foreach ($portefeuille->Programme as $programme) {
           // dd($programme);
            foreach ($programme->SousProgramme as $sousProgramme) {
              //  dd($sousProgramme);
                foreach ($sousProgramme->Action as $action) {
                   // dd($action);
                    foreach ($action->SousAction as $sousAction) {
                       // dd($sousAction);
                        foreach ($sousAction->GroupOperation as $groupe) {
                           // dd($groupe);
                            $groupeAeOuvert = 0;
                            $groupeAeAttendu = 0;
                            $groupeCpOuvert = 0;
                            $groupeCpAttendu = 0;
                           
                            foreach ($groupe->Operation as $operation) {
                              //  dd($operation);
                                $operationAeOuvert = 0;
                                $operationAeAttendu = 0;
                                $operationCPOuvert = 0;
                                $operationCPAttendu = 0;

                                // récupérer les sous operations
                                if (count($operation->SousOperation) > 1) {
                                    //dd($operation->SousOperation);
                                    // calculer la somme de chaque sous op 
                                    foreach ($operation->SousOperation as $sousOperation) {
                                        //dd($sousOperation);
                                        $sousopAeouvert= $sousOperation->AE_ouvert;
                                        $sousopAeattendu= $sousOperation->AE_atendu;
                                         // dd($sousopAeouvert,$sousopAeattendu);
                                        $sousopCpouvert= $sousOperation->CP_ouvert;
                                        $sousopCpattendu= $sousOperation->CP_atendu;
                                      //  dd($sousopCpouvert,$sousopCpattendu);

                                        $totalSousAeGlobal = $sousopAeouvert + $sousopAeattendu; // AE_ouvert + AE_attendu global
                                        $totalSousCpGlobal = $sousopCpouvert + $sousopCpattendu; // CP_ouvert + CP_attendu global
                                        //dd($totalSousAeGlobal,$totalSousCpGlobal);

                                        $operationAeOuvert += $sousOperation->AE_ouvert;
                                        $operationAeAttendu += $sousOperation->AE_atendu;
                                        $operationCPOuvert += $sousOperation->CP_ouvert;
                                        $operationCPAttendu += $sousOperation->CP_attendu;

                                        $totalOPAeGlobal = $operationAeOuvert + $operationAeAttendu; // AE_ouvert + AE_attendu global
                                        $totalOPCpGlobal = $operationCPOuvert + $operationCPAttendu;

                                        dd( $totalOPAeGlobal,  $totalOPCpGlobal);

                                    }
                                } else {
                                    // si pas des sous op on va considérer l'op la mm sous op et recupérer les ae et cp
                                    $operationAeOuvert = $sousOperation->AE_ouvert;
                                    $operationAeAttendu = $sousOperation->AE_atendu;
                                    $operationCPOuvert = $sousOperation->CP_ouvert;
                                    $operationCPAttendu = $sousOperation->CP_attendu;

                                    $totalOPAeGlobal = $operationAeOuvert + $operationAeAttendu; // AE_ouvert + AE_attendu global
                                    $totalOPCpGlobal = $operationCPOuvert + $operationCPAttendu;
                                }
                               
                                    // ajouter les valeurs de l'operation au groupe d'op
                                    $groupeAeOuvert += $operationAeOuvert;
                                    $groupeAeAttendu += $operationAeAttendu;
                                    $groupeCpOuvert += $operationCPOuvert;
                                    $groupeCpAttendu += $operationCPAttendu;

                                    $totalgroupAeGlobal = $groupeAeOuvert + $groupeAeAttendu; // AE_ouvert + AE_attendu global
                                    $totalgroupCpGlobal = $groupeCpOuvert + $groupeCpAttendu;
                                    }

                                    // calculer le total ae et cp 
                                    $totalAeOuvertGlobal += $groupeAeOuvert;
                                    $totalAeAttenduGlobal += $groupeAeAttendu;
                                    $totalCpOuvertGlobal += $groupeCpOuvert;
                                    $totalCpAttenduGlobal += $groupeCpAttendu;

                                    $totalAeT2= $totalAeOuvertGlobal + $totalAeAttenduGlobal; // AE_ouvert + AE_attendu global
                                    $totalCpT2 = $totalCpOuvertGlobal + $totalCpAttenduGlobal;

                                }
                            }
                        }
                    }
                }
                $groupedResultsT2[] = [
                    "code" => $operation->code_operation,
                    "values" => [
                        'ae_ouvertsousop' => $sousopAeouvert, 
                        'ae_attendusousop' => $sousopAeattendu,
                        'cp_ouvertsousop' => $sousopCpouvert,
                        'cp_attendsousuop' => $sousopCpattendu,
                        'totalAEsousop' => $totalSousAeGlobal,
                        'totalCPsousop' => $totalSousCpGlobal,


                        'ae_ouvertop' => $operationAeOuvert, 
                        'ae_attenduop' => $operationAeAttendu,
                        'cp_ouvertop' => $operationCPOuvert,
                        'cp_attenduop' => $operationCPAttendu,
                        'totalAEop' => $totalOPAeGlobal, //total horizontal
                        'totalCPop' => $totalOPCpGlobal,

                        'ae_ouvertgrpop' => $groupeAeOuvert, 
                        'ae_attendugrpop' => $groupeAeAttendu,
                        'cp_ouvertgrpop' => $groupeCpOuvert,
                        'cp_attendugrpop' => $groupeCpAttendu,
                        'totalAEgrpop' => $totalgroupAeGlobal,
                        'totalCPgrpop' => $totalgroupCpGlobal,

                    ]
                ];

               $totalt2[] = [
                "code" => $operation->code_operation,
                    "values" => [
                        'totalAEouvrtvertical'=> $totalAeOuvertGlobal,
                        'totalAEattenduvertical'=> $totalAeAttenduGlobal ,
                        'totalCPouvrtvertical'=>  $totalCpOuvertGlobal ,
                        'totalCPattenduvertical'=> $totalCpAttenduGlobal ,

                        'totalAEt2' => $totalAeT2,
                        'totalCPt2' => $totalCpT2,
                    ]

                    ];

                     // Retourner les résultats
    return [
        'totalT2' => $totalAeT2,
        'groupedResults' => $groupedResultsT2,
    ];
            }
        }
