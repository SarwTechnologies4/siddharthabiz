/*------------------------------------------------------------------
* Project:        Hotux
* Author:         CN-InfoTech
* URL:            hthttps://themeforest.net/user/cn-infotech
* Created:        01/08/2020
-------------------------------------------------------------------*/


(function ($) {


   "use strict";

   /*======== Doucument Ready Function =========*/
    jQuery(document).ready(function () {
     //CACHE JQUERY OBJECTS
      $("#status").fadeOut();
      $("#preloader").delay(200).fadeOut("slow");
      $("body").delay(200).css({ "overflow": "visible" });

      
      /* Init Wow Js */
      new WOW().init();

    });


  // Mouse-enter dropdown
  $('#navbar li').on('mouseenter', function () {
    $(this).find('ul').first().stop(true, true)
      .delay(350)
      .slideDown(500, 'easeInOutQuad');
  });
  // Mouse-leave dropdown
  $('#navbar li').on('mouseleave', function () {
    $(this).find('ul').first().stop(true, true)
      .delay(100)
      .slideUp(150, 'easeInOutQuad');
  });

  $(window).scroll(() => {
    if ($(window).scrollTop() > 10) {
      $('.navigation').addClass('navbar-sticky');
    } else {
      $('.navigation').removeClass('navbar-sticky');
    }
  });

  /* ------------------------------------------------------------------------ */
  /* BACK TO TOP
/* ------------------------------------------------------------------------ */

  $(document).on('click', '#back-to-top, .back-to-top', () => {
    $('html, body').animate({ scrollTop: 0 }, '500');
    return false;
  });
  $(window).on('scroll', () => {
    if ($(window).scrollTop() > 500) {
      $('#back-to-top').fadeIn(200);
    } else {
      $('#back-to-top').fadeOut(200);
    }
  });

  jQuery(document).ready(() => {
    jQuery('.js-video-button').modalVideo({ channel: 'vimeo' });
    $('.content-add').on('click', function(){
      window.location.href = "app"; 
    })


    $('.hotelmenu').on('click', function(){
        $('.mobmenu').removeClass('show');
    })
  });


  $('.review-slider').slick({
    infinite: true,
    slidesToShow: 2,
    slidesToScroll: 1,
    arrows: false,
    dots: true,
    autoplay: true,
    responsive: [
      {
        breakpoint: 1000,
        settings: {
          slidesToShow: 1
        }
      }
    ]
  });

  $('.review-slider1').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    dots: false,
    autoplay: true,
  });


  $('.award-slider').slick({
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    arrows: false,
    dots: false,
    autoplay: true,
    responsive: [
      {
        breakpoint: 1000,
        settings: {
          slidesToShow: 2
        }
      },
      {
        breakpoint: 500,
        settings: {
          slidesToShow: 1
        }
      }
    ]
  });

  $('.team-slider').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: false,
    dots: false,
    autoplay: false,
    responsive: [
      {
        breakpoint: 1000,
        settings: {
          slidesToShow: 2
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1
        }
      }
    ]
  });

  function features() {
    $('.feature-slider').slick({
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    arrows: false,
    dots: true,
    autoplay: false,
    responsive: [
      {
        breakpoint: 1000,
        settings: {
          slidesToShow: 2
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1
        }
      }
    ]
  });
  }

  features();
  // Get the element you want to modify
var yourElement = document.getElementById('header'); // replace 'yourElementId' with the actual ID of your element

