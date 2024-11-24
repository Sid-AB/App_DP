<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste </title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>LES CREDITS DES DEPENSES DE PERSONNEL : </h1>

    <table>
        <thead>
            <tr>
                <th>Code</th>
                <th>T1. DEPENSES DE PERSONNEL</th>
                <th colspan="2">Code {{ $sousProgramme->num_sous_prog }} - Sous Programme {{ $sousProgramme->nom_sous_prog }}</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th>AE Sous-Operation</th>
                <th>CP Sous-Operation</th>
            </tr>
        </thead>
        <tbody>
      
        @foreach (['T1', 'T2', 'T3', 'T4'] as $t)
            @if (isset($resultats[$t]))
                @foreach ($resultats[$t]['sousOperation'] as $sousOperation)
                    <tr>
                        <td>{{ $sousOperation['code'] }}</td>
                        <td>{{ $operations[substr($sousOperation['code'], 0, 5)] ?? 'Nom introuvable' }}</td>
                        <td>{{ $sousOperation['values']['ae_sousop'] ?? 'N/A' }}</td>
                        <td>{{ $sousOperation['values']['cp_sousuop'] ?? 'N/A' }}</td>
                    </tr>

                   
                @endforeach
            @endif
        @endforeach
    </tbody>
    </table>
</body>

</html>