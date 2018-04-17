<?php

class ProductsControllersProduct extends FSControllers {
	var $module;
	var $view;
	function __construct() {
		parent::__construct ();
		$arr_layout = array (array ('characteristic', 'Thông số kĩ thuật', 'thong-so-ki-thuat' ), array ('accessories', 'Phụ kiện', 'phu-kien' ) );
		$this->arr_layout = $arr_layout;
	}
	function display() {
		// call models

		$id = FSInput::get ( 'id' );

		$model = $this->model;
		$data = $model->get_product ();
		$amp = FSInput::get ( 'amp', 0, 'int' );
		if (! $data){
			setRedirect(FSRoute::_('index.php?module=notfound&view=notfound'),'Sản phẩm này không tồn tại');
		}
		$code = FSInput::get('code');
		$id = FSInput::get('id',0,'int');
		if($code != $data-> alias  || $id != $data-> id ){
			
			$link = FSRoute::_("index.php?module=products&view=product&code=".trim($data->alias)."&id=".$data -> id."&ccode=".trim($data-> category_alias)."&Itemid=$Itemid");
			setRedirect($link);
		}
		$total_compare=0;
		if($data -> is_hotdeal){
			if($data -> date_end >  date('Y-m-d H:i:s') && $data->date_start <  date('Y-m-d H:i:s')){
				$price = $data->price;
				$price_old = $data->price_old;
			}else{
				$price = $data->price_old;
				$price_old = '';
			}
		}else{
			$price= $data->price;
			$price_old = $data->price_old;
		}
		if(isset($_SESSION[$data->tablename])) {
			$arr_prd_compare = $_SESSION[$data->tablename];
			$total_compare =count($arr_prd_compare);
		}
		$cat = $model->getCategoryById ( $data->category_id );
		if (! $cat){
			setRedirect(FSRoute::_('index.php?module=notfound&view=notfound'),'Danh mục này không tồn tại');
		}
		$ccode = FSInput::get ( 'ccode' );
		if ($cat->alias != $ccode) {
			$Itemid = 6;
			$link = FSRoute::_ ( 'index.php?module=products&view=product&code=' . $data->alias . '&id=' . $data->id . '&ccode=' . $cat->alias . '&Itemid=' . $Itemid );
			setRedirect ( $link );
		}
		$extend = $model->getProductExt ( $data->tablename, $data->id );
	
		// extension field
		$ext_fields = $model->get_ext_fields ( $cat->tablename );
//		$data_foreign = $model -> get_data_foreign($ext_fields );
		$str_group_fields = '';
		$arr_ext_fileds_by_group = array();
		if(count($ext_fields)){
			$i = 0;
			foreach($ext_fields as $item){
				if($item -> group_id){
					if($i > 0)
						$str_group_fields .= ',';
					$str_group_fields .= $item -> group_id;
					$i ++; 
					if(!isset($arr_ext_fileds_by_group[$item -> group_id]))
						$arr_ext_fileds_by_group[$item -> group_id] = array();
					$arr_ext_fileds_by_group[$item -> group_id][] = $item;
				}else{
					if(!isset($arr_ext_fileds_by_group[0]))
						$arr_ext_fileds_by_group[0] = array();
					$arr_ext_fileds_by_group[0][] = $item;
				}
			}
		}
		$ext_group_fields = $model ->  get_ext_group_fields($str_group_fields);
		$ccode = FSInput::get ( 'ccode' );
		

		


		$description = $model->insert_keyword_to_content ( $data->description );
		if(!$amp){
			$description = str_replace('<iframe','<div class="video_wrapper" ><iframe',$description);
            $description = str_replace('</iframe>','</iframe></div>',$description);
		}

		// seo
		global $tmpl, $module_config;
		
		
		// param from config_module
		FSFactory::include_class ( 'parameters' );
		$current_parameters = new Parameters ( $module_config->params );
		$tabs = $current_parameters->getParams('tabs');
		$limit = $current_parameters->getParams ( 'limit' );
		$use_model = $current_parameters->getParams ( 'use_model' );
		$use_configuration = $current_parameters->getParams ( 'use_configuration' );
		$use_price = $current_parameters->getParams ( 'use_price' );
		$this->limit = $limit;
		$image_small_size = $current_parameters->getParams ( 'image_small_size' );
		$image_small_width = $this->get_dimension ( $image_small_size, 'width' );
		$image_small_height = $this->get_dimension ( $image_small_size, 'height' );
		
		$product_images = $model->getImages ( $data->id );
		
		
		//Lấy dữ liệu theo  màu 
		$price_by_color= $model->get_price_by_colors ( $data->id );

		//Lấy dữ liệu theo  màu 
		// $images_plus = $model->get_images_plus ( $data->id );
		//Lấy dữ liệu theo bộ nhớ
		// $price_by_memory = $model->get_records( 'record_id='.$data->id,'fs_memory_price','*' );

		// $price_by_usage_states = $model->get_records( 'record_id='.$data->id,'fs_usage_states_price','*' );

		// $price_by_warranty = $model->get_records( 'record_id='.$data->id,'fs_warranty_price','*' );
		
		// $price_by_origin = $model->get_records( 'record_id='.$data->id,'fs_origin_price','*' );

		// $price_by_species = $model->get_records( 'record_id='.$data->id,'fs_species_price','*' );

		$relate_news = $model->get_relate_news ( $data->news_related );
		
		if(!$relate_news){
			//	lấy  danh sách  tin tức liên quan theo tag
			$relate_news = $model->get_news_relate_tags ( $data->tags ,'fs_news');
		}		
		if(!$relate_news){
			//	lấy  danh sách  tin tức liên quan theo tag
			$relate_news = $model->get_newsest ();
		}
		
		// products in cat
		$products_in_cat = $model->get_products_in_cat ( $data->category_id, $data->id );
		
		// products in manufactory
		$products_in_manufactory = $model->get_products_in_manufactory ( $data->category_id,$data->manufactory, $data->id );
		
		// sản phẩm gợi ý ( lấy từ database)
		$relate_products_list = $model->get_products_related ( $data->products_related, $data->id );

		// sản phẩm có cấu hình tương đương
		// $products_same_config = $model -> get_products_same_config ( $data->tablename, $ext_fields,$extend, $data , 8 );
		
		
		// sản phẩm cùng khoảng giá
		$products_same_price = $model->get_products_same_price ( $data->id, $data->price );
		
		//			$total_relative  = count($relate_products_list);
		$types = $model->get_types ();
		// get compatable products 
		$array_products_compatable  = $model -> get_products_by_ids($data -> products_compatable);

		$array_products_service  = $model -> get_products_by_ids($data -> products_service);
		
		// get from table fs_product_incentives
		$products_incentives = $model -> get_products_incentives($data -> id);
		// get from table fs_product to support display incentives products 
		$array_products_incentives = $model -> get_products_by_ids($data -> products_incentives);
		// get products from products_shops
		// comments
//		$comments = $model-> get_comments($data -> id);
		
		$session_order = $model -> getOrder();
		$user = $model -> get_user();
		//input info
		$sender_name = isset($session_order-> sender_name)?$session_order-> sender_name:@$user->full_name;
		$sender_sex = isset($session_order->sender_sex)?$session_order->sender_sex:@$user -> sex;
		$sender_address = isset($session_order->sender_address)?$session_order->sender_address:@$user -> address;
		$sender_email = isset($session_order->sender_email)?$session_order->sender_email:@$user -> email;
		$sender_telephone = isset($session_order->sender_telephone)?$session_order->sender_telephone:@$user -> mobilephone;
		$discount_code = isset($session_order->discount_code)?$session_order->discount_code:'';
		
//		$link = FSRoute::_('index.php?module=products&view=product&code='.$data -> alias.'&id='.$item -> id.'&ccode='.$cat->alias.'&Itemid='.$Itemid);
// 		breadcrumbs
//		$lis_cat_parent = $model->get_list_parent ( $data->category_id_wrapper );
		$breadcrumbs = array ();
//		for($i = 0; $i < count ( $lis_cat_parent ); $i ++) {
//			$item = $lis_cat_parent [$i];
//			$breadcrumbs [] = array (0 => $item->name, 1 => FSRoute::_ ( 'index.php?module=products&view=cat&ccode=' . $item->alias . '&Itemid=10' ) );
//		}

		$breadcrumbs[] = array(0=>$cat -> name, 1 => FSRoute::_('index.php?module=products&view=cat&cid='.$data -> category_id.'&ccode='.$data -> category_alias));

		$filter_manu = $model -> get_filter_menu($data->manufactory, $data->tablename);
		if($filter_manu){
			$breadcrumbs[] = array(0=>$data->manufactory_name, 1 => FSRoute::_('index.php?module=products&view=cat&cid='.$data -> category_id.'&ccode='.$data -> category_alias.'&filter='.$filter_manu->alias));
		}
//		$breadcrumbs[] = array(0=>$data->name, 1 => '');	
		global $tmpl;
		$tmpl->assign ( 'breadcrumbs', $breadcrumbs );
		$new_products_right = $model->get_list_new_product();
		$hot_products_right = $model->get_list_hot_product();

		$orders =  $model -> get_orders();
		
		
		$this->set_header ( $data );
		$tmpl->set_data_seo ( $data );
		
		// call views
//		if($data -> landingpage){
//			include 'modules/' . $this->module . '/views/' . $this->view . '/landingpage/'.$data -> landingpage.'/default.php';	
//		}else{
		include 'modules/' . $this->module . '/views/' . $this->view.($amp?'_amp':'') . '/default.php';
//		}
		
	}
	
//	/* Save comment */
//	function save_comment() {
//		$return = FSInput::get ( 'return' );
//		$url = base64_decode ( $return );
//		$is_ajax = FSInput::get ( 'ajax' );
//		if(!$is_ajax) $is_ajax = 0;
//		if(!$is_ajax) {
//			if (! $this->check_captcha ()) {
//				$msg = 'Mã hiển thị không đúng';
//				setRedirect ( $url, $msg, 'error' );
//			}
//			$model = $this->model;
//			if (! $model->save_comment ()) {
//				$msg = 'Chưa lưu thành công comment!';
//				setRedirect ( $url, $msg, 'error' );
//			} else {
//				setRedirect ( $url, 'Cảm ơn bạn đã gửi comment' );
//			}
//		}
//		else { 
//			$model = $this->model;
//			$name = FSInput::get('name');
//			$email = FSInput::get('email');
//			$text = FSInput::get('text');
//			$record_id = FSInput::get('record_id',0,'int');
//			$parent_id = FSInput::get('parent_id',0,'int');
//			$time = date('d/m/Y H:i');
//			$success = 0;
//			if (! $model->save_comment ()) {
//				$msg = 'Chưa lưu thành công comment!'; 
//			} else {
//				$msg = 'Cảm ơn bạn đã gửi comment' ;
//				$success = 1;
//			}
//			$return_arr = array(
//				"parent_id"=>$parent_id, 
//				"record_id"=>$record_id, 
//				"msg"=>$msg,
//				"save_time"=>$time,
//				"name"=>$name,
//				"textContent"=>$text,
//				"success" => $success 
//			);
//			echo json_encode($return_arr);
//			exit;
//		}
//	}
//	/* Save comment reply*/
//	function save_reply() {
//		$return = FSInput::get ( 'return' );
//		$is_ajax = FSInput::get ( 'ajax' );
//		if(!$is_ajax) $is_ajax = 0;
//		if(!$is_ajax) {
//			$url = base64_decode ( $return );
//			
//			$model = $this->model;
//			if (! $model->save_comment ()) {
//				$msg = 'Chưa lưu thành công comment!';
//				setRedirect ( $url, $msg, 'error' );
//			} else {
//				setRedirect ( $url, 'Cảm ơn bạn đã gửi comment' );
//			}
//		}
//		else { 
//			$model = $this->model;
//			$name = FSInput::get('name');
//			$email = FSInput::get('email');
//			$text = FSInput::get('text');
//			$record_id = FSInput::get('record_id',0,'int');
//			$parent_id = FSInput::get('parent_id',0,'int');
//			$time = date('d/m/Y H:i');
//			$success = 0;
//			if (! $model->save_comment ()) {
//				$msg = 'Chưa lưu thành công comment!'; 
//			} else {
//				$msg = 'Cảm ơn bạn đã gửi comment' ;
//				$success = 1;
//			}
//			$return_arr = array(
//				"parent_id"=>$parent_id, 
//				"record_id"=>$record_id, 
//				"msg"=>$msg,
//				"save_time"=>$time,
//				"name"=>$name,
//				"textContent"=>$text,
//				"success" => $success 
//			);
//			echo json_encode($return_arr);
//			exit;
//		}
//	}
/* Save comment */
	
