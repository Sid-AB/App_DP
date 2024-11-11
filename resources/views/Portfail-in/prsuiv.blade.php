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
var paths=@json($path);
console.log('te'+JSON.stringify(path))
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
       
        @foreach($path as $key =>$value)
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
  @if($leng == 4)
  <div class="form-container" id="creati-sous_act">
                        <form >
                        <div class="form-group">
                        <label for="input1">N° Sous_ACTION</label>
                        <input type="text" class="form-control" id="num_s_act" placeholder="Donnee Nom ACTION">
                        </div>
                        <div class="form-group">
                        <label for="input1">Nom Sous_ACTION</label>
                        <input type="text" class="form-control" id="nom_s_act" placeholder="Donnee Nom ACTION">
                        </div>
                        <div class="form-group" id="ElAE_act">
                        <label for="input1">AE pour Sous_ACTION</label>
                        <input type="number" class="form-control" id="AE_s_act" placeholder="Donnee Nom Programme">
                        </div>
                        <div class="form-group" id="ElCP_act">
                        <label for="input1">CP pour Sous_ACTION</label>
                        <input type="number" class="form-control" id="CP_s_act" placeholder="Donnee Nom Programme">
                        </div>
                        <div class="form-group">
                        <label for="inputDate">Date Journal</label>
                        <input type="date" class="form-control" id="date_insert_action">
                        </div>
                        </form>
                        <br>
                        <div id="confirm-holder">
                        <button class="btn btn-primary" id="add-prg3">Ajouter</button>
                        <hr>
                        <div class="file-handle">
                        <input type="file" class="form-control" id="file">
                        <button class="btn btn-primary">Journal</button>
                        </div>
                        </div>
                 @endif

                 @if($leng == 3)
  <div class="form-container" id="creati-act">
                        <form >
                        <div class="form-group">
                        <label for="input1">N° ACTION</label>
                        <input type="text" class="form-control" id="num_act" placeholder="Donnee Nom ACTION">
                        </div>
                        <div class="form-group">
                        <label for="input1">Nom ACTION</label>
                        <input type="text" class="form-control" id="nom_act" placeholder="Donnee Nom ACTION">
                        </div>
                        <div class="form-group" id="ElAE_act">
                        <label for="input1">AE pour Action</label>
                        <input type="number" class="form-control" id="AE_act" placeholder="Donnee Nom ACTION">
                        </div>
                        <div class="form-group" id="ElCP_act">
                        <label for="input1">CP pour Action</label>
                        <input type="number" class="form-control" id="CP_act" placeholder="Donnee Nom ACTION">
                        </div>
                        <div class="form-group">
                        <label for="inputDate">Date Journal</label>
                        <input type="date" class="form-control" id="date_insert_action">
                        </div>
                        </form>
                        <br>
                        <div id="confirm-holder">
                        <button class="btn btn-primary" id="add-prg3">Ajouter</button>
                        <hr>
                        <div class="file-handle">
                        <input type="file" class="form-control" id="file">
                        <button class="btn btn-primary">Journal</button>
                        </div>
                        </div>
                 @endif

                 @if($leng == 2)
  <div class="form-container" id="creati-sous_prog">

                 <form >
                        <div class="form-group">
                        <label for="input1">N° Sous_Programme</label>
                        <input type="text" class="form-control" id="num_sousProg" placeholder="Donnee Nom Sous_Programme">
                        </div>
                        <div class="form-group">
                        <label for="input1">Nom Sous_Programme</label>
                        <input type="text" class="form-control" id="nom_sousProg" placeholder="Donnee Nom Sous_Programme">
                        </div>
                        <div class="form-group" id="ElAE_act">
                        <label for="input1">AE pour Sous_Programme</label>
                        <input type="number" class="form-control" id="AE_sousProg" placeholder="Donnee Nom Sous_Programme">
                        </div>
                        <div class="form-group" id="ElCP_act">
                        <label for="input1">CP pour Sous_Programme</label>
                        <input type="number" class="form-control" id="CP_sousProg" placeholder="Donnee Nom Sous_Programme">
                        </div>
                        <div class="form-group">
                        <label for="inputDate">Date Journal</label>
                        <input type="date" class="form-control" id="date_insert_sousProg">
                        </div>
                        </form>
                        <br>
                        <div id="confirm-holder">
                        <button class="btn btn-primary" id="add-prg2">Ajouter</button>
                        <hr>
                        <div class="file-handle">
                        <input type="file" class="form-control" id="file">
                        <button class="btn btn-primary">Journal</button>
                        </div>
                        </div>
    </div>                    
    <div class="form-container" id="creati-act" style="display:none">
                        <form >
                        <div class="form-group">
                        <label for="input1">N° ACTION</label>
                        <input type="text" class="form-control" id="num_act" placeholder="Donnee Nom ACTION">
                        </div>
                        <div class="form-group">
                        <label for="input1">Nom ACTION</label>
                        <input type="text" class="form-control" id="nom_act" placeholder="Donnee Nom ACTION">
                        </div>
                        <div class="form-group" id="ElAE_act">
                        <label for="input1">AE pour Action</label>
                        <input type="number" class="form-control" id="AE_act" placeholder="Donnee Nom Programme">
                        </div>
                        <div class="form-group" id="ElCP_act">
                        <label for="input1">CP pour Action</label>
                        <input type="number" class="form-control" id="CP_act" placeholder="Donnee Nom Programme">
                        </div>
                        <div class="form-group">
                        <label for="inputDate">Date Journal</label>
                        <input type="date" class="form-control" id="date_insert_action">
                        </div>
                        </form>
                        <br>
                        <div id="confirm-holder">
                        <button class="btn btn-primary" id="add-prg3">Ajouter</button>
                        <hr>
                        <div class="file-handle">
                        <input type="file" class="form-control" id="file">
                        <button class="btn btn-primary">Journal</button>
                        </div>
                        </div>
        </div>
                 @endif


                 @if($leng == 1)

                 <div class="form-container" id="creati-prog">

                 <form>
                        <div class="form-group">
                        <label for="input1">N° Programme</label>
                        <input type="text" class="form-control" id="num_prog" placeholder="Donnee Nom Programme">
                        </div>
                        <div class="form-group">
                        <label for="input1">Nom Programme</label>
                        <input type="text" class="form-control" id="nom_prog" placeholder="Donnee Nom Programme">
                        </div>
                        <div class="form-group" id="ElAE_act">
                        <label for="input1">AE pour Programme</label>
                        <input type="number" class="form-control" id="AE_prog" placeholder="Donnee Nom Programme">
                        </div>
                        <div class="form-group" id="ElCP_act">
                        <label for="input1">CP pour Programme</label>
                        <input type="number" class="form-control" id="AE_prog" placeholder="Donnee Nom Sous_Programme">
                        </div>
                        <div class="form-group">
                        <label for="inputDate">Date Journal</label>
                        <input type="date" class="form-control" id="date_insert_portef">
                        </div>
                        </form>
                        <br>
                        <div id="confirm-holder_prog">
                        <button class="btn btn-primary" id="add-prg1">Ajouter</button>
                        <hr>
                        <div class="file-handle">
                        <input type="file" class="form-control" id="file">
                        <button class="btn btn-primary">Journal</button>
                        </div>
                        </div>
    </div>                    
                
  <div class="form-container" id="creati-sous_prog" style="display:none">

                 <form >
                        <div class="form-group">
                        <label for="input1">N° Sous_Programme</label>
                        <input type="text" class="form-control" id="num_sousProg" placeholder="Donnee Nom Sous_Programme">
                        </div>
                        <div class="form-group">
                        <label for="input1">Nom Sous_Programme</label>
                        <input type="text" class="form-control" id="nom_sousProg" placeholder="Donnee Nom Sous_Programme">
                        </div>
                        <div class="form-group" id="ElAE_act">
                        <label for="input1">AE pour Sous_Programme</label>
                        <input type="number" class="form-control" id="AE_sousProg" placeholder="Donnee Nom Sous_Programme">
                        </div>
                        <div class="form-group" id="ElCP_act">
                        <label for="input1">CP pour Sous_Programme</label>
                        <input type="number" class="form-control" id="CP_sousProg" placeholder="Donnee Nom Sous_Programme">
                        </div>
                        <div class="form-group">
                        <label for="inputDate">Date Journal</label>
                        <input type="date" class="form-control" id="date_insert_sousProg">
                        </div>
                        </form>
                        <br>
                        <div id="confirm-holder_sprog">
                        <button class="btn btn-primary" id="add-prg2">Ajouter</button>
                        <hr>
                        <div class="file-handle">
                        <input type="file" class="form-control" id="file">
                        <button class="btn btn-primary">Journal</button>
                        </div>
                        </div>
    </div>                    
    <div class="form-container" id="creati-act" style="display:none">
                        <form >
                        <div class="form-group">
                        <label for="input1">N° ACTION</label>
                        <input type="text" class="form-control" id="num_act" placeholder="Donnee Nom ACTION">
                        </div>
                        <div class="form-group">
                        <label for="input1">Nom ACTION</label>
                        <input type="text" class="form-control" id="nom_act" placeholder="Donnee Nom ACTION">
                        </div>
                        <div class="form-group" id="ElAE_act">
                        <label for="input1">AE pour Action</label>
                        <input type="number" class="form-control" id="AE_act" placeholder="Donnee Nom Programme">
                        </div>
                        <div class="form-group" id="ElCP_act">
                        <label for="input1">CP pour Action</label>
                        <input type="number" class="form-control" id="CP_act" placeholder="Donnee Nom Programme">
                        </div>
                        <div class="form-group">
                        <label for="inputDate">Date Journal</label>
                        <input type="date" class="form-control" id="date_insert_action">
                        </div>
                        </form>
                        <br>
                        <div id="confirm-holder_act">
                        <button class="btn btn-primary" id="add-prg3">Ajouter</button>
                        <hr>
                        <div class="file-handle">
                        <input type="file" class="form-control" id="file">
                        <button class="btn btn-primary">Journal</button>
                        </div>
                        </div>
        </div>
                 @endif

