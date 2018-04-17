$(function() {
    $("iframe").Lazy();
   	incrementer();
});
var smartTab = jQuery("#smartTab");
var fixedTop = 0;
var headerTabTop = fixedTop + 80;
var clickNum = -1;
$(document).ready(function(){
    // $("#sticker").sticky({ topSpacing: 10 ,bottomSpacing:600});
    //  $("ul.nav li a[href^='#']").click(function(){
    //     $("html, body").stop().animate({
    //         scrollTop: $($(this).attr("href")).offset().top
    //     }, 400);
    // });
	$('#progress_bar_plus').owlCarousel({
	    items:1,
        nav:true,
        dots:true,

	});
 
    $('.show_reply_form').click(function(){
		$('.form_comment_reply').css({"display":"none"});
		$(this).parent().parent().parent().find('.form_comment_reply').first().css({"display":"block"});
	});
	
	
	$('.rate_count').click(function(){
		$('html, body').animate({ scrollTop: $('#comment_add_form').offset().top }, 500);
	});
	// Add new comment 
	
	 $('#commentbt').click(function(){
		 var name = $("#comment_name").val().trim();
		 var email = $("#comment_email").val().trim(); 
		 var textcomment = $("#comment_text").val().trim();
		 if(name == "" || email == "" || textcomment == "") {
			 alert("Bạn cần nhập đầy đủ thông tin trước khi comment");
			 return false;
		 } 
			 
	     var commentForm = $('#comment_add_form');
		 $.ajax({
		 method: "POST",
		 url:"",  
		 data: commentForm.serialize(),
		 success : function(result){
            var resultObj = jQuery.parseJSON(result);
			if(resultObj.success == 1) { 
				 // hide form and clear data 
				 $("#comment_name").val("");
				 $("#comment_email").val("");
				 $("#comment_text").val("");
				 // Display new comment 
				 var commentTempl = $("#commentTempl").clone(); 
				 commentTempl.css({"display":"block"});
				 commentTempl.removeClass("item-reply");
				 commentTempl.find("span.name > strong").html(resultObj.name);
				 commentTempl.find("div.comment_content").html(resultObj.textContent);
				 commentTempl.find("p.commemn_ff > span.date").html('<i class="fa fa-calendar" aria-hidden="true"></i>'+resultObj.save_time);
				 $("#commem_lindo").prepend("<div class='clear'></div>");
				 $("#commem_lindo").prepend(commentTempl);
			} else {
				 alert(resultObj.msg);
			}
         }
		 });
		 return false;
	 });
	
	// Reply comment 
	$('.btnSendComment').click(function(){
		 var name = $(this).parent().parent().parent().find(".name_comment").val().trim();
		 var email = $(this).parent().parent().parent().find(".email_comment").val().trim(); 
		 var textcomment = $(this).parent().parent().parent().find(".text_comment").val().trim();
		 if(name == "" || email == "" || textcomment == "") {
			 alert("Bạn cần nhập đầy đủ thông tin trước khi comment");
			 return false;
		 }
		 var record_id = $("#record_id").val();
		 var parent_id = $(this).parent().find(".comment_parrent").val();
		 var parentComment = $(this).parent().parent().parent().parent().parent();
		 $.ajax({
		 method: "POST",
		 url:"",
		 context:parentComment, 
		 data: {name: name,email:email,text:textcomment,ajax:1,record_id:record_id,parent_id:parent_id,module:"products",view:"product",task:"save_reply"},
		 success : function(result){
            var resultObj = jQuery.parseJSON(result);
			if(resultObj.success == 1) { 
				 // hide form and clear data 
				 $(".form_comment_reply").css({"display":"none"});
				 parentComment.find(".name_comment").val("");
				 parentComment.find(".email_comment").val("");
				 parentComment.find(".text_comment").val("");
				 
				 // Display new comment 
				 var commentTempl = $("#commentTempl").clone(); 
				 commentTempl.css({"display":"block"});
				 commentTempl.addClass("item-reply");
				 commentTempl.find("span.name > strong").html(resultObj.name);
				 commentTempl.find("div.comment_content").html(resultObj.textContent);
				 commentTempl.find("p.commemn_ff > span.date").html('<i class="fa fa-calendar" aria-hidden="true"></i>'+resultObj.save_time);
				 parentComment.after("<div class='clear'></div>");
				 parentComment.after(commentTempl);
			} else {
				 alert(resultObj.msg);
			}
         }
		 });
	});
	// owl_article();
	toogle_desc();
	open_popup_charactestic();
	// open_popup_quick_order();
	close_modal();
	search_compare();
	
	click_tab();
	
	slideshow_ordercart();
	if ( smartTab ) {processScrollDetails();}
	jQuery(window).scroll(function(){
		processScrollDetails();
	});
});  

