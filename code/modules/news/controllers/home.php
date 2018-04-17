<?php
/*
 * Huy write
 */
	// controller
	
	class NewsControllersHome extends FSControllers
	{
		var $module;
		var $view;
		function display()
		{
			// call models
			$model = $this -> model;

			$amp = FSInput::get ( 'amp', 0, 'int' );
			$query_body = $model->set_query_body();
			$list = $model->getNewsList($query_body);
			$total = $model->getTotal($query_body);// tổng số bài viết

			$pagination = $model->getPagination($total);
			// echo "<pre>";
			// print_r($pagination); 

			$breadcrumbs = array();// đường dẫn Trang chủ>Tin tức
			//tạo đường dẫn cho người dùng và cả cho google
			$breadcrumbs[] = array(0=>'Tin tức', 1 => FSRoute::_('index.php?module=news&view=home&Itemid=2'));
			global $tmpl;	
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			$tmpl -> set_seo_special(); 
			$this->set_header ( );


			////////////category

			$list_cates= $model->get_cats();
			$array_cats = array();
			$array_news = array();
			$i = 0;
			foreach ($list_cates as $item) // lặp lấy ra tất cả tin có trong các cate vừa lấy bên trên
			{
				
				$query_body = $model->set_query_body_cate($item->id);
				$news_in_cat = $model->getNewsList($query_body);
				if(count($news_in_cat)){
					$array_cats[] = $item;
					$array_news[$item->id] = $news_in_cat;	
					$i ++;
				}
			}
				
			

			// call views			
			include 'modules/' . $this->module . '/views/' . $this->view.($amp?'_amp':'') . '/default.php';


			 

		}
		
	/*
		 * Tạo ra các tham số header ( cho fb)
		 */
	function set_header() {
		global $config;

		$amp = FSInput::get('amp',0,'int');
		$lang = isset($_SESSION['lang'])?$_SESSION['lang']:'vi';
		$str = '';
		if(!$amp  && $lang == 'vi'){
			$link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
			$str .= '<link rel="amphtml" href="'.str_replace('.html','.amp',$link).'">';
		}
		global $tmpl;
		$tmpl->addHeader ( $str );
	}
}
	
?>