<?php 
	class ProductsModelsCategories extends ModelsCategories
	{
		var $limit;
		var $prefix ;
		function __construct()
		{
			parent::__construct();
			$this -> limit = 1000;
			$this -> type = 'products';
			$this -> table_items = 'fs_'.$this -> type;
			$this -> table_name = 'fs_'.$this -> type.'_categories';
			$this -> check_alias = 1;
			$this -> call_update_sitemap = 0;
			$this->img_folder = 'images/' . $this->type . '/cat';
			$this->field_img = 'image';
			$this -> arr_img_paths = array(array('resized',196,212,'resized_not_crop'));
			$this -> arr_img_paths_icon = array(array('resized',0,41,'resized_not_crop'));
			//synchronize
			$this -> array_synchronize = array('fs_products_filters_values' => array('id'=> 'category_id','alias'=>'category_alias')); // đồng bộ dữ liệu ngoài bảng extend. Viết dang  array(tablename => array(field1, field2,...))
			// exception: key (field need change) => name ( key change follow this field)
			$this -> field_except_when_duplicate = array(array('list_parents','id'),array('alias_wrapper','alias'));
			
			$this -> table_link = 'fs_menus_createlink';
			$this -> calculate_filters = 0;
			
		}
		
		/*
		 * Show list category of product follow page
		 */
		function get_categories_tree()
		{
			global $db;
			$query = $this->setQuery();
			$sql = $db->query($query);
			$result = $db->getObjectList();
			$tree  = FSFactory::getClass('tree','tree/');
			$list = $tree -> indentRows2($result);
			$limit = $this->limit;
			$page  = $this->page?$this->page:1;
			
			$start = $limit*($page-1);
			$end = $start + $limit;
			
			$list_new = array();
			$i = 0;
			foreach ($list as $row){
				if($i >= $start && $i < $end){
					$list_new[] = $row;
				}
				$i ++;
				if($i > $end)
					break;
			}
			return $list_new;
		}
		/*
		 * Select all list category of product
		 */
		function get_categories_tree_all()
		{
			global $db;
			$query = $this->setQuery();
			$sql = $db->query($query);
			$result = $db->getObjectList();
			$tree  = FSFactory::getClass('tree','tree/');
			$list = $tree -> indentRows2($result);
			
			return $list;
		}
		
		function setQuery(){
			
			// ordering
			$ordering = "";
			$task = FSInput::get ( 'task' );
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
			
			$where = "  ";
			
			if(isset($_SESSION[$this -> prefix.'keysearch'] ))
			{
				if($_SESSION[$this -> prefix.'keysearch'] && $task != 'edit' && $task != 'add')
				{
					$keysearch = $_SESSION[$this -> prefix.'keysearch'];
					$where .= " AND name LIKE '%".$keysearch."%' ";
				}
			}
			
		$query = " SELECT a.*, a.parent_id as parent_id 
						  FROM 
						  	".$this -> table_name." AS a
						  	WHERE 1=1".
						 $where.
						 $ordering. " ";
						
			return $query;
		}
		function get_tablenames(){
			$query = " 	   SELECT DISTINCT(a.table_name) 
						  FROM fs_".$this -> type."_tables AS a 
						 ";
			global $db;
			$db->query($query);
			$list = $db->getObjectList();
			// $list = array_merge( array(0=>(object) array('table_name'=>'fs_products')),$list);
			return $list;
		}
		function save($row = array(),$use_mysql_real_escape_string = 0)
		{
		$id = FSInput::get ( 'id', 0, 'int' );
		$cat = $this->get_record_by_id($id);
		$vat = FSInput::get ( 'vat' );
		$tablename = FSInput::get ( 'tablename' );
		
		
			// image
		$image_name_icon = $_FILES["icon"]["name"];
		if($image_name_icon){
			$image_icon = $this->upload_image('icon','_'.time(),2000000,$this -> arr_img_paths_icon);
			if($image_icon){
				$row['icon'] = $image_icon;
			}
		}
		
		$rid = parent::save ($row);
		
		if($tablename){
			$this -> update_table_extend($rid,$tablename);
		}
		
		return $rid;
		}
		function update_table_extend($cid,$tablename){
			
			$record =  $this->get_record_by_id($cid,$this -> table_name);
			$alias =  $record -> alias;
			if($record -> parent_id){
				$parent =  $this->get_record_by_id($record -> parent_id,$this -> table_name);
				$list_parents = ','.$cid.$parent -> list_parents ;
				$alias_wrapper = ','.$alias.$parent -> alias_wrapper ;
			} else {
				$list_parents = ','.$cid.',';
				$alias_wrapper = ','.$alias.',' ;
			}
			
			// update table items
			$id = FSInput::get('id',0,'int');
			if($id){
				$row2['category_id_wrapper'] = $list_parents;
				$row2['category_alias'] = $record -> alias;
				$row2['category_alias_wrapper'] =  $alias_wrapper;
				$row2['category_name'] =  $record -> name;
				$row2['category_published'] =  $record -> published;
				$row3['is_accessories'] =  $record -> is_accessories;
				$row3['is_service'] =  $record -> is_service;
				
				$this -> _update($row2,$tablename,' category_id = '.$cid.' ');
				$this -> _update($row3,$this -> table_items,' category_id = '.$cid.' ');
			}
		}
		function published($value)
		{
			$ids = FSInput::get('id',array(),'array');
		
			if(count($ids))
			{
				global $db;
				foreach ($ids as $id) {
				$record =  $this->get_record_by_id($id,$this -> table_name);
				$tablename = $record->tablename;
				if(!$tablename)
					continue;
					$sql = " UPDATE ".$tablename."
								SET category_published = $value
							WHERE category_id IN ( $id ) " ;
					// $db->query($sql);
					$result = $db->getResult($sql);
				}
			}
			return parent::published($value);
		}
		/*
		 * value: == 1 :hot
		 * value  == 0 :unhot
		 * published record
		 */
	
		function home($value)
		{
			$ids = FSInput::get('id',array(),'array');
			if(count($ids))
			{
				global $db;
				$str_ids = implode(',',$ids);
				$sql = " UPDATE ".$this -> table_items."
							SET show_in_homepage = $value
						WHERE category_id IN ( $str_ids ) " ;
				// $db->query($sql);
				$result = $db->getResult($sql);
				
			}
			return parent::home($value);
		}
	
		function getCreateLinks()
		{
			global $db;
			$query = " SELECT *, parent_id as parent_id
						FROM  ".$this -> table_link."
						WHERE published = 1 AND is_article = 1
						ORDER BY parent_id, ordering ";
			$sql = $db->query($query);
			$result = $db->getObjectList();
			foreach($result as $item){
				$item -> name = FSText::_($item -> name);
			}
			
			$fs_tree  = FSFactory::getClass('tree','tree');
			$list = $fs_tree -> indentRows($result);
			return $list;
		}
	}
	
?>