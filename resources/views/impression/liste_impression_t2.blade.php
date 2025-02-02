<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LES CREDITS DES DEPENSES DE FONCTIONNEMENT</title>
    <style>
        .table_handler
        {
            width: 100%;
        }
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
        margin: 10px 0; /* la distance entre les 2 tables */
       
    }

    .first-table {
            width: 50%; 
            margin-bottom:20px; 
            margin: 0 auto;
           

        }
    .first-table thead
    {
          
    }
    .t2
    {
        background-color:#DDD9C4;
    }
    .headt2{
        background-color:#DCE6F1;
    }

    .total2{
        background-color:#76933C;
        color:white;
        font-size:20px;
    }
    .controle{
        background-color:#76933C;
        color:white;
        font-size:20px;
    }
    td {
    font-size: 18px;
}
    </style>
</head>
<body>

<!--h1>LES CREDITS DES DEPENSES DE FONCTIONNEMENT :</h1-->

<table class="first-table">
    <thead>
                @php
                    // extraire la dernière partie du code 
                    $code_prog = explode('-', $prog->num_prog);
                    $codeprg = end($code_prog);
                @endphp
        <tr>
            <th style="text-align:center; ">PROGRAMME {{ $prog->nom_prog }}</th>
            <th style="text-align:center; ">Code</th>
            <td style="text-align:center; ">{{ $codeprg }}</th>
            <th colspan="2" class ="headt2" style="text-align:center; ">T2 DANS LE DPIC</th>
        </tr>


        <tr>
                @php
                    // extraire la dernière partie du code 
                    $code_sousprog = explode('-', $sousProgramme->num_sous_prog);
                    $codesousprg = end($code_sousprog);
                @endphp
            <th style="text-align:center; ">Sous-programme {{ $sousProgramme->nom_sous_prog }}</th>
            <th style="text-align:center; ">Code</th>
            <td style="text-align:center; ">{{ $codesousprg}}</th>
            <th class="headt2" style="text-align:center; ">AE </th>
            <th class="headt2" style="text-align:center; ">CP </th>
        </tr>

        <tr>
                @php
                    // extraire la dernière partie du code 
                    $code_action = explode('-', $action->num_action );
                    $codeact = end($code_action);
                @endphp
            <th style="text-align: center; ">Action {{ $action->nom_action }}</th>
            <th style="text-align: center; ">Code</th>
            <td style="text-align: center; ">{{ $codeact }}</th>
            <td style="text-align: center; "> {{ number_format((float)$resultstructur['T2']['total'][0]['values']['totalAE'], 2, '.', ',') ?? 'N/A' }}</td>
            <td style="text-align: center; ">{{ number_format((float)$resultstructur['T2']['total'][0]['values']['totalCP'], 2, '.', ',') ?? 'N/A' }}</td>
        </tr>
    </thead>
  
       
    
</table>

