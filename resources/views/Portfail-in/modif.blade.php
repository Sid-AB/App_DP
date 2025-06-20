<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content=" {{csrf_token()}}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACTION</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
<link href="{{asset('assets/css/main.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/bootstrap-5.0.2/css/bootstrap.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/fontawesome-free/css/all.css')}}" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
<link
        rel="stylesheet"
        href="https://unpkg.com/@patternfly/patternfly/patternfly.css"
        crossorigin="anonymous"
      >
<script>
  var path=[]
var paths=@json($paths);
var lengs=@json($leng)
//

console.log('te'+JSON.stringify(path)+'and his leng'+lengs)
Object.entries(paths).forEach(([code,value])=>{
  path.push(value)
})
</script>
</head>
<body>
@include('side_bar.side-barV1')
<!-- Container for Car Cards -->
<div>
 {{--@include('progress_step.progress_step')--}}
 <br>
 </div>
 <div class="wallet-path">
    <div class="the-path">

        @foreach($paths as $key =>$value)
      <!-- path insert -->
      <div class="pinfo-handle">
      <i class="fas fa-wallet"></i>
      <p >{{$key}} :</p>
      <p> {{$value}}</p>
      </div>
      <div class="next-handle">
      <i class="fas fa-angle-double-right complet-icon"></i>
      </div>
      <!-- end path -->


      <!-- this part for all froms at same-->



      <!-- end -->

       @endforeach

    </div>
  </div>
  <div id="progam-handle">
  @if($leng == 6)
  <div class="form-container" id="creati-sous_act">
                        <form >
                        <div class="form-group">
                        <label for="input1">Code de Sous ACTION</label>
                        <input type="text" class="form-control" id="num_sous_act" placeholder="Entrer le Code de sous ACTION">
                        </div>
                        <div class="form-group">
                        <label for="inputDate">Date du Journal</label>
                        <input type="date" class="form-control" id="date_insert_sou_action">
                        </div>
                        <div class="form-group">
                        <label for="input1">Nom de Sous ACTION</label>
                        <input type="text" class="form-control" id="nom_sous_act" placeholder="Entrer le Nom de sous ACTION">
                        </div>
                        <div class="form-group" id="ElAE_act">
                        <label for="input1">AE pour Sous ACTION</label>
                        <input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="AE_sous_act" placeholder="Entrer AE sous Action ">
                        </div>
                        <div class="form-group" id="ElCP_act">
                        <label for="input1">CP pour Sous_ACTION</label>
                        <input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="CP_sous_act" placeholder="Entrer CP sous Action">
                        </div>

                        <!--div class="form-group">
                          <label for="CP_sous_act">Action de Delegatiion</label>
                         <input type="checkbox" id="act_deleg">
                       </div-->

                        </form>
                        <br>
                        <div id="confirm-holder">
                        <button class="btn btn-primary" id="add-prg4">Modifier</button>
                        <hr>
                        <div class="file-handle">
                        <input type="file" class="form-control" id="file">
                      
                        </div>
                         <div id="preview"></div>
                        </div>
                 @endif

                 @if($leng == 5)
  <div class="form-container" id="creati-act">
                        <form >
                        <div class="form-group">
                        <label for="input1">Code D 'ACTION</label>
                        <input type="text" class="form-control" id="num_act" placeholder="Entrer le Code d'ACTION" value="{{$code}}">
                        </div>
                        <div class="form-group">
                        <label for="inputDate">Date du Journal</label>
                       
                        <input type="date" class="form-control" id="date_insert_action" value="{{$date}}">
                        </div>
                        <div class="form-group">
                        <label for="input1">Nom d'ACTION</label>
                        <input type="text" class="form-control" id="nom_act" placeholder="Entrer le Nom d'ACTION" value="{{$nom}}">
                        </div>
                        <div class="form-group" id="ElAE_act">
                        <label for="input1">AE pour Action</label>
                        <input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="AE_act" placeholder="Entrer AE Action" value={{$ae_glob}} disabled>
                        </div>
                        <div class="form-group" id="ElCP_act">
                        <label for="input1">CP pour Action</label>
                        <input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="CP_act" placeholder="Entrer CP Action" value={{$cp_glob}} disabled>
                        </div>

                        <div class="ports_init">
                        <div class="form-group">
                                 <label for="input1">T1 pour ACTION</label>
                                 <input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="T1_AE_init_AC"   placeholder="Entrer T1 AE ACTION" value={{$init_value['ae_T1']}}>
                                 <input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="T1_CP_init_AC"   placeholder="Entrer T1 CP ACTION" value={{$init_value['cp_T1']}}>
                                 </div>
                                 <div class="form-group">
                                 <label for="input1">T2 pour ACTION</label>
                                 <input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="T2_AE_init_AC"   placeholder="Entrer T2 AE ACTION" value={{$init_value['ae_T2']}}>
                                 <input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="T2_CP_init_AC"   placeholder="Entrer T2 CP ACTION" value={{$init_value['cp_T2']}}>
                                 </div>
                                 <div class="form-group">
                                 <label for="input1">T3 pour ACTION</label>
                                 <input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="T3_AE_init_AC"   placeholder="Entrer T3 AE ACTION" value={{$init_value['ae_T3']}}>
                                 <input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="T3_CP_init_AC"   placeholder="Entrer T3 CP ACTION" value={{$init_value['cp_T3']}}>
                                 </div>
                                 <div class="form-group">
                                 <label for="input1">T4 pour ACTION</label>
                                 <input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="T4_AE_init_AC"   placeholder="Entrer T4 AE ACTION" value={{$init_value['ae_T4']}}>
                                 <input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="T4_CP_init_AC"   placeholder="Entrer T4 CP ACTION" value={{$init_value['cp_T4']}}>
                                 </div>

                        </div>

                        <div class="form-group">
                           <label for="CP_sous_act">Action de Delegatiion</label>
                          <input type="checkbox" id="act_deleg">
                        </div>

                        </form>
                        <br>
                        <div id="confirm-holder">
                        <button class="btn btn-primary" id="add-prg3">Modifier</button>
                        <hr>
                        <div class="file-handle">
                        <input type="file" class="form-control" id="file">
                       
                        </div>
                         <div id="preview"></div>
                        </div>
                 @endif

                 @if($leng == 4)
  <div class="form-container" id="creati-sous_prog">

                 <form >
                        <div class="form-group">
                        <label for="input1">Code du Sous Programme</label>
                        <input type="text" class="form-control" id="num_sous_prog" placeholder="Entrer le  Code du Sous Programme" value='{{$code}}'>
                        </div>
                        <div class="form-group">
                        <label for="inputDate">Date du Journal</label>
                        <input type="date" class="form-control" id="date_insert_sousProg" value="{{$date}}">
                        </div>
                        <div class="form-group">
                        <label for="input1">Nom du Sous Programme</label>
                        <input type="text" class="form-control" id="nom_sous_prog" placeholder="Entrer le Nom du Sous Programme" value="{{$nom}}">
                        </div>
                        <div class="form-group" id="ElAE_act">
                        <label for="input1">AE pour Sous Programme</label>
                        <input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="AE_sous_prog" placeholder="Entrer AE sous Programme" value={{$ae_glob}} disabled>
                        </div>
                        <div class="form-group" id="ElCP_act">
                        <label for="input1">CP pour Sous Programme</label>
                        <input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="CP_sous_prog" placeholder="Entrer CP sous Programme" value={{$cp_glob}} disabled>
                        </div>
                        <div class="ports_init">
                        <div class="form-group">
                                 <label for="input1">T1 pour Sous Programme</label>
                                 <input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="T1_AE_init"   placeholder="Entrer T1 AE Sous Programme" value={{$init_value['ae_T1']}}>
                                 <input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="T1_CP_init"   placeholder="Entrer T1 CP Sous Programme" value={{$init_value['cp_T1']}}>
                                 </div>
                                 <div class="form-group">
                                 <label for="input1">T2 pour Sous Programme</label>
                                 <input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="T2_AE_init"   placeholder="Entrer T2 AE Sous Programme" value={{$init_value['ae_T2']}}>
                                 <input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="T2_CP_init"   placeholder="Entrer T2 CP Sous Programme" value={{$init_value['cp_T2']}}>
                                 </div>
                                 <div class="form-group">
                                 <label for="input1">T3 pour Sous Programme</label>
                                 <input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="T3_AE_init"   placeholder="Entrer T3 AE Sous Programme" value={{$init_value['ae_T3']}}>
                                 <input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="T3_CP_init"   placeholder="Entrer T3 CP Sous Programme" value={{$init_value['cp_T3']}}>
                                 </div>
                                 <div class="form-group">
                                 <label for="input1">T4 pour Sous Programme</label>
                                 <input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="T4_AE_init"   placeholder="Entrer T4 AE Sous Programme" value={{$init_value['ae_T4']}}>
                                 <input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="T4_CP_init"   placeholder="Entrer T4 CP Sous Programme" value={{$init_value['cp_T4']}}>
                                 </div>
                        </form>
                        
                        </div>
                        <br>
                        <div id="confirm-holder">
                        <button class="btn btn-primary" id="add-prg2">Modifier</button>
                        <hr>
                        <div class="file-handle">
                        <input type="file" class="form-control" id="file">
                        
                        </div>
                        <div id="preview"></div>
                        </div>
                 @endif


                 @if($leng == 3)

                 <div class="form-container" id="creati-prog">

                 <form>
                        <div class="form-group">
                        <label for="input1">Code du Programme</label>
                        <input type="text" class="form-control" id="num_prog" placeholder="Entrer le Code du Programme" value="{{$code}}">
                        </div>
                        <div class="form-group">
                        <label for="inputDate">Date du Journal</label>
                        <input type="date" class="form-control" id="date_insert_portef" value="{{$date}}">
                        </div>
                        <div class="form-group">
                        <label for="input1">Nom du Programme</label>
                        <input type="text" class="form-control" id="nom_prog" placeholder="Entrer le Nom du Programme" value="{{$nom}}">
                        </div>
                        <div class="form-group" id="ElAE_act">
                        <label for="input1">AE pour le Programme</label>
                        <input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="AE_prog" placeholder="Entrer AE  Programme" value="{{$ae_glob}}">
                        </div>
                        <div class="form-group" id="ElCP_act">
                        <label for="input1">CP pour le Programme</label>
                        <input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="CP_prog" placeholder="Entrer CP  Programme" value="{{$cp_glob}}">
                        </div>
                        </form>
                        <br>
                        <div id="confirm-holder_prog">
                        <button class="btn btn-primary" id="add-prg1">Modifier</button>
                        <hr>
                        <div class="file-handle">
                        <input type="file" class="form-control" id="file">
                        
                        </div>
                         <div id="preview"></div>
                        </div>
    </div>

  
                        <br>                        
                        </div>
                 @endif
                  @if($leng == 2)
                  <div class="form-container">
                  <div class="card-body"  id="creati-prog">
                    <h5 class="card-title">
                      <i class="fas fa-file-alt"></i> Télécharger votre Document
                      </h5>
                <form id="pdf-upload-form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="num_port">Code du portefeuille</label>
                        <input type="text" class="form-control" id="num_port" placeholder="Entrer le Code du portefeuille" value="{{$code}}">

                    </div>
                    <div class="form-group">
                        <label for="date_crt_portf">Date de sortie du portefeuille</label>
                        <input type="date" class="form-control" id="date_crt_portf" placeholder="Entrer la Date de sortie du portefeuille" value="{{$date}}">
                    </div>
                    <div class="form-group">
                        <label for="nom_journ">Nom du Journal</label>
                        <input type="text" class="form-control" id="nom_journ" placeholder="Entrer le nom du journal" value="{{$nom}}">
                    </div>
                    <div class="form-group">
                        <label for="num_journ">Référence du journal</label>
                        <input type="text" class="form-control" id="num_journ" placeholder="Entrer la Référence du journal" value="{{$ref}}">
                    </div>
                    <div class="form-group">
                        <label for="AE_portef">AE pour Portefeuille</label>
                        <input type="text" class="form-control" id="AE_portef" placeholder="Entrer AE Portefeuille" value="{{$ae_glob}}">
                    </div>
                    <div class="form-group">
                        <label for="CP_portef">CP pour Portefeuille</label>
                        <input type="text" class="form-control" id="CP_portef" placeholder="Entrer CP Portefeuille" value="{{$cp_glob}}">
                    </div>
                </form>
                <br>
                <button type="submit" class="btn btn-primary" id="add-wallet">
                   Modifier
                </button>
                <hr>
                        <div class="file-handle">
                        <input type="file" class="form-control" id="file">
                        
                </div>
                </div>
                <div id="message"></div>
                <div id="preview"></div>
            </div>
                  @endif
                 </div>
                 <script>
                 var path3=Array()
                 
                 </script>
<script src="{{asset('assets/bootstrap-5.0.2/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/fontawesome-free/js/all.js')}}"></script>
<script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('assets/js/modif_precess.js')}}">
</script>
<script>var deleg_action="centrale"
$('#act_deleg').change(function() {
    if ($(this).is(':checked')) {
        deleg_action="delegation"
        console.log('Checkbox is checked. Value:', $(this).val()+'deleg_action'+deleg_action);
    } else {
          deleg_action="centrale"
        console.log('Checkbox is unchecked.', $(this).val()+'deleg_action'+deleg_action);
    }
});
</script>
 </body>

</html>
