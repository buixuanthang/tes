<?php 
	class ProductsBModelsProducts  extends FSModels
	{
		function __construct()
		{
		}
		
		function setQuery($ordering,$limit,$type, $filter_category_auto = 0){
			$where = '';
			$order = '';	
			$select = '';	
			switch ($type){
			case 'hotest':
				$order .= ' ordering DESC,created_time DESC';
				$where .= '  AND is_hot = 1 ';	
				break;
			case 'viewest':
				$order .= ' hits DESC,created_time DESC';
				$where .= '';	
				break;
			case 'download':
				$order .= ' download DESC';
//				$where .= '  AND is_hot = 1 ';	
				break;
			case 'sale':
				$order .= ' sale DESC';
//				$where .= '  AND is_hot = 1 ';	
				break;
			case 'discount':
				$order .= ' discount_rate DESC';				
				$select = ', (price_old - price)/price_old as discount_rate';	
				$where .= '  AND price_old > price';	
				break;
			case 'newest':
				$order .= ' created_time DESC,ordering DESC';
				break;	
			case 'random':
				$order .= ' RAND() ';
				break;	
			case 'in_cat':
				$ccode = FSInput::get('ccode');
				$id = FSInput::get('id');
				if($ccode)
					$where .= 'AND id <>'.$id.' AND category_alias_wrapper LIKE "%,'.$ccode.',%" ';
				$order .= ' ordering DESC,created_time DESC';
				break;
			case 'same_author':
				global $tmpl;
				$author_prd = $tmpl -> get_variables('author_prd');
				if(!$author_prd)
					return;
				$id = FSInput::get('id');
				$where .= 'AND id <>'.$id.' AND  user_id = '.$author_prd.'  ';
				$order .= ' ordering DESC,created_time DESC';
				break;
			default: 
				$order .= ' ordering DESC,created_time DESC';
				break;		
			}
			
			if($filter_category_auto){
				$view = FSInput::get('view');
				$module = FSInput::get('module');
				if($module == 'products' && $view == 'cat'){
					$id = FSInput::get('id');
					if($id)
						$where .= ' AND category_id_wrapper LIKE "%,'.$id.',%" ';
				}
				if($module == 'products' && $view == 'product'){
					$ccode = FSInput::get('ccode');
					if($ccode)
						$where .= ' AND category_alias_wrapper LIKE "%,'.$ccode.',%" ';
				}
			}
			
			$query = " SELECT * ".$select."
						  FROM fs_products
						 WHERE  published = 1 ".$where."
						 ORDER BY  ".$order."
						 LIMIT $limit  
						 ";
			return $query;
		}
		function get_list($ordering,$limit,$type, $filter_category_auto = 0){
			global $db;
			$query = $this->setQuery($ordering,$limit,$type,$filter_category_auto);
			if(!$query)
				return;
			$sql = $db->query($query);
			$result = $db->getObjectList();
			return $result;
		}		
	}

?>