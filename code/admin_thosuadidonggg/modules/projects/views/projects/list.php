<?php  
	global $toolbar;
	$toolbar->setTitle(FSText :: _('Projects') );
	$toolbar->addButton('duplicate',FSText :: _('Duplicate'),FSText :: _('You must select at least one record'),'duplicate.png');
	$toolbar->addButton('add',FSText :: _('Add'),'','add.png'); 
	$toolbar->addButton('edit',FSText :: _('Edit'),FSText :: _('You must select at least one record'),'edit.png'); 
	$toolbar->addButton('remove',FSText :: _('Remove'),FSText :: _('You must select at least one record'),'remove.png'); 
	$toolbar->addButton('published',FSText :: _('Published'),FSText :: _('You must select at least one record'),'published.png');
	$toolbar->addButton('unpublished',FSText :: _('Unpublished'),FSText :: _('You must select at least one record'),'unpublished.png');
	$toolbar->addButton('typical',FSText :: _('Typical'),FSText :: _('You must select at least one record'),'published.png');
	$toolbar->addButton('untypical',FSText :: _('UnTypical'),FSText :: _('You must select at least one record'),'unpublished.png');
	
	//	FILTER
			$filter_config  = array();
			$fitler_config['search'] = 1; 
	$fitler_config['filter_count'] = 2;
	$filter_categories = array();
	$filter_categories['title'] = FSText::_('Categories'); 
	$filter_categories['list'] = @$categories; 
	$filter_categories['field'] = 'name'; 
	$fitler_config['filter'][] = $filter_categories;
																																																																																																																																																																																																																																																																																																																																																																																																																							
	$filter_progress['title'] = FSText::_('Tiến độ'); 
	$filter_progress['list'] = $arr_types;
	$fitler_config['filter'][] = $filter_progress;																																																																														
	//	CONFIG	
	$list_config = array();
	$list_config[] = array('title'=>'Name','field'=>'name','ordering'=> 1, 'type'=>'edit_text','col_width' => '30%','arr_params'=>array('size'=> 40));
	$list_config[] = array('title'=>'Image','field'=>'image','type'=>'image','no_col'=>1,'arr_params'=>array('search'=>'/original/','replace'=>'/resized/'));
	$list_config[] = array('title'=>'Category','field'=>'category_name','ordering'=> 1, 'type'=>'text','col_width' => '20%');
	$list_config[] = array('title'=>'Ordering','field'=>'ordering','ordering'=> 1, 'type'=>'edit_text','arr_params'=>array('size'=>3));
	$list_config[] = array('title'=>'Published','field'=>'published','ordering'=> 1, 'type'=>'published');
	$list_config[] = array('title'=>'Tiêu biểu','field'=>'typical','ordering'=> 1, 'type'=>'change_status','arr_params'=>array('function'=>'typical'));
	$list_config[] = array('title'=>'Home','field'=>'show_in_homepage','ordering'=> 1, 'type'=>'change_status','arr_params'=>array('function'=>'home'));
	$list_config[] = array('title'=>'Edit','type'=>'edit');
	$list_config[] = array('title'=>'Người sửa','field'=>'action_username','ordering'=> 1, 'type'=>'action');
	$list_config[] = array('title'=>'Last time','field'=>'edited_time','ordering'=> 1, 'type'=>'datetime');
	$list_config[] = array('title'=>'Created time','field'=>'created_time','ordering'=> 1, 'type'=>'datetime');
	$list_config[] = array('title'=>'Id','field'=>'id','ordering'=> 1, 'type'=>'text');
	
	TemplateHelper::genarate_form_liting($this->module,$this -> view,$list,$fitler_config,$list_config,$sort_field,$sort_direct,$pagination);
		?>
	