<?php
class VideosModelsHome extends FSModels {
    	function __construct() {
    		parent::__construct ();
    		global $module_config;
		FSFactory::include_class('parameters');
		$current_parameters = new Parameters(@$module_config->params);
		$limit   = $current_parameters->getParams('limit'); 
		if(!$limit)	
			$limit = 16;
		$this->limit = $limit;
        }
		function set_query_body()
		{
			$where  = "";
			$fs_table = FSFactory::getClass('fstable');
			$query = " FROM ".$fs_table -> getTable('fs_videos')."
						  WHERE published = 1 
						  	". $where.
						    " ORDER BY  ordering DESC, id DESC
						 ";

			return $query;
		}
		
		
        
    	function get_categories_home(){
    		$query = " SELECT *
    				  FROM ".$this->table_category."
    				  WHERE published = 1
    				ORDER BY  ordering ,id DESC
    				 ";
    		global $db;
    		$sql = $db->query($query);
    		return  $db->getObjectList();
    	}
    	
    
		function get_list($query_body)
		{
			if(!$query_body)
				return;
				
			global $db;
			$query = " SELECT *";
			$query .= $query_body;
			$sql = $db->query_limit($query,$this->limit,$this->page);
			$result = $db->getObjectList();
			
			return $result;
		}
		
		function get_total($query_body)
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