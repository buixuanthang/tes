$(document).ready(function(){
	var slpercent = $( "#slpercent option:selected" ).val();
	var slmonth = $( "#slmonth option:selected" ).val();
	var product_id = $( "#product-id" ).val();
	var product_price = $( "#product-price" ).val();



$.ajax({url: '/index.php?module=products&view=instalment&task=calculator&raw=1',
        type : 'POST',
        dataType: 'json',  
		  data: {slpercent:slpercent,slmonth:slmonth,product_id:product_id,product_price:product_price},
		  success : function(data){
		  	
			  	var instalment_money_before = data.instalment_money_before;
				var instalment_money_per_month = data.instalment_money_per_month;
				var instalment_money_total = data.instalment_money_total;				
				var html = data.html;

				$('#instalment_money_before').val(instalment_money_before);
				$('#instalment_money_per_month').val(instalment_money_per_month);
				$('#instalment_money_total').val(instalment_money_total);
				$('#result').html(html);
				$('.table-instalment-procedures').css("display", "table");
			  
		  }
	});


	if(product_id){
		// $.get("/index.php?module=products&view=instalment&task=load_data&raw=1",{product_id:product_id}, function(html){ 
		// 	$('#product-content').html(html);
		// });
	}
}); 
// $(function() {
// 	var products = $("#list_products").val();
// 	products = JSON.parse(products);
// 	$( "#product_text" ).autocomplete({
// 			minLength: 0,
// 			source: products,
// 			focus: function( event, ui ) {
// 				$( "#product" ).val( ui.item.label );
// 				return false;
// 			},
// 			select: function( event, ui ) {
// 					return false;
// 			}
// 	})
// 	.autocomplete( "instance" )._renderItem = function( ul, item ) {
// 			return $( "<li>" )
// 			.append( "<a>" + item.label + "<br>" + item.desc + "</a>" )
// 			.appendTo( ul );
// 		};
// });

function CalculateInstallmentByMonth(){
	var slpercent = $( "#slpercent option:selected" ).val();
	var slmonth = $( "#slmonth option:selected" ).val();
	var product_id = $( "#product-id" ).val();
	var product_price = $( "#product-price" ).val();
	$.ajax({url: '/index.php?module=products&view=instalment&task=calculator&raw=1',
        type : 'POST',
        dataType: 'json',         
		  	data: {slpercent:slpercent,slmonth:slmonth,product_id:product_id,product_price:product_price},
		  success : function(data){
		  	alert(12);
			  	var instalment_money_before = data.instalment_money_before;
				var instalment_money_per_month = data.instalment_money_per_month;
				var instalment_money_total = data.instalment_money_total;				
				var html = data.html;

				console.log(html);
				
				$('#instalment_money_before').val(instalment_money_before);
				$('#instalment_money_per_month').val(instalment_money_per_month);
				$('#instalment_money_total').val(instalment_money_total);
				$('#result').html(html);
				$('.table-instalment-procedures').css("display", "table");
			  
		  },
        error: function(jqXHR, exception) {
            console.log(jqXHR);
        }
	});
}




function load_quick(element){
	var basic_price = $('#basic_price').val();
	var memory_curent = $('#memory_curent').val();
	var usage_states_curent = $('#usage_states_curent').val();
	var color_curent = $('#color_curent').val();
	var warranty_curent = $('#warranty_curent').val();
	var origin_curent = $('#origin_curent').val();
	var species_curent = $('#species_curent').val();
	
	// var price =  $(element).find("option:selected").data("price");
	// var type  =  $(element).find("option:selected").data("type");

	var price =  $(element).find("option:selected").data("price");

	if(!price){
		price =  $(element).data('price');   
		if(!price)
			price =  0;   
	}
	var type  =  $(element).find("option:selected").data("type");
	if(!type)
		type =  $(element).data('type');
	

	var price =  $(element).find("option:selected").data("price");

	if(!price){
		price =  $(element).data('price');   
		if(!price)
			price =  0;   
	}

	var type  =  $(element).find("option:selected").data("type");
	if(!type)
		type =  $(element).data('type');
	
	var color_id_h = $(element).data('color');
	var f = $( ".color_thump_"+color_id_h ).first();
	var order = f.data('order');
	order = parseInt(order);
	$( ".color_thump_"+color_id_h ).first().trigger( "click" );
//	var owlNumber = $('#sync1').find('.color_owl_'+color_id_h).index();

//	$( ".color_owl_"+color_id_sh ).first().trigger( "click" );

	if (type == 'memory'){
		var number = parseInt(basic_price) + parseInt(price) + parseInt(color_curent) + parseInt(warranty_curent) + parseInt(origin_curent) + parseInt(species_curent)  + parseInt(usage_states_curent) ;
		$('#memory_curent').val(price);
		$("#boxmemory").val($(element).find("option:selected").val());
	}else if (type == 'color'){
		var number = parseInt(basic_price) + parseInt(price) + parseInt(memory_curent) + parseInt(warranty_curent)  + parseInt(origin_curent) + parseInt(species_curent)  + parseInt(usage_states_curent);
		$('#color_curent').val(price);
		// Khi click  vaof  icon ma u sac
		if($(element).data('id')){
			$(".boxcolor").val($(element).data('id'));	
			$("#color").val($(element).data('id'));	
		}

	}else if (type == 'warranty'){
		var number = parseInt(basic_price) + parseInt(price) + parseInt(memory_curent) + parseInt(color_curent)  + parseInt(origin_curent) + parseInt(species_curent)   + parseInt(usage_states_curent);
		$('#warranty_curent').val(price);
		$(".boxwarranty").val($(element).find("option:selected").val());
	}else if (type == 'origin'){
		var number = parseInt(basic_price) + parseInt(price) + parseInt(memory_curent) + parseInt(warranty_curent) + parseInt(color_curent)   +  parseInt(species_curent)  + parseInt(usage_states_curent);
		$('#origin_curent').val(price);
		$(".boxorigin").val($(element).find("option:selected").val());
	}else if (type == 'species'){
		var number = parseInt(basic_price) + parseInt(price) + parseInt(memory_curent)  + parseInt(warranty_curent) + parseInt(color_curent)   + parseInt(origin_curent)   + parseInt(usage_states_curent);
		$('#species_curent').val(price);
		$(".boxspecies").val($(element).find("option:selected").val());
	}else if (type == 'usage_states'){
		var number = parseInt(basic_price) + parseInt(price) + parseInt(memory_curent) + parseInt(warranty_curent) + parseInt(color_curent)  + parseInt(origin_curent) + parseInt(species_curent)  ;
		$('#usage_states_curent').val(price);
		$(".boxusage_states").val($(element).find("option:selected").val());
	}


	$('#product-price').val(number); 

	//Định dạng lại giá
	var number = number.toString();
	var format_money = "";
	while (parseInt(number) > 999) {
		format_money = "." + number.slice(-3) + format_money;
		number = number.slice(0, -3);
	} 
	result = number + format_money;
	

	$('.price_modal').html(result+'₫</span>');
	$('#price').html(result+'₫</span>');
	 CalculateInstallmentByMonth();
	
}


//show_tooltip();
//function show_tooltip(){
//	 $('.color_item').tooltip({
//	        placement : 'top'
//	    });
//}

click_color();
function  click_color(){
	$('.Selector').click(function(){
		$('.Selector').removeClass('active');
		$(this).addClass('active');

	})
}
