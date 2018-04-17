<?php
/*
 * Huy write
 */
	// models 
	include 'blocks/strengths/models/strengths.php';
	class StrengthsBControllersStrengths
	{
		function __construct()
		{
		}
		function display($parameters,$title){

			$limit = $parameters->getParams('limit');

			$limit = $limit ? $limit:4; 
//			$show_readmore = $parameters->getParams('show_readmore');
//			// call models
			$model = new StrengthsBModelsStrengths();
			$cat_id = $parameters->getParams('catid'); 
			$list = $model -> get_list($cat_id,$limit);
			if(!$list)
				return;

			$style = $parameters->getParams('style');

			$style = $style ? $style : 'default';
			// call views
			include 'blocks/strengths/views/strengths/'.$style.'.php';
		}
	}
	
?>