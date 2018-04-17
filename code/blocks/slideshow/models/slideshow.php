<?php 
	class SlideshowBModelsSlideshow extends FSModels{
	
		function __construct()
		{
		}
		
		function get_data($category_id,$limit = 10){	
			$where = "";
			if($category_id){
				$where .= " AND category_id = ".$category_id." ";
			}
			$fstable = FSFactory::getClass('fstable');
			$table_name  = $fstable->_('fs_slideshow');						
			 $query = "  SELECT id,name,image,url,summary
					FROM ".$table_name."
					WHERE published = 1 ".$where."	
					ORDER BY ordering ";
			global $db;
			$db->query($query);
			$result = $db->getObjectList();
			return $result;
		}
		function get_category($cat_id){
			if(!$cat_id)
				return;
			return $this -> get_record_by_id($cat_id,'fs_slideshow_categories');
		}
	}
	
?>