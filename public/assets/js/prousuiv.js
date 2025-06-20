//console.log('testing'+JSON.stringify(path))
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
        console.log('old value'+oldTT);
    })
    $('#T1_AE_init').on('focusout',function(){
        
        console.log('old before if'+oldTT);
        if(old == 0 || old == '' || old == '0' || old == null || old =='NaN')
        {
            old='0'
        }
        if(oldTT == 0 || oldTT == '' || oldTT == '0' || oldTT == null || oldTT =='NaN' )
            {
                someAE_TT=0;
            someAE_TT+=parseNumberWithoutCommas($(this).val())
            $('#AE_sous_prog').val(ValAccountingFigures(someAE_TT))
            console.log('TT '+someAE_TT)
            }
            else
            {
            someAE_TT=parseNumberWithoutCommas(oldTT) - parseNumberWithoutCommas(old)
            console.log('TT befor addin'+someAE_TT);
            someAE_TT+=parseNumberWithoutCommas($(this).val())
            $('#AE_sous_prog').val(ValAccountingFigures(someAE_TT))
            console.log('old TT '+someAE_TT)
            }
            
    })

    $('#T2_AE_init').on('focusin',function(){
        oldTT=$('#AE_sous_prog').val();
        old=$(this).val();
        console.log('old value'+oldTT);
    })

    $('#T2_AE_init').on('focusout',function(){
        console.log('old before if'+oldTT);
        if(old == 0 || old == '' || old == '0' || old == null || old =='NaN')
            {
                old='0'
            }
        if(oldTT == 0 || oldTT == '' || oldTT == '0' || oldTT == null || oldTT =='NaN')
            {
                someAE_TT=0;
            someAE_TT+=parseNumberWithoutCommas($(this).val())
            $('#AE_sous_prog').val(ValAccountingFigures(someAE_TT))
            console.log('TT '+someAE_TT)
            }
            else
            {
                someAE_TT=parseNumberWithoutCommas(oldTT) - parseNumberWithoutCommas(old)
            console.log('TT befor addin'+someAE_TT);
            someAE_TT+=parseNumberWithoutCommas($(this).val())
            $('#AE_sous_prog').val(ValAccountingFigures(someAE_TT))
            console.log('old TT '+someAE_TT)
            }
    })

    $('#T3_AE_init').on('focusin',function(){
        oldTT=$('#AE_sous_prog').val();
        old=$(this).val();
        console.log('old value'+oldTT);
    })

    $('#T3_AE_init').on('focusout',function(){
        console.log('old before if'+oldTT);
        if(old == 0 || old == '' || old == '0' || old == null || old =='NaN')
            {
                old='0'
            }
        if(oldTT == 0 || oldTT == '' || oldTT == '0' || oldTT == null || oldTT =='NaN')
            {
                someAE_TT=0;
            someAE_TT+=parseNumberWithoutCommas($(this).val())
            $('#AE_sous_prog').val(ValAccountingFigures(someAE_TT))
            console.log('TT '+someAE_TT)
            }
            else
            {
            someAE_TT=parseNumberWithoutCommas(oldTT) - parseNumberWithoutCommas(old)
            console.log('TT befor addin'+someAE_TT);
            someAE_TT+=parseNumberWithoutCommas($(this).val())
            $('#AE_sous_prog').val(ValAccountingFigures(someAE_TT))
            console.log('old TT '+someAE_TT)
            }
    })

    $('#T4_AE_init').on('focusin',function(){
        oldTT=$('#AE_sous_prog').val();
        old=$(this).val();
        console.log('old value'+oldTT);
    })

    $('#T4_AE_init').on('focusout',function(){
        console.log('old before if'+oldTT);
        if(old == 0 || old == '' || old == '0' || old == null || old =='NaN')
            {
                old='0'
            }
        if(oldTT == 0 || oldTT == '' || oldTT == '0' || oldTT == null || oldTT =='NaN')
            {
            someAE_TT=0
            someAE_TT+=parseNumberWithoutCommas($(this).val())
            $('#AE_sous_prog').val(ValAccountingFigures(someAE_TT))
            console.log('null TT '+someAE_TT)
            }
            else
            {
            console.log('TT refresh new Value some '+someAE_TT+' old'+oldTT);
            someAE_TT=parseNumberWithoutCommas(oldTT) - parseNumberWithoutCommas(old)
            
            someAE_TT+=parseNumberWithoutCommas($(this).val())
            $('#AE_sous_prog').val(ValAccountingFigures(someAE_TT))
            console.log('old TT '+someAE_TT)
            }
    })
    /**  ------------------------------------------------------ rnf ---------------- */
    /**------------------------------------ Some CP T ----------------------------- */

    $('#T1_CP_init').on('focusin',function(){
        oldTTCP=$('#CP_sous_prog').val();
        oldCP=$(this).val();
        console.log('old value'+oldTTCP);
    })


    $('#T1_CP_init').on('focusout',function(){


        console.log('old before if'+oldTTCP);
        if(oldCP == 0 || oldCP == '' || oldCP == '0' || oldCP == null || oldCP =='NaN')
        {
            oldCP='0'
        }
        if(oldTTCP == 0 || oldTTCP == '' || oldTTCP == '0' || oldTTCP == null || oldTTCP =='NaN' )
            {
                someCP_TT=0;
            someCP_TT+=parseNumberWithoutCommas($(this).val())
            $('#CP_sous_prog').val(ValAccountingFigures(someCP_TT))
            console.log('TT '+someCP_TT)
            }
            else
            {
            someCP_TT=parseNumberWithoutCommas(oldTTCP) - parseNumberWithoutCommas(oldCP)
            console.log('TT befor addin'+someCP_TT);
            someCP_TT+=parseNumberWithoutCommas($(this).val())
            $('#CP_sous_prog').val(ValAccountingFigures(someCP_TT))
            console.log('old TT '+someCP_TT)
            }

    })

    $('#T2_CP_init').on('focusin',function(){
        oldTTCP=$('#CP_sous_prog').val();
        oldCP=$(this).val();
        console.log('old value'+oldTT);
    })


    $('#T2_CP_init').on('focusout',function(){

        console.log('old before if'+oldTTCP);
        if(oldCP == 0 || oldCP == '' || oldCP == '0' || oldCP == null || oldCP =='NaN')
        {
            oldCP='0'
        }
        if(oldTTCP == 0 || oldTTCP == '' || oldTTCP == '0' || oldTTCP == null || oldTTCP =='NaN' )
            {
                someCP_TT=0;
            someCP_TT+=parseNumberWithoutCommas($(this).val())
            $('#CP_sous_prog').val(ValAccountingFigures(someCP_TT))
            console.log('TT '+someCP_TT)
            }
            else
            {
            someCP_TT=parseNumberWithoutCommas(oldTTCP) - parseNumberWithoutCommas(oldCP)
            console.log('TT befor addin'+someCP_TT);
            someCP_TT+=parseNumberWithoutCommas($(this).val())
            $('#CP_sous_prog').val(ValAccountingFigures(someCP_TT))
            console.log('old TT '+someCP_TT)
            }
        
    })

    $('#T3_CP_init').on('focusin',function(){
        oldTTCP=$('#CP_sous_prog').val();
        oldCP=$(this).val();
        console.log('old value'+oldTTCP);
    })

    $('#T3_CP_init').on('focusout',function(){

        console.log('old before if'+oldTTCP);
        if(oldCP == 0 || oldCP == '' || oldCP == '0' || oldCP == null || oldCP =='NaN')
        {
            oldCP='0'
        }
        if(oldTTCP == 0 || oldTTCP == '' || oldTTCP == '0' || oldTTCP == null || oldTTCP =='NaN' )
            {
                someCP_TT=0;
            someCP_TT+=parseNumberWithoutCommas($(this).val())
            $('#CP_sous_prog').val(ValAccountingFigures(someCP_TT))
            console.log('TT '+someCP_TT)
            }
            else
            {
            someCP_TT=parseNumberWithoutCommas(oldTTCP) - parseNumberWithoutCommas(oldCP)
            console.log('TT befor addin'+someCP_TT);
            someCP_TT+=parseNumberWithoutCommas($(this).val())
            $('#CP_sous_prog').val(ValAccountingFigures(someCP_TT))
            console.log('old TT '+someCP_TT)
            }
        
    })

    $('#T4_CP_init').on('focusin',function(){
        oldTTCP=$('#CP_sous_prog').val();
        oldCP=$(this).val();
        console.log('old value'+oldTTCP);
    })

    $('#T4_CP_init').on('focusout',function(){

        console.log('old before if'+oldTT);
        if(oldCP == 0 || oldCP == '' || oldCP == '0' || oldCP == null || oldCP =='NaN')
        {
            oldCP='0'
        }
        if(oldTTCP == 0 || oldTTCP == '' || oldTTCP == '0' || oldTTCP == null || oldTTCP =='NaN' )
            {
            someCP_TT=0;
            someCP_TT+=parseNumberWithoutCommas($(this).val())
            $('#CP_sous_prog').val(ValAccountingFigures(someCP_TT))
            console.log('TT '+someCP_TT)
            }
            else
            {
            someCP_TT=parseNumberWithoutCommas(oldTTCP) - parseNumberWithoutCommas(oldCP)
            console.log('TT befor addin'+someCP_TT);
            someCP_TT+=parseNumberWithoutCommas($(this).val())
            $('#CP_sous_prog').val(ValAccountingFigures(someCP_TT))
            console.log('old TT '+someCP_TT)
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
        console.log('old value'+oldTT);
    })
    $('#T1_AE_init_AC').on('focusout',function(){
        
        console.log('old before if'+oldTT);
        if(old == 0 || old == '' || old == '0' || old == null || old =='NaN')
        {
            old='0'
        }
        if(oldTT == 0 || oldTT == '' || oldTT == '0' || oldTT == null || oldTT =='NaN' )
            {
                someAE_TT=0;
            someAE_TT+=parseNumberWithoutCommas($(this).val())
            $('#AE_act').val(ValAccountingFigures(someAE_TT))
            console.log('TT '+someAE_TT)
            }
            else
            {
            someAE_TT=parseNumberWithoutCommas(oldTT) - parseNumberWithoutCommas(old)
            console.log('TT befor addin'+someAE_TT);
            someAE_TT+=parseNumberWithoutCommas($(this).val())
            $('#AE_act').val(ValAccountingFigures(someAE_TT))
            console.log('old TT '+someAE_TT)
            }
            
    })

    $('#T2_AE_init_AC').on('focusin',function(){
        oldTT=$('#AE_act').val();
        old=$(this).val();
        console.log('old value'+oldTT);
    })

    $('#T2_AE_init_AC').on('focusout',function(){
        console.log('old before if'+oldTT);
        if(old == 0 || old == '' || old == '0' || old == null || old =='NaN')
            {
                old='0'
            }
        if(oldTT == 0 || oldTT == '' || oldTT == '0' || oldTT == null || oldTT =='NaN')
            {
                someAE_TT=0;
            someAE_TT+=parseNumberWithoutCommas($(this).val())
            $('#AE_act').val(ValAccountingFigures(someAE_TT))
            console.log('TT '+someAE_TT)
            }
            else
            {
                someAE_TT=parseNumberWithoutCommas(oldTT) - parseNumberWithoutCommas(old)
            console.log('TT befor addin'+someAE_TT);
            someAE_TT+=parseNumberWithoutCommas($(this).val())
            $('#AE_act').val(ValAccountingFigures(someAE_TT))
            console.log('old TT '+someAE_TT)
            }
    })

    $('#T3_AE_init_AC').on('focusin',function(){
        oldTT=$('#AE_act').val();
        old=$(this).val();
        console.log('old value'+oldTT);
    })

    $('#T3_AE_init_AC').on('focusout',function(){
        console.log('old before if'+oldTT);
        if(old == 0 || old == '' || old == '0' || old == null || old =='NaN')
            {
                old='0'
            }
        if(oldTT == 0 || oldTT == '' || oldTT == '0' || oldTT == null || oldTT =='NaN')
            {
                someAE_TT=0;
            someAE_TT+=parseNumberWithoutCommas($(this).val())
            $('#AE_act').val(ValAccountingFigures(someAE_TT))
            console.log('TT '+someAE_TT)
            }
            else
            {
            someAE_TT=parseNumberWithoutCommas(oldTT) - parseNumberWithoutCommas(old)
            console.log('TT befor addin'+someAE_TT);
            someAE_TT+=parseNumberWithoutCommas($(this).val())
            $('#AE_act').val(ValAccountingFigures(someAE_TT))
            console.log('old TT '+someAE_TT)
            }
    })

    $('#T4_AE_init_AC').on('focusin',function(){
        oldTT=$('#AE_act').val();
        old=$(this).val();
        console.log('old value'+oldTT);
    })

    $('#T4_AE_init_AC').on('focusout',function(){
        console.log('old before if'+oldTT);
        if(old == 0 || old == '' || old == '0' || old == null || old =='NaN')
            {
                old='0'
            }
        if(oldTT == 0 || oldTT == '' || oldTT == '0' || oldTT == null || oldTT =='NaN')
            {
            someAE_TT=0
            someAE_TT+=parseNumberWithoutCommas($(this).val())
            $('#AE_sous_prog').val(ValAccountingFigures(someAE_TT))
            console.log('null TT '+someAE_TT)
            }
            else
            {
            console.log('TT refresh new Value some '+someAE_TT+' old'+oldTT);
            someAE_TT=parseNumberWithoutCommas(oldTT) - parseNumberWithoutCommas(old)
            
            someAE_TT+=parseNumberWithoutCommas($(this).val())
            $('#AE_act').val(ValAccountingFigures(someAE_TT))
            console.log('old TT '+someAE_TT)
            }
    })
    /**  ------------------------------------------------------ rnf ---------------- */
    /**------------------------------------ Some CP T ----------------------------- */

    $('#T1_CP_init_AC').on('focusin',function(){
        oldTTCP=$('#CP_act').val();
        oldCP=$(this).val();
        console.log('old value'+oldTTCP);
    })


    $('#T1_CP_init_AC').on('focusout',function(){


        console.log('old before if'+oldTTCP);
        if(oldCP == 0 || oldCP == '' || oldCP == '0' || oldCP == null || oldCP =='NaN')
        {
            oldCP='0'
        }
        if(oldTTCP == 0 || oldTTCP == '' || oldTTCP == '0' || oldTTCP == null || oldTTCP =='NaN' )
            {
                someCP_TT=0;
            someCP_TT+=parseNumberWithoutCommas($(this).val())
            $('#CP_act').val(ValAccountingFigures(someCP_TT))
            console.log('TT '+someCP_TT)
            }
            else
            {
            someCP_TT=parseNumberWithoutCommas(oldTTCP) - parseNumberWithoutCommas(oldCP)
            console.log('TT befor addin'+someCP_TT);
            someCP_TT+=parseNumberWithoutCommas($(this).val())
            $('#CP_act').val(ValAccountingFigures(someCP_TT))
            console.log('old TT '+someCP_TT)
            }

    })

    $('#T2_CP_init_AC').on('focusin',function(){
        oldTTCP=$('#CP_act').val();
        oldCP=$(this).val();
        console.log('old value'+oldTT);
    })


    $('#T2_CP_init_AC').on('focusout',function(){

        console.log('old before if'+oldTTCP);
        if(oldCP == 0 || oldCP == '' || oldCP == '0' || oldCP == null || oldCP =='NaN')
        {
            oldCP='0'
        }
        if(oldTTCP == 0 || oldTTCP == '' || oldTTCP == '0' || oldTTCP == null || oldTTCP =='NaN' )
            {
                someCP_TT=0;
            someCP_TT+=parseNumberWithoutCommas($(this).val())
            $('#CP_act').val(ValAccountingFigures(someCP_TT))
            console.log('TT '+someCP_TT)
            }
            else
            {
            someCP_TT=parseNumberWithoutCommas(oldTTCP) - parseNumberWithoutCommas(oldCP)
            console.log('TT befor addin'+someCP_TT);
            someCP_TT+=parseNumberWithoutCommas($(this).val())
            $('#CP_act').val(ValAccountingFigures(someCP_TT))
            console.log('old TT '+someCP_TT)
            }
        
    })

    $('#T3_CP_init_AC').on('focusin',function(){
        oldTTCP=$('#CP_act').val();
        oldCP=$(this).val();
        console.log('old value'+oldTTCP);
    })

    $('#T3_CP_init_AC').on('focusout',function(){

        console.log('old before if'+oldTTCP);
        if(oldCP == 0 || oldCP == '' || oldCP == '0' || oldCP == null || oldCP =='NaN')
        {
            oldCP='0'
        }
        if(oldTTCP == 0 || oldTTCP == '' || oldTTCP == '0' || oldTTCP == null || oldTTCP =='NaN' )
            {
                someCP_TT=0;
            someCP_TT+=parseNumberWithoutCommas($(this).val())
            $('#CP_act').val(ValAccountingFigures(someCP_TT))
            console.log('TT '+someCP_TT)
            }
            else
            {
            someCP_TT=parseNumberWithoutCommas(oldTTCP) - parseNumberWithoutCommas(oldCP)
            console.log('TT befor addin'+someCP_TT);
            someCP_TT+=parseNumberWithoutCommas($(this).val())
            $('#CP_act').val(ValAccountingFigures(someCP_TT))
            console.log('old TT '+someCP_TT)
            }
        
    })

    $('#T4_CP_init_AC').on('focusin',function(){
        oldTTCP=$('#CP_act').val();
        oldCP=$(this).val();
        console.log('old value'+oldTTCP);
    })

    $('#T4_CP_init_AC').on('focusout',function(){

        console.log('old before if'+oldTT);
        if(oldCP == 0 || oldCP == '' || oldCP == '0' || oldCP == null || oldCP =='NaN')
        {
            oldCP='0'
        }
        if(oldTTCP == 0 || oldTTCP == '' || oldTTCP == '0' || oldTTCP == null || oldTTCP =='NaN' )
            {
            someCP_TT=0;
            someCP_TT+=parseNumberWithoutCommas($(this).val())
            $('#CP_act').val(ValAccountingFigures(someCP_TT))
            console.log('TT '+someCP_TT)
            }
            else
            {
            someCP_TT=parseNumberWithoutCommas(oldTTCP) - parseNumberWithoutCommas(oldCP)
            console.log('TT befor addin'+someCP_TT);
            someCP_TT+=parseNumberWithoutCommas($(this).val())
            $('#CP_act').val(ValAccountingFigures(someCP_TT))
            console.log('old TT '+someCP_TT)
            }
        
    })
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

$(document).ready(function(){
    $('input').focus(function() {
        $(this).removeAttr('style');
    });
 var deleg_action="centrale"
    $('#act_deleg').change(function() {
        if ($(this).is(':checked')) {
            deleg_action="delegation"
            console.log('Checkbox is checked. Value:', $(this).val());
        } else {
              deleg_action="centrale"
            console.log('Checkbox is unchecked.', $(this).val());
        }
    });
preview('file')
//===================CHECK PROG==================================
$("#date_insert_portef").on('focusout', function () {
    var num_prog = $('#num_prog').val(); // Récupérer la valeur du portefeuille
    var Date_prog = $(this).val();  // Récupérer la valeur de la date

    var year = new Date(Date_prog).getFullYear(); // Extraire l'année à partir de la date
    var numprog_year = path[0] +'-'+num_prog;


    // Vérifie que les deux champs sont remplis avant de continuer
    if (Date_prog && num_prog) {
        // Appel AJAX pour vérifier le portefeuille dans la base de données

        console.log('data' + numprog_year)
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
                    console.log(response); // Vérifiez la réponse
                    console.log('numwall_year path3: ' + JSON.stringify(path3));
                    $("#file_holder_prog").empty();
                    $('#preview').empty()
                    // Remplir les champs du formulaire avec les données récupérées
                    console.log('response.CP_prog' + response.CP_prog)
                    console.log('response.AE_prog' + response.AE_prog)
                    $('#date_insert_portef').val(response.date_insert_portef).trigger('change');
                    $('#nom_prog').val(response.nom_prog).trigger('change'); // Remplir et déclencher l'événement change
                    $('#AE_prog').val(ValAccountingFigures(response.AE_prog)).trigger('change'); // Remplir et déclencher l'événement change
                    $('#CP_prog').val(ValAccountingFigures(response.CP_prog)).trigger('change'); // Remplir et déclencher l'événement change
                    $('#nom_journ').val(response.nom_journal).trigger('change'); // Remplir et déclencher l'événement change
                    $('#num_journ').val(response.num_journal).trigger('change'); // Remplir et déclencher l'événement change


                    alert('Le programme existe déjà');

                }
            },
            error: function () {
                alert('Erreur lors de la vérification du programme');
            }
        });
    }
});


