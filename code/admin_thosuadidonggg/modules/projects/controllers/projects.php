<?php
	class ProjectsControllersProjects extends Controllers
	{
		function __construct()
		{
			$this->view = 'projects' ; 
			parent::__construct(); 
			$arr_types = array(1 => 'Sắp triển khai',2=>'Đang triển khai',3=>'Đã hoàn thành');
			$this -> arr_types = $arr_types;
		}
		function display()
		{
			parent::display();
			$sort_field = $this -> sort_field;
			$sort_direct = $this -> sort_direct;
			
			$model  = $this -> model;
			$arr_types = $this -> arr_types;
			$list = $model->get_data();
			$categories = $model->get_all_record('fs_projects_categories');
			$regions = $model->get_all_record('fs_projects_regions');
			$pagination = $model->getPagination();
			include 'modules/'.$this->module.'/views/'.$this->view.'/list.php';
		}
		function add()
		{
			$model = $this -> model;
			$departments = $model->get_all_record('fs_projects');
			$maxOrdering = $model->getMaxOrdering();
			
			$arr_types = $this -> arr_types;
			// $categories = $model->get_all_record('fs_projects_categories');
			$categories = $model->get_categories_tree();
			$regions = $model->get_all_record('fs_projects_regions');
			include 'modules/'.$this->module.'/views/'.$this -> view.'/detail.php';
		}
		
		function edit()
		{
			$ids = FSInput::get('id',array(),'array');
			$id = $ids[0];
			$model = $this -> model;
			$data = $model->get_record_by_id($id);
			$arr_types = $this -> arr_types;

			// $categories = $model->get_all_record('fs_projects_categories');
			$categories = $model->get_categories_tree();

			$regions = $model->get_all_record('fs_projects_regions');
			$images = $model->get_project_images($data -> id);
			include 'modules/'.$this->module.'/views/'.$this->view.'/detail.php';
		}
		function typical()
		{
			$model = $this -> model;
			$rows = $model->typical(1);
			$link = 'index.php?module='.$this -> module.'&view='.$this -> view;
			$page = FSInput::get('page',0);
			if($page > 1)
				$link .= '&page='.$page;
			if($rows)
			{
				setRedirect($link,$rows.' '.FSText :: _('record was home'));	
			}
			else
			{
				setRedirect($link,FSText :: _('Error when home record'),'error');	
			}
		}
		function untypical()
		{
			$model = $this -> model;
			$rows = $model->typical(0);
			$link = 'index.php?module='.$this -> module.'&view='.$this -> view;
			$page = FSInput::get('page',0);
			if($page > 1)
				$link .= '&page='.$page;
			if($rows)
			{
				setRedirect($link,$rows.' '.FSText :: _('record was unhome'));	
			}
			else
			{
				setRedirect($link,FSText :: _('Error when unhome record'),'error');	
			}
		}
	}
	/**
	* Lấy danh sách ảnh của sản phẩm
	*/
	function get_other_images(){
        	$list_other_images = $this->model->get_other_images();   
	        include 'modules/' . $this->module . '/views/' . $this->view . '/detail_images_list.php';
	} 
	/**
	* Upload nhiều ảnh cho sản phẩm
	*/ 
    	function upload_other_images(){
        	$this->model->upload_other_images();
	 }
	 /**
	 * Xóa ảnh
	 */ 
    	 function delete_other_image(){
        	$this->model->delete_other_image();
	 }
	    
	 /**
	 * Sắp xếp ảnh
	 */
    	function sort_other_images(){
        	$this->model->sort_other_images();
    	} 
    	
    	/*
    	 * Sửa thuộc tính của ảnh
    	 */
    	function change_attr_image(){
    		$this->model->change_attr_image();
    	}
	
?>