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
                <th colspan="2">Code '{{ $sousProgramme->num_sous_prog }}' + '{{ $sousProgramme->nom_sous_prog }}'</th>
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
                    @foreach ($resultats[$t] as $resultats)

                <tr>
                @if (isset($resultats['group']))
                    <!-- afficher chaque groupe -->
                    @foreach ($resultats['group'] as $group)
                        <tr>
                            <td>{{ $group['code'] }}</td>
                            <!--td>Nom du Groupe</td-->
                            <td>{{ $operations[$group['code']] ?? 'Nom introuvable' }}</td>
                            <td>{{ $group['values']['ae_grpop'] }}</td>
                            <td>{{ $group['values']['cp_grpop'] }}</td>
                        </tr>
                        
                        <!-- afficher les sous-opérations liées -->
                        @if (isset($resultats['sousOperation']))
                            @foreach ($resultats['sousOperation'] as $sousOperation)
                                <tr>
                                    <td>{{ $sousOperation['code'] }}</td>
                                    <!--td>Nom Sous Operation</td-->
                                    <td>{{ $operations[$sousOperation['code']] ?? 'Nom introuvable' }}</td>
                                    <td>{{ $sousOperation['values']['ae_sousop'] }}</td>
                                    <td>{{ $sousOperation['values']['cp_sousuop'] }}</td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                @endif
               
                    <td>{{$resultats->num_sous_prog}}</td>
                    <td>{{$resultats->nom_sous_progr}}</td>
                   
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