//==============================FIN CHECKL PROG=============================

//==============================CHECK SOUS PROG=============================
$('#date_insert_sousProg').on('focusout', function () {
    var Date_sou_program = $(this).val(); // Récupérer la valeur du programme
    //var year = new Date(Date_sou_program).getFullYear(); // Extraire l'année à partir de la date
    var num_sou_prog = $('#num_sous_prog').val(); // Récupérer la valeur de la date du programme
    // Vérifie que les deux champs sont remplis avant de continuer
    var num_sou_program = path[1] +'-'+ num_sou_prog;
    console.log('ss'+num_sou_program)
    console.log('response.num_sou_program' + num_sou_program)

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

                   // Remplir les champs du formulaire avec les données récupérées
                   $('#nom_sous_prog').val(response.nom_sous_prog).trigger('change');
                   $('#AE_sous_prog').val(ValAccountingFigures(response.AE_sous_prog)).trigger('change');
                   $('#CP_sous_prog').val(ValAccountingFigures(response.CP_sous_prog)).trigger('change');

                   $('#T1_AE_init').val(ValAccountingFigures(response.T1_AE_init)).trigger('change');
                   $('#T1_CP_init').val(ValAccountingFigures(response.T1_CP_init)).trigger('change');

                   $('#T2_AE_init').val(ValAccountingFigures(response.T2_AE_init)).trigger('change');
                   $('#T2_CP_init').val(ValAccountingFigures(response.T2_CP_init)).trigger('change');

                   $('#T3_AE_init').val(ValAccountingFigures(response.T3_AE_init)).trigger('change');
                   $('#T3_CP_init').val(ValAccountingFigures(response.T3_CP_init)).trigger('change');

                   $('#T4_AE_init').val(ValAccountingFigures(response.T4_AE_init)).trigger('change');
                   $('#T4_CP_init').val(ValAccountingFigures(response.T4_CP_init)).trigger('change');

                   alert('Le sous-programme existe déjà.');
                   $('#preview').empty()
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

//=======================FIN CHECK SOUS PROG ==================================

//======================= CHECK action ==================================

$('#date_insert_action').on('focusout', function () {
    //alert('out')
    var date_act = $(this).val();
    var num_act = $('#num_act').val();
    //  var date_act=  new Date(date_act).getFullYear();
    var numact_year = path[2] +'-'+num_act ;
    console.log('the new id' + numact_year + ' with ' + JSON.stringify(path))
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
                    
                   $('#T1_AE_init_AC').val(ValAccountingFigures(response.T1_AE_init)).trigger('change');
                   $('#T1_CP_init_AC').val(ValAccountingFigures(response.T1_CP_init)).trigger('change');

                   $('#T2_AE_init_AC').val(ValAccountingFigures(response.T2_AE_init)).trigger('change');
                   $('#T2_CP_init_AC').val(ValAccountingFigures(response.T2_CP_init)).trigger('change');

                   $('#T3_AE_init_AC').val(ValAccountingFigures(response.T3_AE_init)).trigger('change');
                   $('#T3_CP_init_AC').val(ValAccountingFigures(response.T3_CP_init)).trigger('change');

                   $('#T4_AE_init_AC').val(ValAccountingFigures(response.T4_AE_init)).trigger('change');
                   $('#T4_CP_init_AC').val(ValAccountingFigures(response.T4_CP_init)).trigger('change');
                    alert('L`Action existe déjà');
                    $('#preview').empty()
                }
                else {
                 //   alert('Erreur d`Opération');

                }
            }
        })
    }
})