	function show_layout($link_image_remote) {
		$layout = FSInput::get ( 'layout', 'thong-so-ki-thuat' );
		$arr_layout = $this->arr_layout;
		$Itemid = FSInput::get ( 'Itemid' );
		$id = FSInput::get ( 'id' );
		foreach ( $arr_layout as $item ) {
			//				$link  = FSRoute::_("index.php?module=products&view=product&id=$id&layout=$item[2]&Itemid=$Itemid"); 
			$link = FSRoute::addParameters ( 'layout', $item [2] );
			if ($layout == $item [2]) {
				echo "<li class='prd_cat_current'> <span>&nbsp; </span> <a  href='" . $link . "' ><span>" . $item [1] . "</span></a>";
			} else {
				echo "<li class='prd_cat_menu'><span>&nbsp; </span><a  href='" . $link . "' ><span>" . $item [1] . "</span></a>";
			}
		}
		echo "<li class='prd_cat_menu'><span>&nbsp; </span><a  href='" . $link_image_remote . "' target='_blink' ><span>" . 'Ảnh' . "</span></a>";
	}
	
	// check captcha
	function check_captcha() {
		$captcha = FSInput::get ( 'txtCaptcha' );
		
		if ($captcha == $_SESSION ["security_code"]) {
			return true;
		} else {
		}
		return false;
	}
	function get_layout() {
		$arr_layout = $this->arr_layout;
		$layout = FSInput::get ( 'layout', 'thong-so-ki-thuat' );
		foreach ( $arr_layout as $item ) {
			if ($layout == $item [2]) {
				return $item [0];
			}
		}
		return $arr_layout [0] [0];
	}
	
