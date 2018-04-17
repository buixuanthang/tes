<?php
/*
 * Huy write
 */
	// models 
	include 'blocks/services/models/services.php';
	class ServicesBControllersServices
	{
		function __construct()
		{
		}
		function display($parameters,$title)
		{
			$ordering = $parameters->getParams('ordering'); 
		        $type  = $parameters->getParams('type'); 
			$limit = $parameters->getParams('limit');
			$summary =  $parameters->getParams('summary');
			$limit = $limit ? $limit:8; 
			$show_readmore = $parameters->getParams('show_readmore');
			// call models
			$model = new ServicesBModelsServices();
			$list = $model -> get_list($ordering,$limit,$type,0);
			if(!$list)
				return;
//			$identity = $parameters->getParams('identity');
			$style = $parameters->getParams('style');
			$style = $style ? $style : 'default';
			// call views
			include 'blocks/services/views/services/'.$style.'.php';
		}
	}
	
?>