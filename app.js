$(document).ready(function(){

  /*==========================================================
                  HOME-TEXT
  ========================================================*/

  $('#readMore').click(function(){
    $('.home-text2').show(1500);
  });

  $('#readLess').click(function(){
    $('.home-text2').hide(1500);
  });

/*==========================================================
                FOOTER
========================================================*/

  var myDate = new Date();
  var thisYear = myDate.getFullYear();

  var width = $(window).width();
  var height = $(window).height();

  $('#copyright').append(' '+thisYear);
  //$('#info').append(width + ' X ' + height);


    /*==========================================================
                    POPUP
    ========================================================*/

    $('.gridImages, .gridImages-small').click(function(){

    var i;
    var tmpSrc = $(this).find('img').attr('src');
    var img = $('<img>', {'src': tmpSrc, 'id': 'popupImg-ID', 'class': 'popupImg-Cl'});
    var myDiv = $('<div>', {'id': 'hideDiv'});
    myDiv.css({'width': '100%',
                'height': '100%',
                'top': '0px',
                'left': '0px',
                'opacity': '60%',
                'display': 'block',
                'position': 'fixed',
                'background-color': '#cceeff',
                'z-index': '1000'
    });
    for (i=0; i<1000; i++){
      $('body').append(myDiv);
      $(myDiv).fadeIn(5000,function(){
        $('#popUp').show('fast');
        $('#popUp').append(img);
      });
    }

    var height = $(img).height();
    var width = $(img).width();
    var marginTopTmp = height/2;
    var marginLeftTmp = width/2;
    var marginTop = "-"+marginTopTmp+"px";
    var marginLeft = "-"+marginLeftTmp+"px";

    $('#popUp').attr('margin-top', marginTop);
    $('#popUp').attr('margin-left', marginLeft);

    //  console.log(width);
    //  console.log(height);
    //  console.log(marginLeft);
    //  console.log(marginTop);
  });

    $('#popUpClose').click(function () {
      var i;
      for (i=0; i<1000; i++){
        $('#popUp').hide();
        $('#popupImg-ID').remove();
        $('#hideDiv').remove();
      }
    });

  /*==========================================================
                  MENU-BTN
  ========================================================*/

$('#menu_btn').click( function(){
    if ( $('nav').css('display') == 'none')  {
      $('nav').css('display','block');
      $('nav ul').css({
        'position': 'absolute',
        'width': '100%',
        'display': 'block',
        'top': '130px',
        'left': '0px',
        'background-color': '#264d73',
        'opacity': '90%'});
        $('ul li').css('display','block');
        $('nav ul li ul').css('display','none');
        $('nav ul li').css({'border-bottom':'1px solid #e6ffff','padding-left': '10px'});
        $('nav ul li span').css('padding','0px');

        $('nav ul li').hover(
          function(){
          $(this).css('background-color','#538cc6');
          //$('nav ul li').css('display','block');
        }, function(){
          $(this).css('background-color','#264d73');
          //$('nav ul li').css('display','block');
          });

        var respSite = true;
      //  console.log('block');
    }else {

      $('nav').css('display','none');
      $('nav ul').css('display','none');
      var respSite = false;
    //  console.log('none');
      }

    });


/*==========================================================
                MENU RESPONSIVE
========================================================*/
//console.log('Width on load = '+width);
$(window).on('resize', function(){
  var respoWidth = $(window).width();
  width = respoWidth;
//  console.log('after resise respoWidth = '+respoWidth);
//  console.log('after resise width = '+width);
  if (respoWidth > 966 && $('nav').css('display') == 'none') {
     $('nav').css({'display':'block'});
     $('nav').load('header.php nav ul:nth-child(1)');
  }
  else if (respoWidth < 966 && $('nav').css('display') == 'block') {
    $('nav').css({'display':'none'});
    $('nav ul').css({'display':'none'});
    $('nav ul li ul').css({'display':'none'});
  }
});

//--------------------ON CLICK

$('nav ul li').on('click', function(){

  if ($(this).index() == 1 && width < 966){
    if ($('ul li ul').css('display') == 'none'){
      $(this).nextAll().css('display','none');
      $('ul li ul').css({'top': '65px'});
      //$('ul li ul').fadeIn('slow');
      $(this).children().fadeIn('slow');
        $(this).css({'background-color':'#3973ac'});
      //  console.log('1');
    }else{
      $('ul li ul').css('display','none');
      $('ul li').fadeIn('slow');//.css('display','block');
      $(this).css('background-color','#264d73');
    //  console.log('2');
    }
  }else if ($(this).index() == 2 && width < 966) {
    if ($('ul li ul').css('display') == 'none'){
      $(this).prev().css('display', 'none');
      $(this).nextAll().css('display', 'none');
      $('ul li ul').css({'top': '65px'});
      $('ul li ul').fadeIn('slow');
      $(this).children().fadeIn('slow');
      $(this).css('background-color','#3973ac');
      //console.log('1');
    }else{
      $('ul li ul').css('display','none');
      $('ul li').fadeIn('slow');//.css('display','block');
      $(this).css('background-color','#264d73');
    //  console.log('2');
    }
  }
  else if ($(this).index() == 3 && width < 966) {
    if ($('ul li ul').css('display') == 'none'){
      $('ul li ul').css('display', 'block');
      $(this).children().css('display','block');
      $('ul li ul').css({'top': '65px'});
      $(this).prev().css('display','none');
      $(this).prev().prev().css('display','none');
      $(this).next().css('display','none');
      $(this).css('background-color','#3973ac');
      //console.log('1');
    }else{
      $('ul li ul').css('display','none');
      $('ul li').fadeIn('slow');//.css('display','block');
      $(this).css('background-color','#264d73');
    //  console.log('2');
    }
  }
});

  /*==========================================================
                  RESIZE WINDOW
  ========================================================*/

  //$(window).on('resize', btnFunction());

    // var respoWidth = $(window).width();
    // console.log(respoWidth);
    // if (respoWidth > 950 ) {
    //   $('nav').load('header.php ul');
    // }


// myFunction();
//
// function myFunction(){
//   console.log('myFunction called');
  // $(window).on('resize', function () {
  //   console.log('resized');
  //     if ($(window).width() > 950) {
  //       $('nav').css('display', 'block');
  //       $('nav').load('header.php ul');
  //       console.log('OK Boomer');
  //     }else if ($(window).width() < 950) {
  //       $('nav').css('display', 'none');
  //       $('nav').load('header.php ul');
  //     }
  // });
//}
//$('nav ul').load(header.php + ' nav');
//$('nav').css('display') == 'none' &&
// if (isRespo = 1;){
//     var respSite = 0;
//     console.log(respSite);
//     console.log('egine to if');
//     $('nav').load(header.php + " nav");
//
// }

/*==========================================================
                FORM VALIDATION
========================================================*/

var emailReg = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
var name = $('#name').val();
var validName = false;
var lastName = $('#lastname').val();
var validLastName = false;
var mail = $('#email').val();
var validMail = false;
var formText = $('#form-text').val();
var validFormText = false;

//----------------- FIRST NAME ----------------

$('#name').focusin(function(event){
  event.preventDefault();

  if (!validName) {
    $(this).val('');
    $(this).css({ 'border-color': '#fff',
                  'color': 'black'});
        //  console.log('focus in !validName ');
  }else if (validName && $(this).val().length >= 4) {
    validName = true;
    name = $('#name').val();
    $(this).val(name);
    $(this).css({ 'border-color': '#fff',
                  'color': '#000'});
          //  console.log('focus in validName is ' +validName+ ' name = ' +name)
  }

});

$('#name').focusout(function(){

  if ($(this).val().length <= 3) {
    $(this).val('Minimum 4 characters!');
    $(this).css({ 'border-color': '#cc0000',
                  'color': '#cc0000'});
    validName = false;
        //  console.log('focus out validName= ' +validName);
  }else if ($(this).val().length >= 4){
    validName = true;
    name = $('#name').val();
    $(this).val(name);
  //  console.log('focus out validName is ' +validName+ ' name =' +name);

  }
});

//----------------- LAST NAME ----------------

$('#lastname').focusin(function(event){
  event.preventDefault();

  if (!validLastName) {
    $(this).val('');
    $(this).css({ 'border-color': '#fff',
                  'color': 'black'});
        //  console.log('focus in !validLastName ');
  }else if (validLastName && $(this).val().length >= 4) {
    validLastName = true;
    lastName = $('#lastname').val();
    $(this).val(lastName);
    $(this).css({ 'border-color': '#fff',
                  'color': '#000'});
          //  console.log('focus in validLastName is ' +validLastName+ ' name = ' +lastName)
  }

});

$('#lastname').focusout(function(){

  if ($(this).val().length <= 3) {
    $(this).val('Minimum 4 characters!');
    $(this).css({ 'border-color': '#cc0000',
                  'color': '#cc0000'});
    validLastName = false;
        //  console.log('focus out validName= ' +validLastName);
  }else if ($(this).val().length >= 4){
    validLastName = true;
    lastName = $('#lastname').val();
    $(this).val(lastName);
    //console.log('focus out validLastName is ' +validLastName+ ' last name =' +lastName);

  }
});

//----------------- TEXTAREA ----------------

$('#form-text').focusin(function(event){
  event.preventDefault();

  if (!validFormText) {
    $(this).val('');
    $(this).css({ 'border-color': '#fff',
                  'color': 'black'});
          //console.log('focus in !validFormText ');
  }else if (validFormText && $(this).val().length >= 4) {
    validFormText = true;
    formText = $('#form-text').val();
    $(this).val(formText);
    $(this).css({ 'border-color': '#fff',
                  'color': '#000'});
            //console.log('focus in validFormText is ' +validFormText+ ' name = ' +formText)
  }

});

$('#form-text').focusout(function(){

  if ($(this).val().length <= 3) {
    $(this).val('Minimum 4 characters!');
    $(this).css({ 'border-color': '#cc0000',
                  'color': '#cc0000'});
    validFormText = false;
          //console.log('focus out validFormText= ' +validFormText);
  }else if ($(this).val().length >= 4){
    validFormText = true;
    formText = $('#form-text').val();
    $(this).val(formText);
    //console.log('focus out validFormText is ' +validFormText+ ' last name =' +formText);
  }
});

//----------------- EMAIL ----------------

$('#email').focusin(function(event){
  event.preventDefault();

  if (!validMail) {
    $(this).val('');
    $(this).css({ 'border-color': '#fff',
                  'color': 'black'});
          //console.log('focus in !validMail ');
  }else if (validMail && $(this).val().length >= 4) {
    validMail = true;
    mail = $('#email').val();
    $(this).val(mail);
    $(this).css({ 'border-color': '#fff',
                  'color': '#000'});
            //console.log('focus in validMail is ' +validMail+ ' mail = ' +mail)
  }

});

$('#email').focusout(function(){

  if ($(this).val().length <= 3) {
    $(this).val('Minimum 4 characters!');
    $(this).css({ 'border-color': '#cc0000',
                  'color': '#cc0000'});
    validMail = false;
          //console.log('focus out validMail= ' +validMail);
  }else if ($(this).val().length >= 4){
      if (emailReg.test($(this).val())){
      validMail = true;
      mail = $('#email').val();
      $(this).val(mail);
      //console.log('focus out validMail is ' +validMail+ ' mail =' +mail);
    }else {
      $(this).val('Not a valid email!');
      $(this).css({ 'border-color': '#cc0000',
                    'color': '#cc0000'});
      validMail = false;
    }
  }
});

$('button').click(function(){

if (validName && validLastName && validMail && validFormText){
  $('.contactForm').submit();
}else{
  $('#obligatoire').css({'color': '#cc0000',
                        'font-weight': 'bold'});
}

});

$('button').click(function(){

if (validName && validLastName && validMail && validFormText){
  $('.commentForm').submit();
}else{
  $('#obligatoire').css({'color': '#cc0000',
                        'font-weight': 'bold'});
}

});

/*==========================================================
                GUESTBOOK
========================================================*/

var commentCount = 0;
var firstID = $('#guestbookMain > div:eq(0)').attr('id');
var secondID = $('#guestbookMain > div:eq(1)').attr('id');
var thirdID = $('#guestbookMain > div:eq(2)').attr('id');
$('#loadMoreComm').click(function(){

  commentCount = commentCount + 3;

  $('#newCont').load('loadComments.php',{
    firstID : firstID,
    secondID : secondID,
    thirdID : thirdID,
    commentNewCount : commentCount
  });

});


});//https://regexr.com/
