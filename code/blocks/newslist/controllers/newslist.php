<?php
/*
 * Huy write
 */
	// models 
	include 'blocks/newslist/models/newslist.php';
	class NewslistBControllersNewslist
	{
		function __construct()
		{
		}
		function display($parameters,$title)
		{
			$cat_id = $parameters->getParams('catid'); 
			$ordering = $parameters->getParams('ordering'); 
			$filter_category_auto = $parameters->getParams('filter_category_auto');
			$limit = $parameters->getParams('limit');
			$limit = $limit ? $limit:5;
			$limit1 = 1;  
			// call models
			$model = new NewslistBModelsNewslist();
			$list1 = $model -> get_list($cat_id,$ordering,$limit1,$filter_category_auto);
			$list = $model -> get_list($cat_id,$ordering,$limit,$filter_category_auto);
			
			$style = $parameters->getParams('style');
			if($style == 'tabs'){
				$list_cats = $model -> get_cats();
				if(!$list_cats)
				return;
				$total_cat = count($list_cats);
				$array_cats = array();
				$array_news_by_cat = array();
				$children_cat_array = array();
				$i = 0;
				foreach (@$list_cats as $item)
				{
					$news_in_cat = $model -> get_list($item->id,$ordering,$limit,$type);
					if($item -> level){
						if(!isset($children_cat_array[$item -> parent_id]))
							$children_cat_array[$item -> parent_id] = array();
							$children_cat_array[$item -> parent_id][] = $item ;
					}else{
						if(count($news_in_cat)){
							$array_cats[] = $item;
							$array_news_by_cat[$item->id] = $news_in_cat;	
							$i ++;
						}
					}
						if($i >3)
						break;
				
				}
			}
			$style = $style?$style:'default';
			
			// call views
			include 'blocks/newslist/views/newslist/'.$style.'.php';
		}
	}
	
?>