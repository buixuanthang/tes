<?php
class ProductsModelsProduct extends FSModels {
	function __construct() {
		$limit = 6;
		$page = FSInput::get ( 'page' );
		$this->limit = $limit;
		$this->page = $page;
	
	}
	//		function setQuery()
	//		{
	//			$query = " SELECT id,title,summary,image, categoryid, tag
	//						  FROM fs_contents
	//						  WHERE categoryid = $cid 
	//						  	AND published = 1
	//						ORDER BY  id DESC, ordering DESC
	//						 ";
	//			return $query;
	//		}
	/*
		 * get Category current
		 */
	//		function get_category_by_id($category_id)
	//		{
	//			if(!$category_id)
	//				return "";
	//			$query = " SELECT id,name,is_comment, icon
	//						FROM fs_news_categories 
	//						WHERE id = $category_id ";
	//			global $db;
	//			$sql = $db->query($query);
	//			$result = $db->getObject();
	//			return $result;
	//		}
	

	/*
		 * get Article
		 */
	function get_product() {
		$id = FSInput::get ( 'id',0,'int' );
		$code = FSInput::get ( 'code' );
		if (! $code && ! $id)
			return;
		$fs_table = FSFactory::getClass ( 'fstable' );
		
		$select = " * ";
		$where = "published = 1 and category_published = 1";
		if (! $id)
			$where .= ' AND alias = "' . $code . '"';
		else
			$where .= ' AND id = ' . $id;
		$result = $this->get_record ( $where, $fs_table->getTable ( 'fs_products' ), $select );
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
		$query = " SELECT id,name, alias,vat
						FROM " . $fs_table->getTable ( 'fs_products_categories' ) . " 
						WHERE alias = '$ccode' ";
		global $db;
		$sql = $db->query ( $query );
		$result = $db->getObject ();
		return $result;
	}
	function getCategoryById($id) {
		if (! $id)
			return;
		$fs_table = FSFactory::getClass ( 'fstable' );
		$query = " SELECT *
						FROM " . $fs_table->getTable ( 'fs_products_categories' ) . " 
						WHERE id = $id ";
		global $db;
		$sql = $db->query ( $query );
		$result = $db->getObject ();
		return $result;
	}
	function get_products_in_cat($category_id, $product_id) {
		if (! $category_id)
			return;
		$limit = 5;
		$query = " SELECT name,id , image,price,price_old,discount, alias,category_alias,category_id,accessories,quantity, price,price_old,types,manufactory_image,manufactory_name,date_start,date_end,warranty,is_hotdeal  
						FROM fs_products
						WHERE category_id = $category_id
							AND published = 1 ORDER BY ordering LIMIT " . $limit;
		global $db;
		$sql = $db->query ( $query );
		$result = $db->getObjectListByKey ( 'id' );
		return $result;
	}
	
	function get_products_in_manufactory($category_id ,$manufactory_id, $product_id) {
		if (! $manufactory_id)
			return;
		$limit = 8;
		$query = " SELECT name,id , image,price,price_old,discount, alias,category_alias,quantity, price,price_old,types,manufactory_image,manufactory_name,date_start,date_end,warranty,is_hotdeal  
						FROM fs_products
						WHERE category_id = ".$category_id ." and manufactory = ".$manufactory_id."
							AND published = 1 ORDER BY ordering LIMIT " . $limit;
		global $db;
		$sql = $db->query ( $query );
		$result = $db->getObjectListByKey ( 'id' );
		return $result;
	}
	
