<?php
class ProductsModelsCountdown extends FSModels {
	var $limit;
	var $page;
	
	function get_data_current(){
		// lấy sản phẩm đang chạy
		return $this -> get_record('published = 1 AND started_time <= NOW() AND finished_time >= NOW() AND quantity > sales ','fs_products_countdown','*');
	}
	function get_datas_current($continuity = 0){
		if($continuity){
			$where = ' AND is_continuity  = 1';
			$start_day = date('Y-m-d').' 00:00:00';
			$finish_day = date('Y-m-d').' 23:59:59'; 
			// lấy sản phẩm đang chạy
			return $this -> get_records('published = 1 AND started_time >= "'.$start_day.'" AND finished_time <= "'.$finish_day.'"  '.$where.' ','fs_products_countdown','*','started_time ASC, finished_time ASC , ordering ASC ');
		}else{ 
			$where = ' AND  is_continuity  = 0 ';
			
			// lấy sản phẩm đang chạy
			return $this -> get_record('published = 1 AND started_time <= NOW() AND finished_time >= NOW() AND quantity > sales '.$where.' ','fs_products_countdown','*','ordering ASC');
		}
		
	}
	function update_continuity($item,$continuity_start_time){
		$row = array();
		$row['continuity_started_time'] = date('Y-m-d H:i:s',$continuity_start_time);
		$row['continuity_finished_time'] = date('Y-m-d H:i:s', $continuity_start_time +  $item ->  continuity_total_time * 60);
		$this -> _update($row, 'fs_products_countdown',' id = '.$item -> id);
	}
	function update_finish_continuity($item,$started_time,$finished_time){
		$row = array();
		$row['continuity_started_time'] = date('Y-m-d H:i:s',($started_time));
		$row['continuity_finished_time'] = date('Y-m-d H:i:s', ($finished_time));
		$row['started_time'] = $row['continuity_started_time'];
		$row['finished_time'] = $row['continuity_finished_time'] ;
		
		$this -> _update($row, 'fs_products_countdown',' id = '.$item -> id);
	}
	
	function get_data_next(){
		// lấy sản phẩm sắp chạy
		return $this -> get_record('published = 1 AND started_time >= NOW() ','fs_products_countdown','*', ' started_time ASC ');
	}
	function get_data_last(){
		// lấy sản phẩm chạy xong
		return $this -> get_record('published = 1 AND ( finished_time <= NOW() OR quantity <= sales ) ','fs_products_countdown','*', ' finished_time DESC ');
	}
	
	function get_boughts($countdown_id){
			if(!$countdown_id)
				return;
			// lấy sản phẩm đang chạy
			return $this -> get_result('status = 1 AND countdown_id = '.$countdown_id.' ','fs_order','count(products_count)');
		}
		
	
}
?>