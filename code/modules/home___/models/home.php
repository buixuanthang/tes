
<?php 
	class HomeModelsHome extends FSModels
	{
		function __construct()
		{
			$this->limit = 10;
		}
		function get_cats()
		{
			global $db;
			$query = " SELECT id,name, alias,tags_group,tablename,is_accessories, root_id, is_accessories,list_parents,icon,is_special
					FROM fs_products_categories 
					WHERE 
						show_in_homepage = 1 AND level = 0
					ORDER BY ordering
							";
			$db->query($query);
			$list = $db->getObjectList();
			
			return $list;	
		}
		function get_manufactory($tablename,$special = 0) {
			$where = '';
			if ($tablename) {
				$where .= 'AND tablenames like "%,' . $tablename . ',%"';
			}
			if ($special) {
				$where .= ' AND is_special <> 1 ';
			}
			global $db;
			$query = ' SELECT id,name, image, alias
							FROM fs_manufactories 
							WHERE published = 1  
							 ' . $where.'
							 ORDER BY  ordering ASC,name ASC
							 ' ;
			$sql = $db->query ( $query );
			$alias = $db->getObjectListByKey ('id');
			
			return $alias;
		}
		/*
		 * return products list in category list.
		 * These categories is Children of category_current
		 */
		function set_query_body($cat_id,$manf_id,$cat_special_id = 0)
		{
			$where  = "";
			
			if($cat_special_id){
				$where  .= " AND category_id_wrapper NOT like '%".$cat_special_id."%' ";
			}
			if($cat_id){
				$where  .= " AND category_id_wrapper like '%".$cat_id."%' ";
			}
			if($manf_id){
				$where  .= " AND manufactory =".$manf_id ;
			}
			$fs_table = FSFactory::getClass('fstable');
			$query = " FROM ".$fs_table -> getTable('fs_products')."
						  WHERE 
						  	 published = 1  AND category_published = 1 AND show_in_home = 1
						  	". $where.
						    " ORDER BY  ordering DESC,created_time DESC, id DESC
						 ";
			return $query;
		}
		function get_list($query_body)
		{
			if(!$query_body)
				return;
			global $db;
			$query = " SELECT id,name,summary,image, created_time,category_id, category_alias, alias,price,price_old ,discount,published_double,image_double,date_end,date_start,warranty,types,is_hotdeal,accessories ";
			$query .= $query_body;
			$query .= 'LIMIT '.$this->limit;
			$db->query($query);
			$result = $db->getObjectList();
			return $result;
		}
	function get_types(){
		return $list = $this -> get_records('published = 1','fs_products_types','id,name,image,alias','ordering ASC');
	}
		
		function get_cat_special(){
			return $this -> get_record('published = 1 AND is_special = 1','fs_products_categories');
		}
		function get_sub_cats_special($cat_id){
			return $this -> get_records('published = 1 AND parent_id = '.$cat_id,'fs_products_categories');
		}

		// bo lọc manu vì nó có rồi
		function get_filters_home(){
			$fs_table = FSFactory::getClass ( 'fstable' );
			return $this -> get_records('published = 1 AND is_home = 1 AND field_name <> "manufactory" ',$fs_table->_('fs_products_filters'),'*');
		}
		// bo lọc manu vì nó có rồi
		function get_filters_manufactories(){
			$fs_table = FSFactory::getClass ( 'fstable' );
			return $this -> get_records('published = 1 AND is_home = 1 AND field_name = "manufactory" ',$fs_table->_('fs_products_filters'),'*',' ordering ASC ');
		}
	}
	
?>