<?php 
	$ss_usr_keysearch  = isset($_SESSION['ss_usr_keysearch']) ? $_SESSION['ss_usr_keysearch']:'';
	$ss_usr_group   = isset($_SESSION['ss_usr_group']) ? $_SESSION['ss_usr_group']:'';
	
	if(isset($_SESSION['users_users_sort_field']))
	{
		$sort_field = $_SESSION['users_users_sort_field'];
		$sort_direct = $_SESSION['users_users_sort_direct'];
		$sort_direct = $sort_direct?$sort_direct:'asc';
	}
	
	
?>
<?php  
	global $toolbar;
	$toolbar->setTitle(FSText :: _('User list') );
	$toolbar->addButton('add',FSText :: _('Add'),'','add.png'); 
	$toolbar->addButton('edit',FSText :: _('Edit'),FSText :: _('You must select at least one record'),'edit.png'); 
	$toolbar->addButton('remove',FSText :: _('Remove'),FSText :: _('You must select at least one record'),'remove.png'); 
	$toolbar->addButton('published',FSText :: _('Published'),FSText :: _('You must select at least one record'),'published.png');
	$toolbar->addButton('unpublished',FSText :: _('Unpublished'),FSText :: _('You must select at least one record'),'unpublished.png');
	//	FILTER
	$filter_config  = array();
	$fitler_config['search'] = 1; 
	
	$list_config = array();
	$list_config[] = array('title'=>'Username','field'=>'username','ordering'=> 1, 'type'=>'text');
		$list_config[] = array('title'=>'Email','field'=>'email','ordering'=> 1, 'type'=>'text');
//	$list_config[] = array('title'=>'Image','field'=>'image','type'=>'image','no_col'=>1,'arr_params'=>array('search'=>'/original/','replace'=>'/resized/'));
	$list_config[] = array('title'=>'Ordering','field'=>'ordering','ordering'=> 1, 'type'=>'edit_text','arr_params'=>array('size'=>3));
	$list_config[] = array('title'=>'Published','field'=>'published','ordering'=> 1, 'type'=>'published');
		
	$list_config[] = array('title'=>'Edit','type'=>'edit');
	$list_config[] = array('title'=>'Phân quyền','field'=>'','type'=>'','arr_params'=>array('function'=>'show_permission'));
	$list_config[] = array('title'=>'Created time','field'=>'created_time','ordering'=> 1, 'type'=>'datetime');
	$list_config[] = array('title'=>'Id','field'=>'id','ordering'=> 1, 'type'=>'text');
	
	TemplateHelper::genarate_form_liting($this->module,$this -> view,$list,$fitler_config,$list_config,$sort_field,$sort_direct,$pagination);
?>
