<?php
/*
 * Huy write
 */
	// controller
	
	class ProductsControllersCat extends FSControllers
	{
		var $module;
		var $view;
		
		// Hàm dùng để gọi form so sánh sản phẩm
		function direct_link(){
			$table_name = FSInput::get('table_name');
			$root_id = FSInput::get('root_id');
			if(isset($_SESSION[$table_name])){
				$list=$_SESSION[$table_name];
				$list_id="";
				$stt=0;
				foreach($list as $id){
					if(!empty($id)){
						$list_id=(isset($list_id) && !empty($list_id))?$list_id.'_'.$id:$id;
						$stt=$stt+1;
					}
				}
				if($stt < 2){
				}else{
					$link="&list=".$list_id;
					echo $link;
				}
				
			}else{
				print_r(0);
			}
			
		}
		function delete_all_compare(){
			$table_name = FSInput::get('table_name');
			unset($_SESSION[$table_name]);
			if(isset($_SESSION[$table_name])){
				print_r(1);
			}else{
				print_r(0);
			}
		}
		function del_product(){
			$id_product  = FSInput::get('id_product');
			$table_name = FSInput::get('table_name');
//			$pos = FSInput::get('pos');
			$compare=$_SESSION[$table_name];
			if(!isset($compare))
				return;
			$rs = array();
			foreach($compare as $key => $value){
				if($id_product == $value){
					continue;
				}
				$rs[$key] = $value;
			}
			$_SESSION[$table_name] = $rs;
			//print_r($_SESSION[$table_name]);
		}
		
		function created_session($limit = 3){
			$id_product  = FSInput::get('id_product');
			$table_name = FSInput::get('table_name');
			if(isset($_SESSION[$table_name])){
				$compare=$_SESSION[$table_name];
			}
//			else{
//				session_register($table_name);
//				$compare="";
//			}
			$stt=1;
			for($i=0;$i<$limit;$i++){
				if(empty($compare[$i])){
					$compare[$i]=$id_product;
					$positon=$i;
					break;
				}else{
					$stt=$stt+1;
				}
			}
			$_SESSION[$table_name] = $compare;
			if($stt > $limit){
				echo $stt;
			}else{
				echo $positon;
			}
		}
		function display()
		{
			// call models
			$model = $this -> model;
			$cat  = $model->get_category();
			if(!$cat){
				echo "Kh&#244;ng t&#236;m th&#7845;y Category";	
				die;
			}

			// select table: fs_products or fs_products_...(detail)
			
//			$table_type = $model -> select_table($cat);
//			$table_type  =1;// ionevn
			 $query_body = $model -> set_query_body($cat);
			$list = $model -> get_list($query_body,$cat -> tablename);
			$product_cmp= $model -> get_compare_product($cat->tablename);
			$total = $model -> getTotal($query_body);
//			
			$pagination = $model->getPagination($total);
			// Lấy loại 
			$types = $model -> get_types();
			
			$arr_order = array(
					array(null,'Sắp xếp theo'),
					array('gia-tang','Giá tăng dần'),
					array('gia-giam','Giá giảm dần'),
//					array('san-pham-cu','Cũ'),
//					array('san-pham-moi','Mới'),
					array('alpha','A -> Z'),
				);
//			$style  = FSInput::get('style'); 
			$sort = FSInput::get('order','new');
//			$link_list = FSRoute::addParameters('style','list');
//			$link_grid = FSRoute::addParameters('style','');
			// breadcrumbs
			$lis_cat_parent = $model -> get_list_parent($cat -> list_parents,$cat->id);
			$breadcrumbs = array();
			for($i = count($lis_cat_parent); $i > 0 ; $i --){
				$item = $lis_cat_parent[$i - 1];
				$breadcrumbs[] = array(0=>$item->name, 1 => FSRoute::_('index.php?module=products&view=cat&ccode='.$item->alias.'&Itemid=10'));
			}
			$breadcrumbs[] = array(0=>$cat->name, 1 => '');
			
			global $tmpl,$module_config;
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			// seo
			$tmpl -> set_data_seo($cat);
			
			// call views			
			include 'modules/'.$this->module.'/views/'.$this->view.'/default.php';
		}
	}
	
?>