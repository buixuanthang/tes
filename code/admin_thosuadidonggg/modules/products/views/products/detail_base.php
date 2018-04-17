<table cellspacing="1" class="admintable">
<?php 

	TemplateHelper::dt_edit_text(FSText :: _('Name'),'name',@$data -> name);
	TemplateHelper::dt_edit_text(FSText :: _('Alias'),'alias',@$data -> alias,'',60,1,0,FSText::_("Can auto generate"));
		//TemplateHelper::dt_edit_text(FSText :: _('Part number'),'partnumber',@$data -> partnumber);
	//if(@$data -> code)
//		TemplateHelper::dt_text(FSText :: _('Mã'),@$data -> code,'');
	TemplateHelper::dt_edit_text(FSText :: _('Giá Thấp Nhất'),'price_old',@$data -> price_old,'',20,1,0);
	TemplateHelper::dt_edit_text(FSText :: _('Giá Cao Nhất'),'maxprice',@$data -> maxprice,'',20,1,0);
	//TemplateHelper::dt_edit_selectbox('Loại giảm giá','discount_unit',@$data -> discount_unit,0,array('percent'=>'Phần trăm','price'=>'Giá trị'),$field_value = '', $field_label='');
	// TemplateHelper::dt_edit_text(FSText :: _('Giảm giá'),'discount',@$data -> discount,'',20,1,0);
	// TemplateHelper::dt_edit_text(FSText :: _('Số lượng'),'quantity',@$data -> quantity,10,20,1,0);
	// TemplateHelper::dt_edit_text(FSText :: _('Số lượng bán ra'),'sale',@$data -> sale,0);
	TemplateHelper::dt_edit_text(FSText :: _('Thời gian sửa chữa'),'fix_time',@$data -> fix_time);
	TemplateHelper::dt_edit_text(FSText :: _('Bảo hành'),'warranty',@$data -> warranty,'',20,1,0);
	TemplateHelper::dt_edit_text(FSText :: _('Giải pháp'),'solution',@$data -> solution,'',650,450,1);
	TemplateHelper::dt_edit_text(FSText :: _('Khuyến mãi'),'accessories',@$data -> accessories,'',650,450,1);

//	$sub_time_start = TemplateHelper::sub_edit_text('&nbsp;&nbsp;&nbsp;','published_hour_start',@$data -> date_start?date('H:i',strtotime(@$data -> date_start)):'','','5',1);
//	TemplateHelper::dt_edit_text(FSText :: _('Ngày bắt đầu'),'date_start',@$data -> date_start?date('d-m-Y',strtotime(@$data -> date_start)):'','','12',1,0,'Nhập dạng <strong>dd-mm-YYYY HH:mm</strong>.',$sub_time_start);
//	$sub_time_end = TemplateHelper::sub_edit_text('&nbsp;&nbsp;&nbsp;','published_hour_end',@$data -> date_end?date('H:i',strtotime(@$data -> date_end)):'','','5',1);
//	TemplateHelper::dt_edit_text(FSText :: _('Ngày hết hạn'),'date_end',@$data -> date_end?date('d-m-Y',strtotime(@$data -> date_end)):'','','12',1,0,'Nhập dạng <strong>dd-mm-YYYY HH:mm</strong>.',$sub_time_end);
	TemplateHelper::dt_sepa();
	// TemplateHelper::dt_checkbox(FSText::_('Hotdeal'),'is_hotdeal',@$data -> is_hotdeal,0);
	// TemplateHelper::dt_checkbox(FSText::_('Hotdeal show home?'),'is_hotdeal_show_home',@$data -> is_hotdeal_show_home,0);
	if(@$data -> is_hotdeal){
		$hotdeal_area = 'hotdeal_area_open';
	}else{
		$hotdeal_area = 'hotdeal_area_close';
	}
	?>

	<?php
	TemplateHelper::dt_sepa();
//	TemplateHelper::dt_edit_text(FSText :: _('Thông tin khuyến mại'),'promotion_info',@$data -> promotion_info,'',60,3,0);
	//TemplateHelper::dt_edit_selectbox(FSText::_('Categories'),'category_id',@$data -> category_id,0,$categories,$field_value = 'id', $field_label='treename',$size = 1,0);
	$category_id = isset($data -> category_id)?$data -> category_id:$cid;
	TemplateHelper::dt_edit_selectbox(FSText::_('Categories'),'category_id',$category_id,0,$relate_categories,$field_value = 'id', $field_label='treename',$size = 1,0);
	//TemplateHelper::dt_edit_selectbox('Loại','types',@$data -> types,0,$types,'id', 'name',$size = 1,0,1);
	if($use_manufactory){
		TemplateHelper::dt_edit_selectbox(FSText::_('Hãng sản xuất'),'manufactory',@$data -> manufactory,0,$manufactories,$field_value = 'id', $field_label='name',$size = 1,0);
//		if($use_model)
//			TemplateHelper::dt_edit_selectbox(FSText::_('Dòng sp'),'model',@$data -> model,0,$product_models,$field_value = 'id', $field_label='name',$size = 10,0);
	}
	TemplateHelper::dt_edit_image(FSText :: _('Image'),'image',str_replace('/original/','/resized/',URL_ROOT.@$data->image));

