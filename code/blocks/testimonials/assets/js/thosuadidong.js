$(document).ready(function(){
        var owl = $("#block-tesimonials");
        owl.owlCarousel({
        loop:true,
	    responsiveClass:true,
		navText:[ "",""],
				autoplay: true,
				nav:true,
				loop:true,
				dots:true,
				responsive:{
		          0:{
		              items:1,
		          },
		         
		          320:{
		              items:2,
		          },
		          380:{
		              items:3,
		          }
		      }	        

        });
        // Custom Navigation Events
});

