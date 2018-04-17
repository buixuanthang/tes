<?php
/*
 * Huy write
 * History of order product
 */
	// controller
	
	class ProductsControllersBought extends FSControllers
	{
		var $module;
		var $view;
		function __construct()
		{
			parent::__construct();
		}
		function display()
		{
		
			
			$link = FSRoute::_('index.php?module=notfound&view=notfound&Itemid=1000');
			setRedirect($link);
			
			$model = $this -> model;
			$title = 'Danh sách khách hàng đã mua';
			$data  = $model -> get_list();

			$str_id = '';
			foreach($data as $item){
				if($str_id)
					$str_id .= ',';
				$str_id .= $item -> products_id;
			}
			$products = $model -> get_products_from_ids($str_id);
			$pagination = $model->getPagination();
			
			$colors = $model -> get_colors();
			$status = $model -> get_status();
			
			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>'Danh sách khách hàng đã mua', 1 => '');
			global $tmpl ;			
			$tmpl -> assign('breadcrumbs', $breadcrumbs);

			include 'modules/'.$this->module.'/views/'.$this->view.'/list.php';
		}
	}
	
?>