function click_tab(){
	jQuery("#smartTab li a").click(function(){
		var target = jQuery(jQuery(this).attr("href"));
		clickNum = parseInt(jQuery(this).attr("href").replace("#prodetails_tab", ""), 10);
		
		jQuery(smartTab).find("li").removeClass("active");
		jQuery(smartTab).find("li:eq(" + (clickNum - 1) + ")").addClass("active");
		
		jQuery("html:not(:animated), body:not(:animated)").animate({scrollTop : (jQuery(target).offset().top - (jQuery(this).attr("href") == "#prodetails_tab2" ? 45 : 45))}, function(){
			clickNum = -1;
		});
		return false;
	});
}

function processScrollDetails() {
	var no_tab =  $('.product_tabs_ul li').length;
	var minTop = jQuery("#prodetails_tab1").offset().top-45;
	var last_element = jQuery('.product_tab_content').find(".prodetails_tab:eq(" + (no_tab - 1) + ")");
	var maxTop = last_element.offset().top + last_element.height() - 45;
	var scrollTop = jQuery(window).scrollTop();
	if(scrollTop >= minTop && scrollTop <= maxTop){
		jQuery(smartTab).find("li").removeClass("active");
		jQuery(smartTab).css({'position' : 'fixed', 'top' : fixedTop + 'px', 'margin-top' : '0px'});
		for(var i = 1; i <= no_tab; i ++){
			element = $('#prodetails_tab'+i);
			if( scrollTop >= (element.offset().top - 45) && scrollTop <= ((element.offset().top + element.height()) -45)){
				jQuery(smartTab).find("li:eq(" + (i - 1) + ")").addClass("active");
				break;
			}
		}
		
	}else{
		jQuery(smartTab).css({'position' : '', 'top' : '', 'margin-top' : ''});
	}
}

// $('._zoomimg').click(function(){
// 	$( "#_zoomimg" ).remove();
// 	var id = $('#product_id').val();
// 	$.get('/index.php?module=products&view=product&task=show_image&raw=1',{id:id}, function(data,this_element){
// 		$('<div class="modal  fade" id="_zoomimg">' + data + '</div>').modal();
// 	});
	
// });

function buy_add(id){
	var buy_count    = $('#buy_count').val();
	
	var link = '/index.php?module=products&view=cart&task=buy_multi&raw=1&id='+id+'&buy_count='+buy_count;
	window.location.href = link;

}

/* FORM CONTACT */
$('#submitbt').click(function(){

	if(checkFormsubmit())
		document.eshopcart_info.submit();
})
$('#resetbt').click(function(){
	document.eshopcart_info.reset();
})
function checkFormsubmit()
{
	$('label.label_error').prev().prev().remove();
	$('label.label_error').prev().remove();
	if(!notEmpty("quantity_modal","Bạn phải nhập số lượng"))	{
		return false;
	}
	if(!isPhone("quantity_modal","Bạn phải nhập số"))
		return false;
	if(!notEmpty("sender_name","Bạn phải nhập họ tên"))	{
		return false;
	}
    if(!notEmpty("sender_telephone","Bạn phải nhập số phone")){
		return false;
	}
	if(!isPhone("sender_telephone","Bạn nhập số điện thoại không hợp lệ"))
		return false;
	if(!notEmpty("sender_address","Bạn phải nhập địa chỉ gửi về"))
		return false;
//	if(!notEmpty("sender_email","Hãy nhập email"))
//		return false;
//	if(!emailValidator("sender_email","Email nhập không hợp lệ")){
//		return false;
//	}	
//	if(!notEmpty("received_time","Bạn phải nhập thời gian nhận hàng"))
//		return false;
	return true;
}
function submit_form_buy_fast()
{
	$('label.label_error').prev().prev().remove();
	$('label.label_error').prev().remove();
	
    if(!notEmpty("telephone_buy_fast","Bạn phải nhập số điện thoại")){
		return false;
	}
	if(!isPhone("telephone_buy_fast","Bạn nhập số điện thoại không hợp lệ"))
		return false;
	
	return true;
}

$(window).load(function(){
  
});


