<?php 
	class ProductsModelsStatus extends FSModels
	{
		var $limit;
		var $page;
		function __construct()
		{
			$limit = 100;
			$page = FSInput::get('page');
			$this->limit = $limit;
			$this -> table_name = 'fs_status';
			//synchronize
			$this -> check_alias = 1;
			$this -> table_product = 'fs_products';
			$this -> arr_img_paths = array(array('resized',62,62,'resized_not_crop'));
			$this->field_img = 'image';
			parent::__construct();
		}
		
		function setQuery()
		{
			// ordering
			$ordering = '';
			$where = "  ";
			if(isset($_SESSION[$this -> prefix.'sort_field']))
			{
				$sort_field = $_SESSION[$this -> prefix.'sort_field'];
				$sort_direct = $_SESSION[$this -> prefix.'sort_direct'];
				$sort_direct = $sort_direct?$sort_direct:'asc';
				$ordering = '';
				if($sort_field)
					$ordering .= " ORDER BY $sort_field $sort_direct, created_time DESC, id DESC ";
			}
				if(!$ordering)
				$ordering .= " ORDER BY created_time DESC , id DESC ";
			
			if(isset($_SESSION[$this -> prefix.'keysearch'] ))
			{
				if($_SESSION[$this -> prefix.'keysearch'] )
				{
					$keysearch = $_SESSION[$this -> prefix.'keysearch'];
					$where .= " AND name LIKE '%".$keysearch."%' ";
				}
			}
			$query = " 	   SELECT * 
						
						  FROM ".$this -> table_name." 
						  	WHERE 1=1 ".
						 $where.
						 $ordering. " ";
			return $query;
		}
		
		
		/*
		 * get Tablename product
		 */
		function get_tablenames()
		{
			global $db;
			$query = " 	   SELECT DISTINCT(a.table_name) as table_name
						  FROM fs_products_tables AS a 
						 ";
			$db->query($query);
			$result = $db->getObjectList();
			
			return $result;
		}
	
	
			
		
		/*
		 * Save into tble fs_status
		 */
		function save(){
			$tablename = FSInput::get('tablenames',array(),'array');
			$str_tables = '';
			for($i = 0 ; $i < count($tablename); $i ++ ){
				if($i)
					$str_tables .= ',';
				$item    = $tablename[$i];
				$str_tables .=  $item;
			}
			if($str_tables)
				$str_tables = ','.$str_tables.',';
			$row['tablenames'] = $str_tables;
		
			$record_id =  parent::save($row);
			if($record_id){
				$record = $this -> get_record('id = '.$record_id.'',$this -> table_name);
				// update bảng sp
				$this -> update_table_products($record_id,$record);
				// update bảng mở rộng
				$this -> update_table_products_extend($record_id,$record);
			}
			return $record_id;
		}
		
		/*
		 * Update table  table fs_products
		 * Chú ý: toàn bộ các bảng con của sp phải đồng bộ lại hết
		 */
		function update_table_products($cid,$status){
				$row['status_alias'] = $status->alias;
				$row['status_name'] = $status->name;
				return $this -> _update($row,'fs_products','  status_id = '.$cid.' ');
		}
		/*
		 * Update status tại các bảng mở rộng
		 */
		function update_table_products_extend($cid,$status){
			$tables = $this -> get_records(' status_id = '.$cid.' ','fs_products',' DISTINCT(tablename) ');
			if(!count($tables))
				return true;
			foreach($tables as $table){
				$table_name = $table -> tablename;
				if(!$table_name)
					continue;
				$row['status_alias'] = $status->alias;
				$row['status_name'] = $status->name;
				
				return $this -> _update($row,$table_name,' status = '.$cid.' ');
			}
		}
	}
	
?>