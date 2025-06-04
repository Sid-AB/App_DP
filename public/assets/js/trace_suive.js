
function upload_file(id_file,id_relat,id)
{

   let formDataFa = new FormData();
   formDataFa.append('pdf_file', $('#'+id_file)[0].files[0]);
   formDataFa.append('related_id',id_relat);



                                $('.form_holder_modif').empty()
                                $('.confirm-justfie').empty();
                                $('.confirm-justfie').removeClass('setit-back')
                                 $('.hide-access-form').append(chekl)
                                 $('#myForm').css('display','block')
                                 $('.hide-access-form').addClass('form-access')
                                 $('#form-cancel').on('click',function(){
                                 $('#myForm').css('display','none')
                                $(".hide-access-form").removeClass('form-access');
                                $('.hide-access-form').empty()
                                })

       
                        var cosnt=0;
                        $('#btn-form-access').on('click',function(){
                         $.ajax({
                            url:'/login/account',
                            type:'POST',
                            data:{
                                email:$('#email').val(),
                                code_generated:$('#code_generated').val(),
                                _token: $('meta[name="csrf-token"]').attr("content"),
                                _method: "POST",},
                        success:function(response)
                        {
                            if(response.code == 200)
                             {
                             path3=id.split('-')
                              port=path3[0]+'-'+path3[1]+'-';
                             prog=port+'-'+path3[2];
                            sprog=prog+'-'+path3[3];
                            act=sprog+'-'+path3[4];
                            console.log('code',act)
                          


                            
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
            $.ajax({
                url:'/validate_modif/'+id,
                type:'GET',
                success:function(response)
                {
                    
                    if(response.code == 200)
                    {
                      window.location.href='/testing/Action/'+port+'/'+prog+'/'+sprog+'/'+act+'/?code='+response.account
                    }
                    else
                    {
                        alert(response.message)
                    }
                },
                error:function(){
                    alert('Error')
                }
            })
          return true
         }
           else
           {
             console.log (' error ')
               return false;
           }
       }
   })



                            }
                            else
                            {
                              window.location.href='/update/pass?code='+response.code_generated+'&mail='+response.account
                            }
             // 
            },
            error:function()
            {
              $('#email').css('border-color','red')
              $('#code_generated').css('border-color','red')
              console.log('out of range')
            }
            })
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


$(document).ready(function()
{
    $('#validate').on('click',function(){
        var id=$(this).closest('td').attr('id')
        console.log('testing'+id)
    var inputfile='<div class="confirm-file-handle"><form>'+
                      '<input type="file" class="form-control" id="file" accept=".pdf, .jpg, .jpeg, .png" required>'+
                      ' </form>'+
                      '<button class="button-70" id="button-70"  role="button">joindre fichier</button></div>';
    $('.confirm-justfie').addClass('setit-back')
    $('.form_holder_modif').append(inputfile)
    preview('file')
    $('.confirm-justfie').append('<div class="preview_window"><div id="preview"></div></div>')
    $('.confirm-justfie').on('dbclick',function(){
        $(this).empty()
        $(this).removeClass('setit-back')
    })  
    $('#button-70').on('click',function(){
        var newids='T_'+id;
        var status_rep=upload_file('file',newids,id)
        console.log('show status',status_rep)
    
    })
    })
  
})