<div class="table-diviser"></div> 
<div class="table_handler">
<table>
      
            <tr>
                <th rowspan="2" class="t2" style="text-align: center; ">Code</th>
                <th rowspan="2" class="t2" style="text-align: center; " >T2. DEPENSES DE FONCTIONNEMENT DES SERVICES </th>

                <th colspan="2" class="t2" style="text-align: center; ">CREDITS OUVERTS</th>
                <th colspan="2" class="t2" style="text-align: center; ">CREDITS ATTENDUS DEVENUS DISPONIBLES</th>
                <th colspan="2" class="t2" style="text-align: center; ">TOTAL CREDITS DISPONIBLES</th>
            </tr>
            <tr>
         
            <th style="text-align: center; ">AE </th>
            <th style="text-align: center; "> CP </th>

            <th style="text-align: center; ">AE </th>
            <th style="text-align: center; ">CP </th>

            <th style="text-align: center; ">AE </th>
            <th style="text-align: center; ">CP </th>
            </tr>
      
        <tbody>
        @if(!empty($resultstructur['T2']['groupedData']))
                @foreach ($resultstructur['T2']['groupedData'] as $groupData)
                @php
                    // extraire la dernière partie du code grp
                    $code_grpsepar = explode('-', $groupData['group']['code']);
                    $codegrp = end($code_grpsepar);
                @endphp
                <tr class="group-row2">
                <td class="code2" style="text-align: center; ">{{$codegrp}}</td>
                <td style=" font-weight: bold; ">{{ $namesT2[$codegrp ] ?? 'Nom non trouvé' }}</td>

                <td style="text-align: center; ">{{ number_format((float)$groupData['group']['values']['ae_ouvertgrpop'], 2, '.', ',') ?? 'N/A' }}</td>
                <td style="text-align: center; ">{{ number_format((float)$groupData['group']['values']['cp_ouvertgrpop'], 2, '.', ',') ?? 'N/A' }}</td>

                <td style="text-align: center; ">{{ number_format((float)$groupData['group']['values']['ae_attendugrpop'], 2, '.', ',') ?? 'N/A' }}</td>
                <td style="text-align: center; ">{{ number_format((float)$groupData['group']['values']['cp_attendugrpop'], 2, '.', ',') ?? 'N/A' }}</td>

                <td style="text-align: center; ">{{ number_format((float)$groupData['group']['values']['totalAEgrpop'], 2, '.', ',') ?? 'N/A' }}</td>
                <td style="text-align: center; ">{{ number_format((float)$groupData['group']['values']['totalCPgrpop'], 2, '.', ',') ?? 'N/A' }}</td>
            </tr>

                 @foreach ($groupData['operations'] as $operationData)
                @php
                    // extraire la dernière partie du code de l'op
                    $code_grpsepar = explode('-', $operationData['operation']['code']);
                     $codeop = end( $code_grpsepar);
                     //dd($operationData);
                     @endphp
                @if (count($operationData['sousOperations']) > 0)
                   <tr class="operation-row with-sousop2">
                   <td class="code2" style="text-align: center; ">{{ $codeop }}</td>
                <td>{{ $namesT2[$codeop] ?? 'Nom non trouvé' }}</td>

                <td style="text-align: center; ">{{ number_format((float)$operationData['operation']['values']['ae_ouvertop'], 2, '.', ',') ?? 'N/A' }}</td>
                <td style="text-align: center; ">{{ number_format((float)$operationData['operation']['values']['cp_ouvertop'], 2, '.', ',') ?? 'N/A' }}</td>

                <td style="text-align: center; ">{{ number_format((float)$operationData['operation']['values']['ae_attenduop'], 2, '.', ',') ?? 'N/A' }}</td>
                <td style="text-align: center; ">{{ number_format((float)$operationData['operation']['values']['cp_attenduop'], 2, '.', ',') ?? 'N/A' }}</td>

                <td style="text-align: center; ">{{ number_format((float)$operationData['operation']['values']['totalAEop'], 2, '.', ',') ?? 'N/A' }}</td>
                <td style="text-align: center; ">{{ number_format((float)$operationData['operation']['values']['totalCPop'], 2, '.', ',') ?? 'N/A' }}</td>
              
               @else
                   <tr class="operation-row2">
                   <td class="code2" style="text-align: center; ">{{ $codeop }}</td>
                <td>{{ $namesT2[$codeop] ?? 'Nom non trouvé' }}</td>

                <td style="text-align: center; ">{{ number_format((float)$operationData['operation']['values']['ae_ouvertop'], 2, '.', ',') ?? 'N/A' }}</td>
                <td style="text-align: center; ">{{ number_format((float)$operationData['operation']['values']['cp_ouvertop'], 2, '.', ',') ?? 'N/A' }}</td>

                <td style="text-align: center; ">{{ number_format((float)$operationData['operation']['values']['ae_attenduop'], 2, '.', ',') ?? 'N/A' }}</td>
                <td style="text-align: center; ">{{ number_format((float)$operationData['operation']['values']['cp_attenduop'], 2, '.', ',') ?? 'N/A' }}</td>

                <td style="text-align: center; ">{{ number_format((float)$operationData['operation']['values']['totalAEop'], 2, '.', ',') ?? 'N/A' }}</td>
                <td style="text-align: center; ">{{ number_format((float)$operationData['operation']['values']['totalCPop'], 2, '.', ',') ?? 'N/A' }}</td>
              
                @endif
              
              

                @foreach ($operationData['sousOperations'] as $sousOp)
            @php
                    // extraire la dernière partie du code de la sous-opération
                    $code_separer = explode('-', $sousOp['code']);
                    $codeextr = end($code_separer);
                    // Extraire la dernière partie du code de l'opération
                    $code_op_separer = explode('-', $operationData['operation']['code']);
                    $codeop = end($code_op_separer);
                @endphp
                @if ($codeextr !== $codeop)
                <tr>
                    <td class="code2" style="text-align: center; ">{{ $codeextr }}</td>
                    <td>{{ $namesT2[$codeextr]?? 'Nom non trouvé' }}</td>

                    <td style="text-align: center; ">{{ number_format((float)$sousOp['values']['ae_ouvertsousop'], 2, '.', ',') ?? 'N/A' }}</td>
                    <td style="text-align: center; ">{{ number_format((float)$sousOp['values']['cp_ouvertsousop'], 2, '.', ',') ?? 'N/A' }}</td>

                    <td style="text-align: center; ">{{ number_format((float)$sousOp['values']['ae_attendusousop'], 2, '.', ',') ?? 'N/A' }}</td>
                    <td style="text-align: center; ">{{ number_format((float)$sousOp['values']['cp_attendsousuop'], 2, '.', ',') ?? 'N/A' }}</td>

                    <td style="text-align: center; "> {{ number_format((float)$sousOp['values']['totalAEsousop'], 2, '.', ',') ?? 'N/A' }}</td>
                    <td style="text-align: center; ">{{ number_format((float)$sousOp['values']['totalCPsousop'], 2, '.', ',') ?? 'N/A' }}</td>
                </tr>
                @endif
            @endforeach
        @endforeach
        @endforeach
        
        @else 
        @foreach ($namesT2 as $code => $name)
                   
                <tr>
                    <td style="text-align: center;" class="code">{{ $code }}</td>
                    <td >{{ $name }}</td>
                  
                    <td style="text-align: center; ">-</td>
                    <td style="text-align: center; ">-</td>

                    <td style="text-align: center; ">-</td>
                    <td style="text-align: center; ">-</td>

                    <td style="text-align: center; ">-</td>
                    <td style="text-align: center; ">-</td>
                </tr>
            @endforeach
            @endif
    </tbody>
    
    @if(!empty($resultstructur['T2']['groupedData']))
        <tr class="total2">
            <td colspan="2" style="text-align: center; font-weight: bold;">TOTAL DES CREDITS</td>
            <td style="text-align: center;">{{ number_format((float)$resultstructur['T2']['total'][0]['values']['totalAEouvrtvertical'], 2, '.', ',') ?? 'N/A' }}</td>
            <td style="text-align: center;">{{ number_format((float)$resultstructur['T2']['total'][0]['values']['totalCPouvrtvertical'], 2, '.', ',') ?? 'N/A' }}</td>
            <td style="text-align: center;">{{ number_format((float)$resultstructur['T2']['total'][0]['values']['totalAEattenduvertical'], 2, '.', ',') ?? 'N/A' }}</td>
            <td style="text-align: center;">{{ number_format((float)$resultstructur['T2']['total'][0]['values']['totalCPattenduvertical'], 2, '.', ',') ?? 'N/A' }}</td>
            <td style="text-align: center;">{{ number_format((float)$resultstructur['T2']['total'][0]['values']['totalAE'], 2, '.', ',') ?? 'N/A' }}</td>
            <td style="text-align: center;">{{ number_format((float)$resultstructur['T2']['total'][0]['values']['totalCP'], 2, '.', ',') ?? 'N/A' }}</td>
        </tr>

        <tr class="controle">
            <td colspan="2" style="text-align: center; font-weight: bold;">CONTRÔLE DE COHERENCE</td>
            <td style="text-align: center;">{{0 }}</td>
            <td style="text-align: center;">{{0 }}</td>
            <td style="text-align: center;">{{0 }}</td>
            <td style="text-align: center;">{{0 }}</td>
            <td style="text-align: center;">{{0 }}</td>
            <td style="text-align: center;">{{0 }}</td>
        </tr>
    @else
        <tr class="total2">
            <td colspan="2" style="text-align: center; font-weight: bold;">TOTAL DES CREDITS</td>
            <td style="text-align: center;">-</td>
            <td style="text-align: center;">-</td>
            <td style="text-align: center;">-</td>
            <td style="text-align: center;">-</td>
            <td style="text-align: center;">-</td>
            <td style="text-align: center;">-</td>
        </tr>

        <tr class="controle">
            <td colspan="2" style="text-align: center; font-weight: bold;">CONTRÔLE DE COHERENCE</td>
            <td style="text-align: center;">-</td>
            <td style="text-align: center;">-</td>
            <td style="text-align: center;">-</td>
            <td style="text-align: center;">-</td>
            <td style="text-align: center;">-</td>
            <td style="text-align: center;">-</td>
        </tr>
    @endif


</table>
</div>
</body>
</html>
