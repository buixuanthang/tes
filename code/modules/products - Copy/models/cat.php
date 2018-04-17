<?php
class ProductsModelsCat extends FSModels {
	function __construct() {
		parent::__construct ();
		global $module_config;
		FSFactory::include_class('parameters');
		$current_parameters = new Parameters(@$module_config->params);
		$limit   = $current_parameters->getParams('limit'); 
		$limit = $limit ? $limit: 24;
		$this->limit = $limit;
	}
	function get_compare_product($table_name) {
		if (isset ( $_SESSION [$table_name] )) {
			$compare = $_SESSION [$table_name];
			global $db;
			$result = "";
			for($i  = 0;$i < 3; $i++ ){
				@$one =$compare[$i];
				if (! empty ( $one )) {
					$query = " SELECT name,id,image
								FROM fs_products
								WHERE id=$one
								AND published = 1
								";
					$db->query ( $query );
					$result [] = reset ( $db->getObjectList () );
				} else {
					$result [] = "";
				}
			}
			return $result;
		} else {
			return "";
		}
	}
	function set_query_body_normal($cid) {
		if (! $cid)
			return;
		$where = "";
		$fs_table = FSFactory::getClass ( 'fstable' );
		$price_from = FSInput::get ( 'pricef', 0, 'int' );
		$price_to = FSInput::get ( 'pricet', 0, 'int' );
		if ($price_from) {
			$where .= " AND a.price >= " . $price_from . " ";
		}
		if ($price_to) {
			$where .= " AND a.price <= " . $price_to . " ";
		}
		
		// filter
		$filter = FSInput::get ( 'filter' );
		if ($filter) {
			$arr_filter = explode ( ',', $filter );
			$arr_standart_filter = array ();
			for($i = 0; $i < count ( $arr_filter ); $i ++) {
				$filter_item = $arr_filter [$i];
				if ($filter_item) {
					$arr_standart_filter [] = "'" . $filter_item . "'";
				}
			}
			if (count ( $arr_standart_filter )) {
				$str_standart_filter = implode ( ",", $arr_standart_filter );
				
				// get filter in table fs_products_filter follow request
				$filter_from_db = $this->getFilterFromRequest ( $str_standart_filter );
				for($i = 0; $i < count ( $filter_from_db ); $i ++) {
					$item = $filter_from_db [$i];
					$calculator = $item->calculator;
					
					$filter_value = '';
					$filter_value1 = '';
					$filter_value2 = '';
					if ($calculator > 9) {
						$filter_value = $item->filter_value;
						$arr_value = explode ( ",", $filter_value, 2 );
						$filter_value1 = @$arr_value [0] ? $arr_value [0] : "";
						$filter_value2 = @$arr_value [1] ? $arr_value [1] : "";
					} else {
						$filter_value = $item->filter_value;
					}
					
					switch ($calculator) {
						case '1' :
							break;
						case '2' :
							$where .= " AND  a." . $item->field_name . " LIKE '%" . $filter_value . "%' ";
							break;
						case '3' :
							$where .= " AND  a." . $item->field_name . " is NULL  ";
							break;
						case '4' :
							$where .= " AND  a." . $item->field_name . " is NOT NULL  ";
							break;
						case '5' :
							$where .= " AND  a." . $item->field_name . " = '" . $filter_value . "' ";
							break;
						case '6' :
							$where .= " AND  a." . $item->field_name . " > " . $filter_value . " ";
							break;
						case '7' :
							$where .= " AND  a." . $item->field_name . " < " . $filter_value . " ";
							break;
						case '8' :
							$where .= " AND  a." . $item->field_name . " >= " . $filter_value . " ";
							break;
						case '9' :
							$where .= " AND  a." . $item->field_name . " <= " . $filter_value . " ";
							break;
						case '10' :
							$where .= " AND a." . $item->field_name . " > " . $filter_value1 . "  ";
							$where .= " AND a." . $item->field_name . " < " . $filter_value2 . "  ";
							break;
						case '11' :
							$where .= " AND a." . $item->field_name . " > " . $filter_value1 . "  ";
							$where .= " AND a." . $item->field_name . " <= " . $filter_value2 . "  ";
							break;
						case '12' :
							$where .= " AND a." . $item->field_name . " >= " . $filter_value1 . "  ";
							$where .= " AND a." . $item->field_name . " < " . $filter_value2 . "  ";
							break;
						case '13' :
							$where .= " AND a." . $item->field_name . " >= " . $filter_value1 . "  ";
							$where .= " AND a." . $item->field_name . " <= " . $filter_value2 . "  ";
							break;
						case '14' ://FOREIGN_ONE
							$where .= " AND   $item->field_name = '" . $filter_value . "' ";
							break;
						case '15' ://FOREIGN_MULTI
							$where .= " AND $item->field_name like  '%," . $filter_value . ",%' ";
							break;
						default :
							break;
					}
				}
			}
		}
		
		$type_alias = FSInput::get('type');
		if($type_alias){
			$type = $this -> get_record('alias = "'.$type_alias.'"','fs_products_types');
			if($type)	
				$where .= ' AND types LIKE "%,'.$type -> id.',%" ';
		}
		
		$query = '';
		//			$query = " SELECT id,name,summary,image,price,   alias
		$query .= " FROM " . $fs_table->getTable ( 'fs_products' ) . " AS a
						  WHERE category_id_wrapper like '%," . $cid . ",%'
						  	AND published = 1
						  	" . $where . "";
		return $query;
	}
	
