<?php 
	class NewsModelsHome extends FSModels
	{
		function __construct(){
			
		parent::__construct();
		global $module_config;
		FSFactory::include_class('parameters');
		$current_parameters = new Parameters($module_config->params);
		$limit   = $current_parameters->getParams('limit');         
		$this->limit = $limit;

	
		}
		function set_query_body()
		{
			$where  = "";
			

			$date1  = FSInput::get("date_search");
			$fs_table = FSFactory::getClass('fstable');
			$query = " FROM ".$fs_table -> getTable('fs_news')."
						  WHERE 
						  	 published = 1  AND category_published = 1
						  	". $where.
						    " ORDER BY  ordering DESC,created_time DESC, id DESC 
						 ";
			return $query;
		}
		

		function set_query_body_cate($cate_id)
		{
			$where  = "";
			if($cate_id){
				$where  .= " AND category_id =".$cate_id ;
			}

			$date1  = FSInput::get("date_search");
			$fs_table = FSFactory::getClass('fstable');
			$query = " FROM ".$fs_table -> getTable('fs_news')."
						  WHERE 
						  	 published = 1  AND category_published = 1
						  	". $where.
						    " ORDER BY  ordering DESC,created_time DESC, id DESC 
						 ";
			return $query;
		}
		
		/*
		 * get Category current
		 * By Id or By code
		 */
		function getCategory()
		{
			$fs_table = FSFactory::getClass('fstable');
			$query = " SELECT id,name, icon, alias,parent_id as parent_id,seo_title,seo_keyword,seo_description
						FROM ".$fs_table -> getTable('fs_news_categories')." 
						WHERE published = 1 ";
			global $db;
			$sql = $db->query($query);
			$result = $db->getObject();
			return $result;
		}

		function get_cats()
		{
			global $db;
			$query = " SELECT id,name,alias
					FROM fs_news_categories 
					WHERE 
						show_in_homepage = 1 AND published = 1
					ORDER BY ordering
							";
			$db->query($query);
			$list = $db->getObjectList();
			return $list;	
		}
		function getNewsList($query_body)
		{
			if(!$query_body)
				return;
				
			global $db;
			$query = " SELECT id,title,summary,image, created_time,category_id, category_alias, alias,comments_total,comments_published";
			$query .= $query_body;

			// $sql = $db->query_limit($query,$this->limit,$this->page);
			$db->query($query);
			$result = $db->getObjectList();
			return $result;
		}
		
		

		function getTotal($query_body)
		{
			if(!$query_body)
				return ;
			global $db;
			$query = "SELECT count(*)";
			$query .= $query_body;
			$sql = $db->query($query);
			$total = $db->getResult();
			return $total;
		}
		
		function getPagination($total)
		{
			FSFactory::include_class('Pagination');
			$pagination = new Pagination($this->limit,$total,$this->page);
			return $pagination;
		}
	}
	
?>