<?php
namespace App\Services;

use App\Models\Portefeuille;

class CalculDpia
{
    public function calculdpiaFromPath($path, $t)
    {
        // décomposer le chemin (portefeuille, programme, sous-programme, action, sous-action)
        $chemin = explode('/', $path);
        if (count($chemin) < 1) {
            throw new \Exception("Le chemin n'est pas valide");
        }

        // récupérer le portefeuille à partir du chemin
        $portefeuille = Portefeuille::where('num_portefeuil', $chemin[0])
            ->with([
                'Programme.SousProgramme.Action.SousAction.GroupOperation.Operation.SousOperation'
            ])->first();

        if (!$portefeuille) {
            throw new \Exception("Portefeuille introuvable");
        }

        $totalAeT2 = 0; 
        $totalCpT2 = 0; 
        $groupedResultsT2 = [];

        // parcourir tous les programmes du portefeuille
        foreach ($portefeuille->Programme as $programme) {
            foreach ($programme->SousProgramme as $sousProgramme) {
                foreach ($sousProgramme->Action as $action) {
                    foreach ($action->SousAction as $sousAction) {
                        foreach ($sousAction->GroupOperation as $groupe) {
                            $groupeAeOuvert = 0;
                            $groupeAeAttendu = 0;
                            $groupeCpOuvert = 0;
                            $groupeCpAttendu = 0;

                            foreach ($groupe->Operation as $operation) {
                                $operationAeOuvert = 0;
                                $operationAeAttendu = 0;
                                $operationCPOuvert = 0;
                                $operationCPAttendu = 0;

                                // récupérer les sous operations
                                if (count($operation->SousOperation) > 1) {
                                    // calculer la somme de chaque sous op 
                                    foreach ($operation->SousOperation as $sousOperation) {
                                        $sousopAeouvert= $sousOperation->AE_ouvert;
                                        $sousopAeattendu= $sousOperation->AE_atendu;

                                        $sousopCpouvert= $sousOperation->CP_ouvert;
                                        $sousopCpattendu= $sousOperation->CP_attendu;

                                        $totalSousAeGlobal = $sousopAeouvert + $sousopAeattendu; // AE_ouvert + AE_attendu global
                                        $totalSousCpGlobal = $sousopCpouvert + $sousopCpattendu; // CP_ouvert + CP_attendu global

                                        $operationAeOuvert += $sousOperation->AE_ouvert;
                                        $operationAeAttendu += $sousOperation->AE_atendu;
                                        $operationCPOuvert += $sousOperation->CP_ouvert;
                                        $operationCPAttendu += $sousOperation->CP_attendu;

                                        $totalOPAeGlobal = $operationAeOuvert + $operationAeAttendu; // AE_ouvert + AE_attendu global
                                        $totalOPCpGlobal = $operationCPOuvert + $operationCPAttendu;
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

                            // enregistrer les résultats par groupe d'opérations
                            $groupedResultsT2[] = [
                                'groupe' => $groupe->nom,
                                'total_ae_ouvert' => $groupeAeOuvert,
                                'total_ae_attendu' => $groupeAeAttendu,
                                'total_ae_groupe' => $groupeAeOuvert + $groupeAeAttendu  // Somme AE ouvert + AE attendu
                            ];
                        }

                        // Enregistrer les résultats pour chaque sous-action
                        $groupedResultsT2[] = [
                            'sousAction' => $sousAction->nom,
                            'total_ae_ouvert' => $sousActionAeOuvert,
                            'total_ae_attendu' => $sousActionAeAttendu,
                            'total_ae_sous_action' => $sousActionAeOuvert + $sousActionAeAttendu  // Somme AE ouvert + AE attendu pour sous-action
                        ];

                        // Ajouter les AE ouverts et attendus de la sous-action au total général pour t2
                        $totalAeT2 += $sousActionAeOuvert + $sousActionAeAttendu;
                    }
                }
            }
        }

        // Retourner les résultats pour t2
        return [
            'totalAeT2' => $totalAeT2,  // Total des AE pour t2
            'groupedResultsT2' => $groupedResultsT2,
            'portefeuille' => $portefeuille->nom
        ];
    }

}