//function favourite(id){
//	$.ajax({
//	  url: root+"index.php?module=products&view=favourites&task=add&raw=1&data="+id,
//	  cache: false,
//	  
//	  success: function(json){
//	  		json = jQuery.trim(json);
//	    	if(json == '1')
//	    	{
//	    		alert("Bạn đã lưu thành công vào danh mục yêu thích");
//	    		return 0;
//	    	}
//	    	else if(json == '2')
//	    	{
//	    		alert("Sản phẩm này đã tồn tại trong danh mục yêu thích của bạn");
//	    		return true;
//	    	}
//	    	else 
//	    	{
//	    		alert("Không lưu vào danh mục yêu thích");
//				return true;
//	    	}
//	  },
//	  error: function()
//	  {
//		 console.log('error');
//		 return false;
//	  }
//	});
//}

function load_quick(element){
	var basic_price = $('#basic_price').val();
	var memory_curent = $('#memory_curent').val();
	var usage_states_curent = $('#usage_states_curent').val();
	var color_curent = $('#color_curent').val();
	var warranty_curent = $('#warranty_curent').val();
	var origin_curent = $('#origin_curent').val();
	var species_curent = $('#species_curent').val();
	
	// var price =  $(element).find("option:selected").data("price");
	// var type  =  $(element).find("option:selected").data("type");

	var price =  $(element).find("option:selected").data("price");

	if(!price){
		price =  $(element).data('price');   
		if(!price)
			price =  0;   
	}
	var type  =  $(element).find("option:selected").data("type");
	if(!type)
		type =  $(element).data('type');
	

	var price =  $(element).find("option:selected").data("price");

	if(!price){
		price =  $(element).data('price');   
		if(!price)
			price =  0;   
	}

	var type  =  $(element).find("option:selected").data("type");
	if(!type)
		type =  $(element).data('type');
	
	var color_id_h = $(element).data('color');
	var f = $( ".color_thump_"+color_id_h ).first();
	var order = f.data('order');
	order = parseInt(order);
	$( ".color_thump_"+color_id_h ).first().trigger( "click" );
//	var owlNumber = $('#sync1').find('.color_owl_'+color_id_h).index();
	
//	sync1.trigger('sync1.jumpTo', order);
	sync1.trigger("to.owl.carousel", [order, 1, true]);
//	$( ".color_owl_"+color_id_sh ).first().trigger( "click" );

	if (type == 'memory'){
		var number = parseInt(basic_price) + parseInt(price) + parseInt(color_curent) + parseInt(warranty_curent) + parseInt(origin_curent) + parseInt(species_curent)  + parseInt(usage_states_curent) ;
		$('#memory_curent').val(price);
		$(".boxmemory").val($(element).find("option:selected").val());
	}else if (type == 'color'){
		var number = parseInt(basic_price) + parseInt(price) + parseInt(memory_curent) + parseInt(warranty_curent)  + parseInt(origin_curent) + parseInt(species_curent)  + parseInt(usage_states_curent);
		$('#color_curent').val(price);
		// Khi click  vaof  icon ma u sac
		if($(element).data('id')){
			$(".boxcolor").val($(element).data('id'));	
		}

	}else if (type == 'warranty'){
		var number = parseInt(basic_price) + parseInt(price) + parseInt(memory_curent) + parseInt(color_curent)  + parseInt(origin_curent) + parseInt(species_curent)   + parseInt(usage_states_curent);
		$('#warranty_curent').val(price);
		$(".boxwarranty").val($(element).find("option:selected").val());
	}else if (type == 'origin'){
		var number = parseInt(basic_price) + parseInt(price) + parseInt(memory_curent) + parseInt(warranty_curent) + parseInt(color_curent)   +  parseInt(species_curent)  + parseInt(usage_states_curent);
		$('#origin_curent').val(price);
		$(".boxorigin").val($(element).find("option:selected").val());
	}else if (type == 'species'){
		var number = parseInt(basic_price) + parseInt(price) + parseInt(memory_curent)  + parseInt(warranty_curent) + parseInt(color_curent)   + parseInt(origin_curent)   + parseInt(usage_states_curent);
		$('#species_curent').val(price);
		$(".boxspecies").val($(element).find("option:selected").val());
	}else if (type == 'usage_states'){
		var number = parseInt(basic_price) + parseInt(price) + parseInt(memory_curent) + parseInt(warranty_curent) + parseInt(color_curent)  + parseInt(origin_curent) + parseInt(species_curent)  ;
		$('#usage_states_curent').val(price);
		$(".boxusage_states").val($(element).find("option:selected").val());
	}


	// alert($(element).data('price'));   

	//Định dạng lại giá
	var number = number.toString();
	var format_money = "";
	while (parseInt(number) > 999) {
		format_money = "." + number.slice(-3) + format_money;
		number = number.slice(0, -3);
	} 
	result = number + format_money;
	
	$('.price_modal').html(result+'₫</span>');
	$('#price').html(result+'₫</span>');
	$('#price_2').html(result+'₫</span>');
	 
	
}


