var click=0;
var changing_mist=new Object();
var value_chng=new Array()
function Edit()
{
$(document).ready(function () {
  var old;
  // Add double-click event to all cells with the class "editable"
  $('.editable').on('click',function(){
    let cell = $(this);  // Reference to the clicked cell
    old = cell.text();
  })
  $('.editable').dblclick(function () {
    var clickid=$(this).attr('id');
    var clickedRow = $(this).closest('tr');
    var code=clickedRow.find('td:first-child');
      let cell = $(this);  // Reference to the clicked cell
      var currentText = cell.text();  // Get current text
      console.log('odl '+code.text())
      // Create an input element and set its value
      let input = $('<input type="number" step="0.01" class="form-control" />').val(currentText);
      cell.html(input);  // Replace the cell content with the input
      input.focus();  // Focus on the input immediately

      // When the input loses focus, update the cell with new text
      input.blur(function () {
          let newText = $(this).val();  // Get new value from input
         
          if( newText != 0 && newText != '' && newText != null)
          {
            mount_chang=true
           
           if( mount_chang == true)
          { 
            console.log('tesing'+newText)
            click++;
            if( click == 1 ){
            var buttons='<button class="btn btn-primary" id="changin"> appliquer</button>'}
            $('.change_app').append(buttons)
            $('#changin').on('click',function(){
              console.log('result'+JSON.stringify(value_chng))
          //    alert('changing success')
              $('.change_app').empty()
            })
          }
          value_chng.push({'code':code.text(),'values':{'type':clickid,'chiffre':newText}})
          cell.text(newText);
        }
        else
        {
          cell.empty();
          cell.text(old)
        }
            // Set the new value back to the cell
      });

      // Optionally, save when Enter key is pressed
      input.keydown(function (event) {
          if (event.key === 'Enter') {
              input.blur();  // Trigger blur event to save and exit input mode
          }
      });
  });
  
});
}

