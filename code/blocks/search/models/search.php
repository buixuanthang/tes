<?php 
	class SearchBModelsSearch
	{
		function __construct()
		{
		}
		
		function get_categories(){
			$query = " SELECT name,alias,id,level,parent_id,alias, list_parents
						  FROM fs_products_categories AS a
						  WHERE published = 1
						  AND level  = 0
						 ";
			global $db;
			$db->query($query);
			$category_list = $db->getObjectList();
			
			if(!$category_list)
				return;
			$tree_class  = FSFactory::getClass('tree','tree/');
			return $list = $tree_class -> indentRows($category_list,3);
		}
	}
?>