// Listen for the scroll event
window.onscroll = function() {
    // Check if the user has scrolled down, for example, when the scroll position is greater than 100 pixels
    if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
        // Add a class to your element
        yourElement.classList.add('stick'); // replace 'stick' with the actual class you want to add
    } else {
        // Remove the class if the user scrolls back to the top
        yourElement.classList.remove('stick');
    }
};




  $('.expand').on('click', function(){
    $('.description').toggleClass('all');
    $(this).toggleClass('all');
    if ($(this).hasClass('all')) {
      $(this).html('<small>Show Less</small>');
    } else {
        $(this).html('<small>Show More</small>');
    }
    
  })

  $('.feature-slider1').slick({
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    arrows: false,
    dots: false,
    autoplay: false,
    responsive: [
      {
        breakpoint: 1000,
        settings: {
          slidesToShow: 2
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1
        }
      }
    ]
  });

  $('.gallery-slider').slick({
    infinite: true,
    slidesToShow: 6,
    slidesToScroll: 1,
    arrows: false,
    dots: false,
    autoplay: true,
    responsive: [
      {
        breakpoint: 1000,
        settings: {
          slidesToShow: 4
        }
      },
      {
        breakpoint: 500,
        settings: {
          slidesToShow: 2
        }
      }
    ]
  });

  $('.slider-store').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.slider-thumbs',
  });

  $('.slider-thumbs').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    asNavFor: '.slider-store',
    dots: false,
    centerMode: true,
    arrows: true,
    focusOnSelect: true,
  });

  $('.slider-for').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    fade: true,
    autoplay:true,
    asNavFor: '.slider-nav',
  });
  $('.slider-nav').slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    asNavFor: '.slider-for',
    dots: false,
    centerMode: true,
    autoplay:true,
    focusOnSelect: true,
  });

  jQuery(document).ready(function () {

    $('.hotelmenu').on('click', function(){
      $('.hotel_menu').toggleClass("menu_active");
    })

    $('.closemenu').on('click', function(){
      $('.hotel_menu').removeClass("menu_active");
    })
    var newValue, oldValue = 0;
    const formbanner = $('.banner-form').position().top ;
    let submenu = 0 ;
    if($('.overview-inner .sbmenu').length){
      submenu = $('.overview-inner .sbmenu').offset().top ;
      
    }

    

    $(window).scroll(()=>{
      // Get the new Value 
      newValue = $(window).scrollTop();
      //Subtract the two and conclude
      //console.log(submenu);
      if($(window).scrollTop()>300){  
        if(oldValue - newValue < 0){
            
          // console.log('up');
          $('header').css({top:'-100px', opacity:'0'});
          if($(window).scrollTop() >= formbanner && $(window).scrollTop() >= submenu ){
            
            $('.home .banner-form, .sbmenu').addClass('sty');
            $('.home .banner-form, .sbmenu').css({top:'0px'});
          }
        } else if(oldValue - newValue > 0){
            // console.log("Down");
          $('header').css({top:'0px', opacity:'1'});
          if($(window).scrollTop() >= formbanner && $(window).scrollTop() >= submenu ){
            $('.home .banner-form, .sbmenu').css({top:'100px'});
          }else{
            $('.home .banner-form, .sbmenu').removeClass('sty');
            $('.home .banner-form, .sbmenu').css({top:'auto'});
          };
        }
      }
      // Update the old value
      oldValue = newValue;
    });
  });


  // Date Picker
  $('#datepicker, #check-datepicker').datepicker();

  // selectPicker
  $('.selectpicker').selectpicker();

  // Nice Select JS
  $('.niceSelect').niceSelect();

  // accordian

  if ($('.accrodion-grp').length) {
    const accrodionGrp = $('.accrodion-grp');
    accrodionGrp.each(function () {
      const accrodionName = $(this).data('grp-name');
      const Self = $(this);
      const accordion = Self.find('.accrodion');
      Self.addClass(accrodionName);
      Self.find('.accrodion .accrodion-content').hide();
      Self.find('.accrodion.active').find('.accrodion-content').show();
      accordion.each(function () {
        $(this).find('.accrodion-title').on('click', function () {
          if ($(this).parent().hasClass('active') === false) {
            $(`.accrodion-grp.${accrodionName}`).find('.accrodion').removeClass('active');
            $(`.accrodion-grp.${accrodionName}`).find('.accrodion').find('.accrodion-content').slideUp();
            $(this).parent().addClass('active');
            $(this).parent().find('.accrodion-content').slideDown();
          }
        });
      });
    });
  }

  $("#contactform").validate({      
    submitHandler: function() {
      
      $.ajax({
        url : 'mail/contact.php',
        type : 'POST',
        data : {
          fname : $('input[name="first_name"]').val(),
          lname : $('input[name="last_name"]').val(),
          email : $('input[name="email"]').val(),
          phone : $('input[name="phone"]').val(),
          comments : $('textarea[name="comments"]').val(),
        },
        success : function( result ){
          $('#contactform-error-msg').html( result );
          $("#contactform")[0].reset();
        }     
      });

    }
  });

  /*= ======= Isotope Filter Script ========= */

  const mt_personal = window.mt_personal || {};
  const $win = $(window);

  mt_personal.Isotope = function () {
    // 4 column layout
    const isotopeContainer = $('.isotopeContainer');
    if (!isotopeContainer.length || !jQuery().isotope) return;
    $win.on('load', () => {
      isotopeContainer.isotope({
        itemSelector: '.isotopeSelector',
      });
      $('.mt_filter').on('click', 'a', function (e) {
        $('.mt_filter ul li').find('.active').removeClass('active');
        $(this).addClass('active');
        const filterValue = $(this).attr('data-filter');
        isotopeContainer.isotope({ filter: filterValue });
        e.preventDefault();
      });
    });
  };

  mt_personal.Isotope();


  // Range sliders activation
  $('.range-slider-ui').each(function () {
    const minRangeValue = $(this).attr('data-min');
    const maxRangeValue = $(this).attr('data-max');
    const minName = $(this).attr('data-min-name');
    const maxName = $(this).attr('data-max-name');
    const unit = $(this).attr('data-unit');

    $(this).slider({
      range: true,
      min: minRangeValue,
      max: maxRangeValue,
      values: [minRangeValue, maxRangeValue],
      slide(event, ui) {
        event = event;
        const currentMin = parseInt(ui.values[0], 10);
        const currentMax = parseInt(ui.values[1], 10);
        $(this).children('.min-value').text(`${currentMin} ${unit}`);
        $(this).children('.max-value').text(`${currentMax} ${unit}`);
        $(this).children('.current-min').val(currentMin);
        $(this).children('.current-max').val(currentMax);
      },
    });
  });

  $('#counter-block').ready(() => {
    $('.room').animationCounter({
      start: 0,
      end: 264,
      step: 2,
      delay: 10,
    });
    $('.staff').animationCounter({
      start: 12,
      end: 575,
      step: 2,
      delay: 15,
    });
    $('.restaurant').animationCounter({
      start: 25,
      end: 487,
      step: 2,
      delay: 12,
    });
    $('.award').animationCounter({
      start: 25,
      end: 320,
      step: 1,
      delay: 11,
    });
  });

  $(document).ready(() => {
    loopcounter('coming-counter');
  });


  window.FPConfig = {
    delay: 0,
    ignoreKeywords: [],
    maxRPS: 3,
    hoverDelay: 50,
  };


  niceSelect_destroy();