	function get_products_related($products_related, $product_id) {
		if (! $products_related || ! $product_id)
			return;
		$limit = 10;
		$rest_products_related_ = substr($products_related, 1, -1);  // retourne "abcde"
		
		$fs_table = FSFactory::getClass ( 'fstable' );
		$query = " SELECT  name,id , image,price,price_old,discount, alias,category_alias,category_id,quantity, price,price_old,types,manufactory_image,manufactory_name,date_start,date_end,warranty,is_hotdeal,summary,accessories
						  FROM " . $fs_table->getTable ( 'fs_products' ) . "
						  WHERE ID IN ( $rest_products_related_ )
						  	AND id <>  $product_id
						  	AND published = 1
						     ORDER BY  ordering DESC , id DESC
						     LIMIT $limit
						 ";
		global $db;
		$sql = $db->query ( $query );
		$result = $db->getObjectList ();
		return $result;
	}
	function get_products_same_price($record_id,$price) {
		if (! $price || ! $record_id)
			return;
		$limit = 5;
		$products  =$this->get_record_by_id($record_id,'fs_products');
		$cat_id= $products->category_id;
		$fs_table = FSFactory::getClass ( 'fstable' );
		$query = " SELECT id,name,summary,image,price,price_old,discount,types, alias,accessories, category_id,category_alias, ABS(price - ".$price.") as price_subtract,manufactory_image,manufactory_name
						  FROM " . $fs_table->getTable ( 'fs_products' ) . "
						  WHERE published = 1
						  	AND id <>  $record_id
						  	AND category_id =  $cat_id
						     ORDER BY price_subtract ASC
						     LIMIT $limit
						 ";
		global $db;
		$sql = $db->query ( $query );
		$result = $db->getObjectList ();
		return $result;
	}
	function getRelateContent($product_name, $product_main_key) {
		if (! $product_name)
			return;
		$where = '';
		$where .= ' AND ( title like "%' . $product_name . '%" ';
		if ($product_main_key) {
			$arr_main_key = explode ( ',', $product_main_key );
			foreach ( $arr_main_key as $item ) {
				if ($item) {
					$where .= ' OR title like "%' . $item . '%" ';
					$where .= ' OR main_key like "%' . $item . '%" ';
				}
			}
		}
		$where .= ') ';
		$limit = 5;
		$fs_table = FSFactory::getClass ( 'fstable' );
		$query = " SELECT id,title, alias, category_id
						  FROM " . $fs_table->getTable ( 'fs_news' ) . "
						  WHERE published  = 1
						  	AND id > 2
						  	" . $where . "
						     ORDER BY  ordering DESC , id DESC
						     LIMIT $limit
						 ";
		global $db;
		$sql = $db->query ( $query );
		$result = $db->getObjectList ();
		return $result;
	}
	function getImages($record_id) {
		if (! $record_id)
			return;
		$limit = 10;
		$fs_table = FSFactory::getClass ( 'fstable' );
	 	$query = " SELECT id,image, record_id,title as name ,  color_id
						  FROM " . $fs_table->getTable ( 'fs_products_images' ) . "
						  WHERE record_id =  $record_id
						     LIMIT $limit
						 ";
		global $db;
		$result = $db->getObjectList ($query );
		return $result;
	}
	function get_price_by_colors($record_id) {
		if (! $record_id)
			return;
		$limit = 10;
		$fs_table = FSFactory::getClass ( 'fstable' );
		$query = " SELECT *
						  FROM " . $fs_table->getTable ( 'fs_products_price' ) . "
						  WHERE record_id =  $record_id
						   ORDER BY  price DESC
						 ";
		global $db;
		$sql = $db->query ( $query );
		$result = $db->getObjectList ();
		return $result;
	}
	
	/* 
		 * get array [id] = alias
		 */
	function get_content_category_ids($str_ids) {
		if (! $str_ids)
			return;
		$fs_table = FSFactory::getClass ( 'fstable' );
		
		// search for category
		

		$query = " SELECT id,alias
                          FROM " . $fs_table->getTable ( 'fs_news_categories' ) . "
                          WHERE id IN (" . $str_ids . ")
                         ";
		
		global $db;
		$sql = $db->query ( $query );
		$result = $db->getObjectList ();
		$array_alias = array ();
		if ($result)
			foreach ( $result as $item ) {
				$array_alias [$item->id] = $item->alias;
			}
		return $array_alias;
	}
	
	function getProductExt($tablename, $product_id) {
		$id = FSInput::get ( 'id', 0, 'int' );
		if (! $tablename || $tablename == 'fs_products')
			return array ();
		global $db;
		if (! $db->checkExistTable ( $tablename ))
			return array ();
		
		$query = " SELECT *
					FROM $tablename 
					WHERE 
						record_id = $product_id	
					";
		$db->query ( $query );
		$result = $db->getObject ();
		
		return $result;
	
	}
	
