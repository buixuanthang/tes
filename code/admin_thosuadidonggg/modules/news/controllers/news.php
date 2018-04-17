<?php
	class NewsControllersNews extends Controllers
	{
		function __construct()
		{
			$this->view = 'news' ; 
			parent::__construct(); 
		}
		function display()
		{
			parent::display();
			$sort_field = $this -> sort_field;
			$sort_direct = $this -> sort_direct;
			
			$model  = $this -> model;
			$list = $model->get_data();
			$categories = $model->get_categories_tree();
			
			$pagination = $model->getPagination();
			include 'modules/'.$this->module.'/views/'.$this->view.'/list.php';
		}
		function add()
		{
			$model = $this -> model;
			$categories = $model->get_categories_tree();
			
			// data from fs_news_categories
			$categories_home  = $model->get_categories_tree();
			$maxOrdering = $model->getMaxOrdering();
			
			include 'modules/'.$this->module.'/views/'.$this -> view.'/detail.php';
		}
		
		function edit()
		{
			$ids = FSInput::get('id',array(),'array');

			$id = $ids[0];
			$model = $this -> model;

			
			$categories  = $model->get_categories_tree();
//			$tags_categories = $model->get_tags_categories();
			$data = $model->get_record_by_id($id);

			// news related
			$products_categories = $model->get_products_categories_tree();
			$products_related = $model -> get_products_related($data -> products_related);

			// news related
			$news_categories = $model->get_news_categories_tree();
			$news_related = $model -> get_news_related($data -> news_related);

			// echo "<pre>";
			// print_r($news_related );
			// echo "</pre>";
			// die();
			
			// data from fs_news_categories
			include 'modules/'.$this->module.'/views/'.$this->view.'/detail.php';
		}
		
		function view_comment($new_id){
			$link = 'index.php?module=news&view=comments&keysearch=&text_count=1&text0='.$new_id.'&filter_count=1&filter0=0';
			return '<a href="'.$link.'" target="_blink">Comment</a>'; 
		}
		function view_history($new_id) {
			$link = 'index.php?module=news&view=history&news_id=' . $new_id;
			return '<a href="' . $link . '" target="_blink"><img border="0" src="templates/default/images/clock_red.png" alt="History"></a>';
		}
		function is_hot()
	{
		$model = $this -> model;
		$rows = $model->hot(1);
		$link = 'index.php?module='.$this -> module.'&view='.$this -> view;
		$page = FSInput::get('page',0);
		if($page > 1)
			$link .= '&page='.$page;
		if($rows)
		{
			setRedirect($link,$rows.' '.FSText :: _('record was event'));	
		}
		else
		{
			setRedirect($link,FSText :: _('Error when hot record'),'error');	
		}
	}
	function unis_hot()
	{
		$model = $this -> model;
		$rows = $model->hot(0);
		$link = 'index.php?module='.$this -> module.'&view='.$this -> view;
		$page = FSInput::get('page',0);
		if($page > 1)
			$link .= '&page='.$page;
		if($rows)
		{
			setRedirect($link,$rows.' '.FSText :: _('record was un_hot'));	
		}
		else
		{
			setRedirect($link,FSText :: _('Error when un_hot record'),'error');	
		}
	}
		function is_promotion()
		{
			$model = $this -> model;
			$rows = $model->promotion(1);
			$link = 'index.php?module='.$this -> module.'&view='.$this -> view;
			$page = FSInput::get('page',0);
			if($page > 1)
				$link .= '&page='.$page;
			if($rows)
			{
				setRedirect($link,$rows.' '.FSText :: _('record was event'));	
			}
			else
			{
				setRedirect($link,FSText :: _('Error when hot record'),'error');	
			}
		}
		function unis_promotion()
		{
			$model = $this -> model;
			$rows = $model->promotion(0);
			$link = 'index.php?module='.$this -> module.'&view='.$this -> view;
			$page = FSInput::get('page',0);
			if($page > 1)
				$link .= '&page='.$page;
			if($rows)
			{
				setRedirect($link,$rows.' '.FSText :: _('record was un_hot'));	
			}
			else
			{
				setRedirect($link,FSText :: _('Error when un_hot record'),'error');	
			}
		}
		function is_instalment()
		{
			$model = $this -> model;
			$rows = $model->instalment(1);
			$link = 'index.php?module='.$this -> module.'&view='.$this -> view;
			$page = FSInput::get('page',0);
			if($page > 1)
				$link .= '&page='.$page;
			if($rows)
			{
				setRedirect($link,$rows.' '.FSText :: _('record was event'));	
			}
			else
			{
				setRedirect($link,FSText :: _('Error when hot record'),'error');	
			}
		}
		function unis_instalment()
		{
			$model = $this -> model;
			$rows = $model->instalment(0);
			$link = 'index.php?module='.$this -> module.'&view='.$this -> view;
			$page = FSInput::get('page',0);
			if($page > 1)
				$link .= '&page='.$page;
			if($rows)
			{
				setRedirect($link,$rows.' '.FSText :: _('record was un_hot'));	
			}
			else
			{
				setRedirect($link,FSText :: _('Error when un_hot record'),'error');	
			}
		}
		function is_ask()
		{
			$model = $this -> model;
			$rows = $model->ask(1);
			$link = 'index.php?module='.$this -> module.'&view='.$this -> view;
			$page = FSInput::get('page',0);
			if($page > 1)
				$link .= '&page='.$page;
			if($rows)
			{
				setRedirect($link,$rows.' '.FSText :: _('record was event'));	
			}
			else
			{
				setRedirect($link,FSText :: _('Error when hot record'),'error');	
			}
		}
		function unis_ask()
		{
			$model = $this -> model;
			$rows = $model->ask(0);
			$link = 'index.php?module='.$this -> module.'&view='.$this -> view;
			$page = FSInput::get('page',0);
			if($page > 1)
				$link .= '&page='.$page;
			if($rows)
			{
				setRedirect($link,$rows.' '.FSText :: _('record was un_hot'));	
			}
			else
			{
				setRedirect($link,FSText :: _('Error when un_hot record'),'error');	
			}
		}
		function ajax_get_products_related(){
			$model = $this -> model;
			$data = $model->ajax_get_products_related();
			$html = $this -> products_genarate_related($data);
			echo $html;
			return;
		}
		function products_genarate_related($data){
			$str_exist = FSInput::get('str_exist');
			$html = '';
				$html .= '<div class="products_related">';
				foreach ($data as $item){
					if($str_exist && strpos(','.$str_exist.',', ','.$item->id.',') !== false ){
						$html .= '<div class="red products_related_item  products_related_item_'.$item -> id.'" onclick="javascript: set_products_related('.$item->id.')" style="display:none" >';	
						$html .= $item -> name;				
						$html .= '</div>';					
					}else{
						$html .= '<div class="products_related_item  products_related_item_'.$item -> id.'" onclick="javascript: set_products_related('.$item->id.')">';	
						$html .= $item -> name;				
						$html .= '</div>';	
					}
				}
				$html .= '</div>';
				return $html;
		}
		/*
		 *==================== AJAX RELATED PRODUCTS==============================
		 */
	
		/***********
		 * NEWS RELATED
		 ************/
		function ajax_get_news_related(){
			$model = $this -> model;
			$data = $model->ajax_get_news_related();
			$html = $this -> news_genarate_related($data);
			echo $html;
			return;
		}
		function news_genarate_related($data){
			$str_exist = FSInput::get('str_exist');
			$html = '';
				$html .= '<div class="news_related">';
				foreach ($data as $item){
					if($str_exist && strpos(','.$str_exist.',', ','.$item->id.',') !== false ){
						$html .= '<div class="red news_related_item  news_related_item_'.$item -> id.'" onclick="javascript: set_news_related('.$item->id.')" style="display:none" >';	
						$html .= $item -> title;				
						$html .= '</div>';					
					}else{
						$html .= '<div class="news_related_item  news_related_item_'.$item -> id.'" onclick="javascript: set_news_related('.$item->id.')">';	
						$html .= $item -> title;				
						$html .= '</div>';	
					}
				}
				$html .= '</div>';
				return $html;
		}
		function remove_cache() {

			$model = $this -> model;
		
			$rows = $model->remove_cache();

			$link = 'index.php?module='.$this -> module.'&view='.$this -> view;
			$page = FSInput::get('page',0);
			if($page > 1)
				$link .= '&page='.$page;
			if($rows){
				setRedirect($link,FSText :: _('Bạn đã xóa cache thành công'));	
			}
		
		}
	
	}
?>