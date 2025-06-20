<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content=" {{csrf_token()}}">
    <title>Tableau CREDITS </title>
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
<link href="{{asset('assets/css/suiv_css.css')}}" rel="stylesheet"/>

</head>

<body>  
@include('side_bar.side-barV1') 
<div class="d-flex justify-content-center p-3 " >
    <h1 class="rounded-3 d-flex justify-content-center card" style="width: 30%;background-color:#d3d5f9d4;text-align:center;">
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
    <p class="lead fw-bold">Le suivi de l’état de programmation des crédits des programmes ( 
    @for($i=0;$i< count($filcode);$i++)
    {{$filcode[$i]}} 
    @if ($i < count($filcode) - 1)
            + {{-- ajouter + pour separer les prgrms --}}
        @endif
    @endfor
    ):
    </p>
   
    </h1>
</div>
@php
    use Illuminate\Support\Facades\DB;
    $indiceProg = []; 
@endphp
         
           
                @if(isset($prgrmsousact) && count($prgrmsousact) > 0)
                    @php 
                    $total_t1_ae = $total_t1_cp = 0;
                    $total_t2_ae = $total_t2_cp = 0;
                    $total_t3_ae = $total_t3_cp = 0;
                    $total_t4_ae = $total_t4_cp = 0;
                    @endphp
                    {{-- Ligne principale pour le programme --}}
                    <tr class="program-title">
                    @foreach($prgrmsousact as $programme)
                    @php
                        $code =explode('-',$programme['num_prog']);
                        $last =count($code)-1;
                        //dd($code);
                    
                    
                        $code = $code[$last];
                        $indiceProg[] = count($indiceProg) + 1;
                        //dd($indiceProg);
                    @endphp
<table >
                    <tr style="background: rgba(255, 255, 255, 0);">

                    <th  style="border: none; background:  transparent;"  colspan=2></th>
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
            
                    <tr style="background: rgba(255, 255, 255, 0);">
                        <th  style="border: none; background:transparent;"  colspan=2></th>
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
    
    <!--<< at tis point start the dataTables js -->

        <div class="Modift-handle" style="
    width: fit-content;
