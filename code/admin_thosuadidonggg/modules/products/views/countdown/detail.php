<link type="text/css" rel="stylesheet" media="all" href="../libraries/jquery/jquery.ui/jquery-ui.css" />
<script type="text/javascript" src="../libraries/jquery/jquery.ui/jquery-ui.js"></script>

	<!-- HEAD -->
	<?php 
	
	$title = @$data ? FSText :: _('Sửa'): FSText :: _('Thêm mới'); 
	global $toolbar;
	$toolbar->setTitle($title);
	$toolbar->addButton('save_add',FSText :: _('Save and new'),'','save_add.png'); 
	$toolbar->addButton('apply',FSText::_('Apply'),'','apply.png'); 
	$toolbar->addButton('save',FSText::_('Save'),'','save.png'); 
	$toolbar->addButton('cancel',FSText::_('Cancel'),'','cancel.png');   
	$this -> dt_form_begin();
	$category_id = isset($product -> category_id)?$product -> category_id: reset($categories)->id;
	TemplateHelper::dt_edit_selectbox(FSText::_('Categories'),'category_id',$category_id,0,$categories,$field_value = 'id', $field_label='treename',$size = 1,0);
	TemplateHelper::dt_edit_selectbox(FSText::_('Product'),'product_id',@$data->product_id,0,$products,$field_value = 'id', $field_label='name',$size = 1,0);
	TemplateHelper::dt_edit_selectbox(FSText::_('Color'),'color_id',@$data->color_id,0,$colors,$field_value = 'id', $field_label='name',$size = 1,0);
	
	TemplateHelper::dt_edit_text(FSText :: _('Số lượng'),'quantity',@$data -> quantity,1,'20');
	TemplateHelper::dt_edit_money(FSText :: _('Giá gốc'),'price',@$data -> price,'',20,1,0);
	TemplateHelper::dt_edit_money(FSText :: _('Giá cuối'),'price_min',@$data -> price_min,'',20,1,0);

	TemplateHelper::dt_checkbox(FSText::_('Chạy liên tục '),'is_continuity',@$data -> is_continuity,0,$array_value = array(1 => 'Có', 0 => 'Không' ),$sub_item = '','Nếu chọn liên tục: Phải set cả SP đầu tiên' );
//	TemplateHelper::dt_edit_text(FSText :: _('Tổng thời gian (nếu chạy liên tục)'),'continuity_total_time',@$data -> continuity_total_time,60,'20',1,0,0,'phút');
	
//	0: cho khoảng time + khoảng giá-> tính kết thúc. 1: cho kết thúc + bước giá => tính khoảng time
	$arr_type = array('1'=>'Chọn bước time + bước giá => Tính time kết thúc','0'=>'Chọn thời gian kết thúc + bước giá => Tính khoảng time');
	TemplateHelper::dt_edit_selectbox(FSText::_('Cách nhập'),'type',@$data -> type,0,$arr_type,'', '',$size = 1,0);
	
	TemplateHelper::dt_edit_money(FSText :: _('Bước giá'),'step_price',@$data -> step_price,10000,'20',1,0,0,'VNĐ');
	
	TemplateHelper::dt_edit_text(FSText :: _('Bước thời gian'),'step_time',@$data -> step_time,4,'20',1,0,0,'phút');
	
	$sub_time = TemplateHelper::sub_edit_text('&nbsp;&nbsp;&nbsp;','started_hour',@$data -> started_time?date('H:i',strtotime(@$data -> started_time)):'','','5',1);
	TemplateHelper::dt_edit_text(FSText :: _('Thời gian bắt đầu'),'started_date',@$data -> started_time?date('d-m-Y',strtotime(@$data -> started_time)):'','','12',1,0,'Nhập dạng <strong>d-m-Y H:i</strong>.',$sub_time);
		
	$sub_time = TemplateHelper::sub_edit_text('&nbsp;&nbsp;&nbsp;','finished_hour',@$data -> finished_time?date('H:i',strtotime(@$data -> finished_time)):'','','5',1);
	TemplateHelper::dt_edit_text(FSText :: _('Thời gian kết thúc'),'finished_date',@$data -> finished_time?date('d-m-Y',strtotime(@$data -> finished_time)):'','','12',1,0,'Nhập dạng <strong>d-m-Y H:i</strong>.',$sub_time);
	
	TemplateHelper::dt_edit_text(FSText :: _('Tình trạng'),'status',@$data -> status,'','60');
	//TemplateHelper::dt_edit_text(FSText :: _('Mô tả'),'description',@$data -> description,'',60,3,0);
	TemplateHelper::dt_edit_text(FSText :: _('Mô tả'),'description',@$data -> description,'',650,450,1);
		
	
	//TemplateHelper::dt_edit_selectbox(FSText::_('Sử dụng cho các bảng'),'tablenames',@$data -> tablenames,0,$tables,'table_name','table_name',$size = 10,1,0,'Giữ phím Ctrl để chọn nhiều item');
	TemplateHelper::dt_checkbox(FSText::_('Published'),'published',@$data -> published,1);
	TemplateHelper::dt_edit_text(FSText :: _('Ordering'),'ordering',@$data -> ordering,@$maxOrdering,'20');
	
	$this -> dt_form_end(@$data);
	?>
