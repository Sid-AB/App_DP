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
  $('#T1').on('click',function(){
    console.log('data is')
    $('#Tport-handle').addClass('scale-out');
    setTimeout(() => {
      // Add the class to hide the table
      $('#Tport-handle').addClass('scale-hidden');
      // Optionally remove the scaling out class after hiding
      $('#Tport-handle').removeClass('scale-out');
      $('.T-handle').css('display','flex')
  }, 500)

  })
  $("#add-wallet").on('click',function(){
    $('.font-bk').removeClass('back-bk')
    $('.wallet-path').css('display','flex')
    $('.wallet-handle').empty()
    $('#progam-handle').css('display','block')
    $('#progam-handle').removeClass('scale-out')
    $('#progam-handle').addClass('scale-visible')
  })
})
$("#add-prg").on('click',function(){

  var prg2='<div class="form-container">'+
      '<form>'+
        '<div class="form-group">'+
          '<label for="input1">Sous Programme</label>'+
          '<input type="text" class="form-control" id="input1" placeholder="Donnee Nom Sous Programme">'+
        '</div>'+
       ' <div class="form-group">'+
         ' <label for="inputDate">Date Journal</label>'+
          '<input type="date" class="form-control" id="inputDate">'+
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
              '<p>  </p>'+
              '</div>'+
              ' <div class="next-handle">'+
              '<i class="fas fa-angle-double-right waiting-icon"></i>'+
              '</div>'
  $('.next-handle svg').removeClass('waiting-icon')
  $('.next-handle svg').addClass('complet-icon')
  $('.the-path').append(nexthop)
  $('#progam-handle').append(prg2)
  $('#add-prg2').on('click',function(){
    var nexthop='<div class="pinfo-handle">'+
    '<i class="fas fa-wallet"></i>'+
    '<p >S_Program :</p>'+
    '<p>  </p>'+
    '</div>'+
    ' <div class="next-handle">'+
    '<i class="fas fa-angle-double-right waiting-icon"></i>'+
    '</div>'
    var prg3='<div class="form-container">'+
        '<form>'+
          '<div class="form-group">'+
            '<label for="input1">ACTION</label>'+
            '<input type="text" class="form-control" id="input1" placeholder="Donnee Nom ACTION">'+
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
          $('#add-prg3').on('click',function(){
            var nexthop='<div class="pinfo-handle">'+
            '<i class="fas fa-wallet"></i>'+
            '<p >ACTION :</p>'+
            '<p>  </p>'+
            '</div>'+
            ' <div class="next-handle">'+
            '<i class="fas fa-angle-double-right waiting-icon"></i>'+
            '</div>'
            var T1='<div class="col-md-15 hover-container">'+
            '<div class="card">'+
           ' <div class="icon-holder">'+
                '<i class="fas fa-door-closed default-icon icon icon-card"></i>'+
                '<i class="fas fa-door-open hover-icon icon icon-card"></i>'+
                '</div>'+
                '<div class="card-body">'+
                    '<h5 class="card-title">Titre 4</h5>'+
                   ' <p class="card-text">Description pour Titre 4.</p>'+
                    '<button class="btn btn-primary bts" id="T4">Vers Les Operation</button>'+
                '</div>'+
            '</div>'+
        '</div>'
        $('#progam-handle').addClass('slide-out')
        setTimeout(() => {
          // Add the class to hide the table
          $('#progam-handle').empty();
          // Optionally remove the scaling out class after hiding
          $('#T_List-handle').addClass('grid-T')
          $('#T1-handle').append(T1)
          $('#T2-handle').append(T1)
          $('#T3-handle').append(T1)
          $('#T4-handle').append(T1)
        $('.next-handle svg').removeClass('waiting-icon')
          $('.next-handle svg').addClass('complet-icon')
        $('.the-path').append(nexthop)
        $('#T4').on('click',function(){
          $('#T_List-handle').removeClass('grid-T')
          $('#T_List-handle').addClass('row-T')
          $('#gr_list_handle').addClass('gr_list')
          var table='<table class="container-T" id="T-tables">'+
                      '<thead>'+
  '<tr>'+
    '<th rowspan="2"><h1>T Description</h1><th> </th></th>'+
    '<th><h1>AE</h1></th>'+
    '<th><h1>CP</h1></th>'+
    '</tr>'+
    '</thead>'+
    '<tbody>'+
    '</tbody>'+
    '</table>'
    $('#table-T').append(table)
           $.getJSON(jsonpath, function (data) {
                // Loop through each item in the JSON data
                $.each(data, function (key, value) {
                    // Create a table row
                    let row = '<tr>' +
                        '<td>' + key + '</td>' +
                        '<td>' + value + '</td>' +
                        '<td>' + 0 + '</td>' +
                        '<td>' + 0 + '</td>' +
                        '</tr>';

                    // Append the row to the table body
                    $('#T-tables tbody').append(row);
                });
            }).fail(function () {
                console.error('Error loading JSON file.');
            });
        })
      }, 500)
      
          
       })
  })
  
})

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

function gettingT1()
{

}
