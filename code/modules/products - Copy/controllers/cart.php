<?php
/*
 * Huy write
 */
	// controller
	
	class ProductsControllersCart  extends FSControllers
	{
		var $module;
		var $view;
		
		
		/*
		 * This function for buy
		 * 1. Save session
		 * 2. Redirect to shopcart page.
		 */
	function ajax_buy(){
			$product_id = FSInput::get('id',0,'int'); // product_id
			$quantity = FSInput::get('quantity',1,'int'); // product_id
			if(!$product_id || !$quantity)
				return;
			FSFactory::include_class('errors');
			if(!$product_id)
				Errors::_(FSText::_('Sản phẩm chưa xác định'));
			
			$model = $this -> model;	
//			$link = FSRoute::_('index.php?module=products&view=cart&task=eshopcart2&Itemid='.$Itemid);
				
			if(!isset($_SESSION['cart'])) {
				$product_list = array();
				
				$prices = $model -> getPrice();
				if($prices == '-1'){
					Errors::_(FSText::_("Không tồn tại sản phẩm trong giỏ hàng"),'error');
					setRedirect($link);
					return;
				}
				$product_list[] = array($product_id, $quantity  ,$prices[0],$prices[1]); // prdid,quality, price, discount
				
			} else {
				$product_list  = $_SESSION['cart'];
				
				$exist_prd  = 0;
				for ($j = 0; $j < count($product_list); $j ++) {
					$prd = $product_list[$j];
							
					if($prd[0] == $product_id) {
						$product_list[$j][1] ++;
						$exist_prd ++;
						break;
					} 
				}
				// if not exist product
				if(!$exist_prd) {
					$prices = $model -> getPrice();
					$product_list[count($product_list)] = array($product_id,$quantity ,$prices[0],$prices[1]);
				}
			}
			
			$total_price = 0;
			$quantity = 0;
			$str_ids = '';
			if(isset($product_list) && $product_list) {
				$i = 0;
				foreach ($product_list as $prd) {
			  		$i++;
			  		$total_price +=  $prd[2]* $prd[1];
			  		$quantity +=  $prd[1];
			  		if($str_ids)
			  			$str_ids .= ',';
			  		$str_ids .= $prd[0];
				}
	  		}
			if($str_ids)
				$arr_products = $model -> get_products_by_ids($str_ids);
			
			$_SESSION['cart']  = $product_list  ;
			$html  = $this -> genarate_shopcart_popup($product_list,$arr_products);
			
			$result = array('total_price'=> format_money($total_price,''),'quantity'=>$quantity,'html'=>$html);
//			$arr_data=array();
//			$arr_data['id']= $data -> id;	
//			$arr_data['category_id']= $data -> category_id;	
//			$arr_data['image']= URL_ROOT.str_replace('/original/','/resized/', $data -> image); 	
//			$arr_data['name'] = $data -> name;	
//			$arr_data['brand']= $data -> category_name;	
//			$arr_data['color']= $color->color_name;	
//			$arr_data['size'] = $size->size_name;	
//			$arr_data['price']= format_money($price['price']);	
//			$arr_data['total']= format_money($price['price']);		
//			$arr_data['count']= $quantity;	

			echo json_encode($result);
//			echo count($product_list);	
			
			return ;
		}
		
		function genarate_shopcart_popup($product_list,$arr_products){
			$i = 0; 
			if(!$product_list) 
				return;
			$html = '';
			foreach ($product_list as $prd) {
			  		$i++;
			  		$product = isset($arr_products[$prd[0]])?$arr_products[$prd[0]]:null;
			  		if(!$product)
			  			continue;
			  		$link_detail =FSRoute::_('index.php?module=products&view=product&code='.$product->alias.'&ccode='.$product -> category_alias.'&id='.$product->id.'&cid='.$product->category_id.'&Itemid=6');
			  		
			 		$html.= '<div class="item">';
			 		$html.= '<a href="'.$link_detail.'" class="item-img">'; 
					if($product -> image){ 
                        $image_small = URL_ROOT.str_replace('/original/', '/resized/', $product->image);
                        	$html.= '<img width="130"  src="'.$image_small.'" alt="'.htmlspecialchars ($product -> name).'"  />';
                    } else {
                            $html.= '<img  width="130" src="'.URL_ROOT.'"images/no-img.gif" alt="'.htmlspecialchars ($product -> name).' />';
                    }	 
					$html.= '</a> ';
				 	$html.= '<div class="other_info">';
			 		$html.= '<a class="name" href="'.$link_detail.'" > '. $product -> name.' </a> 	';
			 		$html.= '<div class="price">'.FSText::_('Đơn giá').': <span>'.format_money($prd[2],'').'</span></div>';
			 		$html.= '<div class="quality">'.FSText::_('Số lượng').': <span>'.$prd[1].'</span></div>';
			 		$html.= '</div>';
			 		$html.= '<div class="clear"></div>';
			 		$html.= '</div>';
			}
			return $html;
		}
		
		/*
		 * This function for buy
		 * 1. Save session
		 * 2. Redirect to shopcart page.
		 */
		function buy(){
			$product_id = FSInput::get('id',0,'int'); // product_id
			FSFactory::include_class('errors');
			if(!$product_id)
				Errors::_(FSText::_('Sản phẩm chưa xác định'));
			
			$model = $this -> model;	
			$link = FSRoute::_('index.php?module=products&view=cart&task=eshopcart2&Itemid='.$Itemid);
				
			if(!isset($_SESSION['cart'])) {
				$product_list = array();
				
				$prices = $model -> getPrice();
				if($prices == '-1'){
					Errors::_(FSText::_("Không tồn tại sản phẩm trong giỏ hàng"),'error');
					setRedirect($link);
					return;
				}
				$product_list[] = array($product_id, 1 ,$prices[0],$prices[1]); // prdid,quality, price, discount
				
			} else {
				$product_list  = $_SESSION['cart'];
				
				$exist_prd  = 0;
				for ($j = 0; $j < count($product_list); $j ++) {
					$prd = $product_list[$j];
							
					if($prd[0] == $product_id) {
						$product_list[$j][1] ++;
						$exist_prd ++;
						break;
					} 
				}
				// if not exist product
				if(!$exist_prd) {
					$prices = $model -> getPrice();
					$product_list[count($product_list)] = array($product_id,1,$prices[0],$prices[1]);
				}
			}
			
			$_SESSION['cart']  = $product_list  ;
			setRedirect($link);
		}
		
		/*
		 * Same BUY function
		 * Addition: add buy incentives accessory
		 */
		function buy_multi(){
			$model = $this -> model;
			$product_id = FSInput::get('id',0,'int'); // product_id
			$buy_count = FSInput::get('buy_count',1,'int'); // product_id
			$Itemid = FSInput::get('Itemid',0,'int'); // product_id
			FSFactory::include_class('errors');
			if(!$product_id)
				Errors::_(FSText::_('Sản phẩm chưa xác định'));
			
			$model = $this -> model;	
			$link = FSRoute::_('index.php?module=products&view=cart&task=eshopcart2&Itemid='.$Itemid);
				
			if(!isset($_SESSION['cart'])) {
				$product_list = array();
				
				$prices = $model -> getPrice();
				if($prices == '-1'){
					Errors::_(FSText::_("Không tồn tại sản phẩm trong giỏ hàng"),'error');
					setRedirect($link);
					return;
				}
				$product_list[] = array($product_id, $buy_count ,$prices[0],$prices[1]); // prdid,quality, price, discount
				
			} else {
				$product_list  = $_SESSION['cart'];
				
				$exist_prd  = 0;
				for ($j = 0; $j < count($product_list); $j ++) {
					$prd = $product_list[$j];
							
					if($prd[0] == $product_id) {
						$product_list[$j][1] += $buy_count;
						$exist_prd ++;
						break;
					} 
				}
				// if not exist product
				if(!$exist_prd) {
					$prices = $model -> getPrice();
					$product_list[count($product_list)] = array($product_id,$buy_count,$prices[0],$prices[1],$dcare,$price_id,$location);
				}
			}
			$_SESSION['cart']  = $product_list  ;
			// add incenty assessory
			
			setRedirect($link);
		}
		
		function buy_incenty_accessory($product_id,$incentives_accessory){
			if(!count($incentives_accessory))
				return;
			$product_list  = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();	
			foreach($incentives_accessory as $item){
				$exist_prd  = 0;
				for ($j = 0; $j < count($product_list); $j ++) {
					$prd = $product_list[$j];
							
					if($prd[0] == $item -> product_incenty_id) {
						$product_list[$j][1] ++;
						$exist_prd ++;
						break;
					} 
				}
				// if not exist product
				if(!$exist_prd) {
					$product_list[count($product_list)] = array($item -> product_incenty_id,1,$item -> price_new,$item -> price_old);
				}
			}		
			$_SESSION['cart']  = $product_list  ;
			return;				
		}
		
		/*
		 * Display shopcart common
		 */
		function shopcart() {
			$note_in_cart = FsGlobal::getConfig('note_in_cart');
			include 'modules/'.$this->module.'/views/'.$this->view.'/shopcart.php';				
		}
		/*
		 * Remove shopcart in one estores
		 */
		function del_all() {
			$Itemid = FSInput::get('Itemid',0,'int');
			if(isset($_SESSION['cart'])) {
				unset($_SESSION['cart']);
			}
			$link = FSRoute::_('index.php?module=products&view=cart&task=eshopcart2&Itemid='.$Itemid);
			setRedirect($link);
		}
		/*
		 * Remove product in one estores
		 */
		function del() {
			$eid = FSInput::get('eid',0,'int');
			$pid = FSInput::get('id',0,'int');
			$Itemid = FSInput::get('Itemid',0,'int');
			if($eid && $pid) {
				if(isset($_SESSION['cart'])) {
					$cart  = $_SESSION['cart'];
					
					$cart_new = array();
					
					// Repeat estores
					for ($j = 0; $j < count($cart); $j ++) {
						 $item = $cart[$j];
						
						// if exist estores
						if($item[0] == $eid) {

							$products_new = array();
							$count_products = 0;
							
							$product_list = $item[1];
							
							// Repeat products
							for($i = 0; $i < count($product_list); $i ++) {
							 	$prd = $product_list[$i];
							 	if($pid != $prd[0]) {
							 		$products_new[] = $prd;
							 		$count_products++;
							 	} 
							}
							if($count_products) 
								$cart_new[] = array('0' => $eid, $products_new);
						} else {	
							$cart_new[] = $item;
						}
					}
					$_SESSION['cart'] = $cart_new;
				}
				
			}
			$link = FSRoute::_('index.php?module=products&view=cart&task=shopcart2&Itemid='.$Itemid);
			setRedirect($link);
		}
		
		/*
		 * Remove product in one estores
		 * but redirect eshopcart
		 */
		function edel() {
			$pid = FSInput::get('id',0,'int');
			$Itemid = FSInput::get('Itemid',0,'int');
			if($pid) {
				if(isset($_SESSION['cart'])) {
					$product_list  = $_SESSION['cart'];
					
					// count products of eid current:
					$count_products_current = 0;
					
					// Repeat estores
							$products_new = array();
							
							// Repeat products
							for($i = 0; $i < count($product_list); $i ++) {
							 	$prd = $product_list[$i];
							 	if($pid != $prd[0]) {
							 		$products_new[] = $prd;
							 	} 
							}
					$_SESSION['cart'] = $products_new;
					
				}
			}
			$link = FSRoute::_('index.php?module=products&view=cart&task=eshopcart2&Itemid='.$Itemid);
			setRedirect($link);
		}
		
		
		/*
		 * Display detail shopcart in estores
		 * and display login form
		 */
		function eshopcart(){
			if(isset($_COOKIE['username'])){
				$this -> eshopcart2();
				return;
			} 
			
			$model = $this -> model;	
			
			// get temporary data stored in fs_order:
			$session_order = $model -> getOrder();
			
			$member = $model->get_member_by_username(@$session_order->username);
			
			include 'modules/'.$this->module.'/views/'.$this->view.'/eshopcart.php';
		}
		
		/*
		 * Save database from eshopcart form
		 */
		function eshopcart_save(){
			$model = $this -> model;	
			$Itemid = FSInput::get('Itemid',0,'int');
			
			// get temporary data stored in fs_order:
			$session_order = $model -> eshopcart_save();
			if($session_order) {
				$link = FSRoute::_('index.php?module=products&view=cart&task=eshopcart2&Itemid='.$Itemid);
				setRedirect($link);
			} else {
				$msg = "B&#7841;n ch&#432;a th&#7875; chuy&#7875;n sang b&#432;&#7899;c ti&#7871;p theo do s&#7889; sim b&#7841;n nh&#7853;p ch&#432;a &#273;&#250;ng";
				$link = FSRoute::_('index.php?module=products&view=cart&task=eshopcart&Itemid='.$Itemid);
				setRedirect($link,$msg,'error');
			}
		}

		/* Mua nhanh: chỉ cấn điền số điện thoại để gọi lại */
		function buy_fast_save(){
			$return = FSInput::get ( 'return' );
			$url = base64_decode ( $return );
			
			$model = $this->model;
			$session_order = $model -> buy_fast_save();
			if (! $session_order) {
			 	$msg = FSText::_('Chưa gửi thành công!');
			 	setRedirect ( $url, $msg, 'error' );
			
			} else {
				$send_mail  = $model -> mail_to_buyer($session_order,$fast = 1);
				// setRedirect ( $url, 'Cảm ơn bạn đã liên hệ. Chúng tôi sẽ gọi lại cho bạn' );
				echo "<script>";
				echo " alert('".FSText::_('Cảm ơn bạn đã liên hệ. Chúng tôi sẽ gọi lại cho bạn')."');      
				        window.location.href='".$url."';
				</script>";
			}
		}
		
		/*
		 * Save payment method
		 */
		function shipping_save(){
			$model = $this -> model;	
			$eid = FSInput::get('eid',0,'int');
			$payment = FSInput::get('payment');
			$Itemid = FSInput::get('Itemid',0,'int');
			
			// get temporary data stored in fs_order:
			$temporary_order = $model -> shipping_save();
			if($temporary_order) {
				$link = FSRoute::_('index.php?module=products&view=cart&task=order&eid='.$eid.'&Itemid='.$Itemid);
				setRedirect($link);
			} else {
				$msg = FSText::_("Bạn chưa thể chuyện qua bước tiếp theo");
				$link = FSRoute::_('index.php?module=products&view=cart&task=shipping&eid='.$eid.'&Itemid='.$Itemid);
				setRedirect($link,$msg,'error');
			}
		}
		
		/*
		 * Display detail shopcart in estores And cutomer form
		 * 
		 */
		function eshopcart2(){
			
			$model = $this -> model;	
			// get temporary data stored in fs_order:
			$session_order = $model -> getOrder();

			// site có 1 sản phẩm
			// $product_one = $model -> get_product_one();

			if(!isset($_SESSION['cart'])  || !count($_SESSION['cart']) ) {
					
					// $link = FSRoute::_('index.php?module=products&view=cart&task=buy_multi&id=1&Itemid=94');
					// setRedirect($link);
			}
			

			$user = $model -> get_user();
			$discount = $model -> getDiscount();
			$Itemid = FSInput::get('Itemid',0,'int');
			// $cities = $model -> get_records('','fs_cities');
			// REQUIRE LOGIN
//			if(!isset($_COOKIE['username']) ){
//				if(!$session_order ) {
//					$link = FSRoute::_('index.php?module=products&view=cart&task=eshopcart&eid='.$eid.'&Itemid='.$Itemid);
//					setRedirect($link);
//				}
//			}
			// breadcrumbs
			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>FSText::_('Đơn hàng'), 1 => '');
			global $tmpl;	
			$tmpl -> assign('breadcrumbs', $breadcrumbs);

			
			//input info
			$sender_name = isset($session_order-> sender_name)?$session_order-> sender_name:@$user->full_name;
			$sender_sex = isset($session_order->sender_sex)?$session_order->sender_sex:@$user -> sex;
			$sender_address = isset($session_order->sender_address)?$session_order->sender_address:@$user -> address;
			$sender_email = isset($session_order->sender_email)?$session_order->sender_email:@$user -> email;
			$sender_telephone = isset($session_order->sender_telephone)?$session_order->sender_telephone:@$user -> mobilephone;
			$sender_telephone = isset($session_order->sender_telephone)?$session_order->sender_telephone:@$user -> mobilephone;
			$sender_city = isset($session_order->sender_city)?$session_order->sender_city:@$user -> city_id;
			$sender_city = isset($session_order->sender_district)?$session_order->sender_district:@$user -> district_id;
//			$discount_code = isset($session_order->discount_code)?$session_order->discount_code:'';
			
			$array_breadcrumb[] = array(0=> array('name'=> 'Giỏ hàng', 'link'=>'','selected' => 0));
			include 'modules/'.$this->module.'/views/'.$this->view.'/eshopcart2/simple.php';
		}
		
		/*
		 * Display policy, transportation of estores
		 */
		function shipping() {
			$model = $this -> model;	
			// get temporary data stored in fs_order:
			$temporary_order = $model -> getOrder();
			$Itemid = FSInput::get('Itemid',0,'int');
			
			// get payment id from fs_estore. Use field payment_methods
			$epayment_methods = $estore->payment_methods;
			$arr_str_payments = explode('|',$epayment_methods);
			$array_epayments  = array();
			$str_epayment_ids = '';
			for($i = 0; $i < count($arr_str_payments); $i ++ ){
				if($i > 0)
					$str_epayment_ids .= ',';
				$item = $arr_str_payments[$i];
				if($item){
					$arr_buff = explode(',[',$item);
					if(isset($arr_buff[1])){
						$array_epayments [$arr_buff[0]] = str_replace(']','',$arr_buff[1]);
						$str_epayment_ids .= $arr_buff[0];
					}
				}
			}
			
			// get from table payments_methods
			$payments= $model->get_payment_methods($str_epayment_ids);
			
			// get transfer id from fs_estore. Use field transfer_methods
			$etransfer_methods = $estore->transfer_methods;
			$arr_str_transfers = explode('|',$etransfer_methods);
			$array_etransfers  = array();
			$str_etransfer_ids = '';
			for($i = 0; $i < count($arr_str_transfers); $i ++ ){
				if($i > 0)
					$str_etransfer_ids .= ',';
				$item = $arr_str_transfers[$i];
				if($item){
					$arr_buff = explode(',[',$item);
					if(isset($arr_buff[1])){
						$array_etransfers [$arr_buff[0]] = str_replace(']','',$arr_buff[1]);
						$str_etransfer_ids .= $arr_buff[0];
					}
				}
			}
			
			// get from table transfers_methods
			$transfers= $model->get_transfer_methods($str_etransfer_ids);
			
			
			$city = $model -> getCity($estore->city_id) ;
			$district = $model -> getDistrict($estore->district_id) ;
			// check input. If not go back
			if($temporary_order->estore_type == 'discount' ) {
				if(!$temporary_order->username ) {
					$link = FSRoute::_('index.php?module=products&view=cart&task=eshopcart2&Itemid='.$Itemid);
					setRedirect($link);
				}
			} else {
				if(!$temporary_order->sender_name ) {
					$link = FSRoute::_('index.php?module=products&view=cart&task=eshopcart2&Itemid='.$Itemid);
					setRedirect($link);
				}
			} 
			include 'modules/'.$this->module.'/views/'.$this->view.'/shipping.php';
		}
		
		/*
		 * Confirm and order
		 */
		function order() {
			$model = $this -> model;
			$Itemid = FSInput::get('Itemid',0,'int');	
			// get temporary data stored in fs_order:
			$session_order = $model -> getOrder();
//			$city = $model -> getCity($estore->city_id) ;
//			$district = $model -> getDistrict($estore->district_id) ;
//			$payment_method_name = $model -> get_payment_method($session_order->payment_method) ;
//			$transfer_method_name = $model -> get_transfer_method($session_order->transfer_method) ;
			// check input. If not go back
			
			
			// calculation:
			$total_price = 0;
			$quantity = 0;
			if(isset($_SESSION['cart'])) {
				$product_list = $_SESSION['cart'];
//				 prdid,quality, price, discount/
				$i = 0; 
				if($product_list) {
					foreach ($product_list as $prd) {
				  		$i++;
				  		$total_price +=  $prd[2]* $prd[1];
				  		$quantity +=  $prd[1];
					}
		  		}
			}
			
			
			// NGAN LUONG
//			FSFactory:: include_class('nganluong');
////			global $config;
////			$nganluong_merchant_site_code = @$config['nganluong_merchant_site_code'];			
////			$nganluong_secure_pass = @$config['nganluong_secure_pass'];
////			$nganluong_email = @$config['nganluong_email'];
//			$nganluong_email = 'hong_hanh54@yahoo.com';
//			
//			$nl = new NL_Checkout();
////			$return_url, $receiver, $transaction_info, $order_code, $price, $currency = 'vnd', $quantity = 1, $tax = 0, $discount = 0, $fee_cal = 0, $fee_shipping = 0, $order_description = '', $buyer_info = '', $affiliate_code = ''
//			$return_url  = URL_ROOT.'nl_complate.html';
//			$receiver  = $nganluong_email;
//			$transaction_info  = 'Giao dịch mua bán';
//			$order_code  = $session_order -> id;
//			$price = $total_price;
////			Họ tên người mua *|* Địa chỉ Email *|* Điện thoại *|* Địa chỉ nhận hàng
//			$buyer_info = @$session_order-> sender_name.'*|*';
//			$buyer_info .= @$session_order-> sender_email.'*|*';
//			$buyer_info .= @$session_order-> sender_telephone.'*|*';
//			$buyer_info .= @$session_order-> recipients_address.'*|*';
//			
//			$nl_url_checkout = $nl -> buildCheckoutUrlNew($return_url,$receiver,$transaction_info,$order_code,$price);
			// end NGAN LUONG	
					
			$notice_when_order = FsGlobal::getConfig('notice_when_order');
			$array_breadcrumb[] = array(0=> array('name'=> 'Đơn hàng', 'link'=>'','selected' => 0));
			if(!$session_order->sender_name ) {
				$link = FSRoute::_('index.php?module=products&view=cart&task=eshopcart2&Itemid='.$Itemid);
				setRedirect($link);
			}
			// breadcrumbs
			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>FSText::_('Thanh toán'), 1 => '');
			global $tmpl;	
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			
			include 'modules/'.$this->module.'/views/'.$this->view.'/order.php';
		}
		function eshopcart2_fast_save(){

			$model = $this -> model;	

			$session_order = $model -> eshopcart2_fast_save();
			if($session_order) {
				$link = FSRoute::_('index.php?module=products&view=cart&task=finished&id='.$session_order);
				setRedirect($link,'Bạn đã đặt hàng thành công. Chúng tôi sẽ liên lạc với bạn trong thời gian sớm nhất. Xin cảm ơn!');
			} else {
				$link = URL_ROOT;
				setRedirect($link);
			}
			
		}
		
		/*
		 * function save info of sender and recipient
		 */
		function eshopcart2_save(){
			$model = $this -> model;	
			$Itemid = FSInput::get('Itemid',0,'int');
			// get temporary data stored in fs_order:
			$session_order = $model -> eshopcart2_save();
			$Itemid = FSInput::get('Itemid',0,'int');
			if(!$session_order) {
				$link = FSRoute::_('index.php?module=products&view=cart&task=eshopcart2&Itemid='.$Itemid);
			} else {
				$link = FSRoute::_('index.php?module=products&view=cart&task=order&Itemid='.$Itemid);
//				$link = FSRoute::_('index.php?module=products&view=cart&task=order&eid='.$eid.'&Itemid='.$Itemid);
			}
			setRedirect($link);
			
		}
		/*
		 * function save info of sender and recipient
		 */
		function eshopcart2_simple_save(){
			$model = $this -> model;	
			$Itemid = FSInput::get('Itemid',0,'int');
			// get temporary data stored in fs_order:
			$order_id = $model -> eshopcart2_simple_save();
			$Itemid = FSInput::get('Itemid',0,'int');
			if($order_id) {
				$send_mail  = $model -> mail_to_buyer($order_id);
				$link = FSRoute::_('index.php?module=products&view=cart&task=finished&id='.$order_id.'&Itemid='.$Itemid);
				setRedirect($link,FSText::_('Đơn hàng của bạn đã được gửi đi. Chúng tôi sẽ liên lạc với bạn trong thời gian sớm nhất. Xin cảm ơn!'));
			} else {
				$link = FSRoute::_('index.php?module=products&view=cart&task=order&Itemid='.$Itemid);
				setRedirect($link);
			}
			
		}
		/*
		 * Recalculate estores
		 * but redirect to eshopcart
		 */
		function ere_cal(){
			$Itemid = FSInput::get('Itemid');
			if(isset($_SESSION['cart'])) {
				$cart  = $_SESSION['cart'];
				$product_list = $cart;
				
				$products_new = array();
				$count_products = 0;
				
				// Repeat products
				for($i = 0; $i < count($product_list); $i ++) {
				 	$prd = $product_list[$i];
					$quantity = FSInput::get('quantity_'.$prd[0]);
					if($quantity) {
						$products_new[] = array($prd[0],$quantity,$prd[2],$prd[3]);
//						$count_products ++;
					}		
				}
//				if($count_products) 
//					$cart_new[] =  $products_new;
				$_SESSION['cart'] = $products_new;
				
				// if del all
				if(!$count_products) {
					$link = FSRoute::_('index.php?module=products&view=cart&task=eshopcart2&Itemid='.$Itemid);
					setRedirect($link);
				}
			}
			
			$link = FSRoute::_('index.php?module=products&view=cart&task=eshopcart2&Itemid='.$Itemid);
			setRedirect($link);
		}
		function ere_cal2(){
			$Itemid = FSInput::get('Itemid');
			$model = $this -> model;
			if(isset($_SESSION['cart'])) {
				$product_list  = $_SESSION['cart'];
				
				$products_new = array();
				$count_products = 0;
				
				// Repeat products
				for($i = 0; $i < count($product_list); $i ++) {
				 	$prd = $product_list[$i];
					$quantity = FSInput::get('quantity_'.$prd[0]);
					$color_price_old = FSInput::get('color_price_'.$prd[0]);
					$color_price = FSInput::get('color_'.$prd[0]);
					$color = $model -> get_record_by_id($color_price,'fs_products_price');
					$price = $prd[2]- $color_price_old;
					$price =$price +$color->price;
					if($quantity) {
						$products_new[] = array($prd[0],$quantity,$price,$prd[3],$prd[4],$color_price,$prd[6]);
//						$count_products ++;
					}		
				}
//				if($count_products) 
//					$cart_new[] =  $products_new;
				$_SESSION['cart'] = $products_new;
				
				// if del all
				if(!$count_products) {
					$link = FSRoute::_('index.php?module=products&view=cart&task=eshopcart2&Itemid='.$Itemid);
					setRedirect($link);
				}
			}
			
			$link = FSRoute::_('index.php?module=products&view=cart&task=eshopcart2&Itemid='.$Itemid);
			setRedirect($link);
		}
		
		/*
		 * get product name
		 */
		function getProductName($product_id) {
			$model = $this -> model;
			return $model -> getProductName($product_id) ;
		}
		
		function getProductById($product_id) {
			$model = $this -> model;
			return $model -> getProductById($product_id) ;
		}
		function get_color($id) {
			$model = $this -> model;
			return $model -> get_color($id) ;
		}
		function get_price_by_color($rid) {
			$model = $this -> model;
			return $model -> get_price_by_color($rid) ;
		}
		function getProductCategoryById($category_id) {
			$model = $this -> model;
			return $model -> getProductCategoryById($category_id) ;
		}
		
		/*
		 * For ajax
		 * Display fullname of sim_number
		 */
		function ajax_get_member() {
			$model = $this -> model;
			$member = $model -> ajax_get_member();
			if(!$member)
				echo json_encode(array('status'=>0,'text'=>'Khong xac dinh'));
			else
				echo json_encode(array('status'=>1,'text'=>$member->fname." ".$member -> mname ." ". $member->lname));
			exit;
		}
		
		/*
		 * SAve order.
		 */
		function order_save() {
			$model = $this -> model;	
			$Itemid = FSInput::get('Itemid');
			// get temporary data stored in fs_order:
			$order_id = $model -> order_save();
			if($order_id) {
				$payment_method = $model -> get_result('id = '.$order_id,'fs_order','payment_method');
				$send_mail  = $model -> mail_to_buyer($order_id);
				
				if($payment_method == 1){  // thanh toán nội địa
					$this -> onepay_interior($order_id);
				}else if($payment_method == 2){ // thanh toán quốc tế
					$this -> onepay_international($order_id);
				}else{
					$link = FSRoute::_('index.php?module=products&view=cart&task=finished&id='.$order_id.'&Itemid='.$Itemid);
					if(!$send_mail){
						$msg = FSText::_('Bạn không thể send mail');
						setRedirect($link,$msg,'alert');
						return;
					}
					setRedirect($link,FSText::_('Đơn hàng của bạn đã được gửi đi. Chúng tôi sẽ liên lạc với bạn trong thời gian sớm nhất. Xin cảm ơn!') );
				}
			} else {
				$msg = FSText::_("Bạn chưa thể chuyển sang bước tiếp theo do có sự cố trong thông tin giỏ hàng");
				$link = FSRoute::_('index.php?module=products&view=cart&task=eshopcart2&Itemid='.$Itemid);
				setRedirect($link,$msg,'error');
			}
		}
		/*
		 * Tích hợp phương thức thanh toán trực tuyến onepay nội địa
		 */
		function onepay_interior($order_id){
			$model = $this -> model;	
			$order = $model -> getOrderById($order_id);
			if(!$order)
				return;
			// ----------------
			// This is secret for encoding the MD5 hash
			// This secret will vary from merchant to merchant
			// To not create a secure hash, let SECURE_SECRET be an empty string - ""
			// $SECURE_SECRET = "secure-hash-secret";
			// Khóa bí mật - được cấp bởi OnePAY
			$SECURE_SECRET = "9E9255056FCFE503B16307451E509A3A";
//			$SECURE_SECRET = "A3EFDFABA8653DF2342E8DAC29B51AF0";// TEST
			
			// add the start of the vpcURL querystring parameters
			// *****************************Lấy giá trị url cổng thanh toán*****************************
//			$vpcURL = 'http://mtf.onepay.vn/onecomm-pay/vpc.op?';
			$vpcURL = 'https://onepay.vn/onecomm-pay/vpc.op?';
			
			$vpc_AccessCode = 'NKX5S39Y';
//			$vpc_AccessCode = 'D67342C2'; // TEST
			$vpc_Merchant = 'HUONGTHUY';
//			$vpc_Merchant = 'ONEPAY';// TEST
			$vpc_Version = 2;
			$vpc_ReturnURL = FSRoute::_('index.php?module=products&view=cart&task=onepay_return');
			
			//$stringHashData = $SECURE_SECRET; *****************************Khởi tạo chuỗi dữ liệu mã hóa trống*****************************
			$stringHashData = "";
			
			// add params
			$vpcURL .= 'Title=VPC+3-Party';
			$stringHashData .= 'vpc_AccessCode='.$vpc_AccessCode;
			$vpc_Amount  = ($order -> total_after_discount) * 100; 
			$stringHashData .= '&vpc_Amount='.$vpc_Amount;
			$stringHashData .= '&vpc_Command='.'pay';
			$stringHashData .= '&vpc_Currency='.'VND';
			$stringHashData .= '&vpc_Customer_Email='.$order -> sender_email;
			if($order -> user_id)
				$stringHashData .= '&vpc_Customer_Id='.$order -> user_id;
			$stringHashData .= '&vpc_Customer_Phone='.$order -> sender_telephone;
			$stringHashData .= '&vpc_Locale='.'vn';
			$stringHashData .= '&vpc_MerchTxnRef='.$order -> id;
			$stringHashData .= '&vpc_Merchant='.$vpc_Merchant;
			$stringHashData .= '&vpc_OrderInfo='.$order -> id;
			$stringHashData .= '&vpc_ReturnURL='.$vpc_ReturnURL;
//			$stringHashData .= '&vpc_SHIP_City='.'ha noi';
//			$stringHashData .= '&vpc_SHIP_Country='.'Viet Nam';
//			$stringHashData .= '&vpc_SHIP_Provice='.'xxxxx';
//			$stringHashData .= '&vpc_SHIP_Street01='.$order ->recipients_address;
			$stringHashData .= '&vpc_TicketNo='.$_SERVER['REMOTE_ADDR'];
			$stringHashData .= '&vpc_Version='.$vpc_Version;
			
			$vpcURL .= '&vpc_AccessCode='.urlencode($vpc_AccessCode);
			$vpcURL .= '&vpc_Amount='.urlencode($vpc_Amount);
			$vpcURL .= '&vpc_Command='.urlencode('pay');
			$vpcURL .= '&vpc_Currency='.urlencode('VND');
			$vpcURL .= '&vpc_Customer_Email='.urlencode($order -> sender_email);
			if($order -> user_id)
				$vpcURL .= '&vpc_Customer_Id='.urlencode($order -> user_id);
			$vpcURL .= '&vpc_Customer_Phone='.urlencode($order -> sender_telephone);
			$vpcURL .= '&vpc_Locale='.urlencode('vn');
			$vpcURL .= '&vpc_MerchTxnRef='.urlencode($order -> id);
			$vpcURL .= '&vpc_Merchant='.urlencode($vpc_Merchant);
			$vpcURL .= '&vpc_OrderInfo='.urlencode($order -> id);
			$vpcURL .= '&vpc_ReturnURL='.urlencode($vpc_ReturnURL);
//			$vpcURL .= '&vpc_SHIP_City='.urlencode('ha noi');
//			$vpcURL .= '&vpc_SHIP_Country='.urlencode('Viet Nam');
//			$vpcURL .= '&vpc_SHIP_Provice='.urlencode('xxxxx');
//			$vpcURL .= '&vpc_SHIP_Street01='.urlencode($order ->recipients_address);
			$vpcURL .= '&vpc_TicketNo='.urlencode($_SERVER['REMOTE_ADDR']);
			$vpcURL .= '&vpc_Version='.$vpc_Version;
			
			
			if (strlen($SECURE_SECRET) > 0) {
			    $vpcURL .= "&vpc_SecureHash=" . strtoupper(hash_hmac('SHA256', $stringHashData, pack('H*',$SECURE_SECRET)));
			}
//			echo $vpcURL;
//			die;
			// chuyển trình duyệt sang cổng thanh toán theo URL được tạo ra
			header("Location: ".$vpcURL);
		}
		/*
		 * Tích hợp phương thức thanh toán trực tuyến onepay Quốc tế
		 */
		function onepay_international($order_id){
			$model = $this -> model;	
			$order = $model -> getOrderById($order_id);
			if(!$order)
				return;
			// ----------------
			// This is secret for encoding the MD5 hash
			// This secret will vary from merchant to merchant
			// To not create a secure hash, let SECURE_SECRET be an empty string - ""
			// $SECURE_SECRET = "secure-hash-secret";
			// Khóa bí mật - được cấp bởi OnePAY
			$SECURE_SECRET = "B30DBB6193BD877CB98DD38F40B397FE";   // config                     
			
			// add the start of the vpcURL querystring parameters
			// *****************************Lấy giá trị url cổng thanh toán*****************************
			$vpcURL = 'https://onepay.vn/vpcpay/vpcpay.op?'; 
//			$vpcURL = 'http://mtf.onepay.vn/vpcpay/vpcpay.op?'; // test
			
			$vpc_AccessCode = '3C149880';
			$vpc_Merchant = 'HUONGTHUY'; 
//			$vpc_AccessCode = '6BEB2546'; //test
//			$vpc_Merchant = 'TESTONEPAY'; //test
			$vpc_Version = 2;
			$vpc_ReturnURL = FSRoute::_('index.php?module=products&view=cart&task=onepay_inter_return');
//			$vpc_ReturnURL = URL_ROOT.'thanh-toan-quoc-te.php';
//			$vpc_ReturnURL = URL_ROOT.'thanh-toan-quoc-te.html';
			
			//$stringHashData = $SECURE_SECRET; *****************************Khởi tạo chuỗi dữ liệu mã hóa trống*****************************
			$stringHashData = "";
			
			// add params
			$vpcURL .= 'Title=VPC+3-Party';
			$stringHashData .= 'vpc_AccessCode='.$vpc_AccessCode;
			$vpc_Amount  = ($order -> total_after_discount) * 100; 
			$stringHashData .= '&vpc_Amount='.$vpc_Amount;
			$stringHashData .= '&vpc_Command='.'pay';
//			$stringHashData .= '&vpc_Currency='.'VND';
			$stringHashData .= '&vpc_Customer_Email='.$order -> sender_email;
			if($order -> user_id)
				$stringHashData .= '&vpc_Customer_Id='.$order -> user_id;
			$stringHashData .= '&vpc_Customer_Phone='.$order -> sender_telephone;
			$stringHashData .= '&vpc_Locale='.'vn';
			$stringHashData .= '&vpc_MerchTxnRef='.$order -> id;
			$stringHashData .= '&vpc_Merchant='.$vpc_Merchant;
			$stringHashData .= '&vpc_OrderInfo='.$order -> id;
			$stringHashData .= '&vpc_ReturnURL='.$vpc_ReturnURL;
//			$stringHashData .= '&vpc_SHIP_City='.'ha noi';
//			$stringHashData .= '&vpc_SHIP_Country='.'Viet Nam';
//			$stringHashData .= '&vpc_SHIP_Provice='.'xxxxx';
//			$stringHashData .= '&vpc_SHIP_Street01='.$order ->recipients_address;
			$stringHashData .= '&vpc_TicketNo='.$_SERVER['REMOTE_ADDR'];
			$stringHashData .= '&vpc_Version='.$vpc_Version;
			
			$vpcURL .= '&vpc_AccessCode='.urlencode($vpc_AccessCode);
			$vpcURL .= '&AgainLink='.urlencode($_SERVER['HTTP_REFERER']);
			$vpcURL .= '&vpc_Amount='.urlencode($vpc_Amount);
			$vpcURL .= '&vpc_Command='.urlencode('pay');
//			$vpcURL .= '&vpc_Currency='.urlencode('VND');
			$vpcURL .= '&vpc_Customer_Email='.urlencode($order -> sender_email);
			if($order -> user_id)
				$vpcURL .= '&vpc_Customer_Id='.urlencode($order -> user_id);
			$vpcURL .= '&vpc_Customer_Phone='.urlencode($order -> sender_telephone);
			$vpcURL .= '&vpc_Locale='.urlencode('vn');
			$vpcURL .= '&vpc_MerchTxnRef='.urlencode($order -> id);
			$vpcURL .= '&vpc_Merchant='.urlencode($vpc_Merchant);
			$vpcURL .= '&vpc_OrderInfo='.urlencode($order -> id);
			$vpcURL .= '&vpc_ReturnURL='.urlencode($vpc_ReturnURL);
//			$vpcURL .= '&vpc_SHIP_City='.urlencode('ha noi');
//			$vpcURL .= '&vpc_SHIP_Country='.urlencode('Viet Nam');
//			$vpcURL .= '&vpc_SHIP_Provice='.urlencode('xxxxx');
//			$vpcURL .= '&vpc_SHIP_Street01='.urlencode($order ->recipients_address);
			$vpcURL .= '&vpc_TicketNo='.urlencode($_SERVER['REMOTE_ADDR']);
			$vpcURL .= '&vpc_Version='.$vpc_Version;
			
			if (strlen($SECURE_SECRET) > 0) {
			    $vpcURL .= "&vpc_SecureHash=" . strtoupper(hash_hmac('SHA256', $stringHashData, pack('H*',$SECURE_SECRET)));
			}

			// chuyển trình duyệt sang cổng thanh toán theo URL được tạo ra
			header("Location: ".$vpcURL);
		}
		
		/*
		 * Kiểm tra việc trả lại với onePay nội địa
		 */
		function onepay_check_return($SECURE_SECRET){
			$vpc_Txn_Secure_Hash = $_GET ["vpc_SecureHash"];
			unset ( $_GET ["vpc_SecureHash"] );
			
			if (strlen ( $SECURE_SECRET ) > 0 && $_GET ["vpc_TxnResponseCode"] != "7" && $_GET ["vpc_TxnResponseCode"] != "No Value Returned") {
				
			    $stringHashData = "";
				
				// sort all the incoming vpc response fields and leave out any with no value
				foreach ( $_GET as $key => $value ) {
			        if ($key != "vpc_SecureHash" && (strlen($value) > 0) && ((substr($key, 0,4)=="vpc_") || (substr($key,0,5) =="user_"))) {
					    $stringHashData .= $key . "=" . $value . "&";
					}
				}
				//  *****************************Xóa dấu & thừa cuối chuỗi dữ liệu*****************************
			    $stringHashData = rtrim($stringHashData, "&");	
				
				if (strtoupper ( $vpc_Txn_Secure_Hash ) == strtoupper(hash_hmac('SHA256', $stringHashData, pack('H*',$SECURE_SECRET)))) {
					return true;
				} else {
					return false;
				}
			} 
			return false;
		}
		/*
		 * Kiểm tra việc trả lại với onePay Quốc tế
		 */
		function onepay_inter_check_return($SECURE_SECRET){
			$vpc_Txn_Secure_Hash = $_GET["vpc_SecureHash"];
			$vpc_MerchTxnRef = $_GET["vpc_MerchTxnRef"];
			$vpc_AcqResponseCode = $_GET["vpc_AcqResponseCode"];
			unset($_GET["vpc_SecureHash"]);
			
			if (strlen($SECURE_SECRET) > 0 && $_GET["vpc_TxnResponseCode"] != "7" && $_GET["vpc_TxnResponseCode"] != "No Value Returned") {
			
			    ksort($_GET);
			    //$md5HashData = $SECURE_SECRET;
			    //khởi tạo chuỗi mã hóa rỗng
			    $md5HashData = "";
			    // sort all the incoming vpc response fields and leave out any with no value
			    foreach ($_GET as $key => $value) {
			//        if ($key != "vpc_SecureHash" or strlen($value) > 0) {
			//            $md5HashData .= $value;
			//        }
			//      chỉ lấy các tham số bắt đầu bằng "vpc_" hoặc "user_" và khác trống và không phải chuỗi hash code trả về
			        if ($key != "vpc_SecureHash" && (strlen($value) > 0) && ((substr($key, 0,4)=="vpc_") || (substr($key,0,5) =="user_"))) {
					    $md5HashData .= $key . "=" . $value . "&";
					}
			    }
			//  Xóa dấu & thừa cuối chuỗi dữ liệu
			    $md5HashData = rtrim($md5HashData, "&");
			
			//    if (strtoupper ( $vpc_Txn_Secure_Hash ) == strtoupper ( md5 ( $md5HashData ) )) {
			//    Thay hàm tạo chuỗi mã hóa
				if (strtoupper ( $vpc_Txn_Secure_Hash ) == strtoupper(hash_hmac('SHA256', $md5HashData, pack('H*',$SECURE_SECRET)))) {
			        return true;
			    } else {
			        return false;
			    }
			} else {
			    return false;
			}
		}
		
		/*
		 * Nhận trả kết quả từ Onepay với cổng thanh toán nội địa
		 */
		function onepay_return(){
			if(!isset($_GET ["vpc_TxnResponseCode"]) || $_GET ["vpc_TxnResponseCode"] == '')
				return;
			if(!isset($_GET ["vpc_MerchTxnRef"]) || $_GET ["vpc_MerchTxnRef"] == '')
				return;
//			$SECURE_SECRET = "A3EFDFABA8653DF2342E8DAC29B51AF0"; // khóa bí mật được cung cấp bởi ONEPAY: test
			$SECURE_SECRET = "9E9255056FCFE503B16307451E509A3A"; // cho HUONG THUY
			if(!$this->onepay_check_return($SECURE_SECRET))
				return; 
			$responseCode = $_GET ["vpc_TxnResponseCode"] ;
			$vpc_MerchTxnRef  = $_GET ["vpc_MerchTxnRef"] ;
			switch ($responseCode) {
				case "0" :
					$message = "Giao dịch thành công - Approved";
					$status = 1;
					break;
				case "1" :
					$message = "Ngân hàng từ chối giao dịch - Bank Declined";
					$status = 0;
					break;
				case "3" :
					$message = "Mã đơn vị không tồn tại - Merchant not exist";
					$status = 0;
					break;
				case "4" :
					$message = "Không đúng access code - Invalid access code";
					$status = 0;
					break;
				case "5" :
					$message = "Số tiền không hợp lệ - Invalid amount";
					$status = 0;
					break;
				case "6" :
					$message = "Mã tiền tệ không tồn tại - Invalid currency code";
					$status = 0;
					break;
				case "7" :
					$message = "Lỗi không xác định - Unspecified Failure ";
					$status = 0;
					break;
				case "8" :
					$message = "Số thẻ không đúng - Invalid card Number";
					$status = 0;
					break;
				case "9" :
					$message = "Tên chủ thẻ không đúng - Invalid card name";
					$status = 0;
					break;
				case "10" :
					$message = "Thẻ hết hạn/Thẻ bị khóa - Expired Card";
					$status = 0;
					break;
				case "11" :
					$message = "Thẻ chưa đăng ký sử dụng dịch vụ - Card Not Registed Service(internet banking)";
					$status = 0;
					break;
				case "12" :
					$message = "Ngày phát hành/Hết hạn không đúng - Invalid card date";
					$status = 0;
					break;
				case "13" :
					$message = "Vượt quá hạn mức thanh toán - Exist Amount";
					$status = 0;
					break;
				case "21" :
					$message = "Số tiền không đủ để thanh toán - Insufficient fund";
					$status = 0;
					break;
				case "99" :
					$message = "Người sủ dụng hủy giao dịch - User cancel";
					$status = 0;
					break;
				default :
					$message = "Giao dịch thất bại - Failured";
					$status = 0;
			}
			$row['payment_message'] = $message;
			$row['status'] = $status;
			$model = $this -> model;
			$model -> _update($row,'fs_order','WHERE id = '.$vpc_MerchTxnRef);
			$link = FSRoute::_('index.php?module=products&view=cart&task=finished&id='.$vpc_MerchTxnRef);
			// gửi mail nếu thanh toán thành công
			$send_mail  = $model -> mail_to_buyer_after_successful($vpc_MerchTxnRef);
//			if(!$send_mail){
				$msg = $status ? 'Bạn đã thanh toán thành công. Chúng tôi sẽ gửi sản phẩm cho quý vị trong thời gian nhanh nhất':'Bạn giao dịch chưa thành công do lỗi "'.$message.'"';
				setRedirect(URL_ROOT,$msg,'alert');
				return;
//			}
			
		}
		/*
		 * Nhận trả kết quả từ Onepay với cổng thanh toán quốc tế
		 */
		function onepay_inter_return(){
			$SECURE_SECRET = "B30DBB6193BD877CB98DD38F40B397FE";
			// get and remove the vpc_TxnResponseCode code from the response fields as we
			// do not want to include this field in the hash calculation
			$vpc_Txn_Secure_Hash = $_GET["vpc_SecureHash"];
			$vpc_MerchTxnRef = $_GET["vpc_MerchTxnRef"];
			$vpc_AcqResponseCode = $_GET["vpc_AcqResponseCode"];
			unset($_GET["vpc_SecureHash"]);
			// set a flag to indicate if hash has been validated
			$errorExists = false;
			
			if (strlen($SECURE_SECRET) > 0 && $_GET["vpc_TxnResponseCode"] != "7" && $_GET["vpc_TxnResponseCode"] != "No Value Returned") {
			
			    ksort($_GET);
			    //$md5HashData = $SECURE_SECRET;
			    //khởi tạo chuỗi mã hóa rỗng
			    $md5HashData = "";
			    // sort all the incoming vpc response fields and leave out any with no value
			    foreach ($_GET as $key => $value) {
			//        if ($key != "vpc_SecureHash" or strlen($value) > 0) {
			//            $md5HashData .= $value;
			//        }
			//      chỉ lấy các tham số bắt đầu bằng "vpc_" hoặc "user_" và khác trống và không phải chuỗi hash code trả về
			        if ($key != "vpc_SecureHash" && (strlen($value) > 0) && ((substr($key, 0,4)=="vpc_") || (substr($key,0,5) =="user_"))) {
					    $md5HashData .= $key . "=" . $value . "&";
					}
			    }
			//  Xóa dấu & thừa cuối chuỗi dữ liệu
			    $md5HashData = rtrim($md5HashData, "&");
			
			//    if (strtoupper ( $vpc_Txn_Secure_Hash ) == strtoupper ( md5 ( $md5HashData ) )) {
			//    Thay hàm tạo chuỗi mã hóa
				if (strtoupper ( $vpc_Txn_Secure_Hash ) == strtoupper(hash_hmac('SHA256', $md5HashData, pack('H*',$SECURE_SECRET)))) {
			        // Secure Hash validation succeeded, add a data field to be displayed
			        // later.
			        $hashValidated = "CORRECT";
			    } else {
			        // Secure Hash validation failed, add a data field to be displayed
			        // later.
			        $hashValidated = "INVALID HASH";
			    }
			} else {
			    // Secure Hash was not validated, add a data field to be displayed later.
			    $hashValidated = "INVALID HASH";
			}
			// Standard Receipt Data
			$txnResponseCode = isset($_GET["vpc_TxnResponseCode"])?$_GET["vpc_TxnResponseCode"]:'nono';
			
			// Show 'Error' in title if an error condition
			$errorTxt = "";
			
			// Show this page as an error page if vpc_TxnResponseCode equals '7'
			if ($txnResponseCode == "7" || $txnResponseCode == "No Value Returned" || $errorExists) {
			    $errorTxt = "Error ";
			}
			
			// This is the display title for 'Receipt' page 
			$title = $_GET["Title"];
			
			// The URL link for the receipt to do another transaction.
			// Note: This is ONLY used for this example and is not required for 
			// production code. You would hard code your own URL into your application
			// to allow customers to try another transaction.
			//TK//$againLink = URLDecode($_GET["AgainLink"]);
			
			
			$transStatus = "";
			if($hashValidated=="CORRECT" && $txnResponseCode=="0"){
//				$transStatus = "Giao dịch thành công";
				$row['payment_message'] = 'Giao dịch thành công';
				$row['status'] = 1;
				$model = $this -> model;
				$model -> _update($row,'fs_order','WHERE id = '.$vpc_MerchTxnRef);
				$link = FSRoute::_('index.php?module=products&view=cart&task=finished&id='.$vpc_MerchTxnRef);
				// gửi mail nếu thanh toán thành công
				$send_mail  = $model -> mail_to_buyer_after_successful($vpc_MerchTxnRef);
			}elseif ($hashValidated=="INVALID HASH" && $txnResponseCode=="0"){
				$transStatus = "Giao dịch Pendding";
			}else {
				$transStatus = "Giao dịch thất bại";
			}
			echo $this -> onepay_inter_get_msg_from_respond($txnResponseCode);
			// Không giao dịch thành công
		}
		
		/*
		 * Dùng cho onepay quốc tế
		 * Trả lại messesge từ repondcode trả về
		 */
		function onepay_inter_get_msg_from_respond($responseCode){
		    switch ($responseCode) {
		        case "0" :
		            $result = "Transaction Successful";
		            break;
		        case "?" :
		            $result = "Transaction status is unknown";
		            break;
		        case "1" :
		            $result = "Bank system reject";
		            break;
		        case "2" :
		            $result = "Bank Declined Transaction";
		            break;
		        case "3" :
		            $result = "No Reply from Bank";
		            break;
		        case "4" :
		            $result = "Expired Card";
		            break;
		        case "5" :
		            $result = "Insufficient funds";
		            break;
		        case "6" :
		            $result = "Error Communicating with Bank";
		            break;
		        case "7" :
		            $result = "Payment Server System Error";
		            break;
		        case "8" :
		            $result = "Transaction Type Not Supported";
		            break;
		        case "9" :
		            $result = "Bank declined transaction (Do not contact Bank)";
		            break;
		        case "A" :
		            $result = "Transaction Aborted";
		            break;
		        case "C" :
		            $result = "Transaction Cancelled";
		            break;
		        case "D" :
		            $result = "Deferred transaction has been received and is awaiting processing";
		            break;
		        case "F" :
		            $result = "3D Secure Authentication failed";
		            break;
		        case "I" :
		            $result = "Card Security Code verification failed";
		            break;
		        case "L" :
		            $result = "Shopping Transaction Locked (Please try the transaction again later)";
		            break;
		        case "N" :
		            $result = "Cardholder is not enrolled in Authentication scheme";
		            break;
		        case "P" :
		            $result = "Transaction has been received by the Payment Adaptor and is being processed";
		            break;
		        case "R" :
		            $result = "Transaction was not processed - Reached limit of retry attempts allowed";
		            break;
		        case "S" :
		            $result = "Duplicate SessionID (OrderInfo)";
		            break;
		        case "T" :
		            $result = "Address Verification Failed";
		            break;
		        case "U" :
		            $result = "Card Security Code Failed";
		            break;
		        case "V" :
		            $result = "Address Verification and Card Security Code Failed";
		            break;
				case "99" :
		            $result = "User Cancel";
		            break;
		        default  :
		            $result = "Unable to be determined";
		    }
		    return $result;
		}
		
		function finished() {
			$model = $this -> model;	
			$order = $model -> getOrderById();

			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>FSText::_('Thanh toán'), 1 => '');
			global $tmpl;	
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			
			if($order){
				$order_detail = $model -> get_orderdetail_by_orderId($order->id);
				
				$i = 0;
				$str_product_ids = '';
				foreach($order_detail as $item){
					if($i > 0)
							$str_product_ids .= ',';
					$str_product_ids .= $item -> product_id;	
					$i ++;
				}
				
				$products = $model -> get_products_from_orderdetail($str_product_ids);
				if(!$order_detail){
					echo FSText::_('Bạn hãy chọn mua sản phẩm');
					return;
				}

				include 'modules/'.$this->module.'/views/'.$this->view.'/finished/finished.php';
			} else {
				
				echo FSText::_('Bạn hãy chọn mua sản phẩm');
				return;
			}
		}
		
		function generate_step($step = 1){
			include 'modules/'.$this->module.'/views/'.$this->view.'/step.php';
		}
		function load_district(){
			$model = $this -> model;	
			$city_id = FSInput::get('city_id');
			$districts = $model -> get_records('city_id='.$city_id,'fs_districts');
			$html ='';
			$html .='<option>--Chọn Quận/Huyện--</option>';
			foreach ($districts as $item) {
				$html .='<option value="'.$item->id.'">'.$item->name.'</option>';
			}
			echo $html;
			return;
		}
	}
	
?>
