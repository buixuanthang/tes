
<?php 
	class SearchModelsSearch  extends FSModels
	{
		function __construct(){
			parent:: __construct();
			$limit = 20;
			$this->limit = $limit;
		}
		function set_query_body()
		{
			global $db;
			$keyword = FSInput::get('keyword');
			if(!$keyword)
				return ;
			$keyword = str_replace('-', ' ',$keyword);
			$keyword = $db -> escape_string($keyword);
			$fs_table = FSFactory::getClass('fstable');
			$where = "";
			$where .= " AND (name like '%".$keyword."%' OR tags like '%".$keyword."%' ) ";
			$sql   = "	 FROM ".$fs_table -> getTable('fs_products')."
						WHERE published =1 ".
						$where ;
			return $sql;
			
		}
		
	
		
		function get_list($query_body){
			if(!$query_body)
				return;
			$query_ordering = $this -> set_query_order_by();
			$query_select = $this -> set_query_select();
			$query = $query_select;
			$query .= $query_body;
			$query .= $query_ordering;
			global $db;
			// echo $query;
			$db->query_limit($query,$this->limit,$this->page);
			$result = $db->getObjectList();
			// print_r($result);
			return $result;
		}
		
		/*
		 * Insert order by into query select
		 */
		function set_query_order_by(){
			$order  = FSInput::get('order');
			 $query_ordering = '';
			if($order){
				switch ($order){
					case 'asc':
						$query_ordering='ORDER BY price '.$order;
						break;
					case 'desc':
						$query_ordering='ORDER BY price '.$order;
						break;
					case 'old':
						$query_ordering='ORDER BY status ASC';
						break;	
					case 'new':
						$query_ordering='ORDER BY status DESC';
						break;	
					case 'alpha':
						$query_ordering='ORDER BY name asc';
						break;	
					case 'promotion':
						$query_ordering='ORDER BY is_promotion asc';
						break;				
				}
			}else{
				$query_ordering='ORDER BY  id DESC';
			}
			
			return $query_ordering;
		}
		function set_query_select(){
			$query = " SELECT * ";
			return $query;
		}
		
	
		
		function getTotal($query_body)
		{	
			if(!$query_body)
				return;
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

		function get_news()
		{
			global $db;
			$keyword = FSInput::get('keyword');
			if(!$keyword)
				return ;
			$keyword = str_replace('-', ' ',$keyword);
			$keyword = $db -> escape_string($keyword);
			$fs_table = FSFactory::getClass('fstable');
			$where = "";
			$where .= " AND (title like '%".$keyword."%' OR tags like '%".$keyword."%' ) ";
			$sql   = " SELECT *	 FROM ".$fs_table -> getTable('fs_news')."
						WHERE published =1 ".
						$where ." ORDER BY id DESC 
						LIMIT 6 ";
			global $db;
			// echo $query;
			$db->query($sql);
			$result = $db->getObjectList();
			// print_r($result);
			return $result;
			
		}

		function get_products()
		{
			global $db;
			$keyword = FSInput::get('keyword');
			if(!$keyword)
				return ;
			$keyword = str_replace('-', ' ',$keyword);
			$keyword = $db -> escape_string($keyword);
			$fs_table = FSFactory::getClass('fstable');
			$where = "";
			$where .= " AND (name like '%".$keyword."%' OR tags like '%".$keyword."%' ) ";
			$sql   = " SELECT *	 FROM ".$fs_table -> getTable('fs_products')."
						WHERE published =1 ".
						$where ." ORDER BY id DESC 
						LIMIT 6 ";
			global $db;
			// echo $query;
			$db->query($sql);
			$result = $db->getObjectList();
			// print_r($result);
			return $result;
			
		}

		function get_projects()
		{
			global $db;
			$keyword = FSInput::get('keyword');
			if(!$keyword)
				return ;
			$keyword = str_replace('-', ' ',$keyword);
			$keyword = $db -> escape_string($keyword);
			$fs_table = FSFactory::getClass('fstable');
			$where = "";
			$where .= " AND (name like '%".$keyword."%' OR tags like '%".$keyword."%' ) ";
			$sql   = " SELECT *	 FROM ".$fs_table -> getTable('fs_projects')."
						WHERE published =1 ".
						$where ." ORDER BY id DESC 
						LIMIT 6 ";
			global $db;
			// echo $query;
			$db->query($sql);
			$result = $db->getObjectList();
			// print_r($result);
			return $result;
			
		}

	}
	
?>