<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DPIC des programmes </title>
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
           padding: 14px ;
           text-align: center;
       
        }

        th {
           /* background-color: #DDD9C4; /* Couleur en-têtes */
            color: rgb(10, 10, 10);
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
        .T
        {
        background-color:#DDD9C4;
     
        }

        .head{
        background-color:#DCE6F1;
        font-weight: bold;
    }

    .vert3{
            background-color:#EBF1DE;
            font-weight: bold;
        }
    </style>
   
</head>
<body>
<h1 style="text-align: center; font-family: Times New Roman, sans-serif; font-size: 18pt; font-weight: bold;">
الجمهورية الجزائرية الديمقراطية الشعبية
</h1> 
<h1 style="text-align: center; font-family: Arial, sans-serif; font-size: 18pt; font-weight: bold;">
REPUBLIQUE ALGERIENNE DEMOCRATIQUE ET POPULAIRE
</h1> 
<p style="font-family: Arial, sans-serif; font-size: 1pt; font-weight: bold; margin-left: 40px;"> 
Ministère de la Communication
    </p>
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
            $filcode[$i] = $code[$last].' ';
            //dd($filcode);
    @endphp
    @endforeach
    @endfor
    
    <p style="font-family: Arial, sans-serif; font-size: 16pt; font-weight: bold;">1.1. LES CREDITS DU PORTEFEUILLE DE PROGRAMMES ( 
    @for($i=0;$i< count($filcode);$i++)
    {{$filcode[$i]}} 
    @if ($i < count($filcode) - 1)
            + {{-- ajouter + pour separer les prgrms --}}
        @endif
    @endfor
    ):
    </p>
    </h1>
    <h1 style="font-family: Arial, sans-serif; font-size: 14pt; font-weight: bold;">1.1.1. CREDITS OUVERTS PAR LA LOI DE FINANCES ET REPARTIS PAR LE DECRET DE REPARTITION :</h1>
    <table >
    
            <tr>
            <th  style="border: none; background: white; "   colspan="2" ></th>
                <th colspan="2" class="T">T1</th>
                <th colspan="2" class="T">T2</th>
                <th colspan="2" class="T">T3</th>
                <th colspan="2" class="T">T4</th>
                <th colspan="2" class="T">TOTAL</th>
            </tr>
            <tr>
                <th class="T">Code</th>
                <th class="T">LES PROGRAMME ET SES SOUS PROGRAMMES</th>
                <th style="text-align:center;  ">AE</th>
                <th style="text-align:center; ">CP</th>
                <th style="text-align:center;  ">AE</th>
                <th style="text-align:center; ">CP</th>
                <th style="text-align:center;  ">AE</th>
                <th style="text-align:center;  ">CP</th>
                <th style="text-align:center;">AE</th>
                <th style="text-align:center;  ">CP</th>
                <th style="text-align:center; ">AE</th>
                <th style="text-align:center; ">CP</th>
            </tr>
     
        <tbody>

            {{-- Boucle sur les programmes --}}
            @for($i=0;$i< count($programmes);$i++)
            @foreach ($programmes[$i] as $programme)
            @php
            $code =explode('-',$programme['code']);
            $last =count($code)-1;
            //dd($code);
            $code = $code[$last];
           
            @endphp
                <tr class="program-title" >
                    <td class="head">{{ $code }}</td>
                    <td class="head">Programme: {{ $programme['nom'] }}</td>
                    
                    @if(!empty($programme['Total']))
                   
                   
                    <td>{{ number_format((float)$programme['Total']['TotalT1_AE'], 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$programme['Total']['TotalT1_CP'], 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$programme['Total']['TotalT2_AE'], 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$programme['Total']['TotalT2_CP'], 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$programme['Total']['TotalT3_AE'], 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$programme['Total']['TotalT3_CP'], 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$programme['Total']['TotalT4_AE'], 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$programme['Total']['TotalT4_CP'], 2, '.', ',') }}</td>

                    <td style=" font-weight: bold;">{{ number_format((float)$programme['Total']['TotalT1_AE']+$programme['Total']['TotalT2_AE']+ $programme['Total']['TotalT3_AE']+$programme['Total']['TotalT4_AE'], 2, '.', ',')}}</td>
                    <td style=" font-weight: bold;">{{ number_format((float)$programme['Total']['TotalT1_CP']+$programme['Total']['TotalT2_CP']+$programme['Total']['TotalT3_CP'] +$programme['Total']['TotalT4_CP'], 2, '.', ',')}}</td>
                    @else
                    
                    <td>{{ number_format((float)0, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)0, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)0, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)0, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)0, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)0, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)0, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)0, 2, '.', ',') }}</td>

                    <td style=" font-weight: bold;">{{ number_format((float)0, 2, '.', ',')}}</td>
                    <td style=" font-weight: bold;">{{ number_format((float)0, 2, '.', ',')}}</td>
                    @endif
                </tr>
               
                {{-- Boucle sur les sous-programmes --}}
                @for($j = 0 ; $j < count($programme['sous_programmes']) ; $j++ )
                @foreach ($programme['sous_programmes'][$j] as $sousProgramme)
                @php
                  $code =explode('-',$sousProgramme['code']);
                  $last =count($code)-1;
                  //dd($programme['sous_programmes']);
              //dd($code);
                  $code = $code[$last];
                  //dd($sousProgramme['Total']['TotalT4_CP_ini']);
                  if (empty($sousProgramme['actions'])):
                 @endphp
                    <tr class="subprogram-title">
                        <td>{{ $code }}</td>
                        <td >Sous Programme:{{ $sousProgramme['nom'] }}</td>
                        <td>{{ number_format((float)$sousProgramme['Total']['TotalT1_AE_ini'], 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$sousProgramme['Total']['TotalT1_CP_ini'], 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$sousProgramme['Total']['TotalT2_AE_ini'], 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$sousProgramme['Total']['TotalT2_CP_ini'], 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$sousProgramme['Total']['TotalT3_AE_ini'], 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$sousProgramme['Total']['TotalT3_CP_ini'], 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$sousProgramme['Total']['TotalT4_AE_ini'], 2, '.', ',') }}</td>
                        <td>{{ number_format((float)$sousProgramme['Total']['TotalT4_CP_ini'], 2, '.', ',') }}</td>

                        <td>{{   number_format((float)$sousProgramme['Total']['TotalT1_AE_ini']+$sousProgramme['Total']['TotalT2_AE_ini']+ $sousProgramme['Total']['TotalT3_AE_ini']+$sousProgramme['Total']['TotalT4_AE_ini'], 2, '.', ',')}}</td>
                        <td>{{   number_format((float)$sousProgramme['Total']['TotalT1_CP_ini'] +$sousProgramme['Total']['TotalT2_CP_ini']+$sousProgramme['Total']['TotalT3_CP_ini'] + $sousProgramme['Total']['TotalT4_CP_ini'], 2, '.', ',')}}</td>

                      
                    </tr>
                @php
                endif;
                @endphp
                @endforeach
                @endfor
            @endforeach
            @endfor
            <tr >
                <th colspan="2">TOTAL (1) DES CREDITS OUVERTS PAR LA LOI DE FINANCES DE L'ANNEE POUR LE PORTEFUILLE </th>

                <td class="vert3">{{ number_format((float)$Ttportglob[0]['TotalPortT1_AE'], 2, '.', ',')}}</td>
                <td class="vert3">{{ number_format((float)$Ttportglob[0]['TotalPortT1_CP'], 2, '.', ',')}}</td>
                <td class="vert3">{{ number_format((float)$Ttportglob[0]['TotalPortT2_AE'], 2, '.', ',')}}</td>
                <td class="vert3">{{ number_format((float)$Ttportglob[0]['TotalPortT2_CP'], 2, '.', ',')}}</td>
                <td class="vert3"> {{ number_format((float)$Ttportglob[0]['TotalPortT3_AE'], 2, '.', ',')}}</td>
                <td class="vert3">{{ number_format((float)$Ttportglob[0]['TotalPortT3_CP'], 2, '.', ',')}}</td>
                <td class="vert3">{{ number_format((float)$Ttportglob[0]['TotalPortT4_AE'], 2, '.', ',')}}</td>
                <td class="vert3">{{ number_format((float)$Ttportglob[0]['TotalPortT4_CP'], 2, '.', ',')}}</td>

                <td class="vert3">{{number_format((float)$Ttportglob[0]['TotalPortT1_AE']+ $Ttportglob[0]['TotalPortT2_AE']+$Ttportglob[0]['TotalPortT3_AE']+$Ttportglob[0]['TotalPortT4_AE'], 2, '.', ',')}}</td>
                <td class="vert3">{{number_format((float)$Ttportglob[0]['TotalPortT1_CP']+$Ttportglob[0]['TotalPortT2_CP']+$Ttportglob[0]['TotalPortT3_CP']+$Ttportglob[0]['TotalPortT4_CP'], 2, '.', ',') }}</td>

            

            </tr>

           

        </tbody>
    </table>
    <div class="page-break"> </div>
    <h1 style="font-family: Arial, sans-serif; font-size: 14pt; font-weight: bold;"> 1.1.2. CREDITS ATTENDUS DEVENUS DISPONIBLES EN COURS D’ANNEE <?php echo date("Y"); ?> </h1>
    <table >
    
            <tr>
            <th  style="border: none; background: white; "   colspan="2" rowspan="2" ></th>
                <th colspan="2" class="T">T1</th>
                <th colspan="2" class="T">T2</th>
                <th colspan="2" class="T">T3</th>
                <th colspan="2" class="T">T4</th>
             
            </tr>
            <tr>
    
                <th style="text-align:center;  ">AE</th>
                <th style="text-align:center; ">CP</th>
                <th style="text-align:center;  ">AE</th>
                <th style="text-align:center; ">CP</th>
                <th style="text-align:center;  ">AE</th>
                <th style="text-align:center;  ">CP</th>
                <th style="text-align:center;">AE</th>
                <th style="text-align:center;  ">CP</th>
                
            </tr>
     
        <tbody>
            @php
                
                $total_AE_envoi_t1 = 0;
                $total_CP_envoi_t1 = 0;
                $total_AE_envoi_t2 = 0;
                $total_CP_envoi_t2 = 0;
                $total_AE_envoi_t3 = 0;
                $total_CP_envoi_t3 = 0;
                $total_AE_envoi_t4 = 0;
                $total_CP_envoi_t4 = 0;
            @endphp
        @foreach($art as $article)
            <tr >
                <td colspan="2">{{ $article->nom }}</td>
                @php
                    
                    $lastModif= $modif->firstWhere('nom', $article->nom);
                    //dd($article->nom);
                   //dd($lastModif->AE_envoi_t2);
            
                @endphp
                
                @if($lastModif)
            <td>
                @if(($lastModif->AE_envoi_t1) > 0 || ($lastModif->AE_envoi_t1) < 0)
                    {{ number_format((float)$lastModif->AE_envoi_t1 , 2, '.', ',') }}
                    @php $total_AE_envoi_t1 += $lastModif->AE_envoi_t1; @endphp
                @elseif(($lastModif->AE_recoit_t1) > 0 || ($lastModif->AE_recoit_t1) < 0)
                    {{ number_format((float)$lastModif->AE_recoit_t1 , 2, '.', ',') }}
                    @php $total_AE_envoi_t1 += $lastModif->AE_recoit_t1; @endphp
                @else
                    0
                @endif
            </td>
            <td>
                @if(($lastModif->CP_envoi_t1) > 0 || ($lastModif->CP_envoi_t1) < 0)
                    {{ number_format((float)$lastModif->CP_envoi_t1 , 2, '.', ',') }}
                    @php $total_CP_envoi_t1 += $lastModif->CP_envoi_t1; @endphp
                @elseif(($lastModif->CP_recoit_t1) > 0 || ($lastModif->CP_recoit_t1) < 0)
                    {{ number_format((float)$lastModif->CP_recoit_t1 , 2, '.', ',') }}
                    @php $total_CP_envoi_t1 += $lastModif->CP_recoit_t1; @endphp
                @else
                    0
                @endif
            </td>
            <td>
                @if(($lastModif->AE_envoi_t2) > 0 || ($lastModif->AE_envoi_t2) < 0)
                    {{ number_format((float)$lastModif->AE_envoi_t2  , 2, '.', ',')}}
                    @php $total_AE_envoi_t2 += $lastModif->AE_envoi_t2; @endphp
                @elseif(($lastModif->AE_recoit_t2) > 0 || ($lastModif->AE_recoit_t2) < 0)
                    {{number_format((float) $lastModif->AE_recoit_t2 , 2, '.', ',') }}
                    @php $total_AE_envoi_t2 += $lastModif->AE_recoit_t2; @endphp
                @else
                    0
                @endif
            </td>
            <td>
                @if(($lastModif->CP_envoi_t2) > 0 || ($lastModif->CP_envoi_t2) < 0)
                    {{ number_format((float)$lastModif->CP_envoi_t2 , 2, '.', ',') }}
                    @php $total_CP_envoi_t2 += $lastModif->CP_envoi_t2; @endphp
                @elseif(($lastModif->CP_recoit_t2) > 0 || ($lastModif->CP_recoit_t2) < 0)
                    {{ number_format((float)$lastModif->CP_recoit_t2 , 2, '.', ',') }}
                    @php $total_CP_envoi_t2 += $lastModif->CP_recoit_t2; @endphp
                @else
                    0
                @endif
            </td>
            <td>
                @if(($lastModif->AE_envoi_t3) > 0 || ($lastModif->AE_envoi_t3) < 0)
                    {{ number_format((float)$lastModif->AE_envoi_t3 , 2, '.', ',') }}
                    @php $total_AE_envoi_t3 += $lastModif->AE_envoi_t3; @endphp
                @elseif(($lastModif->AE_recoit_t3) > 0 || ($lastModif->AE_recoit_t3) < 0)
                    {{ number_format((float)$lastModif->AE_recoit_t3 , 2, '.', ',') }}
                    @php $total_AE_envoi_t3 += $lastModif->AE_recoit_t3; @endphp
                @else
                    0
                @endif
            </td>
            <td>
                @if(($lastModif->CP_envoi_t3) > 0 || ($lastModif->CP_envoi_t3) < 0)
                    {{ number_format((float)$lastModif->CP_envoi_t3 , 2, '.', ',') }}
                    @php $total_CP_envoi_t3 += $lastModif->CP_envoi_t3; @endphp
                @elseif(($lastModif->CP_recoit_t3) > 0 || ($lastModif->CP_recoit_t3) < 0)
                    {{number_format((float) $lastModif->CP_recoit_t3 , 2, '.', ',') }}
                    @php $total_CP_envoi_t3 += $lastModif->CP_recoit_t3; @endphp
                @else
                    0
                @endif
            </td>
            <td>
                @if(($lastModif->AE_envoi_t4) > 0 || ($lastModif->AE_envoi_t4) < 0)
                    {{ number_format((float)$lastModif->AE_envoi_t4 , 2, '.', ',') }}
                    @php $total_AE_envoi_t4 += $lastModif->AE_envoi_t4; @endphp
                @elseif(($lastModif->AE_recoit_t4) > 0 || ($lastModif->AE_recoit_t4) < 0)
                    {{ number_format((float)$lastModif->AE_recoit_t4 , 2, '.', ',')}}
                    @php $total_AE_envoi_t4 += $lastModif->AE_recoit_t4; @endphp
                @else
                    0
                @endif
            </td>
            <td>
                @if(($lastModif->CP_envoi_t4) > 0 || ($lastModif->CP_envoi_t4) < 0)
                    {{ number_format((float)$lastModif->CP_envoi_t4 , 2, '.', ',') }}
                    @php $total_CP_envoi_t4 += $lastModif->CP_envoi_t4; @endphp
                @elseif(($lastModif->CP_recoit_t4) > 0 || ($lastModif->CP_recoit_t4) < 0)
                    {{ number_format((float)$lastModif->CP_recoit_t4 , 2, '.', ',') }}
                    @php $total_CP_envoi_t4 += $lastModif->CP_recoit_t4; @endphp
                @else
                    0
                @endif
            </td>
                @else
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                @endif
            </tr>
        @endforeach

            <tr class="vert3">
                <th style=" width: 200px; "colspan="2" >TOTAL (2) POUR DES CREDITS ATTENDUS DEVENUS DISPONIBLES  POUR LE PORTEFEUILLE DE PROGRAMMES</th>
                <td>{{number_format((float) $total_AE_envoi_t1  , 2, '.', ',')}}</td>
                <td>{{ number_format((float)$total_CP_envoi_t1  , 2, '.', ',')}}</td>
                <td>{{ number_format((float)$total_AE_envoi_t2  , 2, '.', ',')}}</td>
                <td>{{ number_format((float)$total_CP_envoi_t2  , 2, '.', ',')}}</td>
                <td>{{ number_format((float)$total_AE_envoi_t3  , 2, '.', ',')}}</td>
                <td>{{ number_format((float)$total_CP_envoi_t3 , 2, '.', ',') }}</td>
                <td>{{ number_format((float)$total_AE_envoi_t4 , 2, '.', ',') }}</td>
                <td>{{ number_format((float)$total_CP_envoi_t4 , 2, '.', ',') }}</td>
            </tr>

        </tbody>
    </table>

    <table >
    
            <tr>
            <th  style="border: none;  "  class="T" colspan="2" rowspan="2" >RATTACHEMENT DES CREDITS ATTENDUS DEVENUS DISPONIBLES PAR PROGRAMME ET SOUS PROGRAMME</th>
                <th colspan="2" class="T">T1</th>
                <th colspan="2" class="T">T2</th>
                <th colspan="2" class="T">T3</th>
                <th colspan="2" class="T">T4</th>
              
            </tr>
            <tr>
               
                <th style="text-align:center;  ">AE</th>
                <th style="text-align:center; ">CP</th>
                <th style="text-align:center;  ">AE</th>
                <th style="text-align:center; ">CP</th>
                <th style="text-align:center;  ">AE</th>
                <th style="text-align:center;  ">CP</th>
                <th style="text-align:center;">AE</th>
                <th style="text-align:center;  ">CP</th>
               
            </tr>
     
        <tbody>
                @php
                $totalAE_t1 = $totalAE_t2 = $totalAE_t3 = $totalAE_t4 = 0;
                $totalCP_t1 = $totalCP_t2 = $totalCP_t3 = $totalCP_t4 = 0;
                @endphp

                {{-- Boucle sur les programmes --}}
                @for($i = 0; $i < count($programmes); $i++)
                    @foreach ($programmes[$i] as $programme)
                        @php
                            $code = explode('-', $programme['code']);
                            $last = count($code) - 1;
                            $code = $code[$last];
                        @endphp
                        <tr class="program-title">
                            <td class="head" colspan="2">Programme {{$code}} {{$programme['nom']}}</td>
                            @php
                                $totalprogAE = $totalprogCP = 0;
                            @endphp
                            @foreach(['t1', 't2', 't3', 't4'] as $key)
                                @php
                                    $tabsousprogrecoit = $result[$key]['tabsousprogrecoit'] ?? []; 
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

                        </tr>
                  
                        {{-- Boucle sur les sous-programmes --}}
                @for($j = 0; $j < count($programme['sous_programmes']); $j++)
                    @foreach ($programme['sous_programmes'][$j] as $sousProgramme)
                        @php
                            $code = explode('-', $sousProgramme['code']);
                            $last = count($code) - 1;
                            $code = $code[$last];
                        @endphp
                        
                        @if (empty($sousProgramme['actions']))
                            <tr class="subprogram-title">
                                <td colspan="2">Sous Programme {{ $code }} {{ $sousProgramme['nom'] }}</td>
                                
                              
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
                            </tr>
                        @endif
                    @endforeach
                @endfor

                
            @endforeach
            @endfor
            <tr class="vert3" >
                <th colspan="2" class="vert3">TOTAL (3) DES AUTRES CREDITS OUVERTS  POUR LE PORTEFEUILLE DES PROGRAMMES</th>
                
                <td>{{ number_format((float)$totalAE_t1, 2, '.', ',') }}</td>
                <td>{{ number_format((float)$totalCP_t1, 2, '.', ',') }}</td>
                <td>{{ number_format((float)$totalAE_t2, 2, '.', ',') }}</td>
                <td>{{ number_format((float)$totalCP_t2, 2, '.', ',') }}</td>
                <td>{{ number_format((float)$totalAE_t3, 2, '.', ',') }}</td>
                <td>{{ number_format((float)$totalCP_t3, 2, '.', ',' )}}</td>
                <td>{{ number_format((float)$totalAE_t4, 2, '.', ',') }}</td>
                <td>{{ number_format((float)$totalCP_t4, 2, '.', ',') }}</td>
            </tr>

           

        </tbody>
    </table>
    <div class="page-break"> </div>
    <h1 style=" font-family: Cambria, sans-serif; font-size: 14pt; font-weight: bold;"> NOUVELLE SITUATION (CREDITS OUVERTS + CREDITS DEVENUS DISPONIBLES) :</h1>
     <table >
    
            <tr>
            <th    class="vert3" colspan="2" rowspan="2" >LES CREDITS DISPONIBLES PAR PROGRAMME ET SOUS PROGRAMME</th>
                <th colspan="2" class="vert3">T1</th>
                <th colspan="2" class="vert3">T2</th>
                <th colspan="2" class="vert3">T3</th>
                <th colspan="2" class="vert3">T4</th>
              
            </tr>
            <tr>
               
                <th style="text-align:center;  ">AE</th>
                <th style="text-align:center; ">CP</th>
                <th style="text-align:center;  ">AE</th>
                <th style="text-align:center; ">CP</th>
                <th style="text-align:center;  ">AE</th>
                <th style="text-align:center;  ">CP</th>
                <th style="text-align:center;">AE</th>
                <th style="text-align:center;  ">CP</th>
               
            </tr>
     
        <tbody>
        @php
            $indiceProg = [];  //pour calculer nbr de prog les indices 1 2 3 etc pour le stocker dans total h1 
        @endphp
            {{-- Boucle sur les programmes --}}
           @php 
             $t1_ae = $t1_cp = $t2_ae = $t2_cp = $t3_ae = $t3_cp = $t4_ae = $t4_cp = 0;
           $total_t1_ae = $total_t1_cp = $total_t2_ae = $total_t2_cp = $total_t3_ae = $total_t3_cp = $total_t4_ae = $total_t4_cp = 0;
            @endphp
            @for($i=0;$i< count($programmes);$i++)
            @foreach ($programmes[$i] as $programme )
            @php
            $code =explode('-',$programme['code']);
            $last =count($code)-1;
            //dd($code);
         
          
            $code = $code[$last];
            $indiceProg[] = $i + 1;
           // dd($indiceProg);
            @endphp
                <tr class="program-title">
                    
                    <td class="head" colspan="2">Programme {{$code}} {{$programme['nom']}}</td>
                    @php
                  
                     if(!empty($progg))
                      {
                        foreach ($progg as $prog) {
                        
                            if ($prog['num_prog'] === $programme['code']) {
                                switch ($prog['tKey']) {
                                    case 't1':
                                    //dd($prog['valeur_prog_ae']);
                                        $t1_ae = $prog['valeur_prog_ae'];
                                        $t1_cp = $prog['valeur_prog_cp'];
                                        break;
                                    case 't2':
                                        $t2_ae = $prog['valeur_prog_ae'];
                                        $t2_cp = $prog['valeur_prog_cp'];
                                        break;
                                    case 't3':
                                        $t3_ae = $prog['valeur_prog_ae'];
                                        $t3_cp = $prog['valeur_prog_cp'];
                                        break;
                                    case 't4':
                                        $t4_ae = $prog['valeur_prog_ae'];
                                        $t4_cp = $prog['valeur_prog_cp'];
                                        break;
                                }
                            }
                         }
                        }
                        else
                        {
                            if(!empty($programme['Total']))
                            {
                        $t1_ae=$programme['Total']['TotalT1_AE'];
                        $t1_cp=$programme['Total']['TotalT1_CP'] ;
                        $t2_ae=$programme['Total']['TotalT2_AE'] ;
                        $t2_cp=$programme['Total']['TotalT2_CP'] ;
                        $t3_ae=$programme['Total']['TotalT3_AE'] ;
                        $t3_cp=$programme['Total']['TotalT3_CP'] ;
                        $t4_ae=$programme['Total']['TotalT4_AE'] ;
                        $t4_cp=$programme['Total']['TotalT4_CP'] ;
                            }
                        //dd( $programme['Total']['TotalT4_CP']);
                      }

                        $total_t1_ae += $t1_ae;
                        $total_t1_cp += $t1_cp;
                        $total_t2_ae += $t2_ae;
                        $total_t2_cp += $t2_cp;
                        $total_t3_ae += $t3_ae;
                        $total_t3_cp += $t3_cp;
                        $total_t4_ae += $t4_ae;
                        $total_t4_cp += $t4_cp;
                       
                    @endphp
                    <td>{{ number_format((float)$t1_ae, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$t1_cp, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$t2_ae, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$t2_cp, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$t3_ae, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$t3_cp, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$t4_ae, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$t4_cp, 2, '.', ',') }}</td>
                  
                </tr>

                {{-- Boucle sur les sous-programmes --}}
                @for($j = 0 ; $j < count($programme['sous_programmes']) ; $j++ )
                @foreach ($programme['sous_programmes'][$j] as $sousProgramme)
                @php
                  $code =explode('-',$sousProgramme['code']);
                  $last =count($code)-1;
                  //dd($programme['sous_programmes']);
              //dd($code);
                  $code = $code[$last];
                  //dd($sousProgramme['Total']['TotalT4_CP_ini']);
                  if (empty($sousProgramme['actions'])):
                    
                 @endphp
                    <tr class="subprogram-title">
                      
                        <td colspan="2">Sous Programme {{ $code }} {{ $sousProgramme['nom'] }}</td>
                        @php
                        $t1_ae_s = $t1_cp_s = $t2_ae_s = $t2_cp_s = $t3_ae_s = $t3_cp_s = $t4_ae_s = $t4_cp_s= 0;
                        if(!empty($progg)){
                        foreach ($progg as $prog) {
                            if ($prog['sous_programme'] === $sousProgramme['code']) {
                        switch ($prog['tKey']) {
                            case 't1':
                                $t1_ae_s = $prog['valeur_sous_prog_ae'];
                                $t1_cp_s = $prog['valeur_sous_prog_cp'];
                                break;
                            case 't2':
                                $t2_ae_s = $prog['valeur_sous_prog_ae'];
                                $t2_cp_s = $prog['valeur_sous_prog_cp'];
                                break;
                            case 't3':
                                $t3_ae_s = $prog['valeur_sous_prog_ae'];
                                $t3_cp_s = $prog['valeur_sous_prog_cp'];
                                break;
                            case 't4':
                                $t4_ae_s = $prog['valeur_sous_prog_ae'];
                                $t4_cp_s = $prog['valeur_sous_prog_cp'];
                                break;
                        }
                    }
                }
                }
                else
                {
                    $t1_ae_s=$sousProgramme['Total']['TotalT1_AE_ini'];
                    $t1_cp_s=$sousProgramme['Total']['TotalT1_CP_ini'] ;
                    $t2_ae_s=$sousProgramme['Total']['TotalT2_AE_ini'] ;
                    $t2_cp_s=$sousProgramme['Total']['TotalT2_CP_ini'] ;
                    $t3_ae_s=$sousProgramme['Total']['TotalT3_AE_ini'] ;
                    $t3_cp_s=$sousProgramme['Total']['TotalT3_CP_ini'] ;
                    $t4_ae_s=$sousProgramme['Total']['TotalT4_AE_ini'] ;
                    $t4_cp_s=$sousProgramme['Total']['TotalT4_CP_ini'] ;
                }
                      
                    @endphp
                    <td>{{ number_format((float)$t1_ae_s, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$t1_cp_s, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$t2_ae_s, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$t2_cp_s, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$t3_ae_s, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$t3_cp_s, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$t4_ae_s, 2, '.', ',') }}</td>
                    <td>{{ number_format((float)$t4_cp_s, 2, '.', ',') }}</td>
                        
                      
                    </tr>
                @php
                endif;
                @endphp
                @endforeach
                @endfor
            @endforeach
            @endfor
            <tr >
                <th colspan="2" class="vert3">TOTAL DES CREDITS DISPONIBLES POUR LE PROGRAMME ({{ implode(') + (', $indiceProg) }}) </th>
                <td class="vert3">{{ number_format((float)$total_t1_ae, 2, '.', ',')}}</td>
                <td class="vert3">{{ number_format((float)$total_t1_cp, 2, '.', ',')}}</td>
                <td class="vert3">{{ number_format((float)$total_t2_ae, 2, '.', ',')}}</td>
                <td class="vert3">{{ number_format((float)$total_t2_cp, 2, '.', ',')}}</td>
                <td class="vert3">{{ number_format((float)$total_t3_ae, 2, '.', ',')}}</td>
                <td class="vert3">{{ number_format((float)$total_t3_cp, 2, '.', ',')}}</td>
                <td class="vert3">{{ number_format((float)$total_t4_ae, 2, '.', ',')}}</td>
                <td class="vert3">{{ number_format((float)$total_t4_cp, 2, '.', ',')}}</td>
            </tr>

           

        </tbody>
    </table>

</body>
</html>
