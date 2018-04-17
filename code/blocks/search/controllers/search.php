<?php

/*
 * Huy write
 */
	// models 
	
	
	class SearchBControllersSearch
	{
		function __construct()
		{
		}
		function display($parameters = array(),$title = '')
		{
			$style = $parameters->getParams('style');
			$style = $style ? $style : 'default';
			if($style == 'sharedata'){
				include 'blocks/search/models/search.php';
				$model = new SearchBModelsSearch();
				$categories = $model->get_categories();
			}
			// call views
			include 'blocks/search/views/search/'.$style.'.php';
		}
		
	}
	
?>