	/*
		 * Save rating
		 */
	function rating() {
		$model = $this->model;
		if (! $model->save_rating ()) {
			echo '0';
			return;
		} else {
			echo '1';
			return;
		}
	}

	function get_dimension($size, $dimension = 'width') {
		if (! $size)
			return 0;
		$array = explode ( 'x', $size );
		if ($dimension == 'width') {
			return (intval ( @$array [0] ));
		} else {
			return (intval ( @$array [1] ));
		}
	}
	function ajax_compare() {
		$limit = 3;
		$id = FSInput::get('id',0,'int');
		$table_name = 'fs_products_'.FSInput::get('table_name');
		if(!$id || !$table_name){
			echo '';
			return;
		}
		if(isset($_SESSION[$table_name])){
			$compare=$_SESSION[$table_name];
		}else{
			$compare[0]=$id;
			$_SESSION[$table_name] = $compare;
			echo '';
			return;
		}
		// kiểm tra trùng lặp
		$is_duplicate = 0;
		foreach($compare as $pos => $record_id){
			if($id == $record_id){
				$is_duplicate = 1;
			}
		}
		// nếu ko trùng lặp
		if(!$is_duplicate){
			$stt=1;
			if((count($compare) + 1) >= $limit){
				$compare[0]=$id;
			}else{
				for($i=0;$i<$limit;$i++){
					if(empty($compare[$i])){
						$compare[$i]=$id;
						$positon=$i;
						break;
					}else{
						$stt=$stt+1;
					}
				}
			}
			$_SESSION[$table_name] = $compare;
		}
		if(count($compare) <= 1){
			echo '';
			return;
		}
		$str_list_id = '';
		foreach($compare as $pos => $record_id){
			if($str_list_id)
				$str_list_id .= '_';
			$str_list_id .= $record_id; 
		}
		
		echo '/so-sanh-san-pham.html&list='.$str_list_id;
		return;
	}
	// update hits
		function update_hits(){
			$model = new ProductsModelsProduct();
			$product_id = FSInput::get('id');
			$model -> update_hits($product_id);
		}
	