<!-- END HEAD-->

<script  type="text/javascript" language="javascript">
$(function(){
//	$('#continuity_total_time').prop('disabled', true);
	
	$("select#category_id").change(function(){
	$.ajax({url: "index.php?module=products&view=countdown&task=ajax_get_products&raw=1",
			data: {cid: $(this).val()},
			dataType: "text",
			
			success: function(text) {
				if(text == '')
					return;
				j = eval("(" + text + ")");
				
				var options = '';
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].id + '">' + j[i].name + '</option>';
				}
				$('#product_id').html(options);
				elemnent_fisrt = $('#product_id option:first').val();
			}
		});
	});
	
	$( "#started_date" ).datepicker({clickInput:true,dateFormat: 'dd-mm-yy',changeMonth: true, changeYear: true});
	$( "#finished_date" ).datepicker({clickInput:true,dateFormat: 'dd-mm-yy',changeMonth: true, changeYear: true});
//	$( "#published_date").change(function() {
//		document.formSearch.submit();
//	});


	$(function(){
		val  = $("select#type").val();
		is_continuity  = $("input[name='is_continuity']:checked").val();
		change_type(val);
//		change_continuity(is_continuity,val);
		
		$("select#type").change(function(){
			val  = $(this).val();
//			type  = $("type#type").val();
			is_continuity  = $("select#is_continuity").val();
			change_type(val);
//			change_continuity(is_continuity,val);
		});	

//		$('#is_continuity_1').click(function(){
//			val  = $(this).val();
////			type  = $("type#type").val();
//			is_continuity  = $("select#is_continuity").val();
////			change_type(val);
////			change_continuity(1,val);
//		});	
//
//		$('#is_continuity_0').click(function(){
//			val  = $(this).val();
////			type  = $("type#type").val();
//			is_continuity  = $("select#is_continuity").val();
////			change_type(val);
//			change_continuity(0,val);
//		});	
//					
	});

	function change_type(type){
		if(val == 1){
			$('#step_time').prop('disabled', false);
			$('#finished_date').prop('disabled', true);
			$('#finished_hour').prop('disabled', true);
					
			
		}else{
			$('#step_time').prop('disabled', true);
			$('#finished_date').prop('disabled', false);
			$('#finished_hour').prop('disabled', false);
		}
	}
	
	function change_continuity(is_continuity, type){
		if(is_continuity  == 1){
//			$('#continuity_total_time').parent().parent().show();
			$('#type').parent().parent().hide();
			$('#step_time').prop('disabled', false);
			$('#finished_date').prop('disabled', false);
			$('#finished_hour').prop('disabled', false);
		}else{
//			$('#continuity_total_time').parent().parent().hide();
			$('#type').parent().parent().show();
			if(val == 1){
				$('#step_time').prop('disabled', false);
				$('#finished_date').prop('disabled', true);
				$('#finished_hour').prop('disabled', true);
				
			}else{
				$('#step_time').prop('disabled', true);
				$('#finished_date').prop('disabled', false);
				$('#finished_hour').prop('disabled', false);
			}
		}
	}
	
	
})
</script>
