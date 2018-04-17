<?php
/*
 * Huy write
 */
	// controller
	
	class SearchControllersSearch extends FSControllers
	{
		var $module;
		var $view;
		function display()
		{
			// call models
			$model = $this -> model;
			$query_body = $model -> set_query_body();
			$keyword = FSInput::get('keyword');
			$keyword = str_replace('-', ' ',$keyword);
			$keyword = str_replace('+', ' ',$keyword);
			$products = $model -> get_list($query_body);			
			$total = $model -> getTotal($query_body);
			// $total_list = count($news_list);
			$pagination = $model->getPagination($total);

			// $products =  $model -> get_products();
			$news_list =  $model -> get_news();
			// $projects =  $model -> get_projects();

			global $tmpl;	
			
			$title = '"'.$keyword.'" - Tìm kiếm';
			if($title)
				$tmpl->addTitle( $title);	

    
		    $str_meta_des = $keyword;
		    
		 //    for($i = 0; $i < $news_list ; $i ++ ){
		 //        $item = $list[$i];
		 //        $str_meta_des .= ','.$item -> title;
		 //    }
			// $tmpl->addMetakey($str_meta_des);
			// $tmpl->addMetades($str_meta_des);
	


			
			$breadcrumbs = array();			
			$breadcrumbs[] = array(0=>"Tìm kiếm", 1 => '');
			
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			
			// call views			
			include 'modules/'.$this->module.'/views/'.$this->view.'/default.php';
		}
	}
	
?>