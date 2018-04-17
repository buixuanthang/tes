<?php 
class NewsModelsNews extends FSModels{
	var $limit;
	var $prefix;
	function __construct(){
		$this->limit = 50;
		$this->view = 'news';

		$this-> table_category_name = FSTable_ad::_('fs_news_categories');
		$this-> table_types = FSTable_ad::_('fs_news_types');
		$this->arr_img_paths = array (array ('resized', 270, 180, 'cut_image' ), array ('small', 114, 68, 'cut_image' ), array ('large', 454, 260, 'cut_image' ) );
		$this -> table_name = FSTable_ad::_ ('fs_news');
		// config for save
		$cyear = date ( 'Y' );
		$cmonth = date ( 'm' );
		$cday = date ( 'd' );
		$this->img_folder = 'images/news/' . $cyear . '/' . $cmonth . '/' . $cday;
		$this->check_alias = 0;
		$this->field_img = 'image';

		parent::__construct ();
	}


	function get_categories_tree() {
		global $db;
		$query = " SELECT a.*
						  FROM 
						  	" . $this->table_category_name . " AS a
						  	ORDER BY ordering ";
		$result = $db->getObjectList ( $query );
		// echo '<pre>';
		// print_r($result);
		// echo '</pre>';
		$tree = FSFactory::getClass ( 'tree', 'tree/' );
		$list = $tree->indentRows2 ( $result );
		// echo '<pre>';
		// print_r($list);
		// echo '</pre>';
		return $list;
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
		
		// estore
		if (isset ( $_SESSION [$this->prefix . 'filter0'] )) {
			$filter = $_SESSION [$this->prefix . 'filter0'];
			if ($filter) {
				$where .= ' AND a.category_id_wrapper like  "%,' . $filter . ',%" ';
			}
		}
		
		if (! $ordering)
			$ordering .= " ORDER BY created_time DESC , id DESC ";
		
		if (isset ( $_SESSION [$this->prefix . 'keysearch'] )) {
			if ($_SESSION [$this->prefix . 'keysearch']) {
				$keysearch = $_SESSION [$this->prefix . 'keysearch'];
				$where .= " AND a.title LIKE '%" . $keysearch . "%' ";
			}
		}
		
		$query = " SELECT a.*
						  FROM 
						  	" . $this->table_name . " AS a
						  	WHERE 1=1 " . $where . $ordering . " ";
		return $query;
	}
}


?>