$(document).ready(function() {
	var track_click = 1; //track user click on "load more" button, righ now it is 0 click
	
	var url = $( "#url" ).val();
	$('#box_product').load(url, {'page':track_click}, function() {track_click++;}); //initial data to load
	$(".load_more").click(function (e) { //user clicks on button
		var total_pages = $( "#total_rows" ).val();
		var manufactory_id = $( "#manufactory_id" ).val();
		var cid =  $( "#category_id" ).val();
		$(this).hide(); 
		$('.animation_image').show(); //show loading image
		if(track_click <= total_pages) //make sure user clicks are still less than total pages
		{
		//post page number and load returned data into result element
		$.get('/index.php?module=products&view=hotdeal&task=fetch_pages&raw=1',{'page': track_click,'manf_id': manufactory_id,'cid':cid}, function(data) {
		
			$(".load_more").show(); //bring back load more button
			
			$("#box_product").append(data); //append data received from server
			
			//scroll page to button element
			$("html, body").animate({scrollTop: $("#load_more_button").offset().top}, 1200);
			
			//hide loading image
			$('.animation_image').hide(); //hide loading image once data is received

			track_click++; //user click increment on load button
		
		}).fail(function(xhr, ajaxOptions, thrownError) { 
			alert(thrownError); //alert any HTTP error
			$(".load_more").show(); //bring back load more button
			$('.animation_image').hide(); //hide loading image once data is received
		});
		
		if(track_click > total_pages-1)
		{
			//reached end of the page yet? disable load button
			$(".load_more").attr("disabled", "disabled");
			
		}
	}
});

});	