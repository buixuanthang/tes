<?php
	class ProductsControllersCountdown  extends Controllers
	{
		function __construct()
		{	
			 $this->view = 'countdown';
			parent::__construct();
			$this->limit = 20; 
			
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
		function view_name($data){
			$link = FSRoute::_('index.php?module=products&view=coundown&id='.$data->id.'&code='.$data -> alias);
			return '<a target="_blink" href="' . $link . '" title="Xem ngoài font-end">'.$data -> name.'</a>';
		}
	
		function add()
		{
			$model = $this -> model;
			
			// all categories
			$categories = $model->get_categories_tree();
			$cat_first_id = isset(reset($categories) -> id)?reset($categories) -> id : 0;
			
			$products = $model -> get_products_by_cat($cat_first_id);
			$colors = $model -> get_records('published = 1','fs_products_colors');
			$maxOrdering = $model->getMaxOrdering();
			
			include 'modules/'.$this->module.'/views/'.$this->view.'/detail.php';
		}
		
		function ajax_get_products(){
			$model  = $this -> model;
			$cid = FSInput::get('cid');
			$rs  = $model -> get_products_by_cat($cid);
			
			$json = '['; // start the json array element
			$json_names = array();
			foreach( $rs as $item)
			{
				$json_names[] = "{id: $item->id, name: '$item->name'}";
			}
			$json .= implode(',', $json_names);
			$json .= ']'; // end the json array element
			echo $json;
		}
		
		function edit()
		{
			$ids = FSInput::get('id',array(),'array');
			$id = $ids[0];
			$model = $this -> model;
			$data = $model->get_record_by_id($id);
			
			$categories = $model->get_categories_tree();
			$product = $model -> get_record_by_id($data -> product_id,'fs_products');
//			$cat_first_id = isset($categories[0] -> id)?$categories[0] -> id : 0;

			$cat_id = isset($product -> category_id )?$product -> category_id : reset($categories) -> id;
			$products = $model -> get_products_by_cat($cat_id);
			$colors = $model -> get_records('published = 1','fs_products_colors');
			
			include 'modules/'.$this->module.'/views/'.$this->view.'/detail.php';
		}
		
	function format_money($row)
	{	if($row)
			return format_money($row,'VNĐ');
		else 
		return $row;
	}
}
	
?>