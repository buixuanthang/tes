$(document).ready(function(){
	click_menu();
});	

function click_menu(){
	$('.h3_0').click(function(){
		$( this ).toggleClass( "active" );
		var wrapper_child = $(this).next('ul');
		if(wrapper_child.hasClass('hidden')){
			wrapper_child.slideToggle();
		}else{
			wrapper_child.slideToggle();
		}
	});
}
