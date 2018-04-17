<?php
/*
 * Huy write
 */
	// controller
	class HomeControllersHome extends FSControllers
	{
		var $module;
		var $view;
		function display()
		{

			// call models
			$model = $this -> model;

			


			
			// trường hợp đb cho iphone
			$cat_special = $model -> get_cat_special();
			if($cat_special){
				$sub_cats_special = $model -> get_sub_cats_special($cat_special -> id);
				$query_body = $model->set_query_body($cat_special -> id ,'');
				$products_special = $model->get_list($query_body);
			}
			$cat_special_id = isset($cat_special->id)?$cat_special->id:0;
			
			// cat list
			$list_cats = $model -> get_cats();
			

			$array_menu = array (array ('moi-nhat', 'Sản phẩm mới' ),array ('ban-chay-nhat', 'Bán chạy' ),
					array ('gia-thap-nhat', 'Giá rẻ nhất' )
					);


			
			$array_cats = array();
			$array_products = array();
			$array_manf = array();
			$i = 0;
			foreach (@$list_cats as $item)
			{
				$query_body = $model->set_query_body($item->id ,'',$cat_special_id);
				$products_in_cat = $model->get_list($query_body);
				$manf_by_cat = $model -> get_manufactory($item -> tablename, $item -> is_special == 2?1:0 );
				if(count($products_in_cat)){
					$array_cats[] = $item;
					$array_manf[$item->id] = $manf_by_cat;
					$array_products[$item->id] = $products_in_cat;	
					$i ++;
				}
			}
			$types = $model -> get_types();

			// Đưa filter vào thanh bar			
			$filter_all_list = $model -> get_filters_home();

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

			$filter_manufactories_list = $model -> get_filters_manufactories();
			$arr_filter_manufacrories = array();
			if(count($filter_manufactories_list)){
				foreach($filter_manufactories_list as $filter){
					if(!isset($arr_filter_manufacrories[$filter -> tablename]))
						$arr_filter_manufacrories[$filter -> tablename] = array();
					// if(!isset($arr_filter_manufacrories[$filter -> tablename]))
					// 	$arr_filter_manufacrories[$filter -> tablename] = array();
					$arr_filter_manufacrories[$filter -> tablename][] = $filter;
				}
			}
			
						// call views			
			include 'modules/'.$this->module.'/views/'.$this->view.'/thosuadidong.php';
		}
			function fetch_pages()
		{
			$model = $this -> model;		
			$cat_id =FSInput::get('cat_id');
			$manf_id =FSInput::get('manf_id');
			$query_body = $model->set_query_body($cat_id,$manf_id);
			//die($query_body );
			$list = $model->get_list($query_body);
			$types = $model -> get_types();
			include 'modules/'.$this->module.'/views/'.$this->view.'/fetch_pages.php';
			return;
		}

	
	}
	
?>