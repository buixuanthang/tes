<?php
	class ServicesControllersServices extends Controllers{
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
	
	}
?>