<!-- HEAD -->
	<?php 
	
	$title = @$data ? FSText::_('Edit'): FSText::_('Add'); 
	global $toolbar;
	$toolbar->setTitle($title);
	$toolbar->addButton('save_add',FSText :: _('Save and new'),'','save_add.png'); 
	$toolbar->addButton('apply',FSText::_('Apply'),'','apply.png'); 
	$toolbar->addButton('save',FSText::_('Save'),'','save.png'); 
	$toolbar->addButton('cancel',FSText::_('Cancel'),'','cancel.png');   
	
	$this -> dt_form_begin();
		TemplateHelper::dt_edit_text(FSText :: _('Name'),'name',@$data -> name);
	TemplateHelper::dt_edit_text(FSText :: _('Alias'),'alias',@$data -> alias,'',60,1,0,FSText::_("Can auto generate"));
//	TemplateHelper::dt_edit_text(FSText :: _('Mã nhóm'),'code',@$data -> code,'',60,1,0);
	TemplateHelper::dt_edit_selectbox(FSText::_('Parent'),'parent_id',@$data -> parent_id,'',$categories,$field_value = 'id', $field_label='treename',$size = 1,0,1);
//	TemplateHelper::dt_checkbox(FSText::_('Kế thừa từ bảng cha'),'inheritance_perent_table',@$data -> inheritance_perent_table,0);
	TemplateHelper::dt_edit_selectbox(FSText::_('Tên bảng'),'tablename',@$data -> tablename,'',$tables,$field_value = 'table_name', $field_label='table_name',$size = 1,0,0);
	TemplateHelper::dt_checkbox(FSText::_('Published'),'published',@$data -> published,1);
	TemplateHelper::dt_edit_text(FSText :: _('Ordering'),'ordering',@$data -> ordering,@$maxOrdering,'20');
	TemplateHelper::dt_edit_image(FSText :: _('Icon'),'icon',str_replace('/original/','/resized/',URL_ROOT.@$data->icon),'','','Kích thước chuẩn 22x22');
	TemplateHelper::dt_edit_image(FSText :: _('Image'),'image',str_replace('/original/','/resized/',URL_ROOT.@$data->image),'','','Kích thước chuẩn 196x212');
	$this -> dt_form_end(@$data,1,1);
	?>
<script type="text/javascript">
	function created_direct(link){
		$('#menu_link').val(link);
	}
	function created_indirect(link,created_link_id){
		$('#menu_link').val(link);
		window.open("index2.php?module=menus&view=items&task=add_param&id="+created_link_id, "","height=600,width=700,menubar=0,resizable=1,scrollbars=1,statusbar=0,titlebar=0,toolbar=0");
	}
	
</script>
	