	//	return 1: fs_products
	//  return 0: fs_products_...(detail) 
	function select_table($category) {
		$filter = FSInput::get ( 'filter' );
		global $db;
		if ($filter && $category->tablename && ($db->checkExistTable ( $category->tablename ))) {
			return 0;
		}
		return 1;
	}
	
	function get_list($query_body, $tablename) {
		if (! $query_body)
			return;
		$query_ordering = $this->set_query_order_by ( $tablename );
		$query_select = $this->set_query_select ( $tablename );
		$query = $query_select;
		$query .= $query_body;
		$query .= $query_ordering;
		global $db;
		$db->query_limit ( $query, $this->limit, $this->page );
		$result = $db->getObjectList ();
		return $result;
	}
	
	/*
		 * $table_type: 1: fs_products
		 * $table_type: 0: fs_products_...(detail)
		 */
	function set_query_body($category) {
		if ($category->tablename)
			return $this->set_query_body_filter ( $category->id, $category->tablename );
		else
			return $this->set_query_body_normal ( $category->id );
	
		//			if($table_type)
	//				return $this -> set_query_body_normal($category -> id);
	//			else 
	//				return $this -> set_query_body_filter($category -> tablename);
	}
	
	function set_query_body_filter($category_id,$tablename) {
		if (! $tablename)
			return;
		global $db,$tmpl;
		$where = '';
		// filter
		$filter = FSInput::get ( 'filter' );
		if ($filter) {
			$arr_filter = explode ( ',', $filter );
			$arr_standart_filter = array ();
			for($i = 0; $i < count ( $arr_filter ); $i ++) {
				$filter_item = $arr_filter [$i];
				if ($filter_item) {
					$arr_standart_filter [] = "'" . $filter_item . "'";
				}
			}
			if (count ( $arr_standart_filter )) {
				$str_standart_filter = implode ( ",", $arr_standart_filter );
				
				// get filter in table fs_products_filter follow request
				$filter_from_db = $this->getFilterFromRequest ( $str_standart_filter,$tablename );

				$filter_name_current = '';
				$closed  = 0;
				
				for($i = 0; $i < count ( $filter_from_db ); $i ++) {
					$item = $filter_from_db [$i];
					$calculator = $item->calculator;
					$field_name =  $item->field_name;
					$closed = 1;
					if($filter_name_current != $field_name){
						if($i)
							$where .= ') AND ( ';
						else 
							$where .= ' AND ( ';
						$filter_name_current = $field_name;
					}else{
						$where .= ' OR ';
					}
					
					$filter_value = '';
					$filter_value1 = '';
					$filter_value2 = '';
					if ($calculator > 9) {
						$filter_value = $item->filter_value;
						$arr_value = explode ( ",", $filter_value, 2 );
						$filter_value1 = @$arr_value [0] ? $arr_value [0] : "";
						$filter_value2 = @$arr_value [1] ? $arr_value [1] : "";
					} else {
						$filter_value = $item->filter_value;
					}
					
//					// Tìm hãng sản xuất để đưa ra ngoài
//					if($field_name == 'manufactory'){
//						$manu_tmpl = $tmpl -> get_variables('manu');
//						if(!$manu_tmpl) {
//							$tmpl -> assign('manu',array($filter_value));
//						}else{
//							$manu_tmpl[] = $filter_value;
//							$tmpl -> assign('manu',$manu_tmpl);
//						}
//					}
					
					
//					if($item->field_name == 'price'){
//						$item->field_name = $item->field_name.'+('.$item->field_name.'*'.$cat->vat.')/100'; 
//					}
					switch ($calculator) {
						case '1' :
							break;
						case '2' :
							$where .= " a." .$field_name . " LIKE '%" . $filter_value . "%' ";
							break;
						case '3' :
							$where .= " a." .$field_name . " is NULL  ";
							break;
						case '4' :
							$where .= " a." .$field_name . " is NOT NULL  ";
							break;
						case '5' :
							$where .= " ( CONVERT( a.".$field_name.", DECIMAL(10,2)) = ".$filter_value." OR  a." .$field_name . " = '" . $filter_value . "') ";
							break;
						case '6' :
							$where .= " CONVERT( a.".$field_name.", DECIMAL(10,2))  > " . $filter_value . " ";
//							$where .= " a." .$field_name . " > " . $filter_value . " ";
							break;
						case '7' :
							$where .= " CONVERT( a.".$field_name.", DECIMAL(10,2))< " . $filter_value . " ";
//							$where .= " a." .$field_name . " < " . $filter_value . " ";
							break;
						case '8' :
							$where .= " CONVERT( a.".$field_name.", DECIMAL(10,2)) >= " . $filter_value . " ";
//							$where .= " a." .$field_name . " >= " . $filter_value . " ";
							break;
						case '9' :
							$where .= " CONVERT( a.".$field_name.", DECIMAL(10,2)) <= " . $filter_value . " ";
//							$where .= " a." .$field_name . " <= " . $filter_value . " ";
							break;
						case '10' :
							$where .= " ( CONVERT( a.".$field_name.", DECIMAL(10,2)) > " . $filter_value1 . "  ";
							$where .= " AND CONVERT( a.".$field_name.", DECIMAL(10,2)) < " . $filter_value2 . " ) ";
							
//							$where .= " ( a." .$field_name . " > " . $filter_value1 . "  ";
//							$where .= " AND a." .$field_name . " < " . $filter_value2 . " ) ";
							break;
						case '11' :
							$where .= " ( CONVERT( a.".$field_name.", DECIMAL(10,2)) > " . $filter_value1 . "  ";
							$where .= " AND CONVERT( a.".$field_name.", DECIMAL(10,2)) <= " . $filter_value2 . " ) ";
//							$where .= " ( a." .$field_name . " > " . $filter_value1 . "  ";
//							$where .= " AND a." .$field_name . " <= " . $filter_value2 . " ) ";
							break;
						case '12' :
							$where .= " ( CONVERT( a.".$field_name.", DECIMAL(10,2)) >= " . $filter_value1 . "  ";
							$where .= " AND CONVERT( a.".$field_name.", DECIMAL(10,2)) < " . $filter_value2 . " ) ";
//							$where .= " ( a." .$field_name . " >= " . $filter_value1 . "  ";
//							$where .= " AND a." .$field_name . " < " . $filter_value2 . " ) ";
							break;
						case '13' :
							$where .= "(  CONVERT( a.".$field_name.", DECIMAL(10,2)) >= " . $filter_value1 . "  ";
							$where .= " AND CONVERT( a.".$field_name.", DECIMAL(10,2)) <= " . $filter_value2 . " ) ";
//							$where .= "(  a." .$field_name . " >= " . $filter_value1 . "  ";
//							$where .= " AND a." .$field_name . " <= " . $filter_value2 . " ) ";
							break;
						case '14' ://FOREIGN_ONE
							$where .= " $field_name = '" . $filter_value . "' ";
							break;
						case '15' ://FOREIGN_MULTI
							$where .= "  $field_name like  '%," . $filter_value . ",%' ";
							break;
						default :
							break;
					}
				}
				if($closed)
					$where .= ')  ';
			}
		}
		
		// manufactory
		$manufactories_request = FSInput::get ( 'manu', '' );
		if ($manufactories_request) {
			$arr_manufactories_request = explode(',',$manufactories_request);
			if(count($arr_manufactories_request)){
				$where .= " AND (";
				$m = 0;
				foreach($arr_manufactories_request as $item){
					if($item){
						if($m)
							$where .= " OR ";
						$where .= " manufactory_alias = '".	$item."' ";
						$m ++; 
					}
				}
				$where .= " ) ";
			}
		}
		
	// Tìm hãng sản xuất để đưa ra ngoài
//					if($field_name == 'manufactory'){
//						$manu_tmpl = $tmpl -> get_variables('manu');
//						if(!$manu_tmpl) {
//							$tmpl -> assign('manu',array($filter_value));
//						}else{
//							$manu_tmpl[] = $filter_value;
//							$tmpl -> assign('manu',$manu_tmpl);
//						}
//					}
		
//		$price_from = FSInput::get ( 'pricef', 0, 'int' );
//		$price_to = FSInput::get ( 'pricet', 0, 'int' );
//		if ($price_from) {
//			$where .= " AND a.ext_price >= " . $price_from . " ";
//		}
//		if ($price_to) {
//			$where .= " AND a.ext_price <= " . $price_to . " ";
//		}
//		$ccode = FSInput::get ( 'ccode' );
		//			$sql   = " SELECT a.id  as pid ,a.name,a.image,a.summary,a.price, a.categoryid,a.estores_count, b.*
		if($category_id){
			$where .= 'AND category_id_wrapper like "%,'.$category_id.',%" '; 
		}
		$sql = " 	FROM $tablename AS a
						WHERE published = 1 ".$where;
		return $sql;
	}
	
