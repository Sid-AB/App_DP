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
    
    <p> CREDITS DU PORTEFEUILLE DE PROGRAMMES ( 
    @for($i=0;$i< count($filcode);$i++)
    {{$filcode[$i]}} 
    @if ($i < count($filcode) - 1)
            + {{-- ajouter + pour separer les prgrms --}}
        @endif
    @endfor
    ):
    </p>
    </h1>
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
                    <td>{{ $programme['Total']['TotalT1_AE'] }}</td>
                    <td>{{ $programme['Total']['TotalT1_CP'] }}</td>
                    <td>{{ $programme['Total']['TotalT2_AE'] }}</td>
                    <td>{{ $programme['Total']['TotalT2_CP'] }}</td>
                    <td>{{ $programme['Total']['TotalT3_AE'] }}</td>
                    <td>{{ $programme['Total']['TotalT3_CP'] }}</td>
                    <td>{{ $programme['Total']['TotalT4_AE'] }}</td>
                    <td>{{ $programme['Total']['TotalT4_CP'] }}</td>

                    <td style=" font-weight: bold;">{{ $programme['Total']['TotalT1_AE']+$programme['Total']['TotalT2_AE']+ $programme['Total']['TotalT3_AE']+$programme['Total']['TotalT4_AE']}}</td>
                    <td style=" font-weight: bold;">{{$programme['Total']['TotalT1_CP']+$programme['Total']['TotalT2_CP']+$programme['Total']['TotalT3_CP'] +$programme['Total']['TotalT4_CP']}}</td>

                </tr>

                {{-- Boucle sur les sous-programmes --}}
                @for($j = 0 ; $j < count($programme['sous_programmes']) ; $j++ )
                @foreach ($programme['sous_programmes'][$j] as $sousProgramme)
                @php
                  $code =explode('-',$sousProgramme['code']);
                  $last =count($code)-1;
              //dd($code);
                  $code = $code[$last];
                  //dd($sousProgramme['Total']['TotalT4_CP_ini']);
                 @endphp
                    <tr class="subprogram-title">
                        <td>{{ $code }}</td>
                        <td >Sous Programme:{{ $sousProgramme['nom'] }}</td>
                        <td>{{ $sousProgramme['Total']['TotalT1_AE_ini'] }}</td>
                        <td>{{ $sousProgramme['Total']['TotalT1_CP_ini'] }}</td>
                        <td>{{ $sousProgramme['Total']['TotalT2_AE_ini'] }}</td>
                        <td>{{ $sousProgramme['Total']['TotalT2_CP_ini'] }}</td>
                        <td>{{ $sousProgramme['Total']['TotalT3_AE_ini'] }}</td>
                        <td>{{ $sousProgramme['Total']['TotalT3_CP_ini'] }}</td>
                        <td>{{ $sousProgramme['Total']['TotalT4_AE_ini'] }}</td>
                        <td>{{ $sousProgramme['Total']['TotalT4_CP_ini'] }}</td>

                        <td>{{ $sousProgramme['Total']['TotalT1_AE_ini']+$sousProgramme['Total']['TotalT2_AE_ini']+ $sousProgramme['Total']['TotalT3_AE_ini']+$sousProgramme['Total']['TotalT4_AE_ini']}}</td>
                        <td>{{  $sousProgramme['Total']['TotalT1_CP_ini'] +$sousProgramme['Total']['TotalT2_CP_ini']+$sousProgramme['Total']['TotalT3_CP_ini'] + $sousProgramme['Total']['TotalT4_CP_ini']}}</td>

                      
                    </tr>

                @endforeach
                @endfor
            @endforeach
            @endfor
           
           

        </tbody>
    </table>

</body>
</html>