//show_tooltip();
//function show_tooltip(){
//	 $('.color_item').tooltip({
//	        placement : 'top'
//	    });
//}

click_color();
function  click_color(){
	$('.Selector').click(function(){
		$('.Selector').removeClass('active');
		$(this).addClass('active');

	})
}
//function owl_article(){
//
//	$('.relate_products').owlCarousel({
//	  items:4,
//	   margin:10,
//	  loop:false,
//	   nav:true,
//	    autoplay:false,
//	     responsive:{
//          0:{
//              items:1
//          },
//          480:{
//              items:2
//          },
//          720:{
//              items:3
//          },
//          900:{
//              items:4
//          }
//
//      }
//	});
//}
function toogle_desc(){
	var expandedHeight = $('.box_conten_linfo_inner').height();
	$('#readmore_desc span').click(function(){
		if($(this).hasClass('closed')){
			$(this).removeClass('closed').addClass('opened');
			$('#box_conten_linfo').css('max-height','none');
		}else{
//			$('#box_conten_linfo').animate({max-height:'400px'},3000);
			$('#box_conten_linfo').css('max-height','400px');
			$(this).removeClass('opened').addClass('closed');
		}
		
	})
}
function open_popup_charactestic(){
	$('#readmore_chareactestic').click(function(){
		$('#charactestic_detail').show();
	})
}
// function open_popup_quick_order(){
// 	$('#buy-now').click(function(){
// 		$('#modal_buy_now').show();
// 	});
// 	$('#buy-now-2').click(function(){
// 		$('#modal_buy_now').show();
// 	})
// }

function close_modal(){
	$('.modal-header button').click(function(){
		$('.modal').hide();
	});
	$('.modal-full-screen').click(function(){
		$('.modal').hide();
	});
}
sticky_compare();
function sticky_compare(){
	var width = $(window).width();
	if(width < 1030)
		return;
	
	
	var element_height = $('#sticky_right').height();
	var top_max =  $('#sticky_right').offset().top;
	
	$(window).scroll(function () {
		
		
		
		var scrolltop = $(window).scrollTop();
		var pos_bottom = $('#product_page').offset().top + $('#product_page').height();
		
		if (top_max <= scrolltop) {
			if((pos_bottom - element_height) >= scrolltop){
				$('#sticky_right').css({
	                position: 'fixed',
	                top: '50px',
	                width: 'inherit'
	            });	
			}else{
				$('#sticky_right').css({
	                position: 'absolute',
	                bottom: '10px',
	                top: ''
	            });
			}		
            
        } else {
            $('#sticky_right').css({
            	 position: 'relative',
            	 width: '',
            	 bottom: '',
            	 top:''});
        }
	});

}

function search_compare(){
	var table_name = $('#table_name').val();
	var id = $('#record_id').val();
	var code = $('#record_alias').val();
	$('#compare_name').autocomplete({
		serviceUrl:"/index.php?module=products&view=search&raw=1&task=get_ajax_search_compare&table_name="+table_name+"&codes="+code+"&ids="+id,
		groupBy:"",
		minChars:2,
		containerClass: 'autocomplete-suggestions-compare',
		width: '300',
		formatResult:function(n,t){
			t=t.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g,"\\$&");
			var i=n.data.text.split(" "),r="";
			for(j=0;j<i.length;j++)
				r+=t.toLowerCase().indexOf(i[j].toLowerCase())>=0?"<strong>"+i[j]+"</strong> ":i[j]+" ";
			return' <a href = "'+n.value+'" > <img src = "'+n.data.image+'" /> <label> <span> '+r+' </span> <span class = "price"> '+n.data.price+"</span></label></a>"
		},
		onSelect:function(n){
			$(".control input[name=kwd]").val(n.data.text)
		}
	});
}

function incrementer(){

	  
	  $(".numbers-row .button").on("click", function() {
	    var $button = $(this);
	    var oldValue = $('#buy_count').val();

	    if ($button.text() == "+") {
	  	  var newVal = parseFloat(oldValue) + 1;
	  	} else {
		   // Don't allow decrementing below zero
	      if (oldValue > 0) {
	        var newVal = parseFloat(oldValue) - 1;
		    } else {
	        newVal = 0;
	      }
		  }

	    $('#buy_count').val(newVal);

	  });
}


function slideshow_ordercart(){
	$('#products_orders').owlCarousel({
		    loop: true,
		  autoplay: true,
		  items: 1,
		  nav: false,
		  
		  autoplayHoverPause: true,
		  animateOut: 'slideOutUp',
		  animateIn: 'slideInUp'
	});

}
