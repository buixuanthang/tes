<?php
/*
 * Huy write
 */
	// models 
	// include 'blocks/statics/models/statics.php';	
	class StaticsBControllersStatics
	{
		function __construct()
		{
		}
		function display($parameters,$title)
		{
			// $model = new StaticsBModelsStatics();
			$style = $parameters->getParams('style');

			$style = $style?$style:'default';
			// call views
			include 'blocks/statics/views/statics/'.$style.'.php';
		}
	}
	
?>