//=======================FIN CHECK action ==================================

//===============CHECK SOUS ACTION=====================//
$('#date_insert_sou_action').on('focusout', function () {
    //alert('out')
    var date_sousact = $(this).val();
    var num_sousact = $('#num_sous_action').val();
    //  var date_act=  new Date(date_act).getFullYear();
    var numsousact_year = path[3] +'-'+num_sousact ;
    console.log('numsousact_year' + numsousact_year + ' with ' + JSON.stringify(path))
    if (date_sousact && num_sousact) {
        $.ajax({
            url: '/check-sousaction',  // Route pour vérifier l'existence du programme
            type: 'GET',
            data: {
                num_sous_action: numsousact_year,
            },
            success: function (response) {
                if (response.exists) {
                    console.log("response.nom_sous_action", response.nom_sous_action);
                    $('#nom_sous_action').val(response.nom_sous_action).trigger('change'); // Remplir et déclencher l'événement change
                     $('#date_insert_sou_action').val(response.date_insert_sous_action).trigger('change'); // Remplir et déclencher l'événement change
                    $('#AE_sous_act').val(ValAccountingFigures(response.AE_sous_act)).trigger('change'); // Remplir et déclencher l'événement change
                    $('#CP_sous_act').val(ValAccountingFigures(response.CP_sous_act)).trigger('change'); // Remplir et déclencher l'événement change
                    alert('L`Action existe déjà');
                    $('#preview').empty()
                }
                else {
                   // alert('Erreur d`Opération');

                }
            }
        })
    }
})
 //=============== FIN CHECK SOUS ACTION================//


