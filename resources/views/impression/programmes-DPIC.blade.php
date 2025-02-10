<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau DPIC </title>
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
            color: rgb(17, 16, 16);
           
        }

        .subprogram-title {
         
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
            font-size: 1.2em;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2em;
            margin-bottom: 30px;
        }
        .page-break {
            page-break-after: always;
        }

        .first-table {
            width: 100%; 
            margin-bottom: 20px; 
            margin: 0 auto;
        }

        .headt1{
        background-color:#DDD9C4;
    }
    </style>

</head>
<body>
<h1 style="text-align: center; font-family: Cambria, sans-serif; font-size: 18pt; font-weight: bold;">
    1<span style="position: relative; top: -5px; font-size: 0.6em;">ERE</span> PARTIE:
</h1>
<p style="font-family: Arial, sans-serif; font-size: 16pt; font-weight: bold; text-align: center;/*margin-left: 820px;*/"> 
            LES CREDITS BUDGETAIRES
    </p>
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
    <p style="font-family: Arial, sans-serif; font-size:18pt; font-weight: bold;"> 1.2. LA PROGRAMMTION DES CREDITS DES PROGRAMMES ( 
    @for($i=0;$i< count($filcode);$i++)
    {{$filcode[$i]}} 
    @if ($i < count($filcode) - 1)
            + {{-- ajouter + pour separer les prgrms --}}
        @endif
    @endfor
    ):
    </p>
   
    </h1>
    <h1 style="font-family: Arial, sans-serif; font-size: 16pt; font-weight: bold;"> 1.2.1. PROGRAMMATION DES CREDITS OUVERTS PAR LA LOI DE FINANCES ET REPARTIS PAR LE DECRET DE REPARTITION :</h1>
    {{-- Boucle sur les programmes --}}
    @for($i = 0; $i < count($programmes); $i++)
        @foreach ($programmes[$i] as $programme)
            @php
                $code = explode('-', $programme['code']);
                $last = count($code) - 1;
                $code = $code[$last];
            @endphp

            {{-- Nouveau tableau pour chaque programme --}}
            <div>
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
                    <tr class="program-title">
                        <td class="program-title" >{{ $code }}</td>
                        <td class="program-title">Programme :  {{ $programme['nom'] }}</td>
                        @if(!empty($programme['Total']))
                   
                   
                    <td>{{ number_format((float)$programme['Total']['TotalT1_AE'], 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$programme['Total']['TotalT1_CP'], 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$programme['Total']['TotalT2_AE'], 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$programme['Total']['TotalT2_CP'], 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$programme['Total']['TotalT3_AE'], 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$programme['Total']['TotalT3_CP'], 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$programme['Total']['TotalT4_AE'], 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$programme['Total']['TotalT4_CP'], 2, '.', ',') }}</td>

                    <!--td style=" font-weight: bold;">{{ number_format((float)$programme['Total']['TotalT1_AE']+$programme['Total']['TotalT2_AE']+ $programme['Total']['TotalT3_AE']+$programme['Total']['TotalT4_AE'], 2, '.', ',')}}</td>
                    <td style=" font-weight: bold;">{{ number_format((float)$programme['Total']['TotalT1_CP']+$programme['Total']['TotalT2_CP']+$programme['Total']['TotalT3_CP'] +$programme['Total']['TotalT4_CP'], 2, '.', ',')}}</td-->
                    @else
                    
                    <td>{{ number_format((float)0, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)0, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)0, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)0, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)0, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)0, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)0, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)0, 2, '.', ',') }}</td>

                    <!--td style=" font-weight: bold;">{{ number_format((float)0, 2, '.', ',')}}</td>
                    <td style=" font-weight: bold;">{{ number_format((float)0, 2, '.', ',')}}</td-->
                    @endif
                    </tr>

                    {{-- Boucle sur les sous-programmes --}}
                    @for($j = 0; $j < count($programme['sous_programmes']); $j++)
                        @foreach ($programme['sous_programmes'][$j] as $sousProgramme)
                            @php
                                $code = explode('-', $sousProgramme['code']);
                                $last = count($code) - 1;
                                $code = $code[$last];
                            @endphp
                             @if(!isset($sousProgramme['actions'][0]))
                            <tr>
                                <td class="subprogram-title">{{ $code }}</td>
                                <td class="subprogram-title"> Sous Programme : {{ $sousProgramme['nom'] }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT1_AE_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT1_CP_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT2_AE_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT2_CP_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT3_AE_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT3_CP_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT4_AE_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT4_CP_ini'], 2, '.', ',') }}</td>
                            </tr>
                            @endif  
                            {{-- Boucle sur les actions --}}
                            @if(isset($sousProgramme['actions'][0]))
                                @for($k = 0; $k < count($sousProgramme['actions']); $k++)
                                    @foreach ($sousProgramme['actions'][$k] as $action)
                                        @php
                                            $code = explode('-', $action['code']);
                                            $last = count($code) - 1;
                                            $code = $code[$last];
                                            //dd($action);
                                        @endphp

                                        <tr >
                                            <td>{{ $code }}</td>
                                            <td>Action : {{ $action['nom'] }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['TotalT1_AE_ini'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['TotalT1_CP_ini'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['TotalT2_AE_ini'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['TotalT2_CP_ini'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['TotalT3_AE_ini'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['TotalT3_CP_ini'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['TotalT4_AE_ini'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['TotalT4_CP_ini'], 2, '.', ',') }}</td>
                                        </tr>

                                        {{-- Total des actions pour le sous-programme --}}
                                       
                                        <tr class="ttaction-title">
                                            <td class="ttaction-title"colspan="2">Total des actions</td>
                                            @php
                                            //dd($programme['sous_programmes'][0])
                                            @endphp
                                            @if(!empty($programme['sous_programmes']))
                                                <td  class="ttaction-title">{{ number_format((float)$programme['sous_programmes'][$j]['sous_programmes']['Total']['TotalT1_AE_ini'], 2, '.', ',') }}</td>
                                                <td  class="ttaction-title">{{ number_format((float)$programme['sous_programmes'][$j]['sous_programmes']['Total']['TotalT1_CP_ini'], 2, '.', ',') }}</td>
                                                <td  class="ttaction-title">{{ number_format((float)$programme['sous_programmes'][$j]['sous_programmes']['Total']['TotalT2_AE_ini'], 2, '.', ',') }}</td>
                                                <td  class="ttaction-title">{{ number_format((float)$programme['sous_programmes'][$j]['sous_programmes']['Total']['TotalT2_CP_ini'], 2, '.', ',') }}</td>
                                                <td  class="ttaction-title">{{ number_format((float)$programme['sous_programmes'][$j]['sous_programmes']['Total']['TotalT3_AE_ini'], 2, '.', ',') }}</td>
                                                <td  class="ttaction-title">{{ number_format((float)$programme['sous_programmes'][$j]['sous_programmes']['Total']['TotalT3_CP_ini'], 2, '.', ',') }}</td>
                                                <td  class="ttaction-title">{{ number_format((float)$programme['sous_programmes'][$j]['sous_programmes']['Total']['TotalT4_AE_ini'], 2, '.', ',') }}</td>
                                                <td  class="ttaction-title">{{ number_format((float)$programme['sous_programmes'][$j    ]['sous_programmes']['Total']['TotalT4_CP_ini'], 2, '.', ',') }}</td>
                                            @else
                                                <td class="ttaction-title" >0 </td>
                                                <td class="ttaction-title" >0</td>
                                                <td class="ttaction-title">0</td>
                                                <td class="ttaction-title">0</td>
                                                <td class="ttaction-title">0</td>
                                                <td class="ttaction-title">0</td>
                                                <td class="ttaction-title">0</td>
                                                <td class="ttaction-title">0</td>
                                            @endif
                                        </tr>
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
                                    @endforeach
                                    
                                @endfor
                              
                            @endif

                         
                        @endforeach
                    @endfor
                 
                           
                    {{-- Section "Eventuels crédits non répartis" --}}
                               

                    {{-- Total des actions/crédits ouverts pour le programme --}}
                    <tr class="totals">
                        <th class="totals" colspan="2">TOTAL ACTIONS/CREDITS OUVERTS</th>
                        @if(!empty($programme['Total']))
                        <td>{{ number_format((float)$programme['Total']['TotalT1_AE'], 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$programme['Total']['TotalT1_CP'], 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$programme['Total']['TotalT2_AE'], 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$programme['Total']['TotalT2_CP'], 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$programme['Total']['TotalT3_AE'], 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$programme['Total']['TotalT3_CP'], 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$programme['Total']['TotalT4_AE'], 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$programme['Total']['TotalT4_CP'], 2, '.', ',') }}</td>
                     
                        @else
                            <td >0 </td>
                            <td >0</td>
                            <td >0</td>
                            <td >0</td>
                            <td >0</td>
                            <td >0</td>
                            <td >0</td>
                            <td >0</td>
                        @endif
                    </tr>
                </tbody>
            </table>
            </div>
            {{-- Ajouter un espace entre les tableaux --}}
         
        @endforeach
    @endfor

    <div class="page-break"> </div>
    <h1 style="font-family: Arial, sans-serif; font-size: 14pt; font-weight: bold;"> 1.2.2. PROGRAMMATION DES CREDITS ATTENDUS DEVENUS DISPONIBLES EN COURS D'ANNEE   <?php echo date("Y"); ?> </h1>
    <table >
    
    <tr>
   
    {{-- Boucle sur les programmes --}}
    @for($i = 0; $i < count($programmes); $i++)
    @php
                $totalAE_t1 = $totalAE_t2 = $totalAE_t3 = $totalAE_t4 = 0;
                $totalCP_t1 = $totalCP_t2 = $totalCP_t3 = $totalCP_t4 = 0;

        
                @endphp
        @foreach ($programmes[$i] as $programme)
            @php
                $code = explode('-', $programme['code']);
                $last = count($code) - 1;
                $code = $code[$last];
            @endphp

            {{-- Nouveau tableau pour chaque programme --}}
            <div>
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
                    <tr class="program-title">
                        <td class="program-title" >{{ $code }}</td>
                        <td class="program-title">Programme :  {{ $programme['nom'] }}</td>
                        
                        @if(!empty($programme['Total']))
                   
                        @php
                                $totalprogAE = $totalprogCP = 0;
                            @endphp
                            @foreach(['t1', 't2', 't3', 't4'] as $key)
                                @php
                                    $tabsousprogrecoit = $result[$key]['tabsousprogrecoit'] ?? []; 
                                  //  dd( $tabsousprogrecoit);
                                    $tabsousprogretir = $result[$key]['tabsousprogretir'] ?? [];
                                    $valeurAE = $valeurCP = 0;
                                @endphp

                                {{-- Boucle sur tabsousprogrecoit --}}
                                @foreach($tabsousprogrecoit as $index => $item)
                                    @if($item['prog'] === $programme['code'])
                                       
                                        @php
                                            if ($index === 0) {  
                                                $valeurAE = $item['valeurAE'] ?? 0;
                                            }
                                            if ($index === 1) {  
                                                $valeurCP = $item['valeurCP'] ?? 0;
                                            }
                                           
                                        @endphp
                                    @endif
                                @endforeach

                                {{-- Boucle sur tabsousprogretir --}}
                                @foreach($tabsousprogretir as $index => $item)
                                    @if($item['prog'] === $programme['code'])
                                   
                                        @php
                                            if ($index === 0) { 
                                                $valeurAE = $item['valeurAE'] ?? 0;
                                            }
                                            if ($index === 1) { 
                                                $valeurCP = $item['valeurCP'] ?? 0;
                                            }

                                        @endphp
                                    @endif
                                @endforeach
                               
                                @php
                                    $totalprogAE += $valeurAE;
                                    $totalprogCP += $valeurCP;
                                @endphp

                               
                                @php
                                    if ($key === 't1') {
                                        $totalAE_t1 += $valeurAE;
                                        $totalCP_t1 += $valeurCP;
                                    } elseif ($key === 't2') {
                                        $totalAE_t2 += $valeurAE;
                                        $totalCP_t2 += $valeurCP;
                                    } elseif ($key === 't3') {
                                        $totalAE_t3 += $valeurAE;
                                        $totalCP_t3 += $valeurCP;
                                    } elseif ($key === 't4') {
                                        $totalAE_t4 += $valeurAE;
                                        $totalCP_t4 += $valeurCP;
                                    }
                                @endphp
                                <td>{{ number_format((float) $valeurAE , 2, '.', ',')}}</td>
                                <td>{{ number_format((float)$valeurCP, 2, '.', ',') }}</td>
                            @endforeach

                    <!--td>{{ number_format((float)$programme['Total']['TotalT1_AE'], 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$programme['Total']['TotalT1_CP'], 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$programme['Total']['TotalT2_AE'], 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$programme['Total']['TotalT2_CP'], 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$programme['Total']['TotalT3_AE'], 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$programme['Total']['TotalT3_CP'], 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$programme['Total']['TotalT4_AE'], 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$programme['Total']['TotalT4_CP'], 2, '.', ',') }}</td>

                    <td style=" font-weight: bold;">{{ number_format((float)$programme['Total']['TotalT1_AE']+$programme['Total']['TotalT2_AE']+ $programme['Total']['TotalT3_AE']+$programme['Total']['TotalT4_AE'], 2, '.', ',')}}</td>
                    <td style=" font-weight: bold;">{{ number_format((float)$programme['Total']['TotalT1_CP']+$programme['Total']['TotalT2_CP']+$programme['Total']['TotalT3_CP'] +$programme['Total']['TotalT4_CP'], 2, '.', ',')}}</td-->
                    @else
                            <td >0.00 </td>
                            <td >0.00</td>
                            <td >0.00</td>
                            <td >0.00</td>
                            <td >0.00</td>
                            <td >0.00</td>
                            <td >0.00</td>
                            <td >0.00</td>
                    
                    <!--td>{{ number_format((float)0, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)0, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)0, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)0, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)0, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)0, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)0, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)0, 2, '.', ',') }}</td>

                    <td style=" font-weight: bold;">{{ number_format((float)0, 2, '.', ',')}}</td>
                    <td style=" font-weight: bold;">{{ number_format((float)0, 2, '.', ',')}}</td-->
                    @endif
                    </tr>

                    {{-- Boucle sur les sous-programmes --}}
                    @for($j = 0; $j < count($programme['sous_programmes']); $j++)
                    @php
                        $totalactAE_t1 = $totalactAE_t2 = $totalactAE_t3 = $totalactAE_t4 = 0;
                        $totalactCP_t1 = $totalactCP_t2 = $totalactCP_t3 = $totalactCP_t4 = 0;
                    @endphp                   
                        @foreach ($programme['sous_programmes'][$j] as $sousProgramme)
                            @php
                                $code = explode('-', $sousProgramme['code']);
                                $last = count($code) - 1;
                                $code = $code[$last];
                            @endphp
                             @if(!isset($sousProgramme['actions'][0]))
                            <tr>
                                <td class="subprogram-title">{{ $code }}</td>
                                <td class="subprogram-title"> Sous Programme : {{ $sousProgramme['nom'] }}</td>
                                @foreach(['t1', 't2', 't3', 't4'] as $key)
                                    @php
                                        $tabsousprogcoit = $result[$key]['tabsousprogrecoit'] ?? [];
                                        $tabsousprogretir = $result[$key]['tabsousprogretir'] ?? [];
                                        $valeurAE = $valeurCP = 0;  
                                    @endphp

                                 
                                    @foreach($tabsousprogcoit as $index => $item)
                                        @if($item['prog'] === $programme['code'] && $item['num_sous_prog'] === $sousProgramme['code'])
                                        @php
                                            if ($index === 0) { 
                                                $valeurAE = $item['valeurAE'] ?? 0;
                                            }
                                            if ($index === 1) { 
                                                $valeurCP = $item['valeurCP'] ?? 0;
                                            }
                                        @endphp
                                        @endif
                                    @endforeach

                                    {{-- Vérification de tabsousprogretir --}}
                                    @foreach($tabsousprogretir as $index => $item)
                                        @if($item['prog'] === $programme['code'] && $item['num_sous_prog'] === $sousProgramme['code'])
                                        @php
                                            if ($index === 0) { 
                                                $valeurAE = $item['valeurAE'] ?? 0;
                                            }
                                            if ($index === 1) { 
                                                $valeurCP = $item['valeurCP'] ?? 0;
                                            }
                                        @endphp
                                        @endif
                                    @endforeach

                                   
                                    {{-- Affichage des valeurs --}}
                                    <td>{{ number_format((float) $valeurAE , 2, '.', ',')}}</td>
                                    <td>{{ number_format((float)$valeurCP, 2, '.', ',') }}</td>
                                @endforeach
                                <!--td>{{ number_format((float)$sousProgramme['Total']['TotalT1_AE_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT1_CP_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT2_AE_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT2_CP_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT3_AE_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT3_CP_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT4_AE_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT4_CP_ini'], 2, '.', ',') }}</td-->
                            </tr>
                            @endif  
                            {{-- Boucle sur les actions --}}
                            @if(isset($sousProgramme['actions'][0]))
                                @for($k = 0; $k < count($sousProgramme['actions']); $k++)
                                    @foreach ($sousProgramme['actions'][$k] as $action)
                                        @php
                                            $code = explode('-', $action['code']);
                                            $last = count($code) - 1;
                                            $code = $code[$last];
                                            //dd($action);
                                        @endphp

                                        <tr >
                                       
                    
                                            <td>{{ $code }}</td>
                                            <td>Action : {{ $action['nom'] }}</td>
                                            @php
                                                $totalactAE = $totalactCP = 0;
                                            @endphp
                                    @foreach(['t1', 't2', 't3', 't4'] as $key)
                                    @php
                                        $tabsousprogcoit = $result[$key]['tabsousprogrecoit'] ?? [];
                                        $tabsousprogretir = $result[$key]['tabsousprogretir'] ?? [];
                                        $valeurAE = $valeurCP = 0;   
                                        
                                    @endphp

                                             
                                    @foreach($tabsousprogcoit as $index => $item)
                                        @if($item['prog'] === $programme['code'] && $item['num_sous_prog'] === $sousProgramme['code'] && $item['num_action'] === $action['code'])
                                        @php
                                            if ($index === 0) { 
                                                $valeurAE = $item['valeurAE'] ?? 0;
                                            }
                                            if ($index === 1) { 
                                                $valeurCP = $item['valeurCP'] ?? 0;
                                            }
                                        @endphp
                                        @endif
                                    @endforeach

                                    {{-- Vérification de tabsousprogretir --}}
                                    @foreach($tabsousprogretir as $index => $item)
                                        @if($item['prog'] === $programme['code'] && $item['num_sous_prog'] === $sousProgramme['code'] && $item['num_action'] === $action['code'])
                                        @php
                                            if ($index === 0) { 
                                                $valeurAE = $item['valeurAE'] ?? 0;
                                            }
                                            if ($index === 1) { 
                                                $valeurCP = $item['valeurCP'] ?? 0;
                                            }
                                        @endphp
                                        @endif
                                    @endforeach

                                    @php
                                    $totalactAE += $valeurAE;
                                    $totalactCP += $valeurCP;
                                @endphp

                               
                                @php
                                    if ($key === 't1') {
                                        $totalactAE_t1 += $valeurAE;
                                        $totalactCP_t1 += $valeurCP;
                                    } elseif ($key === 't2') {
                                        $totalactAE_t2 += $valeurAE;
                                        $totalactCP_t2 += $valeurCP;
                                    } elseif ($key === 't3') {
                                        $totalactAE_t3 += $valeurAE;
                                        $totalactCP_t3 += $valeurCP;
                                    } elseif ($key === 't4') {
                                        $totalactAE_t4 += $valeurAE;
                                        $totalactCP_t4 += $valeurCP;
                                    }
                                @endphp
                                    {{-- Affichage des valeurs --}}
                                    <td>{{ number_format((float) $valeurAE , 2, '.', ',')}}</td>
                                    <td>{{ number_format((float)$valeurCP, 2, '.', ',') }}</td>
                                @endforeach
                                            <!--td>{{ number_format((float)$action['TotalT']['TotalT1_AE_ini'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['TotalT1_CP_ini'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['TotalT2_AE_ini'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['TotalT2_CP_ini'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['TotalT3_AE_ini'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['TotalT3_CP_ini'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['TotalT4_AE_ini'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['TotalT4_CP_ini'], 2, '.', ',') }}</td-->
                                        </tr>

                                  
                                       
                                        {{-- Total des actions pour le sous-programme --}}
                                       
                                       <tr class="ttaction-title">
                                           <td class="ttaction-title"colspan="2">Total des actions</td>
                                           
                                           @if(!empty($programme['sous_programmes']))
                                               <td  class="ttaction-title">{{ number_format((float)$totalactAE_t1, 2, '.', ',') }}</td>
                                               <td  class="ttaction-title">{{ number_format((float)$totalactCP_t1, 2, '.', ',') }}</td>
                                               <td  class="ttaction-title">{{ number_format((float)$totalactAE_t2, 2, '.', ',') }}</td>
                                               <td  class="ttaction-title">{{ number_format((float)$totalactCP_t2, 2, '.', ',') }}</td>
                                               <td  class="ttaction-title">{{ number_format((float)$totalactAE_t3, 2, '.', ',') }}</td>
                                               <td  class="ttaction-title">{{ number_format((float)$totalactCP_t3, 2, '.', ',') }}</td>
                                               <td  class="ttaction-title">{{ number_format((float)$totalactAE_t4, 2, '.', ',') }}</td>
                                               <td  class="ttaction-title">{{ number_format((float)$totalactCP_t4, 2, '.', ',') }}</td>
                                            @else
                                            <td  class="ttaction-title">0.00 </td>
                                            <td  class="ttaction-title">0.00</td>
                                            <td  class="ttaction-title">0.00</td>
                                            <td  class="ttaction-title">0.00</td>
                                            <td  class="ttaction-title">0.00</td>
                                            <td  class="ttaction-title">0.00</td>
                                            <td  class="ttaction-title">0.00</td>
                                            <td  class="ttaction-title">0.00</td>
                                           @endif
                                       </tr>
                                       <tr class="event-title">
                                           <td colspan="2">Eventuels crédits non répartis</td>
                                           <td >{{ number_format((float)0, 2, '.', ',') }}</td>
                                           <td >{{ number_format((float)0, 2, '.', ',') }}</td>
                                           <td >{{ number_format((float)0, 2, '.', ',') }}</td>
                                           <td >{{ number_format((float)0, 2, '.', ',') }}</td>
                                           <td >{{ number_format((float)0, 2, '.', ',') }}</td>
                                           <td >{{ number_format((float)0, 2, '.', ',') }}</td>
                                           <td >{{ number_format((float)0, 2, '.', ',') }}</td>
                                           <td >{{ number_format((float)0, 2, '.', ',') }}</td>

                                       </tr>
                                   @endforeach
                                   
                               @endfor
                             
                           @endif

                        
                       @endforeach
                   @endfor
                
                          
                   {{-- Section "Eventuels crédits non répartis" --}}
                              

                   {{-- Total des actions/crédits ouverts pour le programme --}}
                   <tr class="totals">
                       <th class="totals" colspan="2">TOTAL ACTIONS/CREDITS OUVERTS</th>
                       @if(!empty($programme['Total']))
                        <td>{{ number_format((float)$totalAE_t1, 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$totalCP_t1, 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$totalAE_t2, 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$totalCP_t2, 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$totalAE_t3, 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$totalCP_t3, 2, '.', ',' )}}</td>
                        <td>{{ number_format((float)$totalAE_t4, 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$totalCP_t4, 2, '.', ',') }}</td>
                            
                       @else
                            <td >{{ number_format((float)0, 2, '.', ',') }}</td>
                            <td >{{ number_format((float)0, 2, '.', ',') }}</td>
                            <td >{{ number_format((float)0, 2, '.', ',') }}</td>
                            <td >{{ number_format((float)0, 2, '.', ',') }}</td>
                            <td >{{ number_format((float)0, 2, '.', ',') }}</td>
                            <td >{{ number_format((float)0, 2, '.', ',') }}</td>
                            <td >{{ number_format((float)0, 2, '.', ',') }}</td>
                            <td >{{ number_format((float)0, 2, '.', ',') }}</td>

                       @endif
                   </tr>
               </tbody>
           </table>
           </div>
           {{-- Ajouter un espace entre les tableaux --}}
        
       @endforeach
   @endfor
</tbody>
</table>
<div class="page-break"> </div>
<h1 style=" font-family: Cambria, sans-serif; font-size: 14pt; font-weight: bold;"> 1.2.3. PROGRAMMATION DES CREDITS DISPONIBLES (CREDITS OUVERTS + CREDITS ATTENDUS DEVENUS DISPONIBLES) :</h1>
<table >
    
    <tr>
    {{-- Boucle sur les programmes --}}
    @for($i = 0; $i < count($programmes); $i++)
        @foreach ($programmes[$i] as $programme)
            @php
                $code = explode('-', $programme['code']);
                $last = count($code) - 1;
                $code = $code[$last];
            @endphp

            {{-- Nouveau tableau pour chaque programme --}}
            <div>
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
                    <tr class="program-title">
                        <td class="program-title" >{{ $code }}</td>
                        <td class="program-title">Programme :  {{ $programme['nom'] }}</td>
                        @if(!empty($programme['Total']))
                       
                   
                    <td>{{ number_format((float)$programme['Total']['TotalT1_AE'], 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$programme['Total']['TotalT1_CP'], 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$programme['Total']['TotalT2_AE'], 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$programme['Total']['TotalT2_CP'], 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$programme['Total']['TotalT3_AE'], 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$programme['Total']['TotalT3_CP'], 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$programme['Total']['TotalT4_AE'], 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$programme['Total']['TotalT4_CP'], 2, '.', ',') }}</td>

                    <!--td style=" font-weight: bold;">{{ number_format((float)$programme['Total']['TotalT1_AE']+$programme['Total']['TotalT2_AE']+ $programme['Total']['TotalT3_AE']+$programme['Total']['TotalT4_AE'], 2, '.', ',')}}</td>
                    <td style=" font-weight: bold;">{{ number_format((float)$programme['Total']['TotalT1_CP']+$programme['Total']['TotalT2_CP']+$programme['Total']['TotalT3_CP'] +$programme['Total']['TotalT4_CP'], 2, '.', ',')}}</td-->
                    @else
                    
                    <td>{{ number_format((float)0, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)0, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)0, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)0, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)0, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)0, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)0, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)0, 2, '.', ',') }}</td>

                    <!--td style=" font-weight: bold;">{{ number_format((float)0, 2, '.', ',')}}</td>
                    <td style=" font-weight: bold;">{{ number_format((float)0, 2, '.', ',')}}</td-->
                    @endif
                    </tr>

                    {{-- Boucle sur les sous-programmes --}}
                    @for($j = 0; $j < count($programme['sous_programmes']); $j++)
                        @foreach ($programme['sous_programmes'][$j] as $sousProgramme)
                            @php
                                $code = explode('-', $sousProgramme['code']);
                                $last = count($code) - 1;
                                $code = $code[$last];
                            @endphp
                             @if(!isset($sousProgramme['actions'][0]))
                            <tr>
                                <td class="subprogram-title">{{ $code }}</td>
                                <td class="subprogram-title"> Sous Programme : {{ $sousProgramme['nom'] }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT1_AE_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT1_CP_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT2_AE_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT2_CP_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT3_AE_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT3_CP_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT4_AE_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT4_CP_ini'], 2, '.', ',') }}</td>
                            </tr>
                            @endif  
                            {{-- Boucle sur les actions --}}
                            @if(isset($sousProgramme['actions'][0]))
                                @for($k = 0; $k < count($sousProgramme['actions']); $k++)
                                    @foreach ($sousProgramme['actions'][$k] as $action)
                                        @php
                                            $code = explode('-', $action['code']);
                                            $last = count($code) - 1;
                                            $code = $code[$last];
                                            //dd($action);
                                        @endphp

                                        <tr >
                                            <td>{{ $code }}</td>
                                            <td>Action : {{ $action['nom'] }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['TotalT1_AE_ini'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['TotalT1_CP_ini'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['TotalT2_AE_ini'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['TotalT2_CP_ini'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['TotalT3_AE_ini'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['TotalT3_CP_ini'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['TotalT4_AE_ini'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['TotalT4_CP_ini'], 2, '.', ',') }}</td>
                                        </tr>

                                        {{-- Total des actions pour le sous-programme --}}
                                       
                                        <tr class="ttaction-title">
                                            <td class="ttaction-title"colspan="2">Total des actions</td>
                                            @php
                                            //dd($programme['sous_programmes'][0])
                                            @endphp
                                            @if(!empty($programme['sous_programmes']))
                                                <td  class="ttaction-title">{{ number_format((float)$programme['sous_programmes'][$j]['sous_programmes']['Total']['TotalT1_AE_ini'], 2, '.', ',') }}</td>
                                                <td  class="ttaction-title">{{ number_format((float)$programme['sous_programmes'][$j]['sous_programmes']['Total']['TotalT1_CP_ini'], 2, '.', ',') }}</td>
                                                <td  class="ttaction-title">{{ number_format((float)$programme['sous_programmes'][$j]['sous_programmes']['Total']['TotalT2_AE_ini'], 2, '.', ',') }}</td>
                                                <td  class="ttaction-title">{{ number_format((float)$programme['sous_programmes'][$j]['sous_programmes']['Total']['TotalT2_CP_ini'], 2, '.', ',') }}</td>
                                                <td  class="ttaction-title">{{ number_format((float)$programme['sous_programmes'][$j]['sous_programmes']['Total']['TotalT3_AE_ini'], 2, '.', ',') }}</td>
                                                <td  class="ttaction-title">{{ number_format((float)$programme['sous_programmes'][$j]['sous_programmes']['Total']['TotalT3_CP_ini'], 2, '.', ',') }}</td>
                                                <td  class="ttaction-title">{{ number_format((float)$programme['sous_programmes'][$j]['sous_programmes']['Total']['TotalT4_AE_ini'], 2, '.', ',') }}</td>
                                                <td  class="ttaction-title">{{ number_format((float)$programme['sous_programmes'][$j    ]['sous_programmes']['Total']['TotalT4_CP_ini'], 2, '.', ',') }}</td>
                                            @else
                                                <td class="ttaction-title" >0 </td>
                                                <td class="ttaction-title" >0</td>
                                                <td class="ttaction-title">0</td>
                                                <td class="ttaction-title">0</td>
                                                <td class="ttaction-title">0</td>
                                                <td class="ttaction-title">0</td>
                                                <td class="ttaction-title">0</td>
                                                <td class="ttaction-title">0</td>
                                            @endif
                                        </tr>
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
                                    @endforeach
                                    
                                @endfor
                              
                            @endif

                         
                        @endforeach
                    @endfor
                 
                           
                    {{-- Section "Eventuels crédits non répartis" --}}
                               

                    {{-- Total des actions/crédits ouverts pour le programme --}}
                    <tr class="totals">
                        <th class="totals" colspan="2">TOTAL ACTIONS/CREDITS OUVERTS</th>
                        @if(!empty($programme['Total']))
                        <td>{{ number_format((float)$programme['Total']['TotalT1_AE'], 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$programme['Total']['TotalT1_CP'], 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$programme['Total']['TotalT2_AE'], 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$programme['Total']['TotalT2_CP'], 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$programme['Total']['TotalT3_AE'], 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$programme['Total']['TotalT3_CP'], 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$programme['Total']['TotalT4_AE'], 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$programme['Total']['TotalT4_CP'], 2, '.', ',') }}</td>
                     
                        @else
                            <td >0 </td>
                            <td >0</td>
                            <td >0</td>
                            <td >0</td>
                            <td >0</td>
                            <td >0</td>
                            <td >0</td>
                            <td >0</td>
                        @endif
                    </tr>
                </tbody>
            </table>
            </div>
            {{-- Ajouter un espace entre les tableaux --}}
         
        @endforeach
    @endfor
</tbody>
</table>
<div class="page-break"> </div>
<h1 style="text-align: center; font-family: Cambria, sans-serif; font-size: 18pt; font-weight: bold;">
    2<span style="position: relative; top: -5px; font-size: 0.6em;">ème </span> PARTIE:
</h1>
<p style="font-family: Arial, sans-serif; font-size: 16pt; font-weight: bold; text-align: center;/*margin-left: 820px;*/"> 
LES EMPLOIS ET LES CREDITS BUDGETAIRES Y AFFERENTS
    </p>
    <table class="first-table">
    <thead>

        @foreach ($programmes as $programme)
            @foreach ($programme as $prog)
                @php
                    // Accéder au code du programme
                    $code = explode('-', $prog['code']);
                    $code = end($code);
                    //dd($programme );
                    $total_AE = 0;
                    $total_CP = 0;
                @endphp

             
                @if($prog['nom'] === 'Administration générale')
                    <tr>
                        <th style="text-align: center;">Code {{ $code }}</th>
                        <th style="text-align: center;">PROGRAMME {{$prog['nom']}}</th>
                        <th colspan="2" class="headt1" style="text-align: center;">T1</th>
                    </tr>
                    <tr>
                        <th class="headt1" style="text-align: center;">Code</th>
                        <th class="headt1" style="text-align: center;">LE PROGRAMME ET SES SOUS-PROGRAMMES</th>
                        <th style="text-align: center;">AE</th>
                        <th style="text-align: center;">CP</th>
                    </tr>

                    {{-- Boucle sur les sous-programmes --}}
                    @foreach ($prog['sous_programmes'] as $sousProgramme)
                          @foreach ($sousProgramme as $sousProgramme)
                        @php
                            // Accéder au code du sous-programme
                            $code_sous_prog = explode('-', $sousProgramme['code']);
                            $code_sous_prog = end($code_sous_prog);
                            $total_AE += $sousProgramme['Total']['TotalT1_AE_ini'];
                            $total_CP += $sousProgramme['Total']['TotalT1_CP_ini'];
                        @endphp

                  
                        @if($sousProgramme['nom'] === 'Soutien administratif' && !isset($sousProgramme['actions'][0]))
                            <tr style="text-align: center; ">
                                <td class="subprogram-title">{{ $code_sous_prog }}</td>
                                <td class="subprogram-title">Sous Programme : {{ $sousProgramme['nom'] }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT1_AE_ini'], 2, '.', ',') }}</td>
                                <td >{{ number_format((float)$sousProgramme['Total']['TotalT1_CP_ini'], 2, '.', ',') }}</td>
                            </tr>
                            <tr>
                
                <th colspan="2" class="headt1" style="text-align: center; ">TOTAL DES CREDITS DISPONIBLES</th>
                <td class="headt1" style="text-align: center; ">{{ number_format((float)$total_AE, 2, '.', ',') ?? 'N/A' }}</td>
                <td class="headt1" style="text-align: center; ">{{ number_format((float)$total_CP, 2, '.', ',') ?? 'N/A' }}</td>
            </tr>
                        @endif
                    @endforeach
                    @endforeach
                @endif
            @endforeach
        @endforeach
    </thead>
    <tbody>
        <!-- Le contenu des sous-programmes sera ici, à l'intérieur des lignes d'en-tête -->
    </tbody>
</table>



</html>
