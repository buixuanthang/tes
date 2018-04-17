<?php
/*
 * Huy write
 */
	// models 
	include 'blocks/slideshow/models/slideshow.php';
	class SlideshowBControllersSlideshow
	{
		function __construct()
		{
		}
		function display($parameters,$title,$block_id = 0)
		{

			$limit = $parameters->getParams('limit');
			$style = $parameters->getParams('style');
			$category_id = $parameters->getParams('category_id');
			$limit = $limit? $limit : '4';
			$style = $style ? $style : 'owl_carousel';
			// call models
			$model = new SlideshowBModelsSlideshow();
			$cat =  $model -> get_category($category_id);
			
			$data = $model -> get_data($category_id,$limit);
			if(!count($data))
				return;
			include 'blocks/slideshow/views/slideshow/'.$style.'.php';
		}
	}
	
?>