<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>LISTE DES OPERATIONS D'INVESTISSEMENT PUBLIC</title>
    <style>
      
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: white;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .table-diviser {
        margin: 20px 0; /* la distance entre les 2 tables */
       
    }

    .first-table {
            width: 50%; 
            margin-bottom: 20px; 
            margin: 0 auto;
        }

    </style>
</head>
<body>

<h1>LISTE DES OPERATIONS D'INVESTISSEMENT PUBLIC:</h1>


<table class="first-table">
    <thead>
                @php
                    // extraire la dernière partie du code 
                    $code_prog = explode('-', $prog->num_prog);
                    $codeprg = end($code_prog);
                @endphp
        <tr>
            <th>PROGRAMME {{ $prog->nom_prog }}</th>
            <th>Code</th>
            <td>{{ $codeprg }}</th>
            <th colspan="2">T3 DANS LE DPIC</th>
        </tr>


        <tr>
                @php
                    // extraire la dernière partie du code 
                    $code_sousprog = explode('-', $sousProgramme->num_sous_prog);
                    $codesousprg = end($code_sousprog);
                @endphp
            <th>Sous-programme {{ $sousProgramme->nom_sous_prog }}</th>
            <th>Code</th>
            <td>{{ $codesousprg}}</th>
            <th>AE </th>
            <th>CP </th>
        </tr>

        <tr>
                @php
                    // extraire la dernière partie du code 
                    $code_action = explode('-', $action->num_action );
                    $codeact = end($code_action);
                @endphp
            <th>Action {{ $action->nom_action }}</th>
            <th>Code</th>
            <td>{{ $codeact }}</th>
            <td>{{ $resultstructur['T3']['total'][0]['values']['totalAE'] ?? 'N/A' }}</td>
            <td>{{ $resultstructur['T3']['total'][0]['values']['totalCP'] ?? 'N/A' }}</td>
        </tr>
    </thead>
    <tbody>
       
    </tbody>
</table>

