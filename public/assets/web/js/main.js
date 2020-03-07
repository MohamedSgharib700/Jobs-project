function deleteModal(modalId){
    // alert(modalId);
    // $('#'+modalId).modal('show');

    $('a[href$="#'+modalId+'"]').on( "click", function(e) {
        e.preventDefault();
        $('#'+modalId).modal('show');
        return false;
    });
    return false;
}

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

  $('#seekerLabel').on("click", function () {

  $('#choose-bg').css('background-image', 'url(../assets/web/img/jobseeker_bg.jpg)').fadeIn(10000);
    $('#seekerLabel').css("color", "#D84861");
    $('#ownerLabel').css("color", "#7E7E94");
    $("#seekerImage").attr("src", "../assets/web/img/Icons/radio_checked.png");
    $("#ownerImage").attr("src", "../assets/web/img/Icons/radio_unchecked.png");
  });

  $('#ownerLabel').on("click", function () {
    $('#choose-bg').css('background-image', 'url(../assets/web/img/businessowner_bg.jpg)');
    $('#ownerLabel').css("color", "#D84861");
    $('#seekerLabel').css("color", "#7E7E94");
    $("#seekerImage").attr("src", "../assets/web/img/Icons/radio_unchecked.png");
    $("#ownerImage").attr("src", "../assets/web/img/Icons/radio_checked.png");
  });
  

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
    $(this).hide();
  });

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
          $("#mdtimer").hide(1000).fadeOut(1000);
      }
  }, 1000);
});
