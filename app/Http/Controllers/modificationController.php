<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SousOperation;
use App\Models\Operation;
use App\Models\GroupOperation;
use App\Models\Portefeuille;
use App\Models\ModificationT;
use App\Models\ConstruireDPIA;
use App\Models\SousProgramme;
use App\Models\Programme; 
use App\Models\Multimedia; 
use App\Models\Action;
use App\Models\initPort;
use App\Models\SousAction;

use App\Models\T1;
use App\Models\T2;
use App\Models\T3;
use App\Models\T4;

use App\Services\CalculDpia;

use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class modificationController extends Controller
{

    protected $CalculDpia;

    public function __construct(CalculDpia $CalculDpia)
    {
        $this->CalculDpia = $CalculDpia;
    }
    //fct update sous operation et insert dpia ac motif update
    public function updateSousOperation(Request $request)
    {

        //récupérer les données de request
        $data = $request->all();
      // dd($request);
        // déterminer le type de données reçues est ce qu'ils sont T ou les valeurs qui sont dans tableau T[]
        $Tport = $data['Tport']; 
        $resultats = $data['result']; //les valeurs [code_sous_op,ae et cp]
        //dd($Tport);
        //dd( $resultats );
        //validation
        if (!in_array($Tport, ['1', '2', '3', '4'])) {
            return response()->json(['erreur' => 'Type de T invalide reçu '], 400);
        }

        $validated = $request->validate([
            'result.*.code' => 'required|string',
        ]);

        try {

            foreach ($resultats as $resultat) {
                $code = $resultat['code']; // récupérer le code
                $values = $resultat['value'];

            // récupérer la ligne d'entrée
            $sousOperation = SousOperation::where('code_sous_operation', $code)->first();
            //dd($sousOperation);
           // modification d'aprés les t
           if ($sousOperation) {
            switch ($Tport) {
                case '1':
                    $this->ModifT1($sousOperation, $values);
                    break;

                case '2':
                    $this->ModifT2($sousOperation, $values);
                    break;

                case '3':
                    $this->ModifT3($sousOperation, $values);
                    break;

                case '4':
                    $this->ModifT4($sousOperation, $values);
                    break;
            }
        } else {
            switch ($Tport) {
                
                case '3':
                    // vérifier si le code est > 9 parties séparé par - 
                    $parts = explode('-', $code);
                    //dd($parts);
                    $codepor=$parts[0].'-'.$parts[1];
                    //dd($parts);
                    $portefeuille = Portefeuille::where('num_portefeuil',$codepor)->firstOrFail();
                    $code_operation = implode('-', array_slice($parts, 0, 8));
                   
                    if (count($parts) > 8) {
                      // insertion d'une nouvelle sous-opération
                      //dd($code);
                        $sous=SousOperation::create([
                            'code_sous_operation' => $code,
                            'nom_sous_operation'=>$values['desc']. '_'. $values['intitule'] ,
                            'desc' => $values['desc'] ?? 'Description non fournie',
                            'intitule' => $values['intitule'] ?? 'Intitulé non fourni',
                            'AE_notifie' => floatval(str_replace(',', '', $values['ae_notifie'])) ?? 0,
                            'AE_reporte' => floatval(str_replace(',', '', $values['ae_reporte'])) ?? 0,
                            'AE_engage' => floatval(str_replace(',', '', $values['ae_engage'])) ?? 0,
                            'CP_notifie' => floatval(str_replace(',', '', $values['cp_notifie'])) ?? 0,
                            'CP_reporte' => floatval(str_replace(',', '', $values['cp_reporte'])) ?? 0,
                            'CP_consome' => floatval(str_replace(',', '', $values['cp_consome'])) ?? 0,
                            'date_insert_SOUSoperation' =>now(),
                            'code_t3'=>30000,
                            'code_operation'=> $code_operation,
                            'date_update_SOUSoperation'=>now()
                        ]);
                     //  dd($sous);
                    // insérer dans ConstruireDPIA
                    ConstruireDPIA::create([
                        'code_sous_operation' =>  $sous->code_sous_operation, //sousopreation qui sera null car creation nouvel sousOperation in update function
                        'motif_dpia' => 'Modification T3 insert intitule et num decision',
                        'date_creation_dpia' => $portefeuille->Date_portefeuille,
                        'date_modification_dpia' => now(),
            
                        'AE_dpia_nv' => null,
                        'CP_dpia_nv' => null,
            
                        'AE_ouvert_dpia' => null,
                        'AE_atendu_dpia' => null,
                        'CP_ouvert_dpia' => null,
                        'CP_atendu_dpia' => null,
            
                        'AE_reporte_dpia' => floatval(str_replace(',', '', $values['ae_reporte'])) ?? $sousOperation->AE_reporte,
                        'AE_notifie_dpia' =>  floatval(str_replace(',', '', $values['ae_notifie'])) ?? $sousOperation->AE_notifie,
                        'AE_engage_dpia' => floatval(str_replace(',', '', $values['ae_engage'])) ?? $sousOperation->AE_engage,
                        'CP_reporte_dpia' => floatval(str_replace(',', '', $values['cp_reporte'])) ?? $sousOperation->CP_reporte,
                        'CP_notifie_dpia' => floatval(str_replace(',', '', $values['cp_notifie'])) ?? $sousOperation->CP_notifie,
                        'CP_consome_dpia' => floatval(str_replace(',', '', $values['cp_consome'])) ?? $sousOperation->CP_consome,
                        'id_rp' => 1,
                        'id_ra' => 1,
                    ]);
                        
                    } elseif (count($parts) > 7) {
                        dd(count($parts));
                        $sousOperation = SousOperation::create([
                            'code_sous_operation' => $code_sous_operation,
                            'nom_sous_operation' => $values['desc']. '_'. $values['intitule'] ,
                            'desc' => $values['desc'] ?? 'Description non fournie',
                            'intitule' => $values['intitule'] ?? 'Intitulé non fourni',
                            'AE_notifie' => floatval(str_replace(',', '', $values['ae_notifie'])) ?? 0,
                            'AE_reporte' => floatval(str_replace(',', '', $values['ae_reporte'])) ?? 0,
                            'AE_engage' => floatval(str_replace(',', '', $values['ae_engage'])) ?? 0,
                            'CP_notifie' => floatval(str_replace(',', '', $values['cp_notifie'])) ?? 0,
                            'CP_reporte' => floatval(str_replace(',', '', $values['cp_reporte'])) ?? 0,
                            'CP_consome' => floatval(str_replace(',', '', $values['cp_consome'] ))?? 0,
                            'date_insert_SOUSoperation' => now(),
                            'code_t3' => 30000,
                            'code_operation' => $code_operation,
                            'date_update_SOUSoperation' => now(),
                        ]);
                        //dd($sous);
                        ConstruireDPIA::create([
                            'code_sous_operation' => $sousOperation->code_sous_operation,
                            'motif_dpia' => 'Modification T3 - insert intitule et num decision',
                            'date_creation_dpia' => $portefeuille->Date_portefeuille ?? now(),
                            'date_modification_dpia' => now(),
                            'AE_dpia_nv' => null,
                            'CP_dpia_nv' => null,
                            'AE_ouvert_dpia' => null,
                            'AE_atendu_dpia' => null,
                            'CP_ouvert_dpia' => null,
                            'CP_atendu_dpia' => null,
                            'AE_reporte_dpia' => floatval(str_replace(',', '', $values['ae_reporte'])) ?? $sousOperation->ae_reporte,
                            'AE_notifie_dpia' => floatval(str_replace(',', '', $values['ae_notifie'])) ?? $sousOperation->ae_notifie,
                            'AE_engage_dpia' => floatval(str_replace(',', '', $values['ae_engage'])) ?? $sousOperation->ae_engage,
                            'CP_reporte_dpia' => floatval(str_replace(',', '', $values['cp_reporte'])) ?? $sousOperation->cp_reporte,
                            'CP_notifie_dpia' => floatval(str_replace(',', '', $values['cp_notifie'])) ?? $sousOperation->cp_notifie,
                            'CP_consome_dpia' => floatval(str_replace(',', '', $values['cp_consome'])) ?? $sousOperation->cp_consome,
                            'id_rp' => 1,
                            'id_ra' => 1,
                        ]);
                    }else {
                // code non valide 
                //dd(count($parts));
                return response()->json([
                    'message' => 'erreur code non valide  : ' . $code,
                    'code'=> 500] );
                }
                break;

                case '4':
                      // vérifier si le code est > 9 parties séparé par - 
                      $parts = explode('-', $code);
                      //dd($parts);
                      $code_operation = implode('-', array_slice($parts, 0, 8));
                      //dd($code_operation );
                      if (count($parts) > 7) {
                        // insertion d'une nouvelle sous-opération
                          $sous=SousOperation::create([
                              'code_sous_operation' => $code,
                              'nom_sous_operation' => $values['dispo']. '_'.'' ,
                              'dispo' => $values['dispo'] ?? 'Dispositif non fournie',
                              'AE_sous_operation' => floatval(str_replace(',', '', $values['ae'])) ?? 0,
                              'CP_sous_operation' => floatval(str_replace(',', '', $values['cp'])) ?? 0,
                              'date_insert_SOUSoperation' =>now(),
                              'code_t4'=>40000,
                              'code_operation'=> $code_operation,
                              'date_update_SOUSoperation'=>now()
                          ]);
                          //dd($sous);
                      // insérer dans ConstruireDPIA
                      ConstruireDPIA::create([
                          'code_sous_operation' =>  $sousOperation->code_sous_operation,
                          'motif_dpia' => 'Modification T4 insert dispositif',
                          'date_creation_dpia' => $portefeuille->Date_portefeuille,
                          'date_modification_dpia' => now(),
              
                          'AE_dpia_nv' => floatval(str_replace(',', '', $values['ae'])) ?? $sousOperation->AE_sous_operation, //si existe ok sinn aucune modif (ae_sous_op sera utilisé)
                          'CP_dpia_nv' => floatval(str_replace(',', '', $values['cp'])) ?? $sousOperation->CP_sous_operation,
              
                          'AE_ouvert_dpia' => null,
                          'AE_atendu_dpia' => null,
                          'CP_ouvert_dpia' => null,
                          'CP_atendu_dpia' => null,

                          'AE_reporte_dpia' => null,
                          'AE_notifie_dpia' => null,
                          'AE_engage_dpia' => null,
                          'CP_reporte_dpia' => null,
                          'CP_notifie_dpia' => null,
                          'CP_consome_dpia' => null,
                          
                          'id_rp' => 1,
                          'id_ra' => 1,
                      ]);
                          
                      } else {
                  // code non valide 
                  return response()->json([
                      'message' => 'erreur code non valide  : ' . $code,
                      'code'=> 500] );
                  }
                  break;
            }
        }
    }

        return response()->json([
            'message' => 'Mise à jour réussie et ajout dans ConstruireDPIA',
            'code' => 200,
        ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la mise à jour ou de l\'ajout', 'details' => $e->getMessage(),
        'code'=>500]);
        }
    }

    private function ModifT1(SousOperation $sousOperation, $values)
    {

     // dd($values,$sousOperation);
      //extrair le num de portefeuille les 7 premiers chiffres
      $codeSousOperation = $sousOperation->code_sous_operation;
      //dd( $codeSousOperation);
      $parts = explode('-', $codeSousOperation);
      //dd($parts);
      $codepor=$parts[0].'-'.$parts[1];
      $numPortefeuille = $codepor;
      //dd( $numPortefeuille );
      $portefeuille = Portefeuille::where('num_portefeuil', $numPortefeuille)->first();

        //update dans sous operation
        $sousOperation->update([
            'AE_sous_operation' => floatval(str_replace(',', '', $values['ae'])) ?? $sousOperation->AE_sous_operation, //si existe ok sinn aucune modif (ae_sous_op sera utilisé)
            'CP_sous_operation' => floatval(str_replace(',', '', $values['cp'])) ?? $sousOperation->CP_sous_operation,
            'date_update_SOUSoperation' => now(),
        ]);
        //dd($sousOperation);
        // insérer dans ConstruireDPIA
        ConstruireDPIA::create([
            'code_sous_operation' =>  $sousOperation->code_sous_operation,
            'motif_dpia' => 'Modification T1',
            'date_creation_dpia' => $portefeuille ? $portefeuille->Date_portefeuille : null,
            'AE_dpia_nv' => floatval(str_replace(',', '', $values['ae'])) ?? $sousOperation->AE_sous_operation, //si existe ok sinn aucune modif (ae_sous_op sera utilisé)
            'CP_dpia_nv' => floatval(str_replace(',', '', $values['cp'])) ?? $sousOperation->CP_sous_operation,
            'date_modification_dpia' => now(),
            'AE_ouvert_dpia' => null,
            'AE_atendu_dpia' => null,
            'CP_ouvert_dpia' => null,
            'CP_atendu_dpia' => null,
            'AE_reporte_dpia' => null,
            'AE_notifie_dpia' => null,
            'AE_engage_dpia' => null,
            'CP_reporte_dpia' => null,
            'CP_notifie_dpia' => null,
            'CP_consome_dpia' => null,
            'id_rp' => 1,
            'id_ra' => 1,

        ]);
    }

    private function ModifT2(SousOperation $sousOperation, $values)
    {
        //extrair le num de portefeuille les 7 premiers chiffres
      $codeSousOperation = $sousOperation->code_sous_operation;
      //dd( $codeSousOperation);
      $parts = explode('-', $codeSousOperation);
      //dd($parts);
      $codepor=$parts[0].'-'.$parts[1];
      $numPortefeuille = $codepor;
      //dd( $numPortefeuille );
      $portefeuille = Portefeuille::where('num_portefeuil', $numPortefeuille)->first();

        $sousOperation->update([
            'AE_ouvert' => floatval(str_replace(',', '', $values['ae_ouvert'])) ?? $sousOperation->AE_ouvert,
            'AE_atendu' => floatval(str_replace(',', '', $values['ae_attendu'])) ?? $sousOperation->AE_atendu,
            'CP_ouvert' => floatval(str_replace(',', '', $values['cp_ouvert'])) ?? $sousOperation->CP_ouvert,
            'CP_atendu' => floatval(str_replace(',', '', $values['cp_attendu'])) ?? $sousOperation->CP_atendu,
            'date_update_SOUSoperation' => now(),
        ]);

        // insérer dans ConstruireDPIA
        ConstruireDPIA::create([
           'code_sous_operation' =>  $sousOperation->code_sous_operation,
            'motif_dpia' => 'Modification T2',
            'date_creation_dpia' => $portefeuille->Date_portefeuille,
            'date_modification_dpia' => now(),

            'AE_dpia_nv' => null,
            'CP_dpia_nv' => null,

            'AE_ouvert_dpia' => floatval(str_replace(',', '', $values['ae_ouvert'])) ?? $sousOperation->AE_ouvert,
            'AE_atendu_dpia' => floatval(str_replace(',', '', $values['ae_attendu'])) ?? $sousOperation->AE_atendu,
            'CP_ouvert_dpia' => floatval(str_replace(',', '', $values['cp_ouvert'])) ?? $sousOperation->CP_ouvert,
            'CP_atendu_dpia' => floatval(str_replace(',', '', $values['cp_attendu'])) ?? $sousOperation->CP_atendu,

            'AE_reporte_dpia' => null,
            'AE_notifie_dpia' => null,
            'AE_engage_dpia' => null,
            'CP_reporte_dpia' => null,
            'CP_notifie_dpia' => null,
            'CP_consome_dpia' => null,
            'id_rp' => 1,
            'id_ra' => 1,

        ]);
    }

    private function ModifT3(SousOperation $sousOperation, $values)
    {
        //extrair le num de portefeuille les 7 premiers chiffres
      $codeSousOperation = $sousOperation->code_sous_operation;
      //dd( $codeSousOperation);
      $parts = explode('-', $codeSousOperation);
      //dd($parts);
      $codepor=$parts[0].'-'.$parts[1];
      $numPortefeuille = $codepor;
    
      $portefeuille = Portefeuille::where('num_portefeuil', $numPortefeuille)->first();


        $sousOperation->update([
            'AE_reporte' => floatval(str_replace(',', '', $values['ae_reporte'])) ?? $sousOperation->AE_reporte,
            'CP_reporte' => floatval(str_replace(',', '', $values['cp_reporte'])) ?? $sousOperation->CP_reporte,
            'AE_notifie' => floatval(str_replace(',', '', $values['ae_notifie'])) ?? $sousOperation->AE_notifie,
            'CP_notifie' => floatval(str_replace(',', '', $values['cp_notifie'])) ?? $sousOperation->CP_notifie,
            'AE_engage' => floatval(str_replace(',', '', $values['ae_engage'])) ?? $sousOperation->AE_engage,
            'CP_consome' => floatval(str_replace(',', '', $values['cp_consome'])) ?? $sousOperation->CP_consome,
            'date_update_SOUSoperation' => now(),
        ]);

        // insérer dans ConstruireDPIA
        ConstruireDPIA::create([
           'code_sous_operation' =>  $sousOperation->code_sous_operation,
           'motif_dpia' => 'Modification T3',
           'date_creation_dpia' => $portefeuille->Date_portefeuille,
           'date_modification_dpia' => now(),

            'AE_dpia_nv' => null,
            'CP_dpia_nv' => null,

            'AE_ouvert_dpia' => null,
            'AE_atendu_dpia' => null,
            'CP_ouvert_dpia' => null,
            'CP_atendu_dpia' => null,

            'AE_reporte_dpia' => floatval(str_replace(',', '', $values['ae_reporte'])) ?? $sousOperation->AE_reporte,
            'AE_notifie_dpia' =>  floatval(str_replace(',', '', $values['ae_notifie'])) ?? $sousOperation->AE_notifie,
            'AE_engage_dpia' => floatval(str_replace(',', '', $values['ae_engage'])) ?? $sousOperation->AE_engage,
            'CP_reporte_dpia' => floatval(str_replace(',', '', $values['cp_reporte'])) ?? $sousOperation->CP_reporte,
            'CP_notifie_dpia' => floatval(str_replace(',', '', $values['cp_notifie'])) ?? $sousOperation->CP_notifie,
            'CP_consome_dpia' => floatval(str_replace(',', '', $values['cp_consome'])) ?? $sousOperation->CP_consome,
            'id_rp' => 1,
            'id_ra' => 1,
        ]);
    }

    private function ModifT4(SousOperation $sousOperation, $values)
            {
        //extrair le num de portefeuille les 7 premiers chiffres
        $codeSousOperation = $sousOperation->code_sous_operation;
        //dd( $codeSousOperation);
        $parts = explode('-', $codeSousOperation);
      //dd($parts);
      $codepor=$parts[0].'-'.$parts[1];
      $numPortefeuille = $codepor;
        //dd( $numPortefeuille );
        $portefeuille = Portefeuille::where('num_portefeuil', $numPortefeuille)->first();

        $sousOperation->update([
            'AE_sous_operation' => floatval(str_replace(',', '', $values['ae'])) ?? $sousOperation->AE_sous_operation,
            'CP_sous_operation' => floatval(str_replace(',', '', $values['cp'])) ?? $sousOperation->CP_sous_operation,
            'date_update_SOUSoperation' => now(),
        ]);

        // insérer dans ConstruireDPIA
        ConstruireDPIA::create([
            'code_sous_operation' =>  $sousOperation->code_sous_operation,
            'motif_dpia' => 'Modification T4',
            'date_creation_dpia' => $portefeuille->Date_portefeuille,
            'date_modification_dpia' =>now(),

            'AE_dpia_nv' =>floatval(str_replace(',', '', $values['ae'])) ?? $sousOperation->AE_sous_operation,
            'CP_dpia_nv' =>floatval(str_replace(',', '', $values['cp'])) ?? $sousOperation->CP_sous_operation,

            'AE_ouvert_dpia' => null,
            'AE_atendu_dpia' => null,
            'CP_ouvert_dpia' => null,
            'CP_atendu_dpia' => null,

            'AE_reporte_dpia' => null,
            'AE_notifie_dpia' => null,
            'AE_engage_dpia' => null,
            'CP_reporte_dpia' => null,
            'CP_notifie_dpia' => null,
            'CP_consome_dpia' => null,
            'id_rp' => 1,
            'id_ra' => 1,

        ]);
    }

    //insérer dans la table moddif
    public function insertModif(Request $request)
    {
        //récupéreer lees données
            $modifications = $request->all();
           //dd($modifications);
           $id_portefeuille = $modifications['id_port'] ?? null;
            if (!$id_portefeuille) {
                return response()->json(['code' =>500,
                                        'message'=>'ID portefeuille manquant']);
            }

        //dd($id_portefeuille);
            $initPorts = DB::table('init_ports')->get();
          //  dd($initPorts );
        
            if ($initPorts->isEmpty()) {
                return response()->json([
                    'code' => 500,
                    'message' => 'Aucune donnée trouvée dans init_ports'
                ]);
            }
        
            // extraire les id_portef depuis num_sous_prog 
            $idPortefeuilles = [];
        
            foreach ($initPorts as $port) {
                $parts = explode('-', $port->num_sous_prog);
                if (count($parts) >= 2) {
                    $id = $parts[0] . '-' . $parts[1];
                   // dd($id);
                    $idPortefeuilles[$id] = true; // pour éviter les doublons
                }
            }
        
            // vérifier si id_portef de request modif existe dans inits
            if (!isset($idPortefeuilles[$id_portefeuille])) {
                return response()->json([
                    'code' => 404,
                    'message' => "ID portefeuille {$id_portefeuille} non trouvé dans init_ports"
                ]);
            }
            //dd($idPortefeuilles);
        
            // création ou update de la vue
            
            $viewName = 'init_ports_' . str_replace('-', '_', $id_portefeuille);

            //si la table n'existe pas alors on va la créer 
            if (!Schema::hasTable($viewName)) {
                
                $sql = "CREATE TABLE {$viewName} AS 
                        SELECT * FROM init_ports WHERE num_sous_prog LIKE '{$id_portefeuille}%'";
            
                DB::statement($sql);
            }
            
            // ajouter auto les nouvelles lignes de init 
            $nouveaux_enregistrements = DB::table('init_ports')
            ->leftJoin($viewName, 'init_ports.id_init', '=', "$viewName.id_init")
            ->where('init_ports.num_sous_prog', 'LIKE', "{$id_portefeuille}%")
            ->whereNull("$viewName.id_init") 
            ->select('init_ports.*')
            ->get();
        
            //dd($nouveaux_enregistrements);
            $dataToInsert = [];
            foreach ($nouveaux_enregistrements as $newRow) {
                $dataToInsert[] = (array) $newRow;
            }
            
            if (!empty($dataToInsert)) {
                DB::table($viewName)->insert($dataToInsert);
            }
            
            $view = DB::table($viewName)->get();
            //dd( $view);



            $validated=$request;
           //dd($validated);

            //initialiser lees var
            $AE_env_T1 = 0;
            $CP_env_T1 = 0;

            $AE_env_T2 = 0;
            $CP_env_T2 = 0;

            $AE_env_T3 = 0;
            $CP_env_T3 = 0;

            $AE_env_T4 = 0;
            $CP_env_T4 = 0;

            $codeT1 = $codeT2 = $codeT3 = $codeT4 = null;
        // remplir les colonnes d'envoi en fonction de T_port_env

            switch ($validated['T_port_env']) {
                case 'T1':
                    $AE_env_T1 = $validated['AE_env_T'];
                    $CP_env_T1 = $validated['CP_env_T'];
                    
                    $codeT1 =T1::value('code_t1');

                    break;
                case 'T2':
                    $AE_env_T2 = $validated['AE_env_T'];
                    $CP_env_T2 = $validated['CP_env_T'];
                    $codeT2 =T2::value('code_t2');

                    break;
                case 'T3':
                    $AE_env_T3 = $validated['AE_env_T'];
                    $CP_env_T3 = $validated['CP_env_T'];
                    $codeT3 = T3::value('code_t3');

                    break;
                case 'T4':
                    $AE_env_T4 = $validated['AE_env_T'];
                    $CP_env_T4 = $validated['CP_env_T'];
                    $codeT4 = T4::value('code_t4');

                    break;
            }
            //dd(  $CP_env_T1);

            if ($validated['AE_T1'] != 0 || $validated['CP_T1'] != 0) {
                $codeT1 = T1::value('code_t1');
            }
            if ($validated['AE_T2'] != 0 || $validated['CP_T2'] != 0) {
                $codeT2 = T2::value('code_t2');
            }
            if ($validated['AE_T3'] != 0 || $validated['CP_T3'] != 0) {
                $codeT3 = T3::value('code_t3');
            }
            if ($validated['AE_T4'] != 0 || $validated['CP_T4'] != 0) {
                $codeT4 = T4::value('code_t4');
            }



            //  récupérer les anciennes valeurs des prog et sous prog
            $sousProgRetire = SousProgramme::where('num_sous_prog', $validated['Sous_prog_retire'])->first();
           // dd( $sousProgRetire);
            $sousProgReçoit = SousProgramme::where('num_sous_prog', $validated['sousprogbum_click'])->first();
            //dd($validated['sousprogbum_click']);

            $actionrec=SousAction::where('num_sous_action',$validated['act_cible_env'])->first();
           //dd($actionrec);
           $actionrec_ = $actionrec?->Action;
           //dd( $actionrec_ );   
           $actionret=SousAction::where('num_sous_action',$validated['act_cible_ret'])->first();
           // dd($actionret);
        
           $actionret_ = $actionret?->Action;
         //  dd( $actionret_ );   

            $ProgRetire = Programme::where('num_prog', $validated['prog_retirer'])->first();
           //dd( $ProgRetire);
           $portefRetire = $ProgRetire?->Portefeuille;
            $ProgReçoit = Programme::where('num_prog', $validated['prognum_click'])->first();
           // dd($ProgReçoit);
           $portefRecoit = $ProgReçoit?->Portefeuille;
           $portefeuille=Portefeuille::where('num_portefeuil',$validated['id_port'])->first();
         //  dd($portefeuille);
           /* if (!$sousProgRetire || !$sousProgReçoit ||!$ProgRetire || !$ProgReçoit) {
                return response()->json(['message' => 'Programme ou sous-programme introuvable'], 404);
            }
                
*/

            //calcull 
            //action 
          
            //portefeuille vers portefeuille 
            if($portefeuille){
              
                if ($validated['type_port']=="recoit_port")
                {   //dd($portefeuille);
                    $portefeuille->AE_portef+=$validated['AE_port'];
                    $portefeuille->CP_portef+=$validated['CP_port'];
                    $portefeuille->Date_update_portefeuille = now();
               
                    $portefeuille->save();


                    if ($ProgReçoit) {
                    $ProgReçoit->AE_prog += $validated['AE_T1'] + $validated['AE_T2'] + $validated['AE_T3'] + $validated['AE_T4'];
                    $ProgReçoit->CP_prog += $validated['CP_T1'] + $validated['CP_T2'] + $validated['CP_T3'] + $validated['CP_T4'];
                    $ProgReçoit->date_update_portef = now();
                    $ProgReçoit->save();
                    } 


                    if ($sousProgReçoit) {
                    $sousProgReçoit->AE_sous_prog += $validated['AE_T1'] +  $validated['AE_T2'] +  $validated['AE_T3'] + $validated['AE_T4'];
                    $sousProgReçoit->CP_sous_prog += $validated['CP_T1'] + $validated['CP_T2'] +  $validated['CP_T3'] + $validated['CP_T4'];
                    $sousProgReçoit->date_update_sousProg = now();
                    $sousProgReçoit->save();
                    }

                    if($actionrec_) {
                        
                    $actionrec_->AE_action += $validated['AE_T1'] +  $validated['AE_T2'] +  $validated['AE_T3'] + $validated['AE_T4'];
                    $actionrec_->CP_action += $validated['CP_T1'] + $validated['CP_T2'] +  $validated['CP_T3'] + $validated['CP_T4'];
                    $actionrec_->date_update_action = now();
                    $actionrec_->save();
                    }

                    if($actionrec){
                    $actionrec->AE_sous_action += $validated['AE_T1'] +  $validated['AE_T2'] +  $validated['AE_T3'] + $validated['AE_T4'];
                    $actionrec->CP_sous_action += $validated['CP_T1'] + $validated['CP_T2'] +  $validated['CP_T3'] + $validated['CP_T4'];
                    $actionrec->date_update_sous_action = now();
                    $actionrec->save();
                    }  
                    foreach ($view as $row) {
                        if ($row->num_sous_prog == $sousProgReçoit->num_sous_prog && is_null($row->num_action)) {
                       
                        DB::table($viewName)
                            ->where('num_sous_prog', $row->num_sous_prog)
                            ->whereNull('num_action')
                            ->update([
                                'AE_init_t1' => DB::raw("AE_init_t1 + {$validated['AE_T1']}"),
                                'CP_init_t1' => DB::raw("CP_init_t1 + {$validated['CP_T1']}"),
                                'AE_init_t2' => DB::raw("AE_init_t2 + {$validated['AE_T2']}"),
                                'CP_init_t2' => DB::raw("CP_init_t2 + {$validated['CP_T2']}"),
                                'AE_init_t3' => DB::raw("AE_init_t3 + {$validated['AE_T3']}"),
                                'CP_init_t3' => DB::raw("CP_init_t3 + {$validated['CP_T3']}"),
                                'AE_init_t4' => DB::raw("AE_init_t4 + {$validated['AE_T4']}"),
                                'CP_init_t4' => DB::raw("CP_init_t4 + {$validated['CP_T4']}")
                            ]);
                    }

                        if ($row->num_action == $actionrec_->num_action ) {
                       
                        DB::table($viewName)
                            ->where('num_action', $row->num_action)
                            ->update([
                                'AE_init_t1' => DB::raw("AE_init_t1 + {$validated['AE_T1']}"),
                                'CP_init_t1' => DB::raw("CP_init_t1 + {$validated['CP_T1']}"),
                                'AE_init_t2' => DB::raw("AE_init_t2 + {$validated['AE_T2']}"),
                                'CP_init_t2' => DB::raw("CP_init_t2 + {$validated['CP_T2']}"),
                                'AE_init_t3' => DB::raw("AE_init_t3 + {$validated['AE_T3']}"),
                                'CP_init_t3' => DB::raw("CP_init_t3 + {$validated['CP_T3']}"),
                                'AE_init_t4' => DB::raw("AE_init_t4 + {$validated['AE_T4']}"),
                                'CP_init_t4' => DB::raw("CP_init_t4 + {$validated['CP_T4']}")
                            ]);
                    }
                }
                }elseif($validated['type_port']=="envoi_port"){
                    $portefeuille->AE_portef-=$validated['AE_port'];
                    $portefeuille->CP_portef-=$validated['CP_port'];
                    $portefeuille->Date_update_portefeuille = now();
                    $portefeuille->save();

                    if ($ProgReçoit) {
                    $ProgReçoit->AE_prog -= (float) ($validated['AE_T1'] + $validated['AE_T2'] + $validated['AE_T3'] + $validated['AE_T4']);
                    $ProgReçoit->CP_prog -= (float) ($validated['CP_T1'] + $validated['CP_T2'] + $validated['CP_T3'] + $validated['CP_T4']);
                    $ProgReçoit->date_update_portef = now();
                    $ProgReçoit->save();
                    }

                    if ($sousProgReçoit) {
                    $sousProgReçoit->AE_sous_prog -=  ($validated['AE_T1'] +  $validated['AE_T2'] +  $validated['AE_T3'] + $validated['AE_T4']);
                    $sousProgReçoit->CP_sous_prog -=  ($validated['CP_T1'] + $validated['CP_T2'] +  $validated['CP_T3'] + $validated['CP_T4']);
                    $sousProgReçoit->date_update_sousProg = now();
                    $sousProgReçoit->save();
                    }

                    if ($actionrec_) {
                    $actionrec_->AE_action -=  ($validated['AE_T1'] +  $validated['AE_T2'] +  $validated['AE_T3'] + $validated['AE_T4']);
                    $actionrec_->CP_action -= ($validated['CP_T1'] + $validated['CP_T2'] +  $validated['CP_T3'] + $validated['CP_T4']);
                    $actionrec_->date_update_action = now();
                    $actionrec_->save();
                    }

                    if ($actionrec) {
                    $actionrec->AE_sous_action -= (float) ($validated['AE_T1'] +  $validated['AE_T2'] +  $validated['AE_T3'] + $validated['AE_T4']);
                    $actionrec->CP_sous_action-= (float) ($validated['CP_T1'] + $validated['CP_T2'] +  $validated['CP_T3'] + $validated['CP_T4']);
                    $actionrec->date_update_sous_action = now();
                    $actionrec->save();
                    }

                    foreach ($view as $row) {   
                        if ($row->num_sous_prog == $sousProgReçoit->num_sous_prog && is_null($row->num_action)) {
                            //dd($validated['T_port_env']);
                      // dd($AE_env_T1);
                        DB::table($viewName)
                            ->where('num_sous_prog', $row->num_sous_prog)
                            ->whereNull('num_action')
                            ->update([
                                'AE_init_t1' => DB::raw("AE_init_t1 - {$validated['AE_T1']}"),
                                'CP_init_t1' => DB::raw("CP_init_t1 - {$validated['CP_T1']}"),
                                'AE_init_t2' => DB::raw("AE_init_t2 - {$validated['AE_T2']}"),
                                'CP_init_t2' => DB::raw("CP_init_t2 - {$validated['CP_T2']}"),
                                'AE_init_t3' => DB::raw("AE_init_t3 - {$validated['AE_T3']}"),
                                'CP_init_t3' => DB::raw("CP_init_t3 - {$validated['CP_T3']}"),
                                'AE_init_t4' => DB::raw("AE_init_t4 - {$validated['AE_T4']}"),
                                'CP_init_t4' => DB::raw("CP_init_t4 - {$validated['CP_T4']}")
                            ]);
                    }

                        if ($row->num_action == $actionrec_->num_action ) {
                       
                        DB::table($viewName)
                            ->where('num_action', $row->num_action)
                            ->update([
                                'AE_init_t1' => DB::raw("AE_init_t1 - {$validated['AE_T1']}"),
                                'CP_init_t1' => DB::raw("CP_init_t1 - {$validated['CP_T1']}"),
                                'AE_init_t2' => DB::raw("AE_init_t2 - {$validated['AE_T2']}"),
                                'CP_init_t2' => DB::raw("CP_init_t2 - {$validated['CP_T2']}"),
                                'AE_init_t3' => DB::raw("AE_init_t3 - {$validated['AE_T3']}"),
                                'CP_init_t3' => DB::raw("CP_init_t3 - {$validated['CP_T3']}"),
                                'AE_init_t4' => DB::raw("AE_init_t4 - {$validated['AE_T4']}"),
                                'CP_init_t4' => DB::raw("CP_init_t4 - {$validated['CP_T4']}")
                            ]);
                    }
                }
        
            }
           
            //les programes et sous prog
            if( $validated['type']=="inter"){

                if($sousProgReçoit->num_sous_prog==$sousProgRetire->num_sous_prog){
                    //dd($sousProgRetire->num_sous_prog);
                    $sousProgReçoit->AE_sous_prog += $validated['AE_T1'] +  $validated['AE_T2'] +  $validated['AE_T3'] + $validated['AE_T4'];
                    $sousProgReçoit->CP_sous_prog += $validated['CP_T1'] + $validated['CP_T2'] +  $validated['CP_T3'] + $validated['CP_T4'];
                    $sousProgReçoit->date_update_sousProg = now();

                    $sousProgReçoit->AE_sous_prog -= (float) $validated['AE_env_T'];
                    $sousProgReçoit->CP_sous_prog -=(float) $validated['CP_env_T'];
                    $sousProgReçoit->date_update_sousProg = now();
                  //  dd($sousProgReçoit);
                    $sousProgReçoit->save();
                    
                    
                 
                }
              

                else {
                    $sousProgReçoit->AE_sous_prog += $validated['AE_T1'] +  $validated['AE_T2'] +  $validated['AE_T3'] + $validated['AE_T4'];
                    $sousProgReçoit->CP_sous_prog += $validated['CP_T1'] + $validated['CP_T2'] +  $validated['CP_T3'] + $validated['CP_T4'];
                    $sousProgReçoit->date_update_sousProg = now();
                    //dd( $sousProgReçoit);
                    $sousProgReçoit->save();

                    $sousProgRetire->AE_sous_prog -=  $validated['AE_env_T'];
                    $sousProgRetire->CP_sous_prog -= $validated['CP_env_T'];
                    $sousProgRetire->date_update_sousProg = now();
                    
                    $sousProgRetire->save();
                     // dd( $sousProgRetire);
                }
            
                if ($ProgReçoit->num_prog ==$ProgRetire->num_prog) {
                
                    $ProgReçoit->AE_prog += $validated['AE_T1'] + $validated['AE_T2'] + $validated['AE_T3'] + $validated['AE_T4'];
                    $ProgReçoit->CP_prog += $validated['CP_T1'] +$validated['CP_T2'] +$validated['CP_T3'] +$validated['CP_T4'];
                
                    $ProgReçoit->AE_prog -=$validated['AE_env_T'];
                    $ProgReçoit->CP_prog -= $validated['CP_env_T'];
                
                
                    $ProgReçoit->date_update_portef = now();
          
                    $ProgReçoit->save();

                    //portefeuille aussi 
                    $portefRecoit->AE_portef += $validated['AE_T1'] + $validated['AE_T2'] + $validated['AE_T3'] + $validated['AE_T4'];
                    $portefRecoit->CP_portef += $validated['CP_T1'] +$validated['CP_T2'] +$validated['CP_T3'] +$validated['CP_T4'];
                
                    $portefRecoit->AE_portef -=$validated['AE_env_T'];
                    $portefRecoit->CP_portef -= $validated['CP_env_T'];
                
                
                    $portefRecoit->Date_update_portefeuille = now();
             
                    $portefRecoit->save();


         
                } else {
                      
                            $ProgReçoit->AE_prog += $validated['AE_T1'] + $validated['AE_T2'] + $validated['AE_T3'] + $validated['AE_T4'];
                            $ProgReçoit->CP_prog += $validated['CP_T1'] + $validated['CP_T2'] + $validated['CP_T3'] + $validated['CP_T4'];
                            $ProgReçoit->date_update_portef = now();
                            $ProgReçoit->save();

                                //portefeuille 
                            $portefRecoit->AE_portef += $validated['AE_T1'] + $validated['AE_T2'] + $validated['AE_T3'] + $validated['AE_T4'];
                            $portefRecoit->CP_portef += $validated['CP_T1'] +$validated['CP_T2'] +$validated['CP_T3'] +$validated['CP_T4'];
                            $portefRecoit->Date_update_portefeuille = now();
                            $portefRecoit->save();
                        
                          
                            $ProgRetire->AE_prog -= $validated['AE_env_T'];
                            $ProgRetire->CP_prog -= $validated['CP_env_T'];
                            $ProgRetire->date_update_portef = now();
                            $ProgRetire->save();

                            //portefeuille
                            $portefRetire ->AE_portef -=$validated['AE_env_T'];
                            $portefRetire->CP_portef -= $validated['CP_env_T'];
                            $portefRetire->Date_update_portefeuille  = now();
                            $portefRetire->save();
                    }

                    if($actionrec->num_sous_action==$actionret->num_sous_action){
                     
                        $actionrec->AE_sous_action += $validated['AE_T1'] +  $validated['AE_T2'] +  $validated['AE_T3'] + $validated['AE_T4'];
                        $actionrec->CP_sous_action += $validated['CP_T1'] + $validated['CP_T2'] +  $validated['CP_T3'] + $validated['CP_T4'];
                        $actionrec->date_update_sous_action = now();
    
                        $actionrec_->AE_action += $validated['AE_T1'] +  $validated['AE_T2'] +  $validated['AE_T3'] + $validated['AE_T4'];
                        $actionrec_->CP_action += $validated['CP_T1'] + $validated['CP_T2'] +  $validated['CP_T3'] + $validated['CP_T4'];
                        $actionrec_->date_update_action = now();

                        $actionrec->AE_sous_action -= (float) $validated['AE_env_T'];
                        $actionrec->CP_sous_action -=(float) $validated['CP_env_T'];
                        $actionrec->date_update_sous_action = now();
                      
                        $actionrec_->AE_action -= (float) $validated['AE_env_T'];
                        $actionrec_->CP_action -=(float) $validated['CP_env_T'];
                        $actionrec_->date_update_action = now();
                        //dd($actionrec);
                        //dd($actionrec_);
                        $actionrec->save();
                        $actionrec_->save();
                    }
                  
    
                    else {
                        $actionrec->AE_sous_action += $validated['AE_T1'] +  $validated['AE_T2'] +  $validated['AE_T3'] + $validated['AE_T4'];
                        $actionrec->CP_sous_action += $validated['CP_T1'] + $validated['CP_T2'] +  $validated['CP_T3'] + $validated['CP_T4'];
                        $actionrec->date_update_sous_action = now();
                        //dd( $actionrec);
                        $actionrec->save();

                        $actionrec_->AE_action += $validated['AE_T1'] +  $validated['AE_T2'] +  $validated['AE_T3'] + $validated['AE_T4'];
                        $actionrec_->CP_action += $validated['CP_T1'] + $validated['CP_T2'] +  $validated['CP_T3'] + $validated['CP_T4'];
                        $actionrec_->date_update_action = now();
                       // dd( $actionrec_);
                        $actionrec_->save();

    
                        $actionret->AE_sous_action -=  $validated['AE_env_T'];
                        $actionret->CP_sous_action -= $validated['CP_env_T'];
                        $actionret->date_update_sous_action = now();
                        //dd($actionret);
                        $actionret->save();
                        

                         
                        $actionret_->AE_action -=  $validated['AE_env_T'];
                        $actionret_->CP_action -= $validated['CP_env_T'];
                        $actionret_->date_update_action = now();
                           // dd( $actionret_);
                        $actionret_->save();
                      
                    }
                //update dans view 
           
              
                    DB::enableQueryLog();
               
                       // dd($row);
                      $updated = DB::table($viewName)
                            ->where('num_sous_prog', $sousProgRetire->num_sous_prog)
                            ->whereNull('num_action')
                            ->first();
                            
                               // dd($AE_env_T1);
                                $AE_init_t1= $updated->AE_init_t1 - (float)$AE_env_T1;
                                $CP_init_t1=$updated->CP_init_t1- (float)$CP_env_T1;
                                $AE_init_t2 =$updated->AE_init_t2  - (float)$AE_env_T2;
                                $CP_init_t2 =$updated->CP_init_t2 -(float) $CP_env_T2;
                                $AE_init_t3=$updated->AE_init_t3 - (float)$AE_env_T3;
                                $CP_init_t3 =$updated->CP_init_t3 - (float)$CP_env_T3; 
                                $AE_init_t4=$updated->AE_init_t4 - (float)$AE_env_T4; 
                                $CP_init_t4 =$updated->CP_init_t4 -(float) $CP_env_T4; 
    
                                $updated= DB::table($viewName)
                                ->where('num_sous_prog', $sousProgRetire->num_sous_prog)
                                ->whereNull('num_action')->
                                update([
                                    'AE_init_t1' =>   $AE_init_t1,
                                    'CP_init_t1' =>  $CP_init_t1,
                                    'AE_init_t2' =>  $AE_init_t2,
                                    'CP_init_t2' => $CP_init_t2 ,
                                    'AE_init_t3' =>  $AE_init_t3,
                                    'CP_init_t3' => $CP_init_t3,
                                    'AE_init_t4' =>  $AE_init_t4,
                                    'CP_init_t4' => $CP_init_t4 ,
                                ]);
                                $queries = DB::getQueryLog(); 
                           /* dd( $AE_init_t1,$CP_init_t1
                        ,$AE_init_t2,$CP_init_t2,
                        $AE_init_t3,$CP_init_t3,
                        $AE_init_t4,$CP_init_t4);  */
                        
                       /*update([
                                'AE_init_t1' => DB::raw("AE_init_t1 - $AE_env_T1"),
                                'CP_init_t1' => DB::raw("CP_init_t1 - $CP_env_T1"),
                                'AE_init_t2' => DB::raw("AE_init_t2 - $AE_env_T2"),
                                'CP_init_t2' => DB::raw("CP_init_t2 - $CP_env_T2"),
                                'AE_init_t3' => DB::raw("AE_init_t3 - $AE_env_T3"),
                                'CP_init_t3' => DB::raw("CP_init_t3 - $CP_env_T3"),
                                'AE_init_t4' => DB::raw("AE_init_t4 - $AE_env_T4"),
                                'CP_init_t4' => DB::raw("CP_init_t4 - $CP_env_T4")
                            ]);*/
                            $queries = DB::getQueryLog(); 
                           // dd( $updates);   
                    
                
                
                        DB::table($viewName)
                            ->where('num_action', $actionret_->num_action)
                            ->update([
                                'AE_init_t1' => DB::raw("AE_init_t1 - $AE_env_T1"),
                                'CP_init_t1' => DB::raw("CP_init_t1 - $CP_env_T1"),
                                'AE_init_t2' => DB::raw("AE_init_t2 - $AE_env_T2"),
                                'CP_init_t2' => DB::raw("CP_init_t2 - $CP_env_T2"),
                                'AE_init_t3' => DB::raw("AE_init_t3 - $AE_env_T3"),
                                'CP_init_t3' => DB::raw("CP_init_t3 - $CP_env_T3"),
                                'AE_init_t4' => DB::raw("AE_init_t4 - $AE_env_T4"),
                                'CP_init_t4' => DB::raw("CP_init_t4 - $CP_env_T4")
                            ]);
                    
               
                foreach ($view as $row) {
                    DB::enableQueryLog();
                    if ($row->num_sous_prog == $sousProgReçoit->num_sous_prog && $row->num_action === null) {
                      //  dd($row, $sousProgReçoit);
                      $updated= DB::table($viewName)
                            ->where('num_sous_prog', $sousProgReçoit->num_sous_prog)
                            ->whereNull('num_action')
                            ->first();
                            //dd($validated['AE_T1']);
                            $AE_init_t1= $updated->AE_init_t1+(float)$validated['AE_T1'];
                            $CP_init_t1=$updated->CP_init_t1+(float)$validated['CP_T1'];
                            $AE_init_t2 =$updated->AE_init_t2 + (float)$validated['AE_T2'];
                            $CP_init_t2 =$updated->CP_init_t2 + (float)$validated['CP_T2'];
                            $AE_init_t3=$updated->AE_init_t3 +(float) $validated['AE_T3'];
                            $CP_init_t3 =$updated->CP_init_t3 + (float)$validated['CP_T3']; 
                            $AE_init_t4=$updated->AE_init_t4 + (float)$validated['AE_T4']; 
                            $CP_init_t4 =$updated->CP_init_t4 +(float) $validated['CP_T4']; 

                            $updated= DB::table($viewName)
                            ->where('num_sous_prog', $sousProgReçoit->num_sous_prog)
                            ->whereNull('num_action')->
                            update([
                                'AE_init_t1' =>   $AE_init_t1,
                                'CP_init_t1' =>  $CP_init_t1,
                                'AE_init_t2' =>  $AE_init_t2,
                                'CP_init_t2' => $CP_init_t2 ,
                                'AE_init_t3' =>  $AE_init_t3,
                                'CP_init_t3' => $CP_init_t3,
                                'AE_init_t4' =>  $AE_init_t4,
                                'CP_init_t4' => $CP_init_t4 ,
                            ]);
                            $queries = DB::getQueryLog(); 
                       /* dd( $AE_init_t1,$CP_init_t1
                    ,$AE_init_t2,$CP_init_t2,
                    $AE_init_t3,$CP_init_t3,
                    $AE_init_t4,$CP_init_t4);   */
                    }
                   
                    if ($row->num_action == $actionrec_->num_action) {
                       
                        DB::table($viewName)
                            ->where('num_action', $actionrec_->num_action)
                            ->update([
                                'AE_init_t1' => DB::raw("AE_init_t1 + {$validated['AE_T1']}"),
                                'CP_init_t1' => DB::raw("CP_init_t1 + {$validated['CP_T1']}"),
                                'AE_init_t2' => DB::raw("AE_init_t2 + {$validated['AE_T2']}"),
                                'CP_init_t2' => DB::raw("CP_init_t2 + {$validated['CP_T2']}"),
                                'AE_init_t3' => DB::raw("AE_init_t3 + {$validated['AE_T3']}"),
                                'CP_init_t3' => DB::raw("CP_init_t3 + {$validated['CP_T3']}"),
                                'AE_init_t4' => DB::raw("AE_init_t4 + {$validated['AE_T4']}"),
                                'CP_init_t4' => DB::raw("CP_init_t4 + {$validated['CP_T4']}")
                            ]);
                           // dd($validated['AE_T1']);
                    }
                }
                
                // Ajouter aux sous-programmes et actions
              
        
    } elseif ($validated['type'] == "exter" && $validated['type_extr'] == "res") {
        $sousProgReçoit->AE_sous_prog += $validated['AE_T1'] +  $validated['AE_T2'] +  $validated['AE_T3'] + $validated['AE_T4'];
        $sousProgReçoit->CP_sous_prog += $validated['CP_T1'] + $validated['CP_T2'] +  $validated['CP_T3'] + $validated['CP_T4'];
        $sousProgReçoit->date_update_sousProg = now();
        //dd( $sousProgReçoit);
        $sousProgReçoit->save();

        
        $ProgReçoit->AE_prog += $validated['AE_T1'] + $validated['AE_T2'] + $validated['AE_T3'] + $validated['AE_T4'];
        $ProgReçoit->CP_prog += $validated['CP_T1'] + $validated['CP_T2'] + $validated['CP_T3'] + $validated['CP_T4'];
        $ProgReçoit->date_update_portef = now();
        $ProgReçoit->save();
        //dd( $ProgReçoit);
        $actionrec->AE_sous_action += $validated['AE_T1'] +  $validated['AE_T2'] +  $validated['AE_T3'] + $validated['AE_T4'];
        $actionrec->CP_sous_action += $validated['CP_T1'] + $validated['CP_T2'] +  $validated['CP_T3'] + $validated['CP_T4'];
        $actionrec->date_update_sous_action = now();
        //dd( $actionrec);
        $actionrec->save();

        $actionrec_->AE_action += $validated['AE_T1'] +  $validated['AE_T2'] +  $validated['AE_T3'] + $validated['AE_T4'];
        $actionrec_->CP_action += $validated['CP_T1'] + $validated['CP_T2'] +  $validated['CP_T3'] + $validated['CP_T4'];
        $actionrec_->date_update_action = now();
       // dd( $actionrec_);
        $actionrec_->save();

        }elseif ($validated['type'] == "exter" && $validated['type_extr'] == "env") {
            $sousProgReçoit->AE_sous_prog -= $validated['AE_T1'] +  $validated['AE_T2'] +  $validated['AE_T3'] + $validated['AE_T4'];
            $sousProgReçoit->CP_sous_prog -= $validated['CP_T1'] + $validated['CP_T2'] +  $validated['CP_T3'] + $validated['CP_T4'];
            $sousProgReçoit->date_update_sousProg = now();
            //dd( $sousProgReçoit);
            $sousProgReçoit->save();
    
            
            $ProgReçoit->AE_prog -= $validated['AE_T1'] + $validated['AE_T2'] + $validated['AE_T3'] + $validated['AE_T4'];
            $ProgReçoit->CP_prog -= $validated['CP_T1'] + $validated['CP_T2'] + $validated['CP_T3'] + $validated['CP_T4'];
            $ProgReçoit->date_update_portef = now();
            $ProgReçoit->save();

            $actionrec->AE_sous_action += $validated['AE_T1'] +  $validated['AE_T2'] +  $validated['AE_T3'] + $validated['AE_T4'];
            $actionrec->CP_sous_action += $validated['CP_T1'] + $validated['CP_T2'] +  $validated['CP_T3'] + $validated['CP_T4'];
            $actionrec->date_update_sous_action = now();
            //dd( $actionrec);
            $actionrec->save();

            $actionrec_->AE_action += $validated['AE_T1'] +  $validated['AE_T2'] +  $validated['AE_T3'] + $validated['AE_T4'];
            $actionrec_->CP_action += $validated['CP_T1'] + $validated['CP_T2'] +  $validated['CP_T3'] + $validated['CP_T4'];
            $actionrec_->date_update_action = now();
           // dd( $actionrec_);
            $actionrec_->save();


        }else {

        }
      
    }
        

        // insérer les données dans la table modif
       $modif= ModificationT::create([
            'date_modif' => now(),

            'AE_envoi_t1' => $AE_env_T1,
            'CP_envoi_t1' => $CP_env_T1,
            'AE_envoi_t2' => $AE_env_T2,
            'CP_envoi_t2' =>$CP_env_T2 ,
            'AE_envoi_t3' => $AE_env_T3,
            'CP_envoi_t3' =>$CP_env_T3 ,
            'AE_envoi_t4' => $AE_env_T4,
            'CP_envoi_t4' =>  $CP_env_T4,


            'AE_recoit_t1' => $validated['AE_T1'] ,
            'CP_recoit_t1' => $validated['CP_T1'],
            'AE_recoit_t2' => $validated['AE_T2'],
            'CP_recoit_t2' => $validated['CP_T2'],
            'AE_recoit_t3' => $validated['AE_T3'],
            'CP_recoit_t3' => $validated['CP_T3'],
            'AE_recoit_t4' =>$validated['AE_T4'] ,
            'CP_recoit_t4' =>$validated['CP_T4'],

            'situation_modif' => $validated['status'],
            'type_modif' => $validated['type'],
            'id_art' => $validated['ref'],
            'num_sous_prog'=> $validated['sousprogbum_click'],
            'num_prog'=>$validated['prognum_click'],

            'num_sous_prog_retire'=> $validated['Sous_prog_retire'],
            'num_prog_retire'=> $validated['prog_retirer'],
            'num_sous_action'=> $validated['act_cible_env'],
            'num_sous_action_retire'=> $validated['act_cible_ret'],


            'code_t1' => $codeT1,
            'code_t2' => $codeT2,
            'code_t3' => $codeT3,
            'code_t4' => $codeT4,


              ]);
            
           //dd( $modif);


    return response()->json(['message' => 'Modifications insérées avec succès'], 200);
}
function affiche_modif($numport)
{
    $port=$numport;
    $moficat_program=[];
    $allaction=[];
    $all_act=[];
    $allsous_prog=[];
    $programmes=[];
    $ttall=[];
    $TtAE1=0;
    $TtCP1=0;
    $TtAE2=0;
    $TtCP2=0;
    $TtAE3=0;
    $TtCP3=0;
    $TtAE4=0;
    $TtCP4=0;
    $TtportT1AE=0;
    $TtportT1CP=0;
    $TtportT2AE=0;
    $TtportT2CP=0;
    $TtportT3AE=0;
    $TtportT3CP=0;
    $TtportT4AE=0;
    $TtportT4CP=0;
    $Ttportglob=[];
    $progms=Programme::where("num_portefeuil",$numport)->get();
    foreach($progms as $progm)
    {
        $sousprog=SousProgramme::where('num_prog',$progm->num_prog)->get();
        foreach($sousprog as $sprog)
        {


                $act=Action::where('num_sous_prog',$sprog->num_sous_prog)->get();
            //    dd($act);
                foreach($act as $listact)
                {
                    if(isset($listact))
                    {
                        $sous_act=SousAction::where('num_action',$listact->num_action)->get();
                      //  dd($sous_act);
                        foreach($sous_act as $listsousact)
                        {

                            if(isset($listsousact))
                            {

                                $resultats = $this->CalculDpia->calculdpiaFromPath($numport, $progm->num_prog, $sprog->num_sous_prog, $listact->num_action,$listsousact->num_sous_action);

                                array_push($allaction,['actions'=>['code'=>$listsousact->num_sous_action,"nom"=>$listsousact->nom_sous_action,'TotalT'=>$resultats]]);
                                $all_act= $allaction;

                            }

                        }
                    }


                }

               // dd($allaction);
                for($i=0 ;$i<count($allaction);$i++)
                {
                foreach($allaction[$i] as $actsect)
                {
                    $TtAE1+=$actsect['TotalT']['T1']['total'][0]['values']['totalAE'];
                    $TtCP1+=$actsect['TotalT']['T1']['total'][0]['values']['totalCP'];

                    $TtAE2+=$actsect['TotalT']['T2']['total'][0]['values']['totalAE'];
                    $TtCP2+=$actsect['TotalT']['T2']['total'][0]['values']['totalCP'];

                    $TtAE3+=$actsect['TotalT']['T3']['total'][0]['values']['totalAE'];
                    $TtCP3+=$actsect['TotalT']['T3']['total'][0]['values']['totalCP'];

                    $TtAE4+=$actsect['TotalT']['T4']['total'][0]['values']['totalAE'];
                    $TtCP4+=$actsect['TotalT']['T4']['total'][0]['values']['totalCP'];

                };

                };

                $ttall=['TotalT1_AE'=>$TtAE1,'TotalT1_CP'=>$TtCP1,
                    'TotalT2_AE'=>$TtAE2,'TotalT2_CP'=>$TtCP2,
                    'TotalT3_AE'=>$TtAE3,'TotalT3_CP'=>$TtCP3,
                    'TotalT4_AE'=>$TtAE4,'TotalT4_CP'=>$TtCP4,
                ];

                array_push($allsous_prog,['sous_programmes'=>['code'=>$sprog->num_sous_prog,"nom"=>$sprog->nom_sous_prog,'actions'=>$all_act,"Total"=>$ttall]]);
                $all_sous_prog= $allsous_prog;
                $TtAE1=0;
                $TtCP1=0;
                $TtAE2=0;
                $TtCP2=0;
                $TtAE3=0;
                $TtCP3=0;
                $TtAE4=0;
                $TtCP4=0;
                $ttall=[];
                $allaction=[];
                $all_act=[];



            }
            for ($i=0; $i < count($allsous_prog) ; $i++)
            {
            foreach($allsous_prog[$i] as $sousprog)
             {
                # code...
                $TtAE1+=$sousprog['Total']['TotalT1_AE'];
                $TtCP1+=$sousprog['Total']['TotalT1_CP'];

                $TtAE2+=$sousprog['Total']['TotalT2_AE'];
                $TtCP2+=$sousprog['Total']['TotalT2_CP'];

                $TtAE3+=$sousprog['Total']['TotalT3_AE'];
                $TtCP3+=$sousprog['Total']['TotalT3_CP'];

                $TtAE4+=$sousprog['Total']['TotalT4_AE'];
                $TtCP4+=$sousprog['Total']['TotalT4_CP'];
            }
        }
            $ttall=['TotalT1_AE'=>$TtAE1,'TotalT1_CP'=>$TtCP1,
            'TotalT2_AE'=>$TtAE2,'TotalT2_CP'=>$TtCP2,
            'TotalT3_AE'=>$TtAE3,'TotalT3_CP'=>$TtCP3,
            'TotalT4_AE'=>$TtAE4,'TotalT4_CP'=>$TtCP4,
        ];
            array_push($programmes,['programmes'=>['code'=>$progm->num_prog,"nom"=>$progm->nom_prog,"sous_programmes"=>$all_sous_prog,"Total"=>$ttall]]);
            $TtAE1=0;
            $TtCP1=0;
            $TtAE2=0;
            $TtCP2=0;
            $TtAE3=0;
            $TtCP3=0;
            $TtAE4=0;
            $TtCP4=0;
            $allsous_prog=[];
        }
             // dd($programmes);
             
             for ($i=0; $i < count($programmes) ; $i++)
             {
        foreach($programmes[$i] as $prog)
        {
            $TtportT1AE+=$prog['Total']['TotalT1_AE'];
            $TtportT1CP+=$prog['Total']['TotalT1_CP'];
            $TtportT2AE+=$prog['Total']['TotalT2_AE'];
            $TtportT2CP+=$prog['Total']['TotalT2_CP'];
            $TtportT3AE+=$prog['Total']['TotalT3_AE'];
            $TtportT3CP+=$prog['Total']['TotalT3_CP'];
            $TtportT4AE+=$prog['Total']['TotalT4_AE'];
            $TtportT4CP+=$prog['Total']['TotalT4_CP'];
            $modiflist=ModificationT::where('num_prog_retire',$prog['code'])->join('articles','modification_t_s.id_art','=','articles.id_art')->get();
          //  dd($prog['code']);
          ///  dd( $modiflist);
            array_push($moficat_program,['reslut'=>$modiflist,'code_prog'=>$prog['code'],'nom_prog'=>$prog['nom']]);
        };
    };
        array_push($Ttportglob,['TotalPortT1_AE'=>$TtportT1AE,'TotalPortT1_CP'=>$TtportT1CP,
                                'TotalPortT2_AE'=>$TtportT2AE,'TotalPortT2_CP'=>$TtportT2CP,
                                'TotalPortT3_AE'=>$TtportT3AE,'TotalPortT3_CP'=>$TtportT3CP,
                                'TotalPortT4_AE'=>$TtportT4AE,'TotalPortT4_CP'=>$TtportT4CP]);
      // dd($moficat_program);
        if(count($programmes)>0)
        {
        /*return response()->json([
            'exists' => true,
            'actions'=>$allaction,
            'sous_programs'=>$allsous_prog,
            'programs'=>$all_prog,
        ]);*/
           
            /***
             *  Modif table
             * 
            */
            
            //dd($moficat_program);



        return view('suivi-port.suivi-port', compact('programmes','Ttportglob','moficat_program','port'));
         
       /* $pdf=SnappyPdf::loadView('impression.impression_dpicprgsousprog', compact('programmes','Ttportglob'))
         ->setPaper("A4","landscape")->setOption('dpi', 300) ->setOption('zoom', 1.5);//lanscape mean orentation
               return $pdf->stream('impression_dpic.pdf');
       //return view('impression.programmes',compact('programmes','Ttportglob'));*/
        }
        else
        {
            response()->json(['exists' => false]);
        }

}


function delete_by_id($id)
{
    $succe_pr_gr=false;
    $split=explode("_",$id);
    $gropos=null;
    //dd($split);
    if($split[0] == 'prog')
    {
        $deletmodel=Programme::find($split[1]);
        if($deletmodel)
        {
            $deletmodel->delete();
        return response()->json(['code'=>200,'message '=>'success']);
        }
        return response()->json(['code'=>404,'message '=>'unsuccess']);

    }
    if($split[0] == 'sousprog')
    {
       // dd($split[0],$split[1]);
        $deletmodel=SousProgramme::find($split[1]);
        $deletmulti=multimedia::where('related_id','=',$split[1])->get();
        $init_sous= initPort::where('num_sous_prog', $split[1])
        ->whereNull('num_action')
        ->first();
        //dd($deletmodel);
        if($deletmodel)
        {
            
            if(isset($deletmulti))
            {
                
                foreach ($deletmulti as $media)
                {
                    $media->delete();
                }
            
            }
            if(isset($init_sous))
            {
                $init_sous->delete();
            }
            DB::delete('DELETE FROM sous_programmes WHERE num_sous_prog = ?',[ $split[1]]);
            return response()->json(['code'=>200,'message '=>'success']);
           
        }
        return response()->json(['code'=>404,'message '=>'unsuccess']);
    }
    if($split[0] == 'act')
    {
        $deletmodel=SousAction::find($split[1].'-01');
        $deletmodelA=Action::find($split[1]);
        //dd($deletmodel['num_sous_action'],$deletmodelA['num_action']);
        if($deletmodel && $deletmodelA)
        {
            //$ops_delete=
            $gropos=GroupOperation::where('num_sous_action','=',$deletmodel['num_sous_action'])->get();
            //dd($gropos);
            if($gropos)
            {
                foreach($gropos as $grpop )
                {
                    $ops=Operation::where('code_grp_operation','=',$grpop['code_grp_operation'])->get();
                    if($ops)
                        {
                           //dd($ops);
                            foreach($ops as $op)
                            {
                                //dd($op);
                                $sou_ops=SousOperation::where('code_operation','=',$op['code_operation'])->get();
                                if($sou_ops)
                                {
                                    //dd($sou_ops);
                                    foreach($sou_ops as $sous_op)
                                    {
                                        $construit_p=ConstruireDPIA::find($sous_op->code_sous_operation);
                                        if($construit_p)
                                        {
                                            $construit_p->delete();
                                        }
                                        $sous_op->delete();
                                    }
                                   
                                }
                                $op->delete(); 
                            }
                        }
                        if($succe_pr_gr)
                        {
                            
                           
                        }
                }
               
               // dd($gropos);
                $grpop->delete();
            }
            $deletmodel->delete();
            $deletmodelA->delete();
            
        return response()->json(['code'=>200,'message '=>'success']);
        }
        return response()->json(['code'=>404,'message '=>'unsuccess']);
    }
    return response()->json(['code'=>404,'message '=>'unsuccess']);
}

function delete_by_t(Request $request)
{
    $code_t='';
    $code=0;
    $succe_pr_gr=false;
    $t=$request['T'];
    $id_act=$request['Act'];
    $gropos=GroupOperation::where('num_sous_action','=',$id_act)->get();
    
    if($t == "T4")
    {
        $code_t='code_t4';
        $code=40000;
    }
    if($t == "T3")
    {
        $code_t='code_t3';
        $code=30000;
    }
    if($t == "T2")
    {
        $code_t='code_t2';
        $code=20000;
    }
    if($t == "T1")
    {
        $code_t='code_t1';
        $code=10000;
    }
    //dd($code_t, $t,$code);
    if($gropos)
    {
        foreach($gropos as $grpop )
        {
            $ops=Operation::where('code_grp_operation','=',$grpop['code_grp_operation'])->get();
           
            if($ops)
                {
                    foreach($ops as $op)
                    {
                       // dd($ops);
                        $sou_ops=SousOperation::where('code_operation','=',$op['code_operation'])->where($code_t,'=',$code)->get();
                        if(!empty($sou_ops) && count($sou_ops) !=0)
                        { 
                           // dd($sou_ops);
                            foreach($sou_ops as $sous_op)
                            {
                                if(!empty($sous_op)){
                                $construit_p=ConstruireDPIA::find($sous_op->code_sous_operation);
                               // dd($construit_p);
                                if($construit_p)
                                {
                                    $construit_p->delete(); 
                                }
                                $sous_op->delete();}
                            }
                            $op->delete();  
                        }
                        else
                        {
                            $succe_pr_gr=false;
                        }
                       
                    }
                   
                }
                if($succe_pr_gr)
                {
                    $grpop->delete();
                }
            
        }
return response()->json(['message'=>'suppimer avec success','code'=>200]);
}
}
}