calaulsomeAE_CP_act()
calaulsomeAE_CP_sprog()



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
            alert("Veuillez remplir tous les champs obligatoires");
            }
            $(this).css('box-shadow','0 0 0 0.25rem rgb(255 0 0 / 47%)')
        }
    });



    if(id == "add-prg3")
    {

        console.log($('#AE_act').val()+ 'fdyudg');
      let userResponse = confirm('Voulez-vous ajouter une sous-action pour cette action ?');
                                    if (userResponse) {
                                        // Récupération des informations de l'action
                                        $('#confirm-holder_act').empty()
                                        $('#confirm-holder_act').append('<i class="fas fa-wrench"></i>')
                                        var nom_act = $('#nom_act').val();
                                        var num_act = $('#num_act').val();
                                        var dat_inst = $('#date_insert_action').val();
                                        var AE_act = $('#AE_act').val()
                                        var CP_act = $('#CP_act').val()

                                        var T1_AE_init = $('#T1_AE_init').val()
                                        var T1_CP_init = $('#T1_CP_init').val()
                    
                                        var T2_AE_init = $('#T2_AE_init').val()
                                        var T2_CP_init = $('#T2_CP_init').val()
                    
                                        var T3_AE_init = $('#T3_AE_init').val()
                                        var T3_CP_init = $('#T3_CP_init').val()
                    
                                        var T4_AE_init = $('#T4_AE_init').val()
                                        var T4_CP_init = $('#T4_CP_init').val()
                                        
                                        
                                        var id_sou_prog = path[2];
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
                                        var formdata_act = {
                                            num_action: numaction_year,
                                            nom_action: nom_act,
                                            date_insert_action: dat_inst,

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
                                            action_deleg:deleg_action,
                                            id_sous_prog: path[2],
                                            AE_act: AE_act,
                                            CP_act: CP_act,
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
                                                    upload_file('file',numaction_year)
                                                    $('#preview').empty()
                                                    console.log('A path: ' + JSON.stringify(path));
                                                    $('#confirm-holder_act').empty()
                                                    $('#confirm-holder_act').append('<i class="fas fa-wrench"></i>')
                                                    // Création du formulaire pour la sous-action après l'ajout de l'action
                                                    var prg4 = `<div class="form-container">
                                                           <form>
                                                             <div class="form-group">
                                                            <label for="num_sous_act">Code de Sous ACTION</label>
                                                            <input type="text" class="form-control" id="num_sous_act" placeholder="Entrer le Code  de Sous ACTION">
                                                           </div>
                                                            <div class="form-group">
                                                                 <label for="date_insert_sou_action">Date du Journal</label>
                                                                 <input type="date" class="form-control" id="date_insert_sou_action">
                                                               </div>
                                                            <div class="form-group">
                                                                <label for="nom_sous_act">Nom de  Sous ACTION</label>
                                                            <input type="text" class="form-control" id="nom_sous_act" placeholder=Entrer le Nom  de Sous ACTION">
                                                            </div>
                                                               <div class="form-group">
                                                                <label for="AE_sous_act">AE pour Sous Action</label>
                                                                <input type="number" class="form-control" id="AE_sous_act" placeholder=" Entrer AE  Sous Action">
                                                            </div>
                                                            <div class="form-group">
                                                              <label for="CP_sous_act">CP pour Sous Action</label>
                                                            <input type="number" class="form-control" id="CP_sous_act" placeholder="Entrer CP  Sous Action">
                                                               </div>
                                                               </form>
                                                               <br>
                                                               <button class="btn btn-primary" id="add-prg4">Ajouter </button>
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
                                                        
                                                        var AE_sous_act = $('#AE_sous_act').val()
                                                        var CP_sous_act = $('#CP_sous_act').val()

                                                       
                                                        var numaction_year = path[3];
                                                        var numsousaction_year = numaction_year +'-'+num_sous_act ;
                                                        // Création du formData pour la sous-action
                                                        var formdata_sous_act = {
                                                            num_sous_action: numsousaction_year,
                                                            nom_sous_action: nom_sous_act,
                                                            date_insert_sous_action: dat_inst,

                                                

                                                            num_act: path[3],
                                                            AE_sous_act: AE_sous_act,
                                                            CP_sous_act: CP_sous_act,
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
                                                                  //  alert('testing')
                                                                    window.location.href = '/testing/S_action/' + path.join('/');
                                                                }
                                                            },
                                                            error: function (response) {
                                                                alert('Erreur lors de l\'ajout de la sous-action');
                                                            }
                                                        });
                                                    });
                                                }
                                            },
                                            error: function (response) {
                                                alert('Erreur lors de l\'ajout de l\'action');
                                            }
                                        });
                                    } else {
                                        // Cas où l'utilisateur n'ajoute pas de sous-action
                                        var nom_act = $('#nom_act').val();
                                        var num_act = $('#num_act').val();
                                        var dat_inst = $('#date_insert_action').val();
                                        var AE_act = $('#AE_act').val()
                                        var CP_act = $('#CP_act').val()

                                        var T1_AE_init = $('#T1_AE_init_AC').val()
                                        var T1_CP_init = $('#T1_CP_init_AC').val()
                    
                                        var T2_AE_init = $('#T2_AE_init_AC').val()
                                        var T2_CP_init = $('#T2_CP_init_AC').val()
                    
                                        var T3_AE_init = $('#T3_AE_init_AC').val()
                                        var T3_CP_init = $('#T3_CP_init_AC').val()
                    
                                        var T4_AE_init = $('#T4_AE_init_AC').val()
                                        var T4_CP_init = $('#T4_CP_init_AC').val()
                                        var deleg_act=$("#act_deleg").val()
                                        var id_sou_prog = path[2];
                                        var numaction_year = id_sou_prog +'-'+num_act ;

                                        var formdata_act = {
                                            num_action: numaction_year,
                                            nom_action: nom_act,
                                            date_insert_action: dat_inst,
                                            id_sous_prog: id_sou_prog,
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
                                            action_delege:deleg_action,
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
                                                    $('#preview').empty()
                                                    console.log('response.num_sous_action: ' + response.num_sous_action);
                                                    path.push(response.num_sous_action);
                                                    console.log('response.num_sous_action: ' +response.num_sous_action);
                                                    console.log('path: ' + JSON.stringify(path));
                                                    if (response.num_sous_action && response.count_sous_action < 2) {
                                                        // console.log('path: ' + JSON.stringify(path));
                                                        window.location.href = '/testing/S_action/' + path.join('/');
                                                    } else if (response.count_sous_action >= 2) {
                                                        console.log('response.num_sous_action: ' + response.num_sous_action);
                                                        window.location.href = '/Portfail/' + response.numPortef;
                                                    } else {
                                                        // console.log('path: ' + JSON.stringify(path));
                                                        window.location.href = '/testing/Action/' + path.join('/');
                                                    }



                                                }
                                            },
                                            error: function (response) {
                                                alert('Erreur lors de l\'ajout de l\'action');
                                            }
                                        });
                                    }

    }
    if(id == "add-prg4")
    {
        console.log($('#AE_sous_act').val()+ 'fdyudg');
        console.log('inside sous_action')
        var nom_sous_act = $('#nom_sous_act').val();
        var num_sous_act = $('#num_sous_act').val();
        var dat_inst = $('#date_insert_sou_action').val();
        var AE_sous_act = $('#AE_sous_act').val()
        var CP_sous_act = $('#CP_sous_act').val()
        var numaction_year = path[3];
        var numsousaction_year = numaction_year +'-'+num_sous_act ;
        console.log('this '+numaction_year+'new pa'+numsousaction_year)
        // Création du formData pour la sous-action
        var formdata_sous_act = {
            num_sous_action: numsousaction_year,
            nom_sous_action: nom_sous_act,
            date_insert_sous_action: dat_inst,
            num_act: path[3],
            AE_sous_act: AE_sous_act,
            CP_sous_act: CP_sous_act,
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
                  //  alert('testing')
                    window.location.href = '/testing/S_action/' + path.join('/');
                }
            },
            error: function (response) {
                alert('Erreur lors de l\'ajout de la sous-action');
            }
        });

    }

    if(id == "add-prg2")
        {
          var parent=$(this).parent()
          var sou_prog = $('#num_sous_prog').val()
                        var nom_sou_prog = $('#nom_sous_prog').val();
                        var dat_sou_prog = $('#date_insert_sousProg').val()
                        var ae_sou_prog = $('#AE_sous_prog').val();
                        var cp_sou_prog = $('#CP_sous_prog').val();

                    var T1_AE_init = $('#T1_AE_init').val()
                    var T1_CP_init = $('#T1_CP_init').val()

                    var T2_AE_init = $('#T2_AE_init').val()
                    var T2_CP_init = $('#T2_CP_init').val()

                    var T3_AE_init = $('#T3_AE_init').val()
                    var T3_CP_init = $('#T3_CP_init').val()

                    var T4_AE_init = $('#T4_AE_init').val()
                    var T4_CP_init = $('#T4_CP_init').val()
                    var id_prog = path[1];
                    var numsouprog_year = id_prog +'-'+sou_prog ;
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
                        AE_sous_prog:ae_sou_prog,
                        CP_sous_prog:cp_sou_prog,
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
                           AE_init_t1:$('#T1_AE_init').val(),
                           CP_init_t1:$('#T1_AE_init').val(),

                           code_t2:20000,
                           AE_init_t2:$('#T2_AE_init').val(),
                           CP_init_t2:$('#T2_CP_init').val(),

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
                        console.log('data' + JSON.stringify(formdatasou_prog))
                        $.ajax({
                            url: '/creationSousProg',
                            type: "POST",
                            data: formdatasou_prog,
                            success: function (response) {
                                if (response.code == 200 || response.code == 404)
                                 {
                                    if(upload_file('file',numsouprog_year) == 200)
                                        {

                                            alert(response.message)
                                            $('#preview').empty()
                                        }
                                        alert(response.message)
                                                path.push(numsouprog_year);
                                                $('.the-path').append(nexthop)
                                               
                                                 document.getElementById("creati-act").style.display="block";
                                 /*   $.ajax({
                                        url:'/init_ports',
                                        type:'POST',
                                        data:formatinitports,
                                        success:function(response)
                                        {
                                            if(response.code == 200)
                                            {
                                                alert(response.message)
                                                path.push(numsouprog_year);
                                                $('.the-path').append(nexthop)
                                                parent.empty();
                                                parent.append('<i class="fas fa-wrench"></i>')
                                                 document.getElementById("creati-act").style.display="block";
                                            }
                                            else
                                            {

                                            }
                                        }
                                    })*/

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
    var numprog_year = path[0] +'-'+id_prog ;
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
                upload_file('file',numprog_year)
               $('#preview').empty()
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
