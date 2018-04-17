<?php
/*
 * Huy write
 */
	// controller
	
	class ProductsControllersCompare extends FSControllers {
		function display()
		{
			$model = new ProductsModelsCompare();
			$ids = FSInput::get('id',0,'array');
			$ids = array_filter($ids);
			$str_ids = implode(',',$ids);
			$first_id = isset($ids[0])?$ids[0]:0;
			
			$first_item = $model -> get_product_by_id($first_id); 
			if(!$first_item){
//				echo "</p>Kh&#244;ng th&#7875; so s&#225;nh &#273;&#432;&#7907;c</p>";
//				return;
			}
			
			$tablename = isset($first_item->tablename)?$first_item->tablename:'';
			
//			$str_product_id = FSInput::get('list');
			
//			$cat_id = FSInput::get('cid');
//			$cat = $model->get_record_by_id($cat_id,'fs_products_categories','*');
			
//			$manu_fac = $model -> get_records('tablenames LIKE "%'.$cat->tablename.'%"','fs_manufactories');
//			$product_cmp= $model -> get_compare_product($cat->tablename);

//			$tablename = $cat->tablename;
//			if(!$str_product_id){
//				include 'modules/'.$this->module.'/views/'.$this->view.'/compare.php';	
//				return;
//			}
//			$query_body = $model->set_query_body($tablename);
//			$total = $model->getTotal($query_body);
//	       $str_ids = '';	
//			 if (isset ( $_SESSION [$tablename] )) {
//				$list_cmp_id = $_SESSION [$tablename];
//				$i = 0;
//				$str_ids = '';
//				foreach($list_cmp_id as $item){
//					$item = intval($item);
//					if($item){
//						if($i > 0)
//							$str_ids .= ',';
//						$str_ids .= $item;
//						$i ++;
//					}	
//				}
//			 }
//			 @$total_cpm = $i;
//			if(!$str_ids){
//				include 'modules/'.$this->module.'/views/'.$this->view.'/compare.php';	
//				return;
//			}
			// check compare
			//$tablename = $model -> check_compare($str_ids);
//			if(!$tablename){
//				echo "</p>Kh&#244;ng th&#7875; so s&#225;nh &#273;&#432;&#7907;c</p>";
//				return;
//			}
			// data in fs_product<br />
			
			$data  = $model -> getProducts($tablename,$str_ids);
			if(!$data){
//				echo "</p>Kh&#244;ng th&#7875; so s&#225;nh &#273;&#432;&#7907;c</p>";
//				return;
			}
			// manufactory
//			$first  = 0;
//			$str_ids = ''; 
//			for($i = 0; $i < count($data); $i ++){
//				
//				if($data[$i]->manufactory){
//					if($first != 0)
//						$str_ids .= ',';
//					
//					$str_ids .= $data[$i]->manufactory;
//					$first=1;
//				}
//			}
			
//			$manufactory_list = $model ->  get_manufactories($str_ids);
			
			// alias of root. This for image link
//			$cat_root_alias = $model ->  get_alias_parent_root($category -> rootid);
			
			// extension field
			$ext_fields = $model ->  get_ext_fields($tablename);
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
		
			
			// create breadcrumb
//			include 'modules/'.$this->module.'/models/'.'cat.php';
//			$model1 = new ProductsModelsCat();

			$title = 'So sánh';
			$i = 0;
			$records_id = ''; 
			$records_alias = ''; 
			if(count($data)){
				$title .= ' giữa ';
				foreach($data as $item){
					if($i){
						$title .= ' và ';
						$records_id .= ',';
						$records_alias .= '-va-';
					}
					$title .= $item -> name;
					$records_id .= $item -> record_id;
					$records_alias .= $item -> alias;
					$i ++; 
				}
			}
			global $tmpl,$module_config;
			$tmpl -> setMetakey($title); 
			$tmpl -> setMetades($title); 
			$tmpl -> setTitle($title); 
			
			$breadcrumbs[] = array(0=>'So sánh sản phẩm', 1 => '');
			
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			include 'modules/'.$this->module.'/views/'.$this->view.'/compare.php';
		}
		function get_data_foreign($table_name,$value,$type){
			$model = $this -> model;
			return $model -> get_data_foreign($table_name,$value,$type);
		}
		function delete_all_compare(){
			$model = $this -> model;
			$table_name = FSInput::get('table_name');
			$cid = FSInput::get('cid');
//			$cat= $model->get_record_by_id($cid,'fs_products_categories');
			unset($_SESSION[$table_name]);
			if(isset($_SESSION[$table_name])){
				print_r(1);
			}else{
//				$link = FSRoute::_("index.php?module=products&view=cat&ccode=".$cat->alias);
				$link = FSRoute::_("index.php?module=products&view=compare&cid=".$cid);
				setRedirect($link);
				
				return $table_name;
			}
		}
		
//		/*
//		 * search product
//		 */
//		function search(){
//			$model = new ProductsModelsCompare();
//			// category
//			$category = $model -> getCategory();
//			
//			// alias of root. This for image link
//			$cat_root_alias = $model ->  get_alias_parent_root($category -> rootid);
//			
//			$data  = $model -> search($category->id);
//			include 'modules/'.$this->module.'/views/'.$this->view.'/search.php';
//		}
//		
		function ajax_get_search_prd()
		{
			$table_name = FSInput::get('table_name');
			$model = $this -> model;	
			$cat = $model ->get_record('tablename ="'.$table_name.'"','fs_products_categories');
			$query_body = $model->set_query_body($table_name);
			$list_cmp = $model->get_list($query_body,$table_name);
			
			$types = $model -> get_types();
			$total = $model -> getTotal($query_body);
//			
			$pagination = $model->getPagination($total);
			
			include 'modules/'.$this->module.'/views/'.$this->view.'/fetch_search_pages.php';
			
			
			return;
		}
		function load_resultcompare()
		{
			include 'modules/'.$this->module.'/views/'.$this->view.'/compare_result.php';
			return;
		}
	}
	
?>