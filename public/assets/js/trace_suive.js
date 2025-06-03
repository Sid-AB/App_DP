
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
            console.log (' update ')
          return response.code
         }
           else
           {
             console.log (' error ')
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


$(document).ready(function()
{
    $('#validate').on('click',function(){
        console.log('testing')
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
            $('.confirm-justfie').empty()
            $('.form_holder_modif').empty()
            $('.confirm-justfie').removeClass('setit-back')
    })
    })
  
})