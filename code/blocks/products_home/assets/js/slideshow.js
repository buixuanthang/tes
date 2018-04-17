$(function() {

	$('.products_home_slideshow').each(function( index ) {
		var id_block = $(this).attr('id');
		var identity = id_block.replace('products_home_slideshow_','');
		$('#products_home_slideshow_'+identity+'').owlCarousel({
		      loop:true,
		      nav:true,
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
		              items:1,
		          },
		           380:{
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
		  })
	});
});
