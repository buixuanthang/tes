<?php
	// models 

		  
	class ProductsControllersCategories extends Controllers
	{
		function __construct()
		{
			$this->view = 'categories' ; 
			parent::__construct(); 
		}
		function display()
		{
			parent::display();
			$sort_field = $this -> sort_field;
			$sort_direct = $this -> sort_direct;
			
			$model  = $this -> model;
			$list = $this -> model->get_categories_tree_all();
			$pagination = $model->getPagination();
			include 'modules/'.$this->module.'/views/'.$this->view.'/list.php';
		}
		function add()
		{
			$model =  $this -> model;
			//$create_link = $model -> getCreateLinks();
			$categories = $model->get_categories_tree_all();
			$maxOrdering = $model->getMaxOrdering();
			$tables = $model->get_tablenames();
			include 'modules/'.$this->module.'/views/'.$this->view.'/detail.php';
		}
		function edit()
		{
			$model =  $this -> model;
			//$create_link = $model -> getCreateLinks();
			$ids = FSInput::get('id',array(),'array');
			$id = $ids[0];
			$data = $model->get_record_by_id($id);
			$categories = $model->get_categories_tree_all();
			$tables = $model->get_tablenames();
			include 'modules/'.$this->module.'/views/'.$this->view.'/detail.php';
		}
		/*
		 * create link edit table name
		 */
		function link_edit_tablename($table_name){
			$table_name = str_replace('fs_products_', '',$table_name);
			$link = 'index.php?module='.$this -> module.'&view=tables&task=edit&tablename='.$table_name;
			return '<a href="'.$link.'" title="Sửa bảng" >'.$table_name.'</a>';
		}
		function view_genarate_filter($data){
			$table_name = str_replace('fs_products_', '',$data -> tablename);
			$link = 'index.php?module='.$this -> module.'&view='.$this -> view.'&task=genarate_filter&tablename='.$table_name;
			return '<a href="'.$link.'" title="Tính toán lại bộ lọc" >Tính lại bộ lọc</a>';
		}
		
		function link_import($id){
			$link = 'index.php?module='.$this -> module.'&view=import&cid='.$id;
			return '<a href="'.$link.'" title="Sửa bảng" ><img src="templates/default/images/toolbar/icon-import.png" /> </a>';
		}
		/*
		 * Sinh ra bộ lọc tự động
		 */
		function genarate_filter(){
			$link = 'index.php?module='.$this -> module.'&view='.$this -> view;
			$table_name = FSInput::get('tablename');
			if(!$table_name){
				setRedirect($link,FSText :: _('Không được để trống bảng mở rộng'));	
			}
			$table_name = 'fs_products_'.$table_name;
			$model = $this -> model;
			$rs = $model->caculate_filter(array($table_name));
			
			if($this -> page)
				$link .= '&page='.$this -> page;	
			if($rows){
				setRedirect($link,$rows.' '.FSText :: _('Đã tính lại xong bộ lọc'));	
			} else {
				setRedirect($link,FSText :: _('Không tính được'),'error');	
			}
		}
	}
	
?>