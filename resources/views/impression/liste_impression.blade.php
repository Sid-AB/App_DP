<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LES CREDITS DES DEPENSES DE PERSONNEL </title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: white; 
        }
        .highlight {
            background-color: white;
        }
        .bold {
            font-weight: bold;
        }

        /*.group-row {
            background-color: #FFE5CC; 
        }
        .with-sousop{
            background-color: #DED4CA ; 
        }
        .code ,.t1{
            background-color:#CCE5FF;
        }
        .total {
            background-color:#6A58DF; 
        }*/
    </style>
</head>
<body>
    <h1>LES CREDITS DES DEPENSES DE PERSONNEL : </h1>

    <table>
        <thead>
            <tr>
                <th rowspan="2">Code</th>
                <th rowspan="2" class="t1">T1. DEPENSES DE PERSONNEL</th>
                @php
                    $sousprog = explode('-', $sousProgramme->num_sous_prog);
                    $lastchiffre = end($sousprog);
                @endphp

                <th colspan="2">Code {{ $lastchiffre }} - Sous Programme {{ $sousProgramme->nom_sous_prog }}</th>
            </tr>
            <tr>
         
                <th>AE Sous-Operation</th>
                <th>CP Sous-Operation</th>
            </tr>
        </thead>
        <tbody>
      
                @foreach ($resultstructur['T1']['groupedData'] as $groupData)
                @php
                    // extraire la dernière partie du code grp
                    $code_grpsepar = explode('-', $groupData['group']['code']);
                    $codegrp = end($code_grpsepar);
                @endphp
                <tr class="group-row">
                <td class="code">{{$codegrp}}</td>
                <td>{{ $names[$codegrp ] ?? 'Nom non trouvé' }}</td>
                <td>{{ $groupData['group']['values']['ae_grpop'] ?? 'N/A' }}</td>
                <td>{{ $groupData['group']['values']['cp_grpop'] ?? 'N/A' }}</td>
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
                <td>{{ $names[$codeop] ?? 'Nom non trouvé' }}</td>
                <td>{{ $operationData['operation']['values']['ae_op'] ?? 'N/A' }}</td>
                <td>{{ $operationData['operation']['values']['cp_op'] ?? 'N/A' }}</td>
              
               @else
                   <tr class="operation-row">
                   <td class="code">{{ $codeop }}</td>
                <td>{{ $names[$codeop] ?? 'Nom non trouvé' }}</td>
                <td>{{ $operationData['operation']['values']['ae_op'] ?? 'N/A' }}</td>
                <td>{{ $operationData['operation']['values']['cp_op'] ?? 'N/A' }}</td>
              
                @endif
              
              

                @foreach ($operationData['sousOperations'] as $sousOp)
            @php
                    // extraire la dernière partie du code de la sous-opération
                    $code_separer = explode('-', $sousOp['code']);
                    $codeextr = end($code_separer);
                @endphp
                <tr>
                    <td class="code">{{ $codeextr }}</td>
                    <td>{{ $names[$codeextr]?? 'Nom non trouvé' }}</td>
                    <td>{{ $sousOp['values']['ae_sousop'] ?? 'N/A' }}</td>
                    <td>{{ $sousOp['values']['cp_sousuop'] ?? 'N/A' }}</td>
                </tr>
            @endforeach
        @endforeach
        @endforeach
    </tbody>
    <tfoot>
        <tr  class="total">
            <td colspan="2" style="text-align: center; font-weight: bold;">Total</td>
            <td>{{ $resultstructur['T1']['total'][0]['values']['totalAE'] ?? 'N/A' }}</td>
            <td>{{ $resultstructur['T1']['total'][0]['values']['totalCP'] ?? 'N/A' }}</td>
        </tr>
    </tfoot>
    </table>
</body>

</html>