">
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
                        <th>situation modif</th>
                        <th>Date modif </th>
                       
                    </tr>
                </thead>

                <tbody>

                        @for($i=0;$i< count($modiflist); $i++)
                        @php
                                $code = explode('-', $modiflist[$i]['num_prog']);
                                //dd($code)
                                $last = count($code) - 1;
                                $code = $code[$last];
                                //dd($code);
                        @endphp 

                         
                            @php
                                $codesp = explode('-', $modiflist[$i]['num_sous_prog']);
                                //dd($codesp)
                                $last = count($codesp) - 1;
                                $codesp = $codesp[$last];
                                //dd($codesp);

                                $codeA = explode('-',$modiflist[$i]['num_sous_action']);
                                //dd($codeA);
                                $last = count($codeA) - 1;
                                $codeA = $codeA[$last];
                                //dd($codeA);

                                $codepR = explode('-', $modiflist[$i]['num_prog_retire']);
                                $last = count($codepR) - 1;
                                $codepR = $codepR[$last];
                             
                                $codespR = explode('-', $modiflist[$i]['num_sous_prog_retire']);
                               
                                $last = count($codespR) - 1;
                                $codespR = $codespR[$last];
                             

                                $codeAR= explode('-',$modiflist[$i]['num_sous_action_retire']);
                                $last = count($codeAR) - 1;
                               
                                $codeAR = $codeAR[$last];
                                $code_ci=$modiflist[$i]['num_sous_action'];
                        @endphp
                         
                            <tr id="">
                            <td><a href="/live-pdf/T_{{$code_ci}}">{{$i}}</a></td>
                            <td>{{$code}} </td>
                           <td>{{$codesp}}</td>
                           <td>{{$codeA}}</td>
                            <td>{{$modiflist[$i]['code_t1'].'-'.
                                $modiflist[$i]['code_t2'].'-'.
                                $modiflist[$i]['code_t3'].'-'.
                                $modiflist[$i]['code_t4']    
                            }} </td>
                            <td>{{number_format((float)$modiflist[$i]['AE_recoit_t1'], 2, '.', ',') ?? 'N/A'}} </td>
                            <td>{{number_format((float)$modiflist[$i]['CP_recoit_t1'], 2, '.', ',') ?? 'N/A'}} </td>
                            <td>{{number_format((float)$modiflist[$i]['AE_recoit_t2'], 2, '.', ',') ?? 'N/A'}} </td>
                            <td>{{number_format((float)$modiflist[$i]['CP_recoit_t2'], 2, '.', ',') ?? 'N/A'}} </td>
                            <td>{{number_format((float)$modiflist[$i]['AE_recoit_t3'], 2, '.', ',') ?? 'N/A'}} </td>
                            <td>{{number_format((float)$modiflist[$i]['CP_recoit_t3'], 2, '.', ',') ?? 'N/A'}} </td>
                            <td>{{number_format((float)$modiflist[$i]['AE_recoit_t4'], 2, '.', ',') ?? 'N/A'}} </td>
                            <td>{{number_format((float)$modiflist[$i]['CP_recoit_t4'] , 2, '.', ',') ?? 'N/A'}} </td>
                            <td>{{$modiflist[$i]['type_modif']}} </td>
                            <td id="">{{$codepR}} </td>
                            <td>{{$codespR}}</td>
                            <td>{{$codeAR}} </td>
                            <td id="{{$code_ci}}">
                                @if(isset($modiflist[$i]['situation_modif']) && $modiflist[$i]['situation_modif'] == 'true')
                                
                                    {{$modiflist[$i]['situation_modif']}}
                                
                                @else
                                 
                                       <div class="d-flex flex-nowrap justify-content-around" style="width: 100%">
                                        <button type="button" class="btn btn-success" style="padding: 10px" id="validate"><i class="fas fa-check" ></i></button>
                                        <button type="button" class="btn btn-danger" style="padding: 10px" id="refuse"><i class="fas fa-times"></i></button>
                                        </div>
                                 
                                @endif
                            </td>
                            <td>{{$modiflist[$i]['date_modif']}}  </td>
                            </tr>
                          
                        @endfor

                        
                </tbody>
            </table>
        </div>
         <div class="confirm-justfie">
 
                        </div>
                        <div class="reload-handle reload-hidden" id="reloading">
                            <div class="reload"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><radialGradient id="a12" cx=".66" fx=".66" cy=".3125" fy=".3125" gradientTransform="scale(1.5)"><stop offset="0" stop-color="#C6BC0A"></stop><stop offset=".3" stop-color="#C6BC0A" stop-opacity=".9"></stop><stop offset=".6" stop-color="#C6BC0A" stop-opacity=".6"></stop><stop offset=".8" stop-color="#C6BC0A" stop-opacity=".3"></stop><stop offset="1" stop-color="#C6BC0A" stop-opacity="0"></stop></radialGradient><circle transform-origin="center" fill="none" stroke="url(#a12)" stroke-width="29" stroke-linecap="round" stroke-dasharray="200 1000" stroke-dashoffset="0" cx="100" cy="100" r="70"><animateTransform type="rotate" attributeName="transform" calcMode="spline" dur="2" values="360;0" keyTimes="0;1" keySplines="0 0 1 1" repeatCount="indefinite"></animateTransform></circle><circle transform-origin="center" fill="none" opacity=".2" stroke="#C6BC0A" stroke-width="29" stroke-linecap="round" cx="100" cy="100" r="70"></circle></svg>
                            </div>
                        </div>
                        <div class="form_holder_modif"></div>
        <div class="hide-access-form"></div>
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
            var chekl='<div class="form-popup-access" id="myForm">'+
        //  '<div class="row align-items-center"style="justify-content: center;">'+
          '<img src="{{asset('assets/img/logo_ministere.svg')}}" alt="" style="width: 60%"/>'+
         // '<div >'+
        '<form class="form-container-access">'+
      
         '<h1>Login</h1>'+
          '<p id="alert-access"></p>'+
         '<label for="email"><b>Email</b></label>'+
         '<input class="form-control" type="text" placeholder="Veuillez entrer votre adresse email" name="email" id="email" required>'+

         '<label for="psw"><b>Password</b></label>'+
         '<input class="form-control" type="password" placeholder="Veuillez entrer votre mot de passe" name="psw" id="code_generated" required>'+

         '<button type="button" class="btn" id="btn-form-access">Se connecter</button>'+
         '<button type="button" class="btn cancel" id="form-cancel">Fermer</button>'+
        '</form>'+
        '</div>'; 
        </script>
        <script src="{{asset('assets/js/trace_suive.js')}}"></script>
    </body>
</html>  