<div class="table-diviser"></div> 
<table>
        <thead>
            <tr>
                <th rowspan="3">Code</th>
                <th rowspan="3"> T3. DEPENSES D'INVESTISSEMENT </th>

                <th rowspan="3"> N° DE DECISION D'INSCRIPTION</th>
                <th rowspan="3">INTITULE DE L'OPERATION D'INVESTISSEMENT PUBLIC (PROJET)</th>
                <th colspan="6">ANNEE EN COURS (N)</th>
            </tr>
            <tr>
         
                <th colspan="3">AE </th>
                <th colspan="3">CP </th>
            </tr>


            <tr>
            <th>AE REPORTEE  </th>
            <th>AE NOTIFIEE </th>
            <th>AE ENGAGEE AU </th>

            <th>CP REPORTES </th>
            <th>CP NOTIFIES </th>
            <th>CP CONSOMMES Au </th>
            </tr>

        </thead>
        <tbody>
      
                @foreach ($resultstructur['T3']['groupedData'] as $groupData)
                @php
                    // extraire la dernière partie du code grp
                    $code_grpsepar = explode('-', $groupData['group']['code']);
                    $codegrp = end($code_grpsepar);

                 $i=0;
                @endphp
            <tr class="group-row">
                <td class="code">{{$codegrp}}</td>
                <td colspan="3">{{$namesT3[$codegrp] }}</td>
                <!--td>{{$namesT3[$codegrp ] ?? Néant}}</td> 

                <td>{{$namesT3[$codegrp ]  ?? Néant }}</td--> 

                <td>{{ $groupData['group']['values']['ae_reportegrpop'] ?? 'N/A' }}</td>
                <td>{{ $groupData['group']['values']['ae_notifiegrpop'] ?? 'N/A' }}</td>
                <td>{{ $groupData['group']['values']['ae_engagegrpop'] ?? 'N/A' }}</td>
              
                <td>{{ $groupData['group']['values']['cp_reportegrpop'] ?? 'N/A' }}</td>
                <td>{{ $groupData['group']['values']['cp_notifiegrpop'] ?? 'N/A' }}</td>
                <td>{{ $groupData['group']['values']['cp_consomegrpop'] ?? 'N/A' }}</td>
               
            </tr>

                 @foreach ($groupData['operations'] as $operationData)
                @php
                    // extraire la dernière partie du code de l'op
                    $code_grpsepar = explode('-', $operationData['operation']['code']);
                     $codeop = end( $code_grpsepar);
                     //dd($operationData);

                     $nom_sepa=explode('-', $namesT3[$codeop ]);
                      $nom=end($nom_sepa);

                    $nom_separ=explode('-', $namesT3[$codeop ]);
                    $nomfirst=reset($nom_separ);

                    // compter le nbr total d'op dans le groupe
                        //$totalOperations = count($operationData['sousOperations']);
                        $totalOperations = count($groupData['operations']);
                      //  dd($totalOperations);
                     @endphp
                @if (count($operationData['sousOperations']) > 0)
                   <tr class="operation-row with-sousop">
                       
                   <td  class="code"></td>
                      <!--td class="code">{{ $codeop }}</td-->
                   <td >{{$namesT3[$codegrp]}}</td>

                   <td >{{$nomfirst ?? Néant}}</td> 

                   <td >{{$nom  ?? Néant }}</td> 

                <td>{{ $operationData['operation']['values']['ae_reporteop'] ?? 'N/A' }}</td>
                <td>{{ $operationData['operation']['values']['ae_notifieop'] ?? 'N/A' }}</td>
                <td>{{ $operationData['operation']['values']['ae_engageop'] ?? 'N/A' }}</td>

                <td>{{ $operationData['operation']['values']['cp_reporteop'] ?? 'N/A' }}</td>
                <td>{{ $operationData['operation']['values']['cp_notifieop'] ?? 'N/A' }}</td>
                <td>{{ $operationData['operation']['values']['cp_consomeop'] ?? 'N/A' }}</td>
           </tr>
              
               @else
                   <tr class="operation-row">
                   <!--td class="code">{{ $codeop }}</td-->
                  
                  
                   @if( $i == 0)
                   <td rowspan={{$totalOperations}} class="code" id="{{'eir'.$i}}"></td>
                   <td rowspan={{$totalOperations}} id="{{'eir'.$i}}">{{$namesT3[$codegrp]}}</td>
                   @php
                   $i++;
                   @endphp
                   @endif
                   <td >{{$nomfirst ?? Néant}}</td> 

                   <td >{{$nom ?? Néant }}</td> 


                    <td>{{ $operationData['operation']['values']['ae_reporteop'] ?? 'N/A' }}</td>
                    <td>{{ $operationData['operation']['values']['ae_notifieop'] ?? 'N/A' }}</td>
                    <td>{{ $operationData['operation']['values']['ae_engageop'] ?? 'N/A' }}</td>

                    <td>{{ $operationData['operation']['values']['cp_reporteop'] ?? 'N/A' }}</td>
                    <td>{{ $operationData['operation']['values']['cp_notifieop'] ?? 'N/A' }}</td>
                    <td>{{ $operationData['operation']['values']['cp_consomeop'] ?? 'N/A' }}</td>
            </tr>
              
                @endif
              
              

                @foreach ($operationData['sousOperations'] as $sousOp)
            @php
                    // extraire la dernière partie du code de la sous-opération
                    $code_separer = explode('-', $sousOp['code']);
                    $codeextr = end($code_separer);

                    $nom_sepa=explode('-', $namesT3[$codeop ]);
                      $nom=end($nom_sepa);

                    $nom_separ=explode('-', $namesT3[$codeop ]);
                    $nomfirst=reset($nom_separ);
                @endphp
                <tr>
                    <td class="code">{{ $codeextr }}</td>

                    <td>{{$namesT3[$codegrp]}}</td>

                    <td>{{$nomfirst ?? Néant}}</td> 

                    <td>{{$nom ?? Néant}}</td> 

                    <td>{{ $sousOp['values']['ae_reportesousop'] ?? 'N/A' }}</td>
                    <td>{{ $sousOp['values']['ae_notifiesousop'] ?? 'N/A' }}</td>
                    <td>{{ $sousOp['values']['ae_engagesousop'] ?? 'N/A' }}</td>

                    <td>{{ $sousOp['values']['cp_reportesousuop'] ?? 'N/A' }}</td>
                    <td>{{ $sousOp['values']['cp_notifiesousop'] ?? 'N/A' }}</td>
                    <td>{{ $sousOp['values']['cp_consomesousop'] ?? 'N/A' }}</td>
                </tr>
            @endforeach
        @endforeach
        @endforeach


        {{-- this part for no rowspan --}}



    </tbody>
    <tfoot>
        <tr  class="total">
            <td colspan="4" style="text-align: center; font-weight: bold;">TOTAL DES CREDITS </td>
            <td>{{ $resultstructur['T3']['total'][0]['values']['totalAEreportevertical'] ?? 'N/A' }}</td>
            <td>{{ $resultstructur['T3']['total'][0]['values']['totalAEnotifievertical'] ?? 'N/A' }}</td>
            <td>{{ $resultstructur['T3']['total'][0]['values']['totalAEengagevertical'] ?? 'N/A' }}</td>

            <td>{{ $resultstructur['T3']['total'][0]['values']['totalCPreportevertical'] ?? 'N/A' }}</td>
            <td>{{ $resultstructur['T3']['total'][0]['values']['totalCPnotifievertical'] ?? 'N/A' }}</td>
            <td>{{ $resultstructur['T3']['total'][0]['values']['totalCPconsomevertical'] ?? 'N/A' }}</td>

      
        </tr>

        
    </tfoot>
    </table>
</body>
</html>
