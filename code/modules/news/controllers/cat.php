<?php
/*
 * Huy write
 */
	// controller
	
	class NewsControllersCat extends FSControllers
	{
		var $module;
		var $view;
		function display()
		{
			// call models
			$model = $this -> model;
			$cat  = $model->getCategory();
		
			if(!$cat){
				$link = FSRoute::_('index.php?module=notfound&view=notfound&Itemid=1000');
				setRedirect($link);
			}
			if($cat->alias != FSInput::get('ccode')){
				$link = FSRoute::_('index.php?module=products&view=cat&cid='.$cat ->id.'&ccode='.$cat -> alias);
				setRedirect($link);
			}
			$amp = FSInput::get ( 'amp', 0, 'int' );

			$query_body = $model->set_query_body($cat->id);
			$list = $model->getNewsList($query_body);
			$total = $model->getTotal($query_body);
			$pagination = $model->getPagination($total);
			
			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>'Tin tức', 1 => FSRoute::_('index.php?module=news&view=home&Itemid=2'));
			$breadcrumbs[] = array(0=>$cat->name, 1 => '');
			global $tmpl;	
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			// seo
			$tmpl -> set_data_seo($cat);
			$this->set_header ( $cat );
			
			// call views			
			include 'modules/' . $this->module . '/views/' . $this->view.($amp?'_amp':'') . '/default.php';
		}
		
	/*
		 * Tạo ra các tham số header ( cho fb)
		 */
	function set_header($data, $image_first = '') {
		global $config;
		$link = FSRoute::_ ( "index.php?module=news&view=cat&cid=" . $data->id . "&ccode=" . $data->alias );
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