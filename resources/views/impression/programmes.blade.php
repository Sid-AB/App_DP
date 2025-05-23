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
            background-color:#fff;  
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        thead th
        {
            text-align: center;
        }
        th, td {
            border: 1px solid #000;
           /* text-align: left;*/
           padding: 13px 20px;
           text-align: center;
       
        }

        th {
           /* background-color: #DDD9C4; /* Couleur en-têtes */
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
           /* background-color: #DDD9C4; /* Couleur plus sombre pour les programmes principaux */
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
            color:white;
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

        h1 {
            font-size: 1em;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2em;
            margin-bottom: 30px;
        }
        .page-break {
            page-break-after: always;
        }

    </style>

</head>
<body>
    <h1>
        @for($i=0;$i< count($programmes);$i++)
        @foreach ($programmes[$i] as $programme)
        @php
                $code =explode('-',$programme['code']);
                $last =count($code)-1;
            // dd($code);
                $filcode[$i] =$code[$last].' ';
                //dd($filcode);
        @endphp
        @endforeach
        @endfor
    <p> LA PROGRAMMTION DES CREDITS DES PROGRAMMES ( 
    @for($i=0;$i< count($filcode);$i++)
    {{$filcode[$i]}} 
    @if ($i < count($filcode) - 1)
            + {{-- ajouter + pour separer les prgrms --}}
        @endif
    @endfor
    ):
    </p>
   
    </h1>

    {{-- Boucle sur les programmes --}}
    @for($i = 0; $i < count($programmes); $i++)
        @foreach ($programmes[$i] as $programme)
            @php
                $code = explode('-', $programme['code']);
                $last = count($code) - 1;
                $code = $code[$last];
            @endphp

            {{-- Nouveau tableau pour chaque programme --}}
            <div class="page-break">
            <table >
           
                    <tr>
                        <th  style="border: none; background: white;"  colspan=2></th>
                        <th colspan="2" class="T">T1</th>
                        <th colspan="2" class="T">T2</th>
                        <th colspan="2" class="T">T3</th>
                        <th colspan="2" class="T">T4</th>
                    </tr>
                    <tr>
                        <th class="T">Code</th>
                        <th class="T">Le Programme/Sous-programmes/Actions</th>
                        <th>AE</th>
                        <th>CP</th>
                        <th>AE</th>
                        <th>CP</th>
                        <th>AE</th>
                        <th>CP</th>
                        <th>AE</th>
                        <th>CP</th>
                    </tr>
              
                <tbody>
                    {{-- Ligne principale pour le programme --}}
                    <tr >
                        <td class="program-title" >{{ $code }}</td>
                        <td class="program-title">Programme :  {{ $programme['nom'] }}</td>
                        <td>{{ number_format((float)$programme['Total']['TotalT1_AE'], 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$programme['Total']['TotalT1_CP'], 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$programme['Total']['TotalT2_AE'], 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$programme['Total']['TotalT2_CP'], 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$programme['Total']['TotalT3_AE'], 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$programme['Total']['TotalT3_CP'], 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$programme['Total']['TotalT4_AE'], 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$programme['Total']['TotalT4_CP'], 2, '.', ',') }}</td>
                    </tr>

                    {{-- Boucle sur les sous-programmes --}}
                    @for($j = 0; $j < count($programme['sous_programmes']); $j++)
                        @foreach ($programme['sous_programmes'][$j] as $sousProgramme)
                            @php
                                $code = explode('-', $sousProgramme['code']);
                                $last = count($code) - 1;
                                $code = $code[$last];
                            @endphp

                            <tr>
                                <td class="subprogram-title">{{ $code }}</td>
                                <td class="subprogram-title"> Sous Programme : {{ $sousProgramme['nom'] }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT1_AE'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT1_CP'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT2_AE'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT2_CP'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT3_AE'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT3_CP'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT4_AE'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT4_CP'], 2, '.', ',') }}</td>
                            </tr>

                            {{-- Boucle sur les actions --}}
                            @if(isset($sousProgramme['actions'][0]))
                                @for($k = 0; $k < count($sousProgramme['actions']); $k++)
                                    @foreach ($sousProgramme['actions'][$k] as $action)
                                        @php
                                            $code = explode('-', $action['code']);
                                            $last = count($code) - 1;
                                            $code = $code[$last];
                                           // dd($action);
                         
                                        @endphp
                                        @if($action['type_action']=='centrale')
                                        <tr >
                                            <td>{{ $code }}</td>
                                            <td>Action : {{ $action['nom'] }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['centrale']['T1']['total'][0]['values']['totalAE'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['centrale']['T1']['total'][0]['values']['totalCP'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['centrale']['T2']['total'][0]['values']['totalAE'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['centrale']['T2']['total'][0]['values']['totalCP'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['centrale']['T3']['total'][0]['values']['totalAE'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['centrale']['T3']['total'][0]['values']['totalCP'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['centrale']['T4']['total'][0]['values']['totalAE'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['centrale']['T4']['total'][0]['values']['totalCP'], 2, '.', ',') }}</td>
                                        </tr>
                                        @elseif ($action['type_action']=='delegation')
                                        <tr >
                                            <td>{{ $code }}</td>
                                            <td>Action : {{ $action['nom'] }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['delegation']['T1']['total'][0]['values']['totalAE'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['delegation']['T1']['total'][0]['values']['totalCP'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['delegation']['T2']['total'][0]['values']['totalAE'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['delegation']['T2']['total'][0]['values']['totalCP'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['delegation']['T3']['total'][0]['values']['totalAE'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['delegation']['T3']['total'][0]['values']['totalCP'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['delegation']['T4']['total'][0]['values']['totalAE'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['delegation']['T4']['total'][0]['values']['totalCP'], 2, '.', ',') }}</td>
                                        </tr>
                                        @endif
                                    @endforeach
                                @endfor
                            @endif

                            {{-- Total des actions pour le sous-programme --}}
                            <tr class="ttaction-title">
                                <td class="ttaction-title"colspan="2">Total des actions</td>
                                <td class="ttaction-title">{{ number_format((float)$sousProgramme['Total']['TotalT1_AE'], 2, '.', ',') }}</td>
                                <td class="ttaction-title">{{ number_format((float)$sousProgramme['Total']['TotalT1_CP'], 2, '.', ',') }}</td>
                                <td class="ttaction-title">{{ number_format((float)$sousProgramme['Total']['TotalT2_AE'], 2, '.', ',') }}</td>
                                <td class="ttaction-title">{{ number_format((float)$sousProgramme['Total']['TotalT2_CP'], 2, '.', ',') }}</td>
                                <td class="ttaction-title">{{ number_format((float)$sousProgramme['Total']['TotalT3_AE'], 2, '.', ',') }}</td>
                                <td class="ttaction-title">{{ number_format((float)$sousProgramme['Total']['TotalT3_CP'], 2, '.', ',') }}</td>
                                <td class="ttaction-title">{{ number_format((float)$sousProgramme['Total']['TotalT4_AE'], 2, '.', ',') }}</td>
                                <td class="ttaction-title">{{ number_format((float)$sousProgramme['Total']['TotalT4_CP'], 2, '.', ',') }}</td>
                            </tr>
                        @endforeach
                    @endfor

                    {{-- Section "Eventuels crédits non répartis" --}}
                    <tr class="event-title">
                        <td colspan="2">Eventuels crédits non répartis</td>
                        <td >0 </td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>

                    </tr>

                    {{-- Total des actions/crédits ouverts pour le programme --}}
                    <tr class="totals">
                        <th class="totals" colspan="2">TOTAL ACTIONS/CREDITS OUVERTS</th>
                        <td>{{ number_format((float)$programme['Total']['TotalT1_AE'], 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$programme['Total']['TotalT1_CP'], 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$programme['Total']['TotalT2_AE'], 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$programme['Total']['TotalT2_CP'], 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$programme['Total']['TotalT3_AE'], 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$programme['Total']['TotalT3_CP'], 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$programme['Total']['TotalT4_AE'], 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$programme['Total']['TotalT4_CP'], 2, '.', ',') }}</td>
                    </tr>
                </tbody>
            </table>
            </div>
            {{-- Ajouter un espace entre les tableaux --}}
        
        @endforeach
    @endfor
    </body>
</html>
