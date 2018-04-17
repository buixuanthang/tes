$(document).ready(function() {
	$('#searchbt').click(function(){
		itemid = 10; 
		url = '';
		var keyword = $('#keyword').val();
		var link_search = $('#link_search').val();
		if(keyword!= 'Tìm kiếm...' && keyword != '')	{
			url += 	'&keyword='+keyword;
			var check = 1;
		}else{
			var check =0;
		}
		if(check == 0){
			alert('Bạn phải nhập tham số tìm kiếm');
			return false;
		}
		// cat product
		cat_value = $('#cat_value').val();
		if(link_search.indexOf("&") == '-1')
			var link = link_search+'/'+cat_value+'/'+keyword+'.html';
		else
			var link = link_search+'&cat_value='+cat_value+'&keyword='+keyword+'&Itemid=9';
 
	    window.location.href=link;
	    return false;
		})
});
change_category();
function change_category(){
	$('.search_cat ul li a').click(function(){
		name = $(this).html();
		name = name.replace(/\&nbsp\;/g,'');
		id = $(this).attr('id');
		$('.cat_current').html(name);
		$('#cat_value').val(id);
		$('.search_cat ul li a').removeClass('selected');
		$(this).addClass('selected');
	});
}
