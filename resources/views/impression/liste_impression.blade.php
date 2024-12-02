<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste </title>
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
            background-color: while; 
        }
        .highlight {
            background-color: white;
        }
        .bold {
            font-weight: bold;
        }

        .group-row {
            background-color: #f2e6d9; 
        }
        .with-sousop{
            background-color: #f2e6d9; 
        }
    </style>
</head>
<body>
    <h1>LES CREDITS DES DEPENSES DE PERSONNEL : </h1>

    <table>
        <thead>
            <tr>
                <th rowspan="2">Code</th>
                <th rowspan="2">T1. DEPENSES DE PERSONNEL</th>
                <th colspan="2">Code {{ $sousProgramme->num_sous_prog }} - Sous Programme {{ $sousProgramme->nom_sous_prog }}</th>
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
                <td>{{$codegrp}}</td>
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
                   <td>{{ $codeop }}</td>
                <td>{{ $names[$codeop] ?? 'Nom non trouvé' }}</td>
                <td>{{ $operationData['operation']['values']['ae_op'] ?? 'N/A' }}</td>
                <td>{{ $operationData['operation']['values']['cp_op'] ?? 'N/A' }}</td>
              
               @else
                   <tr class="operation-row">
                   <td>{{ $codeop }}</td>
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
                    <td>{{ $codeextr }}</td>
                    <td>{{ $names[$codeextr]?? 'Nom non trouvé' }}</td>
                    <td>{{ $sousOp['values']['ae_sousop'] ?? 'N/A' }}</td>
                    <td>{{ $sousOp['values']['cp_sousuop'] ?? 'N/A' }}</td>
                </tr>
            @endforeach
        @endforeach
        @endforeach
    </tbody>
    </table>
</body>

</html>