<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau CREDITS 088 </title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
<link href="{{asset('assets/css/main.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/jquery.dataTables.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/bootstrap-5.0.2/css/bootstrap.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/fontawesome-free/css/all.css')}}" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
<link
        rel="stylesheet"
        href="https://unpkg.com/@patternfly/patternfly/patternfly.css"
        crossorigin="anonymous"
      >
    <style>
        table {
            background-color:#ffffff00;  
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
        table tbody
        {
            background-color:#fff; 
        }

        th {
           /* background-color: #DDD9C4; /* Couleur en-têtes */
            color: rgb(10, 10, 10);
        }

       
        tr:nth-child(even) {
            background-color: #fff; /* Ligne alternative */
        }
        tr.selected {
        background-color:rgb(255, 237, 79) !important;
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
            font-size: 1.2em;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2em;
            margin-bottom: 30px;
        }
        
        #ModiftT_wrapper
        {
            background-color: white;
            
          padding: 10px;
}
        
    </style>

</head>
<body>
@include('side_bar.side-barV1') 
    <h1>
        @for($i=0;$i< count($programmes);$i++)
        @foreach ($programmes[$i] as $programme)
        @php
                $code =explode('-',$programme['code']);
                $last =count($code)-1;
            // dd($code);
                $filcode[$i] = '0'.$code[$last].' ';
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
            <table >
                <thead>
                    <tr>
                        <th  style="border: none; background: #ffffff00;"  colspan=2></th>
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
                </thead>
                <tbody>
                    {{-- Ligne principale pour le programme --}}
                    <tr >
                        <td class="program-title" >{{ '0' .$code }}</td>
                        <td class="program-title">Programme :  {{ $programme['nom'] }}</td>
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

                            <tr>
                                <td class="subprogram-title">{{ $code }}</td>
                                <td class="subprogram-title"> Sous Programme : {{ $sousProgramme['nom'] }}</td>
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
                                            $last = count($code) -2;
                                            $code = $code[$last];
                                           // dd($action);
                                        @endphp
                                        @if($action['type_action']=='centrale')
                                        <tr >
                                            <td>{{ $code }}</td>
                                            <td>Action : {{ $action['nom'] }}</td>
                                            <td>{{ $action['TotalT']['centrale']['T1']['total'][0]['values']['totalAE'] }}</td>
                                            <td>{{ $action['TotalT']['centrale']['T1']['total'][0]['values']['totalCP'] }}</td>
                                            <td>{{ $action['TotalT']['centrale']['T2']['total'][0]['values']['totalAE'] }}</td>
                                            <td>{{ $action['TotalT']['centrale']['T2']['total'][0]['values']['totalCP'] }}</td>
                                            <td>{{ $action['TotalT']['centrale']['T3']['total'][0]['values']['totalAE'] }}</td>
                                            <td>{{ $action['TotalT']['centrale']['T3']['total'][0]['values']['totalCP'] }}</td>
                                            <td>{{ $action['TotalT']['centrale']['T4']['total'][0]['values']['totalAE'] }}</td>
                                            <td>{{ $action['TotalT']['centrale']['T4']['total'][0]['values']['totalCP'] }}</td>
                                        </tr>
                                        @elseif ($action['type_action']=='delegation')
                                        <tr >
                                            <td>{{ $code }}</td>
                                            <td>Action : {{ $action['nom'] }}</td>
                                            <td>{{ $action['TotalT']['delegation']['T1']['total'][0]['values']['totalAE'] }}</td>
                                            <td>{{ $action['TotalT']['delegation']['T1']['total'][0]['values']['totalCP'] }}</td>
                                            <td>{{ $action['TotalT']['delegation']['T2']['total'][0]['values']['totalAE'] }}</td>
                                            <td>{{ $action['TotalT']['delegation']['T2']['total'][0]['values']['totalCP'] }}</td>
                                            <td>{{ $action['TotalT']['delegation']['T3']['total'][0]['values']['totalAE'] }}</td>
                                            <td>{{ $action['TotalT']['delegation']['T3']['total'][0]['values']['totalCP'] }}</td>
                                            <td>{{ $action['TotalT']['delegation']['T4']['total'][0]['values']['totalAE'] }}</td>
                                            <td>{{ $action['TotalT']['delegation']['T4']['total'][0]['values']['totalCP'] }}</td>
                                        </tr>
                                        @endif
                                    @endforeach
                             
                                @endfor
                            @endif

                            {{-- Total des actions pour le sous-programme --}}
                            <tr class="ttaction-title">
                                <td class="ttaction-title"colspan="2">Total des actions</td>
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



    <!--<< at tis point start the dataTables js -->

        <div clas="Modift-handle">
            <table class="table" id="ModiftT">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Programme destinataire</th>
                        <th>Sous programme destinataire</th>
                        <th>Action destinataire</th>
                        <th>code T</th>
                        <th>T1 AE</th>
                        <th>T1 CP</th>
                        <th>T2 AE</th>
                        <th>T2 CP</th>
                        <th>T3 AE</th>
                        <th>T3 CP</th>
                        <th>T4 AE</th>
                        <th>T4 CP</th>
                        <th>type modif</th>
                        <th>Programme source</th>
                        <th>Sous programme source</th>
                        <th>Action source</th>
                        <!--th>situation modif</th-->
                        <th>Date modif </th>
                       
                    </tr>
                </thead>

                <tbody>
                   
                        @for($i=0;$i< count($moficat_program); $i++)
                        @php
                                $code = explode('-', $moficat_program[$i]['code_prog']);
                                //dd($code)
                                $last = count($code) - 1;
                                $code = $code[$last];
                                //dd($code);
                        @endphp
                            @for($j=0;$j< count($moficat_program[$i]['reslut']); $j++)
                         
                            @php
                                $codesp = explode('-', $moficat_program[$i]['reslut'][$j]['num_sous_prog']);
                                //dd($codesp)
                                $last = count($codesp) - 1;
                                $codesp = $codesp[$last];
                                //dd($codesp);

                                $codeA = explode('-',$moficat_program[$i]['reslut'][$j]['num_sous_action']);
                                //dd($codeA)
                                $last = count($codeA) - 1;
                                $codeA = $codeA[$last];
                                //dd($codeA);

                                $codepR = explode('-', $moficat_program[$i]['reslut'][$j]['num_prog_retire']);
                                $last = count($codepR) - 1;
                                $codepR = $codepR[$last];
                             
                                $codespR = explode('-', $moficat_program[$i]['reslut'][$j]['num_sous_prog_retire']);
                                $last = count($codespR) - 1;
                                $codespR = $codespR[$last];
                             

                                $codeAR= explode('-',$moficat_program[$i]['reslut'][$j]['num_sous_action_retire']);
                                $last = count($codeAR) - 1;
                                $codeAR = $codeAR[$last];
                        
                        @endphp
                         
                            <tr id="{{$moficat_program[$i]['code_prog']}}">
                            <th>{{$j}}</th>
                            <th>{{$code}} </th>
                           <th>{{$codesp}}</th>
                           <th>{{$codeA}}</th>
                            <th>{{$moficat_program[$i]['reslut'][$j]['code_t1'].'-'.
                                $moficat_program[$i]['reslut'][$j]['code_t2'].'-'.
                                $moficat_program[$i]['reslut'][$j]['code_t3'].'-'.
                                $moficat_program[$i]['reslut'][$j]['code_t4']    
                            }} </th>
                            <th>{{$moficat_program[$i]['reslut'][$j]['AE_recoit_t1']}} </th>
                            <th>{{$moficat_program[$i]['reslut'][$j]['CP_recoit_t1']}} </th>
                            <th>{{$moficat_program[$i]['reslut'][$j]['AE_recoit_t2']}} </th>
                            <th>{{$moficat_program[$i]['reslut'][$j]['CP_recoit_t2']}} </th>
                            <th>{{$moficat_program[$i]['reslut'][$j]['AE_recoit_t3']}} </th>
                            <th>{{$moficat_program[$i]['reslut'][$j]['CP_recoit_t3']}} </th>
                            <th>{{$moficat_program[$i]['reslut'][$j]['AE_recoit_t4']}} </th>
                            <th>{{$moficat_program[$i]['reslut'][$j]['CP_recoit_t4']}} </th>
                            <th>{{$moficat_program[$i]['reslut'][$j]['type_modif']}} </th>
                            <th id="">{{$codepR}} </th>
                            <th>{{$codespR}}</th>
                            <th>{{$codeAR}} </th>
                            <!--th>{{$moficat_program[$i]['reslut'][$j]['situation_modif']}} </th-->
                            <th>{{$moficat_program[$i]['reslut'][$j]['date_modif']}}  </th>
                        
                            
                            </tr>
                          
                            @endfor
                        @endfor
                </tbody>
            </table>
        </div>
        <script src="{{asset('assets/bootstrap-5.0.2/js/bootstrap.js')}}"></script>
        <script src="{{asset('assets/fontawesome-free/js/all.js')}}"></script>
        <script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
        <script>
            $(document).ready(function() {
                var tabls = $('#ModiftT').DataTable({
                    language: {
                        url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"

                    }
             
               
                });

                $('#ModiftT tbody').on('click', 'tr', function() {
                    $(this).toggleClass('selected');
                });
            });
        </script>

    </body>
</html>