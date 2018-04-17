<?php 
	class ServicesModelsCategories extends ModelsCategories
	{
		function __construct()
		{
			$this -> limit = 20;
			
			$this -> table_items = 'fs_services';
			$this -> table_name = 'fs_services_categories';
			$this -> check_alias = 1;
			$this -> call_update_sitemap = 1;
			// config for save
            $this -> arr_img_paths = array(array('resized',175,175,'cut_image'),array('small',80,80,'cut_image'));
			$cyear = date('Y');
			$cmonth = date('m');
			$cday = date('d');
			$this -> img_folder = 'images/services/cat/'.$cyear.'/'.$cmonth.'/'.$cday;
			$this -> check_alias = 0;
			$this -> field_img = 'image';
            
			// exception: key (field need change) => name ( key change follow this field)
			$this -> field_except_when_duplicate = array(array('list_parents','id'),array('alias_wrapper','alias'));
			parent::__construct();
		}
	}
	
?>