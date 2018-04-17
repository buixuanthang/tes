toogle_partner_info();
function toogle_partner_info(){

	$('.partners_body .item .item_inner_inner').click(function(){
			
		if($(this).parent().parent().hasClass('activated') == false){
			
			$('.partners_body .item').removeClass('activated');
			$(this).parent().parent().addClass('activated');
			
		}else{
			
			$(this).parent().parent().removeClass('activated');
		}
	});
	$('.closed').click(function(){			
			
			$('.partners_body .item').removeClass('activated');
		
	});
}