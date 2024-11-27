$(document).ready(function(){
    $('.update-handl').on('click',function(){
      var id=$(this).parent().parent().attr('id');
      console.log('file loading  '+id)
      $.ajax({
        url:'/check-prog',
        Type:'GET',
        data:{
            num_prog:id
        },
        success:function(response)
        {
            /*
            'exists' => true,
                'nom_prog' => $prog->nom_prog,
                'num_prog' => $prog->num_prog,
            */
           if(response.exists)
           {
            $('#id_sprog_modif').text(response.nom_prog);
           }
        }
      })
      $(this).css('color','red')
        var inputfile='<div class="confirm-file-handle"><form>'+
                      '<input type="file" class="form-control" id="file" accept=".pdf, .jpg, .jpeg, .png">'+
                      ' </form>'+
                      '<button class="button-70" role="button">joindre fichier</button></div>'
    $('.confirm-justfie').addClass('setit-back')
    $('.confirm-justfie').append(inputfile)
    $('.float-export').css('display','none');  
    $('.confirm-justfie').on('click',function(){
      $(this).empty()
      $(this).removeClass('setit-back');
      $('.member .update-handl').css('color','black')
      $('.float-export').css('display','block');
    })
    /*$('.modif-contiant').on('click',function(){
      $(this).removeClass('setit-insert');
      $('.member .update-handl').css('color','black')
      $('.float-export').css('display','block');
    })*/
    $('.button-70').on('click',function(){
  $('.float-export').css('display','block'); 
  $('.modif-contiant').addClass('setit-insert');
  $('.modif-handler').css('display','block');
  $('#T1').click(function(){
  if ($(this).is(':checked')) {
   $('#T1-inpt-handle').css('display','flex')
     // Checkbox is checked
          } else {
         // Checkbox is unchecked
   console.log($(this).val() + " is unchecked.");
   $('#T1-inpt-handle').css('display','none')
       }
     });
     $('#T2').click(function(){
  if ($(this).is(':checked')) {
     // Checkbox is checked
   console.log($(this).val() + " is checked.");
   $('#T2-inpt-handle').css('display','flex')
          } else {
         // Checkbox is unchecked
   console.log($(this).val() + " is unchecked.");
   $('#T2-inpt-handle').css('display','none')
       }
     });
     $('#T3').click(function(){
  if ($(this).is(':checked')) {
     // Checkbox is checked
   console.log($(this).val() + " is checked.");
   $('#T3-inpt-handle').css('display','flex')
          } else {
         // Checkbox is unchecked
   console.log($(this).val() + " is unchecked.");
   $('#T3-inpt-handle').css('display','none')
       }
     });
     $('#T4').click(function(){
  if ($(this).is(':checked')) {
     // Checkbox is checked
   console.log($(this).val() + " is checked.");
   $('#T4-inpt-handle').css('display','flex')
          } else {
         // Checkbox is unchecked
   console.log($(this).val() + " is unchecked.");
   $('#T4-inpt-handle').css('display','none')
       }
     });
  $('input[name="type_modif"]').change(function () {
     const selectedHobby = $('input[name="type_modif"]:checked').val();
   if (selectedHobby === "inter") {
    console.log('testing radio'+selectedHobby);
    var chose ='<div class="form-group">'+
    ' <label for="input1">Action a Reterie montant</label>'+
    '<select type="text" class="form-control" id="id-retire" placeholder="Entrer le Nom du Programme">'+
    '<option id="0" >Selectionner Article</option>'+
    '<option id="1" >Action 01</option>'+
    '<option id="2" >Action 01</option>'+
    '</select>'+
    '</div>';
    $('.add-envoi').append(chose);
      let selectedret = $('#id-retire').val();
      if (selectedret != '0') {
        $('.add-envoi').append('<hr>');
        var choseT ='<div class="form-group">'+
    ' <label for="input1">Tport Reterie montant</label>'+
    '<select type="text" class="form-control" id="id-T-retire" placeholder="Entrer le Nom du Programme">'+
    '<option id="T0" >Selectionner TPort</option>'+
    '<option id="T1" >Port 01</option>'+
    '<option id="T2" >Port 02</option>'+
    '<option id="T3" >Port 03</option>'+
    '<option id="T4" >Port 04</option>'+
    '</select>'+
    '</div>';
    $('.add-envoi').append(choseT);
    let selectTret =$('#id-T-retire').val();
    if(selectTret !== 'T0')
    {
      let ipnst='<div id="T4-inpt-handle" >'+
                 '<label for="Tports">AE</label>'+
                 '<input type="number" class="form-control" id="AE_T4" name="interest" />'+
                  '<label for="number">CP</label>'+
                  '<input type="number" class="form-control" id="CP_T4" name="interest" />'+
                  '</div>';
    $('.add-envoi').append('<hr>');
    $('.add-envoi').append(ipnst);
    }
    else
    {
      console.log('nothing is selected of radios '+selectTret )
    }
      } else {
        
        console.log('nothing is selected Action that will give '+selectedret)
      }
     } else {
     console.log('nothing is selected type of interaction '+selectedHobby)
     $('.add-envoi').empty();
     $('.float-export').css('display','block');
    }

})
    })
  })
})