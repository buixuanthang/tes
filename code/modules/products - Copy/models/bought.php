<?php
class ProductsModelsBought extends FSModels {
	var $limit;
	var $page;
	function __construct() {
		$limit = 10;
		$page = FSInput::get ( 'page' );
		$this->limit = $limit;
		$this->page = $page;
	}
	
	function setQuery() {
		//			$user_id = $_COOKIE['user_id'];
		$where = ' ';
		$status = FSInput::get ( 'display' );
		//			if($status!='')
		//			{
		//				$where .=  " AND status LIKE '%$status%' ";
		//			}
		//			$payment_method = FSInput::get('buy');
		//			if($payment_method!='')
		//			{
		//				$where .=  " AND payment_method LIKE '%$payment_method%' ";
		//			}
		//			
		//			$date_from = FSInput::get('date_from');
		//			$date_from1 = date("Y/m/d 00:00:00", strtotime($date_from) );
		//			$date_to = FSInput::get('date_to');
		//			$date_to1 = date("Y/m/d 23:59:59", strtotime($date_to) );
		//			$service = FSInput::get('service');
		//			if($date_from)
		//			{
		//				$where .=  " AND created_time >= '$date_from1' ";
		//			}
		//			if($date_to)
		//			{
		//				$where .=  " AND created_time <= '$date_to1' ";
		//			}
		

		$sql = "  SELECT a.* , b.color_id, b.status_id
					FROM fs_order AS a
					LEFT JOIN fs_order_items AS b ON a.id = b.order_id
					WHERE
					a. status = 1 
					AND a.is_temporary = 0
					
					" . $where . "
					ORDER BY id DESC
					";
		return $sql;
	}
	
	function get_list() {
		global $db;
		// echo $query = $this->setQuery ();
		if (! $query)
			return array ();
		
		$sql = $db->query_limit ( $query, $this->limit, $this->page );
		$result = $db->getObjectList ();
		return $result;
	}
	function getTotal() {
		global $db;
		$query = $this->setQuery ();
		$sql = $db->query ( $query );
		$total = $db->getTotal ();
		return $total;
	}
	
	function getPagination() {
		$total = $this->getTotal ();
		FSFactory::include_class ( 'Pagination' );
		$pagination = new Pagination ( $this->limit, $total, $this->page );
		return $pagination;
	}
	
	//		function getBoughtById(){
	//			$user_id = $_COOKIE['user_id'];
	//			$id = FSInput::get('id',0,'int');
	//			if(!$id)
	//				return;
	//			global $db;
	//			$query = "  SELECT *
	//					FROM fs_order AS a
	//					WHERE
	//						id = $id AND 
	//						user_id = '$user_id' 
	//					";
	//			$db->query($query);
	//			$result = $db->getObject();
	//			return $result;
	//		}
	//		
	//		function get_order_items($orderid){
	//			if(!$orderid)
	//				return;
	////			$sim_number = $_SESSION['sim_number'];
	//			$id = FSInput::get('id',0,'int');
	//			global $db;
	//			$query = "  SELECT a.*
	//					FROM fs_order_items AS a
	//					WHERE
	//						a.order_id = $id
	//					";
	//			$db->query($query);
	//			$result = $db->getObjectList();
	//			return $result;
	//		}
	function get_products_from_ids($str_ids) {
		if (! $str_ids)
			return;
		$query = "  SELECT *
					FROM fs_products 
					WHERE
						published = 1 
						AND id IN ($str_ids)
					";
		global $db;
		$db->query ( $query );
		$result = $db->getObjectListByKey ( 'id' );
		return $result;
	}
	//		function get_order(){
	//			$user_id = $_COOKIE['user_id'];
	//			$id = FSInput::get('order_code');
	//			$id = str_replace("DH", "", $id);
	//			if(!$id)
	//				return;
	//			global $db;
	//			$query = "  SELECT *
	//					FROM fs_order AS a
	//					WHERE
	//						id = $id AND 
	//						user_id = '$user_id' 
	//					";
	//			$db->query($query);
	//			$result = $db->getObject();
	//			return $result;
	//		}
	

	function get_colors() {
		return $this->get_records ( 'published = 1', 'fs_products_colors', '*', '', '', 'id' );
	}
	
	function get_status() {
		return $this->get_records ( 'published = 1', 'fs_status', '*', '', '', 'id' );
	}

}

?>