	/*
		 * Insert order by into query select
		 */
	function set_query_order_by($table_type) {
		$order = FSInput::get ( 'sort' );
		$query_ordering = '';
			switch ($order) {
				case 'gia-thap-nhat' :
//					$query_ordering = 'ORDER BY price ' . $order;
					$query_ordering='ORDER BY price ASC ';
					break;
				case 'gia-cao-nhat' :
//					$query_ordering = 'ORDER BY price ' . $order;
					$query_ordering='ORDER BY ABS(price) DESC';
					break;
				case 'moi-nhat' :
//					$query_ordering = 'ORDER BY status ASC';
					$query_ordering = 'ORDER BY ordering DESC';
					break;
				case 'xem-nhieu' :
//					$query_ordering = 'ORDER BY status ASC';
					$query_ordering = 'ORDER BY hits DESC';
					break;
				case 'khuyen-mai' :
//					$query_ordering = 'ORDER BY status ASC';
					$query_ordering = 'ORDER BY (price_old - price)/price DESC';
					break;
				case 'ban-chay-nhat' :
//					$query_ordering = 'ORDER BY status ASC';
					$query_ordering = 'ORDER BY sale DESC, hits DESC';
					break;
				default:
					$query_ordering = 'ORDER BY ordering DESC, id DESC';
//					$query_ordering = 'ORDER BY id DESC';
					break;
			}
		return $query_ordering;
	}
	
