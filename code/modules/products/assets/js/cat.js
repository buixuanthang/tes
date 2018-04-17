on_change_order(1);
//open_close_filter();
	
function on_change_order(){
	$('.order-select').change(function() {
		var value=$(this).val();
		if(value){
			location.href=value;
		}
	});
}

function open_close_filter(){
	$('.icon-filter').click(function(){
		if($('.filter_inner').css('display') == 'none'){
			$('.filter_inner').css('display','block');	
		}else{
			$('.filter_inner').css('display','none');
		}
	});
}