$( document ).ready(function() {
	$('#product_menu_toogle').click(function(){
		$('#product_menu_ul').slideToggle( "slow");

	    if($('#product_menu_ul').css('display') == 'none'){
	      $('#product_menu_ul_mask').hide();
	    }else{
	      $('#product_menu_ul_mask').show();
	    }	
	});
  $('#product_menu_ul_mask').click(function(){
    $('#product_menu_ul').slideToggle( "slow", function(){
       if($('#product_menu_ul').css('display') == 'none'){
        $('#product_menu_ul_mask').hide();
      }else{
        $('#product_menu_ul_mask').show();
      }  
    });
  });
});