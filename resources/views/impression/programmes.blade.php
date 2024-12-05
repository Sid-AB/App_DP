<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau CREDITS 088 + 089</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f1eeee;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #d8d3d3;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #5a5b5c; /* Couleur en-têtes */
            color: rgb(10, 10, 10);
        }

        tr:nth-child(even) {
            background-color: #f5f4f4; /* Ligne alternative */
        }

        tr:hover {
            background-color: #0c0a0a; /* Effet survol */
        }

        .program-title {
            font-weight: bold;
            background-color: #2d92fd; /* Couleur plus sombre pour les programmes principaux */
            color: rgb(8, 8, 8);
        }

        .subprogram-title {
            font-weight: bold;
            background-color: #e5e7e9; /* Couleur grise pour les sous-programmes */
            color: rgb(17, 16, 16);
        }
        .ttaction-title {
            font-weight: bold;
            background-color: #39f167; /* Couleur plus sombre pour les programmes principaux */
            color: rgb(8, 8, 8);
        }
        .event-title {
            font-weight: bold;
            background-color: #41165a; /* Couleur eventuels credits */
            color: rgb(245, 238, 238);
        }
        .totals {
            font-weight: bold;
            background-color: #31cfeb; /* Couleur totals des actions1..n */
            color: rgb(243, 236, 236);
        }
    </style>
    <h1>Programmation des crédits du programme 088+089</h1>
</head>
<body>
    <h1>Programmation des crédits du programme 088</h1>
    <table border="1">
        <thead>
            <tr>
                <th class="subprogram-title"></th>
                <th class="subprogram-title"></th>
                <th colspan="2">T1</th>
                <th colspan="2">T2</th>
                <th colspan="2">T3</th>
                <th colspan="2">T4</th>
            </tr>
            <tr>
                <th>Code</th>
                <th>Le Programme/Sous-programmes/Actions</th>
                <th>AE</th>
                <th>CP</th>
                <th>AE</th>
                <th>CP</th>
                <th>AE</th>
                <th>CP</th>
                <th>AE</th>
                <th>CP</th>
            </tr>
        </thead>
        <tbody>

            {{-- Boucle sur les programmes --}}
            @for($i=0;$i< count($programmes);$i++)
            @foreach ($programmes[$i] as $programme)
                <tr class="subprogram-title" >
                    <td>{{ $programme['code'] }}</td>
                    <td>{{ $programme['nom'] }}</td>
                    <td>{{ $programme['Total']['TotalT1_AE']}}</td>
                    <td>{{ $programme['Total']['TotalT1_CP']}}</td>
                    <td>{{ $programme['Total']['TotalT2_AE']}}</td>
                    <td>{{ $programme['Total']['TotalT2_CP']}}</td>
                    <td>{{ $programme['Total']['TotalT3_AE']}}</td>
                    <td>{{ $programme['Total']['TotalT3_CP']}}</td>
                    <td>{{ $programme['Total']['TotalT4_AE']}}</td>
                    <td>{{ $programme['Total']['TotalT4_CP']}}</td>
                    <td colspan="8"></td>
                </tr>

                {{-- Boucle sur les sous-programmes --}}
                @for($j = 0 ; $j < count($programme['sous_programmes']) ; $j++ )
                @foreach ($programme['sous_programmes'][$j] as $sousProgramme)
                    <tr class="subprogram-title">
                        <td>{{ $sousProgramme['code'] }}</td>
                        <td>{{ $sousProgramme['nom'] }}</td>
                        <td>{{ $sousProgramme['Total']['TotalT1_AE']}}</td>
                        <td>{{ $sousProgramme['Total']['TotalT1_CP']}}</td>
                        <td>{{ $sousProgramme['Total']['TotalT2_AE']}}</td>
                        <td>{{ $sousProgramme['Total']['TotalT2_CP']}}</td>
                        <td>{{ $sousProgramme['Total']['TotalT3_AE']}}</td>
                        <td>{{ $sousProgramme['Total']['TotalT3_CP']}}</td>
                        <td>{{ $sousProgramme['Total']['TotalT4_AE']}}</td>
                        <td>{{ $sousProgramme['Total']['TotalT4_CP']}}</td>
                        <td colspan="8"></td>
                    </tr>

                    {{-- Boucle sur les actions pour chaque sous-programme --}}
                    @if(isset($sousProgramme['actions'][0]  ))
                    @for($k=0 ; $k < count($sousProgramme['actions']) ; $k++)
                    @foreach ($sousProgramme['actions'][$k] as $action)
                        <tr class="subprogram-title">
                            <td>{{ $action['code'] }}</td>
                            <td>{{ $action['nom'] }}</td>
                            <td>{{ $action['TotalT']['T1']['total'][0]['values']['totalAE']}}</td>
                            <td>{{ $action['TotalT']['T1']['total'][0]['values']['totalCP']}}</td>
                            <td>{{ $action['TotalT']['T2']['total'][0]['values']['totalAE']}}</td>
                            <td>{{ $action['TotalT']['T2']['total'][0]['values']['totalCP']}}</td>
                            <td>{{ $action['TotalT']['T3']['total'][0]['values']['totalAE']}}</td>
                            <td>{{ $action['TotalT']['T3']['total'][0]['values']['totalCP']}}</td>
                            <td>{{ $action['TotalT']['T4']['total'][0]['values']['totalAE']}}</td>
                            <td>{{ $action['TotalT']['T4']['total'][0]['values']['totalCP']}}</td>
                            <td colspan="8"></td>
                        </tr>
                    @endforeach
                    @endfor
                    @endif


                    <tr class="ttaction-title">
                        <td class="ttaction-title" colspan="2">Total des actions</td>
                        <td class="ttaction-title" colspan="8"></td>
                    </tr>


                    <tr class="event-title">
                        <td colspan="2">Eventuels crédits non répartis</td>
                        <td colspan="8"></td>
                    </tr>
                @endforeach
                @endfor
            @endforeach
            @endfor

            {{-- Total des actions/crédits ouverts pour tous les programmes --}}
            <tr class="totals">
                <th class="totals" colspan="2">TOTAL ACTIONS(1)+(2)/CREDITS OUVERTS</th>
                <th class="totals" colspan="8"></th>
            </tr>

        </tbody>
    </table>

</body>
</html>
