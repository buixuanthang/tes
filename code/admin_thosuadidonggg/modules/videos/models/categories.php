<?php 
	class VideoModelsCategories extends FSModels
	{
		function __construct()
		{
			$this -> limit = 20;
			
			$this -> table_items = 'fs_video';
			$this -> table_name = 'fs_video_categories';
			$this -> check_alias = 1;
//			$this -> call_update_sitemap = 1;
			
			parent::__construct();
		}
	}
	
?>