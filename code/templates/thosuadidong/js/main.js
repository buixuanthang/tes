$(document).ready(function() {

  $('#number1').each(function () {
    $(this).prop('Counter',4664).animate({
        Counter: $(this).text()
    }, {
        duration: 205000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
  });

  $('#number2').each(function () {
    $(this).prop('Counter',5714).animate({
        Counter: $(this).text()
    }, {
        duration: 200000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
  });

  $('#number3').each(function () {
    $(this).prop('Counter',403).animate({
        Counter: $(this).text()
    }, {
        duration: 200000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
  });
});




var is_rewrite = 1;
var root = '/';
$(function() {
    $('.lazy').Lazy();
//    change_region();
    load_fb();
});
// $(document).ready(function(){	
// 	$(window).scroll(function(){
// 		if ($(this).scrollTop() > 500) {
// 			$('.totop').fadeIn();
// 		} else {
// 			$('.totop').fadeOut();
// 		}
// 	});
// 	$('.totop').click(function(){
// 		$('html, body').animate({scrollTop : 0},800);
// 		return false;
// 	});
// 	fb_support_online();
// 	// $('.tooltip').tooltipster({
// 	// });

// });	

$(function () {
	$('#problems_wrapper').addClass('hello');
  var width = $(window).width();
  $(window).resize(function() {
    width = $(window).width();
  });



	
	var lastScrollTop = 0;
	$(window).scroll(function () {

		st = $(this).scrollTop();
    Itid = $('#Itid').val();
     if ($("#problems_wrapper").length > 0){
      scroll_pre_pos($('#problems_wrapper'),2);
    }

    // scroll_pos($('#pos1'),2);
    // scroll_pos($('#pos2'),2);
    // scroll_pos($('#pos3'),2);
    if ($("#pos6").length > 0){
      scroll_pos($('#pos7'),2);
    }
     
     
    
    if(width > 950){ // pc
  		if (st >150) {
  			
          if(st <  lastScrollTop) {
              	$("#menu-fixed-bar").removeClass("slide-down").addClass("slide-up").css({position:'fixed',top:'0px'});
              $('.header_wrapper').css('margin-bottom','50px');
          }
          else {
            $("#menu-fixed-bar").removeClass("slide-up").addClass("slide-down").css({position:'initial'});
            $('.header_wrapper').css('margin-bottom','0px'); 
          }
      	
  		} else {
  			// $('#menu-fixed-bar').fadeOut(200);
  			$("#menu-fixed-bar").css({position:'initial'}).removeClass("slide-up").removeClass("slide-down");
        $('.header_wrapper').css('margin-bottom','0px'); 
  		}
    }else{ // mobile
      if (st >150) {
        
          if(st <  lastScrollTop) {
                $("#header_inner").removeClass("m-slide-down").addClass("m-slide-up").css({position:'fixed',top:'0px'});
                $('#menu-fixed-bar').addClass('m-menu-fix');
                if(Itid == 1)
                  $('body').css('margin-top','113px');                
                else
                  $('body').css('margin-top','93px');                
          }
          else {
            $("#header_inner").removeClass("m-slide-up").addClass("m-slide-down").css({position:'initial'});
            $('#menu-fixed-bar').removeClass('m-menu-fix'); 
            $('body').css('margin-top','0px');
          }
        
      } else {
        // $('#menu-fixed-bar').fadeOut(200);
        $("#header_inner").css({position:'initial'}).removeClass("m-slide-up").removeClass("m-slide-down");
        $('#menu-fixed-bar').addClass('m-menu-fix'); 
        $('body').css('margin-top','0px');
      }
    }
		lastScrollTop = st;
	});
	

  function scroll_pos(element_id,rate_screen){
    
    if (st > ( element_id.offset().top - $(window).height()/rate_screen) ) {
        // $(".section3 video").fadeIn();      
        
          element_id.addClass('hello');      
       
    }else{ 
        if(st < element_id.offset().top )  {
          element_id.removeClass('hello');    
        }
      
    }
  }

/* Cho pos trên cao */
   function scroll_pre_pos(element_id,rate_screen){
    
    if (st < ( element_id.offset().top + $(window).height()/rate_screen) ) {
        // $(".section3 video").fadeIn();      
        
          element_id.addClass('hello');      
       
    }else{ 
        if(st > element_id.offset().top + element_id.height())  {
          element_id.removeClass('hello');    
        }
      
    }
  }



	$("#fixed-bar")
	.css({position:'fixed',bottom:'0px'})
	.hide();
	$(window).scroll(function () {
		if ($(this).scrollTop() > 400) {
			$('#fixed-bar').fadeIn(200);
		} else {
			$('#fixed-bar').fadeOut(200);
		}
	});
	$('.go-top').click(function () {
		$('html,body').animate({
			scrollTop: 0
		}, 1000);
		return false;
	});
  
	
});

init_captcha();
function init_captcha(){
	if($("#imgCaptcha").length){
		setTimeout(function() {		
			changeCaptcha();		
		}, 1000);
	}
}
function changeCaptcha(){
	var date = new Date();
	var captcha_time = date.getTime();
	$("#imgCaptcha").attr({src:'/libraries/jquery/ajax_captcha/create_image.php?'+captcha_time});
}	
$("img")
.error(function(){
	//  $(this).attr("src", "../images/no-img.png");
});  

/* CHECK CAPTCHA AJAX */
function check_captcha(){
	$('#txtCaptcha').blur(function(){
		if($(this).val() != ''){
			$.ajax({url: "/index.php?module=users&task=ajax_check_captcha&raw=1",
				data: {txtCaptcha: $(this).val()},
				dataType: "text",
				success: function(result) {
					$('label.username_check').prev().remove();
					$('label.username_check').remove();
					if(result == 0){
						invalid('txtCaptcha','Bạn nhập sai mã hiển thị');
					} else {
						valid('txtCaptcha');
						$('<br/><div class=\'label_success username_check\'>'+'Bạn đã nhập đúng mã hiển thị'+'</div>').insertAfter($('#username').parent().children(':last'));
					}
				}
			});
		}
	});
}
function openPopupWindow(obj) { 
	var wID = $(obj).attr('data-id');
	var url = $(obj).attr('data-url')+'&display=popup';
	var width = $(obj).attr('data-width');
	var height = $(obj).attr('data-height');
	var w = window.open(url,wID, 'width='+width+',height='+height+',location=1,status=1,resizable=yes');
	var coords = getCenteredCoords(width,height);
	w.moveTo(coords[0],coords[1]);
}
function login_facebook(data){
	$(window.location).attr('href', data.url);
}

function isValidURL(url){
	var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
		return regexp.test(url);
}

//$(document).ready(function(){
//$(document).bind("contextmenu",function(){
//alert('Bạn không được dùng chuột phải');
//return false;
//});
//});


//$(document).ready(function(){
//var top_footer = $('.footer').position().top;
///* Đính menu xuống footer nếu scrollbar kéo xuống dưới footer */
//$(window).scroll(function () {
//var top_footer_menu = $('.footer_t').offset().top;
//if(top_footer_menu >= top_footer ){
//$('.footer_menu').css('position','inherit')
//}else{
//$('.footer_menu').css('position','fixed')
//}
//});

//});

function fb_support_online(){
	
  jQuery(".chat_fb").click(function() {
		jQuery('.fchat').toggle('slow');
  });
  
}

function load_fb(){
  (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.10&appId=140517186551584";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
}

