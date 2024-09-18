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
