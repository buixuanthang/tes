<table cellspacing="1" class="admintable">
<?php

	TemplateHelper::dt_edit_text(FSText :: _('Title'),'title',@$data -> title);
	TemplateHelper::dt_edit_text(FSText :: _('Alias'),'alias',@$data -> alias,'',60,1,0,FSText::_("Can auto generate"));
	TemplateHelper::dt_edit_selectbox(FSText::_('Categories'),'category_id',@$data -> category_id,0,$categories,$field_value = 'id', $field_label='treename',$size = 10,0);

	TemplateHelper::dt_edit_image(FSText :: _('Image'),'image',str_replace('/original/','/resized/',URL_ROOT.@$data->image));
	TemplateHelper::dt_checkbox(FSText::_('Published'),'published',@$data -> published,1);
	TemplateHelper::dt_checkbox(FSText::_('Tin hot'),'is_hot',@$data -> is_hot,1);
//	$sub_time = TemplateHelper::sub_edit_text('&nbsp;&nbsp;&nbsp;','published_hour',@$data -> published_time?date('H:i',strtotime(@$data -> published_time)):'','','5',1);
	// TemplateHelper::dt_edit_text(FSText :: _('Thời gian Xuất bản'),'published_date',@$data -> published_time?date('d-m-Y',strtotime(@$data -> published_time)):'','','12',1,0,'Nhập dạng <strong>d-m-Y H:i</strong>. Nếu thời gian Xuất bản để trống => Hệ thống sẽ lấy tự động',$sub_time);
//	TemplateHelper::dt_checkbox(FSText::_('Tin nhanh'),'news_fast',@$data -> news_fast,1);
//	TemplateHelper::dt_checkbox(FSText::_('Tin tiêu điểm'),'news_focus',@$data -> news_focus,1);
//	TemplateHelper::dt_checkbox(FSText::_('Tin slideshow'),'news_slide',@$data -> news_slide,1);
	TemplateHelper::dt_edit_text(FSText :: _('Ordering'),'ordering',@$data -> ordering,@$maxOrdering,'20');
	TemplateHelper::dt_edit_text(FSText :: _('Summary'),'summary',@$data -> summary,'',100,9);
	TemplateHelper::dt_edit_text(FSText :: _('Content'),'content',@$data -> content,'',650,450,1);
	TemplateHelper::dt_edit_text(FSText :: _('Tags'),'tags',@$data -> tags,'',100,4);
	TemplateHelper::dt_sepa();
	TemplateHelper::dt_edit_text(FSText :: _('SEO title'),'seo_title',@$data -> seo_title,'',100,1);
	TemplateHelper::dt_edit_text(FSText :: _('SEO meta keyword'),'seo_keyword',@$data -> seo_keyword,'',100,1);
	TemplateHelper::dt_edit_text(FSText :: _('SEO meta description'),'seo_description',@$data -> seo_description,'',100,9);
?>
</table>
<script type="text/javascript" >
	$(function() {
		$( "#published_date" ).datepicker({clickInput:true,dateFormat: 'dd-mm-yy',changeMonth: true, changeYear: true});
		$( "#published_date").change(function() {
			document.formSearch.submit();
		});
	});
</script>	