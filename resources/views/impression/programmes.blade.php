<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau CREDITS 088 </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #fff;
        }

        table {
            font-size: 12px; /* Réduction de la taille globale de la police */
            width: 90%; /* Ajuste la largeur globale */
            margin: 20px auto; /* Centre les tableaux et ajoute un espacement vertical */
            border-collapse: collapse;
        }
        thead th
        {
            text-align: center;
        }
        th, td {
            border: 1px solid #000;
           /* text-align: left;*/
            padding: 8px;
        }

        th {
            background-color: #DDD9C4; /* Couleur en-têtes */
            color: rgb(10, 10, 10);
        }

        tr:nth-child(even) {
            background-color: #fff; /* Ligne alternative */
        }

     /*   tr:hover {
            background-color: #0c0a0a;  Effet survol
        }*/

        .program-title {
            text-align:center;
            font-weight: bold;
            background-color: #DDD9C4; /* Couleur plus sombre pour les programmes principaux */
            color: rgb(8, 8, 8);
        }

        .subprogram-title {
            font-weight: bold;
            background-color: #fff; /* Couleur grise pour les sous-programmes */
            color: rgb(17, 16, 16);
        }
        .ttaction-title {
            font-weight: bold;
            background-color: #60497A; /* Couleur plus sombre pour les programmes principaux */
            color: rgb(8, 8, 8);
        }
        .event-title {
            font-weight: bold;
            background-color: #00B050; /* Couleur eventuels credits */
            color: rgb(245, 238, 238);
        }
        .event-title td {
            font-weight: bold;
            background-color: #00B050; /* Couleur eventuels credits */
            color: rgb(245, 238, 238);
        }

        .totals {
            font-weight: bold;
            background-color: #31869B   ; /* Couleur totals des actions1..n */
            color: rgb(243, 236, 236);
        }
        .totals td{
            font-weight: bold;
            background-color: #31869B   ; /* Couleur totals des actions1..n */
            color: rgb(243, 236, 236);
        }
        .T
        {
        background-color:#DDD9C4;
        }
    </style>

