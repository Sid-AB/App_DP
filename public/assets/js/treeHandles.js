

function upload_file(id_file,id_relat)
{

   let formDataFa = new FormData();
   formDataFa.append('pdf_file', $('#'+id_file)[0].files[0]);
   formDataFa.append('related_id',id_relat);
   $.ajax({
       url:'/upload-pdf',
       type:'POST',
       data:formDataFa,
       processData: false,
       contentType: false,
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token
       },
       success:function(response)
       {
           if(response.code)
           {
          return response.code
         }
           else
           {
               return response.message;
           }
       }
   })

}


function preview(file)
{
       
    $('#'+file).on('change', function(event) {
      const file = event.target.files[0];
      const $preview = $('#preview');
      $preview.html(''); // Clear previous content
        console.log('inside preview')
      if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
          const fileURL = e.target.result;

          if (file.type.startsWith('image/')) {
            const $img = $('<img>').attr('src', fileURL);
            $preview.append($img);
          } else if (file.type === 'application/pdf') {
            const $iframe = $('<iframe>', {
              src: fileURL,
              width: '100%',
              height: '600px'
            });
            $preview.append($iframe);
          } else {
            $preview.text('Unsupported file type!');
          }
        };
        reader.readAsDataURL(file);
      }
    });
}


function formatAccountingFigures() {
  $('.chiffre').each(function() {
      // Get the current text
      let text = $(this).text();
      
      // Remove non-numeric characters (except dots)
      let formatted = text.replace(/[^0-9.]/g, '');
      
      // Format as a number with commas (optional)
      formatted = parseFloat(formatted).toLocaleString('dz-DZ', { 
          minimumFractionDigits: 2, 
          maximumFractionDigits: 2 
      });

      // Update the element's text
      $(this).text(formatted);
  });
}