	/*
		 * Lấy dữ liệu từ các bảng mở rộng
		 */
	function get_all_data_foreign($extend_fields) {
		if (! count ( $extend_fields ))
			return array ();
		$data_foreign = array ();
		foreach ( $extend_fields as $field ) {
			if ($field->field_type == 'foreign_one' || $field->field_type == 'foreign_multi') {
				$table_name = $field->foreign_tablename;
				$id = $field->foreign_id;
				$data_foreign [$field->field_name] = $this->get_records ('id = '.$id, $table_name );
			}
		}
		return $data_foreign;
	}
	/*
		 * Lấy dữ liệu từ các bảng mở rộng
		 */
		function get_data_foreign($table_name,$value,$type = 'foreign_one'){
			if(!$value)
				return;
			$where = '';
			if($type == 'foreign_one'){
				$where  = ' id = '.intval($value).' ';
				return $this -> get_result($where,$table_name,'name');
			}else{
				$where  = ' id IN (0'.$value.'0) ';
				$rs =  $this -> get_records($where,$table_name,'name' );
				$html = '<ul class="foreign_multi">';
				for($i = 0; $i < count($rs); $i ++){
					$html .= '<li>'.$rs[$i]->name.'</li>';		
				}
				$html .='</ul>';
				return $html;
			}
			
		}

		function get_products_same_config ( $table_name, $ext_fields,$extend, $data , $limit = 4 ){
			if(!$table_name || !count($ext_fields) || !$extend)
				return;
			$where = '';
			foreach($ext_fields as $field){
				if($field -> is_config){
					$fname = $field -> field_name;
					$ftype = $field -> field_type;
					$value = isset($extend -> $fname) ? $extend -> $fname : '';
					if(!$value)
						break;
					if($ftype == 'foreign_multi'){
						$arr_value = explode(',', $value);
						foreach($arr_value as $v){
							if(!$v)
								continue;
							if($where)
								$where .= ' OR ';
							$where .= $fname. ' LIKE "%,'.$v.',%" ';
						}
					}else{
						if($where)
								$where .= ' OR ';
						$where .= $fname. ' = "'.addslashes($value).'" ';
					}
				}
			}
			if(!$where)
				return;
			$where = '('.$where.')';
			
			$fs_table = FSFactory::getClass ( 'fstable' );
			$query = " SELECT record_id as id,name,summary,image,price,price_old,discount,types, alias, category_id,category_alias,manufactory_image,manufactory_name
							  FROM " . $table_name . "
							  WHERE published = 1
							  	AND record_id <>  ".$data -> id." AND  ".$where ."
							  	ORDER BY ordering ASC 
							     LIMIT $limit
							 ";
			global $db;
			$db->query ( $query );
			$result = $db->getObjectList ();
			return $result;
		}
		
	function get_ext_group_fields($str_group_fields)
		{
			// get rootid
			if(!$str_group_fields)
				return ;
			
			global $db;
			// query get alias
			$query = " SELECT *
						FROM fs_products_fields_groups 
						WHERE id IN ($str_group_fields)
						ORDER BY ordering ASC ";
			$db->query($query);
			$rs = $db->getObjectListByKey('id');	
			return $rs;
		}
		

	function get_address($str_id) {
		if (! $str_id)
			return;
		
		$query = " SELECT id,name, image
						FROM fs_address
						WHERE id IN (" . $str_id . ") 
							AND published = 1
						ORDER BY ordering
						";
		global $db;
		$db->query ( $query );
		$result = $db->getObjectList ();
		return $result;
	}
	
	function get_products_by_ids($str_products_together) {
		if (! $str_products_together)
			return;
		$query = " SELECT name,id , image, alias,category_alias,summary,is_hotdeal,date_start,date_end,h_price,price,price_old
						FROM fs_products
						WHERE id IN (" . $str_products_together . ") 
						AND published = 1
						LIMIT 4
						";
		global $db;
		$sql = $db->query ( $query );
		$result = $db->getObjectListByKey ( 'id' );
		return $result;
	}
	
	function get_products_incentives($product_id) {
		
		$query = " SELECT *
						FROM fs_products_incentives AS a
						WHERE product_id = $product_id";
		global $db;
		$sql = $db->query ( $query );
		$result = $db->getObjectList ();
		return $result;
	}
	
	function get_products_shops($str_shop_ids) {
		if (! $str_shop_ids)
			return;
		$query = " SELECT a.*
						FROM fs_products_shops AS a
						WHERE a.shop_id IN ($str_shop_ids)
							AND is_promotion = 1
						";
		global $db;
		$sql = $db->query ( $query );
		$result = $db->getObjectList ();
		return $result;
	}
	/*
		 * Lấy danh sách category 
		 */
	function get_list_parent($list_parents) {
		if (! $list_parents)
			return;
		$fs_table = FSFactory::getClass ( 'fstable' );
		$query = 'SELECT name,id,alias,parent_id FROM ' . $fs_table->getTable ( 'fs_products_categories' ) . ' WHERE id IN (0' . $list_parents . '0) 
					ORDER BY parent_id ASC' ;
		global $db;
		$db->query ( $query );
		$list = $db->getObjectList ();
		return $list;
	}
	/*
		 * get alias of parent_root
		 */
	function get_ext_fields($tablename) {
		// get rootid
		if (! $tablename)
			return;
		
		global $db;
		// query get alias  
		// tam thơi xóa điều kiệns AND is_compare = 1
		$query = " SELECT *
						FROM fs_products_tables 
						WHERE table_name = '$tablename'
						ANd  is_filter <> 1 
						ORDER BY ordering  
						 ";
		$db->query ( $query );
		$rs = $db->getObjectList ();
		return $rs;
	}