</head>
<body>
    <h1>Programmation des crédits des programmes 088+089</h1>

    {{-- Boucle sur les programmes --}}
    @for($i = 0; $i < count($programmes); $i++)
        @foreach ($programmes[$i] as $programme)
            @php
                $code = explode('-', $programme['code']);
                $last = count($code) - 1;
                $code = $code[$last];
            @endphp

            {{-- Nouveau tableau pour chaque programme --}}
            <table >
                <thead>
                    <tr>
                        <th  style="border: none; background: white;"  colspan=2></th>
                        <th colspan="2" class="T">T1</th>
                        <th colspan="2" class="T">T2</th>
                        <th colspan="2" class="T">T3</th>
                        <th colspan="2" class="T">T4</th>
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
                    {{-- Ligne principale pour le programme --}}
                    <tr class="program-title">
                        <td>{{ $code }}</td>
                        <td>Programme : {{ $programme['nom'] }}</td>
                        <td>{{ $programme['Total']['TotalT1_AE'] }}</td>
                        <td>{{ $programme['Total']['TotalT1_CP'] }}</td>
                        <td>{{ $programme['Total']['TotalT2_AE'] }}</td>
                        <td>{{ $programme['Total']['TotalT2_CP'] }}</td>
                        <td>{{ $programme['Total']['TotalT3_AE'] }}</td>
                        <td>{{ $programme['Total']['TotalT3_CP'] }}</td>
                        <td>{{ $programme['Total']['TotalT4_AE'] }}</td>
                        <td>{{ $programme['Total']['TotalT4_CP'] }}</td>
                    </tr>

                    {{-- Boucle sur les sous-programmes --}}
                    @for($j = 0; $j < count($programme['sous_programmes']); $j++)
                        @foreach ($programme['sous_programmes'][$j] as $sousProgramme)
                            @php
                                $code = explode('-', $sousProgramme['code']);
                                $last = count($code) - 1;
                                $code = $code[$last];
                            @endphp

                            <tr class="subprogram-title">
                                <td>{{ $code }}</td>
                                <td>Sous Programme : {{ $sousProgramme['nom'] }}</td>
                                <td>{{ $sousProgramme['Total']['TotalT1_AE'] }}</td>
                                <td>{{ $sousProgramme['Total']['TotalT1_CP'] }}</td>
                                <td>{{ $sousProgramme['Total']['TotalT2_AE'] }}</td>
                                <td>{{ $sousProgramme['Total']['TotalT2_CP'] }}</td>
                                <td>{{ $sousProgramme['Total']['TotalT3_AE'] }}</td>
                                <td>{{ $sousProgramme['Total']['TotalT3_CP'] }}</td>
                                <td>{{ $sousProgramme['Total']['TotalT4_AE'] }}</td>
                                <td>{{ $sousProgramme['Total']['TotalT4_CP'] }}</td>
                            </tr>

                            {{-- Boucle sur les actions --}}
                            @if(isset($sousProgramme['actions'][0]))
                                @for($k = 0; $k < count($sousProgramme['actions']); $k++)
                                    @foreach ($sousProgramme['actions'][$k] as $action)
                                        @php
                                            $code = explode('-', $action['code']);
                                            $last = count($code) - 1;
                                            $code = $code[$last];
                                        @endphp

                                        <tr class="subprogram-title">
                                            <td>{{ $code }}</td>
                                            <td>Action : {{ $action['nom'] }}</td>
                                            <td>{{ $action['TotalT']['T1']['total'][0]['values']['totalAE'] }}</td>
                                            <td>{{ $action['TotalT']['T1']['total'][0]['values']['totalCP'] }}</td>
                                            <td>{{ $action['TotalT']['T2']['total'][0]['values']['totalAE'] }}</td>
                                            <td>{{ $action['TotalT']['T2']['total'][0]['values']['totalCP'] }}</td>
                                            <td>{{ $action['TotalT']['T3']['total'][0]['values']['totalAE'] }}</td>
                                            <td>{{ $action['TotalT']['T3']['total'][0]['values']['totalCP'] }}</td>
                                            <td>{{ $action['TotalT']['T4']['total'][0]['values']['totalAE'] }}</td>
                                            <td>{{ $action['TotalT']['T4']['total'][0]['values']['totalCP'] }}</td>
                                        </tr>
                                    @endforeach
                                @endfor
                            @endif

                            {{-- Total des actions pour le sous-programme --}}
                            <tr class="ttaction-title">
                                <td class="ttaction-title" colspan="2">Total des actions</td>
                                <td class="ttaction-title">{{ $sousProgramme['Total']['TotalT1_AE'] }}</td>
                                <td class="ttaction-title">{{ $sousProgramme['Total']['TotalT1_CP'] }}</td>
                                <td class="ttaction-title">{{ $sousProgramme['Total']['TotalT2_AE'] }}</td>
                                <td class="ttaction-title">{{ $sousProgramme['Total']['TotalT2_CP'] }}</td>
                                <td class="ttaction-title">{{ $sousProgramme['Total']['TotalT3_AE'] }}</td>
                                <td class="ttaction-title">{{ $sousProgramme['Total']['TotalT3_CP'] }}</td>
                                <td class="ttaction-title">{{ $sousProgramme['Total']['TotalT4_AE'] }}</td>
                                <td class="ttaction-title">{{ $sousProgramme['Total']['TotalT4_CP'] }}</td>
                            </tr>
                        @endforeach
                    @endfor

                    {{-- Section "Eventuels crédits non répartis" --}}
                    <tr class="event-title">
                        <td colspan="2">Eventuels crédits non répartis</td>
                        <td colspan="8"></td>
                    </tr>

                    {{-- Total des actions/crédits ouverts pour le programme --}}
                    <tr class="totals">
                        <th class="totals" colspan="2">TOTAL ACTIONS/CREDITS OUVERTS</th>
                        <td>{{ $programme['Total']['TotalT1_AE'] }}</td>
                        <td>{{ $programme['Total']['TotalT1_CP'] }}</td>
                        <td>{{ $programme['Total']['TotalT2_AE'] }}</td>
                        <td>{{ $programme['Total']['TotalT2_CP'] }}</td>
                        <td>{{ $programme['Total']['TotalT3_AE'] }}</td>
                        <td>{{ $programme['Total']['TotalT3_CP'] }}</td>
                        <td>{{ $programme['Total']['TotalT4_AE'] }}</td>
                        <td>{{ $programme['Total']['TotalT4_CP'] }}</td>
                    </tr>
                </tbody>
            </table>

            {{-- Ajouter un espace entre les tableaux --}}
            <br><br>
        @endforeach
    @endfor
    </body>
</html>
