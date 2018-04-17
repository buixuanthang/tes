<?php
/*
 * Huy write
 */
	// models 
	include 'blocks/products_tabs/models/products_tabs.php';
	
	class Products_tabsBControllersProducts_tabs 
	{
		function __construct()
		{
		}
		function display($parameters,$title)
		{
			$limit = $parameters->getParams('limit');
			$limit = $limit ? $limit:8; 
			
			$arr_type = array('newest' => FSText::_('Sản phẩm mới'),'discount'=>FSText::_('Sản phẩm khuyến mại'),'sale'=>FSText::_('Sản phẩm bán chạy'));
			// call models
			$model = new Products_tabsBModelsProducts_tabs();
			$types = $model->get_types ();
			$list = array();
			
			foreach($arr_type as $type => $name){
				$rs = $model -> get_list($type, $limit);
				$list[$type] = $rs;
			}
			$style = $parameters->getParams('style');
			$style = $style ? $style : 'default';
			// call views
			include 'blocks/products_tabs/views/products_tabs/'.$style.'.php';
		}
	}
	
?>