	function get_news_relate_tags($tag ,$tablename) {
		if (! $tag)
			return;
		$arr_tags = explode ( ',', $tag );
		$where = ' WHERE published = 1';
		$total_tags = count ( $arr_tags );
		if ($total_tags) {
			$where .= ' AND (';
			$j = 0;
			for($i = 0; $i < $total_tags; $i ++) {
				$item = trim ( $arr_tags [$i] );
				if ($item) {
					if ($j > 0)
						$where .= ' OR ';
						$where .= " tags like '%" . $item . "%'";
					$j ++;
				}
			}
			$where .= ' )';
		}
		
		global $db;
		$limit = 6;
		$fs_table = FSFactory::getClass ( 'fstable' );
		
		$query = " SELECT id,title,alias ,category_id ,image , category_alias ,summary,created_time
						FROM " . $fs_table->getTable ( $tablename ) . " 
						" . $where . "
						ORDER BY id DESC,ordering DESC
						LIMIT 0,$limit
						";
		$db->query ( $query );
		$result = $db->getObjectList ();
		
		return $result;
	}

	function get_relate_news($news_related) {
		if (! $news_related)
			return;
		$limit = 6;
		$rest_news_related_ = substr($news_related, 1, -1);  // retourne "abcde"
		
		$fs_table = FSFactory::getClass ( 'fstable' );
		$query = " SELECT id,title,summary,image, alias, category_id,category_alias
						  FROM " . $fs_table->getTable ( 'fs_news' ) . "
						  WHERE ID IN ( $rest_news_related_ )
						  	AND published = 1
						     ORDER BY  ordering DESC , id DESC
						     LIMIT $limit
						 ";
		global $db;
		$sql = $db->query ( $query );
		$result = $db->getObjectList ();
		return $result;
	}
	function get_newsest() {
		
		$limit = 6;
		
		
		$fs_table = FSFactory::getClass ( 'fstable' );
		$query = " SELECT id,title,summary,image, alias, category_id,category_alias
						  FROM " . $fs_table->getTable ( 'fs_news' ) . "
						  WHERE published = 1
						     ORDER BY  ordering DESC , id DESC
						     LIMIT $limit
						 ";
		global $db;
		$sql = $db->query ( $query );
		$result = $db->getObjectList ();
		return $result;
	}
	function get_types(){
		return $list = $this -> get_records('published = 1','fs_products_types','id,name,image,alias','ordering ASC');
	}

