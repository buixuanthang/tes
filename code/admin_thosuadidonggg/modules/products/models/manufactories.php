<?php 
	class ProductsModelsManufactories extends FSModels
	{
		var $limit;
		var $page;
		function __construct()
		{
			$limit = 100;
			$page = FSInput::get('page');
			$this->limit = $limit;
			$this -> table_name = 'fs_manufactories';
			//synchronize
			$this -> check_alias = 1;
			$this -> table_product = 'fs_products';
			$this -> arr_img_paths = array(array('resized',220,124,'cut_image'),array('small',110,62,'cut_image'));
			$this -> img_folder = 'images/products/menufactories/';
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
		 * Save into tble fs_manufactories
		 */
		function save($row = array(),$use_mysql_real_escape_string = 0){
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
		function update_table_products($cid,$manufactory){
				$row['manufactory_alias'] = $manufactory->alias;
				$row['manufactory_name'] = $manufactory->name;
				$row['manufactory_image'] = $manufactory->image;
				return $this -> _update($row,'fs_products','  manufactory = '.$cid.' ');
		}
		/*
		 * Update manufactory tại các bảng mở rộng
		 */
		function update_table_products_extend($mid,$manufactory){
			$tables = $this -> get_records('','fs_products_tables',' DISTINCT(table_name)  AS table_name');
						
			if(!count($tables))
				return true;
				
			foreach($tables as $table){
				$table_name = $table -> table_name;
				
				if(!$table_name)
					continue;
				$row['manufactory_alias'] = $manufactory->alias;
				$row['manufactory_name'] = $manufactory->name;
				$row['manufactory_image'] = $manufactory->image;
							
				$this -> _update($row,$table_name,' manufactory = '.$mid.' ');				
			}
		}
		
		function check_remove(){
			$cids = FSInput::get('id',array(),'array');
			
			foreach ($cids as $cid)
			{
				if( $cid != 1)
				{
					$cids[] = $cid ;
				}
			}
			if(count($cids))
			{
				$str_cids = implode(',',$cids);
				global $db;
				
				$sql = " SELECT count(*) FROM  ".$this -> table_product." 
						WHERE manufactory IN ( $str_cids ) 
						 " ;
				// $db->query($sql);
				$result = $db->getResult($sql);
				if($result)
					return false;
			}
			return true;
		}
		/*
		 * value: == 1 :hot
		 * value  == 0 :unhot
		 * published record
		 */
	
	
	}
	
?>