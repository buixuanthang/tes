<?php
/*
 * Huy write
 */
	// controller
	
	class ProductsControllersPromotion  extends FSControllers
	{
		var $module;
		var $view;
		function __construct()
		{
			parent::__construct ();
		}
		function display()
		{
			// call models
			$model = $this->model;
			$query_body = $model -> set_query_body();
			$list = $model -> get_list($query_body);

			
			$total= $model -> getTotal($query_body);
			$types = $model -> get_types();
			$load_more = $model->getLoadmore($total,count($list));
			
			
			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>'Khuyến mãi', 1 => '');
			global $tmpl,$module_config;
			
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			$tmpl -> set_seo_special();
			
			// call views			
			include 'modules/'.$this->module.'/views/'.$this->view.'/default.php';
		}
		function fetch_pages(){
			$pagecurrent = FSInput::get('pagecurrent',0,'int');
			// call models
			$model = $this -> model;
			
		
			$query_body = $model -> set_query_body();
			$total = $model -> getTotal($query_body);
			$types = $model -> get_types();
			$list = $model -> get_list($query_body);
			if(!$list)
				return ;
			
			$totalCurrent = $pagecurrent+ count($list);
			
			// Loại
			$arr_products=array();
	
			include 'modules/'.$this->module.'/views/'.$this->view.'/fetch_pages.php';
			$arr_products['content']= $html;
			if($totalCurrent < $total )
				$arr_products['next']= 'true';
			$arr_products['totalCurrent']=$totalCurrent;
			
			echo json_encode($arr_products);
			
			return ;
		}
	}
	
?>