<script src="{{asset('assets/bootstrap-5.0.2/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/fontawesome-free/js/all.js')}}"></script>
<script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
<script>
console.log('testing'+JSON.stringify(path))
$(document).ready(function(){
    $('.btn-primary').on('click',function(event){
        event.preventDefault(); // Prevents default button behavior
        id=$(this).attr('id')
        var indice=0;
        var isEmpty=false
        var formId = $(this).parents('.form-container').attr('id');
        console.log('this is '+id+'and form id'+formId);
        $('#' + formId+' form').find('input').each(function(){
            console.log('before the loop')
            var inputValue = $(this).val();

            // Check if the input is not empty
            if (inputValue.trim() === "") 
             {
                isEmpty = true;
                indice++;
             }
       

        if (isEmpty) {
            if(indice < 2)
            {
            alert("Please fill in all required fields.");
            }
            $(this).css('box-shadow','0 0 0 0.25rem rgb(255 0 0 / 47%)')
        }
    });
      


    if(id == "add-prg3")
    {
      
      let userResponse = confirm('Voulez-vous ajouter une sous-action pour cette action ?');
                                    if (userResponse) {
                                        // Récupération des informations de l'action
                                        $('#confirm-holder_act').empty()
                                        $('#confirm-holder_act').append('<i class="fas fa-wrench"></i>')
                                        var nom_act = $('#nom_act').val();
                                        var num_act = $('#num_act').val();
                                        var dat_inst = $('#date_insert_action').val();
                                        var id_sou_prog = path[2];
                                        var numaction_year = num_act + id_sou_prog;
                                        var nexthop = '<div class="pinfo-handle">' +
                                         '<i class="fas fa-wallet"></i>' +
                                         '<p >Action :</p>' +
                                          '<p>' + num_act + '</p>' +
                                           '</div>' +
                                          ' <div class="next-handle">' +
                                          '<i class="fas fa-angle-double-right waiting-icon"></i>' +
                                          '</div>'
                                        // Création du formData pour l'action
                                        var formdata_act = {
                                            num_action: numaction_year,
                                            nom_action: nom_act,
                                            date_insert_action: dat_inst,
                                            id_sous_prog: path[2],
                                            //id_prog: path[1],
                                            //id_porte: path[0],
                                            _token: $('meta[name="csrf-token"]').attr('content'),
                                            _method: 'POST'
                                        };

                                        // Envoi de l'Action via Ajax
                                        $.ajax({
                                            url: '/creationAction',
                                            type: 'POST',
                                            data: formdata_act,
                                            success: function (response) {
                                                if (response.code === 200 || response.code === 404) {
                                                    // Ajout du numéro de l'action au chemin
                                                    path.push(numaction_year);
                                                    path3.push(num_act);
                                                  
                                                    console.log('A path: ' + JSON.stringify(path));
                                                    $('#confirm-holder_act').empty()
                                                    $('#confirm-holder_act').append('<i class="fas fa-wrench"></i>')
                                                    // Création du formulaire pour la sous-action après l'ajout de l'action
                                                    var prg4 = `<div class="form-container">
                                                           <form>
                                                            <div class="form-group">
                                                            <label for="num_sous_act">N°Sous ACTION</label>
                                                            <input type="text" class="form-control" id="num_sous_act" placeholder="Donner le code Sous ACTION">
                                                           </div>
                                                            <div class="form-group">
                                                                <label for="nom_sous_act">Nom Sous ACTION</label>
                                                            <input type="text" class="form-control" id="nom_sous_act" placeholder="Donner le Nom Sous ACTION">
                                                            </div>
                                                               <div class="form-group">
                                                                <label for="AE_sous_act">AE pour Sous Action</label>
                                                                <input type="number" class="form-control" id="AE_sous_act">
                                                            </div>
                                                            <div class="form-group">
                                                              <label for="CP_sous_act">CP pour Sous Action</label>
                                                            <input type="number" class="form-control" id="CP_sous_act">
                                                               </div>
                                                               <div class="form-group">
                                                                 <label for="date_insert_sou_action">Date Journal</label>
                                                                 <input type="date" class="form-control" id="date_insert_sou_action">
                                                               </div>
                                                               </form>
                                                               <br>
                                                               <button class="btn btn-primary" id="add-prg4">Ajouter Sous Action</button>
                                                               </div>`;

                                                    // Insertion du formulaire pour la sous-action dans le DOM
                                                    $('.the-path').append(nexthop)
                                                    $('#progam-handle').append(prg4);

                                                    // Ajout de l'événement d'ajout pour la sous-action
                                                    $('#add-prg4').on('click', function () {
                                                        console.log('inside sous_action')
                                                        var nom_sous_act = $('#nom_sous_act').val();
                                                        var num_sous_act = $('#num_sous_act').val();
                                                        var dat_inst = $('#date_insert_sou_action').val();
                                                        var numaction_year = path[3];
                                                        var numsousaction_year = num_sous_act + numaction_year;
                                                        // Création du formData pour la sous-action
                                                        var formdata_sous_act = {
                                                            num_sous_action: numsousaction_year,
                                                            nom_sous_action: nom_sous_act,
                                                            date_insert_sous_action: dat_inst,
                                                            num_act: path[3],
                                                            //id_sous_act: path[2],
                                                            //id_prog: path[1],
                                                           // id_porte: path[0],
                                                            //year: year,
                                                            _token: $('meta[name="csrf-token"]').attr('content'),
                                                            _method: 'POST'
                                                        };

                                                        // Envoi de la sous-action via Ajax
                                                        $.ajax({
                                                            url: '/creationsousAction',
                                                            type: 'POST',
                                                            data: formdata_sous_act,
                                                            success: function (response) {
                                                                if (response.code === 200 || response.code === 404) {
                                                                    path.push(numsousaction_year);
                                                                    path3.push(num_sous_act);
                                                                    console.log('path: ' + JSON.stringify(path));

                                                                    // Redirection vers la page suivante après l'ajout de la sous-action
                                                                    alert('testing')
                                                                    window.location.href = 'testing/S_action/' + path.join('/');
                                                                }
                                                            },
                                                            error: function (response) {
                                                                alert('Erreur lors de l\'ajout de la sous-action.');
                                                            }
                                                        });
                                                    });
                                                }
                                            },
                                            error: function (response) {
                                                alert('Erreur lors de l\'ajout de l\'action.');
                                            }
                                        });
                                    } else {
                                        // Cas où l'utilisateur n'ajoute pas de sous-action
                                        var nom_act = $('#nom_act').val();
                                        var num_act = $('#num_act').val();
                                        var dat_inst = $('#date_insert_action').val();
                                        var id_sou_prog = path[2];
                                        var numaction_year = num_act + id_sou_prog;

                                        var formdata_act = {
                                            num_action: numaction_year,
                                            nom_action: nom_act,
                                            date_insert_action: dat_inst,
                                            id_sous_prog: id_sou_prog,
                                            //id_prog: path[1],
                                            //id_porte: path[0],
                                            _token: $('meta[name="csrf-token"]').attr('content'),
                                            _method: 'POST'
                                        };

                                        $.ajax({
                                            url: '/creationAction',
                                            type: 'POST',
                                            data: formdata_act,
                                            success: function (response) {
                                                if (response.code === 200 || response.code === 404) {
                                                    path.push(numaction_year);
                                                    path3.push(num_act);
                                                    // console.log('path: ' + JSON.stringify(path));
                                                    window.location.href = '/testing/Action/' + path.join('/');
                                                }
                                            },
                                            error: function (response) {
                                                alert('Erreur lors de l\'ajout de l\'action.');
                                            }
                                        });
                                    }

    }
    if(id == "add-prg2")
    {
      var parent=$(this).parent() 
      var sou_prog = $('#num_sousProg').val()
                    var nom_sou_prog = $('#nom_sousProg').val();
                    var dat_sou_prog = $('#date_insert_sousProg').val()
                    var ae_sou_prog = $('#AE_sousProg').val();
                    var cp_sou_prog = $('#CP_sousProg').val();
                    var id_prog = path[1];
                    var numsouprog_year = sou_prog + id_prog;
                    var nexthop = '<div class="pinfo-handle">' +
                        '<i class="fas fa-wallet"></i>' +
                        '<p >S_Program :</p>' +
                        '<p>' + sou_prog + '</p>' +
                        '</div>' +
                        ' <div class="next-handle">' +
                        '<i class="fas fa-angle-double-right waiting-icon"></i>' +
                        '</div>'
                    var formdatasou_prog = {
                        num_sous_prog: numsouprog_year,
                        nom_sous_prog: nom_sou_prog,
                        date_insert_sousProg: dat_sou_prog,
                        id_program: id_prog,
                        //id_porte: id_port,
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        _method: 'POST'
                    }
                    console.log('data' + JSON.stringify(formdatasou_prog))
                    $.ajax({
                        url: '/creationSousProg',
                        type: "POST",
                        data: formdatasou_prog,
                        success: function (response) {
                            if (response.code == 200 || response.code == 404)
                             {
                             alert(response.message)
                             path.push(numsouprog_year);
                             $('.the-path').append(nexthop)
                             parent.empty();
                             parent.append('<i class="fas fa-wrench"></i>')
                              document.getElementById("creati-act").style.display="block";
                            // path3.push(id_prog);
                              }
    }
  })
}
    if(id == "add-prg1")
    {
     
      var id_prog = $('#num_prog').val();
    var nom_prog = $('#nom_prog').val();
    var Ae_prog = $('#AE_prog').val();
    var Cp_prog = $('#CP_prog').val();
    var numprog_year = id_prog + path[0];
    var nexthop = '<div class="pinfo-handle">' +
        '<i class="fas fa-wallet"></i>' +
        '<p >Programm :</p>' +
        '<p>' + id_prog + '</p>' +
        '</div>' +
        ' <div class="next-handle">' +
        '<i class="fas fa-angle-double-right waiting-icon"></i>' +
        '</div>';
    var date_sort_jour = $('#date_insert_portef').val();
    var parent=$(this).parent()
    var formprogdata = {
        num_prog: numprog_year,
        nom_prog: nom_prog,
        ae_prog:Ae_prog,
        cp_prog:Cp_prog,
        num_portefeuil: path[0],
        date_insert_portef: date_sort_jour,
        _token: $('meta[name="csrf-token"]').attr('content'),
        _method: 'POST'
    }
    $.ajax({
        url: '/creationProg',
        type: "POST",
        data: formprogdata,
        success: function (response) {
            if (response.code == 200 || response.code == 404) {

                alert(response.message)
                path.push(numprog_year);
                $('.the-path').append(nexthop)
                console.log('testing'+numprog_year);
              
               parent.empty();
               parent.append('<i class="fas fa-wrench"></i>')
               document.getElementById("creati-sous_prog").style.display="block";
      }
      else
      {
        alert(response.message)
      }
    }
    })
  }
    })
    
})

</script>
 </body>

</html>