//	TemplateHelper::dt_edit_image(FSText :: _('Ảnh video'),'image_video',str_replace('/original/','/resized/',URL_ROOT.@$data->image_video));
//	TemplateHelper::dt_edit_text(FSText :: _('Video'),'video',@$data -> video,'',60,1,0);
	//TemplateHelper::dt_edit_text(FSText :: _('Video'),'video_second',@$data -> video_second,'',60,1,0,'Phải');
//	TemplateHelper::dt_edit_image(FSText :: _('Image'),'image',str_replace('/original/','/resized/',URL_ROOT.@$data->image),'','','400X460');
//	TemplateHelper::dt_edit_image(FSText :: _('Ảnh thông số kỹ thuật'),'image_spec',str_replace('/original/','/resized/',URL_ROOT.@$data->image_spec));
//	TemplateHelper::dt_edit_image(FSText :: _('Image x2'),'image_double',str_replace('/original/','/resized/',URL_ROOT.@$data->image_double),'','','Kích thước chuẩn 476x250');
//	TemplateHelper::dt_checkbox(FSText::_('Published double'),'published_double',@$data -> published_double,0);
	TemplateHelper::dt_checkbox(FSText::_('Published'),'published',@$data -> published,1);
//	TemplateHelper::dt_checkbox(FSText::_('Sản phẩm mới'),'is_new',@$data -> is_new,1);
//	TemplateHelper::dt_checkbox(FSText::_('Sản phẩm cũ'),'is_old',@$data -> is_old,0);
	TemplateHelper::dt_edit_text(FSText :: _('Ordering'),'ordering',@$data -> ordering,@$maxOrdering,'20');
//	TemplateHelper::dt_edit_text(FSText :: _('Phụ kiện'),'accessory',@$data -> accessory,'',60,3,0);
//	TemplateHelper::dt_edit_text(FSText :: _('Quà khuyến mại'),'accessories',@$data -> accessories,'',650,450,1);
	//TemplateHelper::dt_edit_text(FSText :: _('Summary'),'summary',@$data -> summary,'',60,3,0);
	TemplateHelper::dt_edit_text(FSText :: _('Mô tả'),'description',@$data -> description,'',650,450,1);
	//TemplateHelper::dt_edit_text(FSText :: _('Thông số kỹ thuật'),'characteristic',@$data -> characteristic,'',650,450,1);
//	TemplateHelper::dt_edit_text(FSText :: _('Phụ kiện đi kèm'),'accessories',@$data -> accessories,'',60,3,0);

	?>
	 <!--<tr>
		<td valign="top" class="key">
			<?php  echo FSText :: _('File 360 độ'); ?>
		</td>
		<td>
			<?php if(@$data -> link_360){?>
			<embed height="150" width="100" wmode="opaque" quality="high" name="<?php  echo @$data->name;?>"  src="<?php echo URL_ROOT.'images/products/360/'.$data->link_360; ?>" type="application/x-shockwave-flash">
			<br/>
			<?php } ?>
			<input type="file" name='link_360' value="<?php echo (isset($data->link_360)) ? @$data->link_360 : ''; ?>"/>
		</td>
	</tr>
	--><?php 
	TemplateHelper::dt_edit_text(FSText :: _('Tags'),'tags',@$data -> tags,'',100,2);
	TemplateHelper::dt_sepa();
	TemplateHelper::dt_edit_text(FSText :: _('SEO title'),'seo_title',@$data -> seo_title,'',100,1);
	TemplateHelper::dt_edit_text(FSText :: _('SEO meta keyword'),'seo_keyword',@$data -> seo_keyword,'',100,1);
	TemplateHelper::dt_edit_text(FSText :: _('SEO meta description'),'seo_description',@$data -> seo_description,'',100,9);
?>
</table>
<script>    CKEDITOR.replace( 'promotion_info' );</script>
<script  type="text/javascript" language="javascript">
$(function(){
	$("select#manufactory").change(function(){
		$.ajax({url: "index.php?module=products&view=products&task=ajax_get_product_models&raw=1",
			 data: {cid: $(this).val()},
			  dataType: "text",
			  success: function(text) {
			    j = eval("(" + text + ")");
			    var options = '';
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].id + '">' + j[i].name + '</option>';
				}
				$("#model").html(options);
				$('#model option:first').attr('selected', 'selected');
			  }
		});
	});			
				
});
</script>
<script  type="text/javascript" language="javascript">
$(function() {
	$( "#date_end" ).datepicker({clickInput:true,dateFormat: 'dd-mm-yy',changeMonth: true, changeYear: true,yearRange: "+0:+0",defaultDate: new Date()});
	$( "#date_end").change(function() {
		document.formSearch.submit();
	});
	$( "#date_start" ).datepicker({clickInput:true,dateFormat: 'dd-mm-yy',changeMonth: true, changeYear: true,yearRange: "+0:+0",defaultDate: new Date()});
	$( "#date_start").change(function() {
		document.formSearch.submit();
	});
	$('.hotdeal_area_close').hide();
	$('#is_hotdeal_0').click(function(){
		$('.hotdeal_area_open').hide();
		$('.hotdeal_area_close').hide();
	});
	$('#is_hotdeal_1').click(function(){
		$('.hotdeal_area_open').show();
		$('.hotdeal_area_close').show();
	});
});
</script>