// form validations
var base_url = $('base').attr('url');

$.validator.addMethod("minDob", function(value, element) {
    var minDobDate = new Date();
    minDobDate.setFullYear(minDobDate.getFullYear() - 18);
    minDobDate.setHours(0);
    minDobDate.setMinutes(0);
    minDobDate.setSeconds(0);
    var inputDate = new Date(value);
    inputDate.setHours(0);
    inputDate.setMinutes(0);
    inputDate.setSeconds(0);
    if (inputDate <= minDobDate)
        return true;
    return false;
}, "Age must be above 18 years old!");
    let registerFormRules = {
      'customer' : {
          customer_user_type: {required: !0},
          customer_name: {required: !0},
          customer_username: {required: !0},
          customer_email: {required: !0, email: !0},
          customer_contact_number: {required: !0},
          customer_address: {required: !0},
          customer_nationality: {required: !0}
      },
      'organization' : {
          organization_user_type: {required: !0},
          organization_name: {required: !0},
          organization_username: {required: !0},
          organization_email: {required: !0, email: !0},
          organization_contact_number: {required: !0},
          organization_address: {required: !0},
          organization_nationality: {required: !0},
          organization_type: {required: !0},
          organization_contact_person_name: {required: !0},
          organization_contact_person_email: {required: !0},
          organization_contact_person_contact_number: {required: !0}
      },
      'agency' : {
          agency_user_type: {required: !0},
          agency_name: {required: !0},
          agency_username: {required: !0},
          agency_email: {required: !0, email: !0},
          agency_contact_number: {required: !0},
          agency_address: {required: !0},
          agency_dob: {required: !0, minDob: !0},
          agency_province_id: {required: !0},
          agency_district_id: {required: !0},
          agency_ward: {required: !0},
          agency_occupation: {required: !0}
      }
  }
  
  let registerFormMessages = {
      customer_user_type: {required: "Select Membership Type"}, agency_user_type: {required: "Select Membership Type"}, organization_user_type: {required: "Select Membership Type"},
      customer_name: {required: "Enter your Full Name"}, agency_name: {required: "Enter your Full Name"}, organization_name: {required: "Enter your Full Name"},
      customer_username: {required: "Enter your User Name"}, agency_username: {required: "Enter your User Name"}, organization_username: {required: "Enter your User Name"},
      customer_email: {
          required: "Enter your Email Address",
          email: "Enter a valid email address"
      },
      agency_email: {
          required: "Enter your Email Address",
          email: "Enter a valid email address"
      },
      organization_email: {
          required: "Enter your Email Address",
          email: "Enter a valid email address"
      },
      customer_contact_number: {required: "Enter your Contact Number"}, agency_contact_number: {required: "Enter your Contact Number"}, organization_contact_number: {required: "Enter your Contact Number"},
      customer_address: {required: "Enter your address"}, agency_address: {required: "Enter your address"}, organization_address: {required: "Enter your address"},
      customer_nationality: {required: "Enter your Nationality"}, agency_nationality: {required: "Enter your Nationality"}, organization_nationality: {required: "Enter your Nationality"},
      customer_password: {required: "Enter your Password"}, agency_password: {required: "Enter your Password"}, organization_password: {required: "Enter your Password"},
      organization_type: {required: "Enter your Organization Type"},
      organization_contact_person_name: {required: "Enter Full Name"},
      organization_contact_person_email: {required: "Enter Email"},
      organization_contact_person_contact_number: {required: "Enter Contact Number"},
      agency_dob: {required: "Enter your DOB"},
      agency_province_id: {required: "Enter your Province"}, organization_province_id: {required: "Enter your Province"},
      agency_district_id: {required: "Enter your District"}, organization_district_id: {required: "Enter your District"},
      agency_ward: {required: "Enter your Ward No"}, organization_ward: {required: "Enter your Ward No"},
      agency_occupation: {required: "Enter your Occupation"}
  };
  
  $(document).ready(function () {
      $("#main-register-form2").validate({
          errorElement: 'p',
          errorClass: 'text-danger',
          rules: {
              ...registerFormRules.customer,
              ...registerFormRules.agency,
              ...registerFormRules.organization,
              customer_password: {required: !0},
              agency_password: {required: !0},
              organization_password: {required: !0}
          },
          messages: registerFormMessages,
          submitHandler: function (form) {
              if (form) {
                  let userType = $(".user-type-btn-check:checked").val();
                  var Frmval = $(`#main-register-form2 .${userType}-register-fields`).find('select, textarea, input').serialize();
                  Frmval = `${Frmval}&user_type=${userType}`;
                  $("button#submitRegister").attr("disabled", "true").text('Processing...');
                  $.ajax({
                      type: "POST",
                      dataType: "JSON",
                      url: base_url + "includes/controllers/ajax.user.php",
                      data: "action=registerNewFrontUser&" + Frmval,
                      success: function (data) {
                          var msg = eval(data);
                          $("button#submitRegister").removeAttr("disabled").text('Register');
                          if (msg.action == 'success') {
                              $('#msgRegister').html(msg.message).css('display', 'block').fadeOut(8000);
                              $("form#main-register-form2")[0].reset();
                          }
                          if (msg.action == 'error') {
                              $('#msgRegister').html(msg.message).css('display', 'block').fadeOut(8000);
                          }
                      }
                  });
                  return !1;
              }
          }
      })
  
      // for google
      $("#google-register-form2").validate({
          errorElement: 'p',
          errorClass: 'text-danger',
          rules: {
              ...registerFormRules.customer,
              ...registerFormRules.agency,
              ...registerFormRules.organization
          },
          messages: registerFormMessages,
          submitHandler: function (form) {
              if (form) {
                  let userType = $(".user-type-btn-check:checked").val();
                  // var Frmval = $("#google-register-form2").serialize();
                  var Frmval = $(`#google-register-form2 .${userType}-register-fields`).find('select, textarea, input').serialize();
                  Frmval = `${Frmval}&user_type=${userType}`;
                  $("button#submitRegister").attr("disabled", "true").text('Processing...');
                  $.ajax({
                      type: "POST",
                      dataType: "JSON",
                      url: base_url + "includes/controllers/ajax.user.php",
                      data: "action=registerNewFrontUserFromGoogleLogin&" + Frmval,
                      success: function (data) {
                          console.log(data)
                          var msg = eval(data);
                          $("button#submitRegister").removeAttr("disabled").text('Register');
                          if (msg.action == 'success') {
                              $('#msgRegister').html(msg.message).css('display', 'block').fadeOut(8000);
                              $("form#google-register-form2")[0].reset();
                              $("#otp-verification-form2").show();
                              $("#google-register-form2").hide();
                          }
                          if (msg.action == 'error') {
                              $('#msgRegister').html(msg.message).css('display', 'block').fadeOut(8000);
                          }
                      },
                      error: function (data) {
                          var msg = eval(data);
                          $("button#submitRegister").removeAttr("disabled").text('Register');
                          if(data.responseText.startsWith("Could not instantiate mail function")) {
                              $('#msgOtpNotification').html("OTP mailing service is currently unavailable. Please contact administrator (database).");
                              $("#otp-verification-form2").show();
                              $("#google-register-form2").hide();
                          } else {
                              $(".main-register-wrap").hide();
                              alert("Something went wrong");
                          }
                          
                      }
                  });
  
                  return !1;
              }
          }
      })
  
      $("#otp-verification-form2").validate({
          errorElement: 'p',
          errorClass: 'text-danger',
          rules: {
              otp: {minlength: 6, maxlength: 6, required: !0},
          },
          messages: {
              otp: {minlength: "Enter a 6-digit OTP", maxlength:"Enter a 6-digit OTP", required:"Enter a 6-digit OTP"},
          },
          submitHandler: function (form) {
              if (form) {
                  var Frmval = $("#otp-verification-form2").serialize() + `&email=${$("input[name='google_email']").val()}`;
                  $("button#submitOtp").attr("disabled", "true").text('Processing...');
                  $.ajax({
                      type: "POST",
                      dataType: "JSON",
                      url: base_url + "includes/controllers/ajax.user.php",
                      data: "action=otpVerificationForGoogleRegister&" + Frmval,
                      success: function (data) {
                          console.log(data)
                          var msg = eval(data);
                          $("button#submitOtp").removeAttr("disabled").text('Register');
                          if (msg.action == 'success') {
                              $('#msgOtpVerificationSuccess').html(msg.message).css('display', 'block').fadeOut(8000);
                              $("form#otp-verification-form2")[0].reset();
                              setTimeout(function () {
                                  return window.location.href = base_url;
                              }, 2000);
                          }
                          if (msg.action == 'error') {
                              $('#msgOtpVerificationFail').html(msg.message).css('display', 'block').fadeOut(8000);
                          }
                      },
                      error: function (data) {
                          console.log("error...");
                          $("button#submitOtp").removeAttr("disabled").text('Register');
                      }
                  });
  
                  return !1;
              }
          }
      }) 
  })
  var modal = {};
    modal.hide = function () {
        $('.modal , .reg-overlay').fadeOut(200);
        $("html, body").removeClass("hid-body");
    };
    $('.modal-open').on("click", function (e) {
        e.preventDefault(); console.log('asdasd');
        $('.modal , .reg-overlay').fadeIn(200);
        $("html, body").addClass("hid-body");
    });
    $('.close-reg , .reg-overlay').on("click", function () {
        modal.hide();
    });
    

    
    // Login Form
    $("#main-login-form2").validate({
      errorElement: 'p',
      errorClass: 'text-danger',
      rules: {
          email: {
              required: !0
          },
          password: {required: !0}
      },
      messages: {
          name: {
              required: "Enter your Full Name"
          },
          username: {
              required: "Enter your User Name"
          },
          email: {
              required: "Enter your Username or Email Address"
          },
          password: {required: "Enter your Password"}
      },
      submitHandler: function (form) {
          if (form) {
              var Frmval = $("#main-login-form2").serialize();
              $("button#submitLogin").attr("disabled", "true").text('Processing...');
              $.ajax({
                  type: "POST",
                  dataType: "JSON",
                  url: base_url + "includes/controllers/ajax.user.php",
                  data: "action=frontlogin&" + Frmval,
                  success: function (data) {
                      var msg = eval(data);
                      $("button#submitLogin").removeAttr("disabled").text('Log In');
                      if (msg.action == 'success') {
                          $('#msgLogin').html(msg.message).css('display', 'block').fadeOut(8000);
                          setTimeout(function () {
                              return window.location.href = "";
                              $('.modal , .reg-overlay').fadeOut(200);
                              $("html, body").removeClass("hid-body");
                          }, 2000);
                          $("form#main-login-form2")[0].reset();
                      }
                      if (msg.action == 'error') {
                          $('#msgLogin').html(msg.message).css('display', 'block').fadeOut(8000);
                      }
                  }
              });
              return !1;
          }
      }
  })

  // Switch Login and forgot form
  $(".switch-button").click(function (a) {
      a.preventDefault();
      var b = $(this).attr("switch-parent");
      $(b).slideToggle();
      var c = $(this).attr("switch-target");
      $(c).slideToggle();
  })

  // Forgot Password
  $("#main-forgot-password-form2").validate({
      rules: {
          email: {
              required: !0,
              email: !0
          }
      },
      messages: {
          email: {
              required: "Enter your email address",
              email: "Enter a valid email address"
          }
      },
      submitHandler: function (form) {
          if (form) {
              var Frmval = $("#main-forgot-password-form2").serialize();
              $('#submitForgot').attr("disabled", "true").text('Processing...');
              $.ajax({
                  type: "POST",
                  dataType: "JSON",
                  url: base_url + "includes/controllers/ajax.user.php",
                  data: "action=forgetuserpassword&" + Frmval,
                  success: function (data) {
                      var msg = eval(data);
                      $("#submitForgot").removeAttr("disabled").text('Recover Password');
                      if (msg.action == 'success') {
                          $('#msgForgot').html(msg.message).css('display', 'block').fadeOut(8000);
                          setTimeout(function () {
                              return window.location.href = "";
                          }, 5000);
                          $("form#main-forgot-password-form2")[0].reset();
                      }
                      if (msg.action == 'unsuccess') {
                          $('#msgForgot').html(msg.message).css('display', 'block').fadeOut(8000);
                      }
                  }
              });
              return !1;
          }
      }
  })
}(jQuery));

