<?php 
	class ProductsModelsCart extends FSModels{
		var $limit;
		var $page;
		function __construct()
		{
			parent:: __construct();
			$limit = 30;
			$this->limit = $limit;
			$fs_table = FSFactory::getClass ( 'fstable' );
		
			$this -> table_product =  $fs_table->getTable ( 'fs_products' );
			$this -> table_order =  $fs_table->getTable ( 'fs_order' );
			$this -> table_order_items =  $fs_table->getTable ( 'fs_order_items' );

		}
		
		/*
		 * if currency = '' return
		 * else transform. 
		 */
		function getPrice() {
			$product_id = FSInput::get('id');
			if(!$product_id)
				return -1;
			$query = " SELECT price,  discount
						FROM fs_products 
						WHERE id = $product_id
						 ";
			global $db;
			$db -> query($query);
			$rs = $db->getObject();
			
			return array($rs->price,$rs -> discount);
		}
		/*
		 * get current Estore
		 */
		
//		function getEstore($eid) {
//			if(!$eid)
//				return;
//
//			$query = " SELECT *
//						FROM fs_estores
//						WHERE  id = $eid ";
//			global $db;
//			$db -> query($query);
//			return $rs = $db->getObject();
//		}
		/*
		 * get all payments methods in fs_payment_methods
		 */
		function get_payment_methods($str_epayment_ids){
			if(!$str_epayment_ids){
				return;
			}
			global $db;
			$query = " SELECT *
				FROM fs_payment_methods
				WHERE 
					id IN ($str_epayment_ids)
					AND published = 1
				ORDER BY ordering
				";
			$db->query($query);
			$result = $db->getObjectList();
			return $result;
		}
		/*
		 * get all transfer methods in fs_transfer_methods
		 */
		function get_transfer_methods($str_etransfer_ids){
			if(!$str_etransfer_ids){
				return;
			}
			global $db;
			$query = " SELECT *
				FROM fs_transfer_methods
				WHERE 
					id IN ($str_etransfer_ids)
					AND published = 1
				ORDER BY ordering
				";
			$db->query($query);
			$result = $db->getObjectList();
			return $result;
		}
		
		function getCity($cityid) {
			if(!$cityid)
				return;
			$query = " SELECT *
						FROM fs_cities
						WHERE  id = $cityid ";
			global $db;
			$db -> query($query);
			return $rs = $db->getObject();
		}
		
		function getDistrict($district_id) {
			if(!$district_id)
				return;
			$query = " SELECT *
						FROM fs_districts
						WHERE  id = $district_id ";
			global $db;
			$db -> query($query);
			return $rs = $db->getObject();
		}
		/*
		 * get Payment method
		 */
		function get_payment_method($payment_id){
			if(!$payment_id)
				return;
			$query = " SELECT name
						FROM fs_payment_methods
						WHERE  id = $payment_id ";
			global $db;
			$db -> query($query);
			return $rs = $db->getResult();
		}
		/*
		 * get Payment method
		 */
		function get_transfer_method($transfer_id){
			if(!$transfer_id)
				return;
			$query = " SELECT name
						FROM fs_transfer_methods
						WHERE  id = $transfer_id ";
			global $db;
			$db -> query($query);
			return $rs = $db->getResult();
		}
		
		function getProductName($product_id) {
			if(!$product_id)
				return;
			$query = " SELECT name
						FROM fs_products
						WHERE  id = $product_id ";
			global $db;
			$db -> query($query);
			return $rs = $db->getResult();
		}
		
		function getProductById($product_id) {
			if(!$product_id)
				return;
			$query = " SELECT *
						FROM fs_products
						WHERE  id = $product_id ";
			global $db;
			$db -> query($query);
			return $rs = $db->getObject();
		}
		
		function get_color($id) {
			if(!$id)
				return;
			$query = " SELECT *
						FROM fs_products_price
						WHERE  id = $id ";
			global $db;
			$db -> query($query);
			return $rs = $db->getObject();
		}
		function get_price_by_color($record_id) {
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
		function getProductCategoryById($category_id) {
			if(!$category_id)
				return;
			$query = " SELECT name,id,alias 
						FROM fs_products_categories
						WHERE  id = $category_id ";
			global $db;
			$db -> query($query);
			return $rs = $db->getObject();
		}
		
		/*
		 * get temporary data stored in fs_order
		 * 1
		 */
		function getOrder() {
			$session_id = session_id();
			$query = " SELECT *
						FROM ".$this -> table_order."
						WHERE  session_id = '$session_id' 
						AND is_temporary = 1 ";
			global $db;
			$db -> query($query);
			return $rs = $db->getObject();
			
		}
		
		function getOrderById($id = 0){
			if(!$id)
				$id = FSInput::get('id',0,'int');
			if(!$id)
				return;
			$session_id = session_id();	
			$query = " SELECT *
						FROM ".$this -> table_order."
						WHERE  id = $id 
						AND session_id = '$session_id'
						 ";
			global $db;
			$db -> query($query);
			return $rs = $db->getObject();
		}
		function get_orderdetail_by_orderId($order_id){
			if(!$order_id)
				return;
			$session_id = session_id();	
			$query = " SELECT a.*
						FROM ".$this -> table_order_items." AS a
						WHERE  a.order_id = $order_id ";
			global $db;
			$db -> query($query);
			return $rs = $db->getObjectList();
		}
		
		function get_products_from_orderdetail($str_product_ids){
			if(!$str_product_ids)
				return false;
			$query = " SELECT a.*
						FROM fs_products AS a
						WHERE id IN ($str_product_ids) ";
			global $db;
			$db -> query($query);
			$products = $db->getObjectListByKey('id');
			return $products;
		}
		
		function getDiscount() {
			$discount = 200000;
			return $discount;
		}
		/*
		 * function data into fs_order
		 */
		function eshopcart2_fast_save() {
				 return $this -> eshopcart2_fast_save_new();
		}
		
		/*
		 * function data into fs_order
		 */
		function eshopcart2_save() {
			$session_order = $this -> getOrder();
			$session_id = session_id();
			
			// update
			if($session_order) {
				 return $this -> eshopcart2_save_update();
			} else { // insert
				 return $this -> eshopcart2_save_new();
			}
		}
		
		/*
		 * Update data into fs_order
		 * For 2 case: not member and go to back.
		 */
		function eshopcart2_save_update(){
			if(!isset($_SESSION['cart'])) 
				return false;
			$sender_email  = FSInput::get('sender_email');
			if(!$sender_email)
				return false;
			$discount_code  = FSInput::get('discount_code');
			$discount_successfult  = 0;
			
			$total_before_discount = 0; 
		 	$total_after_discount = 0;
		 	$products_count = 0; 
			 
		 	
			$product_list = $_SESSION['cart'];
				
				// Repeat products
			for($i = 0; $i < count($product_list); $i ++) {
			 	$prd = $product_list[$i];
			 	$prd_id_array[] = $prd[0];
			 	// cal
			 	$total_before_discount += $prd[1]*$prd[2]; 
			 	$products_count += $prd[1]; 
			}
			
			// default:
			$total_after_discount = $total_before_discount;
			$discount_unit = '';	
			$discount_value = '';
			$discount_id = '';
			$discount_money = '';
			if($discount_code){
				$discount_for_guest = $this -> get_discount_4_guest($sender_email,$discount_code);
				
				if($discount_for_guest){
					$discount_unit = $discount_for_guest -> unit;	
					$discount_value = $discount_for_guest -> discount;
					$discount_code = $discount_for_guest -> code;
					$discount_id = $discount_for_guest -> discount_id;
					if($discount_unit == 1){ // tiền mặt
						if($discount_value < $total_before_discount){
							$discount_money = $discount_value;
							$total_after_discount = $total_before_discount - $discount_money;
							$discount_successfult = 1;
						}
					}else{  // phần trăm
						if($discount_value < 100 && $discount_value > 0){
							$discount_money = $total_before_discount * $discount_value / 100;
							$total_after_discount = $total_before_discount - $discount_money;
							$discount_successfult = 1;
						}
					}
				}

//				$discount = $total_before_discount * $discount_for_guest / 100;
//				$total_after_discount = $total_before_discount - $discount;
//				if($total_after_discount < 0){
//				 	$total_after_discount = $total_before_discount;
//				}
			}
					
			$prd_id_str = implode(',',$prd_id_array);
			
			$session_id = session_id();
			
			$sender_name  = FSInput::get('sender_name');
			$sender_sex  = FSInput::get('sender_sex');
			$sender_address  = FSInput::get('sender_address');
//			$sender_email  = FSInput::get('sender_email');
			$sender_telephone  = FSInput::get('sender_telephone');
			$sender_comments  = FSInput::get('sender_comments');
			$recipients_name  = FSInput::get('recipients_name');
			$recipients_sex  = FSInput::get('recipients_sex');
			$recipients_address  = FSInput::get('recipients_address');
			$recipients_email  = FSInput::get('recipients_email');
			$recipients_telephone  = FSInput::get('recipients_telephone');
			$recipients_mobile  = FSInput::get('recipients_mobile');
			$recipients_comments  = FSInput::get('recipients_comments');
			$recipients_here  = FSInput::get('recipients_here');
			$payment_method  = FSInput::get('payment_method');
			$no_people  = FSInput::get('no_people');
			$time = date("Y-m-d H:i:s");

			$received_hour   = FSInput::get('received_hour',0);
			$received_hour  = $received_hour ? $received_hour: 0;
			$received_day      =  FSInput::get("received_day");
			$received_month      =  FSInput::get("received_month");
			$received_year      =  FSInput::get("received_year");
			$received_time = date("Y-m-d H:i:s",mktime($received_hour, 0, 0, $received_month, $received_day, $received_year));
			
				
			$sql = " UPDATE  ".$this -> table_order." SET 
							products_id = '$prd_id_str',
							is_temporary = '1',
							sender_name = '$sender_name',
							sender_sex = '$sender_sex',
							sender_address = '$sender_address',
							sender_email = '$sender_email',
							sender_telephone = '$sender_telephone',
							sender_comments = '$sender_comments',
							recipients_name = '$recipients_name',
							recipients_sex = '$recipients_sex',
							recipients_address = '$recipients_address',
							recipients_email = '$recipients_email',
							recipients_telephone = '$recipients_telephone',
							recipients_mobile = '$recipients_mobile',
							recipients_comments = '$recipients_comments',
							recipients_here = '$recipients_here',
							payment_method = '$payment_method',
							no_people = '$no_people',
							received_time = '$received_time',
							sender_telephone = '$sender_telephone',
							edited_time = '$time',
							total_before_discount = '$total_before_discount',
							total_after_discount = '$total_after_discount',
							products_count = '$products_count',
							discount_id = '$discount_id',
							discount_value = '$discount_value',
							discount_unit = '$discount_unit',
							discount_money = '$discount_money',
							discount_code = '$discount_code',
							
							is_activated = '0'
						WHERE  session_id = '$session_id' 
							AND is_temporary = 1 
					";	
			global $db;
			$db->query($sql);
			$rows = $db->affected_rows();
			
			// update 
			$sql_select = " SELECT id from ".$this -> table_order."
							WHERE session_id = '$session_id' 
							AND is_temporary = 1 ";
			$db -> query($sql_select);
			$order_id  = $db->getResult();
			
			$this -> save_order_items($order_id);
			if($discount_code && !$discount_successfult){
				FSFactory::include_class('errors');
				Errors:: setError("Mã giảm giá không phù hợp");
				return false;
			}
			return $rows;		
		}
		
		function get_discount_4_guest($email,$discount_code){
			$discount = $this -> get_record('code = "'.$discount_code.'" AND email = "'.$email.'" AND published = 1 and is_used = 0','fs_discount_members');
			return $discount;
		}
		
		/*
		 * Save data into fs_order_items
		 */
		function save_order_items($order_id){
			if(!$order_id)
				return false;
				
			global $db,$config;
			
			// remove before update or inser
			$sql = " DELETE FROM ".$this -> table_order_items."
					WHERE order_id = '$order_id'"  ;
			
			//$db->query($sql);
			$rows = $db->affected_rows($sql);	
			
			
			// insert data
			$prd_id_array = array();
			// Repeat estores
			if(!isset($_SESSION['cart']))
				return false;
				
			$product_list  = $_SESSION['cart'];
			$sql = " INSERT INTO ".$this -> table_order_items." (order_id,product_id,price,count,total)
					VALUES "; 
					
			$array_insert = array();
			
			// Repeat products
			for($i = 0; $i < count($product_list); $i ++) {
				
				$prd = $product_list[$i];
				$total_money = $prd[1]*$prd[2];
				
				// calculator color
			 // 	$color_exp = explode('_', $prd[3] );
			 //    $color_price     = $color_exp[0];
			 //    $color_id   = $color_exp[1];
				// $total_money +=  $color_price ;
				// $color = $this -> get_record_by_id($color_exp[1],'fs_products_price');
			 	
			 	// $json_color = fSencode(json_encode($prd[3].'_'.$color ->color_name));

			 	// $arr_attr_new = array();
			 	// calculator attribute
			 // 	foreach ($prd[4] as $key=> $item){
			 // 		$attr_exp = explode('_', $item );
			 // 		$attr_price     = $attr_exp[0];
			 // 		$total_money  += $attr_price  ;

			 // 		$attr = $this -> get_record_by_id($attr_exp[1],'fs_products_attributes_2');

			 // 		$attr_new = $item.'_'.$attr->name;
			 // 		$arr_attr_new[$key] = $attr_new;
			 // 	}
				// $attributes = fSencode(json_encode($arr_attr_new));
				
				$array_insert[] = "('$order_id','$prd[0]','$prd[2]','$prd[1]','$total_money') ";
			}


			if(count($array_insert)) {
				$sql_insert = implode(',',$array_insert);
			$sql .= $sql_insert;
				$db->query($sql);
				$rows = $db->affected_rows();
				return true;				
			} else {
				return;
			}
				
		}

		/* Mua sản phẩm ngay: gõ điện thoại để gọi đên */ 
		function save_order_items_fast($order_id,$product){
			if(!$order_id)
				return false;
				
			global $db,$config;
			
			$row = array();
			$row['order_id'] = $order_id;
			$row['product_id'] = $product -> id;

			$row['price'] = $product -> price;
			$row['count'] = 1;
			$row['total'] = $row['price'] * $row['count'];
			return $this -> _add($row,$this -> table_order_items);		
				
		}

		
		/*
		 * Save new data into fs_order
		 * For 1 case: member buy
		 */
		function eshopcart2_save_new(){
			if(!isset($_SESSION['cart'])) 
				return false;
			$product_list  = $_SESSION['cart'];
			

			$prd_id_array = array();
			$total_before_discount = 0; 
		 	$total_after_discount = 0;
		 	$products_count = 0; 
			 	
			// 	Repeat products	
			for($i = 0; $i < count($product_list); $i ++) {
			 	$prd = $product_list[$i];
			 	$prd_id_array[] = $prd[0];
			 	$products_count += $prd[2]; 
			 	$total_before_discount += $prd[1]*$prd[2]; 

			 	// calculator color
			 	$color_exp = explode('_', $prd[3] );
			    $color_price     = $color_exp[0];
				$total_before_discount = $total_before_discount + $color_price ;

				
			 	// calculator attribute
			 	foreach ($prd[4] as  $key=>$item){
			 		$attr_exp = explode('_', $item );
			 		$attr_price     = $attr_exp[0];
			 		$total_before_discount  += $attr_price  ;
			 	
			 	}
			 	// $color = $this -> get_record_by_id($color_exp[1],'fs_products_price');
			 	// echo $prd[3].'_'.$color ->color_name;

			}
			$total_before_discount = $total_before_discount ;
			
			$total_after_discount = $total_before_discount;
			$prd_id_str = implode(',',$prd_id_array);
			$session_id = session_id();
			
			
	
			$user_id = isset($_COOKIE['user_id'])?$_COOKIE['user_id']:0;
			$username = isset($_COOKIE['username'])?$_COOKIE['username']:0;
			
			$row = array();
			$row['username']              = $username;
			$row['user_id']               = $user_id;

			$row['products_id']           = $prd_id_str;
			$row['is_temporary']          = 0;
			$row['session_id']            = $session_id;
			$row['total_before_discount'] = $total_before_discount;
			$row['total_after_discount']  = $total_after_discount;
			$row['products_count']        = $products_count;
			
			$row['sender_name']           = FSInput::get('sender_name');
			$row['sender_telephone']      = FSInput::get('sender_telephone');
			$row['sender_email']          = FSInput::get('sender_email');
			$row['sender_address']   	  = FSInput::get('sender_address');
			$row['sender_comments']  	  = FSInput::get('sender_comments');
			$row['created_time']     	  = date("Y-m-d H:i:s");
			$row['edited_time']      	  = date("Y-m-d H:i:s");
			
			$id =$this -> _add($row, $this -> table_order);

			// update
			$this -> save_order_items($id);
			if($id) {
				unset($_SESSION['cart']);
			}
			return $id;
		}
		
		
		/*
		 * Save new data into fs_order
		 * For 1 case: member buy
		 * Chỉ thêm mới
		 */
		function eshopcart2_simple_save(){
			
			$username = isset($_COOKIE['username'])?$_COOKIE['username'] : '';
			$user_id = $this ->get_user_id();
			
			if(!isset($_SESSION['cart'])) 
				return false;

//			$product_list   = $_SESSION['cart'];
			
//			$products_new = array();
//			for($i = 0; $i < count($product_list); $i ++) {
//			 	$prd = $product_list[$i];
//				$quantity = FSInput::get('quantity_'.$prd[0]);
//				if($quantity) {
//					$products_new[] = array($prd[0],$quantity,$prd[2],$prd[3]);
//						$count_products ++;
//				}		
//			}

			
//				if($count_products) 
//					$cart_new[] =  $products_new;
//			$_SESSION['cart'] = $products_new;
			

			$sender_email  = FSInput::get('sender_email');
			if(!$sender_email)
				return;
			
			$discount_code  = FSInput::get('discount_code');
			$discount_successfult  = 0;	
				
			$product_list  = $_SESSION['cart'];
			$prd_id_array = array();
						
			$total_before_discount = 0; 
		 	$total_after_discount = 0;
		 	$products_count = 0; 
			 	
			// 	Repeat products	
			for($i = 0; $i < count($product_list); $i ++) {
			 	$prd = $product_list[$i];
			 	$prd_id_array[] = $prd[0];
			 	
			 	// cal
			 	$total_before_discount += $prd[1]*$prd[2]; 
			 	$products_count += $prd[1]; 
			}
		 	/////////////
	 		// default:
			$total_after_discount = $total_before_discount;
			$discount_unit = '';	
			$discount_value = '';
			$discount_id = '';
			$discount_money = '';
			
			if($discount_code){
				$discount_for_guest = $this -> get_discount_4_guest($sender_email,$discount_code);
				
				if($discount_for_guest){
					$discount_unit = $discount_for_guest -> unit;	
					$discount_value = $discount_for_guest -> discount;
					$discount_code = $discount_for_guest -> code;
					$discount_id = $discount_for_guest -> discount_id;
					if($discount_unit == 1){ // tiền mặt
						if($discount_value < $total_before_discount){
							$discount_money = $discount_value;
							$total_after_discount = $total_before_discount - $discount_money;
							$discount_successfult = 1;
						}
					}else{  // phần trăm
						if($discount_value < 100 && $discount_value > 0){
							$discount_money = $total_before_discount * $discount_value / 100;
							$total_after_discount = $total_before_discount - $discount_money;
							$discount_successfult = 1;
						}
					}
				}

//				$discount = $total_before_discount * $discount_for_guest / 100;
//				$total_after_discount = $total_before_discount - $discount;
//				if($total_after_discount < 0){
//				 	$total_after_discount = $total_before_discount;
//				}
			}
					
		 	/////////////
		 	
//			$discount = $total_before_discount * $discount_for_guest / 100;
//			 $total_after_discount = $total_before_discount - $discount;
//			 if($total_after_discount < 0){
//			 	$total_after_discount = $total_before_discount;
//			 }
			$prd_id_str = implode(',',$prd_id_array);
			
			$session_id = session_id();
			
			$sender_name  = FSInput::get('sender_name');
			
			$sender_sex  = FSInput::get('sender_sex');
			$sender_address  = FSInput::get('sender_address');
//			$sender_email  = FSInput::get('sender_email');
			$sender_telephone  = FSInput::get('sender_telephone');
			$sender_comments  = FSInput::get('sender_comments');
			$recipients_name  = FSInput::get('recipients_name');
			$recipients_sex  = FSInput::get('recipients_sex');
			$recipients_address  = FSInput::get('recipients_address');
			$recipients_email  = FSInput::get('recipients_email');
			$recipients_telephone  = FSInput::get('recipients_telephone');
			$recipients_mobile  = FSInput::get('recipients_mobile');
			$recipients_comments  = FSInput::get('recipients_comments');
			$recipients_here  = FSInput::get('recipients_here');
			$payment_method  = FSInput::get('payment_method');
			$no_people  = FSInput::get('no_people');
			$time = date("Y-m-d H:i:s");
//			if(!$sender_name || !$sender_email  || !$recipients_name || ! $recipients_address || !$recipients_email || !$recipients_telephone)
//				return false;
			if(!$sender_name || !$sender_email  )
				return false;
				

			$received_hour   = FSInput::get('received_hour',0);
			$received_hour  = $received_hour ? $received_hour: 0;
			$received_day      =  FSInput::get("received_day");
			$received_month      =  FSInput::get("received_month");
			$received_year      =  FSInput::get("received_year");
			$received_time = date("Y-m-d H:i:s",mktime($received_hour, 0, 0, $received_month, $received_day, $received_year));
			
//			discount_id = '$discount_id',
//							discount_value = '$discount_value',
//							discount_unit = '$discount_unit',
//							discount_money = '$discount_money',
//							discount_code = '$discount_code',

			$fsstring = FSFactory::getClass('FSString');
			$random_string = $fsstring -> generateRandomString(8);
			$code_order = $random_string;
						$row = array();
			$row['username']              = $username;
			$row['user_id']               = $user_id;

			$row['products_id']           = $prd_id_str;
			$row['is_temporary']          = 0;
			$row['session_id']            = $session_id;
			$row['total_before_discount'] = $total_before_discount;
			$row['total_after_discount']  = $total_after_discount;
			$row['products_count']        = $products_count;

			
			$row['sender_name']           = FSInput::get('sender_name');
			$row['sender_telephone']      = FSInput::get('sender_telephone');
			$row['sender_email']          = FSInput::get('sender_email');
			$row['sender_address']   	  = FSInput::get('sender_address');
			$row['sender_comments']  	  = FSInput::get('sender_comments');
			$row['created_time']     	  = date("Y-m-d H:i:s");
			$row['edited_time']      	  = date("Y-m-d H:i:s");
			
		
			
			$id =$this -> _add($row, $this -> table_order);

			
			// update
			$this -> save_order_items($id);

			if($discount_code && !$discount_successfult){
				FSFactory::include_class('errors');
				Errors:: setError("Mã giảm giá không phù hợp");
				return false;
			}
			if($id) {
				unset($_SESSION['cart']);
			}
			return $id;
		}
		
			/*
		 * Save new data into fs_order
		 * For 1 case: member buy
		 */
		function buy_fast_save(){
			
			$id = FSInput::get('id',0,'int');
			$phone = FSInput::get('telephone_buy_fast');
			if(!$id || !$phone)
				return;
			$product = $this -> get_record_by_id($id,'fs_products');
			
			$total_before_discount = $product -> price;
			$total_after_discount = $product -> price;
			$products_count = 1;
			
			
			$prd_id_str = $id;
			$session_id = session_id();
			
			$row = array();
			
			$row['products_id']           = $prd_id_str;
			$row['is_temporary']          = 0;
			$row['session_id']            = $session_id;
			$row['total_before_discount'] = $total_before_discount;
			$row['total_after_discount']  = $total_after_discount;
			$row['products_count']        = $products_count;
			
			$row['sender_name']           = '';
			$row['sender_telephone']      = $phone;
			$row['sender_email']          = '';
			$row['sender_address']   	  = '';
			$row['sender_comments']  	  = '';
			$row['created_time']     	  = date("Y-m-d H:i:s");
			$row['edited_time']      	  = date("Y-m-d H:i:s");
			$row['type']  	  = 'fast';


			$rid =$this -> _add($row, $this -> table_order);
		
			// update
			$this -> save_order_items_fast($rid,$product);			
			return $rid;
		}



		/*
		 * Mua hàng nhanh
		 */
		function eshopcart2_fast_save_new(){
			$total_before_discount = 0; 
		 	$total_after_discount = 0;
		 	$quantity = FSInput::get('quantity',1,'int'); 
		 	$product_id = FSInput::get('id',0,'int'); 
		 	$color_id = FSInput::get('color_id',0,'int'); 
			if(!$product_id)
				return;
			$product = $this -> get_record_by_id($product_id,'fs_products');
			$price = $product -> price;
			if($color_id){
				$price_color = $this -> get_record('record_id = '.$product_id.' AND id = '.$color_id,'fs_products_price');
				if($price_color){
					$price = $price + ($price_color -> price);
				}	
			}	
				
			$total = $price *  $quantity;
			
			$user_id = $_COOKIE['user_id'];
			$username = $_COOKIE['username'];
			
			$row = array();
			$row['username']              = $username;
			$row['user_id']               = $user_id;

			$row['products_id']           = $product_id;
			$row['is_temporary']          = 0;
			$row['session_id']            = session_id();
			$row['total_before_discount'] = $total;
			$row['total_after_discount']  = $total;
			$row['payment_method']        = FSInput::get('payment_method');
			$row['received_method']        = FSInput::get('received_method');
			$row['products_count']        = $quantity;
			$row['products_count']        = $quantity;
			
			$row['sender_name']           = FSInput::get('sender_name');
			$row['sender_telephone']      = FSInput::get('sender_telephone');
			$row['sender_email']          = FSInput::get('sender_email');
			$row['sender_address']   	  = FSInput::get('sender_address');
			$row['sender_comments']  	  = FSInput::get('sender_comments');
			$row['created_time']     	  = date("Y-m-d H:i:s");
			$row['edited_time']      	  = date("Y-m-d H:i:s");
			
			$order_id =$this -> _add($row, $this -> table_order);
			
			// lưu vào order_items
			$row2 = array();
			$row2['order_id'] = $order_id;
			$row2['product_id'] = $product_id;
			$row2['product_id'] = $product_id;
			$row2['price'] = $price;
			$row2['count'] = $quantity;
			$row2['total'] = $total;
			$row2['color'] = $price_color -> color_id;
			$this -> _add($row2, $this -> table_order_items);

			$this -> mail_to_buyer($order_id);
			return $order_id;
		}
		
		function get_estore_type($eid){
			if(!$eid)
				return;
			$query = " SELECT estore_type
						FROM fs_estores
						WHERE  id = $eid ";
			global $db;
			$db -> query($query);
			return $rs = $db->getResult();	
		}
		
		/*
		 * Save data from eshopcart form
		 * Data: sim_number of member
		 */
		function eshopcart_save() {
			
			// check exist:
			$order_temporary = $this -> getOrder();
			
			$username = FSInput::get('member_number');
			$session_id = session_id();
			if(!$username  )
				return false;
				
			$time = date("Y-m-d H:i:s");	
			
			// insert if not exist
			if(!$order_temporary) {
				$sql = " INSERT INTO 
						".$this -> table_order." (`username`,is_temporary,session_id
									,created_time,edited_time,is_activated)
						VALUES ('$username','1','$session_id',
									'$time','$time','0');
						";
				global $db;
				$db->query($sql);
				$id = $db->insert();
				return $id;
				
			} 
			// update if exist
			else { 
					
			 	$sql = " UPDATE  ".$this -> table_order." SET 
			 				`username` = '$username',
							edited_time = '$time'
						WHERE  session_id = '$session_id' 
							AND is_temporary = 1 
					";	
				global $db;
				$db->query($sql);
				$rows = $db->affected_rows();
				return $rows;		
			}
		}
		/*
		 * Display fulname from sim_number
		 */
		function get_member_by_username($username){
			if(!$username)
				return;
			$query = " SELECT fname,lname,mname
						FROM fs_members 
						WHERE  username = '$username' ";
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
		
		function get_user_id(){
			$username = isset($_COOKIE['username'])?$_COOKIE['username']:'';
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
		 * For ajax
		 * Display fulname from sim_number
		 */
		function ajax_get_member(){
			$sim_number = FSInput::get('sim_number');
				if(!$sim_number)
				return;
			$query = " SELECT fname,lname,mname
						FROM fs_members 
						WHERE  sim_number = '$sim_number' ";
			global $db;
			$db -> query($query);
			return $rs = $db->getObject();
		}

		
		/* 
		 * update into fs_order
		 * change payment_method
		 */
		function shipping_save() {
			$eid = FSInput::get('eid',0,'int');
			$payment_method = FSInput::get('payment',0,'int');
			$transfer_method = FSInput::get('transfer_method');
//			if(!$eid || !$payment_method || !$transfer_method)
			if(!$eid  )
				return false;
			$session_id = session_id();
			$time = date("Y-m-d H:i:s");
			
			// if buy by adress: status = 0
			// if buy direct : status = 4: finished
			$status = $payment_method? 0: 4;
			 $sql = " UPDATE  ".$this -> table_order." SET 
							payment_method = '$payment_method',
							edited_time = '$time',
							status = $status
						WHERE  session_id = '$session_id' 
							AND estore_id = $eid
							AND is_temporary = 1 
							
					";	
			global $db;
			$db->query($sql);
			$rows = $db->affected_rows();
			return 1;		
		}
		
		/* 
		 * finished paymenent
		 */
		function order_save() {
			$session_id = session_id();
			$time = date("Y-m-d H:i:s");
			global $db;
			
			// get order_id to return
			$query = " SELECT * 
						FROM ".$this -> table_order."
						WHERE  session_id = '$session_id' 
							AND is_temporary = 1 
					";	
			$db -> query($query);
			$order = $db -> getObject();
			$order_id = $order -> id;
			if(!$order_id)
				return false;
			$fsstring = FSFactory::getClass('FSString');
			$random_string = $fsstring -> generateRandomString(8);
			$code_order = $random_string;
			
			$sql_u = '';
			if(!$order -> payment_method){
				$sql_u .= ", total_after_discount =  '".$order -> total_after_discount."'";
			} else {
			}
			 $sql = " UPDATE  ".$this -> table_order." SET 
							is_temporary = '0',
							code_order = '$code_order',
							edited_time = '$time'".$sql_u."
						WHERE  id = $order_id 
					";	
			$db->query($sql);
			$rows = $db->affected_rows();
			if($rows) {
				unset($_SESSION['cart']);
			}
			return $rows? $order_id :0 ;		
		}
		
	/*
		 * Check pr
		 */
		function check_enough_money($money_pr,$username){
			// check money	
			if(!$username)
				return false;
			$query = " SELECT count(*)
					FROM fs_members
					WHERE username = '$username'
					ANd money >= $money_pr ";
			global $db;
			$db->query($query);
			$result = $db->getResult();
			if(!$result){
				FSFactory::include_class('errors');
				Errors:: setError("Tài khoản của bạn không đủ để thực hiện giao dịch này. Bạn có thể nạp tiền để thanh toán sau.");
				return false;
			}
			return true;	
		}
		
		function subtraction_money($money_pr,$username){
			// minus money
			global $db;
			if(!$username)
				return false;
			$sql = "UPDATE fs_members SET `money` = money - ".$money_pr." WHERE username = '".$username."' ";
			$db->query($sql);
			$rows = $db->affected_rows();
			if(!$rows)
				return false;
		}
		
		function save_into_history($money_pr,$username){
			if(!$username)
				return false;
			$time = date("Y-m-d H:i:s");
			$row3['money'] = $money_pr;
			$row3['type'] = 'buy';
			$row3['username'] = $username;
			$row3['created_time'] = $time;
			$row3['description'] = 'Đặt hàng';
			$row3['service_name'] = 'Đặt hàng';
			if(!$this -> _add($row3, 'fs_history'))
				return false;
		}
		
		/*
		 * Gửi mail cho khách ngay sau khi đặt hàng
		 */
		function mail_to_buyer($id,$fast = 0){
			if(!$id)
				return;
			global $db;
			
			//config
			global $config;
	        $site_name = isset($config['site_name'])?$config['site_name']:'';
	         
			// get order
			$query = " SELECT * 
						FROM ".$this -> table_order."
						WHERE  id = '$id' 
							AND is_temporary = 0 
					";	
			$db -> query($query);
			$order = $db->getObject();
//			$estore = $this -> getEstore($order -> estore_id);
			$data = $this -> get_orderdetail_by_orderId($id);
			if(count($data)){
				$i = 0;
				$str_prd_ids = '';
				foreach($data as $item){
					if($i > 0)
						$str_prd_ids .= ',';
					$str_prd_ids .= $item -> product_id;
					$i ++;
				}
				$arr_product = $this -> get_products_from_orderdetail($str_prd_ids);
				
			}
				
			if(!$order)
				return;
			
				// send Mail()
				$mailer = FSFactory::getClass('Email','mail');
				$global = new FsGlobal();
				$admin_name = $global -> getConfig('admin_name');
				$admin_email = $global -> getConfig('admin_email');
				$mail_order_body = $global -> getConfig('mail_order_body');
				$mail_order_subject = $global -> getConfig('mail_order_subject');
				
				$mailer -> isHTML(true);
				$mailer -> setSender(array($admin_email,$admin_name));
				$mailer -> AddBCC('robocon20062007@gmail.com','pham van huy');
//				$mailer -> AddAddress($order->recipients_email,$order->recipients_name);
				if(!$fast){
					$mailer -> AddAddress($order->sender_email,$order->sender_name);	
				}
				
				$mailer -> AddAddress($admin_email,$admin_name);
				$mailer -> setSubject($mail_order_subject); 
				
//				$mailer -> setSender(array($sender_email,$sender_name));
//				$mailer -> AddAddress($to,'admin');
//				$mailer -> AddCC('phamhuy@finalstyle.com','pham van huy');

				$buyer_name = $order-> sender_name?$order-> sender_name:'Quý khách';
				
				// body
				$body = $mail_order_body;
				$body = str_replace('{name}', $buyer_name, $body);
				$body = str_replace('{ma_don_hang}', 'DH'.str_pad($order -> id, 8 , "0", STR_PAD_LEFT), $body);
				
				// SENDER
				$sender_info = '<table cellspacing="0" cellpadding="6" border="0" width="100%" class="tabl-info-customer">';
				$sender_info .= '	<tbody>'; 
			  	$sender_info .= ' <tr>';
				$sender_info .= '<td width="173px">Tên người đặt hàng </td>';
				$sender_info .= '<td width="5px">:</td>';
				$sender_info .= '<td>'.$buyer_name.'</td>';
			  	$sender_info .= '</tr>';
			  	$sender_info .= '<tr>';
				$sender_info .= '<td>Giới tính</td>';
				$sender_info .= '<td width="5px">:</td>';
				$sender_info .= '<td>';
				if(trim($order->sender_sex) == 'female')
					$sender_info .= "N&#7919;";
				else 
					$sender_info .= "Nam";
				$sender_info .= '</td>';
				$sender_info .= '</tr>';
				$sender_info .= '<tr>';
				$sender_info .= '<td>Địa chỉ  </td>';
				$sender_info .= '<td width="5px">:</td>';
				$sender_info .= '<td>'.$order-> sender_address.'</td>';
			  	$sender_info .= '</tr>';
			  	$sender_info .= '<tr>';
				$sender_info .= '<td>Email </td>';
				$sender_info .= '<td width="5px">:</td>';
				$sender_info .= '<td>'.$order-> sender_email.'</td>';
			  	$sender_info .= '</tr>';
			 	$sender_info .= '<tr>';
				$sender_info .= '<td>Điện thoại </td>';
				$sender_info .= '<td width="5px">:</td>';
				$sender_info .= '<td>'. $order-> sender_telephone;
				$sender_info .= '<strong style="color:red"> (Gọi lại ngay)</strong>';
				$sender_info .= '</td>';
			  	$sender_info .= '</tr>';
				$sender_info .= ' </tbody>';
				$sender_info .= '</table>';
//				$sender_info .= 			'</td>';
				// end SENDER
				
				// RECIPIENT
				$recipient_info = '<table cellspacing="0" cellpadding="6" border="0" width="100%" class="tabl-info-customer">';
				$recipient_info .= '	<tbody> ';
			  	$recipient_info .= '<tr>';
				$recipient_info .= '<td width="173px">Tên người nhận hàng</td>';
				$recipient_info .= '<td width="5px">:</td>';
				$recipient_info .= '<td>'.$order-> recipients_name.'</td>';
			 	$recipient_info .= '</tr>';
			  	$recipient_info .= '<tr>';
				$recipient_info .= '<td>Giới tính </td>';
				$recipient_info .= '<td width="5px">:</td>';
				$recipient_info .= '<td>';
				if(trim($order->recipients_sex) == 'female')
					$recipient_info .= "N&#7919;";
				else 
					$recipient_info .= "Nam";
				$recipient_info .= 	'</td>';
			 	$recipient_info .= ' </tr>';
			 	$recipient_info .= ' <tr>';
				$recipient_info .= '<td>Địa chỉ  </td>';
				$recipient_info .= '<td width="5px">:</td>';
				$recipient_info .= '<td>'.$order-> recipients_address .'</td>';
			 	$recipient_info .= '</tr>';
				$recipient_info .= ' <tr>';
				$recipient_info .= '<td>Email </td>';
				$recipient_info .= '<td width="5px">:</td>';
				$recipient_info .= '<td>'.$order-> recipients_email .'</td>';
				$recipient_info .= '</tr>';
			  	$recipient_info .= '<tr>';
				$recipient_info .= '<td>Điện thoại </td>';
				$recipient_info .= '<td width="5px">:</td>';
				$recipient_info .= '<td>'.$order-> recipients_telephone .'</td>';
			  	$recipient_info .= '</tr>';
			  	$recipient_info .= '<tr>';
			  	
				$recipient_info .= '<td>Thời gian đặt hàng</td>';
				$recipient_info .= '<td width="5px">:</td>';
				$recipient_info .= '<td>';
					$hour = date('H',strtotime($order-> received_time));
					if($hour)
						$recipient_info .= $hour." h, ";
					$recipient_info .=  "ng&#224;y ". date('d/m/Y',strtotime($order-> received_time));
				$recipient_info .= '</td>';
			  	$recipient_info .= '</tr>';
			  	
			  	$recipient_info .= '<td>Địa điểm nhân hàng </b></td>';
				$recipient_info .= '<td width="5px">:</td>';
				$recipient_info .= '<td>';
				$recipient_info .=  $order->recipients_here ? 'Đặt lấy tại nhà hàng':'Nhận tại địa chỉ người nhận';
				$recipient_info .= '</td>';
			  	$recipient_info .= '</tr>';
			  	
			 	$recipient_info .= '</tbody>';
				$recipient_info .= '</table>';
				// end RECIPIENT
				
				
//				$body .= '<br/>';
//				$body .= '<div style="background: none repeat scroll 0 0 #55AEE7;color: #FFFFFF;font-weight: bold;height: 27px;padding-left: 10px;line-height: 25px; margin: 2px;">Chi tiết đơn hàng</div>';
//				$body .= '<div style="padding: 10px">';
				// detail
				$order_detail = '	<table width="964" cellspacing="0" cellpadding="6" bordercolor="#CCC" border="1" align="center" style="border-style:solid;border-collapse:collapse;margin-top:2px">';
				$order_detail .= '		<thead style=" background: #E7E7E7;line-height: 12px;">';
				$order_detail .= '			<tr>';
				$order_detail .= '				<th width="30">STT</th>';
				$order_detail .= '				<th>T&#234;n s&#7843;n ph&#7849;m</th>';
				$order_detail .= '				<th width="117" >Giá</th>';
				$order_detail .= '				<th width="117">S&#7889; l&#432;&#7907;ng</th>';
				$order_detail .= '				<th width="117">T&#7893;ng gi&#225; ti&#7873;n</th>';
				$order_detail .= '			</tr>';
				$order_detail .= '		</thead>';
				$order_detail .= '		<tbody>';
				
//				$total_money = 0;
				$total_discount = 0;
				for($i = 0 ; $i < count($data); $i ++ ){
					$item = $data[$i];
//					$link_view_product = FSRoute::_('index?module=products&view=product&ename='.@$estore->estore_url.'&id='.$item->product_id.'&code='.@$arr_product[$item->product_id] -> alias.'&Itemid=6');
					$link_view_product = FSRoute::_('index.php?module=products&view=product&code='.@$arr_product[$item->product_id] -> alias.'&id='.$item->product_id.'&ccode='.@$arr_product[$item->product_id] ->category_alias.'&cid='.@$arr_product[$item->product_id] ->category_id.'&Itemid=5');
//					$total_money += $item -> total;
//					$total_discount += $item -> discount * $item -> count;

					$order_detail .= '				<tr>';
					$order_detail .= '					<td align="center">';
					$order_detail .= '						<strong>'.($i+1).'</strong><br/>';
					$order_detail .= '					</td>';
					$order_detail .= '					<td> ';
					$order_detail .= '						<a href="'.$link_view_product.'">';
					$order_detail .= 							@$arr_product[$item -> product_id] -> name;
					$order_detail .= '						</a> ';
					$order_detail .= '					</td>';
										
										//		PRICE 	
					$order_detail .= '					<td> ';
					$order_detail .= '						<strong>';
					$order_detail .= 							format_money($item -> price);
					$order_detail .= '						</strong> ';
					$order_detail .= '					</td>';
					$order_detail .= '					<td> ';
					$order_detail .= '						<strong>';
					$order_detail .= 							$item -> count?$item -> count:0;
					$order_detail .= '						</strong>';
					$order_detail .= '					</td>';
					$order_detail .= '					<td> ';
					$order_detail .= '						<span >';
					$order_detail .= 							format_money($item -> total);
					$order_detail .= '						</span> ';
					$order_detail .= '					</td>';
					$order_detail .= '				</tr>';
				}
				$order_detail .= '				<tr>';
				$order_detail .= '					<td colspan="4"  align="right"><strong>Tổng:</strong></td>';
				$order_detail .= '					<td ><strong >'.format_money($order -> total_before_discount).'</strong> </td>';
				$order_detail .= '				</tr>';
//				if($order -> payment_method){
//					$order_detail .= '				<tr>';
//					$order_detail .= '					<td colspan="4"  align="right"><strong>Giảm giá (khi mua qua address):</strong></td>';
//					$order_detail .= '					<td ><strong >'.format_money($order -> total_before_discount - $order -> total_after_discount).'</strong> d>';
//					$order_detail .= '				</tr>';
//					$order_detail .= '				<tr>';
//					$order_detail .= '					<td colspan="4"  align="right"><strong>Thành tiền:</strong></td>';
//					$order_detail .= '					<td ><strong >'.format_money($order -> total_after_discount).'</strong> </td>';
//					$order_detail .= '				</tr>';
//				}
				if(isset($order-> discount_money) && $order-> discount_money){
					$order_detail .= '				<tr>';
					$order_detail .= '					<td colspan="4"  align="right"><strong>Giảm giá:</strong></td>';
					$order_detail .= '					<td ><strong >'.format_money($order -> discount_money).'</strong></td>';
					$order_detail .= '				</tr>';
					$order_detail .= '				<tr>';
					$order_detail .= '					<td colspan="4"  align="right"><strong>Phải thanh toán:</strong></td>';
					$order_detail .= '					<td ><strong >'.format_money($order -> total_after_discount).'</strong> </td>';
					$order_detail .= '				</tr>';
				}
				
				$order_detail .= '		</tbody>';
				$order_detail .= '	</table>	';
				
//				$body .= '	<br/><br/>	';
//				$body .= '<div style="padding: 10px;font-weight: bold;margin-bottom: 30px;">';
//				$body .= '<div>Ch&acirc;n th&agrave;nh c&#7843;m &#417;n!</div>';
//				$body .=  '<div> '.$site_name.' (<a href="'.URL_ROOT.'" target="_blank">'.URL_ROOT.'</a>)</div>';
//				$body .= '	</div>	';
//				$body .= '</div>';
				$body = str_replace('{thong_tin_nguoi_dat}', $sender_info, $body);
//				$body = str_replace('{thong_tin_nguoi_nhan}', $recipient_info, $body);
				$body = str_replace('{thong_tin_don_hang}', $order_detail, $body);

//				print_r($mailer);
//				echo "=====<br/>======";
				// echo $body;
				// die;
				$mailer -> setBody($body);
				if(!$mailer ->Send())
					return false;
				return true;
		}
		/*
		 * Gửi mail cho khách ngay sau khi đơn hàng thanh toán thành công ( qua cổng thanh toán online)
		 */
		function mail_to_buyer_after_successful($id){
			if(!$id)
				return;
			global $db;
			
			//config
			global $config;
	        $site_name = isset($config['site_name'])?$config['site_name']:'';
	         
			// get order
			$query = " SELECT * 
						FROM ".$this -> table_order."
						WHERE  id = '$id' 
							AND is_temporary = 0 
					";	
			$db -> query($query);
			$order = $db->getObject();
//			$estore = $this -> getEstore($order -> estore_id);
			$data = $this -> get_orderdetail_by_orderId($id);
			if(count($data)){
				$i = 0;
				$str_prd_ids = '';
				foreach($data as $item){
					if($i > 0)
						$str_prd_ids .= ',';
					$str_prd_ids .= $item -> product_id;
					$i ++;
				}
				$arr_product = $this -> get_products_from_orderdetail($str_prd_ids);
				
			}
				
			if(!$order)
				return;
			
				// send Mail()
				$mailer = FSFactory::getClass('Email','mail');
				$global = new FsGlobal();
				$admin_name = $global -> getConfig('admin_name');
				$admin_email = $global -> getConfig('admin_email');
				$mail_order_body = $global -> getConfig('mail_order_successful_body');
				$mail_order_subject = $global -> getConfig('mail_order_successful_subject');
				
				$mailer -> isHTML(true);
				$mailer -> setSender(array($admin_email,$admin_name));
				$mailer -> AddBCC('phamhuy@finalstyle.com','pham van huy');
				$mailer -> AddAddress($order->recipients_email,$order->recipients_name);
				$mailer -> setSubject($mail_order_subject); 
				
				// body
				$body = $mail_order_body;
				$body = str_replace('{name}', $order-> sender_name, $body);
				$body = str_replace('{ma_don_hang}', 'DH'.str_pad($order -> id, 8 , "0", STR_PAD_LEFT), $body);
				

				// order common
//				$body .= '<div style="background: none repeat scroll 0 0 #55AEE7;color: #FFFFFF;font-weight: bold;height: 27px;padding-left: 10px;line-height: 25px; margin: 2px;">
//				Thông tin về đơn đặt hàng của bạn	</div>';
//				$body .= 	'<div style="padding: 10px">';
//				$body .= 	'<div>Mã đơn hàng: <strong> DH'.str_pad($order -> id, 8 , "0", STR_PAD_LEFT).'</strong></div>';
////				$body .= 	'<div>Sau khi bạn nhận được hàng, hãy vào :<a href=\''.FSRoute::_('index.php?module=sale&view=finished&Itemid=78').'\'><strong>'. FSRoute::_('index.php?module=sale&view=finished&Itemid=78').'</strong></a> để xác nhận hoàn tất việc mua hàng</div>';
//				$body .= '</div>';
//				$body .= '<br/>';
				
				// table
//				$body .= '<table width="100%" border="2" bordercolor="#ffffff" style="border-collapse: collapse;border-style:solid;border-color: #FFFFFF;">';
//				$body .= 	'<thead style="background: none repeat scroll 0 0 #55AEE7;color: #FFFFFF;font-weight: bold;height: 25px;padding-left: 10px;">';
//				$body .= 		'<tr>';
//				$body .= 			'<td >';
//				$body .= 				'<strong style="padding-left: 10px;">Thông tin người đặt hàng </strong>';
//				$body .= 			'</td>';
//				$body .= 			'<td >';
//				$body .= 				'<strong style="padding-left: 10px;">Thông tin người nhận hàng </strong>';
//				$body .= 			'</td>';
//				
//				$body .= 		'</tr>';
//				$body .= 	'</thead>';
//				
//				$body .= 	'<tbody>';
//				$body .= 		'<tr>';
				
				
				// SENDER
				$sender_info .= '<table cellspacing="0" cellpadding="6" border="0" width="100%" class="tabl-info-customer">';
				$sender_info .= '	<tbody>'; 
			  	$sender_info .= ' <tr>';
				$sender_info .= '<td width="173px">Tên người đặt hàng </td>';
				$sender_info .= '<td width="5px">:</td>';
				$sender_info .= '<td>'.$order-> sender_name.'</td>';
			  	$sender_info .= '</tr>';
			  	$sender_info .= '<tr>';
				$sender_info .= '<td>Giới tính</td>';
				$sender_info .= '<td width="5px">:</td>';
				$sender_info .= '<td>';
				if(trim($order->sender_sex) == 'female')
					$sender_info .= "N&#7919;";
				else 
					$sender_info .= "Nam";
				$sender_info .= '</td>';
				$sender_info .= '</tr>';
				$sender_info .= '<tr>';
				$sender_info .= '<td>Địa chỉ  </td>';
				$sender_info .= '<td width="5px">:</td>';
				$sender_info .= '<td>'.$order-> sender_address.'</td>';
			  	$sender_info .= '</tr>';
			  	$sender_info .= '<tr>';
				$sender_info .= '<td>Email </td>';
				$sender_info .= '<td width="5px">:</td>';
				$sender_info .= '<td>'.$order-> sender_email.'</td>';
			  	$sender_info .= '</tr>';
			 	$sender_info .= '<tr>';
				$sender_info .= '<td>Điện thoại </td>';
				$sender_info .= '<td width="5px">:</td>';
				$sender_info .= '<td>'. $order-> sender_telephone .'</td>';
			  	$sender_info .= '</tr>';
				$sender_info .= ' </tbody>';
				$sender_info .= '</table>';
//				$sender_info .= 			'</td>';
				// end SENDER
				
				// RECIPIENT
				$recipient_info = '<table cellspacing="0" cellpadding="6" border="0" width="100%" class="tabl-info-customer">';
				$recipient_info .= '	<tbody> ';
			  	$recipient_info .= '<tr>';
				$recipient_info .= '<td width="173px">Tên người nhận hàng</td>';
				$recipient_info .= '<td width="5px">:</td>';
				$recipient_info .= '<td>'.$order-> recipients_name.'</td>';
			 	$recipient_info .= '</tr>';
			  	$recipient_info .= '<tr>';
				$recipient_info .= '<td>Giới tính </td>';
				$recipient_info .= '<td width="5px">:</td>';
				$recipient_info .= '<td>';
				if(trim($order->recipients_sex) == 'female')
					$recipient_info .= "N&#7919;";
				else 
					$recipient_info .= "Nam";
				$recipient_info .= 	'</td>';
			 	$recipient_info .= ' </tr>';
			 	$recipient_info .= ' <tr>';
				$recipient_info .= '<td>Địa chỉ  </td>';
				$recipient_info .= '<td width="5px">:</td>';
				$recipient_info .= '<td>'.$order-> recipients_address .'</td>';
			 	$recipient_info .= '</tr>';
				$recipient_info .= ' <tr>';
				$recipient_info .= '<td>Email </td>';
				$recipient_info .= '<td width="5px">:</td>';
				$recipient_info .= '<td>'.$order-> recipients_email .'</td>';
				$recipient_info .= '</tr>';
			  	$recipient_info .= '<tr>';
				$recipient_info .= '<td>Điện thoại </td>';
				$recipient_info .= '<td width="5px">:</td>';
				$recipient_info .= '<td>'.$order-> recipients_telephone .'</td>';
			  	$recipient_info .= '</tr>';
			  	$recipient_info .= '<tr>';
			  	
				$recipient_info .= '<td>Thời gian đặt hàng</td>';
				$recipient_info .= '<td width="5px">:</td>';
				$recipient_info .= '<td>';
					$hour = date('H',strtotime($order-> received_time));
					if($hour)
						$recipient_info .= $hour." h, ";
					$recipient_info .=  "ng&#224;y ". date('d/m/Y',strtotime($order-> received_time));
				$recipient_info .= '</td>';
			  	$recipient_info .= '</tr>';
			  	
			  	$recipient_info .= '<td>Địa điểm nhân hàng </b></td>';
				$recipient_info .= '<td width="5px">:</td>';
				$recipient_info .= '<td>';
				$recipient_info .=  $order->recipients_here ? 'Đặt lấy tại nhà hàng':'Nhận tại địa chỉ người nhận';
				$recipient_info .= '</td>';
			  	$recipient_info .= '</tr>';
			  	
			 	$recipient_info .= '</tbody>';
				$recipient_info .= '</table>';
				// end RECIPIENT
				
				
//				$body .= '<br/>';
//				$body .= '<div style="background: none repeat scroll 0 0 #55AEE7;color: #FFFFFF;font-weight: bold;height: 27px;padding-left: 10px;line-height: 25px; margin: 2px;">Chi tiết đơn hàng</div>';
//				$body .= '<div style="padding: 10px">';
				// detail
				$order_detail = '	<table width="964" cellspacing="0" cellpadding="6" bordercolor="#CCC" border="1" align="center" style="border-style:solid;border-collapse:collapse;margin-top:2px">';
				$order_detail .= '		<thead style=" background: #E7E7E7;line-height: 12px;">';
				$order_detail .= '			<tr>';
				$order_detail .= '				<th width="30">STT</th>';
				$order_detail .= '				<th>T&#234;n s&#7843;n ph&#7849;m</th>';
				$order_detail .= '				<th width="117" >Giá</th>';
				$order_detail .= '				<th width="117">S&#7889; l&#432;&#7907;ng</th>';
				$order_detail .= '				<th width="117">T&#7893;ng gi&#225; ti&#7873;n</th>';
				$order_detail .= '			</tr>';
				$order_detail .= '		</thead>';
				$order_detail .= '		<tbody>';
				
//				$total_money = 0;
				$total_discount = 0;
				for($i = 0 ; $i < count($data); $i ++ ){
					$item = $data[$i];
//					$link_view_product = FSRoute::_('index?module=products&view=product&ename='.@$estore->estore_url.'&id='.$item->product_id.'&code='.@$arr_product[$item->product_id] -> alias.'&Itemid=6');
					$link_view_product = FSRoute::_('index.php?module=products&view=product&code='.@$arr_product[$item->product_id] -> alias.'&id='.$item->product_id.'&ccode='.@$arr_product[$item->product_id] ->category_alias.'&Itemid=5');
//					$total_money += $item -> total;
//					$total_discount += $item -> discount * $item -> count;

					$order_detail .= '				<tr>';
					$order_detail .= '					<td align="center">';
					$order_detail .= '						<strong>'.($i+1).'</strong><br/>';
					$order_detail .= '					</td>';
					$order_detail .= '					<td> ';
					$order_detail .= '						<a href="'.$link_view_product.'">';
					$order_detail .= 							@$arr_product[$item -> product_id] -> name;
					$order_detail .= '						</a> ';
					$order_detail .= '					</td>';
										
										//		PRICE 	
					$order_detail .= '					<td> ';
					$order_detail .= '						<strong>';
					$order_detail .= 							format_money($item -> price);
					$order_detail .= '						</strong> ';
					$order_detail .= '					</td>';
					$order_detail .= '					<td> ';
					$order_detail .= '						<strong>';
					$order_detail .= 							$item -> count?$item -> count:0;
					$order_detail .= '						</strong>';
					$order_detail .= '					</td>';
					$order_detail .= '					<td> ';
					$order_detail .= '						<span >';
					$order_detail .= 							format_money($item -> total);
					$order_detail .= '						</span> ';
					$order_detail .= '					</td>';
					$order_detail .= '				</tr>';
				}
				$order_detail .= '				<tr>';
				$order_detail .= '					<td colspan="4"  align="right"><strong>Tổng:</strong></td>';
				$order_detail .= '					<td ><strong >'.format_money($order -> total_before_discount).'</strong> </td>';
				$order_detail .= '				</tr>';
				if($order -> payment_method){
					$order_detail .= '				<tr>';
					$order_detail .= '					<td colspan="4"  align="right"><strong>Giảm giá (khi mua qua address):</strong></td>';
					$order_detail .= '					<td ><strong >'.format_money($order -> total_before_discount - $order -> total_after_discount).'</strong> </td>';
					$order_detail .= '				</tr>';
					$order_detail .= '				<tr>';
					$order_detail .= '					<td colspan="4"  align="right"><strong>Thành tiền:</strong></td>';
					$order_detail .= '					<td ><strong >'.format_money($order -> total_after_discount).'</strong> </td>';
					$order_detail .= '				</tr>';
				}
				$order_detail .= '		</tbody>';
				$order_detail .= '	</table>	';
				
//				$body .= '	<br/><br/>	';
//				$body .= '<div style="padding: 10px;font-weight: bold;margin-bottom: 30px;">';
//				$body .= '<div>Ch&acirc;n th&agrave;nh c&#7843;m &#417;n!</div>';
//				$body .=  '<div> '.$site_name.' (<a href="'.URL_ROOT.'" target="_blank">'.URL_ROOT.'</a>)</div>';
//				$body .= '	</div>	';
//				$body .= '</div>';
				$body = str_replace('{thong_tin_nguoi_dat}', $sender_info, $body);
				$body = str_replace('{thong_tin_nguoi_nhan}', $recipient_info, $body);
				$body = str_replace('{thong_tin_don_hang}', $order_detail, $body);
				
				$mailer -> setBody($body);
				if(!$mailer ->Send())
					return false;
				return true;
		}
		
		function get_incenty_accessory($product_id){
			$accessory_ids = FSInput::get('add');
			if(!$accessory_ids || !$product_id)
				return;
			$query = " SELECT * FROM fs_products_incentives
						WHERE product_id =  ".$product_id."
						AND product_incenty_id IN (".$accessory_ids.") ";
			global $db;
			$db -> query($query);
			return $rs = $db->getObjectList();
		}
	}
?>