		function get_data_foreign($table_name,$value,$type){
			$model = $this -> model;
			return $model -> get_data_foreign($table_name,$value,$type);
		}

	
		function fetch_quantity_product_by_color(){
			$model = $this -> model;	
			$location = FSInput::get ( 'location' );
			$location = ($location)?$location:'sl_hn';
			$rid = FSInput::get ( 'rid' );	
			$color_id= FSInput::get ( 'color_id' );	
			$price_by_color = $model->get_price_by_colors ($rid);
	 		$quantity = 0;
	   		foreach ($price_by_color as $item){
	   			if($item->color_id == $color_id)
	   				$quantity += $item->$location;
	   		}
	   		$total = $quantity;
   			if($total == 0){
   				echo 'Hết hàng';
   			}elseif ($total > 0 && $total <= 3) {
   				echo 'Còn ít hàng';
   			}else {
   				echo 'Còn hàng';
   			}
   			
			return;
		
		}
		function buy(){
			$product_id = FSInput::get('id',0,'int'); // product_id

			$color_modal = FSInput::get('color_id');
			$color_id_exp = explode('_', $color_modal );
			$color_id     = @$color_id_exp[1];

			$memory_modal =  FSInput::get('memory_id');
			$memory_id_exp= explode('_', $memory_modal );
			$memory_id    = @$memory_id_exp[1];
		
			$usage_states_modal =  FSInput::get('usage_states_id');
			$usage_states_id_exp= explode('_', $usage_states_modal );
			$usage_states_id    = @$usage_states_id_exp[1];

			$warranty_modal= FSInput::get('warranty_id');
			$warranty_id_exp= explode('_', $warranty_modal );
			$warranty_id    = @$warranty_id_exp[1];


			FSFactory::include_class('errors');
			if(!$product_id)
				Errors::_('Sản phẩm chưa xác định');
				$model = $this -> model;	
				
			if(!isset($_SESSION['cart'])) {
				$product_list = array();
				
				$prices = $model -> getPrice();
				if($prices == '-1'){
					Errors::_("Không tồn tại sản phẩm trong giỏ hàng",'error');
					return;
				}
				$product_list[] = array($product_id,$prices[0],1,$color_id,$memory_id,$warranty_id,$usage_states_id);
				
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
					$product_list[count($product_list)] = array($product_id,$prices[0],1,$color_id,$memory_id,$warranty_id,$usage_states_id);
				}
			}
			
