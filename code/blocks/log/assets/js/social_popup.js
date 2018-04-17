function close_popup(){
	$('#form_log_popup').addClass('hide');
}
function open_popup_log(){
	$('#form_log_popup').removeClass('hide');
}
show_loged_popup();
function show_loged_popup(){
	$('#loged_popup_title').click(function(){
		$('.loged_popup_content').slideToggle('slow');	
	})
}