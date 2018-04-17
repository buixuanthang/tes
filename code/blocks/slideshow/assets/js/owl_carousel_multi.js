$(function() {
		$('.slideshow_owl').owlCarousel({
		      loop:true,
		      nav:true,
		      
		      navText: [
		        "‹",
		        "›"
		        ],
		      dots:true,
		      pagination:true,
		      autoplay: true,
			  	autoplayTimeout:4000,
		      items:1,
		      center: true,
		      lazyLoad : true
		  })
});