$(document).ready(function(){
  var change = false;
  var AE_T1=0
  var CP_T1=0
  var T1select=false
  var AE_T2=0
  var CP_T2=0
  var T2select=false
  var AE_T3=0
  var CP_T3=0
  var T3select=false
  var AE_T4=0
  var CP_T4=0
  var T4select=false
  var type;
  let selectTret ='T0';
  let  selectedHobby='t'
  let selectedprogret ='';
  let selectdsousret='';
  var prognum='';
  var sousprogbum='';
  var progs={};
  var type_ext=""
  var sousProgs={};
  var code_port='';
  var type_port='';
  var AE_port=0;
  var CP_port=0;
  var act_cible_ret='';
  var act_cible_env='';

    $('.update-handl').on('click',function(){
      var id=$(this).parent().parent().attr('id');
      var port=$('.family-tree').attr('id');
      console.log('file loading  '+id)
  
      $.ajax({
        url:'/allaction/'+port,
        type:'GET',
        success:function(response)
        {
          if(response.exists)
          {
            progs=response.programs
            sousProgs=response.sous_programs
            console.log('sous prog'+JSON.stringify(sousProgs)+' and prog'+JSON.stringify(progs))  

            response.actions.forEach(element => {
              console.log('append'+JSON.stringify(element.actions) )
              $('#id_cible').append("<option value="+element.actions.actions_num+">"+element.actions.actions_name+"</option>")
            });
          
          }
        }
      })
     
      $(this).css('color','red')
        var inputfile='<div class="confirm-file-handle"><form>'+
                      '<input type="file" class="form-control" id="file" accept=".pdf, .jpg, .jpeg, .png" required>'+
                      ' </form>'+
                      '<button class="button-70" id="button-70"  role="button">joindre fichier</button></div>';
    $('.confirm-justfie').addClass('setit-back')
    $('.form_holder_modif').append(inputfile)
    preview('file')
    $('.confirm-justfie').append('<div class="preview_window"><div id="preview"></div></div>')
    $('.float-export').css('display','none');  
    $('.confirm-justfie').on('click',function(){
      $('.form_holder_modif').empty()
      $(this).removeClass('setit-back');
      $('.member .update-handl').css('color','black')
      $('.float-export').css('display','block');
      
    })
    $('.modif-contiant').on('click',function(){
      $(this).removeClass('setit-insert');
      $('.member .update-handl').css('color','black')
      $('.modif-handler').css('display','none')
      $('.float-export').css('display','block');
      $('#id_cible').empty()
      $('#id-retire').empty()
      window.location.reload();
    })
    $('#button-70').on('click',function(){
    if ($('#file').prop('files').length !== 0)
    {
      $('.confirm-justfie').empty()
      $('.form_holder_modif').empty()
  $('.float-export').css('display','block'); 
  $('.modif-contiant').addClass('setit-insert');
  $('.modif-handler').css('display','block');
  $('#T1').click(function(){
  if ($(this).is(':checked')) {
   $('#T1-inpt-handle').css('display','flex')
     // Checkbox is checked
    T1select=true
          } else {
         // Checkbox is unchecked
   console.log($(this).val() + " is unchecked.");
   $('#T1-inpt-handle').css('display','none')
        AE_T1=0
        CP_T1=0
        T1select=false
       }
     });
     $('#T2').click(function(){
  if ($(this).is(':checked')) {
     // Checkbox is checked
   console.log($(this).val() + " is checked.");
   $('#T2-inpt-handle').css('display','flex')
   T2select=true
          } else {
         // Checkbox is unchecked
   console.log($(this).val() + " is unchecked.");
   $('#T2-inpt-handle').css('display','none')
   AE_T2=0
   CP_T2=0
   T2select=false
       }
     });
     $('#T3').click(function(){
  if ($(this).is(':checked')) {
     // Checkbox is checked
   console.log($(this).val() + " is checked.");
   $('#T3-inpt-handle').css('display','flex')
   T3select=true
          } else {
         // Checkbox is unchecked
   console.log($(this).val() + " is unchecked.");
   $('#T3-inpt-handle').css('display','none')
   AE_T3=0
   CP_T3=0
   T3select=false
       }
     });
     $('#T4').click(function(){
  if ($(this).is(':checked')) {
     // Checkbox is checked
   console.log($(this).val() + " is checked.");
   $('#T4-inpt-handle').css('display','flex')
   T4select=true
          } else {
         // Checkbox is unchecked
   console.log($(this).val() + " is unchecked.");
   $('#T4-inpt-handle').css('display','none')
   AE_T4=0
   CP_T4=0
   T4select=false
       }
     });



 $('#id_env').on('change',function(){
      sousprogbum=$(this).val();
      var selectACT_ret='<div class="form-group">'+
       ' <label for="input1">L\'action destinataire </label>'+
          '<select type="text" class="form-control" id="id_cible_env" placeholder="Entrer le Nom du Programme">'+
           '<option value="0" >Séléctionner l\'action</option>'+
          '</select>'+
        '</div>';
      $.ajax({
        url:"/progrma_from_sous/"+sousprogbum,
        type:'GET',
        success:function(response)
        {
          if(response.exists)
          {
          
            $('#prog_env').empty()
            var inpsts='<hr><label>Appartenant au programme :</label><p type="text" class="id_prog_env" id="'+response.prog.num_prog+'">'+response.prog.nom_prog+'</p><hr>'
            $('#prog_env').append(inpsts);
            $('#prog_env').append(selectACT_ret);
            prognum=response.prog.num_prog;
            console.log('reponse'+JSON.stringify(response.act))
            response.act.forEach(element=>{
              var opts="<option value="+element.num_sous_action+">"+element.nom_sous_action+"</option>";
              $('#id_cible_env').append(opts);
              $('#id_cible_env').change(function(){
                act_cible_env=$(this).val();
              })
            })
          }
        }
      })
 })




  $('input[name="type_modif"]').change(function () {
    selectedHobby = $('input[name="type_modif"]:checked').val();
   if (selectedHobby === "inter") {
    $('#button-71').prop("disabled", false)
    $("#dif").text('Le sous-programme destinataire')
    $('.exter_type').empty();
    console.log('testing radio'+selectedHobby);
    var chose ='<div class="form-group">'+
    ' <label for="input1">Le sous-programme source</label>'+
    '<select class="form-control" id="id-retire_sous_prog" >'+
    '<option value="0" >Séléctionner le Sous Programme</option>'+
    '</select>'+
    '</div><div class="section-env"></div><hr>';
    $('.add-envoi').append(chose);
    if(Object.keys(sousProgs).length !=0)
    {
        sousProgs.forEach(element=>{
          $('#id-retire_sous_prog').append("<option value="+element.sous_programs.sous_progs_num+">"+element.sous_programs.sous_progs_name+"</option>")
         }) 
    }
    
    var choseT ='<div id="prog_ret"></div><div class="form-group">'+
    ' <label for="input1">Tports source</label>'+
    '<select class="form-control" id="id-T-retire">'+
    '<option value="T0" >Séléctionner TPort</option>'+
    '<option value="T1" >Port 01</option>'+
    '<option value="T2" >Port 02</option>'+
    '<option value="T3" >Port 03</option>'+
    '<option value="T4" >Port 04</option>'+
    '</select>'+
    '</div>'+
    '<div class="Tenv-inpt-handle" >'+
     '</div>';
      $('#id-retire_sous_prog').on('change',function(){
        console.log('i act chnage')
        var selectACT_ret='<div class="form-group">'+
        ' <label for="input1">L\'action source</label>'+
           '<select type="text" class="form-control" id="id_cible_ret" placeholder="Entrer le Nom du Programme">'+
            '<option value="0" >Séléctionner l\'action</option>'+
           '</select>'+
         '</div>';
        selectdsousret = $('#id-retire_sous_prog').val();  
        $.ajax({
          url:"/progrma_from_sous/"+selectdsousret,
          type:'GET',
          success:function(response)
          {
            if(response.exists)
            {
              $('#prog_ret').empty()
              var inpsts='<hr><label>appartenant au programme :</label><p type="text" class="id-retire_prog" id="'+response.prog.num_prog+'">'+response.prog.nom_prog+'</p>'
              $('#prog_ret').append(inpsts);
              $('#prog_ret').append(selectACT_ret);
              selectedprogret=response.prog.num_prog;
              console.log('reponse'+response.prog.num_prog)
              response.act.forEach(element=>{
                var opts="<option value="+element.num_sous_action+">"+element.nom_sous_action+"</option>";
                $('#id_cible_ret').append(opts);
                $('#id_cible_ret').change(function(){
                  act_cible_ret=$(this).val();
                })
              })
            }
          }
        })
        console.log('i act chnage')
        selectedprogret = $('.id-retire_prog').attr('id');
        if (selectedprogret != '0') {
          console.log('i act chnage inside')
      
      if(change == false)
      {
      $('.add-envoi').append('<hr>');
      $('.section-env').append(choseT);
      }
      change= true;
      var init='<label for="Tports">AE</label>'+
      '<input type="number" class="form-control" id="AE_env_T" name="interest" />'+
       '<label for="number">CP</label>'+
       '<input type="number" class="form-control" id="CP_env_T" name="interest" />';
      $('#id-T-retire').on('change',function(){
      $('.Tenv-inpt-handle').empty()
       selectTret =$('#id-T-retire').val();
       if(selectTret !== 'T0')
        {
          console.log('all inside')
        $('.Tenv-inpt-handle').append(init);
       
        }
        else
        {
          console.log('nothing is selected of radios '+selectTret )
        }
      })
      
        } else {
          
          console.log('nothing is selected Action that will give '+selectedprogret)
        }
      })

     } else {
      $('.Tenv-inpt-handle').empty();
      $('.section-env').empty();
     $('.add-envoi').empty();
      if(selectedHobby == "exter")
      {
        $('#button-71').prop("disabled", false)
        $("#dif").text('Le sous-programme destinataire/source')
        $('.exter_type').empty()
        $("#dif").text('Sous Programme de L`Operation')
        var type_extr='<div>'+
        '<label for="Tports">Recvoire</label>'+
         '<input type="radio" class="form-check-input" id="exter_res" name="type_extr" value="res" />'+
        '</div>'+
        '<div>'+
        '<label for="Tports">Envoyer</label>'+
        '<input type="radio" class="form-check-input" id="extr_env" name="type_extr" value="env" />'+
        '</div>';
       
        $('.exter_type').append(type_extr);
        $('input[name="type_extr"]').change(function()
      {
        type_ext=$('input[name="type_extr"]:checked').val();
      })
    }
    else
    if(selectedHobby === 'exter_port')
    {
      $('#button-71').prop("disabled", false)
      $('.exter_type').empty()
        var init_port='<div>'+
       ' <div>'+
          '  <label for="Tports">Choisir :</label>'+
                '<select class="form-control" id="Type_op_port">'+
                  '  <option value="recoit_port">'+
                        'Réception'+
                   ' </option>'+
                   ' <option value="envoi_port">'+
                       'Envoi'+
                 '   </option>'+
              '  </select>'+
       ' </div>'+
       '<br>'+
       ' <div>'+
           ' <label for="Tports">Code du Portefeuille Externe :</label><input type="text" class="form-control" id="Code_port" name="interest">'+
      '  </div>'+
       ' <label> Montant du Portefeuille Externe :</label><br>'+
    '<label for="Tports">AE</label><input type="number" class="form-control" id="AE_Port" name="interest"><label for="number">CP</label><input type="number" class="form-control" id="CP_Port" name="interest"></div>';
       $('.exter_type').append(init_port)
       $('#Type_op_port').change(function(){
        console.log('testing changing '+$(this).val());
        type_port=$(this).val();
       });
    }
      else
      {
        $('.Tenv-inpt-handle').empty();
      $('.section-env').empty();
     $('.add-envoi').empty();
      }
     console.log('nothing is selected type of interaction '+selectedHobby)
     $('.float-export').css('display','block');
    }

})


$('#button-71').on('click',function(){
  if(selectedHobby.trim() != ''){
    
  if(T1select == true)
  {
    AE_T1=$('#AE_T1').val();
    CP_T1=$('#CP_T1').val();
  }
  if(T2select == true)
  {
    AE_T2=$('#AE_T2').val();
    CP_T2=$('#CP_T2').val();
  }
  if(T3select == true)
  {
    AE_T3=$('#AE_T3').val();
    CP_T3=$('#CP_T3').val();   
  }
  if(T4select == true)
  {
    AE_T4=$('#AE_T4').val();
    CP_T4=$('#CP_T4').val();     
  }
  var cmpt=false;
  if(selectTret === '0' || selectedprogret === '' && selectedHobby === 'inter' && $('#id_cible').val() === '0')
  {
    cmpt=false
  }
  else
  {
    if(selectTret !== '0' && selectedprogret !== '' && selectedHobby === 'inter' && $('#id_cible').val() !== '0')
    {
      cmpt=true;
    }
  }
  if(selectedHobby === 'exter' && $('#id_cible').val() !== '0')
  {
    cmpt=true;
  } 

  code_port=$('#Code_port').val()
  AE_port=$('#AE_Port').val()
  CP_port=$('#CP_Port').val()

  var datamodif={
    ref:$('#id').val(),
    id_port:port,
     AE_T1:parseFloat(AE_T1),
     CP_T1:parseFloat(CP_T1),
     AE_T2:parseFloat(AE_T2),
     CP_T2:parseFloat(CP_T2),
     AE_T3:parseFloat(AE_T3),
     CP_T3:parseFloat(CP_T3),
     AE_T4:parseFloat(AE_T4),
     CP_T4:parseFloat(CP_T4),
     T_port_env:selectTret,
     AE_env_T: parseFloat($('#AE_env_T').val()),
     CP_env_T: parseFloat($('#CP_env_T').val()),
     prog_retirer:selectedprogret,
     Sous_prog_retire:selectdsousret,
     type:selectedHobby,
     prognum_click:prognum,
     sousprogbum_click:sousprogbum,
     type_extr:type_ext,
     act_cible_env:act_cible_env,
     act_cible_ret:act_cible_ret,
     status:cmpt,
     code_port:code_port,
     type_port:type_port,
     AE_port:AE_port,
     CP_port:CP_port,
     _token: $('meta[name="csrf-token"]').attr("content"),
     _method: "POST",
  }
  console.log('testing all'+JSON.stringify(datamodif));
  $.ajax({
    url:'/updateModif',
    type:'POST',
    data:datamodif,
    success:function(response)
    {
      
      if(upload_file('file',act_cible_env) == 200)
      {
          console.log('Réponse du serveur:', response);
      }
      else
      {
        alert('File upload')
      }
    },
    error: function(xhr, status, error) {
      //  console.log('Erreur AJAX:', status, error);
      //  console.log('Détails de la réponse:', xhr.responseText);
    }
  })

  $('.Tenv-inpt-handle').empty();
      $('.section-env').empty();
     $('.add-envoi').empty();
     $('#T1').prop("checked", false)
     $('#T2').prop("checked", false)
     $('#T3').prop("checked", false)
     $('#T4').prop("checked", false)
     $('#intr').prop("checked", false)
     $('#extr_port').prop("checked", false)
    $('#AE_T1').val('')
    $('#CP_T1').val('')
    $('#AE_T2').val('')
    $('#CP_T2').val('')
    $('#AE_T3').val('')
    $('#CP_T3').val('')
    $('#AE_T4').val('')
    $('#CP_T4').val('')
     change=false;}
     else
     {
      $('#button-71').prop("disabled", false)
     }
})
    }
    else
    {
      alert('Obligation de joindre fichier or pv')
    }
/*** end of button 70 */
})
  })
  formatAccountingFigures()



  /**
   * function of checking files
   */

    var elment=$('.two_handel');

    elment.each(function(){
      var ids = $(this).attr('id');
      var id=ids.split('_')  
      $.ajax({
        type:'GET',
        url:'/check-pdf/'+id[0],
        success:function(response)
        {
          if(response.code == 404)
          {
            $("#"+ids+' .file_handler').addClass('scale-hidden')
           // console.log('#class="two_handel"'+ids);
          }
        }
      })
    })
  /**
   * ending
   */
})