function add_T1()
{
  var T1='<div class="col-md-15 hover-container" id="T1-card-handle">'+
  '<div class="card">'+
 ' <div class="icon-holder">'+
      '<i class="fas fa-door-closed default-icon icon icon-card"></i>'+
      '<i class="fas fa-door-open hover-icon icon icon-card"></i>'+
      '</div>'+
      '<div class="card-body" id="T-card_button">'+
          '<h5 class="card-title">Titre 1</h5>'+
         ' <p class="card-text">Description pour Titre 1.</p>'+
          '<button class="btn btn-primary bts" id="T1">Vers Les Operation</button>'+
      '</div>'+
  '</div>'+
'</div>'
$('#T1-handle').append(T1)
}
function add_T2()
{
  var T1='<div class="col-md-15 hover-container" id="T2-card-handle">'+
  '<div class="card">'+
 ' <div class="icon-holder">'+
      '<i class="fas fa-door-closed default-icon icon icon-card"></i>'+
      '<i class="fas fa-door-open hover-icon icon icon-card"></i>'+
      '</div>'+
      '<div class="card-body" id="T-card_button">'+
          '<h5 class="card-title">Titre 2</h5>'+
         ' <p class="card-text">Description pour Titre 2.</p>'+
          '<button class="btn btn-primary bts" id="T2">Vers Les Operation</button>'+
      '</div>'+
  '</div>'+
'</div>'
$('#T2-handle').append(T1)
}
function add_T3()
{
  var T1='<div class="col-md-15 hover-container" id="T3-card-handle">'+
  '<div class="card">'+
 ' <div class="icon-holder" >'+
      '<i class="fas fa-door-closed default-icon icon icon-card"></i>'+
      '<i class="fas fa-door-open hover-icon icon icon-card"></i>'+
      '</div>'+
      '<div class="card-body" id="T-card_button">'+
          '<h5 class="card-title">Titre 3</h5>'+
         ' <p class="card-text">Description pour Titre 3.</p>'+
          '<button class="btn btn-primary bts" id="T3">Vers Les Operation</button>'+
      '</div>'+
  '</div>'+
'</div>'
$('#T3-handle').append(T1)
}
function add_T4()
{
  var T1='<div class="col-md-15 hover-container" id="T4-card-handle">'+
  '<div class="card">'+
 ' <div class="icon-holder">'+
      '<i class="fas fa-door-closed default-icon icon icon-card"></i>'+
      '<i class="fas fa-door-open hover-icon icon icon-card"></i>'+
      '</div>'+
      '<div class="card-body" id="T-card_button">'+
          '<h5 class="card-title">Titre 4</h5>'+
         ' <p class="card-text">Description pour Titre 4.</p>'+
          '<button class="btn btn-primary bts" id="T4">Vers Les Operation</button>'+
      '</div>'+
  '</div>'+
'</div>'
$('#T4-handle').append(T1)
}
function T1_newform()
{
  var newT='<div class="TP-handle">'+
  ' <div class="card-T">'+
     '<div class="container-card bg-yellow-box">'+
       '<!--i class="fas fa-door-closed T-icon"></i-->'+
       '<i class="fas fa-door-open T-icon"></i>'+
       '<p class="card-title-T">Titre Port 1</p>'+
      ' <p class="card-description-T">AE 190,000 DZ.</p>'+
      ' <p class="card-description-T">CP 100,000 DZ.</p>'+
      ' <button id="T1">...</button>'+
     '</div>'+
   '</div>'+
   '</div>'
   $('#T1-handle').append(newT)
}
function T2_newform()
{
  var newT='<div class="TP-handle">'+
  ' <div class="card-T">'+
     '<div class="container-card bg-yellow-box">'+
       '<!--i class="fas fa-door-closed T-icon"></i-->'+
       '<i class="fas fa-door-open T-icon"></i>'+
       '<p class="card-title-T">Titre Port 2</p>'+
      ' <p class="card-description-T">AE 290,000 DZ.</p>'+
      ' <p class="card-description-T">CP 100,000 DZ.</p>'+
      ' <button id="T2">...</button>'+
     '</div>'+
   '</div>'+
   '</div>'
   $('#T2-handle').append(newT)
}
function T3_newform()
{
  var newT='<div class="TP-handle">'+
  ' <div class="card-T">'+
     '<div class="container-card bg-yellow-box">'+
       '<!--i class="fas fa-door-closed T-icon"></i-->'+
       '<i class="fas fa-door-open T-icon"></i>'+
       '<p class="card-title-T">Titre Port 3</p>'+
      ' <p class="card-description-T">AE 390,000 DZ.</p>'+
      ' <p class="card-description-T">CP 100,000 DZ.</p>'+
      ' <button id="T3">...</button>'+
     '</div>'+
   '</div>'+
   '</div>'
   $('#T3-handle').append(newT)
}
function T4_newform()
{
  var newT='<div class="TP-handle">'+
  ' <div class="card-T">'+
     '<div class="container-card bg-yellow-box">'+
       '<!--i class="fas fa-door-closed T-icon"></i-->'+
       '<i class="fas fa-door-open T-icon"></i>'+
       '<p class="card-title-T">Titre Port 4</p>'+
      ' <p class="card-description-T">AE 490,000 DZ.</p>'+
      ' <p class="card-description-T">CP 100,000 DZ.</p>'+
      ' <button id="T4">...</button>'+
     '</div>'+
   '</div>'+
   '</div>'
   $('#T4-handle').append(newT)
}
$('a').click(function(e){
	var _elem = $(this);

  $('a').parent('li').each(function(){
  	$(this).removeClass('active');
  });

  _elem.parent('li').addClass('active');
});
(function(){
  $('#msbo').on('click', function(){
    $('body').toggleClass('msb-x');
  });
}());
$(document).ready(function(){
  $('.card-photo-holder').on('click',function()
  {
    alert('clicks')
      window.location='/tech';
  })
})
$(document).ready(function(){
  $("#add-wallet").on('click',function(){
    var num_wallet=$('#num_port').val()
    $('.font-bk').removeClass('back-bk')
    $('.wallet-path').css('display','flex')
    $('.wallet-handle').empty()
    $('#progam-handle').css('display','block')
    $('#progam-handle').removeClass('scale-out')
    $('#progam-handle').addClass('scale-visible')
    path.push(num_wallet);
  })
})
$("#add-prg").on('click',function(){
  var id_prog=$('#Programme').val();
  var id_jour=$('#num_journ').val();
  var date_sort_jour=$('#date_journ');
  var prg2='<div class="form-container">'+
      '<form>'+
        '<div class="form-group">'+
          '<label for="input1">Sous Programme</label>'+
          '<input type="text" class="form-control" id="sous_prog" placeholder="Donnee Nom Sous Programme">'+
        '</div>'+
       ' <div class="form-group">'+
         ' <label for="inputDate">Date Journal</label>'+
          '<input type="date" class="form-control" id="s_date_jour">'+
        '</div>'+
       ' </form>'+
       ' <br>'+
        '<div>'+
        '<button class="btn btn-primary" id="add-prg2">Ajouter</button>'+
        '<hr>'+
       ' <div class="file-handle">'+
        '<input type="file" class="form-control" id="file">'+
        '<button class="btn btn-primary">Journal</button>'+
        '</div>'+
        '</div>'
  var nexthop='<div class="pinfo-handle">'+
              '<i class="fas fa-wallet"></i>'+
              '<p >Programm :</p>'+
              '<p>'+id_prog+'</p>'+
              '</div>'+
              ' <div class="next-handle">'+
              '<i class="fas fa-angle-double-right waiting-icon"></i>'+
              '</div>'
              path.push(id_prog);
  $('.next-handle svg').removeClass('waiting-icon')
  $('.next-handle svg').addClass('complet-icon')
  $('.the-path').append(nexthop)
  $('#progam-handle').append(prg2)
  $('#add-prg2').on('click',function(){
    var sou_prog=$('#sous_prog').val()
    var dat_sous=$('#s_date_jour').val()
    var nexthop='<div class="pinfo-handle">'+
    '<i class="fas fa-wallet"></i>'+
    '<p >S_Program :</p>'+
    '<p>'+sou_prog+'</p>'+
    '</div>'+
    ' <div class="next-handle">'+
    '<i class="fas fa-angle-double-right waiting-icon"></i>'+
    '</div>'
    var prg3='<div class="form-container">'+
        '<form>'+
          '<div class="form-group">'+
            '<label for="input1">ACTION</label>'+
            '<input type="text" class="form-control" id="nom_act" placeholder="Donnee Nom ACTION">'+
          '</div>'+
          '<div class="form-group">'+
            '<label for="input1">AE pour Action</label>'+
            '<input type="number" class="form-control" id="AE_act" placeholder="Donnee Nom Programme">'+
          '</div>'+
          '<div class="form-group">'+
            '<label for="input1">CP pour Action</label>'+
            '<input type="number" class="form-control" id="CP_act" placeholder="Donnee Nom Programme">'+
          '</div>'+
         ' <div class="form-group">'+
           ' <label for="inputDate">Date Journal</label>'+
            '<input type="date" class="form-control" id="inputDate">'+
          '</div>'+
         ' </form>'+
         ' <br>'+
          '<div>'+
          '<button class="btn btn-primary" id="add-prg3">Ajouter</button>'+
          '<hr>'+
         ' <div class="file-handle">'+
          '<input type="file" class="form-control" id="file">'+
          '<button class="btn btn-primary">Journal</button>'+
          '</div>'+
          '</div>'
          $('.next-handle svg').removeClass('waiting-icon')
          $('.next-handle svg').addClass('complet-icon')
          $('.the-path').append(nexthop)
          $('#progam-handle').append(prg3)
          path.push(sou_prog);
          /**  this for Creating the T port so we gonna send it to Action handle to deal with it */
          $('#add-prg3').on('click',function(){
            var act=$('#nom_act').val()
            var ae=$('#AE_act').val()
            var cp=$('#CP_act').val()
         /*   var nexthop='<div class="pinfo-handle">'+
            '<i class="fas fa-wallet"></i>'+
            '<p >ACTION :</p>'+
            '<p>  </p>'+
            '</div>'+
            ' <div class="next-handle">'+
            '<i class="fas fa-angle-double-right waiting-icon"></i>'+
            '</div>'
        $('#progam-handle').addClass('slide-out')
        setTimeout(() => {
          // Add the class to hide the table
          $('#progam-handle').empty();
          // Optionally remove the scaling out class after hiding
          $('#T_List-handle').addClass('grid-T')
          add_T1();add_T2();add_T3();add_T4()
        $('.next-handle svg').removeClass('waiting-icon')
          $('.next-handle svg').addClass('complet-icon')
        $('.the-path').append(nexthop)
        $('#T-card_button button').on('click',function(){
          var buttonid=$(this).attr('id');
          console.log(''+buttonid);
          $('#T_List-handle').removeClass('grid-T')
          $('#T_List-handle').addClass('row-T')
          $('#gr_list_handle').addClass('gr_list')
          $('#T1-handle').empty()
          $('#T2-handle').empty()
          $('#T3-handle').empty()
          $('#T4-handle').empty()
          T1_newform();
          T2_newform();
          T3_newform();
          T4_newform();
                $('#table-T').addClass('table-T-scroll')
          var table='<table class="container-T" id="T-tables">'+
                      '<thead style="position: sticky;">'+
                     '<tr>'+
                     '<th rowspan="2"><h1>T Description</h1><th> </th></th>'+
                     '<th><h1>AE</h1></th>'+
                     '<th><h1>CP </h1></th>'+
                     '</tr>'+
                     '</thead>'+
                     '<tbody>'+
                     '</tbody>'+
                   '</table>'
    $('#table-T').append(table)
    if( buttonid == 'T1')
        {   $.getJSON(jsonpath, function (data) {
                // Loop through each item in the JSON data
                $.each(data, function (key, value) {
                    // Create a table row
                    let row = '<tr>' +
                        '<td>' + key + '</td>' +
                        '<td>' + value + ' </td>' +
                        '<td class="editable">' + 0 + '</td>' +
                        '<td class="editable">' + 180+',000</td>' +
                        '</tr>';

                    // Append the row to the table body
                    $('#T-tables tbody').append(row);
                    Edit();
                    $('.TP-handle button').on('click',function(){
                      var btn=$(this).attr('id')
                      console.log('testing card Click'+btn)
                      if(btn != 'T1'){
                      $('#T-tables tbody').empty()
                      $('#T1-handle').empty()
                      $('#T2-handle').empty()
                      $('#T3-handle').empty()
                      $('#T4-handle').empty()
                      T1_newform();
                      T2_newform();
                      T3_newform();
                      T4_newform();}
                    })
                });
            }).fail(function () {
                console.error('Error loading JSON file.');
            });
            }
        })
     
      }, 500)
       /** this to creating at same page  */  
       path.push(act)
       window.location.href='testing/Action/'+path[0]+'/'+id_prog+'/'+sou_prog+'/'+act;
        console.log('path'+JSON.stringify(path))
       })
  })
  
})

