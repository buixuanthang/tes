<?php
/*
 * Huy write
 */
	// models 
	include 'blocks/products/models/products.php';
	
	class ProductsBControllersProducts 
	{
		function __construct()
		{
		}
		function display($parameters,$title,$block_id = 0, $link_title = '',$showTitlte = 0){
			$ordering = $parameters->getParams('ordering'); 
		       $type  = $parameters->getParams('type'); 
			$limit = $parameters->getParams('limit');
			$limit = $limit ? $limit:8; 
			$filter_category_auto = $parameters->getParams('filter_category_auto');
			// call models
			$model = new ProductsBModelsProducts();
			$list = $model -> get_list($ordering,$limit,$type,$filter_category_auto);
			if(!$list)
				return;
			
			$identity = $block_id;
			$style = $parameters->getParams('style');
			$style = $style ? $style : 'default';
			// call views
			include 'blocks/products/views/products/'.$style.'.php';
		}
	}
	
?>