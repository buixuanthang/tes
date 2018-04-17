
<?php 
	class ProductsModelsHotdeal extends FSModels
	{
		var $limit;
		var $page;
		function __construct()
		{
			$page = FSInput::get('page');
			$this->page = $page;
			$limit = 20;
			$this->limit = $limit;
		}
		
		
		/* return query run
		 * get products list in category list.
		 * These categories is Children of category_current
		 */
		// function set_query_body()
		// {
		// 	$fs_table = FSFactory::getClass('fstable');
		// 	$where = "";
			
		// 	$where .= " AND is_hotdeal = 1  AND date_start < NOW() AND date_end > NOW()";
		// 	$sql   = "	 FROM ".$fs_table -> getTable('fs_products')."
		// 				WHERE published =1 and category_published = 1 ".
		// 				$where ;
		// 	return $sql;
			
		// }
		function set_query_body()
		{
			$fs_table = FSFactory::getClass('fstable');
			$where = "";
			
			$where .= " AND ( price_old <> 0 AND price_old > price ) ";
			$sql   = "	 FROM ".$fs_table -> getTable('fs_products')."
						WHERE published =1 and category_published = 1 ".
						$where ;
			return $sql;
			
		}
		function get_list($query_body)
		{
			if(!$query_body)
				return;
			$query_select = $this -> set_query_select();
			$query = $query_select;
			$query .= $query_body;
			global $db;
			$page =FSInput::get('page');
			if(!$page)
				$page = 1;
			if($page<0)
				$page = 1;
			$start =(($page)*$this->limit)-$this->limit; 
			$end = ($page)*$this->limit;
			$db->query_limit_export ( $query, $start, $end);
			$result = $db->getObjectList();
			return $result;
		}
		function set_query_select(){
			$query = " SELECT id,name,summary,image,accessories,price,price_old,quantity,alias,category_alias,category_id, discount,manufactory_alias,manufactory_image,manufactory_name,summary_auto ,types,promotion_info,published_double,warranty,published_double,date_start,date_end,is_hotdeal";
			return $query;
		}
		function getTotal($query_body){
			global $db;
			$query = "SELECT count(*) ";
			$query .= $query_body;
			$db->query($query);
			$total = $db->getResult();
			return $total;
		}
		function getPagination($total)
		{
			FSFactory::include_class('Pagination');
			$pagination = new Pagination($this->limit,$total,$this->page);
			return $pagination;
		}	
		function get_types(){
			return $list = $this -> get_records('published = 1','fs_products_types','id,name,image,alias','ordering ASC');
		}
		
	}
	
?>