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

<<<<<<< HEAD
                             var click=0;
                             var changing_mist=new Object();
                             var value_chng=new Array()
                             function Edit(tid, T)
                             {
                             $(document).ready(function () {
                               var old;
                               var data = {
                                 ae: {},
                                 cp: {},
                                 ae_ouvert: {},
                                 cp_ouvert: {},
                                 ae_attendu: {},
                                 cp_attendu: {}
                               };
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
                                   input.blur(function (t) {
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
                                          // value_chng=new Array()
                             
                                       //    alert('changing success')
                                       $('#T-tables tbody tr').each(function(){
                                         if( tid == 'T_port1' || tid == 'T1')
                                         {
                             
                                         var code = $(this).find('td').eq(0).text();
                                         var aeValue = $(this).find('td').eq(2).text();
                                         var cpValue = $(this).find('td').eq(3).text();
                                         // Ajoute les valeurs dans les objets
                                         data.ae[code] = aeValue;
                                         data.cp[code] = cpValue;
                             
                             
                                       }
                                       if( tid == 'T_port2' || tid == 'T2')
                                         {
                             
                                           var code = $(this).find('td').eq(0).text();
                                           var aeDataOuvert = $(this).find('td').eq(2).text();
                                           var cpDataOuvert = $(this).find('td').eq(3).text();
                                           var aeDataAttendu = $(this).find('td').eq(4).text();
                                           var cpDataAttendu = $(this).find('td').eq(5).text();
                             
                                           // Ajoute les valeurs dans les objets
                                         data.ae_ouvert[code] = aeDataOuvert;
                                         data.cp_ouvert[code] = cpDataOuvert;
                                         data.ae_attendu[code] = aeDataAttendu;
                                         data.cp_attendu[code] = cpDataAttendu;
                             
                                       }
                                       if( tid == 'T_port3' || tid == 'T3')
                                         {
                                           var code = $(this).find('td').eq(0).text();
                                           var aeValue = $(this).find('td').eq(2).text();
                                           var cpValue = $(this).find('td').eq(3).text();
                                           // Ajoute les valeurs dans les objets
                                           data.ae[code] = aeValue;
                                           data.cp[code] = cpValue;
                                       }
                                        // value_chng.push(rw);
                                       })
                             
                                           $('.change_app').empty()
                                          // console.log('path '+JSON.stringify(path))
                                         //console.log('lenght '+path.length)
                                           if(path.length>4){
                                             var url= '/testing/Action/'+path[0]+'/'+path[1]+'/'+path[2]+'/'+path[3]+'/'+path[4]+'/'+T;
                                           }else{
                                             var url= '/testing/Action/'+path[0]+'/'+path[1]+'/'+path[2]+'/'+path[3]+'/'+path[3]+'/'+T;
                                           }
                                           $.ajax({
                                             url: url,
                                             type: 'POST',
                                             data: {
                                                 ae: data.ae,
                                                 cp: data.cp,
                                                 ae_ouvert: data.ae_ouvert,
                                                 cp_ouvert: data.cp_ouvert,
                                                 ae_attendu: data.ae_attendu,
                                                 cp_attendu: data.cp_attendu,
                                                 _token: $('meta[name="csrf-token"]').attr('content'),
                                                 _method:"POST"
                                             },
                                             success: function(response) {
                                                 if(response.code == 200 || response.code == 404)
                                                     {
                                                        path.push()
                                                      window.location.href='testing/Action/'+path[0]+'/'+path[1]+'/'+path[2]+'/'+path[3]+'/'+path[4]+'/'+T;
                                                      console.log('path'+JSON.stringify(path))
                                                     }
                                                   },
                                                   error:function(response)
                                                   {
                                                       alert('error')
                                                   }
                             
                             
                                         });
                                         click=0;
                                         })
                                       }
                                     //  console.log('all table'+JSON.stringify(value_chng))
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
                             
                                //check if exist
                             $('#num_port').on('change', function() {
                                 var num_portefeuil = $(this).val(); // Récupérer la valeur de num_portefeuil
                             
                                 if (num_portefeuil) {
                                     // Vérifier si le numéro de portefeuille existe dans la base de données
                                     $.ajax({
                                         url: '/check-portef',  // Route qui fait l'appel à la base de données
                                         type: 'GET',
                                         data: { num_portefeuil: num_portefeuil }, // Modifier le nom ici
                                         success: function(response) {
                                             if (response.exists) {
                             
                                                 // Afficher un message pour indiquer que le portefeuille existe
                                                 alert('Le portefeuille existe déjà.'); // Message d'alerte
                             
                                                 // Si le portefeuille existe, remplir les champs du formulaire avec les données récupérées
                                                 $('#date_crt_portf').val(response.Date_portefeuille);
                                                 $('#AE_portef').val(response.AE_portef);
                                                 $('#CP_portef').val(response.CP_portef);
                                                 $('#nom_journ').val(response.nom_journal);
                                                 $('#num_journ').val(response.num_journal);
                             
                                                 // Afficher le deuxième formulaire
                                                 $('.card').hide();  // Masque le premier formulaire
                                                 $('#progam-handle').css('display', 'block'); // Affiche le deuxième formulaire
                                             }
                                         },
                                         error: function() {
                                             alert('Erreur lors de la vérification du portefeuille');
                                         }
                                     });
                                 } else {
                                     // Si le champ est vide, vider également les autres champs
                                     $('#nom_journ').val('');
                                     $('#num_journ').val('');
                                     $('#date_crt_portf').val('');
                                     $('#AE_portef').val('');
                                     $('#CP_portef').val('');
                                 }
                             });
                             
                             
                               $("#add-wallet").on('click',function(){
                                 var num_wallet=$('#num_port').val();
                                 console.log('id'+num_wallet)
                                 var formportinsert={
                                   'num_portefeuil':num_wallet,
                                   'Date_portefeuille':$('#date_crt_portf').val(),
                                   'nom_journal':$('#nom_journ').val(),
                                   'num_journal':parseInt($('#num_journ').val()),
                                   'AE_portef':parseFloat($('#AE_portef').val()),
                                   'CP_portef':parseFloat($('#CP_portef').val()),
                                    _token: $('meta[name="csrf-token"]').attr('content'),
                                    _method: 'POST'
                                 }
                                 $.ajax({
                                   url:"/creation",
                                   type:"POST",
                                   data:formportinsert,
                                   success:function(response)
                                   {
                                     if(response.code == 200 || response.code == 404)
                                     {
                                       alert(response.message)
                                       $('.font-bk').removeClass('back-bk')
                                       $('.wallet-path').css('display','flex')
                                       $('.wallet-handle').empty()
                                       $('#progam-handle').css('display','block')
                                       $('#progam-handle').removeClass('scale-out')
                                       $('#progam-handle').addClass('scale-visible')
                                       $('#w_id').text(num_wallet)
                                       path.push(num_wallet);
                                     }
                                     else
                                     {
                                       alert(response.message)
                                     }
                                   },
                                   error:function()
                                   {
                                     alert('error');
                                   }
                                 })
                             
                               })
                             })
                             
                             $("#add-prg").on('click',function(){
                               var id_prog=$('#num_prog').val();
                               var nom_prog=$('#nom_prog').val();
                               var date_sort_jour=$('#date_insert_portef').val();
                               var formprogdata={
                                 num_prog:id_prog,
                                 nom_prog:nom_prog,
                                 num_portefeuil:path[0],
                                 date_insert_portef:date_sort_jour,
                                 _token: $('meta[name="csrf-token"]').attr('content'),
                                 _method: 'POST'
                               }
                               var prg2='<div class="form-container">'+
                               '<form>'+
                                 '<div class="form-group">'+
                                   '<label for="input1">N° Sous Programme</label>'+
                                   '<input type="text" class="form-control" id="num_sous_prog" placeholder="Donnee Nom Sous Programme">'+
                                 '</div>'+
                                 '<div class="form-group">'+
                                   '<label for="input1">Nom Sous Programme</label>'+
                                   '<input type="text" class="form-control" id="nom_sous_prog" placeholder="Donnee Nom Sous Programme">'+
                                 '</div>'+
                                 '<!--div class="form-group">'+
                                   '<label for="input1">AE</label>'+
                                   '<input type="number" class="form-control" id="AE_sous_porg" >'+
                                 '</div>'+
                                 '<div class="form-group">'+
                                   '<label for="input1">CP</label>'+
                                   '<input type="number" class="form-control" id="CP_sous_prog">'+
                                 '</div-->'+
                                ' <div class="form-group">'+
                                  ' <label for="inputDate">Date Journal</label>'+
                                   '<input type="date" class="form-control" id="date_insert_sousProg">'+
                                 '</div>'+
                                ' </form>'+
                                ' <br>'+
                                 '<div id="confirm-holder_sprog">'+
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
                                       '</div>';
                                           $.ajax({
                                             url:'/creationProg',
                                             type:"POST",
                                             data:formprogdata,
                                             success:function(response)
                                             {
                                               if(response.code == 200 || response.code == 404)
                                               {
                             
                                               alert(response.message)
                                               path.push(id_prog);
                                               $('.next-handle svg').removeClass('waiting-icon')
                                               $('.next-handle svg').addClass('complet-icon')
                                               $('.the-path').append(nexthop)
                                               $('#progam-handle').append(prg2)
                                               $('#confirm-holder').empty()
                                               $('#confirm-holder').append('<i class="fas fa-wrench"></i>')
                             
                                               /**  sous action insert */
                                               $('#add-prg2').on('click',function(){
                                                 var sou_prog=$('#num_sous_prog').val()
                                                 var nom_sou_prog=$('#nom_sous_prog').val();
                                                /* var AE=$('#AE_sous_porg').val();
                                                 var CP=$('#CP_sous_prog').val()*/
                                                 var dat_sou_prog=$('#date_insert_sousProg').val()
                                                 var id_prog=path[1];
                                                 var id_port=path[0];
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
                                                         '<label for="input1">N° ACTION</label>'+
                                                         '<input type="text" class="form-control" id="num_act" placeholder="Donnee Nom ACTION">'+
                                                       '</div>'+
                                                       '<div class="form-group">'+
                                                         '<label for="input1">Nom ACTION</label>'+
                                                         '<input type="text" class="form-control" id="nom_act" placeholder="Donnee Nom ACTION">'+
                                                       '</div>'+
                                                       '<div class="form-group" id="ElAE_act">'+
                                                         '<label for="input1">AE pour Action</label>'+
                                                         '<input type="number" class="form-control" id="AE_act" placeholder="Donnee Nom Programme">'+
                                                       '</div>'+
                                                       '<div class="form-group" id="ElCP_act">'+
                                                         '<label for="input1">CP pour Action</label>'+
                                                         '<input type="number" class="form-control" id="CP_act" placeholder="Donnee Nom Programme">'+
                                                       '</div>'+
                                                      ' <div class="form-group">'+
                                                        ' <label for="inputDate">Date Journal</label>'+
                                                         '<input type="date" class="form-control" id="date_insert_action">'+
                                                       '</div>'+
                                                      ' </form>'+
                                                      ' <br>'+
                                                       '<div id="confirm-holder_act">'+
                                                       '<button class="btn btn-primary" id="add-prg3">Ajouter</button>'+
                                                       '<hr>'+
                                                      ' <div class="file-handle">'+
                                                       '<input type="file" class="form-control" id="file">'+
                                                       '<button class="btn btn-primary">Journal</button>'+
                                                       '</div>'+
                                                       '</div>'
                                                       var formdatasou_prog={
                                                         num_sous_prog:sou_prog,
                                                         nom_sous_prog:nom_sou_prog,
                                                        /* AE_sous_porg:AE,
                                                         CP_sous_prog:CP,*/
                                                         date_insert_sousProg:dat_sou_prog,
                                                         id_program:id_prog,
                                                         id_porte:id_port,
                                                         _token: $('meta[name="csrf-token"]').attr('content'),
                                                         _method: 'POST'
                                                       }
                                                       console.log('data'+JSON.stringify(formdatasou_prog))
                                                       $.ajax({
                                                         url:'/creationSousProg',
                                                         type:"POST",
                                                         data:formdatasou_prog,
                                                         success:function(response)
                                                         {
                                                           if(response.code == 200 || response.code == 404)
                                                           {
                                                             alert(response.message)
                                                             $('.next-handle svg').removeClass('waiting-icon')
                                                             $('.next-handle svg').addClass('complet-icon')
                                                             $('.the-path').append(nexthop)
                                                             $('#progam-handle').append(prg3)
                                                             path.push(sou_prog);
                                                             $('#confirm-holder_sprog').empty()
                                                             $('#confirm-holder_sprog').append('<i class="fas fa-wrench"></i>')
                                                             /******           ACTION add for under_progam                    *********** */
                                                             $('#add-prg3').on('click',function(){
                                                               /**
                                                                *  this part for chacking if he want to under_action
                                                                *
                                                                */
                                                              // Demande de confirmation pour ajouter une sous-action après l'ajout de l'action
                             let userResponse = confirm('Voulez-vous ajouter une sous-action pour cette action ?');
                             if (userResponse) {
                               // Récupération des informations de l'action
                               var nom_act = $('#nom_act').val();
                               var num_act = $('#num_act').val();
                               var dat_inst = $('#date_insert_action').val();
                               var id_sou_prog = path[2];
                             
                               // Création du formData pour l'action
                               var formdata_act = {
                                 num_action: num_act,
                                 nom_action: nom_act,
                                 date_insert_action: dat_inst,
                                 id_sous_prog: id_sou_prog,
                                 id_prog: path[1],
                                 id_porte: path[0],
                                 _token: $('meta[name="csrf-token"]').attr('content'),
                                 _method: 'POST'
                               };
                             
                               // Envoi de l'Action via Ajax
                               $.ajax({
                                 url: '/creationAction',
                                 type: 'POST',
                                 data: formdata_act,
                                 success: function(response) {
                                   if (response.code === 200 || response.code === 404) {
                                     // Ajout du numéro de l'action au chemin
                                     path.push(num_act);
                                     console.log('A path: ' + JSON.stringify(path));
                             
                                     // Création du formulaire pour la sous-action après l'ajout de l'action
                                     var prg4 = `
                                       <div class="form-container">
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
                                     $('#progam-handle').append(prg4);
                             
                                     // Ajout de l'événement d'ajout pour la sous-action
                                     $('#add-prg4').on('click', function() {
                                       var nom_sous_act = $('#nom_sous_act').val();
                                       var num_sous_act = $('#num_sous_act').val();
                                       var dat_inst = $('#date_insert_sou_action').val();
                             
                                       // Création du formData pour la sous-action
                                       var formdata_sous_act = {
                                         num_sous_action: num_sous_act,
                                         nom_sous_action: nom_sous_act,
                                         date_insert_sous_action: dat_inst,
                                         num_act: path[3],
                                         id_sous_prog: path[2],
                                         id_prog: path[1],
                                         id_porte: path[0],
                                         _token: $('meta[name="csrf-token"]').attr('content'),
                                         _method: 'POST'
                                       };
                             
                                       // Envoi de la sous-action via Ajax
                                       $.ajax({
                                         url: '/creationsousAction',
                                         type: 'POST',
                                         data: formdata_sous_act,
                                         success: function(response) {
                                           if (response.code === 200 || response.code === 404) {
                                             path.push(num_sous_act);
                                             console.log('path: ' + JSON.stringify(path));
                             
                                             // Redirection vers la page suivante après l'ajout de la sous-action
                                             window.location.href = 'testing/S_action/' + path.join('/');
                                           }
                                         },
                                         error: function(response) {
                                           alert('Erreur lors de l\'ajout de la sous-action.');
                                         }
                                       });
                                     });
                                   }
                                 },
                                 error: function(response) {
                                   alert('Erreur lors de l\'ajout de l\'action.');
                                 }
                               });
                             } else {
                               // Cas où l'utilisateur n'ajoute pas de sous-action
                               var nom_act = $('#nom_act').val();
                               var num_act = $('#num_act').val();
                               var dat_inst = $('#date_insert_action').val();
                               var id_sou_prog = path[2];
                             
                               var formdata_act = {
                                 num_action: num_act,
                                 nom_action: nom_act,
                                 date_insert_action: dat_inst,
                                 id_sous_prog: id_sou_prog,
                                 id_prog: path[1],
                                 id_porte: path[0],
                                 _token: $('meta[name="csrf-token"]').attr('content'),
                                 _method: 'POST'
                               };
                             
                               $.ajax({
                                 url: '/creationAction',
                                 type: 'POST',
                                 data: formdata_act,
                                 success: function(response) {
                                   if (response.code === 200 || response.code === 404) {
                                     path.push(num_act);
                                    // console.log('path: ' + JSON.stringify(path));
                                     window.location.href = 'testing/Action/' + path.join('/');
                                   }
                                 },
                                 error: function(response) {
                                   alert('Erreur lors de l\'ajout de l\'action.');
                                 }
                               });
                             }
                             
                                                           /*********         END ACTION ********************************************** */
                                                          })
                             
                                                           }
                                                         },
                                                         error:function(response)
                                                         {
                                                          alert('error')
                                                         }
                                                       })
                             
                                                       /**  this for Creating the T port so we gonna send it to Action handle to deal with it */
                             
                                               })
                                             }
                                             },
                                             error:function(response)
                                             {
                                               alert('error')
                                             }
                                           })
                             
                             
                             
                             
                             })
                             
                             /**
                              * this for action T port select table
                              *
                              */
                             
                             function T1_table(id,T)
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
                                         '<td class="editable" id="CP_T1">' + 180+',000</td>' +
                                         '</tr>';
                             
                                     // Append the row to the table body
                                     $('#T-tables tbody').append(row);
                                     Edit(id, T)
                                 });
                             }).fail(function () {
                                 console.error('Error loading JSON file.');
                             });
                             }
                             function T2_table(id,T)
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
                                                 Edit(id)
                             
                                             });
                                         }).fail(function () {
                                             console.error('Error loading JSON file.');
                                         });
                             }
                             function T3_table(id,T)
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
                                     Edit(id)
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
                                 var id=$(this).attr('id');
                                 var T=1;
                               T1_table(id,T)
                               })
                               $('#T2').on('click',function(){
                                 var T=2;
                             
                                 T2_table(id,T)
                               })
                               $('#T3').on('click',function(){
                                 var T=3;
                                 T3_table(id,T)
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
                                   T1_table(id_tport_c)
                                 }
                                 if(id_tport_c == 'T_port2')
                                 {
                                   T2_table(id_tport_c)
                                 }
                                 if(id_tport_c == 'T_port3')
                                 {
                                   T3_table(id_tport_c)
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
=======
var click = 0;
var changing_mist = new Object();
var value_chng = new Array()
function Edit(tid, T) {
    $(document).ready(function () {
        var old;
        var data = {
            ae: {},
            cp: {},
            ae_ouvert: {},
            cp_ouvert: {},
            ae_attendu: {},
            cp_attendu: {}
        };
        // Add double-click event to all cells with the class "editable"
        $('.editable').on('click', function () {
            let cell = $(this);  // Reference to the clicked cell
            old = cell.text();
        })
        $('.editable').dblclick(function () {
            var clickid = $(this).attr('id');
            var clickedRow = $(this).closest('tr');
            var code = clickedRow.find('td:first-child');
            let cell = $(this);  // Reference to the clicked cell
            var currentText = cell.text();  // Get current text
            console.log('odl ' + code.text())
            // Create an input element and set its value
            let input = $('<input type="number" step="0.01" class="form-control" />').val(currentText);
            cell.html(input);  // Replace the cell content with the input
            input.focus();  // Focus on the input immediately

            // When the input loses focus, update the cell with new text
            input.blur(function (t) {
                let newText = $(this).val();  // Get new value from input

                if (newText != 0 && newText != '' && newText != null) {
                    mount_chang = true

                    if (mount_chang == true) {
                        console.log('tesing' + newText)
                        click++;
                        if (click == 1) {
                            var buttons = '<button class="btn btn-primary" id="changin"> appliquer</button>'
                        }
                        $('.change_app').append(buttons)
                        $('#changin').on('click', function () {
                            // value_chng=new Array()

                            //    alert('changing success')
                            $('#T-tables tbody tr').each(function () {
                                if (tid == 'T_port1' || tid == 'T1') {

                                    var code = $(this).find('td').eq(0).text();
                                    var aeValue = $(this).find('td').eq(2).text();
                                    var cpValue = $(this).find('td').eq(3).text();
                                    // Ajoute les valeurs dans les objets
                                    data.ae[code] = aeValue;
                                    data.cp[code] = cpValue;


                                }
                                if (tid == 'T_port2' || tid == 'T2') {

                                    var code = $(this).find('td').eq(0).text();
                                    var aeDataOuvert = $(this).find('td').eq(2).text();
                                    var cpDataOuvert = $(this).find('td').eq(3).text();
                                    var aeDataAttendu = $(this).find('td').eq(4).text();
                                    var cpDataAttendu = $(this).find('td').eq(5).text();

                                    // Ajoute les valeurs dans les objets
                                    data.ae_ouvert[code] = aeDataOuvert;
                                    data.cp_ouvert[code] = cpDataOuvert;
                                    data.ae_attendu[code] = aeDataAttendu;
                                    data.cp_attendu[code] = cpDataAttendu;

                                }
                                if (tid == 'T_port3' || tid == 'T3') {
                                    var code = $(this).find('td').eq(0).text();
                                    var aeValue = $(this).find('td').eq(2).text();
                                    var cpValue = $(this).find('td').eq(3).text();
                                    // Ajoute les valeurs dans les objets
                                    data.ae[code] = aeValue;
                                    data.cp[code] = cpValue;
                                }
                                // value_chng.push(rw);
                            })

                            $('.change_app').empty()
                            // console.log('path '+JSON.stringify(path))
                            //console.log('lenght '+path.length)
                            if (path.length > 4) {
                                var url = '/testing/Action/' + path[0] + '/' + path[1] + '/' + path[2] + '/' + path[3] + '/' + path[4] + '/' + T;
                            } else {
                                var url = '/testing/Action/' + path[0] + '/' + path[1] + '/' + path[2] + '/' + path[3] + '/' + path[3] + '/' + T;
                            }
                            $.ajax({
                                url: url,
                                type: 'POST',
                                data: {
                                    ae: data.ae,
                                    cp: data.cp,
                                    ae_ouvert: data.ae_ouvert,
                                    cp_ouvert: data.cp_ouvert,
                                    ae_attendu: data.ae_attendu,
                                    cp_attendu: data.cp_attendu,
                                    _token: $('meta[name="csrf-token"]').attr('content'),
                                    _method: "POST"
                                },
                                success: function (response) {
                                    if (response.code == 200 || response.code == 404) {
                                        path.push()
                                        window.location.href = 'testing/Action/' + path[0] + '/' + path[1] + '/' + path[2] + '/' + path[3] + '/' + path[4] + '/' + T;
                                        console.log('path' + JSON.stringify(path))
                                    }
                                },
                                error: function (response) {
                                    alert('error')
                                }


                            });
                            click = 0;
                        })
                    }
                    //  console.log('all table'+JSON.stringify(value_chng))
                    cell.text(newText);
                }
                else {
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

function add_T1() {
    var T1 = '<div class="col-md-15 hover-container" id="T1-card-handle">' +
        '<div class="card">' +
        ' <div class="icon-holder">' +
        '<i class="fas fa-door-closed default-icon icon icon-card"></i>' +
        '<i class="fas fa-door-open hover-icon icon icon-card"></i>' +
        '</div>' +
        '<div class="card-body" id="T-card_button">' +
        '<h5 class="card-title">Titre 1</h5>' +
        ' <p class="card-text">Description pour Titre 1.</p>' +
        '<button class="btn btn-primary bts" id="T1">Vers Les Operation</button>' +
        '</div>' +
        '</div>' +
        '</div>'
    $('#T1-handle').append(T1)
}
function add_T2() {
    var T1 = '<div class="col-md-15 hover-container" id="T2-card-handle">' +
        '<div class="card">' +
        ' <div class="icon-holder">' +
        '<i class="fas fa-door-closed default-icon icon icon-card"></i>' +
        '<i class="fas fa-door-open hover-icon icon icon-card"></i>' +
        '</div>' +
        '<div class="card-body" id="T-card_button">' +
        '<h5 class="card-title">Titre 2</h5>' +
        ' <p class="card-text">Description pour Titre 2.</p>' +
        '<button class="btn btn-primary bts" id="T2">Vers Les Operation</button>' +
        '</div>' +
        '</div>' +
        '</div>'
    $('#T2-handle').append(T1)
}
function add_T3() {
    var T1 = '<div class="col-md-15 hover-container" id="T3-card-handle">' +
        '<div class="card">' +
        ' <div class="icon-holder" >' +
        '<i class="fas fa-door-closed default-icon icon icon-card"></i>' +
        '<i class="fas fa-door-open hover-icon icon icon-card"></i>' +
        '</div>' +
        '<div class="card-body" id="T-card_button">' +
        '<h5 class="card-title">Titre 3</h5>' +
        ' <p class="card-text">Description pour Titre 3.</p>' +
        '<button class="btn btn-primary bts" id="T3">Vers Les Operation</button>' +
        '</div>' +
        '</div>' +
        '</div>'
    $('#T3-handle').append(T1)
}
function add_T4() {
    var T1 = '<div class="col-md-15 hover-container" id="T4-card-handle">' +
        '<div class="card">' +
        ' <div class="icon-holder">' +
        '<i class="fas fa-door-closed default-icon icon icon-card"></i>' +
        '<i class="fas fa-door-open hover-icon icon icon-card"></i>' +
        '</div>' +
        '<div class="card-body" id="T-card_button">' +
        '<h5 class="card-title">Titre 4</h5>' +
        ' <p class="card-text">Description pour Titre 4.</p>' +
        '<button class="btn btn-primary bts" id="T4">Vers Les Operation</button>' +
        '</div>' +
        '</div>' +
        '</div>'
    $('#T4-handle').append(T1)
}
function T1_newform() {
    var newT = '<div class="TP-handle">' +
        ' <div class="card-T">' +
        '<div class="container-card bg-yellow-box">' +
        '<!--i class="fas fa-door-closed T-icon"></i-->' +
        '<i class="fas fa-door-open T-icon"></i>' +
        '<p class="card-title-T">Titre Port 1</p>' +
        ' <p class="card-description-T">AE 190,000 DZ.</p>' +
        ' <p class="card-description-T">CP 100,000 DZ.</p>' +
        ' <button id="T1">...</button>' +
        '</div>' +
        '</div>' +
        '</div>'
    $('#T1-handle').append(newT)
}
function T2_newform() {
    var newT = '<div class="TP-handle">' +
        ' <div class="card-T">' +
        '<div class="container-card bg-yellow-box">' +
        '<!--i class="fas fa-door-closed T-icon"></i-->' +
        '<i class="fas fa-door-open T-icon"></i>' +
        '<p class="card-title-T">Titre Port 2</p>' +
        ' <p class="card-description-T">AE 290,000 DZ.</p>' +
        ' <p class="card-description-T">CP 100,000 DZ.</p>' +
        ' <button id="T2">...</button>' +
        '</div>' +
        '</div>' +
        '</div>'
    $('#T2-handle').append(newT)
}
function T3_newform() {
    var newT = '<div class="TP-handle">' +
        ' <div class="card-T">' +
        '<div class="container-card bg-yellow-box">' +
        '<!--i class="fas fa-door-closed T-icon"></i-->' +
        '<i class="fas fa-door-open T-icon"></i>' +
        '<p class="card-title-T">Titre Port 3</p>' +
        ' <p class="card-description-T">AE 390,000 DZ.</p>' +
        ' <p class="card-description-T">CP 100,000 DZ.</p>' +
        ' <button id="T3">...</button>' +
        '</div>' +
        '</div>' +
        '</div>'
    $('#T3-handle').append(newT)
}
function T4_newform() {
    var newT = '<div class="TP-handle">' +
        ' <div class="card-T">' +
        '<div class="container-card bg-yellow-box">' +
        '<!--i class="fas fa-door-closed T-icon"></i-->' +
        '<i class="fas fa-door-open T-icon"></i>' +
        '<p class="card-title-T">Titre Port 4</p>' +
        ' <p class="card-description-T">AE 490,000 DZ.</p>' +
        ' <p class="card-description-T">CP 100,000 DZ.</p>' +
        ' <button id="T4">...</button>' +
        '</div>' +
        '</div>' +
        '</div>'
    $('#T4-handle').append(newT)
}
$('a').click(function (e) {
    var _elem = $(this);

    $('a').parent('li').each(function () {
        $(this).removeClass('active');
    });

    _elem.parent('li').addClass('active');
});
(function () {
    $('#msbo').on('click', function () {
        $('body').toggleClass('msb-x');
    });
}());
$(document).ready(function () {
    $('.card-photo-holder').on('click', function () {
        alert('clicks')
        window.location = '/tech';
    })
})
$(document).ready(function () {


    // Vérifie l'existence du portefeuille lorsque le champ de date perd le focus
    $('#date_crt_portf').on('focusout', function () {
        var num_portefeuil = $('#num_port').val(); // Récupérer la valeur du portefeuille
        var Date_portefeuille = $(this).val();  // Récupérer la valeur de la date

        var year = new Date(Date_portefeuille).getFullYear(); // Extraire l'année à partir de la date
        var numwall_year = num_portefeuil + year;


        // Vérifie que les deux champs sont remplis avant de continuer
        if (Date_portefeuille && num_portefeuil) {
            // Appel AJAX pour vérifier le portefeuille dans la base de données
            $.ajax({
                url: '/check-portef',  // Route pour vérifier l'existence du portefeuille
                type: 'GET',
                data: {
                    num_portefeuil: numwall_year,
                    Date_portefeuille: Date_portefeuille
                },
                success: function (response) {
                    if (response.exists) {
                        console.log(response); // Vérifiez la réponse
                        path.push(numwall_year);
                        console.log('numwall_year path: ' + JSON.stringify(path));
                        // Remplir les champs du formulaire avec les données récupérées
                        $('#date_crt_portf').val(response.Date_portefeuille).trigger('change'); // Remplir et déclencher l'événement change
                        $('#AE_portef').val(response.AE_portef).trigger('change'); // Remplir et déclencher l'événement change
                        $('#CP_portef').val(response.CP_portef).trigger('change'); // Remplir et déclencher l'événement change
                        $('#nom_journ').val(response.nom_journal).trigger('change'); // Remplir et déclencher l'événement change
                        $('#num_journ').val(response.num_journal).trigger('change'); // Remplir et déclencher l'événement change

                        alert('Le portefeuille existe déjà.');

                        // Afficher le deuxième formulaire
                        //$('.card').hide();
                        //$('#progam-handle').css('display', 'block');
                        $('.font-bk').removeClass('back-bk')
                        $('.wallet-path').css('display', 'flex')
                        $('.wallet-handle').empty()
                        $('#progam-handle').css('display', 'block')
                        $('#progam-handle').removeClass('scale-out')
                        $('#progam-handle').addClass('scale-visible')
                        $('#w_id').text(num_portefeuil)
                    } else {
                        //alert('Le portefeuille n\'existe pas.');
                    }
                },
                error: function () {
                    alert('Erreur lors de la vérification du portefeuille');
                }
            });
        }
    });




    $("#add-wallet").on('click', function () {
        var num_wallet = $('#num_port').val();
        var dateprort = $('#date_crt_portf').val();
        var year = new Date(dateprort).getFullYear(); // Extraire l'année à partir de la date
        var numwall_year = num_wallet + year;
        // console.log('id'+num_wallet)
        var formportinsert = {
            'num_portefeuil': numwall_year,
            'Date_portefeuille': $('#date_crt_portf').val(),
            'nom_journal': $('#nom_journ').val(),
            'num_journal': parseInt($('#num_journ').val()),
            'AE_portef': parseFloat($('#AE_portef').val()),
            'CP_portef': parseFloat($('#CP_portef').val()),
            //year: year,
            _token: $('meta[name="csrf-token"]').attr('content'),
            _method: 'POST'
        }
        $.ajax({
            url: "/creation",
            type: "POST",
            data: formportinsert,
            success: function (response) {
                if (response.code == 200 || response.code == 404) {
                    alert(response.message)
                    path.push(numwall_year);
                    console.log('numwall_year path: ' + JSON.stringify(path));
                    $('.font-bk').removeClass('back-bk')
                    $('.wallet-path').css('display', 'flex')
                    $('.wallet-handle').empty()
                    $('#progam-handle').css('display', 'block')
                    $('#progam-handle').removeClass('scale-out')
                    $('#progam-handle').addClass('scale-visible')
                    $('#w_id').text(num_wallet)
                }
                else {
                    alert(response.message)
                }
            },
            error: function () {
                alert('error');
            }
        })

    })
})


// Vérifie l'existence du programme lorsque le champ de programme perd le focus
$('#date_insert_portef').on('focusout', function () {
    var Date_program = $(this).val(); // Récupérer la valeur du programme
    var num_prog = $('#num_prog').val(); // Récupérer la valeur de num_prog
    var id_port = path[0];
    var num_program = num_prog + id_port; // Composer num_program

    var prg2 = '<div class="form-container">' +
        '<form>' +
        '<div class="form-group">' +
        '<label for="input1">N° Sous Programme</label>' +
        '<input type="text" class="form-control" id="num_sous_prog" placeholder="Donnee Nom Sous Programme">' +
        '</div>' +
        '<div class="form-group">' +
        '<label for="input1">Nom Sous Programme</label>' +
        '<input type="text" class="form-control" id="nom_sous_prog" placeholder="Donnee Nom Sous Programme">' +
        '</div>' +
        '<div class="form-group">' +
        '<label for="inputDate">Date Journal</label>' +
        '<input type="date" class="form-control" id="date_insert_sousProg">' +
        '</div>' +
        '</form>' +
        '<br>' +
        '<div id="confirm-holder_sprog">' +
        '<button class="btn btn-primary" id="add-prg2">Ajouter</button>' +
        '<hr>' +
        '<div class="file-handle">' +
        '<input type="file" class="form-control" id="file">' +
        '<button class="btn btn-primary">Journal</button>' +
        '</div>' +
        '</div>';

    var nexthop = '<div class="pinfo-handle">' +
        '<i class="fas fa-wallet"></i>' +
        '<p>Programm :</p>' +
        '<p>' + num_prog + '</p>' +
        '</div>' +
        '<div class="next-handle">' +
        '<i class="fas fa-angle-double-right waiting-icon"></i>' +
        '</div>';

    // Vérifie que les deux champs sont remplis avant de continuer
    if (Date_program && num_program) {
        // Appel AJAX pour vérifier le programme dans la base de données
        $.ajax({
            url: '/check-prog',  // Route pour vérifier l'existence du programme
            type: 'GET',
            data: {
                num_prog: num_program,
            },
            success: function (response) {
                if (response.exists) {
                    // Le programme existe déjà
                    console.log(response); // Vérifiez la réponse
                    path.push(num_program);
                    console.log('numprog_year path: ' + JSON.stringify(path));

                    // Remplir les champs du formulaire avec les données récupérées
                    $('#date_insert_portef').val(response.date_insert_portef).trigger('change');
                    $('#nom_prog').val(response.nom_prog).trigger('change');

                    // Afficher l'alerte pour l'utilisateur
                    alert('Le programme existe déjà.');

                    // Afficher le formulaire suivant
                    $('.next-handle svg').removeClass('waiting-icon');
                    $('.next-handle svg').addClass('complet-icon');
                    $('.the-path').append(nexthop); // Ajouter le chemin suivant
                    $('#progam-handle').append(prg2); // Ajouter le formulaire
                    $('#confirm-holder').empty(); // Vider le conteneur de confirmation
                    $('#confirm-holder').append('<i class="fas fa-wrench"></i>'); // Ajouter une icône

                     // Vérifie l'existence du programme lorsque le champ de programme perd le focus
                $('#date_insert_sousProg').on('focusout', function () {
                    var Date_sou_program = $(this).val(); // Récupérer la valeur du programme
                    //var year = new Date(Date_sou_program).getFullYear(); // Extraire l'année à partir de la date
                    var num_sou_prog = $('#num_sous_prog').val(); // Récupérer la valeur de la date du programme
                    var id_prpg = path[1];
                    var num_sou_program = num_sou_prog + id_prpg; // Composer num_program

                    var nexthop = '<div class="pinfo-handle">' +
                        '<i class="fas fa-wallet"></i>' +
                        '<p >S_Program :</p>' +
                        '<p>' + num_sou_prog + '</p>' +
                        '</div>' +
                        ' <div class="next-handle">' +
                        '<i class="fas fa-angle-double-right waiting-icon"></i>' +
                        '</div>'
                    var prg3 = '<div class="form-container">' +
                        '<form>' +
                        '<div class="form-group">' +
                        '<label for="input1">N° ACTION</label>' +
                        '<input type="text" class="form-control" id="num_act" placeholder="Donnee Nom ACTION">' +
                        '</div>' +
                        '<div class="form-group">' +
                        '<label for="input1">Nom ACTION</label>' +
                        '<input type="text" class="form-control" id="nom_act" placeholder="Donnee Nom ACTION">' +
                        '</div>' +
                        '<div class="form-group" id="ElAE_act">' +
                        '<label for="input1">AE pour Action</label>' +
                        '<input type="number" class="form-control" id="AE_act" placeholder="Donnee Nom Programme">' +
                        '</div>' +
                        '<div class="form-group" id="ElCP_act">' +
                        '<label for="input1">CP pour Action</label>' +
                        '<input type="number" class="form-control" id="CP_act" placeholder="Donnee Nom Programme">' +
                        '</div>' +
                        ' <div class="form-group">' +
                        ' <label for="inputDate">Date Journal</label>' +
                        '<input type="date" class="form-control" id="date_insert_action">' +
                        '</div>' +
                        ' </form>' +
                        ' <br>' +
                        '<div id="confirm-holder_act">' +
                        '<button class="btn btn-primary" id="add-prg3">Ajouter</button>' +
                        '<hr>' +
                        ' <div class="file-handle">' +
                        '<input type="file" class="form-control" id="file">' +
                        '<button class="btn btn-primary">Journal</button>' +
                        '</div>' +
                        '</div>';

                    // Vérifie que les deux champs sont remplis avant de continuer
                    if (Date_sou_program && num_sou_prog) {
                        // Appel AJAX pour vérifier le programme dans la base de données
                        $.ajax({
                            url: '/check-sousprog',  // Route pour vérifier l'existence du programme
                            type: 'GET',
                            data: {
                                num_sous_prog: num_sou_program,

                            },
                            success: function (response) {
                                if (response.exists) {
                                    console.log(response); // Vérifiez la réponse
                                    path.push(num_sou_program);
                                    console.log('num_sou_program path: ' + JSON.stringify(path));

                                    // Remplir les champs du formulaire avec les données récupérées
                                    $('#nom_sous_prog').val(response.nom_sous_prog).trigger('change'); // Remplir et déclencher l'événement change
                                    $('#date_insert_sousProg').val(response.date_insert_sousProg).trigger('change'); // Remplir et déclencher l'événement change
                                    //$('#CP_program').val(response.CP_program).trigger('change'); // Remplir et déclencher l'événement change
                                    //$('#nom_journ_program').val(response.nom_journal).trigger('change'); // Remplir et déclencher l'événement change
                                    //$('#num_journ_program').val(response.num_journal).trigger('change'); // Remplir et déclencher l'événement change

                                    alert('Le sous programme existe déjà.');

                                    $('.next-handle svg').removeClass('waiting-icon')
                                    $('.next-handle svg').addClass('complet-icon')
                                    $('.the-path').append(nexthop)
                                    $('#progam-handle').append(prg3)
                                    $('#confirm-holder_sprog').empty()
                                    $('#confirm-holder_sprog').append('<i class="fas fa-wrench"></i>')
                                } else {
                                    // alert('Le programme n\'existe pas.');
                                }
                            },
                            error: function () {
                                alert('Erreur lors de la vérification du programme');
                            }
                        });
                    }
                });

                /**  sous prog insert */
                $('#add-prg2').on('click', function () {
                    var sou_prog = $('#num_sous_prog').val()
                    var nom_sou_prog = $('#nom_sous_prog').val();
                    var dat_sou_prog = $('#date_insert_sousProg').val()
                    var id_prog = path[1];
                    var numsouprog_year = sou_prog + id_prog;
                    //var id_port = path[0];
                    var nexthop = '<div class="pinfo-handle">' +
                        '<i class="fas fa-wallet"></i>' +
                        '<p >S_Program :</p>' +
                        '<p>' + sou_prog + '</p>' +
                        '</div>' +
                        ' <div class="next-handle">' +
                        '<i class="fas fa-angle-double-right waiting-icon"></i>' +
                        '</div>'
                    var prg3 = '<div class="form-container">' +
                        '<form>' +
                        '<div class="form-group">' +
                        '<label for="input1">N° ACTION</label>' +
                        '<input type="text" class="form-control" id="num_act" placeholder="Donnee Nom ACTION">' +
                        '</div>' +
                        '<div class="form-group">' +
                        '<label for="input1">Nom ACTION</label>' +
                        '<input type="text" class="form-control" id="nom_act" placeholder="Donnee Nom ACTION">' +
                        '</div>' +
                        '<div class="form-group" id="ElAE_act">' +
                        '<label for="input1">AE pour Action</label>' +
                        '<input type="number" class="form-control" id="AE_act" placeholder="Donnee Nom Programme">' +
                        '</div>' +
                        '<div class="form-group" id="ElCP_act">' +
                        '<label for="input1">CP pour Action</label>' +
                        '<input type="number" class="form-control" id="CP_act" placeholder="Donnee Nom Programme">' +
                        '</div>' +
                        ' <div class="form-group">' +
                        ' <label for="inputDate">Date Journal</label>' +
                        '<input type="date" class="form-control" id="date_insert_action">' +
                        '</div>' +
                        ' </form>' +
                        ' <br>' +
                        '<div id="confirm-holder_act">' +
                        '<button class="btn btn-primary" id="add-prg3">Ajouter</button>' +
                        '<hr>' +
                        ' <div class="file-handle">' +
                        '<input type="file" class="form-control" id="file">' +
                        '<button class="btn btn-primary">Journal</button>' +
                        '</div>' +
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
                            if (response.code == 200 || response.code == 404) {
                                alert(response.message)
                                path.push(numsouprog_year);
                                console.log('num_sou_program path: ' + JSON.stringify(path));

                                $('.next-handle svg').removeClass('waiting-icon')
                                $('.next-handle svg').addClass('complet-icon')
                                $('.the-path').append(nexthop)
                                $('#progam-handle').append(prg3)
                                $('#confirm-holder_sprog').empty()
                                $('#confirm-holder_sprog').append('<i class="fas fa-wrench"></i>')

                                /******           ACTION add for under_progam                    *********** */
                                $('#add-prg3').on('click', function () {
                                    /**
                                     *  this part for chacking if he want to under_action
                                     *
                                     */
                                    // Demande de confirmation pour ajouter une sous-action après l'ajout de l'action
                                    let userResponse = confirm('Voulez-vous ajouter une sous-action pour cette action ?');
                                    if (userResponse) {
                                        // Récupération des informations de l'action
                                        var nom_act = $('#nom_act').val();
                                        var num_act = $('#num_act').val();
                                        var dat_inst = $('#date_insert_action').val();
                                        var id_sou_prog = path[2];
                                        var numaction_year = num_act + numsouprog_year;
                                        // Création du formData pour l'action
                                        var formdata_act = {
                                            num_action: numaction_year,
                                            nom_action: nom_act,
                                            date_insert_action: dat_inst,
                                            id_sous_prog: id_sou_prog,
                                            id_prog: path[1],
                                            id_porte: path[0],
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
                                                    console.log('A path: ' + JSON.stringify(path));

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
                                                    $('#progam-handle').append(prg4);

                                                    // Ajout de l'événement d'ajout pour la sous-action
                                                    $('#add-prg4').on('click', function () {
                                                        var nom_sous_act = $('#nom_sous_act').val();
                                                        var num_sous_act = $('#num_sous_act').val();
                                                        var dat_inst = $('#date_insert_sou_action').val();
                                                        var year = new Date().getFullYear();
                                                        var numsousaction_year = num_sous_act + numaction_year;
                                                        // Création du formData pour la sous-action
                                                        var formdata_sous_act = {
                                                            num_sous_action: numsousaction_year,
                                                            nom_sous_action: nom_sous_act,
                                                            date_insert_sous_action: dat_inst,
                                                            num_act: path[3],
                                                            id_sous_prog: path[2],
                                                            id_prog: path[1],
                                                            id_porte: path[0],
                                                            year: year,
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
                                                                    console.log('path: ' + JSON.stringify(path));

                                                                    // Redirection vers la page suivante après l'ajout de la sous-action
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
                                        var numaction_year = num_act + numsouprog_year;
                                        var id_sou_prog = path[2];

                                        var formdata_act = {
                                            num_action: numaction_year,
                                            nom_action: nom_act,
                                            date_insert_action: dat_inst,
                                            id_sous_prog: id_sou_prog,
                                            id_prog: path[1],
                                            id_porte: path[0],
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
                                                    // console.log('path: ' + JSON.stringify(path));
                                                    window.location.href = 'testing/Action/' + path.join('/');
                                                }
                                            },
                                            error: function (response) {
                                                alert('Erreur lors de l\'ajout de l\'action.');
                                            }
                                        });
                                    }

                                    /*********         END ACTION ********************************************** */
                                })

                            }
                        },
                        error: function (response) {
                            alert('error')
                        }
                    })

                    /**  this for Creating the T port so we gonna send it to Action handle to deal with it */

                })

                } else {
                    // Le programme n'existe pas, vous pouvez traiter cela si nécessaire
                }
            },
            error: function () {
                alert('Erreur lors de la vérification du programme');
            }
        });
    }
});



$("#add-prg").on('click', function () {
    var id_prog = $('#num_prog').val();
    var nom_prog = $('#nom_prog').val();
    var numprog_year = id_prog + path[0];
    var date_sort_jour = $('#date_insert_portef').val();
    var formprogdata = {
        num_prog: numprog_year,
        nom_prog: nom_prog,
        num_portefeuil: path[0],
        date_insert_portef: date_sort_jour,
        _token: $('meta[name="csrf-token"]').attr('content'),
        _method: 'POST'
    }
    var prg2 = '<div class="form-container">' +
        '<form>' +
        '<div class="form-group">' +
        '<label for="input1">N° Sous Programme</label>' +
        '<input type="text" class="form-control" id="num_sous_prog" placeholder="Donnee Nom Sous Programme">' +
        '</div>' +
        '<div class="form-group">' +
        '<label for="input1">Nom Sous Programme</label>' +
        '<input type="text" class="form-control" id="nom_sous_prog" placeholder="Donnee Nom Sous Programme">' +
        '</div>' +
        '<!--div class="form-group">' +
        '<label for="input1">AE</label>' +
        '<input type="number" class="form-control" id="AE_sous_porg" >' +
        '</div>' +
        '<div class="form-group">' +
        '<label for="input1">CP</label>' +
        '<input type="number" class="form-control" id="CP_sous_prog">' +
        '</div-->' +
        ' <div class="form-group">' +
        ' <label for="inputDate">Date Journal</label>' +
        '<input type="date" class="form-control" id="date_insert_sousProg">' +
        '</div>' +
        ' </form>' +
        ' <br>' +
        '<div id="confirm-holder_sprog">' +
        '<button class="btn btn-primary" id="add-prg2">Ajouter</button>' +
        '<hr>' +
        ' <div class="file-handle">' +
        '<input type="file" class="form-control" id="file">' +
        '<button class="btn btn-primary">Journal</button>' +
        '</div>' +
        '</div>'
    var nexthop = '<div class="pinfo-handle">' +
        '<i class="fas fa-wallet"></i>' +
        '<p >Programm :</p>' +
        '<p>' + id_prog + '</p>' +
        '</div>' +
        ' <div class="next-handle">' +
        '<i class="fas fa-angle-double-right waiting-icon"></i>' +
        '</div>';
    $.ajax({
        url: '/creationProg',
        type: "POST",
        data: formprogdata,
        success: function (response) {
            if (response.code == 200 || response.code == 404) {

                alert(response.message)
                path.push(numprog_year);
                console.log('numprog_year path: ' + JSON.stringify(path));

                $('.next-handle svg').removeClass('waiting-icon')
                $('.next-handle svg').addClass('complet-icon')
                $('.the-path').append(nexthop)
                $('#progam-handle').append(prg2)
                $('#confirm-holder').empty()
                $('#confirm-holder').append('<i class="fas fa-wrench"></i>')


                // Vérifie l'existence du programme lorsque le champ de programme perd le focus
                $('#date_insert_sousProg').on('focusout', function () {
                    var Date_sou_program = $(this).val(); // Récupérer la valeur du programme
                    //var year = new Date(Date_sou_program).getFullYear(); // Extraire l'année à partir de la date
                    var num_sou_prog = $('#num_sous_prog').val(); // Récupérer la valeur de la date du programme
                    var id_prpg = path[1];
                    var num_sou_program = num_sou_prog + id_prpg; // Composer num_program

                    var nexthop = '<div class="pinfo-handle">' +
                        '<i class="fas fa-wallet"></i>' +
                        '<p >S_Program :</p>' +
                        '<p>' + num_sou_prog + '</p>' +
                        '</div>' +
                        ' <div class="next-handle">' +
                        '<i class="fas fa-angle-double-right waiting-icon"></i>' +
                        '</div>'
                    var prg3 = '<div class="form-container">' +
                        '<form>' +
                        '<div class="form-group">' +
                        '<label for="input1">N° ACTION</label>' +
                        '<input type="text" class="form-control" id="num_act" placeholder="Donnee Nom ACTION">' +
                        '</div>' +
                        '<div class="form-group">' +
                        '<label for="input1">Nom ACTION</label>' +
                        '<input type="text" class="form-control" id="nom_act" placeholder="Donnee Nom ACTION">' +
                        '</div>' +
                        '<div class="form-group" id="ElAE_act">' +
                        '<label for="input1">AE pour Action</label>' +
                        '<input type="number" class="form-control" id="AE_act" placeholder="Donnee Nom Programme">' +
                        '</div>' +
                        '<div class="form-group" id="ElCP_act">' +
                        '<label for="input1">CP pour Action</label>' +
                        '<input type="number" class="form-control" id="CP_act" placeholder="Donnee Nom Programme">' +
                        '</div>' +
                        ' <div class="form-group">' +
                        ' <label for="inputDate">Date Journal</label>' +
                        '<input type="date" class="form-control" id="date_insert_action">' +
                        '</div>' +
                        ' </form>' +
                        ' <br>' +
                        '<div id="confirm-holder_act">' +
                        '<button class="btn btn-primary" id="add-prg3">Ajouter</button>' +
                        '<hr>' +
                        ' <div class="file-handle">' +
                        '<input type="file" class="form-control" id="file">' +
                        '<button class="btn btn-primary">Journal</button>' +
                        '</div>' +
                        '</div>';

                    // Vérifie que les deux champs sont remplis avant de continuer
                    if (Date_sou_program && num_sou_prog) {
                        // Appel AJAX pour vérifier le programme dans la base de données
                        $.ajax({
                            url: '/check-sousprog',  // Route pour vérifier l'existence du programme
                            type: 'GET',
                            data: {
                                num_sous_prog: num_sou_program,

                            },
                            success: function (response) {
                                if (response.exists) {
                                    console.log(response); // Vérifiez la réponse
                                    path.push(num_sou_program);
                                    console.log('num_sou_program path: ' + JSON.stringify(path));

                                    // Remplir les champs du formulaire avec les données récupérées
                                    $('#nom_sous_prog').val(response.nom_sous_prog).trigger('change'); // Remplir et déclencher l'événement change
                                    $('#date_insert_sousProg').val(response.date_insert_sousProg).trigger('change'); // Remplir et déclencher l'événement change
                                    //$('#CP_program').val(response.CP_program).trigger('change'); // Remplir et déclencher l'événement change
                                    //$('#nom_journ_program').val(response.nom_journal).trigger('change'); // Remplir et déclencher l'événement change
                                    //$('#num_journ_program').val(response.num_journal).trigger('change'); // Remplir et déclencher l'événement change

                                    alert('Le sous programme existe déjà.');

                                    $('.next-handle svg').removeClass('waiting-icon')
                                    $('.next-handle svg').addClass('complet-icon')
                                    $('.the-path').append(nexthop)
                                    $('#progam-handle').append(prg3)
                                    $('#confirm-holder_sprog').empty()
                                    $('#confirm-holder_sprog').append('<i class="fas fa-wrench"></i>')
                                } else {
                                    // alert('Le programme n\'existe pas.');
                                }
                            },
                            error: function () {
                                alert('Erreur lors de la vérification du programme');
                            }
                        });
                    }
                });
                /**  sous prog insert */
                $('#add-prg2').on('click', function () {
                    var sou_prog = $('#num_sous_prog').val()
                    var nom_sou_prog = $('#nom_sous_prog').val();
                    var dat_sou_prog = $('#date_insert_sousProg').val()
                    var id_prog = path[1];
                    var numsouprog_year = sou_prog + id_prog;
                    //var id_port = path[0];
                    var nexthop = '<div class="pinfo-handle">' +
                        '<i class="fas fa-wallet"></i>' +
                        '<p >S_Program :</p>' +
                        '<p>' + sou_prog + '</p>' +
                        '</div>' +
                        ' <div class="next-handle">' +
                        '<i class="fas fa-angle-double-right waiting-icon"></i>' +
                        '</div>'
                    var prg3 = '<div class="form-container">' +
                        '<form>' +
                        '<div class="form-group">' +
                        '<label for="input1">N° ACTION</label>' +
                        '<input type="text" class="form-control" id="num_act" placeholder="Donnee Nom ACTION">' +
                        '</div>' +
                        '<div class="form-group">' +
                        '<label for="input1">Nom ACTION</label>' +
                        '<input type="text" class="form-control" id="nom_act" placeholder="Donnee Nom ACTION">' +
                        '</div>' +
                        '<div class="form-group" id="ElAE_act">' +
                        '<label for="input1">AE pour Action</label>' +
                        '<input type="number" class="form-control" id="AE_act" placeholder="Donnee Nom Programme">' +
                        '</div>' +
                        '<div class="form-group" id="ElCP_act">' +
                        '<label for="input1">CP pour Action</label>' +
                        '<input type="number" class="form-control" id="CP_act" placeholder="Donnee Nom Programme">' +
                        '</div>' +
                        ' <div class="form-group">' +
                        ' <label for="inputDate">Date Journal</label>' +
                        '<input type="date" class="form-control" id="date_insert_action">' +
                        '</div>' +
                        ' </form>' +
                        ' <br>' +
                        '<div id="confirm-holder_act">' +
                        '<button class="btn btn-primary" id="add-prg3">Ajouter</button>' +
                        '<hr>' +
                        ' <div class="file-handle">' +
                        '<input type="file" class="form-control" id="file">' +
                        '<button class="btn btn-primary">Journal</button>' +
                        '</div>' +
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
                            if (response.code == 200 || response.code == 404) {
                                alert(response.message)
                                path.push(numsouprog_year);
                                console.log('num_sou_program path: ' + JSON.stringify(path));

                                $('.next-handle svg').removeClass('waiting-icon')
                                $('.next-handle svg').addClass('complet-icon')
                                $('.the-path').append(nexthop)
                                $('#progam-handle').append(prg3)
                                $('#confirm-holder_sprog').empty()
                                $('#confirm-holder_sprog').append('<i class="fas fa-wrench"></i>')
                                /******           ACTION add for under_progam                    *********** */
                                $('#add-prg3').on('click', function () {
                                    /**
                                     *  this part for chacking if he want to under_action
                                     *
                                     */
                                    // Demande de confirmation pour ajouter une sous-action après l'ajout de l'action
                                    let userResponse = confirm('Voulez-vous ajouter une sous-action pour cette action ?');
                                    if (userResponse) {
                                        // Récupération des informations de l'action
                                        var nom_act = $('#nom_act').val();
                                        var num_act = $('#num_act').val();
                                        var dat_inst = $('#date_insert_action').val();
                                        var id_sou_prog = path[2];
                                        var numaction_year = num_act + numsouprog_year;
                                        // Création du formData pour l'action
                                        var formdata_act = {
                                            num_action: numaction_year,
                                            nom_action: nom_act,
                                            date_insert_action: dat_inst,
                                            id_sous_prog: id_sou_prog,
                                            id_prog: path[1],
                                            id_porte: path[0],
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
                                                    console.log('A path: ' + JSON.stringify(path));

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
                                                    $('#progam-handle').append(prg4);

                                                    // Ajout de l'événement d'ajout pour la sous-action
                                                    $('#add-prg4').on('click', function () {
                                                        var nom_sous_act = $('#nom_sous_act').val();
                                                        var num_sous_act = $('#num_sous_act').val();
                                                        var dat_inst = $('#date_insert_sou_action').val();
                                                        var year = new Date().getFullYear();
                                                        var numsousaction_year = num_sous_act + numaction_year;
                                                        // Création du formData pour la sous-action
                                                        var formdata_sous_act = {
                                                            num_sous_action: numsousaction_year,
                                                            nom_sous_action: nom_sous_act,
                                                            date_insert_sous_action: dat_inst,
                                                            num_act: path[3],
                                                            id_sous_prog: path[2],
                                                            id_prog: path[1],
                                                            id_porte: path[0],
                                                            year: year,
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
                                                                    console.log('path: ' + JSON.stringify(path));

                                                                    // Redirection vers la page suivante après l'ajout de la sous-action
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
                                        var numaction_year = num_act + numsouprog_year;
                                        var id_sou_prog = path[2];

                                        var formdata_act = {
                                            num_action: numaction_year,
                                            nom_action: nom_act,
                                            date_insert_action: dat_inst,
                                            id_sous_prog: id_sou_prog,
                                            id_prog: path[1],
                                            id_porte: path[0],
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
                                                    // console.log('path: ' + JSON.stringify(path));
                                                    window.location.href = 'testing/Action/' + path.join('/');
                                                }
                                            },
                                            error: function (response) {
                                                alert('Erreur lors de l\'ajout de l\'action.');
                                            }
                                        });
                                    }

                                    /*********         END ACTION ********************************************** */
                                })

                            }
                        },
                        error: function (response) {
                            alert('error')
                        }
                    })

                    /**  this for Creating the T port so we gonna send it to Action handle to deal with it */

                })
            }
        },
        error: function (response) {
            alert('error')
        }
    })




});

/**
 * this for action T port select table
 *
 */

function T1_table(id, T) {
    console.log('data is')
    $('#Tport-handle').addClass('scale-out');
    setTimeout(() => {
        // Add the class to hide the table
        $('#Tport-handle').addClass('scale-hidden');
        // Optionally remove the scaling out class after hiding
        $('#Tport-handle').removeClass('scale-out');
        $('.T-handle').css('display', 'flex')
    }, 500)
    var headT = '<tr>' +
        '<th colspan="2"><h1>T Description</h1></th>' +
        '<th><h1>AE</h1></th>' +
        '<th><h1>CP</h1></th>' +
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
                '<td class="editable" id="CP_T1">' + 180 + ',000</td>' +
                '</tr>';

            // Append the row to the table body
            $('#T-tables tbody').append(row);
            Edit(id, T)
        });
    }).fail(function () {
        console.error('Error loading JSON file.');
    });
}
function T2_table(id, T) {
    $('#Tport-handle').addClass('scale-out');
    setTimeout(() => {
        // Add the class to hide the table
        $('#Tport-handle').addClass('scale-hidden');
        // Optionally remove the scaling out class after hiding
        $('#Tport-handle').removeClass('scale-out');
        $('.T-handle').css('display', 'flex')
    }, 500)
    var headT = '<tr>' +
        '<th colspan="2"><h1>T Description</h1></th>' +
        ' <th colspan="2">' +
        ' <div class="fusion-father">' +
        ' <h1>CREDITS OUVERTS</h1>' +
        '<div class="fusion-child">' +
        ' <h1 style="width:40px;">AE</h1>' +
        ' <h1>CP</h1>' +
        ' </div>' +
        ' </div>  ' +
        '</th>' +
        '<th colspan="2">' +
        ' <div class="fusion-father">' +
        '<h1>CREDITS ATTENDUS EVENUS DISPONIBLES</h1>' +
        '<div class="fusion-child">' +
        '<h1 style="width:40px;">AE</h1>' +
        '<h1>CP</h1>' +
        '</div>' +
        '</div>    ' +
        '</th>' +
        '<th colspan="2">' +
        '<div class="fusion-father">' +
        '<h1>TOTAL CREDITS DISPONIBLES</h1>' +
        '<div class="fusion-child">' +
        ' <h1 style="width:40px;">AE</h1>' +
        '<h1>CP</h1>' +
        '</div>' +
        '</div>    ' +
        '</th>' +
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
                '<td class="editable" id="CP_Over">' + 180 + ',000</td>' +
                '<td class="editable" id="AE_att">' + 0 + '</td>' +
                '<td class="editable" id="CP_att">' + 180 + ',000</td>' +
                '<td class="editable" id="AE_TT">' + 0 + '</td>' +
                '<td class="editable" id="CP_TT">' + 360 + ',000</td>' +
                '</tr>';

            // Append the row to the table body
            $('#T-tables tbody').append(row);
            Edit(id)

        });
    }).fail(function () {
        console.error('Error loading JSON file.');
    });
}
function T3_table(id, T) {
    console.log('data is')
    $('#Tport-handle').addClass('scale-out');
    setTimeout(() => {
        // Add the class to hide the table
        $('#Tport-handle').addClass('scale-hidden');
        // Optionally remove the scaling out class after hiding
        $('#Tport-handle').removeClass('scale-out');
        $('.T-handle').css('display', 'flex')
    }, 500)
    var headT = '<tr>' +
        '<th><h1>code</h1></th>' +
        '<th colspan="2"><h1>T Description</h1></th>' +
        '<th colspan="2">' +
        '<div class="fusion-father">' +
        '<h1>MONTANT ANNEE (N)</h1>' +
        '<div class="fusion-child">' +
        ' <h1 style="width:40px;">AE</h1>' +
        '<h1>CP</h1>' +
        '</div>' +
        '</div>    ' +
        '</th>' +
        '</tr>';
    $('#T-tables thead').append(headT)
    $.getJSON(jsonpath3, function (data) {
        // Loop through each item in the JSON data
        $.each(data, function (key, value) {
            // Create a table row
            var val = value.split('-')
            console.log('values' + JSON.stringify(val))
            let row = '<tr>' +
                '<td class="code">' + key + '</td>' +
                '<td>' + val[0] + ' </td>' +
                '<td>' + val[1] + '</td>' +
                '<td class="editable">' + 0 + '</td>' +
                '<td class="editable">' + 180 + ',000</td>' +
                '</tr>';

            // Append the row to the table body
            $('#T-tables tbody').append(row);
            Edit(id)
        });
    }).fail(function () {
        console.error('Error loading JSON file.');
    });
}
function T4_table() {

}
$(document).ready(function () {

    $('#T1').on('click', function () {
        var id = $(this).attr('id');
        var T = 1;
        T1_table(id, T)
    })
    $('#T2').on('click', function () {
        var T = 2;

        T2_table(id, T)
    })
    $('#T3').on('click', function () {
        var T = 3;
        T3_table(id, T)
    })
    $('#T4').on('click', function () {

    })
    $(".TP-handle").on('click', function () {
        $('#T-tables thead').empty()
        $('#T-tables tbody').empty()

        var id_tport_c = $(this).attr('id');
        if (id_tport_c == 'T_port1') {
            T1_table(id_tport_c)
        }
        if (id_tport_c == 'T_port2') {
            T2_table(id_tport_c)
        }
        if (id_tport_c == 'T_port3') {
            T3_table(id_tport_c)
        }
        console.log('testign which port im ' + id_tport_c)
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
>>>>>>> 14476adda16ddf772b6e5a455aea596d3d396444
