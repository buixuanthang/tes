<?php
	/*
	 * Huy write
	 */
	// controller
	class PartnersControllersHome extends FSControllers
	{
		var $module;
		var $view;
		function display()
		{
			// call models
			$model = $this -> model;
			


			$query_body = $model->set_query_body();
			$list = $model->get_list($query_body);
			$total = $model->getTotal($query_body);
			$pagination = $model->getPagination($total);
			
			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>FSText::_('Đối tác'), 1 => Null);
			global $tmpl;	
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			$tmpl -> set_seo_special();
			// call views
			include 'modules/'.$this->module.'/views/'.$this->view.'/'.'default.php';
		}
	}
	
?>