	function update_hits($record_id){
		if(USE_MEMCACHE){
			$fsmemcache = FSFactory::getClass('fsmemcache');
			$mem_key = 'array_hits';
			
			$data_in_memcache = $fsmemcache -> get($mem_key);
			if(!isset($data_in_memcache))
				$data_in_memcache = array();
			if(isset($data_in_memcache[$record_id])){
				$data_in_memcache[$record_id]++;
			}else{
				$data_in_memcache[$record_id] = 1;
			}
			$fsmemcache -> set($mem_key,$data_in_memcache,10000);
			
		}else{
			if(!$record_id)
				return;
				
			// count
			global $db,$econfig;
			$sql = " UPDATE fs_products 
					SET hits = hits + 1 
					WHERE  id = '$record_id' 
				 ";
			$db->query($sql);
			$rows = $db->affected_rows();
			return $rows;
		}
	}
	function get_price_product(){
		$fs_table = FSFactory::getClass ( 'fstable' );
		$price_id = FSInput::get ( 'price_id' );
		if (!$price_id)
			return;
		 $query = " SELECT *
						FROM " . $fs_table->getTable ( 'fs_products_price' ) . " 
						WHERE id = $price_id";
		global $db;
		$sql = $db->query ( $query );
		$result = $db->getObject ();
		return $result;	
	}
		/*
		 * get temporary data stored in fs_order
		 * 1
		 */
		function getOrder() {
			$session_id = session_id();
			$query = " SELECT *
						FROM fs_order
						WHERE  session_id = '$session_id' 
						AND is_temporary = 1 ";
			global $db;
			$db -> query($query);
			return $rs = $db->getObject();
			
		}
		function get_user(){
			if(!isset($_COOKIE['username']))
				return false;
			$username = $_COOKIE['username'];
				if(!$username)
				return;
			$query = " SELECT full_name,sex,address as address,email, mobilephone,mobilephone
						FROM fs_members 
						WHERE  username = '$username' ";
			global $db;
			$db -> query($query);
			return $rs = $db->getObject();
		}
		/*
		 * if currency = 'VND' return
		 * else transform. 
		 */
		function getPrice() {
			$record_id = FSInput::get('id');
			if(!$record_id)
				return -1;
			$query = " SELECT price,  discount
						FROM fs_products 
						WHERE id = $record_id
						 ";
			global $db;
			$db -> query($query);
			$rs = $db->getObject();
			
			return array($rs->price,$rs -> discount);
		}
		function eshopcart2_simple_save(){
			
			//$username = isset($_COOKIE['username'])?$_COOKIE['username'] : '';
			//$user_id = $this ->get_user_id();
			$username = isset($_COOKIE['username'])?$_COOKIE['username'] : '';
			$user_id ='';
				
			$sender_email  = FSInput::get('sender_email');
			
			if(!$sender_email)
				return;
			
			$quantity = FSInput::get('quantity');
			$price =  FSInput::get('price');
			$warranty =  FSInput::get('warranty');
			
		
			//mau san pham
			$color_id =  FSInput::get('color');
			$color =$this->get_record_by_id($color_id,'fs_products_price');
			if($color)
				$price = $price + $color->price;
				
			if($warranty == 3){
				$total_before_discount =  ($price+300000)* $quantity;
			}else if($warranty == 2){
				$total_before_discount =  ($price+300000)* $quantity;
			}else {
				$total_before_discount =  $price* $quantity;
			}
			//khu  vực
			$region =  FSInput::get('region');
			$data =$this->get_record_by_id(FSInput::get('id'),'fs_products');
			if($data){
				if($region == 'sl_hn'){
					$total_before_discount = $total_before_discount+$data->ha_hoi;
				}else if($region =='sl_hcm'){	
					$total_before_discount = $total_before_discount+$data->ho_chi_minh;
				}elseif($region =='sl_dn')	{
					$total_before_discount =$total_before_discount+$data->da_nang;
				}	
				
			}
		 	$total_after_discount = $total_before_discount;
		 	$products_count = $quantity; 					
			$prd_id_str =  FSInput::get('id');
			
			$session_id = session_id();
			
			$sender_name  = FSInput::get('sender_name');
			$sender_telephone  = FSInput::get('sender_telephone');
			$sender_address  = FSInput::get('sender_address');
			$time = date("Y-m-d H:i:s");
			if(!$sender_name || !$sender_email  )
				return false;
				
			$fsstring = FSFactory::getClass('FSString');
			$random_string = $fsstring -> generateRandomString(8);
			$code_order = $random_string;
			
			$sql = " INSERT INTO 
					fs_order (`username`,`user_id`,products_id,is_temporary,session_id,sender_name,
								sender_address,sender_email,sender_telephone,
								created_time,edited_time,total_before_discount,total_after_discount,products_count,is_activated,code_order)
					VALUES ('$username','$user_id','$prd_id_str','0','$session_id','$sender_name',
								'$sender_address','$sender_email','$sender_telephone',
								'$time','$time','$total_before_discount','$total_after_discount','$products_count','0','$code_order');
					";
			global $db;
			// $db->query($sql);
			$id = $db->insert($sql);
			
			// update
			$this -> save_order_items($id);

			return $id;
		}
		function get_user_id(){
			$username = $_SESSION['username'];
				if(!$username)
				return;
			$query = " SELECT id
						FROM fs_members 
						WHERE  username = '$username' ";
			global $db;
			$db -> query($query);
			return $rs = $db->getResult();
		}
		/*
		 * Save data into fs_order_items
		 */
		function save_order_items($order_id){
			if(!$order_id)
				return false;
				
			global $db;
			
			// remove before update or inser
			$sql = " DELETE FROM fs_order_items
					WHERE order_id = '$order_id'"  ;
			
			// $db->query($sql);
			$rows = $db->affected_rows($sql);	
			
			$quantity = FSInput::get('quantity');
			$price =  FSInput::get('price');
			$price_old =  FSInput::get('price_old');
		 	$products_count = $quantity; 					
			$prd_id =  FSInput::get('id');	
			$warranty =  FSInput::get('warranty');
			$region =  FSInput::get('region');
			//mau san pham
			$color_id =  FSInput::get('color');
			$color =$this->get_record_by_id($color_id,'fs_products_price');
			if($color) 
				$price = $price + $color->price;
			if($warranty == 3){
				$total_money =  ($price +300000)* $quantity;
			}else if($warranty == 2){
				$total_money =  ($price +300000)* $quantity;
			}else{
				$total_money =  $price* $quantity;
			}
			//khu  vực
			$region =  FSInput::get('region');
			$data =$this->get_record_by_id(FSInput::get('id'),'fs_products');
			if($data){
				if($region == 'sl_hn'){
					$total_money = $total_money+$data->ha_hoi;
				}else if($region =='sl_hcm'){	
					$total_money = $total_money+$data->ho_chi_minh;
				}elseif($region =='sl_dn')	{
					$total_money =$total_money+$data->da_nang;
				}	
				
			}	
//			$total_money = $quantity*$price;
			
			// insert data
			$sql = " INSERT INTO fs_order_items (order_id,product_id,price,count,discount,total,warranty,color_id,region)
					VALUES ('$order_id','$prd_id','$price','$quantity','$price_old','$total_money','$warranty','$color_id','$region') "; 
									
				// $db->query($sql);
				$rows = $db->affected_rows($sql);
				return true;				
			
				
		}

