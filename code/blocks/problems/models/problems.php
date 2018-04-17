<?php 
	class advantagesBModelsadvantages
	{
		function __construct()
		{
		}
		
		function setQuery($ordering,$limit,$type, $filter_category_auto = 0){
			$where = '';
			$order = '';	
			switch ($type){
			case 'hotest':
				$order .= ' ordering DESC,created_time DESC';
//				$where .= '  AND is_hot = 1 ';	
				break;
//			case 'download':
//				$order .= ' download DESC';
////				$where .= '  AND is_hot = 1 ';	
//				break;
			case 'newest':
				$order .= ' created_time DESC,ordering DESC';
				break;	
			case 'random':
				$order .= ' RAND() ';
				break;	
//			case 'in_cat':
//				$ccode = FSInput::get('ccode');
//				$id = FSInput::get('id');
//				if($ccode)
//					$where .= 'AND id <>'.$id.' AND category_alias_wrapper LIKE "%,'.$ccode.',%" ';
//				$order .= ' ordering DESC,created_time DESC';
//				break;
			case 'other_service':
				$id = FSInput::get('id');
				if($id)
					$where .= 'AND id <>'.$id.' ';
				$order .= ' ordering DESC,created_time DESC';
				break;
					
//			case 'same_author':
//				global $tmpl;
//				$author_prd = $tmpl -> get_variables('author_prd');
//				if(!$author_prd)
//					return;
//				$id = FSInput::get('id');
//				$where .= 'AND id <>'.$id.' AND  user_id = '.$author_prd.'  ';
//				$order .= ' ordering DESC,created_time DESC';
//				break;
			default: 
				$order .= ' ordering DESC,created_time DESC';
				break;		
			}
			
			
			$query = " SELECT *
						  FROM fs_advantages
						 WHERE  published = 1 ".$where."
						 ORDER BY  ".$order."
						 LIMIT $limit  
						 ";
			return $query;
		}
		function get_list($ordering,$limit,$type, $filter_category_auto = 0){
			if($type == 'hotest')
				return $this -> get_hotest($limit);
			global $db;
			$query = $this->setQuery($ordering,$limit,$type,$filter_category_auto);
			if(!$query)
				return;
			$sql = $db->query($query);
			$result = $db->getObjectList();
			return $result;
		}		
		
		// Lấy SP được down nhiều nhất trong tuần
		function  get_hotest($limit, $limit_day = 10){
			global $db;
			$query = ' SELECT  product_id, count(*) as count_download from fs_products_download
					WHERE
					DATE_SUB(NOW(), INTERVAL '.$limit_day.'  DAYS)  
					GROUP BY product_id
					ORDER BY count_download DESC
						 LIMIT '.$limit.' ';
		  	$list = $db->getObjectList($query);
	  		$arr_ids = array();
	  		$str_ids = '';
			if($list){
				foreach($list as $item){
					$arr_ids[] = $item -> product_id;
				}
				$str_ids = implode(',', $arr_ids);
			}
			$where = '';
			if($str_ids){
				$where .= ' AND product_id NOT IN ('.$str_ids.') ';
			}
			$other_limit = $limit - count($list);
			if($other_limit){
		  		$query = ' SELECT id from fs_products
					WHERE published = 1 '.$where.'
					ORDER BY download DESC, id DESC
						 LIMIT '.$other_limit.' ';
		  			$others = $db->getObjectList($query);
		  		foreach($others as $item){
		  			$arr_ids[] = $item -> id;
		  		}
			}
			$str_ids = implode(',', $arr_ids);
			
			$where = '';
			$where .= " AND  id IN (".$str_ids.") ";
			$query = " SELECT * from fs_products
					WHERE published = 1 ".$where."
					ORDER BY POSITION(','+id+',' IN '".$str_ids."') ";
		  	return $db->getObjectList($query);
			
		}
		
		function get_types(){
			return $this -> get_records('published = 1', 'fs_products_types','*','ordering ASC');
		}
	}

?>