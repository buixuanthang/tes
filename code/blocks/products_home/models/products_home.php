<?php

class Products_homeBModelsProducts_home   extends FSModels{

	function __construct() {

	}

		

		/*

		 * select cat list is children of catid

		 */

		function getCats()

		{
			$fstable  = FSFactory:: getClass('fstable');
			

			global $db;

			$query = " SELECT id,name, alias,tags_group,tablename,root_id, parent_id, list_parents,icon,image

					FROM ".$fstable->_('fs_products_categories')." 

					WHERE 

						show_in_homepage = 1

					ORDER BY ordering

							";

//			$db->query($query);
			$list = $db->getObjectList($query);
			return $list;	

		}

		

		/*

		 * select Relate cats

		 */

		function get_cats_relates($str_cats_rootid)

		{

			if(!$str_cats_rootid)

				return false;
			$fstable  = FSFactory:: getClass('fstable');
			
			

			global $db;

			$query = " SELECT id ,parent_id, root_id, name, image,icon, root_alias

					FROM ".$fstable->_('fs_products_categories')."  

					WHERE 

						root_id IN ($str_cats_rootid)

							";

			$db->query($query);

			$list = $db->getObjectList();

			

			return $list;	

		}

		

		/*

		 * return products list in category list.

		 * These categories is Children of category_current

		 */

		function getProducts($cat_id,$limit)

		{

			global $db;

			if(!$cat_id)

				return false;

			$limit = $limit? $limit: 4;

			$order = " ORDER BY ordering DESC, id DESC ";
			$fstable  = FSFactory:: getClass('fstable');
			$table_name = $fstable->_('fs_products');

			$query   = " SELECT id,name,summary,types,image,price,quantity,alias ,category_alias,category_id ,is_new,is_hot,is_sale,promotion_info,discount,price_old,warranty_time,is_stock

						FROM ".$table_name."

						WHERE category_id_wrapper like '%".$cat_id."%' AND published = 1 "

						.$order." 

						LIMIT $limit";

			$db->query($query);

			$result = $db->getObjectList();

			return $result;

		}

	function get_types() {

		$fs_table = FSFactory::getClass ( 'fstable' );
		$query = " SELECT id,name,image
						  FROM " . $fs_table->getTable ( 'fs_products_types' );
		global $db;
		$sql = $db->query ( $query );
		$result = $db->getObjectList ();
		return $result;
	}

	function get_filters_home(){
		$fstable  = FSFactory:: getClass('fstable');
		return $this -> get_records('published = 1 AND is_home = 1 ',$fstable->_('fs_products_filters'),'*');
	}

}	



?>