	/*
		 * Insert select into query select
		 * 1: fs_products
		 */
	function set_query_select($tablename) {
		if (! $tablename) {
			$query = " SELECT id,name,alias,category_alias,category_id,accessories ,summary_auto,image,price,price_old,quantity,alias,promotion_info,discount,types,published_double,image_double,warranty,published_double,warranty,summary,is_hotdeal,if(price > 0,price, 9999999999)  as price_new";
		} else {
			$query = " SELECT record_id as id,alias,category_alias,category_id,accessories , name ,summary_auto,  image, price,price_old,discount,types,manufactory_image,manufactory_name,manufactory_alias,published_double,warranty ,image_double,summary,is_hotdeal,promotion_price ,if(price > 0,price, 9999999999) as price_new ";
		}
		return $query;
	}
	
	/*
		 * get Category current
		 */
	function get_category() {
		$id = FSInput::get ( 'cid', 0, 'int' );
		$where = 'published = 1 ';
		if ($id) {
			$where .= " AND id = '$id'  ";
		} else {
			$code = FSInput::get ( 'ccode' );
			if (! $code)
				return;
			$where .= " AND alias = '$code' ";
		}
		$fs_table = FSFactory::getClass ( 'fstable' );
		$result = $this->get_record ( $where, $fs_table->getTable ( 'fs_products_categories' ), 'name,id,alias,parent_id,list_parents,seo_title,seo_keyword,seo_description,description,tablename,vat,level,parent_id, description, image,icon' );
		return $result;
	}
	/*
		 * get Category current
		 */
	function get_categories() {
		global $db;
			$query = " SELECT id,name, alias,tags_group,tablename,root_id, list_parents,image,level,parent_id
					FROM fs_products_categories 
					WHERE 
						show_in_homepage = 1
					ORDER BY ordering
							";
			$db->query($query);
			$list = $db->getObjectList();
			
			return $list;	
	}
	/*
		 * get Filter from request
		 * $set_key_alias: ==1: Lấy alias làm key
		 */
	function getFilterFromRequest($str_filter,$tablename = '',$set_key_alias = 0) {
		if (! $str_filter)
			return;
		global $db;
		$where = '';
		if($tablename)
			$where .= " AND tablename = '".$tablename."' ";
		else 
			$where .= " AND ( tablename = '' OR tablename = 'fs_products' )  ";
		$query = " SELECT *
						FROM fs_products_filters
						WHERE alias IN ($str_filter)
						AND published = 1
						".$where."
						ORDER BY field_name
						";
		$db->query ( $query );
		if($set_key_alias)
			$result = $db->getObjectListByKey('alias');
		else
			$result = $db->getObjectList ();
			
		return $result;
	}
	
