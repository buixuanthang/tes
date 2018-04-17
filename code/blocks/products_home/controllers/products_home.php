<?php

/*

 * Huy write

 */

// controller


// models 


include 'blocks/products_home/models/products_home.php';

class Products_homeBControllersProducts_home 

{
	
	function display($parameters, $title) 

	{
		
		$limit = $parameters->getParams ( 'limit' );
		$style = $parameters->getParams ( 'style' );
		
		$style = $style ? $style : 'default';
		
		$cat_root = $parameters->getParams ( 'cat_root' );
		
		// call models
		

		$model = new Products_homeBModelsProducts_home ();
		
		// cat list
		

		$list_cats = $model->getCats ();
		$types = $model->get_types ();
		
		$array_cats = array ();
		$array_cats_child = array();
		$array_products = array ();

		// Ad thêm bộ lọc.
		$filters = $model -> get_filters_home();
		
		$i = 0;
		foreach ( @$list_cats as $item ) 
		{
			if($item -> parent_id){
				if(!isset($array_cats_child[$item -> parent_id]))
					$array_cats_child[$item -> parent_id] = array();
				$array_cats_child[$item -> parent_id][] = $item;
			}else{
				$products_in_cat = $model->getProducts ( $item->id, $limit );
				if (count ( $products_in_cat )) {
					$array_cats [] = $item;
					$array_products [$item->id] = $products_in_cat;
					$i ++;
				}
			}
		
		}
		include 'blocks/products_home/views/products_home/' . $style . '.php';
	
	}

}

?>