	function get_images_plus($record_id) {
		if (! $record_id)
			return;
		$fs_table = FSFactory::getClass ( 'fstable' );
		$query = " SELECT *
						  FROM " . $fs_table->getTable ( 'fs_products_images_plus' ) . "
						  WHERE record_id =  $record_id
						   ORDER BY  id DESC
						 ";
		global $db;
		$sql = $db->query ( $query );
		$result = $db->getObjectList ();
		return $result;
	}
	
	function get_list_new_product()
		{
			global $db;
			$query = "SELECT name,id , image,price,price_old,discount, alias,category_alias,quantity, price,price_old,types,manufactory_image,manufactory_name,date_start,date_end,warranty,is_hotdeal,summary,accessories
			 FROM fs_products WHERE published = 1  AND category_published = 1 AND show_in_homepage = 1  AND is_new = 1
			ORDER BY  ordering DESC, created_time DESC, id DESC LIMIT 0,5";
			$db->query($query);
			$result = $db->getObjectList();
			return $result;
		}
		function get_list_hot_product()
		{
			global $db;
			$query = "SELECT name,id , image,price,price_old,discount, alias,category_alias,quantity, price,price_old,types,manufactory_image,manufactory_name,date_start,date_end,warranty,is_hotdeal,summary,accessories
			 FROM fs_products  WHERE is_sell = 1 ORDER BY sale_count DESC, created_time DESC, id DESC LIMIT 0,5";
			$db->query($query);
			$result = $db->getObjectList();
			return $result;
		}
		function remove_cached($link_detail){
			// $this -> remove_memcached();
			$fsCache = FSFactory::getClass('FSCache');
			$module_rm = 'comments';

			$str_link = $link_detail;
			
			// xoa chi tiết tin
			$fsCache -> remove($str_link,'modules/'.$module_rm);
		
			
			// $files = glob(PATH_BASE.'/cache/modules/comments/*' ); 
			// foreach( $files as $file ){			
			// 	if( is_file( $file ) ) {				
			// 		if( !@unlink( $file ) ) {
			// 			//Handle your errors 
			// 		} 
			// 	} 
			// }			
			
			// $files = glob(PATH_BASE.'/cache/modules/comments/*' ); 
			// foreach( $files as $file ){			
			// 	if( is_file( $file ) ) {				
			// 		if( !@unlink( $file ) ) {
			// 			//Handle your errors 
			// 		} 
			// 	} 
			// }			

			echo '1';
		}

		function get_orders(){
			return $this -> get_records('sender_name <> "" AND sender_telephone <> ""','fs_order','*',' id DESC ', '10');
		}

		 function get_filter_menu($manu_id,$table_name){
		 	if(!$manu_id || !$table_name)
		 		return;
		 	return $this -> get_record(' tablename = "'.$table_name.'" AND field_name = "manufactory" AND filter_value = "'.$manu_id.'" ','fs_products_filters','*');	
		 }
}

?>