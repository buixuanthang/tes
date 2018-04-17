$(function() {
	$('.products_blocks_wrapper').removeClass('hide');
	
	$('.products_blocks_slideshow').each(function( index ) {
		var id_block = $(this).attr('id');
		var identity = id_block.replace('products_blocks_slideshow_','');
		$('#products_blocks_slideshow_'+identity+' #carousel').carouFredSel({
			responsive: true,
			scroll: 1,
			auto: {
				items:0
			},
			prev: '#products_prev_'+identity,
			next: '#products_next_'+identity,
			items: {
				width: 185,
				visible: {
					min: 1,
					max: 10
				}
			},
			height: 330
		});
	});
	
	
	

});