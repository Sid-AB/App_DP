
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTE DES OPERATIONS D'INVESTISSEMENT PUBLIC</title>
    <style>
      
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: white;
          
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .table-diviser {
        margin: 20px 0; /* la distance entre les 2 tables */
       
    }

    .first-table {
            width: 50%; 
            margin-bottom: 20px; 
            margin: 0 auto;
      
        }

        .head3{
            background-color:#DCE6F1;
        }
       .vert3{
            background-color:#EBF1DE;
        }

        .total3{
          
          background-color:#EBF1DE;

        }

        .aecp{
            background-color:#FDE9D9;
        }

    </style>
</head>
<body>

<!--h1>LISTE DES OPERATIONS D'INVESTISSEMENT PUBLIC:</h1-->


<table class="first-table">
    <thead>
                @php
                    // extraire la dernière partie du code 
                    $code_prog = explode('-', $prog->num_prog);
                    $codeprg = end($code_prog);
                @endphp
        <tr>
            <th style="text-align: center; ">PROGRAMME {{ $prog->nom_prog }}</th>
            <th style="text-align: center; ">Code {{ $codeprg }}</th>
            <th colspan="2" class="head3" style="text-align: center; ">T3 DANS LE DPIC</th>
        </tr>


        <tr>
                @php
                    // extraire la dernière partie du code 
                    $code_sousprog = explode('-', $sousProgramme->num_sous_prog);
                    $codesousprg = end($code_sousprog);
                @endphp
            <th style="text-align: center; ">Sous-programme {{ $sousProgramme->nom_sous_prog }}</th>
            <th style="text-align: center; ">Code {{ $codesousprg}}</th>
            <th style="text-align: center; " class="head3">AE </th>
            <th style="text-align: center; " class="head3">CP </th>
        </tr>

        <tr>
                @php
                    // extraire la dernière partie du code 
                    $code_action = explode('-', $action->num_action );
                    $codeact = end($code_action);
                @endphp
            <th style="text-align: center; ">Action {{ $action->nom_action }}</th>
            <th style="text-align: center; ">Code {{ $codeact }}</th>
            <td style="text-align: center; ">{{ number_format((float)$resultstructur['centrale']['T3']['total'][0]['values']['totalAE'], 2, '.', ',') ?? 'N/A' }}</td>
            <td style="text-align: center; ">{{ number_format((float)$resultstructur['centrale']['T3']['total'][0]['values']['totalCP'], 2, '.', ',') ?? 'N/A' }}</td>
        </tr>
    </thead>

</table>

