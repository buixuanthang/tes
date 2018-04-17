<?php  
	global $toolbar;
	$toolbar->setTitle(FSText :: _('Coundown') );
//	$toolbar->addButton('duplicate',FSText :: _('Duplicate'),FSText :: _('You must select at least one record'),'duplicate.png');
//	$toolbar->addButton('save_all',FSText :: _('Save'),'','save.png'); 
	$toolbar->addButton('add',FSText :: _('Add'),'','add.png'); 
	$toolbar->addButton('edit',FSText :: _('Edit'),FSText :: _('You must select at least one record'),'edit.png'); 
	$toolbar->addButton('remove',FSText :: _('Remove'),FSText :: _('You must select at least one record'),'remove.png'); 
	$toolbar->addButton('published',FSText :: _('Published'),FSText :: _('You must select at least one record'),'published.png');
	$toolbar->addButton('unpublished',FSText :: _('Unpublished'),FSText :: _('You must select at least one record'),'unpublished.png');
//	$toolbar->addButton('export',FSText :: _('Export'),'','Excel-icon.png');
	
	//	FILTER
	$filter_config  = array();
	$fitler_config['search'] = 1; 
	$fitler_config['filter_count'] = 2;
	
	$filter_categories = array();
	$filter_categories['title'] = FSText::_('Categories'); 
	$filter_categories['list'] = @$categories; 
	$filter_categories['field'] = 'treename'; 
	

	 
	//SP tiêu biểu
	$filter_hot = array();
	$filter_hot['title'] = FSText::_('Chạy liên tục'); 
	$filter_hot['list'] = array(1=>'Có',2=>'Không'); 
	
	$fitler_config['filter'][] = $filter_categories;	
	$fitler_config['filter'][] = $filter_hot;

	//	CONFIG	
	$list_config = array();
	$list_config[] = array('title'=>'Tên','field'=>'product_name','ordering'=> 1, 'type'=>'text','col_width' => '30%','arr_params'=>array('size'=> 40));
	$list_config[] = array('title'=>'Category','field'=>'category_name','ordering'=> 1, 'type'=>'text','col_width' => '15%');
	
	$list_config[] = array('title'=>'Giá gốc','field'=>'price','ordering'=> 1, 'type'=>'text','col_width' => '12%','arr_params'=>array('function'=>'format_money'));
	$list_config[] = array('title'=>'Giá cuối','field'=>'price_min','ordering'=> 1, 'type'=>'text','col_width' => '12%','arr_params'=>array('function'=>'format_money'));
	$list_config[] = array('title'=>'Bước giá','field'=>'step_price','ordering'=> 1, 'type'=>'text','col_width' => '12%','arr_params'=>array('function'=>'format_money'));
//	$list_config[] = array('title'=>'Giá gốc','field'=>'price', 'type'=>'text','arr_params'=>array('size'=>10));
//	$list_config[] = array('title'=>'Giảm cuối','field'=>'price_min', 'type'=>'text','arr_params'=>array('size'=>10));
//	$list_config[] = array('title'=>'Summary','field'=>'summary','type'=>'text','col_width' => '30%','arr_params'=>array('size'=>50,'rows'=>8));
	
	$list_config[] = array('title'=>'Ordering','field'=>'ordering','ordering'=> 1, 'type'=>'edit_text','arr_params'=>array('size'=>3));
	$list_config[] = array('title'=>'Published','field'=>'published','ordering'=> 1, 'type'=>'published');

	
	$list_config[] = array('title'=>'Số lượng','field'=>'quantity','ordering'=> 1, 'type'=>'text');
	$list_config[] = array('title'=>'Bắt đầu','field'=>'started_time','ordering'=> 1, 'type'=>'datetime');
	$list_config[] = array('title'=>'Kết thúc','field'=>'finished_time','ordering'=> 1, 'type'=>'datetime');
	$list_config[] = array('title'=>'Created time','field'=>'created_time','ordering'=> 1, 'type'=>'datetime');
	$list_config[] = array('title'=>'Edit','type'=>'edit');
	$list_config[] = array('title'=>'Id','field'=>'id','ordering'=> 1, 'type'=>'text');
	
	TemplateHelper::genarate_form_liting($this->module,$this -> view,$list,$fitler_config,$list_config,$sort_field,$sort_direct,$pagination);
?>
<style>
.filter_area select{
	width: 120px;
}
</style>

