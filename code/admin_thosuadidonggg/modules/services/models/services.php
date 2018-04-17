<?php 
	class ServicesModelsServices extends FSModels
	{
		var $limit;
		var $prefix ;
		function __construct()
		{
			$this -> limit = 20;

			$this -> view = 'services';

			

			$this -> table_category_name = 'fs_services_categories';

			$this -> table_types = 'fs_news_types';

			$this -> arr_img_paths = array(array('resized',175,175,'cut_image'),array('small',80,80,'cut_image'));

			$this -> table_name = 'fs_services';
			$this -> arr_img_paths = array(array('resized',300,300,'cut_image'),array('small',120,120,'cut_image'));
			$this->img_folder = 'images/services';
			// config for save
			$cyear = date('Y');
			$cmonth = date('m');
			$cday = date('d');

			$this -> img_folder = 'images/services/'.$cyear.'/'.$cmonth.'/'.$cday;

			$this -> check_alias = 0;
			$this->field_img = 'image';
//			$this -> arr_img_paths = array(array('resized',16,16,'resized_not_crop'));
			parent::__construct();
		}
		
		function setQuery(){
			
			// ordering
			$ordering = "";
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
			

			// estore

			if(isset($_SESSION[$this -> prefix.'filter0'])){

				$filter = $_SESSION[$this -> prefix.'filter0'];

				if($filter){

					$where .= ' AND a.category_id_wrapper like  "%,'.$filter.',%" ';

				}

			}	

			

			if(!$ordering)
				$ordering .= " ORDER BY created_time DESC , id DESC ";
			
			
			if(isset($_SESSION[$this -> prefix.'keysearch'] ))
			{
				if($_SESSION[$this -> prefix.'keysearch'] )
				{
					$keysearch = $_SESSION[$this -> prefix.'keysearch'];

					$where .= " AND a.title LIKE '%".$keysearch."%' ";

				}
			}
			
			$query = " SELECT a.*
						  FROM 
						  	".$this -> table_name." AS a
						  	WHERE 1=1 ".
						 $where.
						 $ordering. " ";
			return $query;
	}
	
	function save() {
		
		$title = FSInput::get ( 'title' );
		
		if (! $title)
			return false;
		$id = FSInput::get ( 'id', 0, 'int' );
		$category_id = FSInput::get ( 'category_id', 'int', 0 );
		if (! $category_id) {
			Errors::_ ( 'Bạn phải chọn danh mục' );
			return;
		}
		
		$cat = $this->get_record_by_id ( $category_id, 'fs_news_categories' );
		
		$row ['category_id_wrapper'] = $cat->list_parents;
		$row ['category_alias_wrapper'] = $cat->alias_wrapper;
		$row ['category_name'] = $cat->name;
		$row ['category_alias'] = $cat->alias;
		$row ['category_published'] = $cat->published;
		
		// $row['content'] = $_POST['content'];
		

		// user
		// $user_group = $_SESSION['ad_group'];
		$user_id = $_SESSION ['ad_userid'];
		$username = $_SESSION ['ad_username'];
		//			$fullname = $_SESSION['ad_fullname'];
		if (! $id) {
			$row ['action_id'] = $user_id;
			$row ['action_name'] = $username;
		}
		// related products
		$record_relate = FSInput::get ( 'products_record_related', array (), 'array' );
/*		$row ['products_related'] = '';
		if (count ( $record_relate )) {
			$record_relate = array_unique ( $record_relate );
			$row ['products_related'] = ',' . implode ( ',', $record_relate ) . ',';
		}
		$record_news_relate = FSInput::get ( 'news_record_related', array (), 'array' );
		$row ['news_related'] = '';
		if (count ( $record_news_relate )) {
			$record_news_relate = array_unique ( $record_news_relate );
			$row ['news_related'] = ',' . implode ( ',', $record_news_relate ) . ',';
		}
*/
		$result_id = parent::save ( $row );
		if ($result_id) {
			$old_record = $this->get_record_by_id ( $result_id );
			//				if(!$id){
			//					$row['id'] = $result_id;
			$this->save_history ( $old_record );
		
		//				}else{
		//					$this -> save_history($old_record);
		//				}
		}
		return $result_id;
	}
	
	/*
		 * select in category of home
		 */
	function get_categories_tree() {
		global $db;
		$query = " SELECT a.*
						  FROM 
						  	" . $this->table_category_name . " AS a
						  	ORDER BY ordering ";
		$result = $db->getObjectList ( $query );
		$tree = FSFactory::getClass ( 'tree', 'tree/' );
		$list = $tree->indentRows2 ( $result );
		return $list;
	}
	
	function save_history($old_record) {
		if (! $old_record)
			return;
		$user_group = $_SESSION ['ad_groupid'];
		$user_id = $_SESSION ['ad_userid'];
		$username = $_SESSION ['ad_username'];
		//			$fullname = $_SESSION['cms_fullname'];
		

		$fields_in_table = $this->get_field_table ( 'fs_news_history' );
		$str_update = array ();
		$field_img = isset ( $this->field_img ) ? $this->field_img : 'image';
		
		// mảng  $row1 này chỉ phục vụ cho việc đồng bộ dữ liệu ra bảng ngoài theo cấu hình $array_synchronize
		$row = array ();
		for($i = 0; $i < count ( $fields_in_table ); $i ++) {
			$item = $fields_in_table [$i];
			$field = $item->Field;
			
			if ($field == 'id') {
				continue;
			}
			if (isset ( $old_record->$field )) {
				$row [$field] = $old_record->$field;
			}
		}
		$time = date ( 'Y-m-d H:i:s' );
		$row ['news_id'] = $old_record->id; // synchronize
		$row ['action_time'] = $time; // synchronize
		$row ['action_username'] = $username; // synchronize
		$row ['action_id'] = $user_id; // synchronize
		//			$row['action_name'] = $fullname;// synchronize
		$this->_add ( $row, 'fs_news_history', 1 );
	}
	/*
	     * Save all record for list form
	     */
	function save_all() {
		$total = FSInput::get ( 'total', 0, 'int' );
		if (! $total)
			return true;
		$field_change = FSInput::get ( 'field_change' );
		if (! $field_change)
			return false;
		$field_change_arr = explode ( ',', $field_change );
		$total_field_change = count ( $field_change_arr );
		$record_change_success = 0;
		for($i = 0; $i < $total; $i ++) {
			//	        	$str_update = '';
			$row = array ();
			$update = 0;
			foreach ( $field_change_arr as $field_item ) {
				$field_value_original = FSInput::get ( $field_item . '_' . $i . '_original' );
				$field_value_new = FSInput::get ( $field_item . '_' . $i );
				if (is_array ( $field_value_new )) {
					$field_value_new = count ( $field_value_new ) ? ',' . implode ( ',', $field_value_new ) . ',' : '';
				}
				
				if ($field_value_original != $field_value_new) {
					$update = 1;
					// category
					if ($field_item == 'category_id') {
						$cat = $this->get_record_by_id ( $field_value_new, 'fs_news_categories' );
						$row ['category_id_wrapper'] = $cat->list_parents;
						$row ['category_alias_wrapper'] = $cat->alias_wrapper;
						$row ['category_published'] = $cat->published;
						$row ['category_name'] = $cat->name;
						$row ['category_alias'] = $cat->alias;
						$row ['category_id'] = $field_value_new;
					} else {
						$row [$field_item] = $field_value_new;
					}
				}
			}
			if ($update) {
				$id = FSInput::get ( 'id_' . $i, 0, 'int' );
				$str_update = '';
				global $db;
				$j = 0;
				foreach ( $row as $key => $value ) {
					if ($j > 0)
						$str_update .= ',';
					$str_update .= "`" . $key . "` = '" . $value . "'";
					$j ++;
				}
				
				$sql = ' UPDATE  ' . $this->table_name . ' SET ';
				$sql .= $str_update;
				$sql .= ' WHERE id =    ' . $id . ' ';
				$rows = $db->affected_rows ( $sql );
				if (! $rows)
					return false;
				$record_change_success ++;
			}
		}
		return $record_change_success;
	
	}
	/*
		 * value: == 1 :hot
		 * value  == 0 :unhot
		 * published record
		 */
	function hot($value) {
		$ids = FSInput::get ( 'id', array (), 'array' );
		
		if (count ( $ids )) {
			global $db;
			$str_ids = implode ( ',', $ids );
			$sql = " UPDATE " . $this->table_name . "
							SET is_hot = $value
						WHERE id IN ( $str_ids ) ";
			$rows = $db->affected_rows ( $sql );
			return $rows;
		}
		// 	update sitemap
		if ($this->call_update_sitemap) {
			$this->call_update_sitemap ();
		}
		return 0;
	}
	/*
		 * value: == 1 :hot
		 * value  == 0 :unhot
		 * published record
		 */
	function promotion($value) {
		$ids = FSInput::get ( 'id', array (), 'array' );
		
		if (count ( $ids )) {
			global $db;
			$str_ids = implode ( ',', $ids );
			$sql = " UPDATE " . $this->table_name . "
							SET is_promotion = $value
						WHERE id IN ( $str_ids ) ";
			$rows = $db->affected_rows ( $sql );
			return $rows;
		}
		// 	update sitemap
		if ($this->call_update_sitemap) {
			$this->call_update_sitemap ();
		}
		return 0;
	}
	/*
		 * value: == 1 :hot
		 * value  == 0 :unhot
		 * published record
		 */
	function instalment($value) {
		$ids = FSInput::get ( 'id', array (), 'array' );
		
		if (count ( $ids )) {
			global $db;
			$str_ids = implode ( ',', $ids );
			$sql = " UPDATE " . $this->table_name . "
							SET is_instalment = $value
						WHERE id IN ( $str_ids ) ";
			$rows = $db->affected_rows ( $sql );
			return $rows;
		}
		// 	update sitemap
		if ($this->call_update_sitemap) {
			$this->call_update_sitemap ();
		}
		return 0;
	}
	/*
		 * value: == 1 :hot
		 * value  == 0 :unhot
		 * published record
		 */
	function ask($value) {
		$ids = FSInput::get ( 'id', array (), 'array' );
		
		if (count ( $ids )) {
			global $db;
			$str_ids = implode ( ',', $ids );
			$sql = " UPDATE " . $this->table_name . "
							SET is_ask = $value
						WHERE id IN ( $str_ids ) ";
			$rows = $db->affected_rows ( $sql );
			return $rows;
		}
		// 	update sitemap
		if ($this->call_update_sitemap) {
			$this->call_update_sitemap ();
		}
		return 0;
	}
	/*
		 * select in category
		 */
	function get_products_categories_tree() {
		global $db;
		$sql = " SELECT id, name, parent_id AS parent_id 
				FROM fs_products_categories
				ORDER BY ordering ASC ";
		$categories = $db->getObjectList ( $sql );
		
		$tree = FSFactory::getClass ( 'tree', 'tree/' );
		$rs = $tree->indentRows ( $categories, 1 );
		return $rs;
	}
	function ajax_get_products_related() {
		$news_id = FSInput::get ( 'product_id', 0, 'int' );
		$category_id = FSInput::get ( 'category_id', 0, 'int' );
		$keyword = FSInput::get ( 'keyword' );
		$where = ' WHERE published = 1 ';
		if ($category_id) {
			$where .= ' AND (category_id_wrapper LIKE "%,' . $category_id . ',%"	) ';
		}
		$where .= " AND ( name LIKE '%" . $keyword . "%' OR alias LIKE '%" . $keyword . "%' )";
		
		$query_body = ' FROM fs_products ' . $where;
		$ordering = " ORDER BY created_time DESC , id DESC ";
		$query = ' SELECT id,category_id,name,category_name ' . $query_body . $ordering . ' LIMIT 40 ';
		global $db;
		$result = $db->getObjectList ( $query );
		return $result;
	}
	/*
	 *====================AJAX RELATED NEWS==============================
	 */
	function get_products_related($products_related) {
		if (! $products_related)
			return;
		$query = " SELECT id, name 
					FROM fs_products
					WHERE id IN (0" . $products_related . "0) 
					 ORDER BY POSITION(','+id+',' IN '0" . $products_related . "0')
					";
		global $db;
		$result = $db->getObjectList ( $query );
		return $result;
	}
	/*
		 * select in category
		 */
	function get_news_categories_tree() {
		global $db;
		$sql = " SELECT id, name, parent_id AS parent_id 
				FROM fs_news_categories
				ORDER BY ordering ASC ";
		$categories = $db->getObjectList ( $sql );
		
		$tree = FSFactory::getClass ( 'tree', 'tree/' );
		$rs = $tree->indentRows ( $categories, 1 );
		return $rs;
	}
	function ajax_get_news_related() {
		$category_id = FSInput::get ( 'category_id', 0, 'int' );
		$keyword = FSInput::get ( 'keyword' );
		$where = ' WHERE published = 1 ';
		if ($category_id) {
			$where .= ' AND (category_id_wrapper LIKE "%,' . $category_id . ',%"	) ';
		}
		$where .= " AND ( title LIKE '%" . $keyword . "%' OR alias LIKE '%" . $keyword . "%' )";
		
		$query_body = ' FROM fs_news ' . $where;
		$ordering = " ORDER BY created_time DESC , id DESC ";
		$query = ' SELECT id,category_id,title,category_name ' . $query_body . $ordering . ' LIMIT 40 ';
		global $db;
		$result = $db->getObjectList ( $query );
		return $result;
	}
	/*
	 *====================AJAX RELATED NEWS==============================
	 */
	function get_news_related($news_related) {
		if (! $news_related)
			return;
		$query = " SELECT id, title 
					FROM fs_news
					WHERE id IN (0" . $news_related . "0) 
					 ORDER BY POSITION(','+id+',' IN '0" . $news_related . "0')
					";
		global $db;
		$result = $db->getObjectList ( $query );
		return $result;
	}
	
	function remove_cache() {
		
		// $this -> remove_memcached();
		$fsCache = FSFactory::getClass ( 'FSCache' );
		
		$module_rm = 'news';
		$view_rm = 'news';
		$ids = FSInput::get ( 'id', array (), 'array' );
		
		$data = $this->get_record_by_id ( isset ( $ids [0] ) ? $ids [0] : 0 );
		if (! $data)
			return;
		
		$link_detail = FSRoute::_ ( 'index.php?module=news&view=news&id=' . $data->id . '&code=' . $data->alias . '&ccode=' . $data->category_alias );
		$link_detail = str_replace ( URL_ROOT, '/', $link_detail );
		
		$link_detail = md5 ( $link_detail );
		$str_link = $link_detail;
		
		// xoa chi tiết tin
		$fsCache->remove ( $str_link, 'modules/' . $module_rm . '/' . $view_rm );
		
		$fsCache->remove ( $str_link, 'modules/' . $module_rm . '/' . $view_rm );
		
		// xóa trang chủ
		$link_home = md5 ( '/' );
		$fsCache->remove ( $link_home, 'modules/home/home' );
		
		$files = glob ( PATH_BASE . '/cache/modules/news/home/*' );
		foreach ( $files as $file ) {
			if (is_file ( $file )) {
				if (! @unlink ( $file )) {
					//Handle your errors 
				}
			}
		}
		$files = glob ( PATH_BASE . '/cache/modules/news/cat/*' );
		foreach ( $files as $file ) {
			if (is_file ( $file )) {
				if (! @unlink ( $file )) {
					//Handle your errors 
				}
			}
		}
		
		return 1;
	}
	
	function remove_memcached() {
		$array_memkey = array ('blocks', 'config_commom', 'menus', 'banners' );
		$fsmemcache = FSFactory::getClass ( 'fsmemcache' );
		foreach ( $array_memkey as $key ) {
			$fsmemcache->delete ( $key );
		}
	}
}
?>