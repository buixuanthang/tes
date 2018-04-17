<?php
/*
 * Huy write
 */
	// controller
	
	class ProductsControllersHotdeal  extends FSControllers
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
			$model = $this -> model;
			
			$query_body = $model -> set_query_body();
			$list = $model -> get_list($query_body);
			
			$total = $model->getTotal($query_body);
			$pagination = $model->getPagination($total);
			$types = $model->get_types ();
			
			$title = 'Khuyến mại';
			// breadcrumbs
			$breadcrumbs = array();
			$breadcrumbs [] = array (0 => $title, 1 => '' );
			
			global $tmpl,$module_config;
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			// seo
			$tmpl -> set_seo_special();
			include 'modules/'.$this->module.'/views/'.$this->view.'/default.php';
			
		}
		
	}
	
?>