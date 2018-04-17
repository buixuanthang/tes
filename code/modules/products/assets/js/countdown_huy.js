var time = $('#expire_time').val();
var austDay = new Date(time);

var current_time_server = $('#current_time').val();
var current_time_server = new Date(current_time_server);
var current_time_client = new Date();

// TÍnh chênh lệch thời gian
var between_time = current_time_server.getTime() - current_time_client.getTime();
var austDay_client = austDay.getTime() - between_time;
var austDay_client = new Date(austDay_client);

//$('#time-countdown').countdown({until: austDay, compact: true, description: ''});
//alert('vvv');
//$('#time-countdown-1').countdown('2020/10/10 12:34:56');
//alert('vvv11');

//var austDay = new Date(new Date().getFullYear() + 1, 0, 0, 0, 0, 0, 0);
$('#time-countdown').countdown(austDay_client)
 .on('update.countdown', function(event) {
     var format = '%H:%M:%S';
     if(event.offset.days > 0) {
         format = '%-D ngày ' + format;
     }
     $(this).html(event.strftime(format));
 })
 .on('finish.countdown',function(event) {
	 location.reload();
});

$('#submitbt').click(function(){
	if(checkFormsubmit())
		document.eshopcart_info.submit();
})
function submit_quick_order()
{
	$('label.label_error').prev().prev().remove();
	$('label.label_error').prev().remove();
	if(!notEmpty("sender_name","Bạn phải nhập họ tên"))	{
		return false;
	}
    if(!notEmpty("sender_telephone","Bạn phải nhập số phone")){
		return false;
	}
    if(!notEmpty("sender_address","Bạn phải nhập giao hàng"))
		return false;
	if(!isPhone("sender_telephone","Bạn nhập số điện thoại không hợp lệ"))
		return false;
	
	if(!notEmpty("sender_email","Hãy nhập email"))
		return false;
	if(!emailValidator("sender_email","Email nhập không hợp lệ")){
		return false;
	}	
	
	return true;
}