<div class="table-diviser"></div> 
<table>
     
            <tr>
                <th rowspan="3" style="text-align: center; ">Code</th>
                <th class="vert3"  rowspan="3" style="text-align: center; "> T3. DEPENSES D'INVESTISSEMENT </th>

                <th class="vert3" rowspan="3"style="text-align: center; "> N° DE DECISION D'INSCRIPTION</th>
                <th class="vert3"  rowspan="3" style="text-align: center; ">INTITULE DE L'OPERATION D'INVESTISSEMENT PUBLIC (PROJET)</th>
                <th class="aecp " colspan="6"  style="text-align: center;">ANNEE EN COURS (N)</th>
            </tr>
            <tr>
         
                <th class="aecp " colspan="3" style="text-align: center;" >AE </th>
                <th  class="aecp " colspan="3" style="text-align: center;">CP </th>
            </tr>


            <tr>
            <th class="aecp " style="text-align: center; ">AE REPORTEE  <br> 31-12-{{$years-1}} </th>
            <th class="aecp " style="text-align: center; ">AE NOTIFIEE  <br> {{$years}}</th>
            <th class="aecp " style="text-align: center; ">AE ENGAGEE  <br> AU  <br> 31-12-{{$years-1}} </th>

            <th class="aecp ">CP REPORTES  <br> 31-12-{{$years-1}}</th>
            <th class="aecp ">CP NOTIFIES  <br> {{$years}}</th>
            <th class="aecp ">CP CONSOMMES  <br> Au  <br> 31-12-{{$years-1}} </th>
            </tr>

        
        <tbody>
       
   
     
         @if(!empty($resultstructur['centrale']['T3']['groupedData']))
                @foreach ($resultstructur['centrale']['T3']['groupedData'] as $groupData)
                @php
                    // extraire la dernière partie du code grp
                    $code_grpsepar = explode('-', $groupData['group']['code']);
                    //dd(  $code_grpsepar);
                    $codegrp = end($code_grpsepar);
                    //dd($codegrp);
               
                @endphp
            <tr class="group-row">
                <td style="text-align: center; " class="code">{{$codegrp}}</td>
                <td colspan="3" style=" font-weight: bold; ">{{$namesT3[$codegrp] }}</td>
                <!--td>{{$namesT3[$codegrp ] ?? Néant}}</td> 

                <td>{{$namesT3[$codegrp ]  ?? Néant }}</td--> 

                <td class="aecp " style="text-align: center; ">{{ number_format((float)$groupData['group']['values']['ae_reporte'], 2, '.', ',') ?? 'N/A' }}</td>
                <td class="aecp " style="text-align: center; ">{{ number_format((float)$groupData['group']['values']['ae_notifie'], 2, '.', ',') ?? 'N/A' }}</td>
                <td class="aecp " style="text-align: center; ">{{ number_format((float)$groupData['group']['values']['ae_engage'], 2, '.', ',') ?? 'N/A' }}</td>
              
                <td class="aecp " style="text-align: center; ">{{ number_format((float)$groupData['group']['values']['cp_reporte'], 2, '.', ',') ?? 'N/A' }}</td>
                <td class="aecp " style="text-align: center; ">{{ number_format((float)$groupData['group']['values']['cp_notifie'], 2, '.', ',') ?? 'N/A' }}</td>
                <td class="aecp " style="text-align: center; ">{{ number_format((float)$groupData['group']['values']['cp_consome'], 2, '.', ',') ?? 'N/A' }}</td>
               
            </tr>

                 @foreach ($groupData['operations'] as $operationData)
                @php
                    // extraire la dernière partie du code de l'op
                    $code_grpsepar = explode('-', $operationData['operation']['code']);
                     $codeop = end( $code_grpsepar);
                     //dd($operationData);
                  
                   

                    // compter le nbr total d'op dans le groupe
                        //$totalOperations = count($operationData['sousOperations']);
                        $totalOperations = count($groupData['operations']);
                      //  dd($totalOperations);
                     // dd($namesT3[$codeop]);
                     @endphp
                @if (count($operationData['sousOperations']) > 0)
                   <tr class="operation-row with-sousop">
                  
                   <!--td rowspan={{$totalOperations}} class="code"></td-->        <td class="code">{{ $codeop }}</td>
    
                   <td >{{$namesT3[$codeop]}}</td>
                   <td ></td>   <td class="vert3"></td>
                  

                <td class="aecp " style="text-align: center; ">{{ number_format((float)$operationData['operation']['values']['ae_reporte'], 2, '.', ',') ?? 'N/A' }}</td>
                <td class="aecp " style="text-align: center; ">{{ number_format((float)$operationData['operation']['values']['ae_notifie'], 2, '.', ',') ?? 'N/A' }}</td>
                <td class="aecp " style="text-align: center; ">{{ number_format((float)$operationData['operation']['values']['ae_engage'], 2, '.', ',') ?? 'N/A' }}</td>

                <td class="aecp " style="text-align: center; ">{{ number_format((float)$operationData['operation']['values']['cp_reporte'], 2, '.', ',') ?? 'N/A' }}</td>
                <td class="aecp " style="text-align: center; ">{{ number_format((float)$operationData['operation']['values']['cp_notifie'], 2, '.', ',') ?? 'N/A' }}</td>
                <td class="aecp " style="text-align: center; ">{{ number_format((float)$operationData['operation']['values']['cp_consome'], 2, '.', ',') ?? 'N/A' }}</td>
           </tr>
              
               @else
                <tr class="operation-row">
                <td class="code">{{ $codeop }}</td>
    
                <td >{{$namesT3[$codeop]}}</td>
                <td ></td>   <td class="vert3"></td>
                
                    <td class="aecp " style="text-align: center; ">{{ number_format((float)$operationData['operation']['values']['ae_reporte'], 2, '.', ',') ?? 'N/A' }}</td>
                    <td class="aecp "  style="text-align: center; ">{{ number_format((float)$operationData['operation']['values']['ae_notifie'], 2, '.', ',') ?? 'N/A' }}</td>
                    <td class="aecp " style="text-align: center; ">{{ number_format((float)$operationData['operation']['values']['ae_engage'], 2, '.', ',') ?? 'N/A' }}</td>

                    <td class="aecp " style="text-align: center; ">{{ number_format((float)$operationData['operation']['values']['cp_reporte'], 2, '.', ',') ?? 'N/A' }}</td>
                    <td class="aecp " style="text-align: center; ">{{ number_format((float)$operationData['operation']['values']['cp_notifie'], 2, '.', ',') ?? 'N/A' }}</td>
                    <td class="aecp " style="text-align: center; ">{{ number_format((float)$operationData['operation']['values']['cp_consome'], 2, '.', ',') ?? 'N/A' }}</td>
                </tr>
              
                @endif
              
              

                @foreach ($operationData['sousOperations'] as $sousOp)
            @php
                    // extraire la dernière partie du code de la sous-opération
                    $code_separer = explode('-', $sousOp['code']);
                    //dd(  $code_separer);
                    $codeextr = end($code_separer);
                 //  dd($codeextr);
                 $avantDernierePartie = $code_separer[count($code_separer) - 2] ?? null;
                 //dd(  $avantDernierePartie);
                 $nom = $avantDernierePartie ? App\Models\SousOperation::where('code_sous_operation', $sousOp['code'])->first()->nom_sous_operation : null;
                    //dd($nom);
       
                    if (strpos($nom, '_') !== false) {
                    $explodnom = explode('_', $nom);
                    //$decision=reset($explodnom);
                    $decision= $explodnom[1];
                    //dd($decision);
                    $intitule=end($explodnom);
                   // dd($intitule);
                    }else {
                            $decision ='';
                            $intitule = '';
                    }
                //dd($namesT3[$codeextr]);
                @endphp  
                @if ($codeextr !== $codeop)
                    <tr>
                    <td class="code">{{  (strlen($codeextr) === 5) ? $codeextr : '' }}</td>
    
                    <td>{{ $namesT3[$codeextr] ??$namesT3[$avantDernierePartie] }}</td>
                    <td >{{ $decision }}</td>
                    <td class="vert3">{{ $intitule }}</td>
                    <!--td style="text-align: center; " class="code">{{ $codeextr }}</td>

                    <td>{{$namesT3[$codegrp]}}</td-->

                   


                    <td class="aecp " style="text-align: center; ">{{ number_format((float)$sousOp['values']['ae_reporte'], 2, '.', ',') ?? 'N/A' }}</td>
                    <td class="aecp " style="text-align: center; ">{{ number_format((float)$sousOp['values']['ae_notifie'], 2, '.', ',') ?? 'N/A' }}</td>
                    <td class="aecp " style="text-align: center; ">{{ number_format((float)$sousOp['values']['ae_engage'], 2, '.', ',') ?? 'N/A' }}</td>

                    <td class="aecp " style="text-align: center; ">{{ number_format((float)$sousOp['values']['cp_reporte'], 2, '.', ',') ?? 'N/A' }}</td>
                    <td class="aecp " style="text-align: center; ">{{ number_format((float)$sousOp['values']['cp_notifie'], 2, '.', ',') ?? 'N/A' }}</td>
                    <td class="aecp " style="text-align: center; ">{{ number_format((float)$sousOp['values']['cp_consome'], 2, '.', ',') ?? 'N/A' }}</td>
                </tr>
                @elseif (($codeextr == $codeop) && (isset($explodnom[1]) && $explodnom[1] != '-'))

                     <tr>
                    <td class="code">{{  (strlen($codeextr) === 5) ? $codeextr : '' }}</td>
    
                    <td>{{ $namesT3[$codeextr] ??$namesT3[$avantDernierePartie] }}</td>
                    <td >{{ $decision }}</td>
                    <td class="vert3">{{ $intitule }}</td>
                    <!--td style="text-align: center; " class="code">{{ $codeextr }}</td>

                    <td>{{$namesT3[$codegrp]}}</td-->

                   


                    <td class="aecp " style="text-align: center; ">{{ number_format((float)$sousOp['values']['ae_reporte'], 2, '.', ',') ?? 'N/A' }}</td>
                    <td class="aecp " style="text-align: center; ">{{ number_format((float)$sousOp['values']['ae_notifie'], 2, '.', ',') ?? 'N/A' }}</td>
                    <td class="aecp " style="text-align: center; ">{{ number_format((float)$sousOp['values']['ae_engage'], 2, '.', ',') ?? 'N/A' }}</td>

                    <td class="aecp " style="text-align: center; ">{{ number_format((float)$sousOp['values']['cp_reporte'], 2, '.', ',') ?? 'N/A' }}</td>
                    <td class="aecp " style="text-align: center; ">{{ number_format((float)$sousOp['values']['cp_notifie'], 2, '.', ',') ?? 'N/A' }}</td>
                    <td class="aecp " style="text-align: center; ">{{ number_format((float)$sousOp['values']['cp_consome'], 2, '.', ',') ?? 'N/A' }}</td>
                </tr>
                @endif
            @endforeach
        @endforeach
        @endforeach
      
        @else
            
                @foreach ($namesT3 as $code => $name)
                 
                <tr>
                    <td style="text-align: center;" class="code">{{ $code }}</td>
                    <td >{{ $name }}</td>
                    <td ></td>
                    <td class="vert3"></td>
                    <td class="aecp" style="text-align: center;"> - </td>
                    <td class="aecp" style="text-align: center;">-</td>
                    <td class="aecp" style="text-align: center;">-</td>
                    <td class="aecp" style="text-align: center;">-</td>
                    <td class="aecp" style="text-align: center;">-</td>
                    <td class="aecp" style="text-align: center;">-</td>
                </tr>
            @endforeach
        @endif
    
    </tbody>
    
  
       @if(!empty($resultstructur['centrale']['T3']['groupedData']))
        <tr  class="total3">
            <td colspan="4" style="text-align: center;font-weight: bold;font-size:20px;">TOTAL DES CREDITS </td>
            <td style="text-align: center;font-weight: bold;font-size:20px; ">{{ number_format((float)$resultstructur['centrale']['T3']['total'][0]['values']['totalAEreportevertical'], 2, '.', ',') ?? 'N/A' }}</td>
            <td style="text-align: center; font-weight: bold;font-size:20px;">{{ number_format((float)$resultstructur['centrale']['T3']['total'][0]['values']['totalAEnotifievertical'], 2, '.', ',') ?? 'N/A' }}</td>
            <td style="text-align: center; font-weight: bold;font-size:20px;">{{ number_format((float)$resultstructur['centrale']['T3']['total'][0]['values']['totalAEengagevertical'], 2, '.', ',') ?? 'N/A' }}</td>

            <td style="text-align: center;font-weight: bold;font-size:20px; ">{{ number_format((float)$resultstructur['centrale']['T3']['total'][0]['values']['totalCPreportevertical'], 2, '.', ',') ?? 'N/A' }}</td>
            <td style="text-align: center; font-weight: bold;font-size:20px;">{{ number_format((float)$resultstructur['centrale']['T3']['total'][0]['values']['totalCPnotifievertical'], 2, '.', ',') ?? 'N/A' }}</td>
            <td style="text-align: center;font-weight: bold;font-size:20px; ">{{ number_format((float)$resultstructur['centrale']['T3']['total'][0]['values']['totalCPconsomevertical'], 2, '.', ',') ?? 'N/A' }}</td>

      
        </tr>
        @else 
        <tr  class="total3">
            <td colspan="4" style="text-align: center; font-weight: bold;font-size:20px;">TOTAL DES CREDITS </td>
            <td style="text-align: center;font-weight: bold;font-size:20px; ">- </td>
            <td style="text-align: center; font-weight: bold;font-size:20px;">- </td>
            <td style="text-align: center;font-weight: bold;font-size:20px; ">- </td>
            <td style="text-align: center; font-weight: bold;font-size:20px;">- </td>
            <td style="text-align: center; font-weight: bold;font-size:20px;">- </td>
            <td style="text-align: center; font-weight: bold;font-size:20px;">- </td>

      
        </tr>
    @endif
   
    </table>
    </div>
</body>
</html>