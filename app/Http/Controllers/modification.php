<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class modification extends Controller
{
    //fct update sous operation et insert dpia ac motif update
    public function updateSousOperation(Request $request)
    {
        //récupérer les données de request
        $data = $request->all();
         dd($data);
        // déterminer le type de données reçues est ce qu'ils sont T ou les valeurs qui sont dans tableau T[]
        $type = array_key_first($data); //arrey_key_first permet de récupérer la clé principale du tableau (t1 t2 t3 t4...)
        $valeurs = $data[$type]; //les valeurs [code_sous_op,ae et cp]

        //validation
        if (!in_array($type, ['T1', 'T2', 'T3', 'T4'])) {
            return response()->json(['erreur' => 'Type de T invalide reçu '], 400);
        }

        $validated = $request->validate([
            "$type.code_sous_operation" => 'required|string|exists:sous_operations,code_sous_operation',
        ]);

        try {
            // récupérer la ligne d'entré
            $sousOperation = SousOperation::findOrFail($values['code_sous_operation']);

           // modification d'aprés les t
            switch ($type) {
                case 'T1':
                    $this->ModifT1($sousOperation, $values);
                    break;

                case 'T2':
                    $this->ModifT2($sousOperation, $values);
                    break;

                case 'T3':
                    $this->ModifT3($sousOperation, $values);
                    break;

                case 'T4':
                    $this->ModifT4($sousOperation, $values);
                    break;
            }

            return response()->json(['message' => 'Mise à jour réussie et ajout dans ConstruireDPIA'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la mise à jour ou de l\'ajout', 'details' => $e->getMessage()], 500);
        }
    }

    private function ModifT1(SousOperation $sousOperation, $values)
    {
        //update dans sous operation
        $sousOperation->update([
            'AE_sous_operation' => $values['ae'] ?? $sousOperation->AE_sous_operation,
            'CP_sous_operation' => $values['cp'] ?? $sousOperation->CP_sous_operation,
            'date_update_SOUSoperation' => now(),
        ]);

        // insérer dans ConstruireDPIA
        ConstruireDPIA::create([
            'code_sous_operation' => $values['code_sous_operation'],
            'motif_dpia' => 'Modification T1: AE=' . $values['ae'] . ', CP=' . $values['cp'],
            'date_modification_dpia' => now(),
        ]);
    }

    private function ModifT2(SousOperation $sousOperation, $values)
    {
        // Mise à jour des colonnes spécifiques à T2
        $sousOperation->update([
            'AE_ouvert' => $values['ae_ouvert'] ?? $sousOperation->AE_ouvert,
            'AE_atendu' => $values['ae_atendu'] ?? $sousOperation->AE_atendu,
            'CP_ouvert' => $values['cp_ouvert'] ?? $sousOperation->CP_ouvert,
            'CP_atendu' => $values['cp_atendu'] ?? $sousOperation->CP_atendu,
            'date_update_SOUSoperation' => now(),
        ]);

        // Insérer dans ConstruireDPIA
        ConstruireDPIA::create([
            'code_sous_operation' => $values['code_sous_operation'],
            'motif_dpia' => 'Modification T2: AE_ouvert=' . $values['ae_ouvert'] . ', CP_ouvert=' . $values['cp_ouvert'],
            'date_creation_dpia' => now(),
        ]);
    }

    private function ModifT3(SousOperation $sousOperation, $values)
    {
        // Mise à jour des colonnes spécifiques à T3
        $sousOperation->update([
            'AE_reporte' => $values['ae_reporte'] ?? $sousOperation->AE_reporte,
            'CP_reporte' => $values['cp_reporte'] ?? $sousOperation->CP_reporte,
            'date_update_SOUSoperation' => now(),
        ]);

        // Insérer dans ConstruireDPIA
        ConstruireDPIA::create([
            'code_sous_operation' => $values['code_sous_operation'],
            'motif_dpia' => 'Modification T3: AE_reporte=' . $values['ae_reporte'] . ', CP_reporte=' . $values['cp_reporte'],
            'date_creation_dpia' => now(),
        ]);
    }

    private function ModifT4(SousOperation $sousOperation, $values)
    {
        // Mise à jour des colonnes spécifiques à T4
        $sousOperation->update([
            'AE_notifie' => $values['ae_notifie'] ?? $sousOperation->AE_notifie,
            'CP_notifie' => $values['cp_notifie'] ?? $sousOperation->CP_notifie,
            'date_update_SOUSoperation' => now(),
        ]);

        // Insérer dans ConstruireDPIA
        ConstruireDPIA::create([
            'code_sous_operation' => $values['code_sous_operation'],
            'motif_dpia' => 'Modification T4: AE_notifie=' . $values['ae_notifie'] . ', CP_notifie=' . $values['cp_notifie'],
            'date_creation_dpia' => now(),
        ]);
    }
}
