$(document).ready(function(){

  /*==========================================================
                  SLIDES
  ========================================================*/

var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = $('.slides-img'); //document.getElementsByClassName("slides-img");
  for (i = 0; i < slides.length; i++) {
    //slides[i].style.display = "none";
    $('.slides-img').css('display','none');
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}
  slides[slideIndex-1].style.display = "block";

  setTimeout(showSlides, 4000);
}

  $('#right-area').click(function() {
      var current = $('img:visible').index();
      var last_index = $('img:last').index();

      if (current == last_index) {
        var next = 0;
      } else {
        var next = current+1;
      }
  $('img').eq(next).show().siblings('img').hide();
});

  $('#left-area').click(function() {
    var current = $('img:visible').index();

    if (current == 0) {
      var previous = $('img:last').index();
    }else {
      var previous = current-1;
    }
  $('img').eq(previous).show().siblings('img').hide();
});

//================ btn hover

$('#left-area').hover(function(){
  $('#left-btn').css('opacity','40%');
}, function(){
  $('#left-btn').css('opacity','100%');
});

$('#right-area').hover(function(){
  $('#right-btn').css('opacity','40%');
}, function(){
  $('#right-btn').css('opacity','100%');
});


});
