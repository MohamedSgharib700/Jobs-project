$(document).ready(function () {

  // index screen
  $('.tabs ul li').on('click', function () {
    $(this).addClass('active').siblings().removeClass('active');
  });
  $(".tabs ul li").on("click", function () {
    var myid = $(this).attr("id");
    $(".content .sub-content").hide();
    $(".img").hide();
    $("#" + myid + "-content").fadeIn(1000);
    $("#" + myid + "-contente").fadeIn(1000);
    // console.log(myid);
  });


  // choose screen


  $('#aa').on("click", function () {

  $('#choose-bg').css('background-image', 'url(./img/jobseeker_bg.jpg)').fadeIn(10000);
    $('#aa').css("color", "#D84861");
    $('#bb').css("color", "#7E7E94");
    $("#dd").attr("src", "./img/Icons/radio_checked.png");
    $("#ff").attr("src", "./img/Icons/radio_unchecked.png");
  });

  // $('#choose-bg').animate({
  //   'background-position-x': '10%',
  //   'background-position-y': '20%'
  // }, 10000, 'linear');
//   $('#choose-bg').each(function(index) {
//      $(this).hide();
//      $(this).delay(8000* index).fadeIn(8000).fadeOut();
// });

  $('#bb').on("click", function () {
    $('#choose-bg').css('background-image', 'url(./img/businessowner_bg.jpg)');
    $('#bb').css("color", "#D84861");
    $('#aa').css("color", "#7E7E94");
    $("#dd").attr("src", "./img/Icons/radio_unchecked.png");
    $("#ff").attr("src", "./img/Icons/radio_checked.png");
  });


  $("#sign").on("click", function () {

    if ($("#cc").is(':checked')) {
      $(this).attr("href", "./stepper1.html");
    }
    if ($("#gg").is(':checked')) {
      $(this).attr("href", "./Bo-stepper1.html");

    }
  })

  //notification Load MOre

  $('.box-hiddene').slice(0, 10).show();
  $('#loadMore').on('click', function (e) {
    e.preventDefault();
    $('.box-hiddene:hidden').slice(0, 3).show();
    if ($('.box-hiddene:hidden').length == 0) {
      $('#loadMore').fadeOut('slow');
    };
    $('html, body').animate({
      scrollTop: $(this).offset().top
    }, 1500);
  });

  // stepper screen

  $('.skils-card').on('click', function () {
    alert("dsaasdasd");
    $(this).hide();
  });

  // $(".check-label").on("click", function () {

  //   if ($('.mycheck').is(':checked')) {
  //     $('.check-label').css("color", "#D84861");
  //     $(".check-img").attr("src", "./img/Icons/checkbox_done.png");

  //   }
  //   else if(!$(".mycheck").is(':checked')) {
  //     $('.check-label').css("color", "#7E7E94");
  //     $(".check-img").attr("src", "./img/Icons/checkbox_outline.png");

  //   }
  // })
  // $('#exampleFormControlFile1').on('click', function () {

  //   $(".progress-bar").add();
  // });







  // setting screen

  $(".tabs li").on("click", function () {
    $(this).addClass("active").siblings().removeClass("active")
  });
  $(".my-content:not(:first-of-type)").hide();

  $(".tabs  li").on("click", function () {
    var myid = $(this).attr("id");
    $(".my-content").hide();
    $("#" + myid + "-contetnt").fadeIn();
    // console.log(myid);
  });

  //Search page
  $('.box-ch').first().slideDown();
  $('.box-filtter .box-p').on('click',function(){
      $(this).find('img').toggle();
    var myId = $(this).attr('id');
        myId = myId + 'content';
      // $(myid).fadeIn();

      $('#' + myId).slideToggle();
    // console.log('#' + myId);
  });

  $('.box-jobs').on('click',function(){
    window.location = $(this).find(".mylink").attr("href");
  });



  // $('.box-edit').on('click',function(){
  //   // window.location = $(this).find(".ali").attr("href");
  //   $( ".ali" ).trigger( "click" );
  // });

  // $('.delete').on('click',function(e){
    $('a[href$="#Modal1"]').on( "click", function() {
      $('#Modal1').modal('show');
       return false;
     });
  // });

});



// upload file stepper2

function imageLoader(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
          // $(".form-control-file").progressTimer({ timeLimit: 10 });
          $("#progressTimer").progressTimer({
                timeLimit: 5,
                warningThreshold: 2,
                baseStyle: 'progress-bar-warning',
                warningStyle: 'progress-bar-danger',
                completeStyle: 'progress-bar-info',

                onFinish: function() {
                console.log("I'm done");
                }
          });
    }

    reader.readAsDataURL(input.files[0]);
  }
 }
//  notifcation reload
 jQuery(document).ready(function () {
  var sec = 10
  var timer = setInterval(function () {
      $("#mdtimer span").text(sec--);
      if (sec == 0) {
          $("#makingdifferenttimer").delay(1000).fadeIn(1000);
          $("#mdtimer").hide(1000).fadeOut(fast);
      }
  }, 1000);
});
