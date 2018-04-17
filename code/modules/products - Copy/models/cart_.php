<?php 
	class ProductsModelsCart extends FSModels{
		var $limit;
		var $page;
		function __construct()
		{
			parent:: __construct();
			$limit = 30;
			$this->limit = $limit;
		}
		
		/*
		 * if currency = 'VND' return
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
						FROM fs_order
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
						FROM fs_order
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
						FROM fs_order_items AS a
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
		function eshopcart2_save() {
				 return $this -> eshopcart2_save_new();
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
			$sql = " DELETE FROM fs_order_items
					WHERE order_id = '$order_id'"  ;
			
			//$db->query($sql);
			$rows = $db->affected_rows($sql);	
			
			
			// insert data
			$prd_id_array = array();
			// Repeat estores
			if(!isset($_SESSION['cart']))
				return false;
				
			$product_list  = $_SESSION['cart'];
			$sql = " INSERT INTO fs_order_items (order_id,product_id,price,count,total,color_id,color_name,color_price,memory_id,memory_name,memory_price,warranty_id,warranty_name,warranty_price,origin_id,origin_name,origin_price,species_id,species_name,species_price,usage_states_id,usage_states_name,usage_states_price)
					VALUES "; 
					
			$array_insert = array();
			
			// Repeat products
			for($i = 0; $i < count($product_list); $i ++) {
				
				$prd = $product_list[$i];
				$total_money = $prd[1];
				
				   // calculator color
			 	$color = $this -> get_record_by_id($prd[3],'fs_products_price');
				$total_money = $total_money + $color->price;
			   
			   // calculator status
			    $memory = $this -> get_record_by_id($prd[4],'fs_memory_price');
				$total_money = $total_money + $memory->price;


				 // calculator status
				$warranty = $this -> get_record_by_id($prd[5],'fs_warranty_price');
				$total_money = $total_money + $warranty->price;
				
				$origin = $this -> get_record_by_id($prd[6],'fs_origin_price');
				$total_money = $total_money + $origin->price;

				$species = $this -> get_record_by_id($prd[7],'fs_species_price');
				$total_money = $total_money + $species->price;

				  $usage_states = $this -> get_record_by_id($prd[8],'fs_usage_states_price');
				$total_money = $total_money + $usage_states->price;


				$total_money = $total_money * $prd[2];
				
				$array_insert[] = "('$order_id','$prd[0]','$prd[1]','$prd[2]','$total_money','$prd[3]','$color->color_name','$color->price','$prd[4]','$memory->memory_name','$memory->price','$prd[5]','$warranty->warranty_name','$warranty->price','$prd[6]','$origin->origin_name','$origin->price','$prd[7]','$species->species_name','$species->price','$prd[8]','$usage_states->usage_states_name','$usage_states->price') ";
			}
			if(count($array_insert)) {
				$sql_insert = implode(',',$array_insert);
			$sql .= $sql_insert;
				//$db->query($sql);
				$rows = $db->affected_rows($sql);
				return true;				
			} else {
				return;
			}
				
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
			global $config;
			for($i = 0; $i < count($product_list); $i ++) {
				
				$prd = $product_list[$i];
			 	$prd_id_array[] = $prd[0];
			 	$total_before_discount += $prd[1]; 
			 	
			 	// $total_before_discount += $prd[1]*$prd[2]; 

			   // calculator color
			 	$color = $this -> get_record_by_id($prd[3],'fs_products_price');
				$total_before_discount = $total_before_discount + $color->price;
			   
			   // calculator memory
			    $memory = $this -> get_record_by_id($prd[4],'fs_memory_price');
				$total_before_discount = $total_before_discount + $memory->price;


				// calculator memory
			    $warranty = $this -> get_record_by_id($prd[5],'fs_warranty_price');
				$total_before_discount = $total_before_discount + $warranty->price;

				// calculator memory
			    $origin = $this -> get_record_by_id($prd[6],'fs_origin_price');
				$total_before_discount = $total_before_discount + $origin->price;

				// calculator memory
			    $species = $this -> get_record_by_id($prd[7],'fs_species_price');
				$total_before_discount = $total_before_discount + $species->price;

				 $usage_states = $this -> get_record_by_id($prd[8],'fs_usage_states_price');
				$total_before_discount = $total_before_discount + $memory->price;

				 $total_before_discount = $total_before_discount*$prd[2]; 
				
				 // calculator warranty
				
			 	$products_count += $prd[2]; 
			}
			$total_after_discount = $total_before_discount;
			$prd_id_str = implode(',',$prd_id_array);
			$session_id = session_id();
			
			$row = array();
			
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
			
			$id =$this -> _add($row, 'fs_order');
		
			// update
			$this -> save_order_items($id);
			if($id) {
				unset($_SESSION['cart']);
			}
			return $id;
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
						fs_order (`username`,is_temporary,session_id
									,created_time,edited_time,is_activated)
						VALUES ('$username','1','$session_id',
									'$time','$time','0');
						";
				global $db;
//				$db->query($sql);
				$id = $db->insert($sql);
				return $id;
				
			} 
			// update if exist
			else { 
					
			 	$sql = " UPDATE  fs_order SET 
			 				`username` = '$username',
							edited_time = '$time'
						WHERE  session_id = '$session_id' 
							AND is_temporary = 1 
					";	
				global $db;
				//$db->query($sql);
				$rows = $db->affected_rows($sql);
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
			if(!isset($_SESSION['username']))
				return false;
			$username = $_SESSION['username'];
				if(!$username)
				return;
			$query = " SELECT *
						FROM fs_members 
						WHERE  username = '$username' ";
			global $db;
			$db -> query($query);
			return $rs = $db->getObject();
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
			 $sql = " UPDATE  fs_order SET 
							payment_method = '$payment_method',
							edited_time = '$time',
							status = $status
						WHERE  session_id = '$session_id' 
							AND estore_id = $eid
							AND is_temporary = 1 
							
					";	
			global $db;
			// $db->query($sql);
			$rows = $db->affected_rows($sql);
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
						FROM fs_order
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
			 $sql = " UPDATE  fs_order SET 
							is_temporary = '0',
							code_order = '$code_order',
							edited_time = '$time'".$sql_u."
						WHERE  id = $order_id 
					";	
			// $db->query($sql);
			$rows = $db->affected_rows($sql);
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
			// $db->query($sql);
			$rows = $db->affected_rows($sql);
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
		function mail_to_buyer($id){
			if(!$id)
				return;
			global $db;
			
			//config
			global $config;
	        $site_name = isset($config['site_name'])?$config['site_name']:'';
	         
			// get order
			$query = " SELECT * 
						FROM fs_order
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
				$mailer -> AddBCC('phamhuy@finalstyle.com','pham van huy');
				$mailer -> AddAddress($order->recipients_email,$order->recipients_name);
				$mailer -> setSubject($mail_order_subject); 
				
				// body
				$body = $mail_order_body;
				$body = str_replace('{name}', $order-> sender_name, $body);
				$body = str_replace('{ma_don_hang}', 'DH'.str_pad($order -> id, 8 , "0", STR_PAD_LEFT), $body);
				
				// SENDER
				$sender_info = '<table cellspacing="0" cellpadding="6" border="0" width="100%" class="tabl-info-customer">';
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
					$link_view_product = FSRoute::_('index.php?module=products&view=product&pcode='.@$arr_product[$item->product_id] -> alias.'&id='.$item->product_id.'&ccode='.@$arr_product[$item->product_id] ->category_alias.'&Itemid=5');
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
					$order_detail .= '						</strong> VND';
					$order_detail .= '					</td>';
					$order_detail .= '					<td> ';
					$order_detail .= '						<strong>';
					$order_detail .= 							$item -> count?$item -> count:0;
					$order_detail .= '						</strong>';
					$order_detail .= '					</td>';
					$order_detail .= '					<td> ';
					$order_detail .= '						<span >';
					$order_detail .= 							format_money($item -> total);
					$order_detail .= '						</span> VND';
					$order_detail .= '					</td>';
					$order_detail .= '				</tr>';
				}
				$order_detail .= '				<tr>';
				$order_detail .= '					<td colspan="4"  align="right"><strong>Tổng:</strong></td>';
				$order_detail .= '					<td ><strong >'.format_money($order -> total_before_discount).'</strong> VND</td>';
				$order_detail .= '				</tr>';
//				if($order -> payment_method){
//					$order_detail .= '				<tr>';
//					$order_detail .= '					<td colspan="4"  align="right"><strong>Giảm giá (khi mua qua address):</strong></td>';
//					$order_detail .= '					<td ><strong >'.format_money($order -> total_before_discount - $order -> total_after_discount).'</strong> VND</td>';
//					$order_detail .= '				</tr>';
//					$order_detail .= '				<tr>';
//					$order_detail .= '					<td colspan="4"  align="right"><strong>Thành tiền:</strong></td>';
//					$order_detail .= '					<td ><strong >'.format_money($order -> total_after_discount).'</strong> VND</td>';
//					$order_detail .= '				</tr>';
//				}
				if(isset($order-> discount_money) && $order-> discount_money){
					$order_detail .= '				<tr>';
					$order_detail .= '					<td colspan="4"  align="right"><strong>Giảm giá:</strong></td>';
					$order_detail .= '					<td ><strong >'.format_money($order -> discount_money).'</strong> VND</td>';
					$order_detail .= '				</tr>';
					$order_detail .= '				<tr>';
					$order_detail .= '					<td colspan="4"  align="right"><strong>Phải thanh toán:</strong></td>';
					$order_detail .= '					<td ><strong >'.format_money($order -> total_after_discount).'</strong> VND</td>';
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
						FROM fs_order
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
					$link_view_product = FSRoute::_('index.php?module=products&view=product&pcode='.@$arr_product[$item->product_id] -> alias.'&id='.$item->product_id.'&ccode='.@$arr_product[$item->product_id] ->category_alias.'&Itemid=5');
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
					$order_detail .= '						</strong> VND';
					$order_detail .= '					</td>';
					$order_detail .= '					<td> ';
					$order_detail .= '						<strong>';
					$order_detail .= 							$item -> count?$item -> count:0;
					$order_detail .= '						</strong>';
					$order_detail .= '					</td>';
					$order_detail .= '					<td> ';
					$order_detail .= '						<span >';
					$order_detail .= 							format_money($item -> total);
					$order_detail .= '						</span> VND';
					$order_detail .= '					</td>';
					$order_detail .= '				</tr>';
				}
				$order_detail .= '				<tr>';
				$order_detail .= '					<td colspan="4"  align="right"><strong>Tổng:</strong></td>';
				$order_detail .= '					<td ><strong >'.format_money($order -> total_before_discount).'</strong> VND</td>';
				$order_detail .= '				</tr>';
				if($order -> payment_method){
					$order_detail .= '				<tr>';
					$order_detail .= '					<td colspan="4"  align="right"><strong>Giảm giá (khi mua qua address):</strong></td>';
					$order_detail .= '					<td ><strong >'.format_money($order -> total_before_discount - $order -> total_after_discount).'</strong> VND</td>';
					$order_detail .= '				</tr>';
					$order_detail .= '				<tr>';
					$order_detail .= '					<td colspan="4"  align="right"><strong>Thành tiền:</strong></td>';
					$order_detail .= '					<td ><strong >'.format_money($order -> total_after_discount).'</strong> VND</td>';
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