	/*
		 * get Category current
		 */
	function getCategoryByCode() {
		$fs_table = FSFactory::getClass ( 'fstable' );
		$ccode = FSInput::get ( 'ccode' );
		if (! $ccode)
			return;
		$query = " SELECT id,name, alias,tags_group,tablename,is_accessories, root_id, is_accessories,list_parents,icon
						FROM " . $fs_table->getTable ( 'fs_products_categories' ) . " 
						WHERE alias = '$ccode' ";
		global $db;
		$sql = $db->query ( $query );
		$result = $db->getObject ();
		return $result;
	}
	function getProductsList($cid) {
		global $db;
		$query = $this->setQuery ( $cid );
		$sql = $db->query_limit ( $query, $this->limit, $this->page );
		$result = $db->getObjectList ();
		return $result;
	}
	
	function getTotal($query_body) {
		global $db;
		$query = "SELECT count(*) ";
		$query .= $query_body;
		$db->query ( $query );
		$total = $db->getResult ();
		return $total;
	}
	
	function getPagination($total) {
		FSFactory::include_class ( 'Pagination' );
		$pagination = new Pagination ( $this->limit, $total, $this->page );
		return $pagination;
	}
	
	function get_breadcrumb($cat_id, $root_id, $list_parents, $is_accessories) {
		if (! $root_id || ! $cat_id || ! $list_parents)
			return;
		global $db;
		$query = " SELECT parent_id,id,level,name,alias
						FROM fs_products_categories
						WHERE ((root_id = $root_id ) OR level = 0)
						AND published = 1
						";
		$db->query ( $query );
		$list = $db->getObjectList ();
		$array_breadcrumb = array ();
		$array_breadcrumb [0] = array ();
		$array_breadcrumb [0] [] = array ('name' => 'Store', 'link' => '', 'selected' => 1 );
		
		// root
		$array_breadcrumb [1] = array ();
		foreach ( $list as $item ) {
			if ($item->level == 0) {
				$Itemid = $item->is_accessories ? 36 : 34;
				$link = FSRoute::_ ( 'index.php?module=products&view=cat&ccode=' . $item->alias . '&Itemid=' . $Itemid );
				$selected = $item->id == $root_id ? 1 : 0;
				
				$array_breadcrumb [1] [] = array ('name' => $item->name, 'link' => $link, 'selected' => $selected );
			}
		}
		
		$array_list_parents = explode ( ',', $list_parents );
		
		//			$array_cat = array();
		$count_parent = count ( $array_list_parents ) - 2;
		$j = 2;
		if ($count_parent) {
			$Itemid = $is_accessories ? 36 : 34;
			// rootid -> cat_current
			for($i = ($count_parent); $i > 1; $i --) {
				
				$cat_item = $array_list_parents [$i];
				$array_breadcrumb [$j] = array ();
				foreach ( $list as $item ) {
					if ($item->parent_id == $cat_item) {
						$link = FSRoute::_ ( 'index.php?module=products&view=cat&ccode=' . $item->alias . '&Itemid=' . $Itemid );
						$selected = $item->id == $array_list_parents [$i - 1] ? 1 : 0;
						$array_breadcrumb [$j] [] = array ('name' => $item->name, 'link' => $link, 'selected' => $selected );
					}
				}
				$j ++;
			}
		}
		return $array_breadcrumb;
	}
	