/**
 * this for action T port select table
 * 
 */

function T1_table()
{
  console.log('data is')
    $('#Tport-handle').addClass('scale-out');
    setTimeout(() => {
      // Add the class to hide the table
      $('#Tport-handle').addClass('scale-hidden');
      // Optionally remove the scaling out class after hiding
      $('#Tport-handle').removeClass('scale-out');
      $('.T-handle').css('display','flex')
  }, 500)
  var headT='<tr>'+
 '<th colspan="2"><h1>T Description</h1></th>'+
 '<th><h1>AE</h1></th>'+
 '<th><h1>CP</h1></th>'+
'</tr>';
  $('#T-tables thead').append(headT)
  $.getJSON(jsonpath1, function (data) {
    // Loop through each item in the JSON data
    $.each(data, function (key, value) {
        // Create a table row
        let row = '<tr>' +
            '<td class="code">' + key + '</td>' +
            '<td>' + value + ' </td>' +
            '<td class="editable" id="AE_T1">' + 0 + '</td>' +
            '<td class="editable" id="CP_T2">' + 180+',000</td>' +
            '</tr>';

        // Append the row to the table body
        $('#T-tables tbody').append(row);
        Edit()
    });
}).fail(function () {
    console.error('Error loading JSON file.');
});
}
function T2_table()
{
  $('#Tport-handle').addClass('scale-out');
  setTimeout(() => {
    // Add the class to hide the table
    $('#Tport-handle').addClass('scale-hidden');
    // Optionally remove the scaling out class after hiding
    $('#Tport-handle').removeClass('scale-out');
    $('.T-handle').css('display','flex')
}, 500)
 var headT='<tr>'+
 '<th colspan="2"><h1>T Description</h1></th>'+
' <th colspan="2">'+
 ' <div class="fusion-father">'+
  ' <h1>CREDITS OUVERTS</h1>'+
   '<div class="fusion-child">'+
    ' <h1 style="width:40px;">AE</h1>'+
    ' <h1>CP</h1>'+
  ' </div>'+
  ' </div>  '+
 '</th>'+
  '<th colspan="2">'+
' <div class="fusion-father">'+
   '<h1>CREDITS ATTENDUS EVENUS DISPONIBLES</h1>'+
   '<div class="fusion-child">'+
   '<h1 style="width:40px;">AE</h1>'+
   '<h1>CP</h1>'+
 '</div>'+
 '</div>    '+
 '</th>'+
 '<th colspan="2">'+
   '<div class="fusion-father">'+
   '<h1>TOTAL CREDITS DISPONIBLES</h1>'+
   '<div class="fusion-child">'+
  ' <h1 style="width:40px;">AE</h1>'+
   '<h1>CP</h1>'+
   '</div>'+
   '</div>    '+
 '</th>'+
'</tr>';
$('#T-tables thead').append(headT)
  $.getJSON(jsonpath2, function (data) {
                // Loop through each item in the JSON data
                $.each(data, function (key, value) {
                    // Create a table row
                    let row = '<tr>' +
                        '<td class="code">' + key + '</td>' +
                        '<td>' + value + ' </td>' +
                        '<td class="editable" id="AE_Over">' + 0 + '</td>' +
                        '<td class="editable" id="CP_Over">' + 180+',000</td>' +
                        '<td class="editable" id="AE_att">' + 0 + '</td>' +
                        '<td class="editable" id="CP_att">' + 180+',000</td>' +
                        '<td class="editable" id="AE_TT">' + 0 + '</td>' +
                        '<td class="editable" id="CP_TT">' + 360+',000</td>' +
                        '</tr>';

                    // Append the row to the table body
                    $('#T-tables tbody').append(row);
                    Edit()
                    $('#changin').on('click',function(){
                      alert('changing success')
                    })
                });
            }).fail(function () {
                console.error('Error loading JSON file.');
            });
}
function T3_table()
{
  console.log('data is')
    $('#Tport-handle').addClass('scale-out');
    setTimeout(() => {
      // Add the class to hide the table
      $('#Tport-handle').addClass('scale-hidden');
      // Optionally remove the scaling out class after hiding
      $('#Tport-handle').removeClass('scale-out');
      $('.T-handle').css('display','flex')
  }, 500)
  var headT='<tr>'+
  '<th><h1>code</h1></th>'+
 '<th colspan="2"><h1>T Description</h1></th>'+
 '<th colspan="2">'+
   '<div class="fusion-father">'+
   '<h1>MONTANT ANNEE (N)</h1>'+
   '<div class="fusion-child">'+
  ' <h1 style="width:40px;">AE</h1>'+
   '<h1>CP</h1>'+
   '</div>'+
   '</div>    '+
 '</th>'+
'</tr>';
  $('#T-tables thead').append(headT)
  $.getJSON(jsonpath3, function (data) {
    // Loop through each item in the JSON data
    $.each(data, function (key, value) {
        // Create a table row
        var val=value.split('-')
        console.log('values'+JSON.stringify(val))
        let row = '<tr>' +
            '<td class="code">' + key + '</td>' +
            '<td>' + val[0] + ' </td>' +
            '<td>'+ val[1]+'</td>'+
            '<td class="editable">' + 0 + '</td>' +
            '<td class="editable">' + 180+',000</td>' +
            '</tr>';

        // Append the row to the table body
        $('#T-tables tbody').append(row);
        Edit()
    });
}).fail(function () {
    console.error('Error loading JSON file.');
});
}
function T4_table()
{
  
}
$(document).ready(function(){
 
  $('#T1').on('click',function(){
  T1_table()
  })
  $('#T2').on('click',function(){
  
    T2_table()
  })
  $('#T3').on('click',function(){
    T3_table()
  })
  $('#T4').on('click',function(){
    
  })
  $(".TP-handle").on('click',function()
  
  {
    $('#T-tables thead').empty()
    $('#T-tables tbody').empty()
    
    var id_tport_c=$(this).attr('id');
    if(id_tport_c == 'T_port1')
    {
      T1_table()
    }
    if(id_tport_c == 'T_port2')
    {
      T2_table()
    }
    if(id_tport_c == 'T_port3')
    {
      T3_table()
    }
    console.log('testign which port im '+id_tport_c)
  })
})

/**
 * 
 *  end
 */
const progress = document.getElementById("progress");
const stepCircles = document.querySelectorAll(".circle");
let currentActive = 1;

//NOTE CHANGE HERE TO 1-4
//1=25%
//2=50%
//3=75%
//4=100%
update(3);

function update(currentActive) {
  stepCircles.forEach((circle, i) => {
    if (i < currentActive) {
      circle.classList.add("active");
    } else {
      circle.classList.remove("active");
    }
  });

  const activeCircles = document.querySelectorAll(".active");
  progress.style.width =
    ((activeCircles.length - 1) / (stepCircles.length - 1)) * 100 + "%";


}

