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
    
    <p> 1.1. CREDITS DU PORTEFEUILLE DE PROGRAMMES ( 
    @for($i=0;$i< count($filcode);$i++)
    {{$filcode[$i]}} 
    @if ($i < count($filcode) - 1)
            + {{-- ajouter + pour separer les prgrms --}}
        @endif
    @endfor
    ):
    </p>
    </h1>
    <h1> 1.1.1. CREDITS OUVERTS PAR LA LOI DE FINANCES ET REPARTIS PAR LE DECRET DE REPARTITION :</h1>
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
                <tr  >
                    <td class="head">{{ $code }}</td>
                    <td class="head">Programme: {{ $programme['nom'] }}</td>
                    <td style=" font-weight: bold;">{{ number_format((float)$programme['Total']['TotalT1_AE'], 2, '.', ',')}}</td>
                    <td  style=" font-weight: bold;">{{ number_format((float)$programme['Total']['TotalT1_CP'], 2, '.', ',')}}</td>
                    <td  style=" font-weight: bold;">{{ number_format((float)$programme['Total']['TotalT2_AE'], 2, '.', ',')}}</td>
                    <td  style=" font-weight: bold;">{{ number_format((float)$programme['Total']['TotalT2_CP'], 2, '.', ',')}}</td>
                    <td style=" font-weight: bold;">{{ number_format((float)$programme['Total']['TotalT3_AE'], 2, '.', ',')}}</td>
                    <td style=" font-weight: bold;">{{ number_format((float)$programme['Total']['TotalT3_CP'], 2, '.', ',')}}</td>
                    <td style=" font-weight: bold;">{{ number_format((float)$programme['Total']['TotalT4_AE'], 2, '.', ',')}}</td>
                    <td style=" font-weight: bold;">{{ number_format((float)$programme['Total']['TotalT4_CP'], 2, '.', ',')}}</td>

                    <td style=" font-weight: bold;">{{ number_format((float)$programme['Total']['TotalT1_AE']+$programme['Total']['TotalT2_AE']+ $programme['Total']['TotalT3_AE']+$programme['Total']['TotalT4_AE'], 2, '.', ',')}}</td>
                    <td style=" font-weight: bold;">{{ number_format((float)$programme['Total']['TotalT1_CP']+$programme['Total']['TotalT2_CP']+$programme['Total']['TotalT3_CP'] +$programme['Total']['TotalT4_CP'], 2, '.', ',')}}</td>

                </tr>
                
                {{-- Boucle sur les sous-programmes --}}
                @for($j = 0 ; $j < count($programme['sous_programmes']) ; $j++ )
                @foreach ($programme['sous_programmes'][$j] as $sousProgramme)
                @php
                  $code =explode('-',$sousProgramme['code']);
                  $last =count($code)-1;
              //dd($code);
                  $code = $code[$last];
                 @endphp
                    <tr class="subprogram-title">
                        <td>{{ $code }}</td>
                        <td >Sous Programme:{{ $sousProgramme['nom'] }}</td>
                        <td>{{ number_format((float)$sousProgramme['Total']['TotalT1_AE'], 2, '.', ',')}}</td>
                        <td>{{ number_format((float)$sousProgramme['Total']['TotalT1_CP'], 2, '.', ',')}}</td>
                        <td>{{ number_format((float)$sousProgramme['Total']['TotalT2_AE'], 2, '.', ',')}}</td>
                        <td>{{ number_format((float)$sousProgramme['Total']['TotalT2_CP'], 2, '.', ',')}}</td>
                        <td>{{ number_format((float)$sousProgramme['Total']['TotalT3_AE'], 2, '.', ',')}}</td>
                        <td>{{ number_format((float)$sousProgramme['Total']['TotalT3_CP'], 2, '.', ',')}}</td>
                        <td>{{ number_format((float)$sousProgramme['Total']['TotalT4_AE'], 2, '.', ',')}}</td>
                        <td>{{ number_format((float)$sousProgramme['Total']['TotalT4_CP'], 2, '.', ',')}}</td>

                        <td>{{ number_format((float)$sousProgramme['Total']['TotalT1_AE']+$sousProgramme['Total']['TotalT2_AE']+ $sousProgramme['Total']['TotalT3_AE']+$sousProgramme['Total']['TotalT4_AE'], 2, '.', ',')}}</td>
                    <td>{{ number_format((float)$sousProgramme['Total']['TotalT1_CP']+$sousProgramme['Total']['TotalT2_CP']+$sousProgramme['Total']['TotalT3_CP'] +$sousProgramme['Total']['TotalT4_CP'], 2, '.', ',')}}</td>

                      
                    </tr>

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
                <td class="vert3">{{ number_format((float)$Ttportglob[0]['TotalPortT3_AE'], 2, '.', ',')}}</td>
                <td class="vert3">{{ number_format((float)$Ttportglob[0]['TotalPortT3_CP'], 2, '.', ',')}}</td>
                <td class="vert3">{{ number_format((float)$Ttportglob[0]['TotalPortT4_AE'], 2, '.', ',')}}</td>
                <td class="vert3">{{ number_format((float)$Ttportglob[0]['TotalPortT4_CP'], 2, '.', ',')}}</td>

                <td class="vert3">{{number_format((float)$Ttportglob[0]['TotalPortT1_AE']+ $Ttportglob[0]['TotalPortT2_AE']+$Ttportglob[0]['TotalPortT3_AE']+$Ttportglob[0]['TotalPortT4_AE'], 2, '.', ',')}}</td>
                <td class="vert3">{{number_format((float)$Ttportglob[0]['TotalPortT1_CP']+$Ttportglob[0]['TotalPortT2_CP']+$Ttportglob[0]['TotalPortT3_CP']+$Ttportglob[0]['TotalPortT4_CP'], 2, '.', ',') }}</td>

            

            </tr>

           
           

        </tbody>
    </table>

</body>
</html>
