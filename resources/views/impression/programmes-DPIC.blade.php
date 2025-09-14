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
<h1 style="text-align: center; font-family: Arial Narrow, sans-serif; font-size: 14pt; font-weight: bold;">
    1<span style="position: relative; top: -5px; font-size: 0.6em;">ERE</span> PARTIE:
</h1>
<p style="font-family: Arial Narrow, sans-serif; font-size: 14pt; font-weight: bold; text-align: center;/*margin-left: 820px;*/"> 
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
    <p style="font-family: Arial Narrow, sans-serif; font-size:14pt; font-weight: bold;"> 1.2. LA PROGRAMMTION DES CREDITS DES PROGRAMMES ( 
    @for($i=0;$i< count($filcode);$i++)
    {{$filcode[$i]}} 
    @if ($i < count($filcode) - 1)
            + {{-- ajouter + pour separer les prgrms --}}
        @endif
    @endfor
    ):
    </p>
   
    </h1>
    <h1 style="font-family: Arial Narrow, sans-serif; font-size: 14pt; font-weight: bold;"> 1.2.1. PROGRAMMATION DES CREDITS OUVERTS PAR LA LOI DE FINANCES ET REPARTIS PAR LE DECRET DE REPARTITION :</h1>
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
                               // dd($sousProgramme)
                            @endphp
                            <tr>
                                <td class="subprogram-title">{{ $code }}</td>
                                <td class="subprogram-title"> Sous Programme : {{ $sousProgramme['nom'] }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total_sp']['TotalT1_AE_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total_sp']['TotalT1_CP_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total_sp']['TotalT2_AE_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total_sp']['TotalT2_CP_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total_sp']['TotalT3_AE_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total_sp']['TotalT3_CP_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total_sp']['TotalT4_AE_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total_sp']['TotalT4_CP_ini'], 2, '.', ',') }}</td>
                            </tr>
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
                                   
                                    @endforeach
                                    
                                @endfor
                              
                                <tr class="ttaction-title">
                                    <td class="ttaction-title"colspan="2">Total des actions</td>
                                    @php
                                    //dd($programme['sous_programmes'][0])
                                    @endphp
                                    @if(!empty($programme['sous_programmes']))
                                        <td  class="ttaction-title">{{ number_format((float)$sousProgramme['Total_sp']['TotalT1_AE_ini'], 2, '.', ',') }}</td>
                                        <td  class="ttaction-title">{{ number_format((float)$sousProgramme['Total_sp']['TotalT1_CP_ini'], 2, '.', ',') }}</td>
                                        <td  class="ttaction-title">{{ number_format((float)$sousProgramme['Total_sp']['TotalT2_AE_ini'], 2, '.', ',') }}</td>
                                        <td  class="ttaction-title">{{ number_format((float)$sousProgramme['Total_sp']['TotalT2_CP_ini'], 2, '.', ',') }}</td>
                                        <td  class="ttaction-title">{{ number_format((float)$sousProgramme['Total_sp']['TotalT3_AE_ini'], 2, '.', ',') }}</td>
                                        <td  class="ttaction-title">{{ number_format((float)$sousProgramme['Total_sp']['TotalT3_CP_ini'], 2, '.', ',') }}</td>
                                        <td  class="ttaction-title">{{ number_format((float)$sousProgramme['Total_sp']['TotalT4_AE_ini'], 2, '.', ',') }}</td>
                                        <td  class="ttaction-title">{{ number_format((float)$sousProgramme['Total_sp']['TotalT4_CP_ini'], 2, '.', ',') }}</td>
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
                            @endif
                       

                         
                        @endforeach
                    @endfor
                 
                           
                    {{-- Section "Eventuels crédits non répartis" --}}
                               

                    {{-- Total des actions/crédits ouverts pour le programme --}}
                    <tr class="totals">
                        <th class="totals" colspan="2">TOTAL DES ACTIONS/CREDITS OUVERTS</th>
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
    <h1 style="font-family: Arial Narrow, sans-serif; font-size: 14pt; font-weight: bold;"> 1.2.2. PROGRAMMATION DES CREDITS ATTENDUS DEVENUS DISPONIBLES EN COURS D'ANNEE   <?php echo date("Y"); ?> </h1>
    <table >
    @php
               // dd($resulg);
                  $result = $resulg[0]['resulta'] ?? [];
              
                @endphp

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
                                   // dd( $tabsousprogrecoit);
                                    $tabsousprogretir = $result[$key]['tabsousprogretir'] ?? [];
                                 //  dd($tabsousprogretir);
                                 $valeurAE = $valeurCP = 0;
                                @endphp

                                {{-- Boucle sur tabsousprogrecoit --}}
                                @foreach($tabsousprogrecoit as $index => $item)
                               
                                    @if(isset($item['prog']) && $item['prog'] === $programme['code'])
                                 
                                        @php
                                            if (array_keys($item)[0] === 'valeurAE') {  
                                                $valeurAE += $item['valeurAE'] ?? $valeurAE;
                                            }
                                            if (array_keys($item)[0] === 'valeurCP') {  
                                                $valeurCP += $item['valeurCP'] ?? $valeurCP;
                                            }

                                           
                                        @endphp
                                        
                                    @endif
                                @endforeach
                             
                                {{-- Boucle sur tabsousprogretir --}}
                                @foreach($tabsousprogretir as $index => $item)
                               
                                @if(isset($item['prog']) && $item['prog'] === $programme['code'])
                               
                                        @php
                                            if (array_keys($item)[0] === 'valeurAE') { 
                                                $valeurAE += $item['valeurAE'] ??$valeurAE;
                                            }
                                            if (array_keys($item)[0] === 'valeurCP') { 
                                                $valeurCP += $item['valeurCP'] ?? $valeurCP;
                                            }

                                        @endphp
                                    @endif
                                @endforeach
                               
                                @php
                                    $totalprogAE += $valeurAE;
                                    $totalprogCP += $valeurCP;
                                    //dd($totalprogAE);
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
                                    $AE_recoit_Key='AE_recoit_'.$key;
                                    $CP_recoit_Key='CP_recoit_'.$key;
                                    $AE_envoi_Key='AE_envoi_'.$key;
                                    $CP_envoi_Key='CP_envoi_'.$key;

                                    if(!empty($result[$key])){
                                      //dd($result);
                                    foreach ($result[$key]['lastModif'] as $modif) 
                                    {
                                        # code...
                                    $valeurAEr=$modif->$AE_recoit_Key + $modif->$AE_envoi_Key;
                                    $valeurCPr=$modif->$CP_recoit_Key + $modif->$CP_envoi_Key;
                                     }
                                }
                                    //dd( $valeurAE,$valeurCP);
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
                                            if (array_keys($item)[0] === 'valeurAE') { 
                                                $valeurAE += $item['valeurAE'] ?? 0;
                                            }
                                            if (array_keys($item)[0] === 'valeurCP') { 
                                                $valeurCP += $item['valeurCP'] ?? 0;
                                            }
                                        @endphp
                                        @endif
                                    @endforeach

                                    {{-- Vérification de tabsousprogretir --}}
                                    @foreach($tabsousprogretir as $index => $item)
                                        @if($item['prog'] === $programme['code'] && $item['num_sous_prog'] === $sousProgramme['code'])
                                        @php
                                            if (array_keys($item)[0] === 'valeurAE') { 
                                                $valeurAE += $item['valeurAE'] ?? 0;
                                            }
                                            if (array_keys($item)[0] === 'valeurCP') { 
                                                $valeurCP += $item['valeurCP'] ?? 0;
                                            }
                                        @endphp
                                        @endif
                                    @endforeach

                                    @php
                                    $AE_recoit_Key='AE_recoit_'.$key;
                                    $CP_recoit_Key='CP_recoit_'.$key;
                                    $AE_envoi_Key='AE_envoi_'.$key;
                                    $CP_envoi_Key='CP_envoi_'.$key;

                                    if(!empty($result[$key])){
                                    foreach ($result[$key]['lastModif'] as $modif) {
                                        # code...  
                                    $valeurAEsr=$modif->$AE_recoit_Key + $modif->$AE_envoi_Key;
                                    $valeurCPsr=$modif->$CP_recoit_Key + $modif->$CP_envoi_Key;
                                    }
                                  }
                                    //dd( $valeurAE,$valeurCP);
                                    @endphp
                                    {{-- Affichage des valeurs --}}
                                    <td>{{ number_format((float)$valeurAE  , 2, '.', ',')}}</td>
                                    <td>{{ number_format((float)$valeurCP, 2, '.', ',') }}</td>
                                @endforeach
                              {{--  <!--td>{{ number_format((float)$sousProgramme['Total']['TotalT1_AE_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT1_CP_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT2_AE_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT2_CP_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT3_AE_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT3_CP_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT4_AE_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT4_CP_ini'], 2, '.', ',') }}</td-->--}}
                            </tr>
                           
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
                                            if (array_keys($item)[0] === 'valeurAE') { 
                                                $valeurAE += $item['valeurAE'] ?? 0;
                                            }
                                            if (array_keys($item)[0] === 'valeurCP') { 
                                                $valeurCP += $item['valeurCP'] ?? 0;
                                            }
                                        @endphp
                                        @endif
                                    @endforeach

                                    {{-- Vérification de tabsousprogretir --}}
                                    @foreach($tabsousprogretir as $index => $item)
                                        @if($item['prog'] === $programme['code'] && $item['num_sous_prog'] === $sousProgramme['code'] && $item['num_action'] === $action['code'])
                                        @php
                                            if (array_keys($item)[0] === 'valeurAE') { 
                                                $valeurAE += $item['valeurAE'] ?? 0;
                                            }
                                            if (array_keys($item)[0] === 'valeurCP') { 
                                                $valeurCP += $item['valeurCP'] ?? 0;
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
                                           {{-- <!--td>{{ number_format((float)$action['TotalT']['TotalT1_AE_ini'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['TotalT1_CP_ini'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['TotalT2_AE_ini'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['TotalT2_CP_ini'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['TotalT3_AE_ini'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['TotalT3_CP_ini'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['TotalT4_AE_ini'], 2, '.', ',') }}</td>
                                            <td>{{ number_format((float)$action['TotalT']['TotalT4_CP_ini'], 2, '.', ',') }}</td-->--}}
                                        </tr>

                                  
                                       
                                        {{-- Total des actions pour le sous-programme --}}
                                       
                                       
                                   @endforeach
                                   
                               @endfor
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
                           @endif

                        
                       @endforeach
                   @endfor
                
                          
                   {{-- Section "Eventuels crédits non répartis" --}}
                              

                   {{-- Total des actions/crédits ouverts pour le programme --}}
                   <tr class="totals">
                       <th class="totals" colspan="2">TOTAL DES ACTIONS/CREDITS OUVERTS</th>
                       @if(!empty($programme['Total']))
                        <td>{{ number_format((float)$totalactAE_t1, 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$totalactCP_t1, 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$totalactAE_t2, 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$totalactCP_t2, 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$totalactAE_t3, 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$totalactCP_t3, 2, '.', ',' )}}</td>
                        <td>{{ number_format((float)$totalactAE_t4, 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$totalactCP_t4, 2, '.', ',') }}</td>
                            
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
<h1 style=" font-family: Arial Narrow, sans-serif; font-size: 14pt; font-weight: bold;"> 1.2.3. PROGRAMMATION DES CREDITS DISPONIBLES (CREDITS OUVERTS + CREDITS ATTENDUS DEVENUS DISPONIBLES) :</h1>

@php
    use Illuminate\Support\Facades\DB;
    $indiceProg = []; 
@endphp
         
           
                @if(isset($prgrmsousact) && count($prgrmsousact) > 0)
               
                    {{-- Ligne principale pour le programme --}}
                    <tr class="program-title">
                    @foreach($prgrmsousact as $programme)
                    @php
                        $code =explode('-',$programme['num_prog']);
                        $last =count($code)-1;
                        //dd($code);
                        $total_t1_ae = 0;
                        $total_t1_cp = 0;
                        $total_t2_ae = 0;
                        $total_t2_cp = 0;
                        $total_t3_ae = 0;
                        $total_t3_cp = 0;
                        $total_t4_ae = 0;
                        $total_t4_cp = 0;
                                    
                        $code = $code[$last];
                        $indiceProg[] = count($indiceProg) + 1;
                        //dd($indiceProg);
                    @endphp
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
              
                    <tr class="program-title">
                    <td class="program-title" >{{ $code }}</td>
                        <td class="program-title">Programme :  {{ $programme['nom_prog']}}</td>

                        <td>{{ number_format($programme['total_AE_init_t1'], 2, ',', ' ') }}</td>
                        <td>{{ number_format($programme['total_CP_init_t1'], 2, ',', ' ') }}</td>
                        <td>{{ number_format($programme['total_AE_init_t2'], 2, ',', ' ') }}</td>
                        <td>{{ number_format($programme['total_CP_init_t2'], 2, ',', ' ') }}</td>
                        <td>{{ number_format($programme['total_AE_init_t3'], 2, ',', ' ') }}</td>
                        <td>{{ number_format($programme['total_CP_init_t3'], 2, ',', ' ') }}</td>
                        <td>{{ number_format($programme['total_AE_init_t4'], 2, ',', ' ') }}</td>
                        <td>{{ number_format($programme['total_CP_init_t4'], 2, ',', ' ') }}</td>
                    </tr>

                    @foreach ($programme['sous_programmes'] as $sous_programme)
                            @php
                                $code =explode('-',$sous_programme['num_sous_prog']);
                                $last =count($code)-1;
                                //dd($programme['sous_programmes']);
                                //dd($sous_programme);
                                $code = $code[$last];
                                //dd($code);
                            @endphp
                        <tr class="subprogram-title">
                        <td class="subprogram-title">{{ $code }}</td>
                        <td class="subprogram-title"> Sous Programme : {{ $sous_programme['nom_sous_prog']}}</td>
                      
                        <td>{{ number_format($sous_programme['AE_init_t1'], 2, ',', ' ') }}</td>
                        <td>{{ number_format($sous_programme['CP_init_t1'], 2, ',', ' ') }}</td>
                        <td>{{ number_format($sous_programme['AE_init_t2'], 2, ',', ' ') }}</td>
                        <td>{{ number_format($sous_programme['CP_init_t2'], 2, ',', ' ') }}</td>
                        <td>{{ number_format($sous_programme['AE_init_t3'], 2, ',', ' ') }}</td>
                        <td>{{ number_format($sous_programme['CP_init_t3'], 2, ',', ' ') }}</td>
                        <td>{{ number_format($sous_programme['AE_init_t4'], 2, ',', ' ') }}</td>
                        <td>{{ number_format($sous_programme['CP_init_t4'], 2, ',', ' ') }}</td>
                    </tr>
                
                           
                            {{-- Boucle sur les actions --}}
                            @foreach ($sous_programme['actions'] as $action)
                            @php
                                $code =explode('-', $action->num_action);
                                $last =count($code)-1;
                                
                                //dd($code);
                                $code = $code[$last];
                                $nomAction = DB::table('actions')
                                        ->where('num_action', $action->num_action)
                                        ->value('nom_action');
                            @endphp
                    <tr class="action-title">
                    <td>{{ $code }}</td>
                    <td>Action : {{ $nomAction }}</td>
                   
                    <td>{{ number_format($action->AE_init_t1, 2, ',', ' ') }}</td>
                    <td>{{ number_format($action->CP_init_t1, 2, ',', ' ') }}</td>
                    <td>{{ number_format($action->AE_init_t2, 2, ',', ' ') }}</td>
                    <td>{{ number_format($action->CP_init_t2, 2, ',', ' ') }}</td>
                    <td>{{ number_format($action->AE_init_t3, 2, ',', ' ') }}</td>
                    <td>{{ number_format($action->CP_init_t3, 2, ',', ' ') }}</td>
                    <td>{{ number_format($action->AE_init_t4, 2, ',', ' ') }}</td>
                    <td>{{ number_format($action->CP_init_t4, 2, ',', ' ') }}</td>
                </tr>
                @endforeach
        
                              
                    <tr class="ttaction-title">
                        <td class="ttaction-title"colspan="2">Total des actions</td>
                        <td class="ttaction-title">{{ number_format($sous_programme['total_act_AE_t1'], 2, ',', ' ') }}</td>
                        <td class="ttaction-title">{{ number_format($sous_programme['total_act_CP_t1'], 2, ',', ' ') }}</td>
                        <td class="ttaction-title">{{ number_format($sous_programme['total_act_AE_t2'], 2, ',', ' ') }}</td>
                        <td class="ttaction-title">{{ number_format($sous_programme['total_act_CP_t2'], 2, ',', ' ') }}</td>

                        <td class="ttaction-title">{{ number_format($sous_programme['total_act_AE_t3'], 2, ',', ' ') }}</td>
                        <td class="ttaction-title">{{ number_format($sous_programme['total_act_CP_t3'], 2, ',', ' ') }}</td>
                        <td class="ttaction-title">{{ number_format($sous_programme['total_act_AE_t4'], 2, ',', ' ') }}</td>
                        <td class="ttaction-title">{{ number_format($sous_programme['total_act_CP_t4'], 2, ',', ' ') }}</td>
  
                     </tr>
            @endforeach
   
                               
                    @php
                    
                        $total_t1_ae += $programme['total_AE_init_t1'];
                        $total_t1_cp += $programme['total_CP_init_t1'];
                        $total_t2_ae += $programme['total_AE_init_t2'];
                        $total_t2_cp += $programme['total_CP_init_t2'];
                        $total_t3_ae += $programme['total_AE_init_t3'];
                        $total_t3_cp += $programme['total_CP_init_t3'];
                        $total_t4_ae += $programme['total_AE_init_t4'];
                        $total_t4_cp += $programme['total_CP_init_t4'];
                    @endphp
                    </tbody>
                    {{-- Total des actions/crédits ouverts pour le programme --}}
                    <tr class="totals">
                        <th class="totals" colspan="2">TOTAL ACTIONS/CREDITS DISPONIBLES</th>
               
                       
                        <td >{{ number_format((float)$total_t1_ae, 2, '.', ',')}}</td>
                        <td >{{ number_format((float)$total_t1_cp, 2, '.', ',')}}</td>
                        <td >{{ number_format((float)$total_t2_ae, 2, '.', ',')}}</td> 
                        <td >{{ number_format((float)$total_t2_cp, 2, '.', ',')}}</td>
                        <td >{{ number_format((float)$total_t3_ae, 2, '.', ',')}}</td>
                        <td >{{ number_format((float)$total_t3_cp, 2, '.', ',')}}</td>
                        <td>{{ number_format((float)$total_t4_ae, 2, '.', ',')}}</td>
                        <td>{{ number_format((float)$total_t4_cp, 2, '.', ',')}}</td>
                    </tr>
                    </table>
                @endforeach
                @else 
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
                           
                            <tr>
                                <td class="subprogram-title">{{ $code }}</td>
                                <td class="subprogram-title"> Sous Programme : {{ $sousProgramme['nom'] }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total_sp']['TotalT1_AE_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total_sp']['TotalT1_CP_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total_sp']['TotalT2_AE_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total_sp']['TotalT2_CP_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total_sp']['TotalT3_AE_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total_sp']['TotalT3_CP_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total_sp']['TotalT4_AE_ini'], 2, '.', ',') }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total_sp']['TotalT4_CP_ini'], 2, '.', ',') }}</td>
                            </tr>
                           
                            {{-- Boucle sur les actions --}}
                            @if(isset($sousProgramme['actions'][0]))
                                @for($k = 0; $k < count($sousProgramme['actions']); $k++)
                                    @foreach ($sousProgramme['actions'][$k] as $action)
                                        @php
                                            $code = explode('-', $action['code']);
                                            $last = count($code) - 1;
                                            $code = $code[$last];
                                            //dd($result);
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
                                       
                                    @endforeach
                                    
                                @endfor
                              
                                <tr class="ttaction-title">
                                    <td class="ttaction-title"colspan="2">Total des actions</td>
                                    @php
                                    //dd($programme['sous_programmes'][0])
                                    @endphp
                                    @if(!empty($programme['sous_programmes']))
                                        <td  class="ttaction-title">{{ number_format((float)$sousProgramme['Total_sp']['TotalT1_AE_ini'], 2, '.', ',') }}</td>
                                        <td  class="ttaction-title">{{ number_format((float)$sousProgramme['Total_sp']['TotalT1_CP_ini'], 2, '.', ',') }}</td>
                                        <td  class="ttaction-title">{{ number_format((float)$sousProgramme['Total_sp']['TotalT2_AE_ini'], 2, '.', ',') }}</td>
                                        <td  class="ttaction-title">{{ number_format((float)$sousProgramme['Total_sp']['TotalT2_CP_ini'], 2, '.', ',') }}</td>
                                        <td  class="ttaction-title">{{ number_format((float)$sousProgramme['Total_sp']['TotalT3_AE_ini'], 2, '.', ',') }}</td>
                                        <td  class="ttaction-title">{{ number_format((float)$sousProgramme['Total_sp']['TotalT3_CP_ini'], 2, '.', ',') }}</td>
                                        <td  class="ttaction-title">{{ number_format((float)$sousProgramme['Total_sp']['TotalT4_AE_ini'], 2, '.', ',') }}</td>
                                        <td  class="ttaction-title">{{ number_format((float)$sousProgramme['Total_sp']['TotalT4_CP_ini'], 2, '.', ',') }}</td>
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
                                
                            @endif

                         
                        @endforeach
                    @endfor
                 
                           
                    {{-- Section "Eventuels crédits non répartis" --}}
                               

                    {{-- Total des actions/crédits ouverts pour le programme --}}
                    <tr class="totals">
                        <th class="totals" colspan="2">TOTAL DES ACTIONS/CREDITS DISPONIBLES</th>
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
   </table>
   @endif
<div class="page-break"> </div>
<h1 style="text-align: center; font-family: Cambria (Titres), sans-serif; font-size: 20pt; font-weight: bold;">
    2<span style="position: relative; top: -5px; font-size: 0.6em;">ème </span> PARTIE:
</h1>
<p style="font-family: Cambria (Titres), sans-serif; font-size: 20pt; font-weight: bold; text-align: center;/*margin-left: 820px;*/"> 
LES EMPLOIS ET LES CREDITS BUDGETAIRES Y AFFERENTS
    </p>
    <table class="first-table">
   
 
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

             
                @if($prog['nom'] === 'Administration Générale')
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
                    @foreach ($prog['sous_programmes'] as $programme)
   
                        @php
                            $sousProgramme = $programme['sous_programmes'];
                            //dd( $sousProgramme);
                            $code_sous_prog = explode('-', $sousProgramme['code']);
                            $code_sous_prog = end($code_sous_prog);
                            //dd( $code_sous_prog);
                            $total_AE += $sousProgramme['Total']['TotalT1_AE'];
                            $total_CP += $sousProgramme['Total']['TotalT1_CP'];
                           // dd( $total_AE,$total_CP);
                        @endphp
                        @if ($sousProgramme['nom'] === 'Soutien Administratif')
                            <tr style="text-align: center; ">
                                <td class="subprogram-title">{{ $code_sous_prog }}</td>
                                <td class="subprogram-title">Sous Programme : {{ $sousProgramme['nom'] }}</td>
                                <td>{{ number_format((float)$sousProgramme['Total']['TotalT1_AE'], 2, '.', ',') }}</td>
                                <td >{{ number_format((float)$sousProgramme['Total']['TotalT1_CP'], 2, '.', ',') }}</td>
                            </tr>

                            @endif
                @endforeach    
              
                            <tr>
                           
                <th colspan="2" class="headt1" style="text-align: center; ">TOTAL DES CREDITS DISPONIBLES</th>
                <td class="headt1" style="text-align: center; font-weight: bold; ">{{ number_format((float)$total_AE, 2, '.', ',') ?? 0.00 }}</td>
                <td class="headt1" style="text-align: center; font-weight: bold; ">{{ number_format((float)$total_CP, 2, '.', ',') ?? 0.00 }}</td>
            </tr>
                        
                   
               
                @endif
            @endforeach
        @endforeach

    <tbody>
        
    </tbody>
</table>



</html>