/**
* Make height equal to screen
*/

jQuery(window).on('resize load', () => {
  resize_eb_slider();
}).resize();

/**
* Resize slider
*/

function resize_eb_slider() {
  let bodyheight = jQuery(this).height();

  if (jQuery(window).width() > 1400) {
    // bodyheight *= 0.90;
    jQuery('.slider').css('height', `${bodyheight}px`);
  }
}


function niceSelect_destroy() {
  if (jQuery(window).width() < 768) {
    $('.niceSelect').niceSelect('destroy');
  } else {
    $('.niceSelect').niceSelect('update');
  }
}


jQuery(document).on('click','.dark-mode a',function(){
  jQuery('body').addClass('night-mode');
});
jQuery(document).on('click','.light-mode a',function(){
  jQuery('body').removeClass('night-mode');

  
});




$('.hotel-tab').on('click', function(){
  // alert('tet');
  $('.menus div').removeClass('active');
  $(this).addClass('active');
  $('.pan').removeClass('dsplay');
  $('.hotel_panel').toggleClass('dsplay');
  
})
$('.restaurant-tab').on('click', function(){
  $('.menus div').removeClass('active');


  $(this).addClass('active');

  $('.pan').removeClass('dsplay');
  $('.restaurant_panel').toggleClass('dsplay');
})
$('.cafe-tab').on('click', function(){
  $('.menus div').removeClass('active');


  $(this).addClass('active');

  $('.pan').removeClass('dsplay');
  $('.cafe_panel').toggleClass('dsplay');
})


