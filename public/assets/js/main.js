
var click = 0;
var iupdate=1;
var changing_mist = new Object();
var value_chng = new Array()
var  dataupdate=new Array();
var replac=false;

/**
 *
 * this function for adding button et makalah -_- ;
 */

function preview(file)
{
    $('#'+file).on('change', function(event) {
      const file = event.target.files[0];
      const $preview = $('#preview');
      $preview.html(''); // Clear previous content

      if (file) {
        const reader = new FileReader();
        console.log('access to preview')
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


function preview_sprog(file)
{
    $('#'+file).on('change', function(event) {
      const file = event.target.files[0];
      const $preview = $('#preview_sporg');
      $preview.html(''); // Clear previous content

      if (file) {
        const reader = new FileReader();
        console.log('access to preview')
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

function preview_act(file)
{
    $('#'+file).on('change', function(event) {
      const file = event.target.files[0];
      const $preview = $('#preview_act');
      $preview.html(''); // Clear previous content

      if (file) {
        const reader = new FileReader();
        console.log('access to preview')
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

function openForm() {
    document.getElementById("myForm").style.display = "block";
  }
  
  function closeForm() {
    document.getElementById("myForm").style.display = "none";
  }

function vider_t(t,id,id_sa)
{
    if($(id).is(":visible")) {
        //console.log("Element is visible");

        $.ajax({
            url:'/viderTab/',
            type:'POST',
            data:{
                T:t,
                Act:id_sa,
                _token: $('meta[name="csrf-token"]').attr("content"),
                _method: "POST",
            },
            success:function(response)
            {
                if(response.code == 200)
                {
                    window.location.reload()
                }
                else
                {
                    //console.log('pas option de supprission')
                }
            }
        })
    } else {
        //console.log("Element is hidden");
    }
}
function appliquer_up(T)
{
    $('.change_app').on('click',function(){
        var idbtn=$(this).children('#changin').attr('id');
        if(idbtn =='changin' )
        {
            //console.log('i insert '+JSON.stringify(dataupdate))
            //console.log('click once'+iupdate);


            //console.log('click after'+iupdate);
   $.ajax({
        url:'/update',
        type:'POST',
        data:{
            Tport:T,
            result:dataupdate,
            _token: $('meta[name="csrf-token"]').attr("content"),
            _method: "POST",},
            success:function(response)
            {
                if(response.code == 200)
                    {
                dataupdate.forEach(elemnt=>{
                    //console.log('green add to '+elemnt.code)
                    $('#ref'+elemnt.code).addClass('row-updated');

                    dataupdate=Array();
                })
                }
            }


    })

       //console.log('testing'+JSON.stringify(dataupdate))
       $('.change_app').empty()
    click=0;

        }
    })
}
function insert_edit(tid,T)
{
    var data = {
        disp:{},
         ae: {},
         cp: {},
         ae_ouvert: {},
         cp_ouvert: {},
         ae_attendu: {},
         cp_attendu: {},
         ae_reporte: {},
         ae_notifie: {},
         ae_engage: {},
         cp_reporte: {},
         cp_notifie: {},
         cp_consome: {},
         descrp:{},
         intituel:{}
     };
    $('#reloading').removeClass('reload-hidden')
    //    alert('changing success')
    $('#T-tables tbody tr').each(function () {
    
    if (tid == 'T_port1' || tid == 'T1') {
    
    var code = $(this).find('td').eq(0).text();
    var aeValue = $(this).find('td').eq(2).text();
    var cpValue = $(this).find('td').eq(3).text();
    // Ajoute les valeurs dans les objets
    data.ae[code] = aeValue;
    data.cp[code] = cpValue;
    //console.log('Data of T1'+JSON.stringify(data));
    
    
    }
    if (tid == 'T_port2' || tid == 'T2') {
    
    var code = $(this).find('td').eq(0).text();
    var aeDataOuvert = $(this).find('td').eq(2).text();
    var cpDataOuvert = $(this).find('td').eq(3).text();
    var aeDataAttendu = $(this).find('td').eq(4).text();
    var cpDataAttendu = $(this).find('td').eq(5).text();
    /* var someae = parseFloat(aeDataOuvert) + parseFloat(aeDataAttendu);
    var somecp = parseFloat(cpDataOuvert) + parseFloat(cpDataAttendu);
    */
    // Ajoute les valeurs dans les objets
    data.ae_ouvert[code] = aeDataOuvert;
    data.cp_ouvert[code] = cpDataOuvert;
    data.ae_attendu[code] = aeDataAttendu;
    data.cp_attendu[code] = cpDataAttendu;
    
    }
    if (tid == 'T_port3' || tid == 'T3' || tid == 3) {
    
    var code = $(this).find('td').eq(0).text();
    var descrip=$(this).find('td').eq(2).text();
    var intituel=$(this).find('td').eq(3).text();
    var aeDataReporte = $(this).find('td').eq(4).text();
    var aeDataNotifie = $(this).find('td').eq(5).text();
    var aeDataEngage = $(this).find('td').eq(6).text();
    
    var cpDataReporte = $(this).find('td').eq(7).text();
    var cpDataNotifie = $(this).find('td').eq(8).text();
    var cpDataEngage = $(this).find('td').eq(9).text();
    
    
    // Ajoute les valeurs dans les objet
    ////console.log("ddcss");
    data.descrp[code]=descrip
    data.intituel[code]=intituel
    data.ae_reporte[code] = aeDataReporte;
    data.ae_notifie[code] = aeDataNotifie;
    data.ae_engage[code] = aeDataEngage;
    
    data.cp_reporte[code] = cpDataReporte;
    data.cp_notifie[code] = cpDataNotifie;
    data.cp_consome[code] = cpDataEngage;
    //console.log('code in tables'+code);
    }
    if (tid == 'T_port4' || tid == 'T4') {
    
    var code = $(this).find('td').eq(0).text();
    var descr= $(this).find('td').eq(1).text();
    var dispo= $(this).find('td').eq(2).text()
    var aeValue = $(this).find('td').eq(3).text();
    var cpValue = $(this).find('td').eq(4).text();
    // Ajoute les valeurs dans les objets
    data.descrp[code]=descr;
    data.disp[code]=dispo;
    data.ae[code] = aeValue;
    data.cp[code] = cpValue;
    //console.log('T4'+JSON.stringify(data))
    
    }
    // value_chng.push(rw);
    })
    
    $('.change_app').empty()
    //  //console.log('path' + JSON.stringify(path))
    //console.log('path' + JSON.stringify(path3))
    //var url=   '/testing/Action/' + path.join('/');
    //console.log(" eat " + path3.length)
    if (path3.length > 4) {
    //console.log('URL plus' + url)
    var url = '/testing/S_action/' + path3[0] + '/' + path3[1] + '/' + path3[2] + '/' + path3[3] + '/' + path3[4] + '/' + T;
    //var id_sous_action= path[4];
    } else {
        //console.log('path' + JSON.stringify(path3))
    // var id_sous_action= path[3];
    var url = '/testing/S_action/' + path3[0] + '/' + path3[1] + '/' + path3[2] + '/' + path3[3] + '/' + path3[3] + '/' + T;
    //console.log('URL less' + url)
    }
    
    $.ajax({
    url: url,
    type: 'GET',
    data: {
    ae: data.ae,
    cp: data.cp,
    
    ae_ouvert: data.ae_ouvert,
    cp_ouvert: data.cp_ouvert,
    ae_attendu: data.ae_attendu,
    cp_attendu: data.cp_attendu,
    
    ae_reporte: data.ae_reporte,
    ae_notifie: data.ae_notifie,
    ae_engage: data.ae_engage,
    cp_reporte: data.cp_reporte,
    cp_notifie: data.cp_notifie,
    cp_consome: data.cp_consome,
    dispo:data.disp,
    intitule:data.intituel,
    descr:data.descrp,
    //id_sous_action: id_sous_action,
    _token: $('meta[name="csrf-token"]').attr('content'),
    _method: "GET"
    },
    success: function (response) {
    if (response.code == 200 || response.code == 404) {
    
    window.location.reload();
    }
    else
    {
    //console.log(response.message)
    }
    },
    error: function (response) {
    //console.log('error')
//console.log('data ->'+JSON.stringify(data.ae_notifie))
    }
    
    
    });
    click = 0;
}


function calaulsomeAE_CP_sprog()
{
    someAE_TT=0;
    someCP_TT=0;
    var oldTT=0
    var old=0;
    var oldTTCP=0
    var oldCP=0;
        /**   ----------------------------------------------- some AE T ---------------*/
    $('#T1_AE_init').on('focusin',function(){
        oldTT=$('#AE_sous_prog').val();
        old=$(this).val();
        //console.log('old value'+oldTT);
    })
    $('#T1_AE_init').on('focusout',function(){
        
        //console.log('old before if'+oldTT);
        if(old == 0 || old == '' || old == '0' || old == null || old =='NaN')
        {
            old='0'
        }
        if(oldTT == 0 || oldTT == '' || oldTT == '0' || oldTT == null || oldTT =='NaN' )
            {
                someAE_TT=0;
            someAE_TT+=parseNumberWithoutCommas($(this).val())
            $('#AE_sous_prog').val(ValAccountingFigures(someAE_TT))
            //console.log('TT '+someAE_TT)
            }
            else
            {
            someAE_TT=parseNumberWithoutCommas(oldTT) - parseNumberWithoutCommas(old)
            //console.log('TT befor addin'+someAE_TT);
            someAE_TT+=parseNumberWithoutCommas($(this).val())
            $('#AE_sous_prog').val(ValAccountingFigures(someAE_TT))
            //console.log('old TT '+someAE_TT)
            }
            
    })

    $('#T2_AE_init').on('focusin',function(){
        oldTT=$('#AE_sous_prog').val();
        old=$(this).val();
        //console.log('old value'+oldTT);
    })

    $('#T2_AE_init').on('focusout',function(){
        //console.log('old before if'+oldTT);
        if(old == 0 || old == '' || old == '0' || old == null || old =='NaN')
            {
                old='0'
            }
        if(oldTT == 0 || oldTT == '' || oldTT == '0' || oldTT == null || oldTT =='NaN')
            {
                someAE_TT=0;
            someAE_TT+=parseNumberWithoutCommas($(this).val())
            $('#AE_sous_prog').val(ValAccountingFigures(someAE_TT))
            //console.log('TT '+someAE_TT)
            }
            else
            {
                someAE_TT=parseNumberWithoutCommas(oldTT) - parseNumberWithoutCommas(old)
            //console.log('TT befor addin'+someAE_TT);
            someAE_TT+=parseNumberWithoutCommas($(this).val())
            $('#AE_sous_prog').val(ValAccountingFigures(someAE_TT))
            //console.log('old TT '+someAE_TT)
            }
    })

    $('#T3_AE_init').on('focusin',function(){
        oldTT=$('#AE_sous_prog').val();
        old=$(this).val();
        //console.log('old value'+oldTT);
    })

    $('#T3_AE_init').on('focusout',function(){
        //console.log('old before if'+oldTT);
        if(old == 0 || old == '' || old == '0' || old == null || old =='NaN')
            {
                old='0'
            }
        if(oldTT == 0 || oldTT == '' || oldTT == '0' || oldTT == null || oldTT =='NaN')
            {
                someAE_TT=0;
            someAE_TT+=parseNumberWithoutCommas($(this).val())
            $('#AE_sous_prog').val(ValAccountingFigures(someAE_TT))
            //console.log('TT '+someAE_TT)
            }
            else
            {
            someAE_TT=parseNumberWithoutCommas(oldTT) - parseNumberWithoutCommas(old)
            //console.log('TT befor addin'+someAE_TT);
            someAE_TT+=parseNumberWithoutCommas($(this).val())
            $('#AE_sous_prog').val(ValAccountingFigures(someAE_TT))
            //console.log('old TT '+someAE_TT)
            }
    })

    $('#T4_AE_init').on('focusin',function(){
        oldTT=$('#AE_sous_prog').val();
        old=$(this).val();
        //console.log('old value'+oldTT);
    })

    $('#T4_AE_init').on('focusout',function(){
        //console.log('old before if'+oldTT);
        if(old == 0 || old == '' || old == '0' || old == null || old =='NaN')
            {
                old='0'
            }
        if(oldTT == 0 || oldTT == '' || oldTT == '0' || oldTT == null || oldTT =='NaN')
            {
            someAE_TT=0
            someAE_TT+=parseNumberWithoutCommas($(this).val())
            $('#AE_sous_prog').val(ValAccountingFigures(someAE_TT))
            //console.log('null TT '+someAE_TT)
            }
            else
            {
            //console.log('TT refresh new Value some '+someAE_TT+' old'+oldTT);
            someAE_TT=parseNumberWithoutCommas(oldTT) - parseNumberWithoutCommas(old)
            
            someAE_TT+=parseNumberWithoutCommas($(this).val())
            $('#AE_sous_prog').val(ValAccountingFigures(someAE_TT))
            //console.log('old TT '+someAE_TT)
            }
    })
    /**  ------------------------------------------------------ rnf ---------------- */
    /**------------------------------------ Some CP T ----------------------------- */

    $('#T1_CP_init').on('focusin',function(){
        oldTTCP=$('#CP_sous_prog').val();
        oldCP=$(this).val();
        //console.log('old value'+oldTTCP);
    })


    $('#T1_CP_init').on('focusout',function(){


        //console.log('old before if'+oldTTCP);
        if(oldCP == 0 || oldCP == '' || oldCP == '0' || oldCP == null || oldCP =='NaN')
        {
            oldCP='0'
        }
        if(oldTTCP == 0 || oldTTCP == '' || oldTTCP == '0' || oldTTCP == null || oldTTCP =='NaN' )
            {
                someCP_TT=0;
            someCP_TT+=parseNumberWithoutCommas($(this).val())
            $('#CP_sous_prog').val(ValAccountingFigures(someCP_TT))
            //console.log('TT '+someCP_TT)
            }
            else
            {
            someCP_TT=parseNumberWithoutCommas(oldTTCP) - parseNumberWithoutCommas(oldCP)
            //console.log('TT befor addin'+someCP_TT);
            someCP_TT+=parseNumberWithoutCommas($(this).val())
            $('#CP_sous_prog').val(ValAccountingFigures(someCP_TT))
            //console.log('old TT '+someCP_TT)
            }

    })

    $('#T2_CP_init').on('focusin',function(){
        oldTTCP=$('#CP_sous_prog').val();
        oldCP=$(this).val();
        //console.log('old value'+oldTT);
    })


    $('#T2_CP_init').on('focusout',function(){

        //console.log('old before if'+oldTTCP);
        if(oldCP == 0 || oldCP == '' || oldCP == '0' || oldCP == null || oldCP =='NaN')
        {
            oldCP='0'
        }
        if(oldTTCP == 0 || oldTTCP == '' || oldTTCP == '0' || oldTTCP == null || oldTTCP =='NaN' )
            {
                someCP_TT=0;
            someCP_TT+=parseNumberWithoutCommas($(this).val())
            $('#CP_sous_prog').val(ValAccountingFigures(someCP_TT))
            //console.log('TT '+someCP_TT)
            }
            else
            {
            someCP_TT=parseNumberWithoutCommas(oldTTCP) - parseNumberWithoutCommas(oldCP)
            //console.log('TT befor addin'+someCP_TT);
            someCP_TT+=parseNumberWithoutCommas($(this).val())
            $('#CP_sous_prog').val(ValAccountingFigures(someCP_TT))
            //console.log('old TT '+someCP_TT)
            }
        
    })

    $('#T3_CP_init').on('focusin',function(){
        oldTTCP=$('#CP_sous_prog').val();
        oldCP=$(this).val();
        //console.log('old value'+oldTTCP);
    })

    $('#T3_CP_init').on('focusout',function(){

        //console.log('old before if'+oldTTCP);
        if(oldCP == 0 || oldCP == '' || oldCP == '0' || oldCP == null || oldCP =='NaN')
        {
            oldCP='0'
        }
        if(oldTTCP == 0 || oldTTCP == '' || oldTTCP == '0' || oldTTCP == null || oldTTCP =='NaN' )
            {
                someCP_TT=0;
            someCP_TT+=parseNumberWithoutCommas($(this).val())
            $('#CP_sous_prog').val(ValAccountingFigures(someCP_TT))
            //console.log('TT '+someCP_TT)
            }
            else
            {
            someCP_TT=parseNumberWithoutCommas(oldTTCP) - parseNumberWithoutCommas(oldCP)
            //console.log('TT befor addin'+someCP_TT);
            someCP_TT+=parseNumberWithoutCommas($(this).val())
            $('#CP_sous_prog').val(ValAccountingFigures(someCP_TT))
            //console.log('old TT '+someCP_TT)
            }
        
    })

    $('#T4_CP_init').on('focusin',function(){
        oldTTCP=$('#CP_sous_prog').val();
        oldCP=$(this).val();
        //console.log('old value'+oldTTCP);
    })

    $('#T4_CP_init').on('focusout',function(){

        //console.log('old before if'+oldTT);
        if(oldCP == 0 || oldCP == '' || oldCP == '0' || oldCP == null || oldCP =='NaN')
        {
            oldCP='0'
        }
        if(oldTTCP == 0 || oldTTCP == '' || oldTTCP == '0' || oldTTCP == null || oldTTCP =='NaN' )
            {
            someCP_TT=0;
            someCP_TT+=parseNumberWithoutCommas($(this).val())
            $('#CP_sous_prog').val(ValAccountingFigures(someCP_TT))
            //console.log('TT '+someCP_TT)
            }
            else
            {
            someCP_TT=parseNumberWithoutCommas(oldTTCP) - parseNumberWithoutCommas(oldCP)
            //console.log('TT befor addin'+someCP_TT);
            someCP_TT+=parseNumberWithoutCommas($(this).val())
            $('#CP_sous_prog').val(ValAccountingFigures(someCP_TT))
            //console.log('old TT '+someCP_TT)
            }
        
    })
}


function calaulsomeAE_CP_act()
{
    someAE_TT=0;
    someCP_TT=0;
    var oldTT=0
    var old=0;
    var oldTTCP=0
    var oldCP=0;
        /**   ----------------------------------------------- some AE T ---------------*/
    $('#T1_AE_init_AC').on('focusin',function(){
        oldTT=$('#AE_act').val();
        old=$(this).val();
        //console.log('old value'+oldTT);
    })
    $('#T1_AE_init_AC').on('focusout',function(){
        
        //console.log('old before if'+oldTT);
        if(old == 0 || old == '' || old == '0' || old == null || old =='NaN')
        {
            old='0'
        }
        if(oldTT == 0 || oldTT == '' || oldTT == '0' || oldTT == null || oldTT =='NaN' )
            {
                someAE_TT=0;
            someAE_TT+=parseNumberWithoutCommas($(this).val())
            $('#AE_act').val(ValAccountingFigures(someAE_TT))
            //console.log('TT '+someAE_TT)
            }
            else
            {
            someAE_TT=parseNumberWithoutCommas(oldTT) - parseNumberWithoutCommas(old)
            //console.log('TT befor addin'+someAE_TT);
            someAE_TT+=parseNumberWithoutCommas($(this).val())
            $('#AE_act').val(ValAccountingFigures(someAE_TT))
            //console.log('old TT '+someAE_TT)
            }
            
    })

    $('#T2_AE_init_AC').on('focusin',function(){
        oldTT=$('#AE_act').val();
        old=$(this).val();
        //console.log('old value'+oldTT);
    })

    $('#T2_AE_init_AC').on('focusout',function(){
        //console.log('old before if'+oldTT);
        if(old == 0 || old == '' || old == '0' || old == null || old =='NaN')
            {
                old='0'
            }
        if(oldTT == 0 || oldTT == '' || oldTT == '0' || oldTT == null || oldTT =='NaN')
            {
                someAE_TT=0;
            someAE_TT+=parseNumberWithoutCommas($(this).val())
            $('#AE_act').val(ValAccountingFigures(someAE_TT))
            //console.log('TT '+someAE_TT)
            }
            else
            {
                someAE_TT=parseNumberWithoutCommas(oldTT) - parseNumberWithoutCommas(old)
            //console.log('TT befor addin'+someAE_TT);
            someAE_TT+=parseNumberWithoutCommas($(this).val())
            $('#AE_act').val(ValAccountingFigures(someAE_TT))
            //console.log('old TT '+someAE_TT)
            }
    })

    $('#T3_AE_init_AC').on('focusin',function(){
        oldTT=$('#AE_act').val();
        old=$(this).val();
        //console.log('old value'+oldTT);
    })

    $('#T3_AE_init_AC').on('focusout',function(){
        //console.log('old before if'+oldTT);
        if(old == 0 || old == '' || old == '0' || old == null || old =='NaN')
            {
                old='0'
            }
        if(oldTT == 0 || oldTT == '' || oldTT == '0' || oldTT == null || oldTT =='NaN')
            {
                someAE_TT=0;
            someAE_TT+=parseNumberWithoutCommas($(this).val())
            $('#AE_act').val(ValAccountingFigures(someAE_TT))
            //console.log('TT '+someAE_TT)
            }
            else
            {
            someAE_TT=parseNumberWithoutCommas(oldTT) - parseNumberWithoutCommas(old)
            //console.log('TT befor addin'+someAE_TT);
            someAE_TT+=parseNumberWithoutCommas($(this).val())
            $('#AE_act').val(ValAccountingFigures(someAE_TT))
            //console.log('old TT '+someAE_TT)
            }
    })

    $('#T4_AE_init_AC').on('focusin',function(){
        oldTT=$('#AE_act').val();
        old=$(this).val();
        //console.log('old value'+oldTT);
    })

    $('#T4_AE_init_AC').on('focusout',function(){
        //console.log('old before if'+oldTT);
        if(old == 0 || old == '' || old == '0' || old == null || old =='NaN')
            {
                old='0'
            }
        if(oldTT == 0 || oldTT == '' || oldTT == '0' || oldTT == null || oldTT =='NaN')
            {
            someAE_TT=0
            someAE_TT+=parseNumberWithoutCommas($(this).val())
            $('#AE_sous_prog').val(ValAccountingFigures(someAE_TT))
            //console.log('null TT '+someAE_TT)
            }
            else
            {
            //console.log('TT refresh new Value some '+someAE_TT+' old'+oldTT);
            someAE_TT=parseNumberWithoutCommas(oldTT) - parseNumberWithoutCommas(old)
            
            someAE_TT+=parseNumberWithoutCommas($(this).val())
            $('#AE_act').val(ValAccountingFigures(someAE_TT))
            //console.log('old TT '+someAE_TT)
            }
    })
    /**  ------------------------------------------------------ rnf ---------------- */
    /**------------------------------------ Some CP T ----------------------------- */

    $('#T1_CP_init_AC').on('focusin',function(){
        oldTTCP=$('#CP_act').val();
        oldCP=$(this).val();
        //console.log('old value'+oldTTCP);
    })


    $('#T1_CP_init_AC').on('focusout',function(){


        //console.log('old before if'+oldTTCP);
        if(oldCP == 0 || oldCP == '' || oldCP == '0' || oldCP == null || oldCP =='NaN')
        {
            oldCP='0'
        }
        if(oldTTCP == 0 || oldTTCP == '' || oldTTCP == '0' || oldTTCP == null || oldTTCP =='NaN' )
            {
                someCP_TT=0;
            someCP_TT+=parseNumberWithoutCommas($(this).val())
            $('#CP_act').val(ValAccountingFigures(someCP_TT))
            //console.log('TT '+someCP_TT)
            }
            else
            {
            someCP_TT=parseNumberWithoutCommas(oldTTCP) - parseNumberWithoutCommas(oldCP)
            //console.log('TT befor addin'+someCP_TT);
            someCP_TT+=parseNumberWithoutCommas($(this).val())
            $('#CP_act').val(ValAccountingFigures(someCP_TT))
            //console.log('old TT '+someCP_TT)
            }

    })

    $('#T2_CP_init_AC').on('focusin',function(){
        oldTTCP=$('#CP_act').val();
        oldCP=$(this).val();
        //console.log('old value'+oldTT);
    })


    $('#T2_CP_init_AC').on('focusout',function(){

        //console.log('old before if'+oldTTCP);
        if(oldCP == 0 || oldCP == '' || oldCP == '0' || oldCP == null || oldCP =='NaN')
        {
            oldCP='0'
        }
        if(oldTTCP == 0 || oldTTCP == '' || oldTTCP == '0' || oldTTCP == null || oldTTCP =='NaN' )
            {
                someCP_TT=0;
            someCP_TT+=parseNumberWithoutCommas($(this).val())
            $('#CP_act').val(ValAccountingFigures(someCP_TT))
            //console.log('TT '+someCP_TT)
            }
            else
            {
            someCP_TT=parseNumberWithoutCommas(oldTTCP) - parseNumberWithoutCommas(oldCP)
            //console.log('TT befor addin'+someCP_TT);
            someCP_TT+=parseNumberWithoutCommas($(this).val())
            $('#CP_act').val(ValAccountingFigures(someCP_TT))
            //console.log('old TT '+someCP_TT)
            }
        
    })

    $('#T3_CP_init_AC').on('focusin',function(){
        oldTTCP=$('#CP_act').val();
        oldCP=$(this).val();
        //console.log('old value'+oldTTCP);
    })

    $('#T3_CP_init_AC').on('focusout',function(){

        //console.log('old before if'+oldTTCP);
        if(oldCP == 0 || oldCP == '' || oldCP == '0' || oldCP == null || oldCP =='NaN')
        {
            oldCP='0'
        }
        if(oldTTCP == 0 || oldTTCP == '' || oldTTCP == '0' || oldTTCP == null || oldTTCP =='NaN' )
            {
                someCP_TT=0;
            someCP_TT+=parseNumberWithoutCommas($(this).val())
            $('#CP_act').val(ValAccountingFigures(someCP_TT))
            //console.log('TT '+someCP_TT)
            }
            else
            {
            someCP_TT=parseNumberWithoutCommas(oldTTCP) - parseNumberWithoutCommas(oldCP)
            //console.log('TT befor addin'+someCP_TT);
            someCP_TT+=parseNumberWithoutCommas($(this).val())
            $('#CP_act').val(ValAccountingFigures(someCP_TT))
            //console.log('old TT '+someCP_TT)
            }
        
    })

    $('#T4_CP_init_AC').on('focusin',function(){
        oldTTCP=$('#CP_act').val();
        oldCP=$(this).val();
        //console.log('old value'+oldTTCP);
    })

    $('#T4_CP_init').on('focusout',function(){

        //console.log('old before if'+oldTT);
        if(oldCP == 0 || oldCP == '' || oldCP == '0' || oldCP == null || oldCP =='NaN')
        {
            oldCP='0'
        }
        if(oldTTCP == 0 || oldTTCP == '' || oldTTCP == '0' || oldTTCP == null || oldTTCP =='NaN' )
            {
            someCP_TT=0;
            someCP_TT+=parseNumberWithoutCommas($(this).val())
            $('#CP_act').val(ValAccountingFigures(someCP_TT))
            //console.log('TT '+someCP_TT)
            }
            else
            {
            someCP_TT=parseNumberWithoutCommas(oldTTCP) - parseNumberWithoutCommas(oldCP)
            //console.log('TT befor addin'+someCP_TT);
            someCP_TT+=parseNumberWithoutCommas($(this).val())
            $('#CP_act').val(ValAccountingFigures(someCP_TT))
            //console.log('old TT '+someCP_TT)
            }
        
    })
}

function parseNumberWithoutCommas(input) {
    // Remove commas from the input string
    let cleanedInput = input.replace(/,/g, '');
    // Parse the cleaned string into a float
    return parseFloat(cleanedInput);
}

function formatAccountingFigures(input) {
    // Remove non-numeric characters except for "."
    let value = input.value.replace(/[^0-9.]/g, '');

    // Split the input into integer and decimal parts
    let parts = value.split('.');
    let integerPart = parts[0];
    let decimalPart = parts[1] ? '.' + parts[1] : '';

    // Add commas to the integer part
    integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

    // Combine integer and decimal parts
    input.value = integerPart + decimalPart;
}
function ValAccountingFigures(inputs) {
    if (isNaN(inputs)) {
        return ''; // Return an empty string for invalid numbers
    }

    // Convert number to a fixed decimal string (optional)
    let formattedNumber = inputs.toFixed(2); // Keeps two decimal places

    // Split the number into integer and decimal parts
    let [integerPart, decimalPart] = formattedNumber.split('.');

    // Add commas to the integer part
    integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

    // Combine integer and decimal parts
    return integerPart + '.' + decimalPart;
}
function only_def(id)
{
   var localverb;
   $.ajax({
       url:'/opsinfo/'+id,
       type:'GET',
       success:function(response)
       {
           if(response.code == 200)
           {
               defss=response.result.nom_sous_operation 
               //console.log('def '+defss)
               newdfs=defss.split('_')
               if(newdfs.length > 2){
               $('#ref'+id+" #def").text(newdfs[0])
               $('#ref'+id+" #def").text(newdfs[1])
               $('#ref'+id+" #sous_def").text(newdfs[2])}
               else
               {
                $('#ref'+id+" #def").text(newdfs[0])
                $('#ref'+id+" #sous_def").text(newdfs[1])
               }
               
           }
       }
   })
   return localverb
}



/**
 *
 * upload file function
 *
 */
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
function focus_() {
    $('input').focus(function () {
        $(this).removeAttr('style');
    });
}
function check_ifnull(button) {
    var indice = 0;
    var isEmpty = false
    var formId = $(button).parents('.form-container').attr('id');
    //console.log('and form id' + formId);
    $('#' + formId + ' form').find('input').each(function () {
        //console.log('before the loop')
        var inputValue = $(this).val();

        // Check if the input is not empty
        if (inputValue.trim() === "") {
            isEmpty = true;
            indice++;
        }


        if (isEmpty) {
            if (indice < 2) {
                //alert("Veuillez remplir tous les champs obligatoires");
            }
            $(this).css('box-shadow', '0 0 0 0.25rem rgb(255 0 0 / 47%)')
        }
    });
}

function splitcode(str, length) {
    let result = [];
    for (let i = 0; i < str.length; i += length) {
        let chunk = str.substring(i, i + length);
        result.push({ substring: chunk, length: chunk.length });
    }
    var testing =str.split("-");
    var last=testing.length-1
  
    return testing[last];
}


function add_newOPs_T1(id, descr, value, key,) {
    var row = '<tr id="ref' + id + '">' +
        '<td class="code" >' + id + '</td>' +
        '<td id="add_op" style="display: flex;align-items: center;justify-content: space-between;"><p>' + descr + '</p></td>' +
        '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_T1">' + value + '</td>' +
        '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_T1">' + 180 + '</td>' +
        '</tr>';

    $('#' + key).after(row);
    $('#' + key + ' td').each(function () {
        $(this).removeClass('editable');
    })
}
function add_newOPs_T2(id, descr, value, key) {
   var champ='<div><label>AE Overture</label>'+
   '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="add_AE_Over">'+
   '<label>AE Attendu</label>'+
   '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="add_AE_att">'+
   '<label>AE Total</label>'+
   '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="some_AE" disabled>'+
   '</div>'+
   '<div>'+
   '<label>CP Overture</label>'+
   '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="add_CP_Over">'+
   '<label>CP Attendu</label>'+
   '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="add_CP_att">'+
   '<label>CP Toral</label>'+
   '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="some_CP" disabled>'+
   '</div>';
   $('#Tport-vals').append(champ);
   var someae=0;
   var somecp=0;
   $('#add_AE_Over').on('change',function(){

       someae+=parseInt($(this).val())
       $('#some_AE').val(someae);
   })
   $('#add_AE_att').on('change',function(){
       someae+=parseInt($(this).val())
       $('#some_AE').val(someae);
   })
   $('#add_CP_att').on('change',function(){

       somecp+=parseInt($(this).val())
       $('#some_CP').val(somecp)
   })
   $('#add_CP_Over').on('change',function(){
       if($(this).val() !=0 && somecp != 0)
           {
               somecp-=$(this).val()
           }
       somecp+=parseInt($(this).val())
       $('#some_CP').val(somecp)
   })
    $('#ajt').click(function(){
       var sopdata_add={
           code:id,
           descrp:descr,
           AE_Over:$('#add_AE_Over').val(),
           CP_Over:$('#add_CP_Over').val(),
           AE_att:$('#add_AE_att').val(),
           CP_att:$('#add_CP_att').val(),
           _token: $('meta[name="csrf-token"]').attr("content"),
           _method: "POST",
       }
       $.ajax({
           url:'',
           type:'POST',
           data:sopdata_add,
           success:function(response)
           {
               var row = '<tr class="ref'+id+'" id="ref' + id + '">' +
               '<td class="code">' + id + '</td>' +
               '<td id="add_op" style="display: flex;align-items: center; justify-content: space-between;"> <p>' + descr + '</p> </td>' +
               '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_Over">' + value + '</td>' +
               '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_Over">' + 180 + '</td>' +
               '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_att">' + value + '</td>' +
               '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_att">' + 180 + '</td>' +
               '<td  id="AE_TT" diseabled>' + some + '</td>' +
               '<td  id="CP_TT" diseabled>' + 360 + '</td>' +
               '</tr>';
           $('#' + key).after(row);
           $('#' + key + ' td').each(function () {
               $(this).removeClass('editable');
           })
           }
       })



})
$('#cancel_ops').click(function(){

   $('.Tsop_handler').addClass('Tsop_handler_h')
   $('#Tport-vals').empty()
   alert('cancel op')
})
}
function add_newOPs_T3(id, value, key,code) {
    $('.change_app').empty()
    var T=3
    var tid='T3'
   $("#dispo").text('');
   $('.desp').text('INTITULE DE L\'OPERATION');
   var champ='<div class="Tsop_add_handle">'+
   '<form id="add_sops">'+
   '<div class="form-group">'+
   '<label class="desp"> N° DE DECISION D\'INSCRIPTION</label>'+
    '<input type="text" class="form-control" id="dispo" placeholder="Veuillez Entrer  N° DE DECISION  d\'INSCRIPTION">'+
    '<label class="desp">INTITULE DE L\'OPERATION D\'INVESTISSEMENT PUBLIC (PROJET)</label>'+
    '<input type="text" class="form-control" id="int-T3" placeholder="Veuillez Entrer INTITULE DE L\'OPERATION ">'+
    '</div>'+
    '<div class="T3-ops_inpt_handle">' +
    '<div><label>AE REPORTEE</label>'+
             '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="add_AE_rpor">'+
             '<label>AE NOTIFIEE</label>'+
             '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="add_AE_not">'+
             '<label>AE ENGAGEE</label>'+
             '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="add_AE_enga">'+
             '</div>'+
             '<div>'+
             '<label>CP CP REPORTES</label>'+
             '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="add_CP_rpor">'+
             '<label>CP NOTIFIES</label>'+
             '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="add_CP_not">'+
             '<label>CP CONSOMMES</label>'+
             '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="add_CP_consom">'+
             '</div>'+
   '</div>'+
'</form>'+
'<div class="Tsop_btn_handle">'+
'<div><button  class="btn btn-primary" id="ajt"> Ajouter </button></div>'+
'<div><button  class="btn btn-primary" id="cancel_ops"> Cancel </button></div>'+
'</div>'+
'</div>';
  
   $('.Tsop_handler').append(champ);
   $('#ajt').on('click',function(){
    if(replac == false)
    {
    idsz=id+'-'+counter;}
    else
    {
    id=idsz;
    idsz=id+counter
    }
    counter++;
    var buttons = '<button class="btn btn-primary" id="changin"> appliquer</button>'
    $('.change_app').append(buttons)
       var sopdata_add={
           code:idsz,
           intituel:$('#int-T3').val(),
           descrp:$('#dispo').val(),
           AE_rpor:$('#add_AE_rpor').val(),
           AE_not:$('#add_AE_not').val(),
           AE_enga:$('#add_AE_enga').val(),
           CP_rpor:$('#add_CP_rpor').val(),
           CP_not:$('#add_CP_not').val(),
           CP_consom:$('#add_CP_consom').val(),
           _token: $('meta[name="csrf-token"]').attr("content"),
           _method: "POST",

       }
       dataupdate.push({code:idsz,value:{ae_notifie:sopdata_add.AE_not,ae_reporte:sopdata_add.AE_rpor,ae_engage:sopdata_add.AE_enga,
        cp_notifie:sopdata_add.CP_not,cp_reporte:sopdata_add.CP_rpor,cp_consome:sopdata_add.CP_consom,desc:sopdata_add.descrp,intitule:sopdata_add.intituel}})
       //console.log('data T3'+JSON.stringify(sopdata_add))
       /*$.ajax({
           url:'',
           type:'POST',
           data:sopdata_add,
           success:function(response)
           {
               if(response.code == 200)
               {
                   
               }
           }
       })*/
            
            var idsfinal=id.split("-")
            ////console.log('split -'+idsfinal)
            var lng=idsfinal.length
           var row = '<tr id="ref' + idsz + '">' +
                   '<td class="code">'+idsfinal[idsfinal.length-1]+'</td>' +
                   '<td> - </td>' +
                   '<td>' + sopdata_add.descrp + '</td>' +
                   '<td id="add_op" style="display: flex;align-items: center; justify-content: space-between;"><p>' + sopdata_add.intituel + '</p> <i id="new_ops" class="fas fa-folder-plus" style="font-size: 48px"></i></td>' +
                   '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_rpor">' + sopdata_add.AE_rpor + '</td>' +
                   '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_not">' + sopdata_add.AE_not + '</td>' +
                   '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_enga">' + sopdata_add.AE_enga + '</td>' +
                   '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_rpor">' + sopdata_add.CP_rpor + '</td>' +
                   '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_not">' + sopdata_add.CP_not + '</td>' +
                   '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_consom">' + sopdata_add.CP_consom + '</td>' +
                   '</tr>';
                  
                   if(idsfinal.length == 9 || idsfinal.length == 1)
                    {
                        ////console.log('testing remplace'+idsfinal.length)
                     $('#' + key).replaceWith(row)
                     replac=true
                    }
                    else
                    {
                       // //console.log('testing append'+idsfinal.length)
                        row='<tr id="ref' + idsz + '">' +
                   '<td class="code" >'+id+'</td>' +
                   '<td> - </td>' +
                   '<td>' + sopdata_add.descrp + '</td>' +
                   '<td ><p>' + sopdata_add.intituel + '</p></td>' +
                   '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_rpor">' + sopdata_add.AE_rpor + '</td>' +
                   '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_not">' + sopdata_add.AE_not + '</td>' +
                   '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_enga">' + sopdata_add.AE_enga + '</td>' +
                   '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_rpor">' + sopdata_add.CP_rpor + '</td>' +
                   '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_not">' + sopdata_add.CP_not + '</td>' +
                   '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_consom">' + sopdata_add.CP_consom + '</td>' +
                   '</tr>';
                        $('#' + key).after(row)
                    }
                    $('#ref' + idsz + ' #add_op').on('click', function () {
                        var newKey=$(this).parent().attr('id');
                        var ads = newKey.split('ref')[1]
                        $('.Tsop_handler').removeClass('Tsop_handler_h')
                        add_newOPs_T3(ads, 2500, newKey,code);
                        if(code != 200)
                            {
                        Edit(tid, T)
                        }
                     })

               
             /*  $('#' + key + ' td').each(function () {
                   $(this).removeClass('editable');
               })*/
                   $('#Tport-vals').removeClass('T4')
                   $("#dispo").val('');
                  $('.Tsop_handler').empty();
                  $('#add_sops').trigger('reset');
                  $('.Tsop_handler').addClass('Tsop_handler_h')
                  mount_chang = true

                  if (mount_chang == true) {
                      
                      click++;
                      if (click == 1) {
                         
                          click++
                      }
                   
                    }
                    if(code == 200)
                    {
                       
                        appliquer_up(T)
                    }
                    else {
                      
                        $('#changin').on('click',function(){
                        insert_edit(tid, T)
                        })
                        
                    }
   })
   $('#cancel_ops').click(function(){
       $('.change_app').empty()
       $('.Tsop_handler').addClass('Tsop_handler_h')
       $('#Tport-vals').empty()
       $('.Tsop_handler').empty();
       alert('cancel op')
   })
}

function add_newOPs_T4(id, value, key,code) {
   $('.change_app').empty()
   $("#dispo").val('');
   $('.desp').text('Dispositive');
   $('#Tport-vals').addClass('T4')

   var champ='<div class="Tsop_add_handle">'+
               '<form id="add_sops">'+
               '<div class="form-group">'+
               '<label class="desp">Dispositif d\'intervention </label>'+
            '<input type="text" class="form-control" id="dispo" placeholder="Veuillez Entrer le Dispositif d\'intervention">'+
           '</div>'+

           '<div class="form-group" id="Tport-vals">'+
             '<div><label>AE</label>'+
            '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="add_AE_T4">'+
            '</div>'+
            '<div>'+
            '<label>CP </label>'+
           '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="add_CP_T4">'+
           '</div>'+
           '</div>'+

           '</form>'+
       '<div class="Tsop_btn_handle">'+
        '<div><button  class="btn btn-primary" id="ajt"> Ajouter </button></div>'+
        '<div><button  class="btn btn-primary" id="cancel_ops"> Cancel </button></div>'+
       '</div>'+
   '</div>'
   ;
   $('.Tsop_handler').append(champ);
 
   $('#ajt').click(function(){
    
    mount_chang=true;


    idsz=id+'-'+counter;
    var buttons = '<button class="btn btn-primary" id="changin"> appliquer</button>'
    $('.change_app').append(buttons)
       var data_add_ops={
           code:idsz,
           descrp:$('#dispo').val(),
          // defi:$('#def_T4').val(),
           AE_T4:$('#add_AE_T4').val(),
           CP_T4:$('#add_CP_T4').val(),
           _token: $('meta[name="csrf-token"]').attr("content"),
           _method: "POST",
       }
       var idsfinal=id.split("-")
       var row = '<tr id="ref' + idsz + '">' +
       '<td class="code" >' +idsz + '</td>' +
       '<td>'+value+'</td>'+
       '<td id="add_op" style="display: flex;align-items: center; justify-content: space-between;"><p>' + data_add_ops.descrp + '</p> <i id="new_ops" class="fas fa-folder-plus" style="font-size: 48px"></i></td>' +
       '<td id="AE_T4" class="init_AE_T4">' + data_add_ops.AE_T4 + '</td>' +
       '<td id="CP_T4" class="init_CP_T4">' + data_add_ops.CP_T4 + '</td>' +
       '</tr>';

       if(idsfinal.length == 9 || idsfinal.length == 1)
        {
             //console.log('testing remplace'+idsfinal.length)
         $('#' + key).after(row)
      
        }
        else
        {
             //console.log('testing remplace'+idsfinal.length)
            row='<tr id="ref' + idsz + '">' +
       '<td class="code" style="visibility: hidden;">' +idsz + '</td>' +
       '<td>-</td>'+
       '<td id="add_op" style="display: flex;align-items: center; justify-content: space-between;"><p>' + data_add_ops.descrp + '</p></td>' +
       '<td id="AE_T4">' + data_add_ops.AE_T4 + '</td>' +
       '<td  id="CP_T4">' + data_add_ops.CP_T4 + '</td>' +
       '</tr>';
            $('#' + key).after(row)
        }

       /* var cpold=parseNumberWithoutCommas($('#'+key+' td:last').text());
        var aeold=parseNumberWithoutCommas($('#'+key+' td').eq(-2).text());
        
        var newcp=parseInt(cpold)+parseInt(parseNumberWithoutCommas(data_add_ops.CP_T4))
        var newae=parseInt(aeold)+parseInt(parseNumberWithoutCommas(data_add_ops.AE_T4)) 
        //console.log('ae'+newae+'cp'+newcp)
        $('#'+key+' td:last').text(ValAccountingFigures(newcp))
        $('#'+key+' td').eq(-2).text(ValAccountingFigures(newae))*/

        $('#ref' + idsz + ' #add_op').on('click', function () {
            var newKey=$(this).parent().attr('id');
            var ads = newKey.split('ref')[1]
            $('.Tsop_handler').removeClass('Tsop_handler_h')
             add_newOPs_T4(ads, 2500, key,code);
            if(code != 200)
            {
                T=4;
                Edit(id, T)
            }
         })
       counter++
   dataupdate.push({code:idsz,value:{ae:data_add_ops.AE_T4,cp:data_add_ops.CP_T4,dispo:data_add_ops.descrp}})
  /* $('#' + key + ' td').each(function () {
       $(this).removeClass('editable');
   })*/
       //console.log('data T4'+JSON.stringify(data_add_ops))
        $('#Tport-vals').removeClass('T4')
        $("#dispo").val('');
       $('.Tsop_handler').empty();
       $('#add_sops').trigger('reset');
       $('.Tsop_handler').addClass('Tsop_handler_h')
       if(code == 200)
        {
            T=4;
            appliquer_up(T)
        }   
        else {
            T=4;
            $('#changin').on('click',function(){
                insert_edit(tid, T)
                })
        }
   })
   $('#cancel_ops').click(function(){
       $('.Tsop_handler').empty();
       $('.Tsop_handler').addClass('Tsop_handler_h')
    
       alert('cancel op')
   })

}
/**
 *
 * the end
 *
 */

/**
 *
 * star of update function
 *
 */
function Update_dpia(T,iupdate)
{
   var old;
   $(document).ready(function(){
       $('.editable').on('click', function () {
           let cell = $(this);  // Reference to the clicked cell
           old = cell.text();
       })
       $('.editable').dblclick(function(){

           var ae=0;
           var cp=0;
           var ae_ouvert =0
           var cp_ouvert =0
           var ae_attendu =0
           var cp_attendu =0
           var ae_reporte =0
           var ae_notifie =0
           var ae_engage =0
           var cp_reporte =0
           var cp_notifie =0
           var cp_consome =0
           var clickid = $(this).attr('id');
           //console.log('testing the id'+clickid);
            var clickedRow = $(this).closest('tr');
            var code = clickedRow.find('td:first-child');
            let cell = $(this);  // Reference to the clicked cell
            var currentText = cell.text();

            var exist=false;  // Get current text
            //console.log('odl ' + code.text() +'old '+old)
            var codesoup=clickedRow.attr('id').split('ref')[1];
            //console.log('sis -'+JSON.stringify(codesoup))
            // Create an input element and set its value
            let input = $('<input type="text" oninput="formatAccountingFigures(this)" step="0.01" class="form-control" min="0"/>').val(currentText);
            cell.html(input);  // Replace the cell content with the input

            input.focus();
            input.blur(function()
           {
               let newText = $(this).val();
               //console.log('zero'+newText)
               if (T == '2') {
                   var sommevertAEatt=parseNumberWithoutCommas($('#foot_AE_att').text());
                   var sommevertCPatt=parseNumberWithoutCommas($('#foot_CP_att').text());
                   var sommevertAEovr=parseNumberWithoutCommas($('#foot_AE_Over').text());
                   var sommevertCPovr=parseNumberWithoutCommas($('#foot_CP_Over').text());
                   var sommevertAETT=parseNumberWithoutCommas($('#foot_AE_TT').text());
                   var sommevertCPTT=parseNumberWithoutCommas($('#foot_CP_TT').text());
                   //console.log('footer info'+sommevertAEatt+'--'+sommevertCPatt+'--'+sommevertAEovr+'--'+sommevertCPovr)
                   var testcpattendu = parseNumberWithoutCommas(clickedRow.find('td').eq(5).text());//cpattendu
                   var testaeattendu = parseNumberWithoutCommas(clickedRow.find('td').eq(4).text());//aeattendu
                   var testcpover = parseNumberWithoutCommas(clickedRow.find('td').eq(3).text());//cpovert
                   var testaeover = parseNumberWithoutCommas(clickedRow.find('td').eq(2).text());//aeovert
                   var someae = 0;
                   var somecp = 0;
                   var wit = $(this).parent().attr('id');
                   if (newText != 0 && newText != '' && newText != null ) {
                     someae = clickedRow.find('td').eq(6).text();
                     somecp = clickedRow.find('td').eq(7).text();
                       //console.log('ae -> ' + testaeover + 'cp ->' + testcpover + ' ae ett -> ' + testaeattendu + ' cp ett ->' + testcpattendu + 'value change ->' + JSON.stringify(wit))
                       if (wit == 'CP_att') {
                           testcpattendu = newText
                           sommevertCPatt=parseFloat(sommevertCPatt)-parseFloat(old)
                           sommevertCPTT=parseFloat(sommevertCPTT)-parseFloat(old)
                           sommevertCPatt=parseFloat(sommevertCPatt)+parseFloat(newText)
                           sommevertCPTT=parseFloat(sommevertCPTT)+parseFloat(newText)
                           somecp-=parseFloat(old)
                           //console.log('new AE_Over'+sommevertCPatt)
                       }
                       if (wit == 'AE_att') {
                           testaeattendu = newText
                          
                              
                               sommevertAEatt=parseFloat(sommevertAEatt)-parseFloat(old)
                               sommevertAETT =parseFloat(sommevertAETT)-parseFloat(old)
                               sommevertAEatt=parseFloat(sommevertAEatt)+parseFloat(newText)
                               sommevertAETT=parseFloat(sommevertAETT)+parseFloat(newText)
                               someae-=parseFloat(old)
                          
                           //console.log('new AE_Over'+sommevertAEatt)
                       }
                       if (wit == 'AE_Over') {
                           testaeover = newText
                           sommevertAEovr=parseFloat(sommevertAEovr)-parseFloat(old)
                           sommevertAETT =parseFloat(sommevertAETT)-parseFloat(old)
                           sommevertAEovr=parseFloat(sommevertAEovr)+parseFloat(newText)
                           sommevertAETT=parseFloat(sommevertAETT)+parseFloat(newText)
                           someae-=parseFloat(old)
                           //console.log('new AE_Over'+sommevertAEovr)
                       }
                       if (wit == 'CP_Over') {
                           testcpover = newText
                           sommevertCPovr=parseFloat(sommevertCPovr)-parseFloat(old)
                           sommevertCPTT=parseFloat(sommevertCPTT)-parseFloat(old)
                           somecp-=parseFloat(old)
                           sommevertCPovr=parseFloat(sommevertCPovr)+parseFloat(newText)
                           sommevertCPTT=parseFloat(sommevertCPTT)+parseFloat(newText)
                           //console.log('new CP_Over'+sommevertCPovr)
                       }
                       somecp = parseFloat(testcpattendu) + parseFloat(testcpover)
                       someae = parseFloat(testaeattendu) + parseFloat(testaeover);
                       //console.log('ae' + someae + ' cp ' + somecp)
                    $('#foot_AE_att').text(ValAccountingFigures(sommevertAEatt));
                    $('#foot_CP_att').text(sommevertCPatt);
                    $('#foot_AE_Over').text(sommevertAEovr);
                    $('#foot_CP_Over').text(sommevertCPovr);
                    $('#foot_AE_TT').text(sommevertAETT);
                    $('#foot_CP_TT').text(sommevertCPTT);

                    //console.log('footer info'+sommevertAEatt+'--'+sommevertCPatt+'--'+sommevertAEovr+'--'+sommevertCPovr)
                       clickedRow.find('td').eq(6).text(someae);
                       clickedRow.find('td').eq(7).text(somecp);
                   } else
                   {
                    someae = clickedRow.find('td').eq(6).text();
                    somecp = clickedRow.find('td').eq(7).text();
                       //console.log('deminuis'+old+'of '+wit)
                       if (wit == 'CP_att') {
                           testcpattendu = newText
                           sommevertCPatt=parseFloat(sommevertCPatt)-parseFloat(old)
                           sommevertCPTT=parseFloat(sommevertCPTT)-parseFloat(old)
                           somecp-=parseInt(old)
                          
                       }
                       if (wit == 'AE_att') {
                            testaeattendu = newText
                           someae-=parseInt(old)
                           sommevertAEatt=parseFloat(sommevertAEatt)-parseFloat(old)
                           sommevertAETT =parseFloat(sommevertAETT)-parseFloat(old)
                   
                       }
                       if (wit == 'AE_Over') {
                             testaeover = newText
                           someae-=parseInt(old)
                           sommevertAEovr=parseFloat(sommevertAEovr)-parseFloat(old)
                           sommevertCPTT=parseFloat(sommevertCPTT)-parseFloat(old)
                          
                       }
                       if (wit == 'CP_Over') {
                           testcpover = newText
                           somecp-=parseInt(old)
                           sommevertCPovr=parseFloat(sommevertCPovr)-parseFloat(old)
                           sommevertAETT =parseFloat(sommevertAETT)-parseFloat(old)
                           
                    
                       }
                       
                   
                        $('#foot_AE_att').text(sommevertAEatt);
                        $('#foot_CP_att').text(sommevertCPatt);
                        $('#foot_AE_Over').text(sommevertAEovr);
                        $('#foot_CP_Over').text(sommevertCPovr);
                        $('#foot_AE_TT').text(sommevertAETT);
                        $('#foot_CP_TT').text(sommevertCPTT);
                       
                        somecp = parseFloat(testcpattendu) + parseFloat(testcpover)
                        someae = parseFloat(testaeattendu) + parseFloat(testaeover);
                       clickedRow.find('td').eq(6).text(someae);
                       clickedRow.find('td').eq(7).text(somecp);
                   }
               }
               else
               {
                if( T == '3')
                {
                    var sommevertAErepor=parseNumberWithoutCommas($('#foot_AE_rpor').text());
                    var sommevertAEnot=parseNumberWithoutCommas($('#foot_AE_not').text());
                    var sommevertAEenga=parseNumberWithoutCommas($('#foot_AE_enga').text());
                    var sommevertCPrpor=parseNumberWithoutCommas($('#foot_CP_rpor').text());
                    var sommevertCPnot=parseNumberWithoutCommas($('#foot_CP_not').text());
                    var sommevertCPconsum=parseNumberWithoutCommas($('#foot_CP_consom').text());
                  
                   
                    var wit = $(this).parent().attr('id');
                    if (newText != 0 && newText != '' && newText != null ) {
                       // //console.log('ae -> ' + testaeover + 'cp ->' + testcpover + ' ae ett -> ' + testaeattendu + ' cp ett ->' + testcpattendu + 'value change ->' + JSON.stringify(wit))
                        if (wit == 'AE_rpor') {
                            
                            sommevertAErepor=parseFloat(sommevertAErepor)-parseFloat(old)
                            sommevertAErepor=parseFloat(sommevertAErepor)+parseFloat(newText)
    
                        }
                        if (wit == 'AE_not') {
                               
                            sommevertAEnot=parseFloat(sommevertAEnot)-parseFloat(old)
                            sommevertAEnot=parseFloat(sommevertAEnot)+parseFloat(newText)
                        }
                        if(wit == 'AE_enga')
                        { 
                            sommevertAEenga=parseFloat(sommevertAEenga)-parseFloat(old)
                            sommevertAEenga=parseFloat(sommevertAEenga)+parseFloat(newText)

                        }
                        if (wit == 'CP_rpor') {
                            sommevertCPrpor=parseFloat(sommevertCPrpor)-parseFloat(old)
                            sommevertCPrpor=parseFloat(sommevertCPrpor)+parseFloat(newText)
                        }
                        if (wit == 'CP_not') {
                            sommevertCPnot=parseFloat(sommevertCPnot)-parseFloat(old)
                            sommevertCPnot=parseFloat(sommevertCPnot)+parseFloat(newText)
                        }
                        if (wit == 'CP_consom') {
                            sommevertCPconsum=parseFloat(sommevertCPconsum)-parseFloat(old)
                            sommevertCPconsum=parseFloat(sommevertCPconsum)+parseFloat(newText)
                        }
    

                        $('#foot_AE_rpor').text(sommevertAErepor);
                        $('#foot_AE_not').text(sommevertAEnot);
                        $('#foot_AE_enga').text(sommevertAEenga);
                        $('#foot_CP_rpor').text(sommevertCPrpor);
                        $('#foot_CP_not').text(sommevertCPnot);
                        $('#foot_CP_consom').text(sommevertCPconsum);
 
               
                    } else
                    {
                  
                        if (wit == 'AE_rpor') {
                            
                            sommevertAErepor=parseFloat(sommevertAErepor)-parseFloat(old)
                          
    
                        }
                        if (wit == 'AE_not') {
                               
                            sommevertAEnot=parseFloat(sommevertAEnot)-parseFloat(old)
                            
                        }
                        if(wit == 'AE_enga')
                        { 
                            sommevertAEenga=parseFloat(sommevertAEenga)-parseFloat(old)
                           

                        }
                        if (wit == 'CP_rpor') {
                            sommevertCPrpor=parseFloat(sommevertCPrpor)-parseFloat(old)
                           
                        }
                        if (wit == 'CP_not') {
                            sommevertCPnot=parseFloat(sommevertCPnot)-parseFloat(old)
                          
                        }
                        if (wit == 'CP_consom') {
                            sommevertCPconsum=parseFloat(sommevertCPconsum)-parseFloat(old)
                           
                        }
                        
                    
                        $('#foot_AE_rpor').text(sommevertAErepor);
                        $('#foot_AE_not').text(sommevertAEnot);
                        $('#foot_AE_enga').text(sommevertAEenga);
                        $('#foot_CP_rpor').text(sommevertCPrpor);
                        $('#foot_CP_not').text(sommevertCPnot);
                        $('#foot_CP_consom').text(sommevertCPconsum);
                    
                    }
                }

               }
              
               if(dataupdate.length > 0)
               {
                  for (let index = 0; index < dataupdate.length; index++) {
                   const element = dataupdate[index];
                    if(element.code === codesoup)
                    {
                       //console.log('code exisit'+JSON.stringify(element))
                      if( clickid == 'AE_T1' || clickid == 'AE_T4')
                      {
                       element.value.ae=newText;
                      }
                      if(clickid == 'CP_T1' || clickid == 'CP_T4')
                      {
                       element.value.cp=newText;
                      }
                      if(clickid == 'AE_Over')
                      {
                       element.value.ae_ouvert=newText
                      }
                      if(clickid == 'AE_att')
                       {
                           element.value.ae_attendu=newText
                       }
                       if(clickid == 'CP_Over')
                       {
                           element.value.cp_ouvert=newText
                       }
                       if(clickid == 'CP_att')
                       {
                           element.value.cp_attendu=newText
                       }
                       if(clickid == 'AE_rpor')
                       {
                           element.value.ae_reporte=newText
                        
                       }
                       if(clickid == 'AE_not')
                       {
                           element.value.ae_notifie=newText
                       }
                       if(clickid == 'AE_enga')
                       {
                           element.value.ae_engage=newText
                       }
                       if(clickid == 'CP_rpor')
                       {
                       element.value.cp_reporte=newText
                       }
                       if(clickid == 'CP_not')
                       {
                       element.value.cp_notifie=newText
                       }
                       if(clickid == 'CP_consom')
                       {
                       element.value.cp_consome=newText
                       }
                       exist=true;
                    }
                  }
               }

               if (newText != 0 && newText != '' && newText != null && newText != '0') {
 $('.change_app').empty()
 var buttons = '<button class="btn btn-primary" id="changin"> appliquer</button>'
                   mount_chang = true

                   if (mount_chang == true) {
                       
                       click++;
                       if (click == 1) {
                          
                           click++
                       }
                       $('.change_app').append(buttons)


                   //  //console.log('all table'+JSON.stringify(value_chng))
                   cell.text(newText);
                   if(!exist){
                       if(clickid == 'AE_T1' || clickid == 'AE_T4')
                       {
                           ae=newText
                           cp=0
                       }
                       if(clickid == 'CP_T1' || clickid == 'CP_T4')
                       {
                           ae=0
                           cp=newText
                       }
                       if(clickid == 'AE_Over')
                       {
                        ae_ouvert=newText
                       }
                       if(clickid == 'AE_att')
                       {
                        ae_attendu=newText
                       }
                       if(clickid == 'CP_Over')
                       {
                       cp_ouvert=newText
                       }
                       if(clickid == 'CP_att')
                       {
                       cp_attendu=newText
                       }
                       if(clickid == 'AE_rpor')
                           {
                           ae_reporte=newText
                           }
                           if(clickid == 'AE_not')
                           {
                           ae_notifie=newText
                           }
                           if(clickid == 'AE_enga')
                           {
                           ae_engage=newText
                           }
                           if(clickid == 'CP_rpor')
                           {
                           cp_reporte=newText
                           }
                           if(clickid == 'CP_not')
                           {
                           cp_notifie=newText
                           }
                           if(clickid == 'CP_consom')
                           {
                           cp_consome=newText
                           }

                       if( T == '1')
                       {
                           dataupdate.push({code:codesoup,value:{ae:ae,cp:cp}});
                       }
                       if(T == '2')
                       {
                       dataupdate.push({code:codesoup,value:{ae_ouvert:ae_ouvert,ae_attendu:ae_attendu,cp_ouvert:cp_ouvert,cp_attendu:cp_attendu}});
                       }
                       if(T == '3')
                       {
                        //console.log('i insert  T3'+JSON.stringify(dataupdate))
                           dataupdate.push({code:codesoup,value:{ae_notifie:ae_notifie,ae_reporte:ae_reporte,ae_engage:ae_engage,
                                                                 cp_notifie:cp_notifie,cp_reporte:cp_reporte,cp_consome:cp_consome}})
                       }
                       if(T == '4' || T==4)
                       {
                        //console.log('i insert  T4'+JSON.stringify(dataupdate))
                               dataupdate.push({code:codesoup,value:{ae:ae,cp:cp}})
                       }

                   
                   }

               }
               }
               else {
                   cell.empty();
                   if(old == 0 || old == "0" || old == '' || old === null || newText == 0 )
                       {
                          old='0';
                       }
                   cell.text(old)
               }
           })



       })
       $('.change_app').on('click',function(){
           var idbtn=$(this).children('#changin').attr('id');
           if(idbtn =='changin' )
           {
               //console.log('i insert '+JSON.stringify(dataupdate))
               //console.log('click once'+iupdate);


               //console.log('click after'+iupdate);
      $.ajax({
           url:'/update',
           type:'POST',
           data:{
               Tport:T,
               result:dataupdate,
               _token: $('meta[name="csrf-token"]').attr("content"),
               _method: "POST",},
               success:function(response)
               {
                   if(response.code == 200)
                       {
                   dataupdate.forEach(elemnt=>{
                       //console.log('green add to '+elemnt.code)
                       $('#ref'+elemnt.code).addClass('row-updated');

                       dataupdate=Array();
                   })
                   }
               }


       })

          //console.log('testing'+JSON.stringify(dataupdate))
          $('.change_app').empty()
       click=0;

           }
       })
       })
   i=0;
}
/**
 *
 * The end of update function
 */
function Edit(tid, T) {
    $(document).ready(function () {
        var old;
        var data = {
           disp:{},
            ae: {},
            cp: {},
            ae_ouvert: {},
            cp_ouvert: {},
            ae_attendu: {},
            cp_attendu: {},
            ae_reporte: {},
            ae_notifie: {},
            ae_engage: {},
            cp_reporte: {},
            cp_notifie: {},
            cp_consome: {},
            descrp:{},
            intituel:{}
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
            //console.log('odl ' + code.text())
            // Create an input element and set its value
            let input = $('<input type="text" oninput="formatAccountingFigures(this)" step="0.01" class="form-control"/>').val(currentText);
            cell.html(input);  // Replace the cell content with the input

            input.focus();  // Focus on the input immediately

            // When the input loses focus, update the cell with new text
            input.blur(function (t) {
                let newText = $(this).val();  // Get new value from input

                if (tid == 'T_port2' || tid == 'T2') {
                    var testcpattendu = clickedRow.find('td').eq(5).text();//cpattendu
                    var testaeattendu = clickedRow.find('td').eq(4).text();//aeattendu
                    var testcpover = clickedRow.find('td').eq(3).text();//cpovert
                    var testaeover = clickedRow.find('td').eq(2).text();//aeovert
                    var someae = 0;
                    var somecp = 0;
                    if (newText != 0 && newText != '' && newText != null) {
                        var wit = $(this).parent().attr('id');
                        //console.log('ae -> ' + testaeover + 'cp ->' + testcpover + ' ae ett -> ' + testaeattendu + ' cp ett ->' + testcpattendu + 'value change ->' + JSON.stringify(wit))
                        if (wit == 'CP_att') {
                            testcpattendu = newText
                        }
                        if (wit == 'AE_att') {
                            testaeattendu = newText
                        }
                        if (wit == 'AE_Over') {
                            testaeover = newText
                        }
                        if (wit == 'CP_Over') {
                            testcpover = newText
                        }
                        somecp = parseNumberWithoutCommas(testcpattendu) + parseNumberWithoutCommas(testcpover)
                        someae = parseNumberWithoutCommas(testaeattendu) + parseNumberWithoutCommas(testaeover);
                        //console.log('ae' + someae + ' cp ' + somecp)
                        clickedRow.find('td').eq(6).text(ValAccountingFigures(someae));
                        clickedRow.find('td').eq(7).text(ValAccountingFigures(somecp));
                    }
                }
                if (newText != 0 && newText != '' && newText != null) {
                    mount_chang = true

                    if (mount_chang == true) {
                        
                        click++;
                        if (click == 1) {
                            var buttons = '<button class="btn btn-primary" id="changin"> appliquer</button>'
                        }
                        $('.change_app').append(buttons)
                      /*  $('#changin').on('click', function () {
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
                                    //console.log('Data of T1'+JSON.stringify(data));


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
                                if (tid == 'T_port3' || tid == 'T3' || T == 3) {

                                    var code = $(this).find('td').eq(0).text();
                                    var aeDataReporte = $(this).find('td').eq(3).text();
                                    var aeDataNotifie = $(this).find('td').eq(4).text();
                                    var aeDataEngage = $(this).find('td').eq(5).text();

                                    var cpDataReporte = $(this).find('td').eq(6).text();
                                    var cpDataNotifie = $(this).find('td').eq(7).text();
                                    var cpDataEngage = $(this).find('td').eq(8).text();


                                    // Ajoute les valeurs dans les objets
                                    ////console.log("ddcss");
                                    data.ae_reporte[code] = aeDataReporte;
                                    data.ae_notifie[code] = aeDataNotifie;
                                    data.ae_engage[code] = aeDataEngage;

                                    data.cp_reporte[code] = cpDataReporte;
                                    data.cp_notifie[code] = cpDataNotifie;
                                    data.cp_consome[code] = cpDataEngage;

                                }
                                if (tid == 'T_port4' || tid == 'T4') {

                                    var code = $(this).find('td').eq(0).text();
                                    var aeValue = $(this).find('td').eq(3).text();
                                    var cpValue = $(this).find('td').eq(4).text();
                                    // Ajoute les valeurs dans les objets
                                    data.ae[code] = aeValue;
                                    data.cp[code] = cpValue;
                                   //console.log('T4'+JSON.stringify(data))

                                }
                                // value_chng.push(rw);
                            })

                            $('.change_app').empty()
                            //  //console.log('path' + JSON.stringify(path))
                            ////console.log('path' + JSON.stringify(path3))
                            //var url=   '/testing/Action/' + path.join('/');
                            //console.log(" eat " + path3.length)
                            if (path3.length > 4) {
                               //console.log('URL plus' + url)
                                var url = '/testing/S_action/' + path3[0] + '/' + path3[1] + '/' + path3[2] + '/' + path3[3] + '/' + path3[4] + '/' + T;
                                //var id_sous_action= path[4];
                            } else {

                                // var id_sous_action= path[3];
                                var url = '/testing/S_action/' + path3[0] + '/' + path3[1] + '/' + path3[2] + '/' + path3[3] + '/' + path3[3] + '/' + T;
                                //console.log('URL less' + url)
                            }

                            $.ajax({
                                url: url,
                                type: 'GET',
                                data: {
                                    ae: data.ae,
                                    cp: data.cp,

                                    ae_ouvert: data.ae_ouvert,
                                    cp_ouvert: data.cp_ouvert,
                                    ae_attendu: data.ae_attendu,
                                    cp_attendu: data.cp_attendu,

                                    ae_reporte: data.ae_reporte,
                                    ae_notifie: data.ae_notifie,
                                    ae_engage: data.ae_engage,
                                    cp_reporte: data.cp_reporte,
                                    cp_notifie: data.cp_notifie,
                                    cp_consome: data.cp_consome,
                                    //id_sous_action: id_sous_action,
                                    _token: $('meta[name="csrf-token"]').attr('content'),
                                    _method: "GET"
                                },
                                success: function (response) {
                                    if (response.code == 200 || response.code == 404) {
                                        window.location.reload();
                                        ////console.log('path' + JSON.stringify(path))

                                    }
                                    else
                                    {
                                       //console.log(response.message)
                                    }
                                },
                                error: function (response) {
                                    //console.log('error')
                                }


                            });
                            click = 0;
                        })*/
                    }
                    //  //console.log('all table'+JSON.stringify(value_chng))
                    cell.text(newText);
                }
                else {
                    cell.empty();
                    if(old == 0 || old == "0" || old == '' || old === null)
                    {
                       old='0';
                    }
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

            $('.change_app').on('click',function(){
               var idbtn=$(this).children('#changin').attr('id');
               if(idbtn == 'changin')
               {
// value_chng=new Array()
$('#reloading').removeClass('reload-hidden')
//    alert('changing success')
$('#T-tables tbody tr').each(function () {

if (tid == 'T_port1' || tid == 'T1') {

var code = $(this).find('td').eq(0).text();
var aeValue = $(this).find('td').eq(2).text();
var cpValue = $(this).find('td').eq(3).text();
// Ajoute les valeurs dans les objets
data.ae[code] = aeValue;
data.cp[code] = cpValue;
//console.log('Data of T1'+JSON.stringify(data));


}
if (tid == 'T_port2' || tid == 'T2') {

var code = $(this).find('td').eq(0).text();
var aeDataOuvert = $(this).find('td').eq(2).text();
var cpDataOuvert = $(this).find('td').eq(3).text();
var aeDataAttendu = $(this).find('td').eq(4).text();
var cpDataAttendu = $(this).find('td').eq(5).text();
/* var someae = parseFloat(aeDataOuvert) + parseFloat(aeDataAttendu);
var somecp = parseFloat(cpDataOuvert) + parseFloat(cpDataAttendu);
*/
// Ajoute les valeurs dans les objets
data.ae_ouvert[code] = aeDataOuvert;
data.cp_ouvert[code] = cpDataOuvert;
data.ae_attendu[code] = aeDataAttendu;
data.cp_attendu[code] = cpDataAttendu;

}
if (tid == 'T_port3' || tid == 'T3' || T == 3) {

var code = $(this).find('td').eq(0).text();
var descrip=$(this).find('td').eq(2).text();
var intituel=$(this).find('td').eq(3).text();
var aeDataReporte = $(this).find('td').eq(4).text();
var aeDataNotifie = $(this).find('td').eq(5).text();
var aeDataEngage = $(this).find('td').eq(6).text();

var cpDataReporte = $(this).find('td').eq(7).text();
var cpDataNotifie = $(this).find('td').eq(8).text();
var cpDataEngage = $(this).find('td').eq(9).text();


// Ajoute les valeurs dans les objet
////console.log("ddcss");
data.descrp[code]=descrip
data.intituel[code]=intituel
data.ae_reporte[code] = aeDataReporte;
data.ae_notifie[code] = aeDataNotifie;
data.ae_engage[code] = aeDataEngage;

data.cp_reporte[code] = cpDataReporte;
data.cp_notifie[code] = cpDataNotifie;
data.cp_consome[code] = cpDataEngage;

}
if (tid == 'T_port4' || tid == 'T4' || T == 4) {

var code = $(this).find('td').eq(0).text();
var descr= $(this).find('td').eq(1).text();
var dispo= $(this).find('td').eq(2).text();
/*if($(this).find('td').eq(3).attr('class') == 'init_AE_T4')
{
    var aeValue = 0;
}
else
{
    var aeValue = $(this).find('td').eq(3).text();
}

if($(this).find('td').eq(4).attr('class') == 'init_CP_T4')
{
        var cpValue = 0;
}
else
{
        var cpValue = $(this).find('td').eq(4).text();
}*/
var aeValue = $(this).find('td').eq(3).text();
var cpValue = $(this).find('td').eq(4).text();
// Ajoute les valeurs dans les objets
data.descrp[code]=descr;
data.disp[code]=dispo;
data.ae[code] = aeValue;
data.cp[code] = cpValue;
//console.log('T4'+JSON.stringify())

}
// value_chng.push(rw);
})


$('.change_app').empty()
  ////console.log('path' + JSON.stringify(path))
//console.log('path' + JSON.stringify(path3))
//var url=   '/testing/Action/' + path.join('/');
//console.log(" eat " + path3.length)
if (path3.length > 4) {
//console.log('URL plus' + url)
var url = '/testing/S_action/' + path3[0] + '/' + path3[1] + '/' + path3[2] + '/' + path3[3] + '/' + path3[4] + '/' + T;
//var id_sous_action= path[4];
} else {
    //console.log('path' + JSON.stringify(path3))
// var id_sous_action= path[3];
var url = '/testing/S_action/' + path3[0] + '/' + path3[1] + '/' + path3[2] + '/' + path3[3] + '/' + path3[3] + '/' + T;
//console.log('URL less' + url)
}

$.ajax({
url: url,
type: 'GET',
data: {
ae: data.ae,
cp: data.cp,

ae_ouvert: data.ae_ouvert,
cp_ouvert: data.cp_ouvert,
ae_attendu: data.ae_attendu,
cp_attendu: data.cp_attendu,

ae_reporte: data.ae_reporte,
ae_notifie: data.ae_notifie,
ae_engage: data.ae_engage,
cp_reporte: data.cp_reporte,
cp_notifie: data.cp_notifie,
cp_consome: data.cp_consome,
dispo:data.disp,
intitule:data.intituel,
descr:data.descrp,
//id_sous_action: id_sous_action,
_token: $('meta[name="csrf-token"]').attr('content'),
_method: "GET"
},
success: function (response) {
if (response.code == 200 || response.code == 404) {

window.location.reload();
}
else
{
//console.log(response.message)
}
},
error: function (response) {
//console.log('error')
}


});
click = 0;

               }
            })
            $('#changin').on('click', function () {

           })

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
        ' <p class="card-description-T">AE 190 DZ.</p>' +
        ' <p class="card-description-T">CP 100 DZ.</p>' +
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
        ' <p class="card-description-T">AE 290 DZ.</p>' +
        ' <p class="card-description-T">CP 100 DZ.</p>' +
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
        ' <p class="card-description-T">AE 390 DZ.</p>' +
        ' <p class="card-description-T">CP 100 DZ.</p>' +
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
        ' <p class="card-description-T">AE 490 DZ.</p>' +
        ' <p class="card-description-T">CP 100 DZ.</p>' +
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
    preview('file_holder')
    $('#date_crt_portf').on('focusout', function () {
        var num_portefeuil = $('#num_port').val(); // Récupérer la valeur du portefeuille
        var Date_portefeuille = $(this).val();  // Récupérer la valeur de la date

        var year = new Date(Date_portefeuille).getFullYear(); // Extraire l'année à partir de la date
        var numwall_year = num_portefeuil +'-'+ year;


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
                        //console.log(response); // Vérifiez la réponse

                        //console.log('numwall_year path3: ' + JSON.stringify(path3));
                         $('#file_holder').empty()

                        // Remplir les champs du formulaire avec les données récupérées
                        $('#date_crt_portf').val(response.Date_portefeuille).trigger('change'); // Remplir et déclencher l'événement change
                        $('#AE_portef').val(ValAccountingFigures(response.AE_portef)).trigger('change'); // Remplir et déclencher l'événement change
                        $('#CP_portef').val(ValAccountingFigures(response.CP_portef)).trigger('change'); // Remplir et déclencher l'événement change
                        $('#nom_journ').val(response.nom_journal).trigger('change'); // Remplir et déclencher l'événement change
                        $('#num_journ').val(response.num_journal).trigger('change'); // Remplir et déclencher l'événement change
                        $('#add-wallet').text('Modifier')
                        //console.log(response.Date_portefeuille);
                        alert('Le portefeuille existe déjà');

                        //$('.font-bk').removeClass('back-bk')
                        //$('.wallet-path').css('display', 'flex')
                        //$('.wallet-handle').empty()
                        //$('#progam-handle').css('display', 'block')
                        //$('#progam-handle').removeClass('scale-out')
                        //$('#progam-handle').addClass('scale-visible')
                        //$('#w_id').text(num_portefeuil)
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
    var deleg_action="centrale"

    $('#act_deleg').change(function() {
        if ($(this).is(':checked')) {
            deleg_action="delegation"
            //console.log('Checkbox is checked. Value:', $(this).val());
        } else {
              deleg_action="centrale"
            //console.log('Checkbox is unchecked.', $(this).val());
        }
    });


    $("#add-wallet").on("click", function () {
        var num_wallet = $("#num_port").val();
        var dateprort = $("#date_crt_portf").val();
        var year = new Date(dateprort).getFullYear(); // Extraire l'année à partir de la date
        var numwall_year = num_wallet + '-'+ year;
        var indice = 0;
        var isEmpty = false;
        var formId = $(this).parents(".card-body").attr("id");
        //console.log("and form id" + formId);
        $("#" + formId + " form")
            .find("input")
            .each(function () {
                //console.log("before the loop");
                var inputValue = $(this).val();

                // Check if the input is not empty
                if (inputValue.trim() === "") {
                    isEmpty = true;
                    indice++;
                }

                if (isEmpty) {
                    if (indice < 2) {
                        alert("Veuillez remplir tous les champs obligatoires");
                    }
                    $(this).css(
                        "box-shadow",
                        "0 0 0 0.25rem rgb(255 0 0 / 47%)"
                    );
                }
            });
        // //console.log('id'+num_wallet)
        var formportinsert = {
            num_portefeuil: numwall_year,
            Date_portefeuille: $("#date_crt_portf").val(),
            nom_journal: $("#nom_journ").val(),
            num_journal: $("#num_journ").val(),
            AE_portef: $("#AE_portef").val(),
            CP_portef: $("#CP_portef").val(),
            //year: year,
            _token: $('meta[name="csrf-token"]').attr("content"),
            _method: "POST",
        };

        // Ajouter le fichier s'il est sélectionné HOUDAA
        $.ajax({
            url: "/creation",
            type: "POST",
            data: formportinsert,
            success: function (response) {
                if (response.code == 200 ) {
                    //console.log('createing')
                   
                    alert(response.message);
                    path.push(numwall_year);
                    path3.push(num_wallet);
                    upload_file('file_prg',numwall_year) 
                    //console.log("numwall_year path: " + JSON.stringify(path));

                    $(".font-bk").removeClass("back-bk");
                    $(".wallet-path").css("display", "flex");
                    $(".wallet-handle").empty();
                    $(".wallet-handle").addClass('wallet-hide');
                    $("#progam-handle").css("display", "block");
                    $("#progam-handle").removeClass("scale-out");
                    $("#progam-handle").addClass("scale-visible");
                    $("#w_id").text(num_wallet);
                    preview('file_prg')
                
                    
                } else if( response.code == 404) {

                   alert(response.message);
                   path.push(numwall_year);
                   path3.push(num_wallet);
                   upload_file('file',numwall_year) 
                   preview('file')

                   //console.log("numwall_year path: " + JSON.stringify(path));
                   $(".font-bk").removeClass("back-bk");
                   $(".wallet-path").css("display", "flex");
                   $(".wallet-handle").empty();
                   $(".wallet-handle").addClass('wallet-hide');
                   $("#progam-handle").css("display", "block");
                   $("#progam-handle").removeClass("scale-out");
                   $("#progam-handle").addClass("scale-visible");
                   $("#w_id").text(num_wallet);
                   preview('file_prg')
               }
                   else{
                    alert(response.message);
                }
            },
            error: function () {
                alert("error");
            },
        });
    });




});
focus_()

$("#date_insert_portef").on('focusout', function () {
    var num_prog = $('#num_prog').val(); // Récupérer la valeur du portefeuille
    var Date_prog = $(this).val();  // Récupérer la valeur de la date

    var year = new Date(Date_prog).getFullYear(); // Extraire l'année à partir de la date
    var numprog_year = path[0] +'-'+num_prog;
    

    // Vérifie que les deux champs sont remplis avant de continuer
    if (Date_prog && num_prog) {
        // Appel AJAX pour vérifier le portefeuille dans la base de données

        //console.log('data' + numprog_year)
        $.ajax({
            url: '/check-prog',  // Route pour vérifier l'existence du portefeuille
            type: 'GET',
            data: {
                num_portefeuil: path[0],
                num_prog: numprog_year,
                Date_prog: Date_prog
            },
            success: function (response) {
                if (response.exists) {
                    //console.log(response); // Vérifiez la réponse
                    //console.log('numwall_year path3: ' + JSON.stringify(path3));
                    $("#file_holder_prog").empty();
                    // Remplir les champs du formulaire avec les données récupérées
                    //console.log('response.CP_prog' + response.CP_prog)
                    $('#date_insert_portef').val(response.date_insert_portef).trigger('change');
                    $('#nom_prog').val(response.nom_prog).trigger('change'); // Remplir et déclencher l'événement change
                    $('#AE_prog').val(ValAccountingFigures(response.AE_prog)).trigger('change'); // Remplir et déclencher l'événement change
                    $('#CP_prog').val(ValAccountingFigures(response.CP_prog)).trigger('change'); // Remplir et déclencher l'événement change
                    $('#nom_journ').val(response.nom_journal).trigger('change'); // Remplir et déclencher l'événement change
                    $('#num_journ').val(response.num_journal).trigger('change'); // Remplir et déclencher l'événement change
                    $('#add-prg').text('Modifier')
                    $('.preview_handle').empty()
                    preview('file_prg')

                    alert('Le programme existe déjà');

                }
            },
            error: function () {
                alert('Erreur lors de la vérification du programme');
            }
        });
    }
});

$("#add-prg").on('click', function () {
    $('#reloading').removeClass('reload-hidden')
    var id_prog = $('#num_prog').val();
    var nom_prog = $('#nom_prog').val();
    var ae_prog = $('#AE_prog').val()
    var cp_prog = $('#CP_prog').val()
    var numprog_year =path[0] +'-'+ id_prog;
    //console.log("path[0]",path[0] );
    //console.log("id_prog",id_prog );
    //console.log("prog",numprog_year );
    var date_sort_jour = $('#date_insert_portef').val();
    check_ifnull(this)
    var formprogdata = {
        num_prog: numprog_year,
        nom_prog: nom_prog,
        ae_prog: ae_prog,
        cp_prog: cp_prog,
        num_portefeuil: path[0],
        date_insert_portef: date_sort_jour,
        _token: $('meta[name="csrf-token"]').attr('content'),
        _method: 'POST'
    }
    var prg2 = '<div class="form-container" id="creati-sous_prog">' +
        '<form enctype="multipart/form-data">' +
        '<div class="form-group">' +
        '<label for="input1">Code du Sous Programme</label>' +
        '<input type="text" class="form-control" id="num_sous_prog" placeholder="Entrer le  Code du Sous Programme">' +
        '</div>' +
        ' <div class="form-group">' +
        ' <label for="inputDate">Date du Journal</label>' +
        '<input type="date" class="form-control" id="date_insert_sousProg">' +
        '</div>' +
        '<div class="form-group">' +
        '<label for="input1">Nom du Sous Programme</label>' +
        '<input type="text" class="form-control" id="nom_sous_prog" placeholder="Entrer le Nom du Sous Programme">' +
        '</div>' +
        '<div class="form-group">' +
        '<label for="input1">AE pour Sous Programme</label>' +
        '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="AE_sous_prog"   placeholder="Entrer AE Sous Programme" disabled>' +
        '</div>' +
        '<div class="form-group">' +
        '<label for="input1">CP pour Sous Programme</label>' +
        '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="CP_sous_prog"  placeholder=" Entrer CP Sous Programme" disabled>' +
        '</div>' +
        '<div class="init_holder">'+
        '<div class="T_init_port">'+
        '<div class="ports_init">'+
        '<div class="form-group">' +
        '<label for="input1">T1 pour Sous Programme</label>' +
        '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="T1_AE_init"   placeholder="Entrer T1 AE Sous Programme">' +
        '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="T1_CP_init"   placeholder="Entrer T1 CP Sous Programme">' +
        '</div>' +
        '<div class="form-group">' +
        '<label for="input1">T2 pour Sous Programme</label>' +
        '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="T2_AE_init"   placeholder="Entrer T2 AE Sous Programme">' +
        '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="T2_CP_init"   placeholder="Entrer T2 CP Sous Programme">' +
        '</div>' +
        '<div class="form-group">' +
        '<label for="input1">T3 pour Sous Programme</label>' +
        '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="T3_AE_init"   placeholder="Entrer T3 AE Sous Programme">' +
        '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="T3_CP_init"   placeholder="Entrer T3 CP Sous Programme">' +
        '</div>' +
        '<div class="form-group">' +
        '<label for="input1">T4 pour Sous Programme</label>' +
        '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="T4_AE_init"   placeholder="Entrer T4 AE Sous Programme">' +
        '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="T4_CP_init"   placeholder="Entrer T4 CP Sous Programme">' +
        '</div>' +
        '</div>'+
        '</div>'+
        '</div>'+
        ' </form>' +
        ' <br>' +
        '<div id="confirm-holder_sprog">' +
        ' <div class="file-handle" id="file_holder">' +
        '<input type="file" class="form-control" id="file_sprog" accept=".pdf, .jpg, .jpeg, .png">' +
        '</div>' +
        '<div id="preview_sporg"></div>'+
         '<hr>' +
        '<button class="btn btn-primary" id="add-prg2">Ajouter</button>' +
        '</div>';
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

               if(response.code == 200){
               if(upload_file('file_prg',numprog_year) == 200)
               {
                   alert(response.message)
                   $('#reloading').addClass('reload-hidden')
                  // $('.preview_handle').empty()
               }}
                path.push(numprog_year);
                path3.push(id_prog);
                //console.log('numprog_year path: ' + JSON.stringify(path));
                //console.log('numprog path: ' + JSON.stringify(path3));
                $('.next-handle svg').removeClass('waiting-icon')
                $('.next-handle svg').addClass('complet-icon')
                $('.the-path').append(nexthop)
                $('#progam-handle').append(prg2)
                $(this).text('Modifier')

                preview_sprog('file_sprog')
                // Vérifie l'existence du programme lorsque le champ de programme perd le focus
                $('#date_insert_sousProg').on('focusout', function () {
                    var Date_sou_program = $(this).val(); // Récupérer la valeur du programme
                    //var year = new Date(Date_sou_program).getFullYear(); // Extraire l'année à partir de la date
                    var num_sou_prog = $('#num_sous_prog').val(); // Récupérer la valeur de la date du programme
                    // Vérifie que les deux champs sont remplis avant de continuer
                    var num_sou_program = path[1] +'-'+ num_sou_prog;
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
                                   //console.log(response); // Vérifiez la réponse

                                   // Remplir les champs du formulaire avec les données récupérées
                                   $('#nom_sous_prog').val(response.nom_sous_prog).trigger('change');
                                   $('#AE_sous_prog').val(ValAccountingFigures(response.AE_sous_prog))  .trigger('change');
                                   $('#CP_sous_prog').val(ValAccountingFigures(response.CP_sous_prog)).trigger('change');

                                   $('#T1_AE_init').val(ValAccountingFigures(response.T1_AE_init)).trigger('change');
                                   $('#T1_CP_init').val(ValAccountingFigures(response.T1_CP_init)).trigger('change');

                                   $('#T2_AE_init').val(ValAccountingFigures(response.T2_AE_init)).trigger('change');
                                   $('#T2_CP_init').val(ValAccountingFigures(response.T2_CP_init)).trigger('change');

                                   $('#T3_AE_init').val(ValAccountingFigures(response.T3_AE_init)).trigger('change');
                                   $('#T3_CP_init').val(ValAccountingFigures(response.T3_CP_init)).trigger('change');

                                   $('#T4_AE_init').val(ValAccountingFigures(response.T4_AE_init)).trigger('change');
                                   $('#T4_CP_init').val(ValAccountingFigures(response.T4_CP_init)).trigger('change');
                                   $('#add-prg2').text('Modifier')
                                    $('.preview_handle').empty()
                                   preview_sprog('file_sprog')
                                   alert('Le sous-programme existe déjà.');
                               }  else {
                                    // alert('Le programme n\'existe pas.');
                                }
                            },
                            error: function () {
                                alert('Erreur lors de la vérification du programme');
                            }
                        });
                    }
                });
                focus_()

                calaulsomeAE_CP_sprog()
                /**  sous prog insert */
                $('#add-prg2').on('click', function () {
                    $('#reloading').removeClass('reload-hidden')
                    var sou_prog = $('#num_sous_prog').val()
                    var nom_sou_prog = $('#nom_sous_prog').val();
                    var dat_sou_prog = $('#date_insert_sousProg').val()
                    var AE_sous_prog = $('#AE_sous_prog').val()
                    var T1_AE_init = $('#T1_AE_init').val()
                    var T1_CP_init = $('#T1_CP_init').val()

                    var T2_AE_init = $('#T2_AE_init').val()
                    var T2_CP_init = $('#T2_CP_init').val()

                    var T3_AE_init = $('#T3_AE_init').val()
                    var T3_CP_init = $('#T3_CP_init').val()

                    var T4_AE_init = $('#T4_AE_init').val()
                    var T4_CP_init = $('#T4_CP_init').val()

                    var CP_sous_prog = $('#CP_sous_prog').val()
                    var id_prog = path[1];
                    var numsouprog_year = id_prog +'-'+sou_prog ;
                    check_ifnull('#add-prg2')
                    //var id_port = path[0];
                    var nexthop = '<div class="pinfo-handle">' +
                        '<i class="fas fa-wallet"></i>' +
                        '<p >S_Program :</p>' +
                        '<p>' + sou_prog + '</p>' +
                        '</div>' +
                        ' <div class="next-handle">' +
                        '<i class="fas fa-angle-double-right waiting-icon"></i>' +
                        '</div>'
                    var prg3 = '<div class="form-container" id="creati-act">' +
                        '<form>' +
                        '<div class="form-group">' +
                        '<label for="input1">Code  d\'ACTION</label>' +
                        '<input type="text" class="form-control" id="num_act" placeholder="Entrer le Code  d\'ACTION">' +
                        '</div>' +
                        ' <div class="form-group">' +
                        ' <label for="inputDate">Date du Journal</label>' +
                        '<input type="date" class="form-control" id="date_insert_action">' +
                        '</div>' +
                        '<div class="form-group">' +
                        '<label for="input1">Nom  d\'ACTION</label>' +
                        '<input type="text" class="form-control" id="nom_act" placeholder="Entrer le Nom  d\'ACTION">' +
                        '</div>' +
                        '<div class="form-group" id="ElAE_act">' +
                        '<label for="input1">AE pour Action</label>' +
                        '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="AE_act" placeholder="Entrer AE Action" disabled>' +
                        '</div>' +
                        '<div class="form-group" id="ElCP_act">' +
                        '<label for="input1">CP pour Action</label>' +
                        '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="CP_act" placeholder="Entrer CP Action" disabled>' +
                        '</div>' +
                        '<div class="init_holder">'+
                        '<div class="T_init_port">'+
                        '<div class="ports_init">'+
                        '<div class="form-group">' +
                        '<label for="input1">T1 pour ACTION</label>' +
                        '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="T1_AE_init_AC"   placeholder="Entrer T1 AE ACTION">' +
                        '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="T1_CP_init_AC"   placeholder="Entrer T1 CP ACTION">' +
                        '</div>' +
                        '<div class="form-group">' +
                        '<label for="input1">T2 pour ACTION</label>' +
                        '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="T2_AE_init_AC"   placeholder="Entrer T2 AE ACTION">' +
                        '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="T2_CP_init_AC"   placeholder="Entrer T2 CP ACTION">' +
                        '</div>' +
                        '<div class="form-group">' +
                        '<label for="input1">T3 pour ACTION</label>' +
                        '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="T3_AE_init_AC"   placeholder="Entrer T3 AE ACTION">' +
                        '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="T3_CP_init_AC"   placeholder="Entrer T3 CP ACTION">' +
                        '</div>' +
                        '<div class="form-group">' +
                        '<label for="input1">T4 pour ACTION</label>' +
                        '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="T4_AE_init_AC"   placeholder="Entrer T4 AE ACTION">' +
                        '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="T4_CP_init_AC"   placeholder="Entrer T4 CP ACTION">' +
                        '</div>' +
                        '</div>'+
                        '</div>'+
                        '</div>'+
                        ' <div class="form-group">'+
                        ' <label for="CP_sous_act">Action de Délégation</label>'+
                        '<input type="checkbox"  id="act_deleg">'+
                         '</div>'+
                         ' </form>' +
                        ' <br>' +
                        '<div id="confirm-holder_sprog">' +
                        '<div class="file-handle" id="file_holder">' +
                        '<input type="file" class="form-control" id="file_act" accept=".pdf, .jpg, .jpeg, .png">' +
                        '</div>' +
                        '<div class="preview_handle_act">'+
                        '<div id="preview_act"></div>'+
                        '</div>'+
                        '<hr>' +
                        '<div id="confirm-holder_act">' +
                        '<button class="btn btn-primary" id="add-prg3">Ajouter</button>' +
                        '</div>'
                        ;
                    var formdatasou_prog = {
                        num_sous_prog: numsouprog_year,
                        nom_sous_prog: nom_sou_prog,
                        AE_sous_prog: AE_sous_prog,
                        CP_sous_prog: CP_sous_prog,
                        date_insert_sousProg: dat_sou_prog,
                        id_program: id_prog,

                        T1_AE_init: T1_AE_init,
                        T1_CP_init: T1_CP_init,
                        code_t1: 10000,

                        T2_AE_init: T2_AE_init,
                        T2_CP_init: T2_CP_init,
                        code_t2: 20000,

                        T3_AE_init: T3_AE_init,
                        T3_CP_init: T3_CP_init,
                        code_t3: 30000,

                        T4_AE_init: T4_AE_init,
                        T4_CP_init: T4_CP_init,
                        code_t4: 40000,

                        //id_porte: id_port,
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        _method: 'POST'
                    }
                    var formatinitports=
                    {
                       num_sous_prog: numsouprog_year,
                       code_t1:10000,
                       T1_AE_init:$('#T1_AE_init').val(),
                       T1_CP_init:$('#T1_CP_init').val(),

                       code_t2:20000,
                       T2_AE_init:$('#T2_AE_init').val(),
                       T2_CP_init:$('#T2_CP_init').val(),

                       code_t3:30000,
                       AE_init_t3:$('#T3_AE_init').val(),
                       CP_init_t3:$('#T3_CP_init').val(),

                       code_t4:40000,
                       AE_init_t4:$('#T4_AE_init').val(),
                       CP_init_t4:$('#T4_CP_init').val(),
                       date_init:dat_sou_prog,
                       _token: $('meta[name="csrf-token"]').attr('content'),
                       _method: 'POST'
                    }
                    //console.log('data' + JSON.stringify(formdatasou_prog))
                    $.ajax({
                        url: '/creationSousProg',
                        type: "POST",
                        data: formdatasou_prog,
                        success: function (response) {
                            if (response.code == 200 || response.code == 404) {
                               if(response.code == 200){
                                   if(upload_file('file_sprog',numsouprog_year) == 200)
                                   {
                                    $('#reloading').addClass('reload-hidden')
                                       alert(response.message)
                                      // $('.preview_handle').empty()
                                   }
                                  /* $.ajax({
                                       url:'/init_ports',
                                       type:'POST',
                                       data:formatinitports,
                                       success:function(response)
                                       {
                                           if(response.code == 200)
                                           {

                                           }
                                           else
                                           {

                                           }
                                       }
                                   })*/
                               }
                                alert(response.message)
                                path.push(numsouprog_year);
                                path3.push(sou_prog);
                                //console.log('num_sou_program path: ' + JSON.stringify(path));

                                $('.next-handle svg').removeClass('waiting-icon')
                                $('.next-handle svg').addClass('complet-icon')
                                $('.the-path').append(nexthop)
                                $('#progam-handle').append(prg3)
                                $(this).text('Modifier')
                                focus_()
                                preview_act('file_act')
                                $('#date_insert_action').on('focusout', function () {
                                    //console.log('out')
                                    var date_act = $(this).val();
                                    var num_act = $('#num_act').val();
                                    //  var date_act=  new Date(date_act).getFullYear();
                                    var numact_year = path[2] +'-'+num_act ;
                                    //console.log('the new id' + numact_year + ' with ' + JSON.stringify(path))
                                    //console.log('jhvgf');
                                    if (date_act && num_act) {
                                        $.ajax({
                                            url: '/check-action',  // Route pour vérifier l'existence du programme
                                            type: 'GET',
                                            data: {
                                                num_action: numact_year,
                                            },
                                            success: function (response) {
                                                if (response.exists) {
                                                    $('#nom_act').val(response.nom_action).trigger('change'); // Remplir et déclencher l'événement change
                                                     $('#date_insert_action').val(response.date_insert_action).trigger('change'); // Remplir et déclencher l'événement change
                                                    $('#AE_act').val(ValAccountingFigures(response.AE_act)).trigger('change'); // Remplir et déclencher l'événement change
                                                    $('#CP_act').val(ValAccountingFigures(response.CP_act)).trigger('change'); // Remplir et déclencher l'événement change
                                                    $('#add-prg3').text('Modifier')
                                                     $('.preview_handle').empty()
                                                    alert('L`Action existe déjà');
                                                    preview_act('file_act')
                                                }
                                                else {
                                                    //console.log('Erreur d`Opération');

                                                }
                                            }
                                        })
                                    }
                                })

                                /******           ACTION add for under_progam                    *********** */

                                calaulsomeAE_CP_act()
                                $('#add-prg3').on('click', function () {
                                    /**
                                     *  this part for chacking if he want to under_action
                                     *
                                     */
                                    $('#reloading').removeClass('reload-hidden')
                                    // Demande de confirmation pour ajouter une sous-action après l'ajout de l'action
                                    let userResponse = confirm('Voulez-vous ajouter une sous-action pour cette action ?');
                                    var nom_act = $('#nom_act').val();
                                    var num_act = $('#num_act').val();
                                    var AE_act = $('#AE_act').val()
                                    var CP_act = $('#CP_act').val()
                                    var deleg_act=$('#act_deleg').val()
                                    var dat_inst = $('#date_insert_action').val();
                                    var id_sou_prog = path[2];
                                    check_ifnull('#add-prg3')
                                    var numaction_year = id_sou_prog +'-'+num_act ;
                                        var nexthop = '<div class="pinfo-handle">' +
                                            '<i class="fas fa-wallet"></i>' +
                                            '<p >Action :</p>' +
                                            '<p>' + num_act + '</p>' +
                                            '</div>' +
                                            ' <div class="next-handle">' +
                                            '<i class="fas fa-angle-double-right waiting-icon"></i>' +
                                            '</div>'
                                        // Création du formData pour l'action
                                        //console.log('action sous prog '+path[2])
                                        var formdata_act = {
                                            num_action: numaction_year,
                                            nom_action: nom_act,
                                            AE_act: AE_act,
                                            CP_act: CP_act,
                                            action_delege:deleg_action,
                                            date_insert_action: dat_inst,
                                            id_sous_prog: path[2],
                                            _token: $('meta[name="csrf-token"]').attr('content'),
                                            _method: 'POST'
                                        };

                                    if (userResponse) {
                                        // Récupération des informations de l'action


                                        // Envoi de l'Action via Ajax
                                        $.ajax({
                                            url: '/creationAction',
                                            type: 'POST',
                                            data: formdata_act,
                                            success: function (response) {
                                                if (response.code === 200 || response.code === 404) {
                                                    // Ajout du numéro de l'action au chemin

                                                    if(response.code == 200){
                                                       if(upload_file('file',numaction_year) == 200)
                                                       {
                                                           alert(response.message)
                                                           $('#reloading').addClass('reload-hidden')
                                                       }
                                                   }
                                                    path.push(numaction_year);
                                                    path3.push(num_act);
                                                  /*  $('#confirm-holder_act').empty()
                                                    $('#confirm-holder_act').append('<i class="fas fa-wrench"></i>')*/
                                                    $(this).text('Modifier')
                                                    //console.log('A path: ' + JSON.stringify(path));
                                                    
                                                    // Création du formulaire pour la sous-action après l'ajout de l'action
                                                    var prg4 = `<div class="form-container" id="creati-act">
                                                           <form>
                                                            <div class="form-group">
                                                            <label for="num_sous_act">Code de Sous ACTION</label>
                                                            <input type="text" class="form-control" id="num_sous_act" placeholder="Entrer le Code de sous ACTION">
                                                           </div>
                                                            <div class="form-group">
                                                                 <label for="date_insert_sou_action">Date du Journal</label>
                                                                 <input type="date" class="form-control" id="date_insert_sou_action">
                                                               </div>
                                                            <div class="form-group">
                                                                <label for="nom_sous_act">Nom de  Sous ACTION</label>
                                                            <input type="text" class="form-control" id="nom_sous_act" placeholder="Entrer le Nom de sous ACTION">
                                                            </div>
                                                               <div class="form-group">
                                                                <label for="AE_sous_act">AE pour Sous Action</label>
                                                                <input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="AE_sous_act" placeholder="Entrer AE Sous Action">
                                                            </div>
                                                            <div class="form-group">
                                                              <label for="CP_sous_act">CP pour Sous Action</label>
                                                            <input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="CP_sous_act" placeholder="Entrer CP Sous Action">
                                                               </div>
                                                             <div class="form-group">
                                                              <label for="CP_sous_act">Action de Délégation</label>
                                                            <input type="checkbox" id="act_deleg" >
                                                              </div>
                                                               </form>
                                                               <br>
                                                               <button class="btn btn-primary" id="add-prg4">Ajouter Sous Action</button>
                                                               </div>`;

                                                    // Insertion du formulaire pour la sous-action dans le DOM
                                                    $('.the-path').append(nexthop)
                                                    $('#progam-handle').append(prg4);
                                                    focus_()
                                                    //===============CHECK SOUS ACTION=====================//
                                                    $('#date_insert_sou_action').on('focusout', function () {
                                                       //alert('out')
                                                       var date_sousact = $(this).val();
                                                       var num_sousact = $('#num_sous_act').val();
                                                       //  var date_act=  new Date(date_act).getFullYear();
                                                       var numsousact_year = path[3] +'-'+num_sousact ;
                                                       //console.log('numsousact_year' + numsousact_year + ' with ' + JSON.stringify(path))
                                                       if (date_sousact && num_sousact) {
                                                           $.ajax({
                                                               url: '/check-sousaction',  // Route pour vérifier l'existence du programme
                                                               type: 'GET',
                                                               data: {
                                                                   num_sous_action: numsousact_year,
                                                               },
                                                               success: function (response) {
                                                                   if (response.exists) {
                                                                       $('#nom_sous_act').val(response.nom_sous_action).trigger('change'); // Remplir et déclencher l'événement change
                                                                        $('#date_insert_sou_action').val(response.date_insert_sous_action).trigger('change'); // Remplir et déclencher l'événement change
                                                                       $('#AE_sous_act').val(ValAccountingFigures(response.AE_sous_act)).trigger('change'); // Remplir et déclencher l'événement change
                                                                       $('#CP_sous_act').val(ValAccountingFigures(response.CP_sous_act)).trigger('change'); // Remplir et déclencher l'événement change
                                                                       $('#add-prg4').text('Modifier')
                                                                       alert('L`Action existe déjà');

                                                                   }
                                                                   else {
                                                                       //alert('Erreur d`Opération');

                                                                   }
                                                               }
                                                           })
                                                       }
                                                   })
                                                    //=============== FIN CHECK SOUS ACTION================//
                                                    // Ajout de l'événement d'ajout pour la sous-action
                                                    $('#add-prg4').on('click', function () {
                                                        $('#reloading').removeClass('reload-hidden')
                                                        //console.log('inside sous_action')
                                                        var nom_sous_act = $('#nom_sous_act').val();
                                                        var num_sous_act = $('#num_sous_act').val();
                                                        var AE_sous_act = $('#AE_sous_act').val()
                                                        var CP_sous_act = $('#CP_sous_act').val()
                                                        var deleg=$("#act_deleg").val()
                                                        var dat_inst = $('#date_insert_sou_action').val();
                                                        //console.log("ae= ",AE_sous_act,"      " );
                                                        //console.log("cp= ",CP_sous_act );
                                                        check_ifnull('#add-prg4')
                                                        var numaction_year = path[3];
                                                        var numsousaction_year = numaction_year +'-'+num_sous_act ;
                                                        // Création du formData pour la sous-action
                                                        var formdata_sous_act = {
                                                            num_sous_action: numsousaction_year,
                                                            nom_sous_action: nom_sous_act,
                                                            AE_sous_act: AE_sous_act,
                                                            CP_sous_act: CP_sous_act,
                                                            date_insert_sous_action: dat_inst,
                                                            action_delege:deleg_action,
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
                                                                    $('#reloading').addClass('reload-hidden')
                                                                    path.push(numsousaction_year);
                                                                    path3.push(num_sous_act);
                                                                    //console.log('path: ' + JSON.stringify(path));

                                                                    // Redirection vers la page suivante après l'ajout de la sous-action
                                                                    alert('testing')
                                                                    window.location.href = 'testing/S_action/' + path[0] + '/' + path[1] + '/' + path[2] + '/' + path[3] + '/' + path[4];
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
                                        var AE_act = $('#AE_act').val()
                                        var CP_act = $('#CP_act').val()
                                        var dat_inst = $('#date_insert_action').val();
                                        var T1_AE_init = $('#T1_AE_init_AC').val()
                                        var T1_CP_init = $('#T1_CP_init_AC').val()
                    
                                        var T2_AE_init = $('#T2_AE_init_AC').val()
                                        var T2_CP_init = $('#T2_CP_init_AC').val()
                    
                                        var T3_AE_init = $('#T3_AE_init_AC').val()
                                        var T3_CP_init = $('#T3_CP_init_AC').val()
                    
                                        var T4_AE_init = $('#T4_AE_init_AC').val()
                                        var T4_CP_init = $('#T4_CP_init_AC').val()
                    
                                        var id_sou_prog = path[2];
                                        var numaction_year = id_sou_prog +'-'+num_act ;
                                        var formdata_act = {
                                            num_action: numaction_year,
                                            nom_action: nom_act,
                                            AE_act: AE_act,
                                            CP_act: CP_act,

                                            T1_AE_init_AC: T1_AE_init,
                                            T1_CP_init_AC: T1_CP_init,
                                             code_t1: 10000,

                                            T2_AE_init_AC: T2_AE_init,
                                            T2_CP_init_AC: T2_CP_init,
                                            code_t2: 20000,

                                            T3_AE_init_AC: T3_AE_init,
                                            T3_CP_init_AC: T3_CP_init,
                                            code_t3: 30000,

                                            T4_AE_init_AC: T4_AE_init,
                                            T4_CP_init_AC: T4_CP_init,
                                            code_t4: 40000,

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
                                                   if(response.code == 200){
                                                       if(upload_file('file',numaction_year) == 200)
                                                       {
                                                        $('#reloading').addClass('reload-hidden')
                                                           alert(response.message)
                                                       }
                                                   }
                                                    path.push(numaction_year);
                                                    path3.push(num_act);
                                                    //console.log('response.num_sous_action: ' + response.num_sous_action);
                                                    path.push(response.num_sous_action);
                                                    if (response.num_sous_action) {
                                                       // //console.log('path: ' + JSON.stringify(path));
                                                       window.location.href = '/testing/S_action/' + path.join('/');
                                                   }else{
                                                       // //console.log('path: ' + JSON.stringify(path));
                                                   window.location.href = '/testing/Action/' + path.join('/');
                                                   }

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
                            $('#reloading').addClass('reload-hidden')
                           
                        }
                    })

                    /**  this for Creating the T port so we gonna send it to Action handle to deal with it */

                })
            }
        },
        error: function (response) {
            alert('error')
            $('#reloading').addClass('reload-hidden')
           
        }
    })




});

/**
 * this for action T port select table
 *
 */





function T1_table(id, T, id_s_act, port,code) {
   $('#T-tables tfoot').empty();
   $('#reloading').removeClass('reload-hidden')
    var current = new Array();
    var preve = new Array();
    var newbtn = ' <div class="btn_add_budg">'+
            '<i class="fas fa-plus"></i>'+
        '</div>'+
        '<div class="print_apt">'+
        '<i class="fas fa-print"></i>'
        '</div>';
    var data_T_port = new Array();
    //console.log('T is' + T)
    $('#Tport-handle').addClass('scale-out');
    var tfooter='<tr><td colspan="2">Total</td>'+
                '<td id="foot_AE_T1">' + 0 + '</td>' +
                '<td id="foot_CP_T1">' + 0 + '</td>';
    setTimeout(() => {
        // Add the class to hide the table
        $('#Tport-handle').addClass('scale-hidden');
        // Optionally remove the scaling out class after hiding
        $('#Tport-handle').removeClass('scale-out');
        $('.T-handle').css('display', 'flex')
    }, 500)
    

    var headT = '<tr>' +
        '<th ><h1>Code</h1></th>' +
        '<th ><h1>T1. DEPENSES DE PERSONNEL</h1></th>' +
        '<th><h1>AE</h1></th>' +
        '<th><h1>CP</h1></th>' +
        '</tr>';
   

             


        var Radio='<div class="cntr">'+
  
        '<label for="opt1" class="radio" id="funt">'+
          '<input type="radio" name="rdo" id="opt1" class="hidden"/>'+
          '<span class="label"></span>Fonction supérieure'+
        '</label>'+
        
        '<label for="opt2" class="radio" id="post_sup">'+
          '<input type="radio" name="rdo" id="opt2" class="hidden"/>'+
          '<span class="label"></span>Poste supérieur'+
        '</label>'+
        
       ' <label for="opt3" class="radio" id="corcom">'+
          '<input type="radio" name="rdo" id="opt3" class="hidden"/>'+
          '<span class="label"></span>Corps Communs'+
        '</label>'+
        
      ' <label for="opt6" class="radio" id="opconducteur">'+
        '<input type="radio" name="rdo" id="opt6" class="hidden"/>'+
        '<span class="label"></span> OP + APPARITEURS + CONDUCTEURS'+
        '</label>'+

        ' <label for="opt4" class="radio" id="cdi">'+
        '<input type="radio" name="rdo" id="opt4" class="hidden"/>'+
        '<span class="label"></span> CDI'+
        '</label>'+

        ' <label for="opt5" class="radio" id="cdd">'+
        '<input type="radio" name="rdo" id="opt5" class="hidden"/>'+
        '<span class="label"></span> CDD'+
        '</label>'+

  
        ' <label for="opt7" class="radio" id="indemin">'+
        '<input type="radio" name="rdo" id="opt7" class="hidden"/>'+
        '<span class="label"></span> Primes & Indemnites'+
        '</label>'+

        ' <label for="opt8" class="radio" id="port_T1">'+
        '<input type="radio" name="rdo" id="opt8" class="hidden"/>'+
        '<span class="label"></span>Port'+
      '</label>'+

      '</div>'+
'<hr>';
var cnter=0
var currentYear = new Date().getFullYear();
$('.opt_handle').append(Radio)

/**
 * opconducteur
 */
$('#opconducteur').on('click',function()
{
   
    $('#reloading').removeClass('reload-hidden')
    $('.ports_info').css('display','none')
    $('.Budget_info').css('display','')
    var currentYear = new Date().getFullYear(); 
    var headBF='  <tr>'+
    ' <th> ADMINISTRATION CENTRALE (SERVICES CENTRAUX)</th>'+
     '<th colspan="3"> EMPLOIS BUDGETAIRES</th>'+
     '<th colspan="5"> REMUNERATION</th>'+
  ' </tr>'+
   '<tr>'+
     '<th> Catégorie du personnel</th>'+
     '<th> Ouverts (' + currentYear + ')  </th>'+
     '<th> Occupés au 31 décembre </th>'+
     '<th>Vacants ou excédent</th>'+
     '<th colspan="2"> CLASSIFICATION</th>'+
     '<th rowspan="2"> TRAITEMENT ANNUEL</th>'+
     '<th rowspan="2"> PRIMES ET INDEMNITES</th>'+
     '<th rowspan="2"> DEPENSES ANNUELLES</th>'+
   '</tr>'+
   '<tr>'+
     '<th>OP + APPARITEURS + CONDUCTEURS</th>'+
     '<th id="nbr_over"> 00</th>'+
     '<th id="nbr_occup"> 00</th>'+
     '<th id="nbr_vacants"> 00</th>'+
     '<th> CATEGORIE</th>'+
     '<th> MOYENNE</th>'+
   '</tr>';

    if($(this).children().first().is(':checked') )
        {
            
            $('.btn_bg-handler').empty()
            $('#T-tables thead').empty()
            $('#T-tables tbody').empty()
            $('#T-tables tfoot').empty()
        //console.log('inside corcome');
        $('.btn_bg-handler').append(newbtn)
        $('#T-tables thead').append(headBF)

        
        $.ajax({
            url:'/get_list_OAC/'+id_s_act,
            type:'GET',
            success:function(response){
                if(response.code == 200)
                    {
                        $('#reloading').addClass('reload-hidden')
                        $('#T-tables tbody').empty();
                    response.postsup.forEach(element=>{
                    bodyadd='<tr id='+element.id_emp+'>'+
                    '<td>'+element.Nom_opconducteurs+' </td>'+
                    '<td>'+element.EmploiesOuverts+' </td>'+
                    '<td>'+element.EmploiesOccupes+'</td>'+
                    '<td>'+element.EmploiesVacants+'</td>'+
            
                    '<td>'+element.CATEGORIE_opconducteurs+' </td>'+
                    '<td>'+element.MOYENNE_opconducteurs+' </td>'+
                   
                    '<td>'+element.TRAITEMENT_ANNUEL+'</td>'+
                    '<td>'+element.PRIMES_INDEMNITES+'</td>'+
                    '<td style="display: flex;align-items: center;flex-direction: row;justify-content: space-around;"><p>'+element.DEPENSES_ANNUELLES+'</p><p class="del_btn"><i class="fas fa-trash-alt"></i></p></td>';
                    $('#T-tables tbody').append(bodyadd);

                    $('#reloading').addClass('reload-hidden')
                    $('#nbr_over').text(response.totalOuverts)
                    $('#nbr_occup').text(response.totalOccupes)
                    $('#nbr_vacants').text(response.totalVacants)
                    $('.del_btn').on('click',function()
                    {
                        //console.log('the id is'+$(this).closest("tr").attr('id'))
                        var delID=$(this).closest("tr").attr('id')
                        $.ajax({
                            url:'/del_emplois',
                            type:'POST',
                            data:{
                                delID:delID,
                                type_pos:'opconducteur',
                                _token: $('meta[name="csrf-token"]').attr("content"),
                                _method: "POST",
                            },
                            success:function(response)
                            {
                                if(response.code == 200)
                                    {
                                newover=parseInt($('#nbr_over').text())-parseInt( element.EmploiesOuverts)
                                newoccup=parseInt($('#nbr_occup').text())-parseInt( element.EmploiesOccupes)
                                newvacant=parseInt($('#nbr_vacants').text())-parseInt( element.EmploiesVacants)


                                var t_tr=parseInt($('#T_tr').text())-parseInt(element.EmploiesOuverts)
                            var t_pr=parseInt($('#T_pr').text())-parseInt(element.EmploiesOccupes)
                            var t_dp=parseInt($('#T_dp').text())-parseInt(element.EmploiesVacants)
                                $('#T_tr').text(t_tr)
                                $('#T_pr').text(t_pr)                   
                                $('#T_dp').text(t_dp)
                    
                                var t_ov=parseInt($('#T_ov').text())-parseInt(element.TRAITEMENT_ANNUEL)
                                var t_oc=parseInt($('#T_oc').text())-parseInt(element.PRIMES_INDEMNITES)
                                var t_va=parseInt($('#T_va').text())-parseInt(element.DEPENSES_ANNUELLES)
                                $('#T_ov').text(t_ov)
                                $('#T_oc').text(t_oc) 
                                $('#T_va').text(t_va)

                              // //console.log('new'+$('#nbr_over').text()+" - "+$(this).closest("tr").find("td").eq(1).text()+"="+newover)
                               $('#'+delID).remove();   
                               $('#nbr_over').text(newover);
                               $('#nbr_occup').text(newoccup);
                               $('#nbr_vacants').text(newvacant);
                                }
                                else
                                {
                                   $('#reloading').addClass('reload-hidden')
                                }
                            }
                        })
                        
                        
                    })

                })
            }
            else
            {
               $('#reloading').addClass('reload-hidden')
            }
            },
            error: function (response) {
                alert('error')
                $('#reloading').addClass('reload-hidden')
               
            }
        })
    /**
     *  add handling button
     * */    

    $('.print_apt').on('click',function(){
        window.open('/printlist_oap/'+id_s_act,'_blank')
    })

    $(".btn_add_budg").on('click',function(){
        
        var champ='<div class="Tsop_add_handle">'+
        '<form id="add_sops">'+
        '<div class="form-group">'+
        '<label class="desp">OP + APPARITEURS + CONDUCTEURS</label>'+
         '<input type="text" class="form-control" id="funt_sup" placeholder="Veuillez Entrer le Nom du OP + APPARITEURS + CONDUCTEURS">'+
         '</div>'+
         '<div class="T3-ops_inpt_handle">' +
         '<div><label>EMPLOIS BUDGETAIRES Ouverts</label>'+
                  '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="bg_overt">'+
                  '<label>EMPLOIS BUDGETAIRES Occupés</label>'+
                  '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="bg_occup">'+
                  '<label>EMPLOIS BUDGETAIRES Vacants ou excédent </label>'+
                  '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="bg_vacant">'+
                  '<label>CLASSIFICATION CATEGORIE </label>'+
                  '<input type="text" class="form-control" id="cl_cat">'+
                  '<label>CLASSIFICATION MOYENNE </label>'+
                  '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="cl_moy">'+
                  '</div>'+
                  '<div>'+
                  '<label>TRAITEMENT ANNUEL</label>'+
                  '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="tr_annuel">'+
                  '<label>PRIMES ET INDEMNITES</label>'+
                  '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="pr_ind">'+
                  '<label>DEPENSES ANNUELLES</label>'+
                  '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="depn_annuel">'+
                  '</div>'+
        '</div>'+
     '</form>'+
     '<div class="Tsop_btn_handle">'+
     '<div><button  class="btn btn-primary" id="ajt"> Ajouter </button></div>'+
     '<div><button  class="btn btn-primary" id="cancel_ops"> Cancel </button></div>'+
     '</div>'+
     '</div>';
       
        $('.Tsop_handler').append(champ);
        $('.Tsop_handler').removeClass('Tsop_handler_h')    


        $('#ajt').on('click',function(){
            $('#reloading').removeClass('reload-hidden')
                var formate={
                    id_s_act:id_s_act,
                    type_pos:'opconducteur',
                    funt_sup:$('#funt_sup').val(),
                    bg_overt:parseInt(parseNumberWithoutCommas($('#bg_overt').val())),
                    bg_occup:parseInt(parseNumberWithoutCommas($('#bg_occup').val())),
                    bg_vacant:parseInt(parseNumberWithoutCommas($('#bg_vacant').val())),
                    cl_cat:parseInt(parseNumberWithoutCommas($('#cl_cat').val())),
                    cl_moy:parseInt(parseNumberWithoutCommas($('#cl_moy').val())),
                    tr_annuel:parseInt(parseNumberWithoutCommas($('#tr_annuel').val())),
                    pr_ind:parseInt(parseNumberWithoutCommas($('#pr_ind').val())),
                    depn_annuel:parseInt(parseNumberWithoutCommas($('#depn_annuel').val())),
                    code_t1:10000,
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    _method: "POST",
                }
                //console.log('befor ajax')
                $.ajax({
                    url:'/insertemploi',
                    type:'POST',
                    data:formate,
                    success:function(response)
                    {
                        if(response.code == 200)
                            {
                                $('#reloading').addClass('reload-hidden')   
                        //console.log('consl'+response.id_emp)
                        $('#reloading').addClass('reload-hidden')
                        id_empl=response.id_emp
              
                //console.log('tesign'+id_empl)
            var bodyadd='<tr id='+id_empl+'>'+
            '<td>'+formate.funt_sup+' </td>'+
            '<td>'+formate.bg_overt+' </td>'+
            '<td>'+formate.bg_occup+'</td>'+
            '<td>'+formate.bg_vacant+'</td>'+
    
            '<td>'+formate.cl_cat+' </td>'+
            '<td>'+formate.cl_moy+' </td>'+
           
            '<td>'+formate.tr_annuel+'</td>'+
            '<td>'+formate.pr_ind+'</td>'+
            '<td style="display: flex;align-items: center;flex-direction: row;justify-content: space-around;"><p>'+formate.depn_annuel+'</p><p class="del_btn"><i class="fas fa-trash-alt"></i></p></td>';
           
           
            var newover=parseInt(formate.bg_overt)+parseInt($('#nbr_over').text())
            var newoccup=parseInt(formate.bg_occup)+parseInt($('#nbr_occup').text())
            var newvacant=parseInt(formate.bg_vacant)+parseInt($('#nbr_vacants').text())
            
            var t_tr=parseInt(formate.tr_annuel)+parseInt($('#T_tr').text())
            var t_pr=parseInt(formate.pr_ind)+parseInt($('#T_pr').text())
            var t_dp=parseInt(formate.depn_annuel)+parseInt($('#T_dp').text())
            $('#T_tr').text(t_tr)
            $('#T_pr').text(t_pr)                   
            $('#T_dp').text(t_dp)

            var t_ov=parseInt(formate.bg_overt)+parseInt($('#T_ov').text())
            var t_oc=parseInt(formate.bg_occup)+parseInt($('#T_oc').text())
            var t_va=parseInt(formate.bg_vacant)+parseInt($('#T_va').text())
            $('#T_ov').text(t_ov)
            $('#T_oc').text(t_oc) 
            $('#T_va').text(t_va)                  


            $('#nbr_over').text(newover);
            $('#nbr_occup').text(newoccup);
            $('#nbr_vacants').text(newvacant);
            $('#T-tables tbody').append(bodyadd);

                $('.del_btn').on('click',function()
            {
                $('#reloading').removeClass('reload-hidden')
                //console.log('the id is'+$(this).closest("tr").attr('id'))
                var delID=$(this).closest("tr").attr('id')
                $.ajax({
                    url:'/del_emplois',
                    type:'POST',
                    data:{
                        id_s_act:id_s_act,
                        delID:delID,
                        type_pos:'opconducteur',
                        _token: $('meta[name="csrf-token"]').attr("content"),
                        _method: "POST",
                    },
                    success:function(response)
                    {
                        if(response.code == 200)
                            {$('#reloading').addClass('reload-hidden')
                        newover=parseInt($('#nbr_over').text())-parseInt(formate.bg_overt)
                        newoccup=parseInt($('#nbr_occup').text())-parseInt(formate.bg_occup)
                        newvacant=parseInt($('#nbr_vacants').text())-parseInt(formate.bg_vacant)

                        var t_tr=parseInt($('#T_tr').text())-parseInt(formate.tr_annuel)
                        var t_pr=parseInt($('#T_pr').text())-parseInt(formate.pr_ind)
                        var t_dp=parseInt($('#T_dp').text())-parseInt(formate.depn_annuel)
                        $('#T_tr').text(t_tr)
                        $('#T_pr').text(t_pr)                   
                        $('#T_dp').text(t_dp)
            
                        var t_ov=parseInt($('#T_ov').text())-parseInt(formate.bg_overt)
                        var t_oc=parseInt($('#T_oc').text())-parseInt(formate.bg_occup)
                        var t_va=parseInt($('#T_va').text())-parseInt(formate.bg_vacant)
                        $('#T_ov').text(t_ov)
                        $('#T_oc').text(t_oc) 
                        $('#T_va').text(t_va)

                      // //console.log('new'+$('#nbr_over').text()+" - "+$(this).closest("tr").find("td").eq(1).text()+"="+newover)
                       $('#'+delID).remove();   
                       $('#nbr_over').text(newover);
                       $('#nbr_occup').text(newoccup);
                       $('#nbr_vacants').text(newvacant);
                        }
                    },
                    error: function (response) {
                        alert('error')
                        $('#reloading').addClass('reload-hidden')
                       
                    }
                })
                
            })

        }
        else
        {
           $('#reloading').addClass('reload-hidden')
        }
    },
    error: function (response) {
        alert('error')
        $('#reloading').addClass('reload-hidden')
       
    }
    })

            $('.Tsop_handler').addClass('Tsop_handler_h')
            $('#Tport-vals').empty()
            $('.Tsop_handler').empty();
        })

        $('#cancel_ops').click(function(){
            $('.change_app').empty()
            $('.Tsop_handler').addClass('Tsop_handler_h')
            $('#Tport-vals').empty()
            $('.Tsop_handler').empty();
            alert('cancel op')
        })
    })

    }
      
})


/**
 * 
 * CDD
 */

$('#cdd').on('click',function()
{
   
    $('#reloading').removeClass('reload-hidden')
    $('.ports_info').css('display','none')
    $('.Budget_info').css('display','')
    var currentYear = new Date().getFullYear(); 
    var headBF='  <tr>'+
    ' <th> ADMINISTRATION CENTRALE (SERVICES CENTRAUX)</th>'+
     '<th colspan="3"> EMPLOIS BUDGETAIRES</th>'+
     '<th colspan="5"> REMUNERATION</th>'+
  ' </tr>'+
   '<tr>'+
     '<th> Catégorie du personnel</th>'+
     '<th> Ouverts (' + currentYear + ')  </th>'+
     '<th> Occupés au 31 décembre </th>'+
     '<th>Vacants ou excédent</th>'+
     '<th colspan="2"> CLASSIFICATION</th>'+
     '<th rowspan="2"> TRAITEMENT ANNUEL</th>'+
     '<th rowspan="2"> PRIMES ET INDEMNITES</th>'+
     '<th rowspan="2"> DEPENSES ANNUELLES</th>'+
   '</tr>'+
   '<tr>'+
     '<th>CDD</th>'+
     '<th id="nbr_over"> 00</th>'+
     '<th id="nbr_occup"> 00</th>'+
     '<th id="nbr_vacants"> 00</th>'+
     '<th> CATEGORIE</th>'+
     '<th> MOYENNE</th>'+
   '</tr>';

    if($(this).children().first().is(':checked') )
        {
            
            $('.btn_bg-handler').empty()
            $('#T-tables thead').empty()
            $('#T-tables tbody').empty()
            $('#T-tables tfoot').empty()
        //console.log('inside corcome');
        $('.btn_bg-handler').append(newbtn)
        $('#T-tables thead').append(headBF)

        
        $.ajax({
            url:'/getlist_cdd/'+id_s_act,
            type:'GET',
            success:function(response){
                if(response.code == 200)
                    {
                        $('#reloading').addClass('reload-hidden')
                        $('#T-tables tbody').empty();
                    response.postsup.forEach(element=>{
                    bodyadd='<tr id='+element.id_emp+'>'+
                    '<td>'+element.Nom_c_d_d_s+' </td>'+
                    '<td>'+element.EmploiesOuverts+' </td>'+
                    '<td>'+element.EmploiesOccupes+'</td>'+
                    '<td>'+element.EmploiesVacants+'</td>'+
            
                    '<td>'+element.CATEGORIE_c_d_d_s+' </td>'+
                    '<td>'+element.MOYENNE_c_d_d_s+' </td>'+
                   
                    '<td>'+element.TRAITEMENT_ANNUEL+'</td>'+
                    '<td>'+element.PRIMES_INDEMNITES+'</td>'+
                    '<td style="display: flex;align-items: center;flex-direction: row;justify-content: space-around;"><p>'+element.DEPENSES_ANNUELLES+'</p><p class="del_btn"><i class="fas fa-trash-alt"></i></p></td>';
                    $('#T-tables tbody').append(bodyadd);

                    $('#reloading').addClass('reload-hidden')
                    $('#nbr_over').text(response.totalOuverts)
                    $('#nbr_occup').text(response.totalOccupes)
                    $('#nbr_vacants').text(response.totalVacants)
                    $('.del_btn').on('click',function()
                    {
                        //console.log('the id is'+$(this).closest("tr").attr('id'))
                        var delID=$(this).closest("tr").attr('id')
                        $.ajax({
                            url:'/del_emplois',
                            type:'POST',
                            data:{
                                delID:delID,
                                type_pos:'cdd',
                                _token: $('meta[name="csrf-token"]').attr("content"),
                                _method: "POST",
                            },
                            success:function(response)
                            {
                                if(response.code == 200)
                                    {
                                newover=parseInt($('#nbr_over').text())-parseInt( element.EmploiesOuverts)
                                newoccup=parseInt($('#nbr_occup').text())-parseInt( element.EmploiesOccupes)
                                newvacant=parseInt($('#nbr_vacants').text())-parseInt( element.EmploiesVacants)


                                var t_tr=parseInt($('#T_tr').text())-parseInt(element.EmploiesOuverts)
                            var t_pr=parseInt($('#T_pr').text())-parseInt(element.EmploiesOccupes)
                            var t_dp=parseInt($('#T_dp').text())-parseInt(element.EmploiesVacants)
                                $('#T_tr').text(t_tr)
                                $('#T_pr').text(t_pr)                   
                                $('#T_dp').text(t_dp)
                    
                                var t_ov=parseInt($('#T_ov').text())-parseInt(element.TRAITEMENT_ANNUEL)
                                var t_oc=parseInt($('#T_oc').text())-parseInt(element.PRIMES_INDEMNITES)
                                var t_va=parseInt($('#T_va').text())-parseInt(element.DEPENSES_ANNUELLES)
                                $('#T_ov').text(t_ov)
                                $('#T_oc').text(t_oc) 
                                $('#T_va').text(t_va)

                              // //console.log('new'+$('#nbr_over').text()+" - "+$(this).closest("tr").find("td").eq(1).text()+"="+newover)
                               $('#'+delID).remove();   
                               $('#nbr_over').text(newover);
                               $('#nbr_occup').text(newoccup);
                               $('#nbr_vacants').text(newvacant);
                                }
                                else
                                {
                                   $('#reloading').addClass('reload-hidden')
                                }
                            }
                        })
                        
                        
                    })

                })
            }
            else
            {
               $('#reloading').addClass('reload-hidden')
            }
            },
            error: function (response) {
                alert('error')
                $('#reloading').addClass('reload-hidden')
               
            }
        })
    /**
     *  add handling button
     * */    

    $('.print_apt').on('click',function(){
        window.open('/printlist_cdd/'+id_s_act,'_blank')
    })

    $(".btn_add_budg").on('click',function(){
        
        var champ='<div class="Tsop_add_handle">'+
        '<form id="add_sops">'+
        '<div class="form-group">'+
        '<label class="desp">Corps Communs</label>'+
         '<input type="text" class="form-control" id="funt_sup" placeholder="Veuillez Entrer le Nom du CDD">'+
         '</div>'+
         '<div class="T3-ops_inpt_handle">' +
         '<div><label>EMPLOIS BUDGETAIRES Ouverts</label>'+
                  '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="bg_overt">'+
                  '<label>EMPLOIS BUDGETAIRES Occupés</label>'+
                  '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="bg_occup">'+
                  '<label>EMPLOIS BUDGETAIRES Vacants ou excédent </label>'+
                  '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="bg_vacant">'+
                  '<label>CLASSIFICATION CATEGORIE </label>'+
                  '<input type="text" class="form-control" id="cl_cat">'+
                  '<label>CLASSIFICATION MOYENNE </label>'+
                  '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="cl_moy">'+
                  '</div>'+
                  '<div>'+
                  '<label>TRAITEMENT ANNUEL</label>'+
                  '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="tr_annuel">'+
                  '<label>PRIMES ET INDEMNITES</label>'+
                  '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="pr_ind">'+
                  '<label>DEPENSES ANNUELLES</label>'+
                  '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="depn_annuel">'+
                  '</div>'+
        '</div>'+
     '</form>'+
     '<div class="Tsop_btn_handle">'+
     '<div><button  class="btn btn-primary" id="ajt"> Ajouter </button></div>'+
     '<div><button  class="btn btn-primary" id="cancel_ops"> Cancel </button></div>'+
     '</div>'+
     '</div>';
       
        $('.Tsop_handler').append(champ);
        $('.Tsop_handler').removeClass('Tsop_handler_h')    


        $('#ajt').on('click',function(){
            $('#reloading').removeClass('reload-hidden')
                var formate={
                    id_s_act:id_s_act,
                    type_pos:'cdd',
                    funt_sup:$('#funt_sup').val(),
                    bg_overt:parseInt(parseNumberWithoutCommas($('#bg_overt').val())),
                    bg_occup:parseInt(parseNumberWithoutCommas($('#bg_occup').val())),
                    bg_vacant:parseInt(parseNumberWithoutCommas($('#bg_vacant').val())),
                    cl_cat:parseInt(parseNumberWithoutCommas($('#cl_cat').val())),
                    cl_moy:parseInt(parseNumberWithoutCommas($('#cl_moy').val())),
                    tr_annuel:parseInt(parseNumberWithoutCommas($('#tr_annuel').val())),
                    pr_ind:parseInt(parseNumberWithoutCommas($('#pr_ind').val())),
                    depn_annuel:parseInt(parseNumberWithoutCommas($('#depn_annuel').val())),
                    code_t1:10000,
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    _method: "POST",
                }
                //console.log('befor ajax')
                $.ajax({
                    url:'/insertemploi',
                    type:'POST',
                    data:formate,
                    success:function(response)
                    {
                        if(response.code == 200)
                            {
                                $('#reloading').addClass('reload-hidden')   
                        //console.log('consl'+response.id_emp)
                        $('#reloading').addClass('reload-hidden')
                        id_empl=response.id_emp
              
                //console.log('tesign'+id_empl)
            var bodyadd='<tr id='+id_empl+'>'+
            '<td>'+formate.funt_sup+' </td>'+
            '<td>'+formate.bg_overt+' </td>'+
            '<td>'+formate.bg_occup+'</td>'+
            '<td>'+formate.bg_vacant+'</td>'+
    
            '<td>'+formate.cl_cat+' </td>'+
            '<td>'+formate.cl_moy+' </td>'+
           
            '<td>'+formate.tr_annuel+'</td>'+
            '<td>'+formate.pr_ind+'</td>'+
            '<td style="display: flex;align-items: center;flex-direction: row;justify-content: space-around;"><p>'+formate.depn_annuel+'</p><p class="del_btn"><i class="fas fa-trash-alt"></i></p></td>';
           
           
            var newover=parseInt(formate.bg_overt)+parseInt($('#nbr_over').text())
            var newoccup=parseInt(formate.bg_occup)+parseInt($('#nbr_occup').text())
            var newvacant=parseInt(formate.bg_vacant)+parseInt($('#nbr_vacants').text())
            
            var t_tr=parseInt(formate.tr_annuel)+parseInt($('#T_tr').text())
            var t_pr=parseInt(formate.pr_ind)+parseInt($('#T_pr').text())
            var t_dp=parseInt(formate.depn_annuel)+parseInt($('#T_dp').text())
            $('#T_tr').text(t_tr)
            $('#T_pr').text(t_pr)                   
            $('#T_dp').text(t_dp)

            var t_ov=parseInt(formate.bg_overt)+parseInt($('#T_ov').text())
            var t_oc=parseInt(formate.bg_occup)+parseInt($('#T_oc').text())
            var t_va=parseInt(formate.bg_vacant)+parseInt($('#T_va').text())
            $('#T_ov').text(t_ov)
            $('#T_oc').text(t_oc) 
            $('#T_va').text(t_va)                  


            $('#nbr_over').text(newover);
            $('#nbr_occup').text(newoccup);
            $('#nbr_vacants').text(newvacant);
            $('#T-tables tbody').append(bodyadd);

                $('.del_btn').on('click',function()
            {
                $('#reloading').removeClass('reload-hidden')
                //console.log('the id is'+$(this).closest("tr").attr('id'))
                var delID=$(this).closest("tr").attr('id')
                $.ajax({
                    url:'/del_emplois',
                    type:'POST',
                    data:{
                        id_s_act:id_s_act,
                        delID:delID,
                        type_pos:'cdd',
                        _token: $('meta[name="csrf-token"]').attr("content"),
                        _method: "POST",
                    },
                    success:function(response)
                    {
                        if(response.code == 200)
                            {$('#reloading').addClass('reload-hidden')
                        newover=parseInt($('#nbr_over').text())-parseInt(formate.bg_overt)
                        newoccup=parseInt($('#nbr_occup').text())-parseInt(formate.bg_occup)
                        newvacant=parseInt($('#nbr_vacants').text())-parseInt(formate.bg_vacant)

                        var t_tr=parseInt($('#T_tr').text())-parseInt(formate.tr_annuel)
                        var t_pr=parseInt($('#T_pr').text())-parseInt(formate.pr_ind)
                        var t_dp=parseInt($('#T_dp').text())-parseInt(formate.depn_annuel)
                        $('#T_tr').text(t_tr)
                        $('#T_pr').text(t_pr)                   
                        $('#T_dp').text(t_dp)
            
                        var t_ov=parseInt($('#T_ov').text())-parseInt(formate.bg_overt)
                        var t_oc=parseInt($('#T_oc').text())-parseInt(formate.bg_occup)
                        var t_va=parseInt($('#T_va').text())-parseInt(formate.bg_vacant)
                        $('#T_ov').text(t_ov)
                        $('#T_oc').text(t_oc) 
                        $('#T_va').text(t_va)

                      // //console.log('new'+$('#nbr_over').text()+" - "+$(this).closest("tr").find("td").eq(1).text()+"="+newover)
                       $('#'+delID).remove();   
                       $('#nbr_over').text(newover);
                       $('#nbr_occup').text(newoccup);
                       $('#nbr_vacants').text(newvacant);
                        }
                    },
                    error: function (response) {
                        alert('error')
                        $('#reloading').addClass('reload-hidden')
                       
                    }
                })
                
            })

        }
        else
        {
           $('#reloading').addClass('reload-hidden')
        }
    },
    error: function (response) {
        alert('error')
        $('#reloading').addClass('reload-hidden')
       
    }
    })

            $('.Tsop_handler').addClass('Tsop_handler_h')
            $('#Tport-vals').empty()
            $('.Tsop_handler').empty();
        })

        $('#cancel_ops').click(function(){
            $('.change_app').empty()
            $('.Tsop_handler').addClass('Tsop_handler_h')
            $('#Tport-vals').empty()
            $('.Tsop_handler').empty();
            alert('cancel op')
        })
    })

    }
      
})

/*
CDI
*/


$('#cdi').on('click',function()
{
   
    $('#reloading').removeClass('reload-hidden')
    $('.ports_info').css('display','none')
    $('.Budget_info').css('display','')
    var currentYear = new Date().getFullYear(); 
    var headBF='  <tr>'+
    ' <th> ADMINISTRATION CENTRALE (SERVICES CENTRAUX)</th>'+
     '<th colspan="3"> EMPLOIS BUDGETAIRES</th>'+
     '<th colspan="5"> REMUNERATION</th>'+
  ' </tr>'+
   '<tr>'+
     '<th> Catégorie du personnel</th>'+
     '<th> Ouverts (' + currentYear + ')  </th>'+
     '<th> Occupés au 31 décembre </th>'+
     '<th>Vacants ou excédent</th>'+
     '<th colspan="2"> CLASSIFICATION</th>'+
     '<th rowspan="2"> TRAITEMENT ANNUEL</th>'+
     '<th rowspan="2"> PRIMES ET INDEMNITES</th>'+
     '<th rowspan="2"> DEPENSES ANNUELLES</th>'+
   '</tr>'+
   '<tr>'+
     '<th>CDI</th>'+
     '<th id="nbr_over"> 00</th>'+
     '<th id="nbr_occup"> 00</th>'+
     '<th id="nbr_vacants"> 00</th>'+
     '<th> CATEGORIE</th>'+
     '<th> MOYENNE</th>'+
   '</tr>';

    if($(this).children().first().is(':checked') )
        {
            
            $('.btn_bg-handler').empty()
            $('#T-tables thead').empty()
            $('#T-tables tbody').empty()
            $('#T-tables tfoot').empty()
        //console.log('inside corcome');
        $('.btn_bg-handler').append(newbtn)
        $('#T-tables thead').append(headBF)

        
        $.ajax({
            url:'/getlist_cdi/'+id_s_act,
            type:'GET',
            success:function(response){
                if(response.code == 200)
                    {
                        $('#reloading').addClass('reload-hidden')
                        $('#T-tables tbody').empty();
                    response.postsup.forEach(element=>{
                    bodyadd='<tr id='+element.id_emp+'>'+
                    '<td>'+element.	Nom_c_d_i_s+' </td>'+
                    '<td>'+element.EmploiesOuverts+' </td>'+
                    '<td>'+element.EmploiesOccupes+'</td>'+
                    '<td>'+element.EmploiesVacants+'</td>'+
            
                    '<td>'+element.CATEGORIE_c_d_i_s+' </td>'+
                    '<td>'+element.MOYENNE_c_d_i_s+' </td>'+
                   
                    '<td>'+element.TRAITEMENT_ANNUEL+'</td>'+
                    '<td>'+element.PRIMES_INDEMNITES+'</td>'+
                    '<td style="display: flex;align-items: center;flex-direction: row;justify-content: space-around;"><p>'+element.DEPENSES_ANNUELLES+'</p><p class="del_btn"><i class="fas fa-trash-alt"></i></p></td>';
                    $('#T-tables tbody').append(bodyadd);

                    $('#reloading').addClass('reload-hidden')
                    $('#nbr_over').text(response.totalOuverts)
                    $('#nbr_occup').text(response.totalOccupes)
                    $('#nbr_vacants').text(response.totalVacants)
                    $('.del_btn').on('click',function()
                    {
                        //console.log('the id is'+$(this).closest("tr").attr('id'))
                        var delID=$(this).closest("tr").attr('id')
                        $.ajax({
                            url:'/del_emplois',
                            type:'POST',
                            data:{
                                delID:delID,
                                type_pos:'cdi',
                                _token: $('meta[name="csrf-token"]').attr("content"),
                                _method: "POST",
                            },
                            success:function(response)
                            {
                                if(response.code == 200)
                                    {
                                newover=parseInt($('#nbr_over').text())-parseInt( element.EmploiesOuverts)
                                newoccup=parseInt($('#nbr_occup').text())-parseInt( element.EmploiesOccupes)
                                newvacant=parseInt($('#nbr_vacants').text())-parseInt( element.EmploiesVacants)


                                var t_tr=parseInt($('#T_tr').text())-parseInt(element.EmploiesOuverts)
                            var t_pr=parseInt($('#T_pr').text())-parseInt(element.EmploiesOccupes)
                            var t_dp=parseInt($('#T_dp').text())-parseInt(element.EmploiesVacants)
                                $('#T_tr').text(t_tr)
                                $('#T_pr').text(t_pr)                   
                                $('#T_dp').text(t_dp)
                    
                                var t_ov=parseInt($('#T_ov').text())-parseInt(element.TRAITEMENT_ANNUEL)
                                var t_oc=parseInt($('#T_oc').text())-parseInt(element.PRIMES_INDEMNITES)
                                var t_va=parseInt($('#T_va').text())-parseInt(element.DEPENSES_ANNUELLES)
                                $('#T_ov').text(t_ov)
                                $('#T_oc').text(t_oc) 
                                $('#T_va').text(t_va)

                              // //console.log('new'+$('#nbr_over').text()+" - "+$(this).closest("tr").find("td").eq(1).text()+"="+newover)
                               $('#'+delID).remove();   
                               $('#nbr_over').text(newover);
                               $('#nbr_occup').text(newoccup);
                               $('#nbr_vacants').text(newvacant);
                                }
                                else
                                {
                                   $('#reloading').addClass('reload-hidden')
                                }
                            }
                        })
                        
                        
                    })

                })
            }
            else
            {
               $('#reloading').addClass('reload-hidden')
            }
            },
            error: function (response) {
                alert('error')
                $('#reloading').addClass('reload-hidden')
               
            }
        })
    /**
     *  add handling button
     * */    

    $('.print_apt').on('click',function(){
        window.open('/printlist_cdi/'+id_s_act,'_blank')
    })

    $(".btn_add_budg").on('click',function(){
        
        var champ='<div class="Tsop_add_handle">'+
        '<form id="add_sops">'+
        '<div class="form-group">'+
        '<label class="desp">CDI</label>'+
         '<input type="text" class="form-control" id="funt_sup" placeholder="Veuillez Entrer le Nom du CDI">'+
         '</div>'+
         '<div class="T3-ops_inpt_handle">' +
         '<div><label>EMPLOIS BUDGETAIRES Ouverts</label>'+
                  '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="bg_overt">'+
                  '<label>EMPLOIS BUDGETAIRES Occupés</label>'+
                  '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="bg_occup">'+
                  '<label>EMPLOIS BUDGETAIRES Vacants ou excédent </label>'+
                  '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="bg_vacant">'+
                  '<label>CLASSIFICATION CATEGORIE </label>'+
                  '<input type="text" class="form-control" id="cl_cat">'+
                  '<label>CLASSIFICATION MOYENNE </label>'+
                  '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="cl_moy">'+
                  '</div>'+
                  '<div>'+
                  '<label>TRAITEMENT ANNUEL</label>'+
                  '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="tr_annuel">'+
                  '<label>PRIMES ET INDEMNITES</label>'+
                  '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="pr_ind">'+
                  '<label>DEPENSES ANNUELLES</label>'+
                  '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="depn_annuel">'+
                  '</div>'+
        '</div>'+
     '</form>'+
     '<div class="Tsop_btn_handle">'+
     '<div><button  class="btn btn-primary" id="ajt"> Ajouter </button></div>'+
     '<div><button  class="btn btn-primary" id="cancel_ops"> Cancel </button></div>'+
     '</div>'+
     '</div>';
       
        $('.Tsop_handler').append(champ);
        $('.Tsop_handler').removeClass('Tsop_handler_h')    


        $('#ajt').on('click',function(){
            $('#reloading').removeClass('reload-hidden')
                var formate={
                    id_s_act:id_s_act,
                    type_pos:'cdi',
                    funt_sup:$('#funt_sup').val(),
                    bg_overt:parseInt(parseNumberWithoutCommas($('#bg_overt').val())),
                    bg_occup:parseInt(parseNumberWithoutCommas($('#bg_occup').val())),
                    bg_vacant:parseInt(parseNumberWithoutCommas($('#bg_vacant').val())),
                    cl_cat:parseInt(parseNumberWithoutCommas($('#cl_cat').val())),
                    cl_moy:parseInt(parseNumberWithoutCommas($('#cl_moy').val())),
                    tr_annuel:parseInt(parseNumberWithoutCommas($('#tr_annuel').val())),
                    pr_ind:parseInt(parseNumberWithoutCommas($('#pr_ind').val())),
                    depn_annuel:parseInt(parseNumberWithoutCommas($('#depn_annuel').val())),
                    code_t1:10000,
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    _method: "POST",
                }
                //console.log('befor ajax')
                $.ajax({
                    url:'/insertemploi',
                    type:'POST',
                    data:formate,
                    success:function(response)
                    {
                        if(response.code == 200)
                            {
                                $('#reloading').addClass('reload-hidden')   
                        //console.log('consl'+response.id_emp)
                        $('#reloading').addClass('reload-hidden')
                        id_empl=response.id_emp
              
                //console.log('tesign'+id_empl)
            var bodyadd='<tr id='+id_empl+'>'+
            '<td>'+formate.funt_sup+' </td>'+
            '<td>'+formate.bg_overt+' </td>'+
            '<td>'+formate.bg_occup+'</td>'+
            '<td>'+formate.bg_vacant+'</td>'+
    
            '<td>'+formate.cl_cat+' </td>'+
            '<td>'+formate.cl_moy+' </td>'+
           
            '<td>'+formate.tr_annuel+'</td>'+
            '<td>'+formate.pr_ind+'</td>'+
            '<td style="display: flex;align-items: center;flex-direction: row;justify-content: space-around;"><p>'+formate.depn_annuel+'</p><p class="del_btn"><i class="fas fa-trash-alt"></i></p></td>';
           
           
            var newover=parseInt(formate.bg_overt)+parseInt($('#nbr_over').text())
            var newoccup=parseInt(formate.bg_occup)+parseInt($('#nbr_occup').text())
            var newvacant=parseInt(formate.bg_vacant)+parseInt($('#nbr_vacants').text())
            
            var t_tr=parseInt(formate.tr_annuel)+parseInt($('#T_tr').text())
            var t_pr=parseInt(formate.pr_ind)+parseInt($('#T_pr').text())
            var t_dp=parseInt(formate.depn_annuel)+parseInt($('#T_dp').text())
            $('#T_tr').text(t_tr)
            $('#T_pr').text(t_pr)                   
            $('#T_dp').text(t_dp)

            var t_ov=parseInt(formate.bg_overt)+parseInt($('#T_ov').text())
            var t_oc=parseInt(formate.bg_occup)+parseInt($('#T_oc').text())
            var t_va=parseInt(formate.bg_vacant)+parseInt($('#T_va').text())
            $('#T_ov').text(t_ov)
            $('#T_oc').text(t_oc) 
            $('#T_va').text(t_va)                  


            $('#nbr_over').text(newover);
            $('#nbr_occup').text(newoccup);
            $('#nbr_vacants').text(newvacant);
            $('#T-tables tbody').append(bodyadd);

                $('.del_btn').on('click',function()
            {
                $('#reloading').removeClass('reload-hidden')
                //console.log('the id is'+$(this).closest("tr").attr('id'))
                var delID=$(this).closest("tr").attr('id')
                $.ajax({
                    url:'/del_emplois',
                    type:'POST',
                    data:{
                        id_s_act:id_s_act,
                        delID:delID,
                        type_pos:'cdi',
                        _token: $('meta[name="csrf-token"]').attr("content"),
                        _method: "POST",
                    },
                    success:function(response)
                    {
                        if(response.code == 200)
                            {$('#reloading').addClass('reload-hidden')
                        newover=parseInt($('#nbr_over').text())-parseInt(formate.bg_overt)
                        newoccup=parseInt($('#nbr_occup').text())-parseInt(formate.bg_occup)
                        newvacant=parseInt($('#nbr_vacants').text())-parseInt(formate.bg_vacant)

                        var t_tr=parseInt($('#T_tr').text())-parseInt(formate.tr_annuel)
                        var t_pr=parseInt($('#T_pr').text())-parseInt(formate.pr_ind)
                        var t_dp=parseInt($('#T_dp').text())-parseInt(formate.depn_annuel)
                        $('#T_tr').text(t_tr)
                        $('#T_pr').text(t_pr)                   
                        $('#T_dp').text(t_dp)
            
                        var t_ov=parseInt($('#T_ov').text())-parseInt(formate.bg_overt)
                        var t_oc=parseInt($('#T_oc').text())-parseInt(formate.bg_occup)
                        var t_va=parseInt($('#T_va').text())-parseInt(formate.bg_vacant)
                        $('#T_ov').text(t_ov)
                        $('#T_oc').text(t_oc) 
                        $('#T_va').text(t_va)

                      // //console.log('new'+$('#nbr_over').text()+" - "+$(this).closest("tr").find("td").eq(1).text()+"="+newover)
                       $('#'+delID).remove();   
                       $('#nbr_over').text(newover);
                       $('#nbr_occup').text(newoccup);
                       $('#nbr_vacants').text(newvacant);
                        }
                    },
                    error: function (response) {
                        alert('error')
                        $('#reloading').addClass('reload-hidden')
                       
                    }
                })
                
            })

        }
        else
        {
           $('#reloading').addClass('reload-hidden')
        }
    },
    error: function (response) {
        alert('error')
        $('#reloading').addClass('reload-hidden')
       
    }
    })

            $('.Tsop_handler').addClass('Tsop_handler_h')
            $('#Tport-vals').empty()
            $('.Tsop_handler').empty();
        })

        $('#cancel_ops').click(function(){
            $('.change_app').empty()
            $('.Tsop_handler').addClass('Tsop_handler_h')
            $('#Tport-vals').empty()
            $('.Tsop_handler').empty();
            alert('cancel op')
        })
    })

    }
      
})


/**
 * corcom
 */
$('#corcom').on('click',function()
{
   
    $('#reloading').removeClass('reload-hidden')
    $('.ports_info').css('display','none')
    $('.Budget_info').css('display','')
    var currentYear = new Date().getFullYear(); 
    var headBF='  <tr>'+
    ' <th> ADMINISTRATION CENTRALE (SERVICES CENTRAUX)</th>'+
     '<th colspan="3"> EMPLOIS BUDGETAIRES</th>'+
     '<th colspan="5"> REMUNERATION</th>'+
  ' </tr>'+
   '<tr>'+
     '<th> Catégorie du personnel</th>'+
     '<th> Ouverts (' + currentYear + ')  </th>'+
     '<th> Occupés au 31 décembre </th>'+
     '<th>Vacants ou excédent</th>'+
     '<th colspan="2"> CLASSIFICATION</th>'+
     '<th rowspan="2"> TRAITEMENT ANNUEL</th>'+
     '<th rowspan="2"> PRIMES ET INDEMNITES</th>'+
     '<th rowspan="2"> DEPENSES ANNUELLES</th>'+
   '</tr>'+
   '<tr>'+
     '<th>Corps Communs</th>'+
     '<th id="nbr_over"> 00</th>'+
     '<th id="nbr_occup"> 00</th>'+
     '<th id="nbr_vacants"> 00</th>'+
     '<th> CATEGORIE</th>'+
     '<th> MOYENNE</th>'+
   '</tr>';

    if($(this).children().first().is(':checked') )
        {
            
            $('.btn_bg-handler').empty()
            $('#T-tables thead').empty()
            $('#T-tables tbody').empty()
            $('#T-tables tfoot').empty()
        //console.log('inside corcome');
        $('.btn_bg-handler').append(newbtn)
        $('#T-tables thead').append(headBF)

        
        $.ajax({
            url:'/getlist_PostCommuns/'+id_s_act,
            type:'GET',
            success:function(response){
                if(response.code == 200)
                    {
                        $('#reloading').addClass('reload-hidden')
                        $('#T-tables tbody').empty();
                    response.postsup.forEach(element=>{
                    bodyadd='<tr id='+element.id_emp+'>'+
                    '<td>'+element.Nom_post+' </td>'+
                    '<td>'+element.EmploiesOuverts+' </td>'+
                    '<td>'+element.EmploiesOccupes+'</td>'+
                    '<td>'+element.EmploiesVacants+'</td>'+
            
                    '<td>'+element.CATEGORIE_post+' </td>'+
                    '<td>'+element.MOYENNE_post+' </td>'+
                   
                    '<td>'+element.TRAITEMENT_ANNUEL+'</td>'+
                    '<td>'+element.PRIMES_INDEMNITES+'</td>'+
                    '<td style="display: flex;align-items: center;flex-direction: row;justify-content: space-around;"><p>'+element.DEPENSES_ANNUELLES+'</p><p class="del_btn"><i class="fas fa-trash-alt"></i></p></td>';
                    $('#T-tables tbody').append(bodyadd);

                    $('#reloading').addClass('reload-hidden')
                    $('#nbr_over').text(response.totalOuverts)
                    $('#nbr_occup').text(response.totalOccupes)
                    $('#nbr_vacants').text(response.totalVacants)
                    $('.del_btn').on('click',function()
                    {
                        //console.log('the id is'+$(this).closest("tr").attr('id'))
                        var delID=$(this).closest("tr").attr('id')
                        $.ajax({
                            url:'/del_emplois',
                            type:'POST',
                            data:{
                                delID:delID,
                                type_pos:'corcom',
                                _token: $('meta[name="csrf-token"]').attr("content"),
                                _method: "POST",
                            },
                            success:function(response)
                            {
                                if(response.code == 200)
                                    {
                                newover=parseInt($('#nbr_over').text())-parseInt( element.EmploiesOuverts)
                                newoccup=parseInt($('#nbr_occup').text())-parseInt( element.EmploiesOccupes)
                                newvacant=parseInt($('#nbr_vacants').text())-parseInt( element.EmploiesVacants)


                                var t_tr=parseInt($('#T_tr').text())-parseInt(element.EmploiesOuverts)
                            var t_pr=parseInt($('#T_pr').text())-parseInt(element.EmploiesOccupes)
                            var t_dp=parseInt($('#T_dp').text())-parseInt(element.EmploiesVacants)
                                $('#T_tr').text(t_tr)
                                $('#T_pr').text(t_pr)                   
                                $('#T_dp').text(t_dp)
                    
                                var t_ov=parseInt($('#T_ov').text())-parseInt(element.TRAITEMENT_ANNUEL)
                                var t_oc=parseInt($('#T_oc').text())-parseInt(element.PRIMES_INDEMNITES)
                                var t_va=parseInt($('#T_va').text())-parseInt(element.DEPENSES_ANNUELLES)
                                $('#T_ov').text(t_ov)
                                $('#T_oc').text(t_oc) 
                                $('#T_va').text(t_va)

                              // //console.log('new'+$('#nbr_over').text()+" - "+$(this).closest("tr").find("td").eq(1).text()+"="+newover)
                               $('#'+delID).remove();   
                               $('#nbr_over').text(newover);
                               $('#nbr_occup').text(newoccup);
                               $('#nbr_vacants').text(newvacant);
                                }
                                else
                                {
                                   $('#reloading').addClass('reload-hidden')
                                }
                            }
                        })
                        
                        
                    })

                })
            }
            else
            {
               $('#reloading').addClass('reload-hidden')
            }
            },
            error: function (response) {
                alert('error')
                $('#reloading').addClass('reload-hidden')
               
            }
        })
    /**
     *  add handling button
     * */    

    $('.print_apt').on('click',function(){
        window.open('/printlist_commun/'+id_s_act,'_blank')
    })

    $(".btn_add_budg").on('click',function(){
        
        var champ='<div class="Tsop_add_handle">'+
        '<form id="add_sops">'+
        '<div class="form-group">'+
        '<label class="desp">Corps Communs</label>'+
         '<input type="text" class="form-control" id="funt_sup" placeholder="Veuillez Entrer le Nom du Corps Communs">'+
         '</div>'+
         '<div class="T3-ops_inpt_handle">' +
         '<div><label>EMPLOIS BUDGETAIRES Ouverts</label>'+
                  '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="bg_overt">'+
                  '<label>EMPLOIS BUDGETAIRES Occupés</label>'+
                  '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="bg_occup">'+
                  '<label>EMPLOIS BUDGETAIRES Vacants ou excédent </label>'+
                  '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="bg_vacant">'+
                  '<label>CLASSIFICATION CATEGORIE </label>'+
                  '<input type="text" class="form-control" id="cl_cat">'+
                  '<label>CLASSIFICATION MOYENNE </label>'+
                  '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="cl_moy">'+
                  '</div>'+
                  '<div>'+
                  '<label>TRAITEMENT ANNUEL</label>'+
                  '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="tr_annuel">'+
                  '<label>PRIMES ET INDEMNITES</label>'+
                  '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="pr_ind">'+
                  '<label>DEPENSES ANNUELLES</label>'+
                  '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="depn_annuel">'+
                  '</div>'+
        '</div>'+
     '</form>'+
     '<div class="Tsop_btn_handle">'+
     '<div><button  class="btn btn-primary" id="ajt"> Ajouter </button></div>'+
     '<div><button  class="btn btn-primary" id="cancel_ops"> Cancel </button></div>'+
     '</div>'+
     '</div>';
       
        $('.Tsop_handler').append(champ);
        $('.Tsop_handler').removeClass('Tsop_handler_h')    


        $('#ajt').on('click',function(){
            $('#reloading').removeClass('reload-hidden')
                var formate={
                    id_s_act:id_s_act,
                    type_pos:'corcom',
                    funt_sup:$('#funt_sup').val(),
                    bg_overt:parseInt(parseNumberWithoutCommas($('#bg_overt').val())),
                    bg_occup:parseInt(parseNumberWithoutCommas($('#bg_occup').val())),
                    bg_vacant:parseInt(parseNumberWithoutCommas($('#bg_vacant').val())),
                    cl_cat:parseInt(parseNumberWithoutCommas($('#cl_cat').val())),
                    cl_moy:parseInt(parseNumberWithoutCommas($('#cl_moy').val())),
                    tr_annuel:parseInt(parseNumberWithoutCommas($('#tr_annuel').val())),
                    pr_ind:parseInt(parseNumberWithoutCommas($('#pr_ind').val())),
                    depn_annuel:parseInt(parseNumberWithoutCommas($('#depn_annuel').val())),
                    code_t1:10000,
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    _method: "POST",
                }
                //console.log('befor ajax')
                $.ajax({
                    url:'/insertemploi',
                    type:'POST',
                    data:formate,
                    success:function(response)
                    {
                        if(response.code == 200)
                            {
                                $('#reloading').addClass('reload-hidden')   
                        //console.log('consl'+response.id_emp)
                        $('#reloading').addClass('reload-hidden')
                        id_empl=response.id_emp
              
                //console.log('tesign'+id_empl)
            var bodyadd='<tr id='+id_empl+'>'+
            '<td>'+formate.funt_sup+' </td>'+
            '<td>'+formate.bg_overt+' </td>'+
            '<td>'+formate.bg_occup+'</td>'+
            '<td>'+formate.bg_vacant+'</td>'+
    
            '<td>'+formate.cl_cat+' </td>'+
            '<td>'+formate.cl_moy+' </td>'+
           
            '<td>'+formate.tr_annuel+'</td>'+
            '<td>'+formate.pr_ind+'</td>'+
            '<td style="display: flex;align-items: center;flex-direction: row;justify-content: space-around;"><p>'+formate.depn_annuel+'</p><p class="del_btn"><i class="fas fa-trash-alt"></i></p></td>';
           
           
            var newover=parseInt(formate.bg_overt)+parseInt($('#nbr_over').text())
            var newoccup=parseInt(formate.bg_occup)+parseInt($('#nbr_occup').text())
            var newvacant=parseInt(formate.bg_vacant)+parseInt($('#nbr_vacants').text())
            
            var t_tr=parseInt(formate.tr_annuel)+parseInt($('#T_tr').text())
            var t_pr=parseInt(formate.pr_ind)+parseInt($('#T_pr').text())
            var t_dp=parseInt(formate.depn_annuel)+parseInt($('#T_dp').text())
            $('#T_tr').text(t_tr)
            $('#T_pr').text(t_pr)                   
            $('#T_dp').text(t_dp)

            var t_ov=parseInt(formate.bg_overt)+parseInt($('#T_ov').text())
            var t_oc=parseInt(formate.bg_occup)+parseInt($('#T_oc').text())
            var t_va=parseInt(formate.bg_vacant)+parseInt($('#T_va').text())
            $('#T_ov').text(t_ov)
            $('#T_oc').text(t_oc) 
            $('#T_va').text(t_va)                  


            $('#nbr_over').text(newover);
            $('#nbr_occup').text(newoccup);
            $('#nbr_vacants').text(newvacant);
            $('#T-tables tbody').append(bodyadd);

                $('.del_btn').on('click',function()
            {
                $('#reloading').removeClass('reload-hidden')
                //console.log('the id is'+$(this).closest("tr").attr('id'))
                var delID=$(this).closest("tr").attr('id')
                $.ajax({
                    url:'/del_emplois',
                    type:'POST',
                    data:{
                        id_s_act:id_s_act,
                        delID:delID,
                        type_pos:'corcom',
                        _token: $('meta[name="csrf-token"]').attr("content"),
                        _method: "POST",
                    },
                    success:function(response)
                    {
                        if(response.code == 200)
                            {$('#reloading').addClass('reload-hidden')
                        newover=parseInt($('#nbr_over').text())-parseInt(formate.bg_overt)
                        newoccup=parseInt($('#nbr_occup').text())-parseInt(formate.bg_occup)
                        newvacant=parseInt($('#nbr_vacants').text())-parseInt(formate.bg_vacant)

                        var t_tr=parseInt($('#T_tr').text())-parseInt(formate.tr_annuel)
                        var t_pr=parseInt($('#T_pr').text())-parseInt(formate.pr_ind)
                        var t_dp=parseInt($('#T_dp').text())-parseInt(formate.depn_annuel)
                        $('#T_tr').text(t_tr)
                        $('#T_pr').text(t_pr)                   
                        $('#T_dp').text(t_dp)
            
                        var t_ov=parseInt($('#T_ov').text())-parseInt(formate.bg_overt)
                        var t_oc=parseInt($('#T_oc').text())-parseInt(formate.bg_occup)
                        var t_va=parseInt($('#T_va').text())-parseInt(formate.bg_vacant)
                        $('#T_ov').text(t_ov)
                        $('#T_oc').text(t_oc) 
                        $('#T_va').text(t_va)

                      // //console.log('new'+$('#nbr_over').text()+" - "+$(this).closest("tr").find("td").eq(1).text()+"="+newover)
                       $('#'+delID).remove();   
                       $('#nbr_over').text(newover);
                       $('#nbr_occup').text(newoccup);
                       $('#nbr_vacants').text(newvacant);
                        }
                    },
                    error: function (response) {
                        alert('error')
                        $('#reloading').addClass('reload-hidden')
                       
                    }
                })
                
            })

        }
        else
        {
           $('#reloading').addClass('reload-hidden')
        }
    },
    error: function (response) {
        alert('error')
        $('#reloading').addClass('reload-hidden')
       
    }
    })

            $('.Tsop_handler').addClass('Tsop_handler_h')
            $('#Tport-vals').empty()
            $('.Tsop_handler').empty();
        })

        $('#cancel_ops').click(function(){
            $('.change_app').empty()
            $('.Tsop_handler').addClass('Tsop_handler_h')
            $('#Tport-vals').empty()
            $('.Tsop_handler').empty();
            alert('cancel op')
        })
    })

    }
      
})

$('#post_sup').on('click',function()
{
    $('#reloading').addClass('reload-hidden')
    $('#reloading').removeClass('reload-hidden')
    $('.ports_info').css('display','none')
    $('.Budget_info').css('display','')
    $('.btn_bg-handler').empty()
    $('#T-tables thead').empty()
    $('#T-tables tbody').empty()
    $('#T-tables tfoot').empty()
    var currentYear = new Date().getFullYear(); 
    var headPS='  <tr>'+
    ' <th> ADMINISTRATION CENTRALE (SERVICES CENTRAUX)</th>'+
     '<th colspan="3"> EMPLOIS BUDGETAIRES</th>'+
     '<th colspan="5"> REMUNERATION</th>'+
  ' </tr>'+
   '<tr>'+
     '<th> Catégorie du personnel</th>'+
     '<th> Ouverts (' + currentYear + ')</th>'+
     '<th> Occupés au 31 décembre </th>'+
     '<th>Vacants ou excédent</th>'+
     '<th colspan="2"> CLASSIFICATION</th>'+
     '<th rowspan="2"> BONIFICATION INDICIAIRE / MONTANT</th>'+
     '<th rowspan="2" colspan="2"> DEPENSES ANNUELLES</th>'+
   '</tr>'+
   '<tr>'+
     '<th>Poste supérieur</th>'+
     '<th id="nbr_over"> 00</th>'+
     '<th id="nbr_occup"> 00</th>'+
     '<th id="nbr_vacants"> 00</th>'+
     '<th> BONIFICATION INDICIAIRE / NIVEAU</th>'+
     '<th> BONIFICATION INDICIAIRE / POINTS</th>'+
     
   '</tr>';
    if($(this).children().first().is(':checked'))
        {
           
        //console.log('inside post sup commun')
        $('.btn_bg-handler').append(newbtn)
        $('#T-tables thead').append(headPS)

        $.ajax({
            url:'/getlist_PostSup/'+id_s_act,
            type:'GET',
            success:function(response){
                if(response.code == 200)
                    {
                        $('#T-tables tbody').empty()
                        $('#reloading').addClass('reload-hidden')
                response.postsup.forEach(element=>{
                    bodyadd='<tr id='+element.id_emp+'>'+
                    '<td>'+element.Nom_postsup+' </td>'+
                    '<td>'+element.EmploiesOuverts+' </td>'+
                    '<td>'+element.EmploiesOccupes+'</td>'+
                    '<td>'+element.EmploiesVacants+'</td>'+
            
                    '<td>'+element.Niveau_sup+' </td>'+
                    '<td>'+element.point_indsup+' </td>'+
                   
                    '<td>'+element.TRAITEMENT_ANNUEL+'</td>'+
                    '<td>'+element.PRIMES_INDEMNITES+'</td>'+
                    '<td style="display: flex;align-items: center;flex-direction: row;justify-content: space-around;"><p>'+element.DEPENSES_ANNUELLES+'</p><p class="del_btn"><i class="fas fa-trash-alt"></i></p></td>';
                    $('#T-tables tbody').append(bodyadd);

                    
                    $('#nbr_over').text(response.totalOuverts)
                    $('#nbr_occup').text(response.totalOccupes)
                    $('#nbr_vacants').text(response.totalVacants)
                    $('.del_btn').on('click',function()
                    {
                        //console.log('the id is'+$(this).closest("tr").attr('id'))
                        var delID=$(this).closest("tr").attr('id')
                        $.  ajax({
                            url:'/del_emplois',
                            type:'POST',
                            data:{
                                id_s_act:id_s_act,
                                delID:delID,
                                type_pos:'post_sup',
                                _token: $('meta[name="csrf-token"]').attr("content"),
                                _method: "POST",
                            },
                            success:function(response)
                            {
                                newover=parseInt($('#nbr_over').text())-parseInt(element.EmploiesOuverts)
                                newoccup=parseInt($('#nbr_occup').text())-parseInt(element.EmploiesOccupes)
                                newvacant=parseInt($('#nbr_vacants').text())-parseInt(element.EmploiesVacants)

                                var t_tr=parseInt($('#T_tr').text())-parseInt(element.EmploiesOuverts)
                                var t_pr=parseInt($('#T_pr').text())-parseInt(element.EmploiesOccupes)
                                var t_dp=parseInt($('#T_dp').text())-parseInt(element.EmploiesVacants)
                            $('#T_tr').text(t_tr)
                            $('#T_pr').text(t_pr)                   
                            $('#T_dp').text(t_dp)
                
                            var t_ov=parseInt($('#T_ov').text())-parseInt(element.TRAITEMENT_ANNUEL)
                            var t_oc=parseInt($('#T_oc').text())-parseInt(element.PRIMES_INDEMNITES)
                            var t_va=parseInt($('#T_va').text())-parseInt(element.DEPENSES_ANNUELLES)
                            $('#T_ov').text(t_ov)
                            $('#T_oc').text(t_oc) 
                            $('#T_va').text(t_va)

                              // //console.log('new'+$('#nbr_over').text()+" - "+$(this).closest("tr").find("td").eq(1).text()+"="+newover)
                               $("#"+delID).remove();   
                               $('#nbr_over').text(newover);
                               $('#nbr_occup').text(newoccup);
                               $('#nbr_vacants').text(newvacant);
                            },
                            error: function (response) {
                                alert('error')
                                $('#reloading').addClass('reload-hidden')
                               
                            }
                        })
                        
                        
                    })

                })
            }
            else
            {
               $('#reloading').addClass('reload-hidden')
            }
            },
            error: function (response) {
                alert('error')
                $('#reloading').addClass('reload-hidden')
               
            }
        })

        $('.print_apt').on('click',function(){
        
            window.open('/printlist_posts/'+id_s_act,'_blank')
        })

         $(".btn_add_budg").on('click',function(){
            var champ='<div class="Tsop_add_handle">'+
            '<form id="add_sops">'+
            '<div class="form-group">'+
            '<label class="desp">Poste supérieur</label>'+
             '<input type="text" class="form-control" id="funt_sup" placeholder="Veuillez Entrer le Nom du Poste supérieur">'+
             '</div>'+
             '<div class="T3-ops_inpt_handle">' +
             '<div><label>EMPLOIS BUDGETAIRES Ouverts</label>'+
                      '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="bg_overt">'+
                      '<label>EMPLOIS BUDGETAIRES Occupés</label>'+
                      '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="bg_occup">'+
                      '<label>EMPLOIS BUDGETAIRES Vacants ou excédent </label>'+
                      '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="bg_vacant">'+
                      '<label>CLASSIFICATION BONIFICATION INDICIAIRE / NIVEAU </label>'+
                      '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="cl_cat">'+
                      '<label>CLASSIFICATION BONIFICATION INDICIAIRE / POINTS </label>'+
                      '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="cl_moy">'+
                      '</div>'+
                      '<div>'+
                      '<label>BONIFICATION INDICIAIRE / MONTANT</label>'+
                      '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="tr_annuel">'+
                      '<label>DEPENSES ANNUELLES</label>'+
                      '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="pr_ind">'+
                      '<label>DEPENSES ANNUELLES</label>'+
                      '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="depn_annuel">'+
                      '</div>'+
            '</div>'+
         '</form>'+
         '<div class="Tsop_btn_handle">'+
         '<div><button  class="btn btn-primary" id="ajt"> Ajouter </button></div>'+
         '<div><button  class="btn btn-primary" id="cancel_ops"> Cancel </button></div>'+
         '</div>'+
         '</div>';
           
            $('.Tsop_handler').append(champ);
            $('.Tsop_handler').removeClass('Tsop_handler_h')    


            $('#ajt').on('click',function(){
                $('#reloading').removeClass('reload-hidden')
                    var formate={
                        id_s_act:id_s_act,
                        type_pos:'post_sup',
                        funt_sup:$('#funt_sup').val(),
                        bg_overt:parseInt(parseNumberWithoutCommas($('#bg_overt').val())),
                        bg_occup:parseInt(parseNumberWithoutCommas($('#bg_occup').val())),
                        bg_vacant:parseInt(parseNumberWithoutCommas($('#bg_vacant').val())),
                        cl_cat:parseInt(parseNumberWithoutCommas($('#cl_cat').val())),
                        cl_moy:parseInt(parseNumberWithoutCommas($('#cl_moy').val())),
                        tr_annuel:parseInt(parseNumberWithoutCommas($('#tr_annuel').val())),
                        pr_ind:parseInt(parseNumberWithoutCommas($('#pr_ind').val())),
                        depn_annuel:parseInt(parseNumberWithoutCommas($('#depn_annuel').val())),
                        code_t1:10000,
                        _token: $('meta[name="csrf-token"]').attr("content"),
                        _method: "POST",
                    }
                    $.ajax({
                        url:'/insertemploi',
                        type:'POST',
                        data:formate,
                        success:function(response)
                        {
                        
                    if(response.code == 200){
                        $('#reloading').addClass('reload-hidden')
                var bodyadd='<tr id='+response.id_emp+'>'+
                '<td>'+formate.funt_sup+' </td>'+
                '<td>'+formate.bg_overt+' </td>'+
                '<td>'+formate.bg_occup+'</td>'+
                '<td>'+formate.bg_vacant+'</td>'+
        
                '<td>'+formate.cl_cat+' </td>'+
                '<td>'+formate.cl_moy+' </td>'+
               
                '<td>'+formate.tr_annuel+'</td>'+
                '<td>'+formate.pr_ind+'</td>'+
                '<td style="display: flex;align-items: center;flex-direction: row;justify-content: space-around;"><p>'+formate.depn_annuel+'</p><p class="del_btn"><i class="fas fa-trash-alt"></i></p></td>';
                var newover=parseInt(formate.bg_overt)+parseInt($('#nbr_over').text())
                var newoccup=parseInt(formate.bg_occup)+parseInt($('#nbr_occup').text())
                var newvacant=parseInt(formate.bg_vacant)+parseInt($('#nbr_vacants').text())

                var t_tr=parseInt(formate.tr_annuel)+parseInt($('#T_tr').text())
                var t_pr=parseInt(formate.pr_ind)+parseInt($('#T_pr').text())
                var t_dp=parseInt(formate.depn_annuel)+parseInt($('#T_dp').text())
                $('#T_tr').text(t_tr)
                $('#T_pr').text(t_pr)                   
                $('#T_dp').text(t_dp)
    
                var t_ov=parseInt(formate.bg_overt)+parseInt($('#T_ov').text())
                var t_oc=parseInt(formate.bg_occup)+parseInt($('#T_oc').text())
                var t_va=parseInt(formate.bg_vacant)+parseInt($('#T_va').text())
                $('#T_ov').text(t_ov)
                $('#T_oc').text(t_oc) 
                $('#T_va').text(t_va)                  

                $('#nbr_over').text(newover);
                $('#nbr_occup').text(newoccup);
                $('#nbr_vacants').text(newvacant);
                $('#T-tables tbody').append(bodyadd);

                    $('.del_btn').on('click',function()
                {
                   
                    //console.log('the id is'+$(this).closest("tr").attr('id'))
                    var delID=$(this).closest("tr").attr('id')
                    $.  ajax({
                        url:'/del_emplois',
                        type:'POST',
                        data:{
                            id_s_act:id_s_act,
                            delID:delID,
                            type_pos:'post_sup',
                            _token: $('meta[name="csrf-token"]').attr("content"),
                            _method: "POST",
                        },
                        success:function(response)
                        {
                            newover=parseInt($('#nbr_over').text())-parseInt(formate.bg_overt)
                            newoccup=parseInt($('#nbr_occup').text())-parseInt(formate.bg_occup)
                            newvacant=parseInt($('#nbr_vacants').text())-parseInt(formate.bg_vacant)

                            var t_tr=parseInt($('#T_tr').text())-parseInt(formate.tr_annuel)
                            var t_pr=parseInt($('#T_pr').text())-parseInt(formate.pr_ind)
                            var t_dp=parseInt($('#T_dp').text())-parseInt(formate.depn_annuel)
                            $('#T_tr').text(t_tr)
                            $('#T_pr').text(t_pr)                   
                            $('#T_dp').text(t_dp)
                
                            var t_ov=parseInt($('#T_ov').text())-parseInt(formate.bg_overt)
                            var t_oc=parseInt($('#T_oc').text())-parseInt(formate.bg_occup)
                            var t_va=parseInt($('#T_va').text())-parseInt(formate.bg_vacant)
                            $('#T_ov').text(t_ov)
                            $('#T_oc').text(t_oc) 
                            $('#T_va').text(t_va)

                          // //console.log('new'+$('#nbr_over').text()+" - "+$(this).closest("tr").find("td").eq(1).text()+"="+newover)
                           $("#"+delID).remove();   
                           $('#nbr_over').text(newover);
                           $('#nbr_occup').text(newoccup);
                           $('#nbr_vacants').text(newvacant);
                        },
                        error: function (response) {
                            alert('error')
                            $('#reloading').addClass('reload-hidden')
                           
                        }
                    })
                    
                })
                    }
                    else
                    {
                       $('#reloading').addClass('reload-hidden')
                    }
                },
                error: function (response) {
                    alert('error')
                    $('#reloading').addClass('reload-hidden')
                   
                }
            })
                $('.Tsop_handler').addClass('Tsop_handler_h')
                $('#Tport-vals').empty()
                $('.Tsop_handler').empty();
            })

            $('#cancel_ops').click(function(){
                $('.change_app').empty()
                $('.Tsop_handler').addClass('Tsop_handler_h')
                $('#Tport-vals').empty()
                $('.Tsop_handler').empty();
                alert('cancel op')
            })
        })

        }
})

$('#funt').on('click',function()
{
    $('#reloading').addClass('reload-hidden')
    $('#reloading').removeClass('reload-hidden')
    $('.ports_info').css('display','none')
    $('.Budget_info').css('display','')
    $('.btn_bg-handler').empty()
    $('#T-tables thead').empty()
    $('#T-tables tbody').empty()
    $('#T-tables tfoot').empty()
    var currentYear = new Date().getFullYear(); 
    var headBF='  <tr>'+
    ' <th> ADMINISTRATION CENTRALE (SERVICES CENTRAUX)</th>'+
     '<th colspan="3"> EMPLOIS BUDGETAIRES</th>'+
     '<th colspan="5"> REMUNERATION</th>'+
  ' </tr>'+
   '<tr>'+
     '<th> Catégorie du personnel</th>'+
     '<th> Ouverts (' + currentYear + ')  </th>'+
     '<th> Occupés au 31 décembre </th>'+
     '<th>Vacants ou excédent</th>'+
     '<th colspan="2"> CLASSIFICATION</th>'+
     '<th rowspan="2"> TRAITEMENT ANNUEL</th>'+
     '<th rowspan="2"> PRIMES ET INDEMNITES</th>'+
     '<th rowspan="2"> DEPENSES ANNUELLES</th>'+
   '</tr>'+
   '<tr>'+
     '<th>Fonction supérieure</th>'+
     '<th id="nbr_over"> 00</th>'+
     '<th id="nbr_occup"> 00</th>'+
     '<th id="nbr_vacants"> 00</th>'+
     '<th> CATEGORIE</th>'+
     '<th> MOYENNE</th>'+
   '</tr>';
    if($(this).children().first().is(':checked'))
        {
      
        //console.log('inside function commun')
        $('.btn_bg-handler').append(newbtn)
        $('#T-tables thead').append(headBF)
        var bodyadd='';

            $.ajax({
                url:'/getlist_fonctions/'+id_s_act,
                type:'GET',
                success:function(response){
                    if(response.code == 200)
                        {
                            $('#reloading').addClass('reload-hidden')
                            $('#T-tables tbody').empty();
                    response.postsup.forEach(element=>{
                        bodyadd='<tr id='+element.id_emp+'>'+
                        '<td>'+element.Nom_fonction+' </td>'+
                        '<td>'+element.EmploiesOuverts+' </td>'+
                        '<td>'+element.EmploiesOccupes+'</td>'+
                        '<td>'+element.EmploiesVacants+'</td>'+
                
                        '<td>'+element.CATEGORIE+' </td>'+
                        '<td>'+element.Moyenne+' </td>'+
                       
                        '<td>'+element.TRAITEMENT_ANNUEL+'</td>'+
                        '<td>'+element.PRIMES_INDEMNITES+'</td>'+
                        '<td style="display: flex;align-items: center;flex-direction: row;justify-content: space-around;"><p>'+element.DEPENSES_ANNUELLES+'</p><p class="del_btn"><i class="fas fa-trash-alt"></i></p></td>';
                        $('#T-tables tbody').append(bodyadd);

                        
                        $('#nbr_over').text(response.totalOuverts)
                        $('#nbr_occup').text(response.totalOccupes)
                        $('#nbr_vacants').text(response.totalVacants)
                        $('.del_btn').on('click',function()
                        {
                            //console.log('the id is'+$(this).closest("tr").attr('id'))
                            var delID=$(this).closest("tr").attr('id')
                            $.  ajax({
                                url:'/del_emplois',
                                type:'POST',
                                data:{
                                    id_s_act:id_s_act,
                                    delID:delID,
                                    type_pos:'funt',
                                    _token: $('meta[name="csrf-token"]').attr("content"),
                                    _method: "POST",
                                },
                                success:function(response)
                                {
                                    newover=parseInt($('#nbr_over').text())-parseInt( element.EmploiesOuverts)
                                    newoccup=parseInt($('#nbr_occup').text())-parseInt( element.EmploiesOccupes)
                                    newvacant=parseInt($('#nbr_vacants').text())-parseInt( element.EmploiesVacants)
                                  // //console.log('new'+$('#nbr_over').text()+" - "+$(this).closest("tr").find("td").eq(1).text()+"="+newover)

                                    
                            var t_tr=parseInt($('#T_tr').text())-parseInt(element.EmploiesOuverts)
                            var t_pr=parseInt($('#T_pr').text())-parseInt(element.EmploiesOccupes)
                            var t_dp=parseInt($('#T_dp').text())-parseInt(element.EmploiesVacants)
                            $('#T_tr').text(t_tr)
                            $('#T_pr').text(t_pr)                   
                            $('#T_dp').text(t_dp)
                
                            var t_ov=parseInt($('#T_ov').text())-parseInt(element.TRAITEMENT_ANNUEL)
                            var t_oc=parseInt($('#T_oc').text())-parseInt(element.PRIMES_INDEMNITES)
                            var t_va=parseInt($('#T_va').text())-parseInt(element.DEPENSES_ANNUELLES)
                            //console.log('tv'+t_ov+'tva'+t_oc+' - '+t_va +'value original'+element.TRAITEMENT_ANNUEL+'Total'+parseInt($('#T_ov').text()))
                            $('#T_ov').text(t_ov)
                            $('#T_oc').text(t_oc) 
                            $('#T_va').text(t_va)


                                   $('#'+delID).remove();   
                                   $('#nbr_over').text(newover);
                                   $('#nbr_occup').text(newoccup);
                                   $('#nbr_vacants').text(newvacant);
                                },
                                error: function (response) {
                                    alert('error')
                                    $('#reloading').addClass('reload-hidden')
                                   
                                }
                            })
                            
                            
                        })

                    })
                }

                    else
                    {
                       $('#reloading').addClass('reload-hidden')
                    }
                },
                error: function (response) {
                    alert('error')
                    $('#reloading').addClass('reload-hidden')
                   
                }
            })
            $('.print_apt').on('click',function(){
                //console.log('print function')
                window.open('/printlist_fonctions/'+id_s_act,'_blank')
            })
            $(".btn_add_budg").on('click',function(){
                var champ='<div class="Tsop_add_handle">'+
                '<form id="add_sops">'+
                '<div class="form-group">'+
                '<label class="desp">Fonction supérieure</label>'+
                 '<input type="text" class="form-control" id="funt_sup" placeholder="Veuillez Entrer le Nom de la Fonction supérieure">'+
                 '</div>'+
                 '<div class="T3-ops_inpt_handle">' +
                 '<div><label>EMPLOIS BUDGETAIRES Ouverts</label>'+
                          '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="bg_overt">'+
                          '<label>EMPLOIS BUDGETAIRES Occupés</label>'+
                          '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="bg_occup">'+
                          '<label>EMPLOIS BUDGETAIRES Vacants ou excédent </label>'+
                          '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="bg_vacant">'+
                          '<label>CLASSIFICATION CATEGORIE </label>'+
                          '<input type="text" class="form-control" id="cl_cat">'+
                          '<label>CLASSIFICATION MOYENNE </label>'+
                          '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="cl_moy">'+
                          '</div>'+
                          '<div>'+
                          '<label>TRAITEMENT ANNUEL</label>'+
                          '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="tr_annuel">'+
                          '<label>PRIMES ET INDEMNITES</label>'+
                          '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="pr_ind">'+
                          '<label>DEPENSES ANNUELLES</label>'+
                          '<input type="text" oninput="formatAccountingFigures(this)" class="form-control" id="depn_annuel">'+
                          '</div>'+
                '</div>'+
             '</form>'+
             '<div class="Tsop_btn_handle">'+
             '<div><button  class="btn btn-primary" id="ajt"> Ajouter </button></div>'+
             '<div><button  class="btn btn-primary" id="cancel_ops"> Cancel </button></div>'+
             '</div>'+
             '</div>';
               
                $('.Tsop_handler').append(champ);
                $('.Tsop_handler').removeClass('Tsop_handler_h')    


                $('#ajt').on('click',function(){
                    $('#reloading').removeClass('reload-hidden')
                        var formate={
                            id_s_act:id_s_act,
                            type_pos:'funt',
                            funt_sup:$('#funt_sup').val(),
                            bg_overt:parseInt(parseNumberWithoutCommas($('#bg_overt').val())),
                            bg_occup:parseInt(parseNumberWithoutCommas($('#bg_occup').val())),
                            bg_vacant:parseInt(parseNumberWithoutCommas($('#bg_vacant').val())),
                            cl_cat:$('#cl_cat').val(),
                            cl_moy:parseNumberWithoutCommas($('#cl_moy').val()),
                            tr_annuel:parseInt(parseNumberWithoutCommas($('#tr_annuel').val())),
                            pr_ind:parseInt(parseNumberWithoutCommas($('#pr_ind').val())),
                            depn_annuel:parseInt(parseNumberWithoutCommas($('#depn_annuel').val())),
                            code_t1:10000,
                            _token: $('meta[name="csrf-token"]').attr("content"),
                            _method: "POST",
                        }
                        $.ajax({
                            url:'/insertemploi',
                            type:'POST',
                            data:formate,
                            success:function(response)
                            {
                                //console.log('response'+response.code)   
                    if(response.code == 200)
                        {
                            $('#reloading').addClass('reload-hidden')
                    var bodyadd='<tr id='+response.id_emp+'>'+
                    '<td>'+formate.funt_sup+' </td>'+
                    '<td>'+formate.bg_overt+' </td>'+
                    '<td>'+formate.bg_occup+'</td>'+
                    '<td>'+formate.bg_vacant+'</td>'+
            
                    '<td>'+formate.cl_cat+' </td>'+
                    '<td>'+formate.cl_moy+' </td>'+
                   
                    '<td>'+formate.tr_annuel+'</td>'+
                    '<td>'+formate.pr_ind+'</td>'+
                    '<td style="display: flex;align-items: center;flex-direction: row;justify-content: space-around;"><p>'+formate.depn_annuel+'</p><p class="del_btn"><i class="fas fa-trash-alt"></i></p></td>';
                    var newover=parseInt(formate.bg_overt)+parseInt($('#nbr_over').text())
                    var newoccup=parseInt(formate.bg_occup)+parseInt($('#nbr_occup').text())
                    var newvacant=parseInt(formate.bg_vacant)+parseInt($('#nbr_vacants').text())



                    var t_tr=parseInt(formate.tr_annuel)+parseInt($('#T_tr').text())
                    var t_pr=parseInt(formate.pr_ind)+parseInt($('#T_pr').text())
                    var t_dp=parseInt(formate.depn_annuel)+parseInt($('#T_dp').text())
                    $('#T_tr').text(t_tr)
                    $('#T_pr').text(t_pr)                   
                    $('#T_dp').text(t_dp)
        
                    var t_ov=parseInt(formate.bg_overt)+parseInt($('#T_ov').text())
                    var t_oc=parseInt(formate.bg_occup)+parseInt($('#T_oc').text())
                    var t_va=parseInt(formate.bg_vacant)+parseInt($('#T_va').text())
                    $('#T_ov').text(t_ov)
                    $('#T_oc').text(t_oc) 
                    $('#T_va').text(t_va)                  

                    $('#nbr_over').text(newover);
                    $('#nbr_occup').text(newoccup);
                    $('#nbr_vacants').text(newvacant);
                    $('#T-tables tbody').append(bodyadd);

                        $('.del_btn').on('click',function()
                    {
                        //console.log('the id is'+$(this).closest("tr").attr('id'))
                        var delID=$(this).closest("tr").attr('id')
                        $.ajax({
                            url:'/del_emplois',
                            type:'POST',
                            data:{
                                delID:delID,
                                type_pos:formate.type_pos,
                                _token: $('meta[name="csrf-token"]').attr("content"),
                                _method: "POST",
                            },
                            success:function(response)
                            {
                                newover=parseInt($('#nbr_over').text())-parseInt(formate.bg_overt)
                                newoccup=parseInt($('#nbr_occup').text())-parseInt(formate.bg_occup)
                                newvacant=parseInt($('#nbr_vacants').text())-parseInt(formate.bg_vacant)
                              // //console.log('new'+$('#nbr_over').text()+" - "+$(this).closest("tr").find("td").eq(1).text()+"="+newover)
                              /*if( (formate.tr_annuel == null || formate.tr_annuel === "" || (Array.isArray(formate.tr_annuel) && formate.tr_annuel === 0) || (typeof formate.tr_annuel === 'object' && formate.tr_annuel !== null && Object.keys(formate.tr_annuel).length === 0)) )
                              {
                              var t_tr=parseInt($('#T_tr').text())-parseInt($(this).closest("tr").find("td:eq(1)").text())
                              var t_pr=parseInt($('#T_pr').text())-parseInt($(this).closest("tr").find("td:eq(2)").text())
                              var t_dp=parseInt($('#T_dp').text())-parseInt($(this).closest("tr").find("td:eq(3)").text())
                              var t_ov=parseInt($('#T_ov').text())-parseInt($(this).closest("tr").find("td:eq(6)").text())
                              var t_oc=parseInt($('#T_oc').text())-parseInt($(this).closest("tr").find("td:eq(7)").text())
                              var t_va=parseInt($('#T_va').text())-parseInt($(this).closest("tr").find("td:eq(8)").text())
                            }
                            else
                            { }*/
                              var t_tr=parseInt($('#T_tr').text())-parseInt(formate.tr_annuel)
                              var t_pr=parseInt($('#T_pr').text())-parseInt(formate.pr_ind)
                              var t_dp=parseInt($('#T_dp').text())-parseInt(formate.depn_annuel)
                              var t_ov=parseInt($('#T_ov').text())-parseInt(formate.bg_overt)
                              var t_oc=parseInt($('#T_oc').text())-parseInt(formate.bg_occup)
                              var t_va=parseInt($('#T_va').text())-parseInt(formate.bg_vacant)
                           
                              
                              $('#T_tr').text(t_tr)
                              $('#T_pr').text(t_pr)                   
                              $('#T_dp').text(t_dp)
                  
                              $('#T_ov').text(t_ov)
                              $('#T_oc').text(t_oc) 
                              $('#T_va').text(t_va) 
                                
                               $("#"+delID).remove();   
                               $('#nbr_over').text(newover);
                               $('#nbr_occup').text(newoccup);
                               $('#nbr_vacants').text(newvacant);
                            },
                            error: function (response) {
                                alert('error')
                                $('#reloading').addClass('reload-hidden')
                               
                            }
                        })
                        
                        
                    })
                 }
                 else
                 {
                    $('#reloading').addClass('reload-hidden')
                 }
                    },
                    error: function (response) {
                        alert('error')
                        $('#reloading').addClass('reload-hidden')
                       
                    }
                        })

                    $('.Tsop_handler').addClass('Tsop_handler_h')
                    $('#Tport-vals').empty()
                    $('.Tsop_handler').empty();
                })

                $('#cancel_ops').click(function(){
                    $('.change_app').empty()
                    $('.Tsop_handler').addClass('Tsop_handler_h')
                    $('#Tport-vals').empty()
                    $('.Tsop_handler').empty();
                    alert('cancel op')
                })
            })
        }
})

$('#port_T1').on('click',function()
{   $('#reloading').addClass('reload-hidden')
    $('#reloading').removeClass('reload-hidden')
    $('.ports_info').css('display','')
    $('.Budget_info').css('display','none')
    if($(this).children().first().is(':checked') )
        {
            $('.btn_bg-handler').empty()
            $('#T-tables thead').empty()
            $('#T-tables tbody').empty()
            $('#T-tables tfoot').empty()

            if(code == 200)
                {
            $.ajax({
                url: '/testing/S_action/' + port + '/' + id_s_act + '/T1',
                type: 'GET',
                success: function (response) {
                    if (response.code === 200) {
                        
                        //console.log('data' + JSON.stringify(Object.keys(response.results)).length)
                        data_T_port = response.results;
                       tfooter='<tr><td colspan="2">Total</td>'+
                        '<td id="foot_AE_T1">' + ValAccountingFigures(data_T_port.total[0].values.totalAE) + '</td>' +
                        '<td id="foot_CP_T1">' + ValAccountingFigures(data_T_port.total[0].values.totalCP) + '</td>';
                        $('#reloading').addClass('reload-hidden')
                    }
                    else {
                        alert(response.message);
                        $('#reloading').addClass('reload-hidden')
                    }
                    $('#T-tables tfoot').append(tfooter);
                }
            })
        }
           else
        {
            $('#reloading').addClass('reload-hidden')
            $('#T-tables tfoot').append(tfooter);
        }   

            cnter++;
            //console.log('inside function commun')
       

    $('#T-tables thead').append(headT)
   
    $.getJSON(jsonpath1, function (data) {
        // Loop through each item in the JSON data
        var lengT = Object.keys(data).length
        var i = 0;
        var ig = 0;
        var io = 0;
        var iso = 0;
      //  //console.log('testing split function' + splitcode(data_T_port.group[0].code, 5)[0].substring)
      if(code !== 200)
        {
           
         
        }
        $.each(data, function (key, value) {
            // Create a table row
            let row = '<tr class="ref'+key+'" id="ref' + key + '">' +
                '<td scope="row" class="code" >' + key + '</td>' +
                '<td id="add_op" style="display: flex;align-items: center;justify-content: space-between;"><p>' + value + '</p></td>' +
                '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_T1">' + 0 + '</td>' +
                '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_T1">' + 0 + '</td>' +
                '</tr>';
                if(Object.keys(data_T_port).length > 0 ){
            if (data_T_port.group.length > 0 && data_T_port.group.length > ig) {
               var land=data_T_port.group[ig].code.length-5
                if (key == splitcode(data_T_port.group[ig].code, land)) {
                    row = '<tr class="ref'+key+'" id="ref' + data_T_port.group[ig].code + '">' +
                        '<td scope="row" class="code" >' + key + '</td>' +
                        '<td id="add_op" style="display: flex;align-items: center;justify-content: space-between;"><p>' + value + '</p></td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_T1">' +ValAccountingFigures (data_T_port.group[ig].values.ae_grpop) + '</td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_T1">' +ValAccountingFigures (data_T_port.group[ig].values.cp_grpop) + '</td>' +
                        '</tr>';
                    ig++;

                }
            }
            if (data_T_port.operation.length > 0 && data_T_port.operation.length > io) {
               var land=data_T_port.operation[io].code.length-5
                if (key == splitcode(data_T_port.operation[io].code, land)) {
                    row = '<tr class="ref'+key+'" id="ref' + data_T_port.operation[io].code + '">' +
                        '<td scope="row"  class="code" >' + key + '</td>' +
                        '<td id="add_op" style="display: flex;align-items: center;justify-content: space-between;"><p>' + value + '</p></td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_T1">' +ValAccountingFigures (data_T_port.operation[io].values.ae_op) + '</td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_T1">' +ValAccountingFigures (data_T_port.operation[io].values.cp_op) + '</td>' +
                        '</tr>';
                    io++;
                }
            }
            if (data_T_port.sousOperation.length > 0 && data_T_port.sousOperation.length > iso) {
               var land=data_T_port.sousOperation[iso].code.length-5
                if (key == splitcode(data_T_port.sousOperation[iso].code, land)) {
                    row = '<tr class="ref'+key+'" id="ref' + data_T_port.sousOperation[iso].code + '">' +
                        '<td scope="row"  class="code" >' + key + '</td>' +
                        '<td id="add_op" style="display: flex;align-items: center;justify-content: space-between;"><p>' + value + '</p></td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_T1">' +ValAccountingFigures (data_T_port.sousOperation[iso].values.ae_sousop) + '</td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_T1">' +ValAccountingFigures( data_T_port.sousOperation[iso].values.cp_sousuop )+ '</td>' +
                        '</tr>';
                    iso++;
                }
            }
}
            // Append the row to the table body

            $('#T-tables tbody').append(row);
           
            if(code !== 200)
            {
               //console.log('testing')
               Edit(id, T)
              ;
            }
            i++
            //console.log('the lengh' + lengT + 'and the pas' + i)
            if (i == lengT) {
                if ($('.ref' + key + ' td').hasClass("editable")) {
                }
            }

            if (current.length == 0) {
                current = key;
                preve = current;
            }
            else {
                current = key;
                if (current.split("0")[0].length > preve.split("0")[0].length) {
                    ////console.log('testing editable'+key)
                    $('.ref' + preve + ' td').each(function () {
                        $(this).removeClass('editable')
                    })
                    preve = current;
                }
                else {
                    //   //console.log('testing '+key)
                    if ($('.ref' + preve + ' td').hasClass("editable")) {


                    }
                    preve = current;
                }
                current = key;
            }


        });
        if(code === 200)
        {Update_dpia(T,id_s_act);
        //console.log('testing new update function')
        }
    }).fail(function () {
        console.error('Error loading JSON file.');
    });
}
})
}
function T2_table(id, T, id_s_act, port,code) {
    
$('#reloading').addClass('reload-hidden')
   $('#T-tables tfoot').empty();
    var current = new Array();
    var preve = new Array();
    var data_T_port = new Array();
    var newbtn = '<i id="new_ops" class="fas fa-folder-plus" style="font-size: 48px"></i>'
    $('#Tport-handle').addClass('scale-out');
    var tfooter='<tr><td colspan="2">Total</td>'+
    '<td  id="foot_AE_Over">'+0 + '</td>' +
    '<td  id="foot_CP_Over">'+0+ '</td>' +
    '<td  id="foot_AE_att">'+0+ '</td>' +
    '<td  id="foot_CP_att">'+0+ '</td>' +
    '<td  id="foot_AE_TT">'+0+ '</td>' +
    '<td  id="foot_CP_TT">'+0+ '</td> </tr>' ;
    setTimeout(() => {
        // Add the class to hide the table
        $('#Tport-handle').addClass('scale-hidden');
        // Optionally remove the scaling out class after hiding
        $('#Tport-handle').removeClass('scale-out');
        $('.T-handle').css('display', 'flex')
    }, 500)
if(code == 200)
    {
    $.ajax({
        url: '/testing/S_action/' + port + '/' + id_s_act + '/T2',
        type: 'GET',
        success: function (response) {
            if (response.code === 200) {
                $('#reloading').addClass('reload-hidden')
                //console.log('data' + JSON.stringify(Object.keys(response.results)).length)
                data_T_port = response.results;
               tfooter='<tr><td colspan="2">Total</td>'+
                '<td  id="foot_AE_Over">'+ValAccountingFigures(data_T_port.total[0].values.totalAEouvrtvertical) + '</td>' +
                '<td  id="foot_CP_Over">'+ValAccountingFigures(data_T_port.total[0].values.totalCPouvrtvertical) + '</td>' +
                '<td  id="foot_AE_att">'+ValAccountingFigures(data_T_port.total[0].values.totalAEattenduvertical) + '</td>' +
                '<td  id="foot_CP_att">'+ValAccountingFigures(data_T_port.total[0].values.totalCPattenduvertical) + '</td>' +
                '<td  id="foot_AE_TT">'+ValAccountingFigures(data_T_port.total[0].values.totalAE) + '</td>' +
                '<td  id="foot_CP_TT">'+ValAccountingFigures(data_T_port.total[0].values.totalCP) + '</td> </tr>' ;
                
                
            }
            else {
                alert(response.message);
            }
            $('#T-tables tfoot').append(tfooter);
        }
    })
}
else
   {
       $('#T-tables tfoot').append(tfooter);
   }

    var headT = '<tr>' +
        '<th><h1>Code</h1></th>' +
        '<th><h1>T2. DEPENSES DE FONCTIONNEMENT DES SERVICES</h1></th>' +
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
        var lengT = Object.keys(data).length
        var i = 0;
        var ig = 0;
        var io = 0;
        var iso = 0;


        $.each(data, function (key, value) {
            // Create a table row
            let row = '<tr class="ref'+key+'" id="ref' + key + '">' +
                '<td scope="row"  class="code">' + key + '</td>' +
                '<td id="add_op" style="display: flex;align-items: center; justify-content: space-between;"> <p>' + value + '</p> </td>' +
                '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_Over">' + 0 + '</td>' +
                '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_Over">' + 0 + '</td>' +
                '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_att">' + 0 + '</td>' +
                '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_att">' + 0 + '</td>' +
                '<td  class="someae" oninput="formatAccountingFigures(this)" id="AE_TT">' + 0 + '</td>' +
                '<td  class="somecp" oninput="formatAccountingFigures(this)" id="CP_TT">' + 0 + '</td>' +
                '</tr>';
            var codegr = data_T_port.group;
            var codeop = data_T_port.operation;
            var codesop = data_T_port.sousOperation;

            if(Object.keys(data_T_port).length > 0){
            if (codegr.length > 0 && data_T_port.group.length > ig) {
               var land=data_T_port.group[ig].code.length-5
                if (key == splitcode(data_T_port.group[ig].code, land)) {
                    row = '<tr class="ref' + key + '" id="ref'+data_T_port.group[ig].code+'">' +
                        '<td scope="row"  class="code">' + key + '</td>' +
                        '<td id="add_op" style="display: flex;align-items: center; justify-content: space-between;"> <p>' + value + '</p> </td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_Over">' +ValAccountingFigures( data_T_port.group[ig].values.ae_ouvert) + '</td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_Over">' +ValAccountingFigures (data_T_port.group[ig].values.cp_ouvert) + '</td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_att">' +ValAccountingFigures (data_T_port.group[ig].values.ae_attendu) + '</td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_att">' +ValAccountingFigures (data_T_port.group[ig].values.cp_attendu) + '</td>' +
                        '<td  class="someae" oninput="formatAccountingFigures(this)" id="AE_TT">' +ValAccountingFigures (data_T_port.group[ig].values.total_ae) + '</td>' +
                        '<td  class="somecp" oninput="formatAccountingFigures(this)" id="CP_TT">' +ValAccountingFigures (data_T_port.group[ig].values.total_cp) + '</td>' +
                        '</tr>';
                        //console.log('group T2'+JSON.stringify(data_T_port.group[ig].values.ae_attendu))
                    ig++
                   
                }
            }
            if (codeop.length > 0 && data_T_port.operation.length > io) {
               var land=data_T_port.operation[io].code.length-5
                if (key == splitcode(data_T_port.operation[io].code, land)) {
                    row = '<tr class="ref'+key+'" id="ref' + data_T_port.operation[io].code + '">' +
                        '<td scope="row"  class="code">' + key + '</td>' +
                        '<td id="add_op" style="display: flex;align-items: center; justify-content: space-between;"> <p>' + value + '</p> </td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_Over">' +ValAccountingFigures (data_T_port.operation[io].values.ae_ouvert) + '</td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_Over">' +ValAccountingFigures (data_T_port.operation[io].values.cp_ouvert) + '</td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_att">' +ValAccountingFigures (data_T_port.operation[io].values.ae_attendu) + '</td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_att">' +ValAccountingFigures (data_T_port.operation[io].values.cp_attendu) + '</td>' +
                        '<td  class="someae" oninput="formatAccountingFigures(this)" id="AE_TT">' +ValAccountingFigures (data_T_port.operation[io].values.total_ae) + '</td>' +
                        '<td  class="somecp" oninput="formatAccountingFigures(this)" id="CP_TT">' +ValAccountingFigures (data_T_port.operation[io].values.total_cp) + '</td>' +
                        '</tr>';
                    io++
                }
            }
            if (codesop.length > 0 && data_T_port.sousOperation.length > iso) {
               var land=data_T_port.sousOperation[iso].code.length-5
                if (key == splitcode(data_T_port.sousOperation[iso].code, land)) {
                    row = '<tr class="ref'+key+'" id="ref' + data_T_port.sousOperation[iso].code + '">' +
                        '<td scope="row"  class="code">' + key + '</td>' +
                        '<td id="add_op" style="display: flex;align-items: center; justify-content: space-between;"> <p>' + value + '</p> </td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_Over">' + ValAccountingFigures(data_T_port.sousOperation[iso].values.ae_ouvert) + '</td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_Over">' +ValAccountingFigures (data_T_port.sousOperation[iso].values.cp_ouvert) + '</td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_att">' +ValAccountingFigures (data_T_port.sousOperation[iso].values.ae_attendu) + '</td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_att">' +ValAccountingFigures (data_T_port.sousOperation[iso].values.cp_attendu) + '</td>' +
                        '<td  class="someae" oninput="formatAccountingFigures(this)" id="AE_TT">' +ValAccountingFigures( data_T_port.sousOperation[iso].values.total_ae) + '</td>' +
                        '<td  class="somecp"  oninput="formatAccountingFigures(this)" id="CP_TT">' +ValAccountingFigures( data_T_port.sousOperation[iso].values.total_cp) + '</td>' +
                        '</tr>';
                    iso++
                }
            }
}
            // Append the row to the table body
            $('#T-tables tbody').append(row);
           
            //formatAccountingFigures()
            Edit(id, T)
            if (current.length == 0) {
                current = key;
                preve = current;
            }
            else {
                current = key;
                //console.log('cuureent' + current.split("0")[0] + ' prev' + preve.split("0")[0])
                if (key.split("0")[0].length > preve.split("0")[0].length) {
                    //console.log('testing not adding' + preve)
                    $('.ref' + preve + ' td').each(function () {
                        $(this).removeClass('editable')
                    })

                }
                else {

                    //console.log('testing adding ' + preve)
                    if ($('.ref' + preve + ' td').hasClass("editable")) {
                    }

                }
                preve = current;
                current = key;
            }
            i++
            if (i == lengT) {
                if ($('.ref' + key + ' td').hasClass("editable")) {


                }
            }
        });
        if(code === 200)
           {
               
               Update_dpia(T,id_s_act);
               dataupdate=[]
           //console.log('testing new update function')
           }
    }).fail(function () {
        console.error('Error loading JSON file.');
    });
}
function T3_table(id, T, id_s_act, port,code) {
    
    $('#reloading').addClass('reload-hidden')
   $('#T-tables tfoot').empty();
    var current = new Array();
    var preve = new Array();
    var data_T_port = new Array();

    var aerTpt=0;
    var aenTpt=0;
    var aeeTpt=0;

    var cprTpt=0;
    var cpnTpt=0;
    var cpcTpt=0;
    var tfooter='<tr><td colspan="4">Total</td>'+
                '<td  id="foot_AE_rpor">'+0 + '</td>' +
                '<td  id="foot_AE_not">'+0 + '</td>' +
                '<td  id="foot_AE_enga">'+0 + '</td>' +
                '<td  id="foot_CP_rpor">'+0 + '</td>' +
                '<td  id="foot_CP_not">'+0 + '</td>' +
                '<td  id="foot_CP_consom">'+0 + '</td> </tr>' ;
    var newbtn = '<i id="new_ops" class="fas fa-folder-plus" style="font-size: 48px"></i>'
    //console.log('data is')
    $('#Tport-handle').addClass('scale-out');
    setTimeout(() => {
        // Add the class to hide the table
        $('#Tport-handle').addClass('scale-hidden');
        // Optionally remove the scaling out class after hiding
        $('#Tport-handle').removeClass('scale-out');
        $('.T-handle').css('display', 'flex')
    }, 500)
if(code == 200){
    $.ajax({
        url: '/testing/S_action/' + port + '/' + id_s_act + '/T3',
        type: 'GET',
        success: function (response) {
            if (response.code === 200) {
                $('#reloading').addClass('reload-hidden')
                //console.log('data' + JSON.stringify(Object.keys(response.results)).length)
                data_T_port = response.results;
                //console.log(data_T_port.total[0].values.totalAEnotifievertical)
                aerTpt=data_T_port.total[0].values.totalAEreportevertical
                aenTpt=data_T_port.total[0].values.totalAEnotifievertical
                aeeTpt=data_T_port.total[0].values.totalAEengagevertical
                cprTpt=data_T_port.total[0].values.totalCPreportevertical
                cpnTpt=data_T_port.total[0].values.totalCPnotifievertical
                cpcTpt=data_T_port.total[0].values.totalCPconsomevertical
               tfooter='<tr><td colspan="4">Total</td>'+
                '<td  id="foot_AE_rpor">'+ValAccountingFigures(aerTpt) + '</td>' +
                '<td  id="foot_AE_not">'+ValAccountingFigures(aenTpt) + '</td>' +
                '<td  id="foot_AE_enga">'+ValAccountingFigures(aeeTpt) + '</td>' +
                '<td  id="foot_CP_rpor">'+ValAccountingFigures(cprTpt) + '</td>' +
                '<td  id="foot_CP_not">'+ValAccountingFigures(cpnTpt) + '</td>' +
                '<td  id="foot_CP_consom">'+ValAccountingFigures(cpcTpt) + '</td> </tr>' ;
               
                
            }
            else {
                alert(response.message);
            }
            $('#T-tables tfoot').append(tfooter);
        }
    })}
    else
   {
       $('#T-tables tfoot').append(tfooter);
   }
       var lasty=parseInt(yearport) - 1
    var headT = '<tr>' +
        '<th><h1>code</h1></th>' +
        '<th><h1>T3.DEPENSES D\'INV</h1></th>' +
        '<th><h1>N° DE DECISION </h1></th>' +
        '<th><h1>INTITULE DE L\'OP</h1></th>' +
        '<th colspan="6">' +
        '<div class="fusion-father">' +
        '<h1>MONTANT ANNEE (N)</h1>' +
        '<div class="fusion-child">' +
        '<h1>AE Reportee <p>31-12-'+lasty+'</p></h1>' +
        '<h1>AE Notifiee <p>'+yearport+'<p></h1>' +
        '<h1>AE Engagee  <p>31-12-'+lasty+'</p></h1>' +
        '<h1>CP Reportes <p>31-12-'+lasty+'</p></h1>' +
        '<h1>CP Notifies <p>'+yearport+'<p></h1>' +
        '<h1>CP Consommes <p>31-12-'+lasty+'</p></h1>' +
        '</div>' +
        '</th>' +
        '</tr>';
        
      
        
    $('#T-tables thead').append(headT)

  
    $.getJSON(jsonpath3, function (data) {
        // Loop through each item in the JSON data
        var lengT = Object.keys(data).length
        var i = 0;
        var ig = 0;
        var io = 0;
        var iso = 0;
        var finder_s=true;
        $.each(data, function (key, value) {
            // Create a table row
            var val = value.split('-')

            //   //console.log('values' + JSON.stringify(val))
            let row = '<tr class="ref'+key+'" id="ref' + key + '">' +
                '<td scope="row"  class="code">' + key + '</td>' +
                '<td id="nom_ops"><p>' + val[0] + '</p> </td>' +
                '<td> - </td>' +
                '<td id="add_op" style="display: flex;align-items: center; justify-content: space-between;"><p>' + val[1] + '</p></td>' +
                '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_rpor">' + 0 + '</td>' +
                '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_not">' + 0 + '</td>' +
                '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_enga">' + 0 + '</td>' +
                '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_rpor">' + 0 + '</td>' +
                '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_not">' + 0 + '</td>' +
                '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_consom">' + 0 + '</td>' +
                '</tr>';

           
            if(Object.keys(data_T_port).length > 0){

            if (data_T_port.group.length > 0 && data_T_port.group.length > ig) {
               var land=data_T_port.group[ig].code.length-5;
               // key=splitcode(data_T_port.group[ig].code, land)
                if (key==data_T_port.group[ig].code.split('-')[6]) {
                   // //console.log(key+'keys --codes groupe'+data_T_port.group[ig].code.split('-')[6])
                    row = '<tr class="ref'+key+'" id="ref' + data_T_port.group[ig].code + '">' +
                        '<td scope="row"  class="code">' + key + '</td>' +
                        '<td id="nom_ops"><p>'+data_T_port.group[ig].nom+'</p> </td>' +
                        '<td> - </td>' +
                        '<td id="add_op" style="display: flex;align-items: center; justify-content: space-between;"><p></p></td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_rpor">' +ValAccountingFigures (data_T_port.group[ig].values.ae_reporte) + ',00</td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_not">' +ValAccountingFigures (data_T_port.group[ig].values.ae_notifie) + ',00</td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_enga">' +ValAccountingFigures (data_T_port.group[ig].values.ae_engage) + ',00</td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_rpor">' +ValAccountingFigures (data_T_port.group[ig].values.cp_reporte) + ',00</td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_not">' +ValAccountingFigures (data_T_port.group[ig].values.cp_notifie) + '</td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_consom">' +ValAccountingFigures (data_T_port.group[ig].values.cp_consome) + ',00</td>' +
                        '</tr>';
                    ig++;$('#T-tables tbody').append(row);
                }
            }
            if (data_T_port.operation.length > 0 && data_T_port.operation.length > io) {
               var land=data_T_port.operation[io].code.length-5;
              // key = splitcode(data_T_port.operation[io].code, land)
                if ( key==data_T_port.operation[io].code.split('-')[7]) {
                    //console.log(key+'keys --codes opiration'+data_T_port.operation[io].code.split('-')[7])
                    row = '<tr class="ref'+key+'" id="ref' + data_T_port.operation[io].code + '">' +
                        '<td scope="row"  class="code">' + key + '</td>' +
                        '<td id="nom_ops"><p>' + data_T_port.operation[io].nom + '</p> </td>' +
                        '<td> - </td>' +
                        '<td id="add_op" style="display: flex;align-items: center; justify-content: space-between;"><p>'+val[0]+'</p></td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_rpor">' +ValAccountingFigures (data_T_port.operation[io].values.ae_reporte) + '</td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_not">' +ValAccountingFigures (data_T_port.operation[io].values.ae_notifie) + '</td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_enga">' +ValAccountingFigures (data_T_port.operation[io].values.ae_engage) + '</td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_rpor">' +ValAccountingFigures (data_T_port.operation[io].values.cp_reporte) + '</td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_not">' +ValAccountingFigures (data_T_port.operation[io].values.cp_notifie) + '</td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_consom">' +ValAccountingFigures (data_T_port.operation[io].values.cp_consome) + '</td>' +
                        '</tr>';
                    io++;$('#T-tables tbody').append(row);
                }
            }
            if (data_T_port.sousOperation.length > 0 && data_T_port.sousOperation.length > iso) {
               var land=data_T_port.sousOperation[iso].code.length-5;
               var last=data_T_port.sousOperation[iso].code.split('-').length

                ////console.log('all'+land+' split code'+splitcode(data_T_port.sousOperation[iso].code, land)+'Key code'+key+'the last'+data_T_port.sousOperation[iso].code.split('-')[last-1])
               // key = splitcode(data_T_port.sousOperation[iso].code, land)
                if (key==data_T_port.sousOperation[iso].code.split('-')[last-1] && data_T_port.sousOperation[iso].code.split('-').length <= 9) {
                    //only_def(data_T_port.sousOperation[iso].code)
                   //console.log('code orignal')
                    var def='';
                    var nom='';
                    var int='';
                    if(data_T_port.sousOperation[iso].nom.split('_').length > 2)
                    {
                        def=data_T_port.sousOperation[iso].nom.split('_')[1]
                        nom=data_T_port.sousOperation[iso].nom.split('_')[0]
                        int=data_T_port.sousOperation[iso].nom.split('_')[2]
                    }
                    else
                    {
                        nom=data_T_port.sousOperation[iso].nom.split('_')[0]
                    }
                    row = '<tr class="ref'+key+'" id="ref' + data_T_port.sousOperation[iso].code + '">' +
                        '<td scope="row"  class="code">' + key + '</td>' +
                        '<td id="nom_ops"><p>' +  nom + '</p> </td>' +
                        '<td> '+def+' </td>' +
                        '<td id="add_op" style="display: flex;align-items: center; justify-content: space-between;"><p>' + int + '</p></td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_rpor">' +ValAccountingFigures (data_T_port.sousOperation[iso].values.ae_reporte) + '</td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_not">' +ValAccountingFigures (data_T_port.sousOperation[iso].values.ae_notifie) + '</td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_enga">' +ValAccountingFigures (data_T_port.sousOperation[iso].values.ae_engage) + '</td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_rpor">' +ValAccountingFigures (data_T_port.sousOperation[iso].values.cp_reporte) + '</td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_not">' +ValAccountingFigures (data_T_port.sousOperation[iso].values.cp_notifie) + '</td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_consom">' +ValAccountingFigures (data_T_port.sousOperation[iso].values.cp_consome) + '</td>' +
                        '</tr>';
                    iso++;$('#T-tables tbody').append(row);
                   
                   
                }
                else
                {  
                   if(data_T_port.sousOperation[iso].code.split('-').length > 9 )
                   {
                    finder_s = true;
                    //console.log('new code  '+data_T_port.sousOperation[iso].code.split('-')[last-1]+'-- -leng --- '+data_T_port.sousOperation[iso].code.split('-').length)
                    while(finder_s){
                    if(data_T_port.sousOperation[iso].code.split('-').length > 9 && key!=data_T_port.sousOperation[iso].code){
                        //console.log('new code >> '+splitcode(data_T_port.sousOperation[iso].code, land)+' >> leng >>'+data_T_port.sousOperation[iso].code.split('-').length)
                        var def='';
                        var nom='';
                        var int='';
                        if(data_T_port.sousOperation[iso].nom.split('_').length > 2)
                        {
                            def=data_T_port.sousOperation[iso].nom.split('_')[1]
                            nom=data_T_port.sousOperation[iso].nom.split('_')[0]
                            int=data_T_port.sousOperation[iso].nom.split('_')[2]
                        }
                        else
                        {
                            nom=data_T_port.sousOperation[iso].nom.split('_')[0]
                        }
                   row = '<tr class="ref'+splitcode(data_T_port.sousOperation[iso].code, land)+'" id="ref' + data_T_port.sousOperation[iso].code + '">' +
                   '<td scope="row"  class="code" style="visibility: hidden;" >' +key+"-"+splitcode(data_T_port.sousOperation[iso].code, land) + '</td>' +
                   '<td id="nom_ops">'+nom+'</td>' +
                   '<td id="def">'+def+'</td>' +
                   '<td id="sous_def" style="display: flex;align-items: center; justify-content: space-between;">'+int+'</td>' +
                   '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_rpor">' +ValAccountingFigures( data_T_port.sousOperation[iso].values.ae_reporte) + '</td>' +
                   '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_not">' +ValAccountingFigures (data_T_port.sousOperation[iso].values.ae_notifie) + '</td>' +
                   '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_enga">' +ValAccountingFigures (data_T_port.sousOperation[iso].values.ae_engage) + '</td>' +
                   '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_rpor">' +ValAccountingFigures (data_T_port.sousOperation[iso].values.cp_reporte) + '</td>' +
                   '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_not">' +ValAccountingFigures (data_T_port.sousOperation[iso].values.cp_notifie) + '</td>' +
                   '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_consom">' +ValAccountingFigures (data_T_port.sousOperation[iso].values.cp_consome) + '</td>' +
                   '</tr>';
                   //$('#T-tables tbody').append(row);
                   iso++;$('#T-tables tbody').append(row);
               }
               else
               {
                row = '<tr class="ref'+key+'" id="ref' + data_T_port.sousOperation[iso].code + '">' +
                '<td scope="row"  class="code" >' + key + '</td>' +
                '<td id="nom_ops">'  +    nom + '</td>' +
                '<td>  - </td>' +
                '<td id="add_op" style="display: flex;align-items: center; justify-content: space-between;"><p>' + int + '</p></td>' +
                '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_rpor">' +ValAccountingFigures (data_T_port.sousOperation[iso].values.ae_reporte) + '</td>' +
                '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_not">' +ValAccountingFigures (data_T_port.sousOperation[iso].values.ae_notifie) + '</td>' +
                '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_enga">' +ValAccountingFigures (data_T_port.sousOperation[iso].values.ae_engage) + '</td>' +
                '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_rpor">' +ValAccountingFigures (data_T_port.sousOperation[iso].values.cp_reporte) + '</td>' +
                '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_not">' +ValAccountingFigures (data_T_port.sousOperation[iso].values.cp_notifie) + '</td>' +
                '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_consom">' +ValAccountingFigures (data_T_port.sousOperation[iso].values.cp_consome) + '</td>' +
                '</tr>';
                finder_s = false;
               // $('#T-tables tbody').append(row);
               }
            }
           
            }
                }
                
                
            }
            
           
          
            // Append the row to the table body
            //$('#T-tables tbody').append(row);
        }
        else
        {
            $('#T-tables tbody').append(row);
        }
            if (current.length == 0) {
                current = key;
                preve = current;
            }
            else {
                current = key;
                if (key.split("0")[0].length <= 2) {
                    $('#ref' + key + ' td').each(function () {
                        $(this).removeClass('editable')
                    })
                }
                if (current.split("0")[0].length > preve.split("0")[0].length) {
                    //console.log('testing ' + preve)
                    $('.ref' + preve + ' td').each(function () {
                        $(this).removeClass('editable')
                        
                    })
                    preve = current;

                }
                else {
                    ////console.log('testing editable'+preve)
                    if ($('.ref' + preve + ' td').hasClass("editable")) {
                        $('.ref' + preve + ' #add_op').append(newbtn)
                        $('.ref' + preve + ' #add_op').on('click', function () {
                           var newKey=$(this).parent().attr('id');
                           var ads = newKey.split('ref')[1]
                           $('.Tsop_handler').removeClass('Tsop_handler_h')
                            add_newOPs_T3(ads, value, newKey,code);
                            Edit(id, T)

                        })
                    }

                    preve = current;
                }
                current = key;
            }
            
            if (i == lengT) {
                if ($('.ref' + key + ' td').hasClass("editable")) {
                    $('.ref' + key + ' #add_op').append(newbtn)
                    $('.ref' + key + ' #add_op').on('click', function () {
                       var newKey=$(this).parent().attr('id');
                       var ads = newKey.split('ref')[1] 
                       $('.Tsop_handler').removeClass('Tsop_handler_h')
                        add_newOPs_T3(ads, value, preve,code);
                        Edit(id, T)
                    })
                }
            }
            Edit(id, T)
     
        });
        if(code === 200)
        {
           
           Update_dpia(T,iupdate);
           dataupdate=[]
           //console.log('testing new update function')
        }
    }).fail(function () {
        console.error('Error loading JSON file.');
    });
    
}
function T4_table(id, T, id_s_act, port,code) {
    $('#reloading').addClass('reload-hidden')
   $('#T-tables tfoot').empty();
  
    var current = new Array();
    var preve = new Array();
    var data_T_port = new Array();
    var newbtn = '<i id="new_ops" class="fas fa-folder-plus" style="font-size: 48px"></i>'
    var tfooter='<tr><td colspan="3">Total</td>'+
    '<td id="foot_AE_T4">' + 0+ '</td>' +
    '<td id="foot_CP_T4">' + 0 + '</td>';  
    //console.log('data is')
    $('#Tport-handle').addClass('scale-out');
    setTimeout(() => {
        // Add the class to hide the table
        $('#Tport-handle').addClass('scale-hidden');
        // Optionally remove the scaling out class after hiding
        $('#Tport-handle').removeClass('scale-out');
        $('.T-handle').css('display', 'flex')
    }, 500)
    if(code === 200){
    $.ajax({
        url: '/testing/S_action/' + port + '/' + id_s_act + '/T4',
        type: 'GET',
        success: function (response) {
            if (response.code === 200) {
            
                $('#reloading').addClass('reload-hidden')
                //console.log('data' + JSON.stringify(Object.keys(response.results)).length)
                data_T_port = response.results;
               tfooter='<tr><td colspan="3">Total</td>'+
                '<td id="foot_AE_T4">' + ValAccountingFigures(data_T_port.total[0].values.totalAE) + '</td>' +
                '<td id="foot_CP_T4">' + ValAccountingFigures(data_T_port.total[0].values.totalCP) + '</td> </tr>';  

               
            }
            else {
                alert(response.message);
            }
            $('#T-tables tfoot').append(tfooter);
        }
    })
   }
   else
   {
       $('#T-tables tfoot').append(tfooter);
   }

    var headT = '<tr>' +
        '<th><h1>Code</h1></th>' +
        '<th><h1>T4. DEPENSES DE TRANSFERT</h1></th>' +
        '<th><h1>Dispositifs d\'interventions</h1></th>'+
        '<th colspan="2">' +
        '<div class="fusion-father">' +
        '<h1>MONTANT ANNEE (N)</h1>' +
        '<div class="fusion-child">' +
        '<h1>AE</h1>' +
        '<h1>CP</h1>' +
        '</div>' +
        '</div>    ' +
        '</th>' +
        '</tr>';
    $('#T-tables thead').append(headT)
    

    $.getJSON(jsonpath4, function (data) {
    var lengT = Object.keys(data).length
    var i = 0;
    var ig = 0;
    var io = 0;
    var iso = 0;
    var sousou=true
    var sop_to_op=false;
        // Loop through each item in the JSON data
        $.each(data, function (key, value) {
            // Create a table row
            var val = value.split('-')
            //   //console.log('values' + JSON.stringify(val))
            let row = '<tr class="ref'+key+'" id="ref' + key + '">' +
                '<td scope="row"  class="code">' + key + '</td>' +
                '<td><p>' + value + '</p></td>' +
                '<td  id="add_op" style="display: flex;align-items: center;justify-content: space-between;"><p>null</p></td>'+
                '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_T4">' + 0 + ',00</td>' +
                '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_T4">' + 0 + ',00</td>' +
                '</tr>';
            if(Object.keys(data_T_port).length > 0){
            if (data_T_port.group.length > 0 && data_T_port.group.length > ig) {
               var land=data_T_port.group[ig].code.length-5;
                if (key == splitcode(data_T_port.group[ig].code, land)) {
                    console.log('testing '+data_T_port.group[ig].values.ae_grpop)
                    row = '<tr class="ref'+key+'" id="ref' + data_T_port.group[ig].code + '">' +
                        '<td scope="row" class="code" >' + key + '</td>' +
                        '<td><p>' + value + '</p></td>' +

                        '<td  id="add_op" style="display: flex;align-items: center;justify-content: space-between;"><p>null</p></td>'+
                        '<td  class="editable" oninput="formatAccountingFigures(this)" id="AE_T4">' +ValAccountingFigures(data_T_port.group[ig].values.ae_grpop) + '</td>' +
                        '<td  class="editable" oninput="formatAccountingFigures(this)" id="CP_T4">' +ValAccountingFigures(data_T_port.group[ig].values.cp_grpop) + '</td>' +
                        '</tr>';
                    ig++;
                    $('#T-tables tbody').append(row);
                }
            }
            if (data_T_port.operation.length > 0 && data_T_port.operation.length > io) {
               var land=data_T_port.operation[io].code.length-5;
               ////console.log(data_T_port.operation[io].code+'-- code so split' +splitcode(data_T_port.operation[io].code, land)+'his leng'+land +"Key origin"+key)
                if (key == splitcode(data_T_port.operation[io].code, land)  ) {
                    row = '<tr class="ref'+key+'" id="ref'+ data_T_port.operation[io].code + '">' +
                        '<td scope="row" class="code" >' + key + '</td>' +
                        '<td ><p>' + value + '</p></td>' +

                        '<td id="add_op" style="display: flex;align-items: center;justify-content: space-between;"><p>null</p></td>'+
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_T4">' +ValAccountingFigures (data_T_port.operation[io].values.ae_op) + '</td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_T4">' +ValAccountingFigures (data_T_port.operation[io].values.cp_op) + '</td>' +
                        '</tr>';
                    io++;
                    $('#T-tables tbody').append(row);
            }
        }
            if (data_T_port.sousOperation.length > 0 && data_T_port.sousOperation.length > iso  ) {
               var land=data_T_port.sousOperation[iso].code.length-5;
               //&& data_T_port.operation[io]?.code !== undefined && data_T_port.sousOperation[iso]?.code !== undefined&& data_T_port.operation[io].code != data_T_port.sousOperation[iso].code
               ////console.log('T 4 sous operation'+data_T_port.operation[io].code +'!='+ data_T_port.sousOperation[iso+1].code)
                if (key == splitcode(data_T_port.sousOperation[iso].code, land) && data_T_port.operation[io]?.code !== undefined && data_T_port.sousOperation[iso]?.code !== undefined&& data_T_port.operation[io].code != data_T_port.sousOperation[iso+1].code ) {
                    ////console.log('T 4' +data_T_port.operation[io-1].code)
                    if(data_T_port.operation[io-1].code === data_T_port.sousOperation[iso].code)
                        {
                    row = '<tr class="ref'+key+'" id="ref' + data_T_port.sousOperation[iso].code + '">' +
                        '<td scope="row" class="code" >' + key + '</td>' +
                        '<td ><p>' + value + '</p></td>' +

                        '<td id="add_op" style="display: flex;align-items: center;justify-content: space-between;"><p>null</p></td>'+
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_T4">' +ValAccountingFigures (data_T_port.operation[io-1].values.ae_op) + '</td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_T4">' +ValAccountingFigures( data_T_port.operation[io-1].values.ae_op) + '</td>' +
                        '</tr>';
                       // $('#T-tables tbody').append(row);
                    }
                    else
                    {
                        row = '<tr class="ref'+key+'" id="ref' + data_T_port.sousOperation[iso].code + '">' +
                        '<td scope="row" class="code" >' + key + '</td>' +
                        '<td ><p>' + value + '</p></td>' +

                        '<td id="add_op" style="display: flex;align-items: center;justify-content: space-between;"><p>null</p></td>'+
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_T4">' +ValAccountingFigures (data_T_port.sousOperation[iso].values.ae_sousop) + '</td>' +
                        '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_T4">' +ValAccountingFigures( data_T_port.sousOperation[iso].values.cp_sousuop) + '</td>' +
                        '</tr>';
                      
                    }
                    iso++;
                    sousou=true
                    $('#T-tables tbody').append(row);
                }
                else{
                 if(data_T_port.operation[io]?.code !== undefined && data_T_port.sousOperation[iso]?.code !== undefined&& data_T_port.operation[io].code == data_T_port.sousOperation[iso+1].code)
                 {
                    //console.log('else T4')
                    iso++;
                 }
                    while (sousou) {
                        if(splitcode(data_T_port.sousOperation[iso].code, land).length < 5 )
                            {
                                console.log('else insert ')
                                only_def(data_T_port.sousOperation[iso].code)
                            row = '<tr class="ref'+data_T_port.sousOperation[iso].code+'" id="ref' + data_T_port.sousOperation[iso].code + '">' +
                            '<td scope="row" class="code" style="visibility: hidden;">'  +key+"-"+splitcode(data_T_port.sousOperation[iso].code, land)+'</td>' +
                            '<td id="def"></td>' +
                            '<td id="sous_def" ></td>'+
                            '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_T4">' +ValAccountingFigures (data_T_port.sousOperation[iso].values.ae_sousop) + '</td>' +
                            '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_T4">' +ValAccountingFigures (data_T_port.sousOperation[iso].values.cp_sousuop) + '</td>' +
                            '</tr>';
                            $('#T-tables tbody').append(row);
                          //  iso++;
                          
                        }
                    else
                    {  
                       
                        /*row = '<tr class="ref'+data_T_port.sousOperation[iso].code+'" id="ref' + data_T_port.sousOperation[iso].code +'">' +
                            '<td scope="row" class="code" >'+key+'</td>' +
                            '<td id="def">'+value+'</td>' +
                            '<td id="add_op" style="display: flex;align-items: center;justify-content: space-between;"><p>null</p></td>'+
                            '<td class="editable" oninput="formatAccountingFigures(this)" id="AE_T4">' +ValAccountingFigures (data_T_port.sousOperation[iso].values.ae_sousop) + '</td>' +
                            '<td class="editable" oninput="formatAccountingFigures(this)" id="CP_T4">' +ValAccountingFigures (data_T_port.sousOperation[iso].values.cp_sousuop) + '</td>' +
                            '</tr>';   */
                        sousou=false
                        //$('#T-tables tbody').append(row);
                    }
                    iso++; 
                    }
                  
                }
            }
            else
            {
                iso++;  
            }
           
           }
            // Append the row to the table body
           // $('#T-tables tbody').append(row);

            if (current.length == 0) {
                current = key;
                preve = current;
            }
            else {

                if (key.split("0")[0].length <= 2) {
                    $('.ref' + key + ' td').each(function () {
                        $(this).removeClass('editable')
                    })
                }
                if (current.split("0")[0].length > preve.split("0")[0].length) {
                    //console.log('testing ' + preve)
                    $('.ref' + preve + ' td').each(function () {
                        $(this).removeClass('editable')
                    })
                    preve = current;

                }
                else {
                    ////console.log('testing editable'+preve)
                    if ($('.ref' + preve + ' td').hasClass("editable")) {
                        $('.ref' + preve + ' #add_op').append(newbtn)
                        $('.ref' + preve + ' #add_op').on('click', function () {
                           var newKey=$(this).parent().attr('id');
                           var ads = newKey.split('ref')[1]
                           $('.Tsop_handler').removeClass('Tsop_handler_h')
                           //console.log('add once');
                            add_newOPs_T4(ads, value , newKey,code);
                        })
                    }

                    preve = current;
                }
                current = key;
            }
            i++;
            if (i == lengT) {
                if ($('.ref' + key + ' td').hasClass("editable")) {
                    $('.ref' + key + ' #add_op').append(newbtn)
                    $('.ref' + key + ' #add_op').on('click', function () {
                       var newKey=$(this).parent().attr('id');
                       var ads = newKey.split('ref')[1] 
                       $('.Tsop_handler').removeClass('Tsop_handler_h')
                        add_newOPs_T4(ads, value, newKey,code);
                    })
                }
            }
            if(code === 200)
                {   
                   Update_dpia('4',iupdate);
                   dataupdate=[]
                   //console.log('testing new update function')
     
                }else
                {
                    Edit(id, T)
                }
            
        });
        
    }).fail(function () {
        console.error('Error loading JSON file.');
    });
}
$(document).ready(function () { 

    $('#T1').on('click', function () {
        $('#reloading').removeClass('reload-hidden')
        $("#expExcel").css('display','none')
        $("#vide_t").css('display','none')
        var indic = path3.length - 1
        var id = $(this).attr('id');
        var T = 1;
        //console.log('len' + path3.length + ' act ' + indic)
        $.ajax({
            url: '/testing/codeSousOperation/' + ssact,
            type: 'GET',
            success: function (response) {
                if (response.code == 200 && response.t1_exists==1) {
               
                    counter=counter+10
                    alert('Existe')
                    T1_table(id, T, ssact, path3[0],response.code)
                    $('#T_port1').addClass('heilighter')
                    $('#reloading').addClass('reload-hidden')
                    $("#expExcel").css('display','block')
                    $("#vider_t").css('display','block')
                    $('#T-tables tbody').attr('id','T1_'+ssact+'')

                }
                else {
               
                    alert('Nouveau')
                    code =404
                    T1_table(id, T, ssact, path3[0],code) 
                    $('#reloading').addClass('reload-hidden')
                    $("#expExcel").css('display','block')
                    $("#vider_t").css('display','none')
                }
            }
        })
    })
    $('#T2').on('click', function () {
        $('.btn_bg-handler').empty()
        $("#expExcel").css('display','none')
        $("#vide_t").css('display','none')
        $('#reloading').removeClass('reload-hidden')
        var indic = path3.length - 1
        var T=2
        var id = $(this).attr('id');
        //console.log('len' + path3.length + ' act ' + indic)
        $.ajax({
            url: '/testing/codeSousOperation/' + ssact,
            type: 'GET',
            success: function (response) {
                if (response.code == 200 && response.t2_exists==1) {
                    alert('Existe')
                    counter=counter+10
                    $('#reloading').addClass('reload-hidden')
                    T2_table(id, T, ssact, path3[0],response.code)
                    $('#T_port2').addClass('heilighter')
                    $("#expExcel").css('display','block')
                    $("#vider_t").css('display','block')
                    $('#T-tables tbody').attr('id','T2_'+ssact+'')
                }
                else {
                    alert('Nouveau')
                    $('#reloading').addClass('reload-hidden')
                   code=404
                    T2_table(id, T, ssact, path3[0],code)
                    $("#expExcel").css('display','block')
                    $("#vider_t").css('display','none')
                }
            }
        })
        //  T2_table(id, T)
    })

    $('#T3').on('click', function () {
        $('.btn_bg-handler').empty()
        $("#expExcel").css('display','none')
        $("#vide_t").css('display','none')
        $('#reloading').removeClass('reload-hidden')
        var indic = path3.length - 1
        //console.log('len' + path3.length + ' act ' + indic)
        var id = $(this).attr('id');
        var T = 3;
        $.ajax({
            url: '/testing/codeSousOperation/' + ssact,
            type: 'GET',
            success: function (response) {
                if (response.code == 200 && response.t3_exists==1) {
                    alert('Existe')
                    counter=counter+10
                    $('#reloading').addClass('reload-hidden')
                    T3_table(id, T, ssact, path3[0],response.code)
                    $('#T_port3').addClass('heilighter')
                    $("#expExcel").css('display','block')
                    $("#vider_t").css('display','block')
                    $('#T-tables tbody').attr('id','T3_'+ssact+'')
                    $('#vider_t').on('click',function(){
                        vider_t('T3',this,ssact)
                    })
                }
                else {
                    $('#reloading').addClass('reload-hidden')
                    alert('Nouveau')
                    code =404
                    T3_table(id, T, ssact, path3[0],code)
                    $("#expExcel").css('display','block')
                    $("#vider_t").css('display','none')
                }
            }
        })
        //T3_table(id, T)
    })
    $('#T4').on('click', function () {
        $('.btn_bg-handler').empty()
        $("#expExcel").css('display','none')
        $("#vide_t").css('display','none')
        $('#reloading').removeClass('reload-hidden')
        var indic = path3.length - 1
        //console.log('len' + path3.length + ' act ' + indic)
        var id = $(this).attr('id');
        var T = 4;
        $.ajax({
            url: '/testing/codeSousOperation/' + ssact,
            type: 'GET',
            success: function (response) {
                if (response.code == 200 && response.t4_exists==1) {
                    alert('Existe')
                    counter=counter+10
                    $('#reloading').addClass('reload-hidden')
                    T4_table(id, T, ssact, path3[0],response.code)
                    $('#T_port4').addClass('heilighter')
                    $("#expExcel").css('display','block')
                    $("#vider_t").css('display','block')
                    $('#T-tables tbody').attr('id','T4_'+ssact+'')
                }
                else {
                    alert('Nouveau')
                    code =404
                    $('#reloading').addClass('reload-hidden')
                    T4_table(id, T, ssact, path3[0],code)
                    $("#expExcel").css('display','block')
                    $("#vider_t").css('display','none')
                }
            }
        })
    })
    $(".TP-handle").on('click', function () {
        $('#T-tables thead').empty()
        $('#T-tables tbody').empty()
        var indic = path3.length - 1
        var id_tport_c = $(this).attr('id');
           $(this).addClass('heilighter')
        if (id_tport_c == 'T_port1') {
            $('.btn_bg-handler').empty()
            $('#reloading').removeClass('reload-hidden')
            $('.opt_handle').empty()
            $("#expExcel").css('display','none')
            $("#vide_t").css('display','none')
           $('#T_port2').removeClass('heilighter')
           $('#T_port3').removeClass('heilighter')
           $('#T_port4').removeClass('heilighter')
            //var indic = path3.length - 1
            var id = $(this).attr('id');
            var T = 1;
            //console.log('len' + path3.length + ' act ' + indic)
            $.ajax({
                url: '/testing/codeSousOperation/' + ssact,
                type: 'GET',
                success: function (response) {
                    if (response.code == 200 && response.t1_exists==1) {
                        alert('Existe')
                        counter=counter+10
                        T1_table(id, T, ssact, path3[0],response.code)
                        $('#reloading').addClass('reload-hidden')
                        $("#expExcel").css('display','block')
                        $("#vider_t").css('display','block')
                        

                    }
                    else {
                        

                        alert('Nouveau')
                        code =404
                        T1_table(id, T, ssact, path3[0],code)
                        $('#reloading').addClass('reload-hidden')
                        $("#expExcel").css('display','block')
                        $("#vider_t").css('display','none')
                    }
                }
            })
        }
        if (id_tport_c == 'T_port2') {
            $('.btn_bg-handler').empty()
            $('#reloading').addClass('reload-hidden')
            $('#reloading').removeClass('reload-hidden')
            $('.opt_handle').empty()
            $("#expExcel").css('display','none')
            $("#vide_t").css('display','none')
           $('#T_port1').removeClass('heilighter')
           $('#T_port3').removeClass('heilighter')
           $('#T_port4').removeClass('heilighter')
           var id = $(this).attr('id');
           var T = 2;
            $.ajax({
                url: '/testing/codeSousOperation/' + ssact,
                type: 'GET',
                success: function (response) {
                    if (response.code == 200 && response.t2_exists==1) {
                        alert('Existe')
                        counter=counter+10
                        $('#reloading').addClass('reload-hidden')
                        T2_table(id, T, ssact, path3[0],response.code)
                        $("#expExcel").css('display','block')
                        $("#vider_t").css('display','block')
                        $('#T-tables tbody').attr('id','T2_'+ssact+'')
                    }
                    else {
                        $('#reloading').addClass('reload-hidden')
                        alert('Nouveau')
                               code=404
                        T2_table(id, T, ssact, path3[0],code)
                        $("#expExcel").css('display','block')
                        $("#vider_t").css('display','none')
                    }
                }
            })
        }
        if (id_tport_c == 'T_port3') {
            $('.btn_bg-handler').empty()
            $('#reloading').addClass('reload-hidden')
            $('#reloading').removeClass('reload-hidden')
            $('.opt_handle').empty()
            $("#expExcel").css('display','none')
            $("#vide_t").css('display','none')
           $('#T_port2').removeClass('heilighter')
           $('#T_port1').removeClass('heilighter')
           $('#T_port4').removeClass('heilighter')
           var id = $(this).attr('id');
           var T = 3;
            $.ajax({
                url: '/testing/codeSousOperation/' + ssact,
                type: 'GET',
                success: function (response) {
                    if (response.code == 200 && response.t3_exists==1) {
                        alert('Existe')
                        counter=counter+10
                        $('#reloading').addClass('reload-hidden')
                        T3_table(id, T, ssact, path3[0],response.code)
                        $("#expExcel").css('display','block')
                        $("#vider_t").css('display','block')
                        $('#T-tables tbody').attr('id','T3_'+ssact+'')
                        
                    }
                    else {
                        alert('Nouveau ')
                        $('#reloading').addClass('reload-hidden')
                        T3_table(id, T, ssact, path3[0],code)
                        $("#expExcel").css('display','block')
                        $("#vider_t").css('display','none')
                    }
                }
            })


        }
        if (id_tport_c == 'T_port4') {
            $('.btn_bg-handler').empty()
            $('#reloading').addClass('reload-hidden')
            $('#reloading').removeClass('reload-hidden')
            $('.opt_handle').empty()
            $("#expExcel").css('display','none')
            $("#vide_t").css('display','none')
           $('#T_port2').removeClass('heilighter')
           $('#T_port3').removeClass('heilighter')
           $('#T_port1').removeClass('heilighter')
           var id = $(this).attr('id');
           var T = 4;
            $.ajax({
                url: '/testing/codeSousOperation/' + ssact,
                type: 'GET',
                success: function (response) {
                    if (response.code == 200 && response.t4_exists==1) {
                        alert('Existe')
                        counter=counter+10
                        $('#reloading').addClass('reload-hidden')
                        T4_table(id, T, ssact, path3[0],response.code)
                        $("#expExcel").css('display','block')
                        $("#vider_t").css('display','block')
                        $('#T-tables tbody').attr('id','T4_'+ssact+'')
                    }
                    else {
                        alert('Nouveau')
                        code =404
                        $('#reloading').addClass('reload-hidden')
                        T4_table(id, T, ssact, path3[0],code)
                        $("#expExcel").css('display','block')
                        $("#vider_t").css('display','none')
                    }

                }
            })


        }
        //console.log('testign which port im ' + id_tport_c)
    })

    $('.budget_port_switch').on('click',function()
    {
       if( $('.Budget_info').css('display') =='none')
       {
        $('.ports_info').css('display','none')
        $('.Budget_info').css('display','')
       }
       else
       {
        $('.ports_info').css('display','')
        $('.Budget_info').css('display','none')
       }
    })

$('#expExcel').on('click',function()
{
    let table = document.getElementById("T-tables"); 
    let wb = XLSX.utils.book_new(); 
    let ws = XLSX.utils.table_to_sheet(table); 

    XLSX.utils.book_append_sheet(wb, ws, "Sheet1"); 
    XLSX.writeFile(wb, "table_data.xlsx");
})
$('#vider_t').on('click',function()
{
    $('#reloading').removeClass('reload-hidden')
    var ids=$('#T-tables tbody').attr('id')
    var listid=ids.split('_')
    //console.log('ids '+JSON.stringify(listid))
   vider_t(listid[0],this,listid[1]);
})
})

/**
 *
 *  this js for creation from the index
 */
preview('file')



/**
 *
 *
 *
 */
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