	function get_product_from_ids($str_product_ids) {
		if (! $str_product_ids)
			return;
		$query = " SELECT id,is_hot,is_sale,is_new
					FROM fs_products
					WHERE id IN ($str_product_ids) ";
		$query;
		global $db;
		$db->query ( $query );
		$result = $db->getObjectList ();
		return $result;
	}
	
	function get_list_parent($list_parents, $cat_id) {
		if (! $list_parents)
			return;
		$fs_table = FSFactory::getClass ( 'fstable' );
		$query = 'SELECT name,id,alias,parent_id FROM ' . $fs_table->getTable ( 'fs_products_categories' ) . ' WHERE id IN (0' . $list_parents . '0) AND id <> ' . $cat_id . '
					ORDER BY POSITION(","+id+"," IN "0' . $list_parents . '0")';
		global $db;
		$db->query ( $query );
		$list = $db->getObjectList ();
		return $list;
	}
	
	function get_types(){
		return $list = $this -> get_records('published = 1','fs_products_types','id,name,image,alias','ordering ASC');
	}

	function get_group_manu($manufactory) {
		$where = 'published = 1 ';
		if (!$manufactory)
			return;
		$where .= " AND manufactory = $manufactory ";
		$fs_table = FSFactory::getClass ( 'fstable' );
		$result = $this->get_records ( $where, $fs_table->getTable ( 'fs_products_groups' ), '*','ordering DESC, id DESC' );
		
		return $result;
	}
	function get_products($query_body, $tablename) {
		if (! $query_body)
			return;
		$query_ordering = $this->set_query_order_by ( $tablename );
		$query_select = $this->set_query_select ( $tablename );
		$query = $query_select;
		$query .= $query_body;
		$query .= $query_ordering;
		global $db;
		$sql = $db->query ( $query );
		$result = $db->getObjectList ();
		return $result;
	}
	function get_price_by_colors() {
			$fs_table = FSFactory::getClass ( 'fstable' );
			$query = " SELECT id,color_code,record_id
							  FROM " . $fs_table->getTable ( 'fs_products_price' ) . "
							 ";
			global $db;
			$sql = $db->query ( $query );
			$result = $db->getObjectList ();
			return $result;
		}
}

?>