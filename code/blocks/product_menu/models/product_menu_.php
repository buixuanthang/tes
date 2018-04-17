<?php
class Product_menuBModelsProduct_menu {
	function __construct() {
	}
	function getListCat() {
		
		$query = "SELECT name,alias,id,level,parent_id as parent_id,alias, list_parents,tablename,image,show_in_homepage,show_in_footer
						  FROM fs_products_categories AS a
						  WHERE published = 1 
						  ORDER BY ordering ASC, id ASC
						  
						 ";
		global $db;
		$db->query ( $query );
		$category_list = $db->getObjectList ();
		
		if (! $category_list)
			return;
		$tree_class = FSFactory::getClass ( 'tree', 'tree/' );
		return $list = $tree_class->indentRows ( $category_list, 3 );
	
	}
	function getListProduct() {
		
		$query = "SELECT *
						  FROM fs_products AS a
						  WHERE published = 1
						  ORDER BY ordering ASC, id ASC
						 ";
		global $db;
		$db->query ( $query );
		$product_list = $db->getObjectList ();
	}
	
	/*
	 * Lấy bộ lọc có tính count theo từng filter
	 */
	function get_filters_has_calculate($cat) {
		$module = FSInput::get ( 'module' );
		if ($module != 'products')
			return;
		$where = '';
		$filter = FSInput::get ( 'filter' );
		$count_filter = 0;
		if ($filter) {
			$arr_filter = explode ( ',', $filter );
			//				$arr_standart_filter = array ();
			for($i = 0; $i < count ( $arr_filter ); $i ++) {
				$filter_item = $arr_filter [$i];
				if ($filter_item) {
					//						$arr_standart_filter [] = "'" . $filter_item . "'";
					$where .= ' AND url_alias LIKE  ",%' . $filter_item . '%," ';
					$count_filter ++;
				}
			}
		}
		
		$where .= ' AND url_total_params =  ' . $count_filter . ' ';
		if ($cat->id) {
			$where .= ' AND category_id = ' . $cat->id . ' ';
		}
		//			if($cat -> tablename){
		//				$where .= ' AND tablename = "'.$cat->tablename.'" AND is_common <> 1'; 
		//			} else {
		//				$where .= '  AND is_common = 1'; 
		//			}
		$query = ' SELECT record_id,id, total, filter_show,field_name,field_show,alias, calculator,record_id
						FROM fs_products_filters_values 
						WHERE published = 1 ' . $where . '
						GROUP BY record_id';
		global $db;
		$db->query ( $query );
		return $result = $db->getObjectList ();
	}
	
	/*get filter follow tablename of products
		 * 
		 */
	function get_filter_all() {
		global $db;
		$query = " SELECT *
						FROM fs_products_filters
						WHERE published = 1
						ORDER BY is_common DESC, field_ordering
						";
		$db->query ( $query );
		$result = $db->getObjectList ();
		return $result;
	}

}
?>