//xuân thành

//tooltip2();
tooltip();


function tooltip(){
	$(".frame_inner").ezpz_tooltip(); 
}
function tooltip2(){
	$('.cat_item_store .item').hover(function(e){
		$(this).find('.tooltip-content').animate({top:'32px'},800);
	});
	$('.cat_item_store .item').mouseleave(function(e){
		$(this).find('.tooltip-content').stop(true).animate({top:'400px'},300);
	});
}
function tooltip3(){
	$('.cat_item_store .item').hover(function(e){
		$(this).find('.tooltip-content').animate({opcity:'show'},600);
	});
	$('.cat_item_store .item').mouseleave(function(e){
		$(this).find('.tooltip-content').stop(true).animate({opcity:'hide'},60);
	});
}

