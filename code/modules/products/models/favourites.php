
<?php 
	class ProductsModelsFavourites  extends FSModels
	{
		var $limit;
		var $page;
		function __construct()
		{
			$limit = 3;
			$page = FSInput::get('page');
			$this->limit = $limit;
			$this->page = $page;
		}
		
		function set_query_body($str_record_id){
			if(!$str_record_id)
				return;
			$sort = FSInput::get('sort','DESC');
			$sortby= FSInput::get('sortby','id');
			if(!$sortby)
				$sortby = 'id';
			if(!$sort)
				$sort = 'DESC';

			$order = " ORDER BY $sortby $sort";
			
			$sql = "  FROM fs_products 
					WHERE id IN ($str_record_id)
					". $order. " ";
			return $sql;
		}
		/*
		/*
		 * input: task, sim_number
		 */
		function getFavourites($query_body)
		{
			global $db;
			if(!$query_body)
				return array();
			$query = " SELECT * ".$query_body;
				
			$db->query_limit($query,$this->limit,$this->page);
			$result = $db->getObjectList();
			return $result;
		}
		function getTotal($query_body)
		{
			global $db;
			if(!$query_body)
				return array();
			$query = " SELECT count(*) ".$query_body;
				
			$db->query($query);
			$total = $db->getResult();
			return $total;
		}
		
		function getPagination($total)
		{
			FSFactory::include_class('Pagination');
			$pagination = new Pagination($this->limit,$total,$this->page);
			return $pagination;
		}
		
		/*
		 * delete from table fs_products_favourites
		 */
		function delete()
		{
			if(!isset($_COOKIE['user_id']))
				return ;
			$user_id = $_COOKIE['user_id'];
			$cids = FSInput::get('id',array(),'array');
			if(count($cids))
			{
				global $db;
				$str_cids = implode(',',$cids);
				$sql = " DELETE FROM fs_products_favourites
						WHERE record_id IN ($str_cids )
							AND user_id = $user_id ";
				// $db->query($sql);
				
				$rows = $db->affected_rows($sql);
				return $rows;
			}
			return 0;
		}
		
		function save()
		{
			global $db;
			$productids = FSInput::get('data');
			if(!$productids)
				return 0;
			$arr_pid = explode(",",$productids);
			$user_id = $_COOKIE['user_id'];
			$username = $_COOKIE['username'];
			$time = date('Y-m-d H:i:s');
			
			$j = 0;
			for($i = 0 ; $i < count($arr_pid); $i ++)
			{
				$pid = $arr_pid[$i];
				$query_exist = "SELECT EXISTS (SELECT * FROM fs_products_favourites 
								WHERE record_id='$pid'
								AND user_id = '$user_id'
								)
								";
				$db->query($query_exist);
				$exist = $db->getResult();
				if($exist){
					return 2;
				}
				else
				{
					$sql = " INSERT INTO fs_products_favourites
									(record_id,`user_id`,`username`,created_time,updated_time)
									VALUES ('$pid','$user_id','$username','$time','$time')
									";
					// $db->query($sql);
					$id = $db->insert($sql);
					$i ++;
				}
			}
			return 1;
		}
		
				/*
		 * get categories contain products
		 */
		function get_cats($array_cats_id)
		{
			if(!$array_cats_id)
				return ;
				
			$str_cats_id = implode(",",$array_cats_id);
			// get rootid
			
			global $db;
			// query get alias
			$query = " SELECT id,alias,name,root_alias
						FROM fs_categories 
						WHERE id IN ( $str_cats_id ) ";
			$sql = $db->query($query);
			$cats = $db->getObjectList();	
			return $cats;
		}
		
		function get_favourite_ids(){
			if(!isset($_COOKIE['user_id']))
				return ;
			$user_id = $_COOKIE['user_id'];
			$query = " SELECT record_id
						FROM fs_products_favourites 
						WHERE user_id = '".$user_id."' ";
			global $db;
			$db->query($query);
			$rs = $db->getObjectList();
			$i = 0;
			if(!count($rs))
				return;
			$str_id = '';
			foreach($rs as $item){
				if($i > 0)
					$str_id .= ',';
				$str_id .= $item -> record_id;
				$i ++;
			}		
			return $str_id;
		}
		function  get_favourite($id){
				if(!isset($_COOKIE['user_id']))
				return ;
			$user_id = $_COOKIE['user_id'];
			$query = " SELECT record_id,created_time
						FROM fs_products_favourites 
						WHERE record_id  = ".$id." AND
						 user_id = '".$user_id."' ";
			global $db;
			$db->query($query);
			$rs = $db->getObject();
			return $rs;
		}

		function ajax_product_add_like() {
			if (! isset ( $_COOKIE ['user_id'] ) || ! $_COOKIE ['user_id'])
				return '-3'; // chưa login
			$user_id = $_COOKIE ['user_id'];
			$record_id = FSInput::get ( 'data', 0, 'int' );
			$has_remove = FSInput::get ( 'has_remove', 0, 'int' );
			if (! $record_id)
				return;
	//		$video = $this->get_record_by_id ( $record_id, 'fs_videos' );
	//		if (! $video) {
	//			return;
	//		}
			global $db;
			$record = $this->get_record ( ' record_id  = ' . $record_id . ' AND user_id = ' . $user_id, 'fs_products_favourites' );
			
			// người đi theo dõi người khác	
	//		$folower = $this->get_record ( ' id  = ' . $user_id, 'fs_members' );
			
			if ($record) {
				// if($has_remove){
					// $this->_remove ( 'id = ' . $record->id, 'fs_products_favourites' );
	//			return '0';
					return -2;
				// }
			
			} else {
				$row = array ();
				$row ['record_id'] = $record_id;
				$row ['username'] = $_COOKIE ['username'];
				$row ['user_id'] = $user_id;
				$row ['created_time'] = date('Y-m-d H:i:s');
				$rid = $this->_add ( $row, 'fs_products_favourites' );
				return 1;
			}
			// $total_like = $this->get_count ( ' record_id  = ' . $record_id, 'fs_products_favourites' );
			// $row = array ();
			// $row ['likes'] = $total_like;
			// $rs = $this->_update ( $row, 'fs_products', 'id = ' . $record_id );
	//		if ($product->tablename) {
	//			$this->_update ( $row, $product->tablename, 'record_id = ' . $record_id );
	//		}
	//		return $total_like;
			// return $record ? '0_'.$total_like:'1_'.$total_like;
			return  0;
		}
	}
	
?>