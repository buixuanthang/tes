<?php
/*
 * Huy write
 */
	// models 
	include 'blocks/product_menu/models/product_menu.php';
	
	class Product_menuBControllersProduct_menu 
	{
		function __construct()
		{
		}
		function display($parameters,$title)
		{
			$style = $parameters->getParams('style');
			$style = $style ? $style : 'default';
	
			// call models
			$model = new Product_menuBModelsProduct_menu();
			$list = $model->getListCat($style);
			if(!$list)
				return;
			if($style == 'drop_down' || $style =='drop_down_right' || $style == 'amp'){
				// add filter cứng vào website
			
				$level_0 = array();
				$children = array();
				$arr_activated = array();
				foreach ($list as $item) {
					$arr_activated[$item->id] = 0;
					if(!$item -> parent_id){
						$level_0[] = $item;
					}else{
						if(!isset($children[$item -> parent_id]))
							$children[$item -> parent_id] = array();
						$children[$item -> parent_id][] = $item;
					}
				}
				// Lấy từ bảng products_filter
				$filter_all_list = $model -> get_filter_all();
				// mảng filter theo cat_id, field dạng array([table_name][field][array: filters])
				$arr_filter_by_field = array();
				if(count($filter_all_list)){
					foreach($filter_all_list as $filter){
						if(!isset($arr_filter_by_field[$filter -> tablename]))
							$arr_filter_by_field[$filter -> tablename] = array();
						if(!isset($arr_filter_by_field[$filter -> tablename][$filter -> field_name]))
							$arr_filter_by_field[$filter -> tablename][$filter -> field_name] = array();
						$arr_filter_by_field[$filter -> tablename][$filter -> field_name][] = $filter;
					}
				}
			}else{
				// need_chek
				$module = FSInput::get('module');		
				$need_check = 0;
				$root_parrent_activated = 0;
				// lấy các category thuộc nhóm được activate, cả tree activated 
				$group_has_parent_activated = array();
			
				// thực hiện việc đưa danh mục activated lên đầu
				if($module == 'products'){
				$ccode = FSInput::get('ccode');
					foreach ( $list as $item ){
						if($item->alias ==  $ccode){
							if($item -> level > 0 ){
								$root_parrent_activated = 	$item -> parent_id;
								$group_has_parent_activated[] = $item -> id;
								$group_has_parent_activated[] = $item -> parent_id;
								$level_current = $item -> level;
							    
								// Lấy tree có độ sâu > 2
								while($level_current > 1){
									foreach ( $list as $item_child ){
										if($item_child -> id  == $root_parrent_activated ){
											$group_has_parent_activated[] = $item_child -> id;
											$group_has_parent_activated[] = $item_child -> parent_id;
											break;
										}
									}
									$level_current --;
								}
							}else{
								$root_parrent_activated = 	$item -> id;
								$group_has_parent_activated[] = $item -> id;
								$group_has_parent_activated[] = $item -> parent_id;
							}
							break;
						}
					}
				}
			}
			// call views
			include 'blocks/product_menu/views/product_menu/'.$style.'.php';
		}
		
		function get_filters_has_calculate($cat){
			$model = new Product_menuBModelsProduct_menu();
			return $list = $model->get_filters_has_calculate($cat);
		}
	}
	
?>