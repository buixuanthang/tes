$(function() {
//	$('#products_tab_new .owl-carousel').owlCarousel({
//	      loop:true,
//	      nav:false,
//	      items:1,
//	      dots:true,
//	      autoplay: true
//	  })
		
//	$('.products_blocks_wrapper').removeClass('hide');
//	
	$('.products_tab').each(function( index ) {
		var id_block = $(this).attr('id');
		var identity = id_block.replace('products_tab_','');
		initialize_owl($('#products_tab_'+identity+''));
		return false;
		
	});
	
//	$('#products_tab_wrapper_promotion').addClass('hide');
//	$('#products_tab_wrapper_sale').addClass('hide');
	
	run_tab();
});

function run_tab(){
	$('.tab_title li').click(function(){
		var id = $(this).attr('id');
		$('.tab_title li').removeClass('activated');
		$(this).addClass('activated');
		
		content_id = id.replace('tab_','products_tab_wrapper_');
		$('.products_tab_wrapper').addClass('hide');
		$('#'+content_id).removeClass('hide');
		
		content_owl_id = id.replace('tab_','products_tab_');
//		$('#'+content_owl_id).removeClass('hide');
		initialize_owl($('#'+content_owl_id));
//		$('#'+content_owl_id).trigger("refresh.owl.carousel");
	})
}

function initialize_owl(el) {
    el.owlCarousel({
    	  loop:true,
	      nav:true,
		      
		      navText: [
		         "‹",
		        "›"
		        ],
	      dots:false,
	      pagination:false,		      
	      autoplay: false,
	      responsiveClass:true,
	      responsive:{
	          0:{
	              items:1,
	          },
	          320:{
	              items:2,
	          },
	          600:{
	              items:3,
	          },
	           800:{
	              items:4,
	          },
	          1000:{
	              items:5,
	          }
	      }
    });
}

//function destroy_owl(el) {
//    el.data('owlCarousel').destroy();
//}
