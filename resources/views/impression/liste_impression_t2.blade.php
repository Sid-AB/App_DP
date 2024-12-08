<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>LES CREDITS DES DEPENSES DE FONCTIONNEMENT</title>
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
    .first-table thead
    {
          
    }
    .t2
    {
        background-color:#DDD9C4;
    }
    </style>
</head>
<body>

<h1>LES CREDITS DES DEPENSES DE FONCTIONNEMENT :</h1>

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
            <th colspan="2">T2 DANS LE DPIC</th>
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
            <td>{{ $resultstructur['T2']['total'][0]['values']['totalAE'] ?? 'N/A' }}</td>
            <td>{{ $resultstructur['T2']['total'][0]['values']['totalCP'] ?? 'N/A' }}</td>
        </tr>
    </thead>
    <tbody>
       
    </tbody>
</table>

<div class="table-diviser"></div> 
<table>
        <thead>
            <tr>
                <th rowspan="2" class="t2">Code</th>
                <th rowspan="2" class="t2" style="width: 900px;">T2. DEPENSES DE FONCTIONNEMENT DES SERVICES </th>

                <th colspan="2" class="t2">CREDITS OUVERTS</th>
                <th colspan="2" class="t2">CREDITS ATTENDUS DEVENUS DISPONIBLES</th>
                <th colspan="2" class="t2">TOTAL CREDITS DISPONIBLESS</th>
            </tr>
            <tr>
         
            <th>AE </th>
            <th>CP </th>

            <th>AE </th>
            <th>CP </th>

            <th>AE </th>
            <th>CP </th>
            </tr>
        </thead>
        <tbody>
      
                @foreach ($resultstructur['T2']['groupedData'] as $groupData)
                @php
                    // extraire la dernière partie du code grp
                    $code_grpsepar = explode('-', $groupData['group']['code']);
                    $codegrp = end($code_grpsepar);
                @endphp
                <tr class="group-row">
                <td class="code">{{$codegrp}}</td>
                <td>{{ $namesT2[$codegrp ] ?? 'Nom non trouvé' }}</td>

                <td>{{ $groupData['group']['values']['ae_ouvertgrpop'] ?? 'N/A' }}</td>
                <td>{{ $groupData['group']['values']['cp_ouvertgrpop'] ?? 'N/A' }}</td>

                <td>{{ $groupData['group']['values']['ae_attendugrpop'] ?? 'N/A' }}</td>
                <td>{{ $groupData['group']['values']['cp_attendugrpop'] ?? 'N/A' }}</td>

                <td>{{ $groupData['group']['values']['totalAEgrpop'] ?? 'N/A' }}</td>
                <td>{{ $groupData['group']['values']['totalCPgrpop'] ?? 'N/A' }}</td>
            </tr>

                 @foreach ($groupData['operations'] as $operationData)
                @php
                    // extraire la dernière partie du code de l'op
                    $code_grpsepar = explode('-', $operationData['operation']['code']);
                     $codeop = end( $code_grpsepar);
                     //dd($operationData);
                     @endphp
                @if (count($operationData['sousOperations']) > 0)
                   <tr class="operation-row with-sousop">
                   <td class="code">{{ $codeop }}</td>
                <td>{{ $namesT2[$codeop] ?? 'Nom non trouvé' }}</td>

                <td>{{ $operationData['operation']['values']['ae_ouvertop'] ?? 'N/A' }}</td>
                <td>{{ $operationData['operation']['values']['cp_ouvertop'] ?? 'N/A' }}</td>

                <td>{{ $operationData['operation']['values']['ae_attenduop'] ?? 'N/A' }}</td>
                <td>{{ $operationData['operation']['values']['cp_attenduop'] ?? 'N/A' }}</td>

                <td>{{ $operationData['operation']['values']['totalAEop'] ?? 'N/A' }}</td>
                <td>{{ $operationData['operation']['values']['totalCPop'] ?? 'N/A' }}</td>
              
               @else
                   <tr class="operation-row">
                   <td class="code">{{ $codeop }}</td>
                <td>{{ $namesT2[$codeop] ?? 'Nom non trouvé' }}</td>

                <td>{{ $operationData['operation']['values']['ae_ouvertop'] ?? 'N/A' }}</td>
                <td>{{ $operationData['operation']['values']['cp_ouvertop'] ?? 'N/A' }}</td>

                <td>{{ $operationData['operation']['values']['ae_attenduop'] ?? 'N/A' }}</td>
                <td>{{ $operationData['operation']['values']['cp_attenduop'] ?? 'N/A' }}</td>

                <td>{{ $operationData['operation']['values']['totalAEop'] ?? 'N/A' }}</td>
                <td>{{ $operationData['operation']['values']['totalCPop'] ?? 'N/A' }}</td>
              
                @endif
              
              

                @foreach ($operationData['sousOperations'] as $sousOp)
            @php
                    // extraire la dernière partie du code de la sous-opération
                    $code_separer = explode('-', $sousOp['code']);
                    $codeextr = end($code_separer);
                @endphp
                <tr>
                    <td class="code">{{ $codeextr }}</td>
                    <td>{{ $namesT2[$codeextr]?? 'Nom non trouvé' }}</td>

                    <td>{{ $sousOp['values']['ae_ouvertsousop'] ?? 'N/A' }}</td>
                    <td>{{ $sousOp['values']['cp_ouvertsousop'] ?? 'N/A' }}</td>

                    <td>{{ $sousOp['values']['ae_attendusousop'] ?? 'N/A' }}</td>
                    <td>{{ $sousOp['values']['cp_attendsousuop'] ?? 'N/A' }}</td>

                    <td>{{ $sousOp['values']['totalAEsousop'] ?? 'N/A' }}</td>
                    <td>{{ $sousOp['values']['totalCPsousop'] ?? 'N/A' }}</td>
                </tr>
            @endforeach
        @endforeach
        @endforeach
    </tbody>
    <tfoot>
        <tr  class="total">
            <td colspan="2" style="text-align: center; font-weight: bold;">TOTAL DES CREDITS </td>
            <td>{{ $resultstructur['T2']['total'][0]['values']['totalAEouvrtvertical'] ?? 'N/A' }}</td>
            <td>{{ $resultstructur['T2']['total'][0]['values']['totalCPouvrtvertical'] ?? 'N/A' }}</td>

            <td>{{ $resultstructur['T2']['total'][0]['values']['totalAEattenduvertical'] ?? 'N/A' }}</td>
            <td>{{ $resultstructur['T2']['total'][0]['values']['totalCPattenduvertical'] ?? 'N/A' }}</td>

            <td>{{ $resultstructur['T2']['total'][0]['values']['totalAE'] ?? 'N/A' }}</td>
            <td>{{ $resultstructur['T2']['total'][0]['values']['totalCP'] ?? 'N/A' }}</td>
        </tr>

        <tr  class="CONTRÔLE DE COHERENCE">
            <td colspan="2" style="text-align: center; font-weight: bold;">CONTRÔLE DE COHERENCE </td>
            <td>{{ $sousOp['values']['ae_ouvertsousop_NONREPARTIS'] ?? 'N/A' }}</td>
            <td>{{ $sousOp['values']['ae_attendusousop_NONREPARTIS'] ?? 'N/A' }}</td>

            <td>{{ $sousOp['values']['cp_ouvertsousop_NONREPARTIS'] ?? 'N/A' }}</td>
            <td>{{ $sousOp['values']['cp_attendsousuop_NONREPARTIS'] ?? 'N/A' }}</td>

            <td>{{ $sousOp['values']['totalAEsousop_NONREPARTIS'] ?? 'N/A' }}</td>
            <td>{{ $sousOp['values']['totalCPsousop_NONREPARTIS'] ?? 'N/A' }}</td>
        </tr>

    </tfoot>
    </table>
</body>
</html>