			$_SESSION['cart']  = $product_list  ;
				
				
			$html ='';
		    $html .=' <div class="modal-dialog">';
		             $html .=' <div class="modal-content">';
		                  $html .='<div class="modal-header">';
		                      $html .='<h4 class="modal-title"><span>Thêm vào giỏ hàng</span></h4>';
		                 $html .=' </div>';
		                  $html .='<div class="modal-body">';
		                  	if(!isset($_SESSION['cart'])) {
		                    	$html .=' <div class="check-square-no mt10"><strong>Sản phẩm chưa thêm vào giỏ hàng</strong></div>';
		                  	}else{
		                  		$html .=' <div class="check-square mt10"><strong>Sản phẩm đã thêm vào giỏ hàng</strong></div>';
		                  	}
		                $html .='  </div>';
		                 $html .=' <div class="modal-footer">';
		                     $html .=' <button type="button" class="btn btn-default" data-dismiss="modal">Xem tiếp sản phẩm</button>';
		                     $html .=' <a  href="'. FSRoute::_("index.php?module=products&view=cart&task=eshopcart2").'" class="btn btn-default">Giỏ hàng của bạn</a>';
		                 $html .=' </div>';
		              $html .='</div>';
		          $html .='</div>';
		     $html .=' </div>';
			echo $html;
			return;
		}		
		function load_price_by_dcare(){
			$value = FSInput::get('value');
			$model = $this->model;
			$data = $model->get_product ();
			$req_region = FSInput::get ('price_region');
			$req_color = FSInput::get ('price_color');	
			if (! $data)
				return;
			if($data -> is_hotdeal){
				if($data -> date_end >  date('Y-m-d H:i:s') && $data->date_start <  date('Y-m-d H:i:s'))
					$price = $data->price;
				else
					$price = $data->price_old;
			}else{
				$price= $data->price;
			}
			$rs ='';
			if($value == 3){
				$rs .=$price+300000;
				$price_dcare =300000;
			}else if($value == 0){
				$rs .= $price;
				$price_dcare =0;
			}
			$rs = $rs+$req_region+ $req_color;
		    echo json_encode(array('price'=>"<span>". format_money($rs,'đ')."</span>",'price_dcare'=>$price_dcare));
		    return;
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
//				$send_mail  = $model -> mail_to_buyer_simple($order_id);
				$link = FSRoute::_('index.php?module=products&view=cart&task=finished&id='.$order_id.'&Itemid='.$Itemid);
				setRedirect($link,'Đơn hàng của bạn đã được gửi đi. Chúng tôi sẽ liên lạc với bạn trong thời gian sớm nhất. Xin cảm ơn!');
			} else {
				$link = FSRoute::_('index.php?module=products&view=cart&task=order&Itemid='.$Itemid);
				setRedirect($link);
			}
		}

		function show_image(){
			$model = $this -> model;	
			$id = FSInput::get('id',0,'int');
			$data = $model->get_product ();
			$product_images =  $model->getImages ($id);
			$array1 = array("0" => $data);
			$result = array_merge($array1, $product_images);
			$total =count($result);
			$i=0;
			$html ='';
			$html .=' <div class="modal-dialog">';
		        $html .=' <div class="modal-content">';
		        	$html .='<div class="modal-header">';
		        		$html .='<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&nbsp;</button>';
	                $html .=' </div>';
	   				 $html .=' <div id="myCarouselPrd" class="carousel slide">';
	                     $html .=' <div class="carousel-inner">';
	                    	foreach($product_images as $item){	
	                    		$class ='';
	                    		if($i==0){
	                    			$class = 'active';
	                    		}
					        	 $html .='<div class="item '.$class.'">';
				 					$html .='<img src="'.URL_ROOT.str_replace('/original/','/large/', $item -> image).'" class="img-responsive" >';
	                           	 $html .='</div>';
	                           	 $i++;
							} 
	                    $html .='</div>';
	                    $html .='<a class="carousel-control left" href="#myCarouselPrd" data-slide="prev"> </a>';
	                    $html .='<a class="carousel-control right" href="#myCarouselPrd" data-slide="next"></a>';
	                 
	                $html .='</div>';
	          
		        $html .='</div>';
		    $html .='</div>';
		  
		    echo $html;
			return;

		}
		
			/*
		 * Tạo ra các tham số header ( cho fb)
		 */
	function set_header($data, $image_first = '') {
		global $config;
		$link = FSRoute::_ ( "index.php?module=products&view=product&id=" . $data->id . "&code=" . $data->alias . "&ccode=" . $data->category_alias."&cid=" . $data->category_id );
		$image = URL_ROOT . str_replace ( '/original/', '/large/', $data->image );
		$str = '<meta property="og:image"  content="' . $image . '" />
				<meta property="og:image:width" content="600 "/>
				<meta property="og:image:height" content="315"/>
			';
		$amp = FSInput::get('amp',0,'int');
		if(!$amp){
			$str .= '<link rel="amphtml" href="'.str_replace('.html','.amp',$link).'">';
		}else{
			$str .= '
			<script async custom-element="amp-facebook-comments" src="https://cdn.ampproject.org/v0/amp-facebook-comments-0.1.js"></script>
			<script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"></script>
			<script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
			<script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.1.js"></script>
			';

		}
		// $str .= '<meta property="og:description"  content="' . htmlspecialchars ( $data->summary ) . '" />';

		$rating_value = $data -> rating_count ? round($data -> rating_sum /$data -> rating_count): 4 ;
		$rating_count = $data -> rating_count?$data -> rating_count:1; 


		$str .= '		
			<script type="application/ld+json">
			{
			    "@context": "http://schema.org/",
			    "@type": "Product",
			    "name": "'.htmlspecialchars ( $data->name ).'",
			    "image": "' . $image . '",
			    "description": "' . htmlspecialchars ( $data->summary ) . '",
			    "mpn": "' . $data -> id . '",
			    "brand": {
			        "@type": "' . htmlspecialchars ( $data->category_name ) . '",
			        "name": "' . ( $data->manufactory_name ? htmlspecialchars ( $data->manufactory_name ):htmlspecialchars ( $data->summary ) ). '"
			    },
			    "aggregateRating": {
			        "@type": "AggregateRating",
			        "ratingValue": "'.$rating_value.'",
			        "reviewCount": "'.$rating_count.'"
			    },
			    "offers": {
			        "@type": "Offer",
			        "priceCurrency": "VND",
			        "price": "'.$data -> price.'",
			        "priceValidUntil": "2020-11-05",
			        "itemCondition": "http://schema.org/UsedCondition",
			        "availability": "http://schema.org/InStock",
			        "seller": {
			            "@type": "Retail",
			            "name": "'.URL_ROOT.'"
			        }
			    }
			}

			</script>';

		
		global $tmpl;
		$tmpl->addHeader ( $str );
	}

	function standart_content_amp($description){
		 $description = preg_replace ( '#style\=\"(.*?)\"#is', '', $description );
            $description = preg_replace ( '#style\=\'(.*?)\'#is', '', $description );
            $description = preg_replace ( '#<style>(.*?)</style>#is', '', $description );
            $description = preg_replace ( '#layout\=\"(.*?)\"#is', '', $description );
            $description = preg_replace ( '# h\=\"(.*?)\"#is', '', $description );
            $description = preg_replace ( '# w\=\"(.*?)\"#is', '', $description );
            $description = preg_replace ( '#photoid\=\"(.*?)\"#is', '', $description );
            $description = preg_replace ( '#rel\=\"(.*?)\"#is', '', $description );
            $description = preg_replace ( '#type\=\"(.*?)\"#is', '', $description );
            
            
          
            $description = preg_replace ( '#onclick\=\"(.*?)\"#is', '', $description );
            $description = preg_replace ( '#onclick\=\'(.*?)\'#is', '', $description );
            $description = preg_replace ( '#onmouseover\=\"(.*?)\"#is', '', $description );
            $description = preg_replace ( '#onmouseover\=\'(.*?)\'#is', '', $description );
            
            $description = str_replace('<font','<span',$description);
            $description = str_replace('</font','</span',$description);

            $description = $this -> amp_add_size_into_img($description);
            $description = str_replace('<img','<amp-img  layout="responsive"',$description);
            $description = str_replace('</img','</amp-img',$description);
            
            $description = str_replace('<iframe','<amp-iframe layout="responsive" sandbox="allow-scripts allow-same-origin allow-popups" ',$description);
            $description = str_replace('</iframe','</amp-iframe',$description);
            return $description;
	}
	function amp_add_size_into_img($content){
		preg_match_all('#<img(.*?)>#is',$content,$images);
		$arr_images = array();
		if(!count($images[0]))
			return $content;
		$i = 0;
		foreach($images[0] as $item){			
						
			unset($height);
			preg_match('#height([\s]*)=([\s]*)[\'|\"](.*?)[\'|\"]#is',$item,$height);
			
			if(!isset($height[3])){
				$item_new = str_replace('<img','<img height="400" ', $item);
				// $content = str_replace($item,$item_new, $content);
			}elseif(!$height[3]){
				$item_new = preg_replace('%height([\s]*)=([\s]*)[\'|\"](.*?)[\'|\"]%i', 'height="402"', $item);

				// $content = str_replace($item,$item_new, $content);
			}else{
				$item_new = $item;
				// $content = str_replace($item,$item_new, $content);
			}
			
			unset($width);
			preg_match('#width([\s]*)=([\s]*)[\'|\"](.*?)[\'|\"]#is',$item_new,$width);
			if(!isset($width[3])){
				$item_new_2 = str_replace('<img','<img width="600" ', $item_new);
				// $content = str_replace($item_new,$item_new_2, $content);
			}elseif(!$width[3]){
				$item_new_2 = preg_replace('%width([\s]*)=([\s]*)[\'|\"](.*?)[\'|\"]%i', 'width="602"', $item_new);
				// $content = str_replace($item_new,$item_new_2, $content);
			}else{
				$item_new_2 = preg_replace('%width([\s]*)=([\s]*)[\'|\"](.*?)[\'|\"]%i', 'width="601"', $item_new);
				// $content = str_replace($item_new,$item_new_2, $content);
			}
			
			if($item != $item_new_2){
				$content = str_replace($item,$item_new_2, $content);
			}
			
			
		}

		return $content;	
	}

	/* Chuyển từ textarea sang dạng có dòng trong thẻ <p></p> */
	function breakline_summary($summary){
		 
		if(strpos( $summary,'<p') === false){ 
	    	$summary = nl2br(trim($summary));
	    	$summary = '<p>'.$summary.'</p>';
	    }
		$summary = str_replace(array("<br>","<br/>","<br />"),'</p><p>', $summary);
		$summary = str_replace(array("<p>&nbsp;</p>\n","<p></p>","<p>&nbsp;</p>", "&nbsp;<br />\n"), array('', ''), $summary);
		$summary = preg_replace('%<p>[\s]*[\n]*\-%i', '<p>', $summary);
			
		return $summary;
	}
	
}

?>
 