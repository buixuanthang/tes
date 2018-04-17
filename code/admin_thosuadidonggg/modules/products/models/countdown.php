<?php
class ProductsModelsCountdown extends FSModels {
	var $limit;
	var $prefix;
	var $image_watermark;
	function __construct() {
		$this->limit = 20;
		$this->table_name = 'fs_products_countdown';
		$this->table_category = 'fs_products_categories';
		parent::__construct ();
	}
	
	function setQuery() {
		
		// ordering
		$ordering = "";
		$where = "  ";
		if (isset ( $_SESSION [$this->prefix . 'sort_field'] )) {
			$sort_field = $_SESSION [$this->prefix . 'sort_field'];
			$sort_direct = $_SESSION [$this->prefix . 'sort_direct'];
			$sort_direct = $sort_direct ? $sort_direct : 'asc';
			$ordering = '';
			if ($sort_field)
				$ordering .= " ORDER BY $sort_field $sort_direct, created_time DESC, id DESC ";
		}
		if (isset ( $_SESSION [$this->prefix . 'filter0'] )) {
			$filter = $_SESSION [$this->prefix . 'filter0'];
			if ($filter) {
				$where .= ' AND b.category_id_wrapper like   "%,' . $filter . '%," ';
			}
		}
		// lọc loại sản phẩm
		if (isset ( $_SESSION [$this->prefix . 'filter1'] )) {
			$filter = $_SESSION [$this->prefix . 'filter1'];
			if ($filter == 1) {
				$where .= ' AND a.is_continuity  = 1 ';
			}elseif($filter == 2){
				$where .= ' AND a.is_continuity  = 0 ';
			}
		}
		
		if (! $ordering)
			$ordering .= " ORDER BY a.created_time DESC , a.id DESC ";
		
		if (isset ( $_SESSION [$this->prefix . 'keysearch'] )) {
			if ($_SESSION [$this->prefix . 'keysearch']) {
				$keysearch = $_SESSION [$this->prefix . 'keysearch'];
				$where .= " AND ( b.name LIKE '%" . $keysearch . "%' OR b.alias LIKE '%" . $keysearch . "%' OR a.product_id = '" . $keysearch . "' )";
			}
		}
		
		$query = " SELECT a.*, b.name as product_name,b.image as product_image, b.category_name
						  FROM 
						  	" . $this->table_name . " AS a
						  	LEFT JOIN fs_products AS b ON a.product_id = b.id
						  	WHERE 1=1 " . $where . $ordering . " ";
		return $query;
	}
	
	/*
		 * select in category
		 */
	function get_categories_tree() {
		global $db;
		$sql = " SELECT id, name, parent_id AS parent_id 
				FROM " . $this->table_category;
		$db->query ( $sql );
		$categories = $db->getObjectList ();
		
		$tree = FSFactory::getClass ( 'tree', 'tree/' );
		$rs = $tree->indentRows ( $categories, 1 );
		return $rs;
	}
	
	function save($row = array(), $use_mysql_real_escape_string = 0) {
		$product_id = FSInput::get ( 'product_id' );
		if (! $product_id) {
			Errors::_ ( 'You must entere product' );
			return false;
		}
		$id = FSInput::get ( 'id', 0, 'int' );
		$type = FSInput::get ( 'type', 0, 'int' );
		
		$started_date = FSInput::get('started_date');
		$started_hour = FSInput::get('started_hour',date('H:i'));
		if($started_date){
			$row['started_time'] = date('Y-m-d H:i:s',strtotime($started_hour.':0 '. $started_date));
		}	
		
		$row['price'] = FSInput::get ( 'price', 0, 'money' );
		$row['price_min'] = FSInput::get ( 'price_min', 0, 'money' );
		$row['step_price'] = FSInput::get ( 'step_price', 0, 'money' );
		
		if(!$row['price'] || !$row['price_min']|| !$row['step_price']|| !$row['started_time']){
			Errors::_ ( 'Nhập đầy đủ các trường' );
			return false;
		}
		
		$row['is_continuity'] = FSInput::get ( 'is_continuity', 0, 'int' );
		if($row['is_continuity']){ // Loại này phải nhập bước time
//			$step_time = FSInput::get ( 'step_time', 0, 'int' );
//			
//			$finished_date = FSInput::get('finished_date');
//			$finished_hour = FSInput::get('finished_hour',date('H:i'));
//			if(!$finished_date || !$finished_hour){
//				Errors::_ ( 'Nhập thời gian kết thúc' );
//				return false;
//			}
//			if(!$row['step_price']){
//				Errors::_ ( 'Nhập bước giá' );
//				return false;
//			}
			$row['continuity_started_time'] = null;
			$row['continuity_finished_time'] =   null;
			
//			$row['finished_time'] = date('Y-m-d H:i:s',strtotime($finished_hour.':0 '. $finished_date));
//			$row['continuity_total_time'] = ' NULL ';
				
		}
		
			if($type){ // Chọn bước time + bước giá => Tính time kết thúc
				$step_time = FSInput::get ( 'step_time', 0, 'int' );
				if(!$step_time){
					Errors::_ ( 'Nhập khoảng time' );
					return false;
				}
				
				// số lần giảm giá
				$times_countdown = ceil(($row['price']  - $row['price_min'])/$row['step_price']);
	//			$finished_time = 
				$row['finished_time'] = date('Y-m-d H:i:s',strtotime($started_hour.':0 '. $started_date.' + '.($times_countdown * $step_time).' minute'));
				$row['step_time'] = $step_time;
				
			}else{ // Chọn thời gian kết thúc + bước giá => Tính khoảng time
				$finished_date = FSInput::get('finished_date');
				$finished_hour = FSInput::get('finished_hour',date('H:i'));
				if(!$finished_date || !$finished_hour){
					Errors::_ ( 'Nhập thời gian kết thúc' );
					return false;
				}
				$row['finished_time'] = date('Y-m-d H:i:s',strtotime($finished_hour.':0 '. $finished_date));
				
				$steps = ceil(($row['price'] - $row['price_min']) / $row['step_price']  );
				$interval = round((strtotime($row['finished_time']) - strtotime($row['started_time']))/ $steps);
				$row['step_time'] = $interval;
			}
		
		
		
		$id = parent::save ( $row );
		
		return $id;
	}
	
	function get_products_by_cat($cat_id){
		if(!$cat_id)
			return;
		return  $this -> get_records('published = 1 AND category_id_wrapper LIKE   "%,'.$cat_id.',%"', 'fs_products','id,name');
	}
}
?>