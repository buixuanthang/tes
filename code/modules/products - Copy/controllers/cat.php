<?php
/*
 * Huy write
 */
	// controller

class ProductsControllersCat extends FSControllers {
	var $module;
	var $view;
	
	function display() {
		// call models
		$model = $this->model;
		$cat = $model->get_category ();
		if (! $cat) {
				$link = FSRoute::_('index.php?module=notfound&view=notfound&Itemid=1000');
				setRedirect($link);
			}
			if($cat->alias != FSInput::get('ccode')){
				$link = FSRoute::_('index.php?module=products&view=cat&cid='.$cat ->id.'&ccode='.$cat -> alias);
				setRedirect($link);
			}
			$amp = FSInput::get ( 'amp', 0, 'int' );
			$filter = FSInput::get ( 'filter' );		
			
			$query_body = $model -> set_query_body($cat);
			$list = $model -> get_list($query_body,$cat -> tablename);
			
			$total = $model->getTotal ( $query_body );
			$total_add_seo = 0; // nếu > 3 là ko chuyển qua dùng canonical
			
			$tablename = $cat->tablename;
			$pagination = $model->getPagination ( $total );
			$types = $model->get_types ();
			$arr_order = array (array (null, 'Sắp xếp theo' ), array ('gia-tang', 'Giá tăng dần' ), array ('gia-giam', 'Giá giảm dần' ), //					array('san-pham-cu','Cũ'),
			//					array('san-pham-moi','Mới'),
			array ('alpha', 'A -> Z' ) );
			//			$style  = FSInput::get('style'); 
			$sort = FSInput::get ( 'sort', 'moi-nhat' );
			//			$link_list = FSRoute::addParameters('style','list');
			//			$link_grid = FSRoute::addParameters('style','');
			if($sort)
				$total_add_seo ++;

			$page = FSInput::get('page');
			if($page > 1)
				$total_add_seo ++;
	
				$array_menu = array (array ('ban-chay-nhat', 'Bán chạy nhất' ),array ('khuyen-mai', 'Khuyễn mãi' ),
					array ('gia-thap-nhat', 'Giá từ thấp tới cao' ),array ('gia-cao-nhat', 'Giá từ cao tới thấp' ),
					array ('moi-nhat', 'Mới nhất' ), array ('xem-nhieu', 'Xem nhiều' ) );
				global $tmpl,$module_config;
			$title = $cat -> name;
			$str_manufactory_title = '';
			
			
			// set SEO follow filter
			if ($filter) {
				$arr_filter = explode ( ',', $filter );
				$arr_standart_filter = array ();
				for($i = 0; $i < count ( $arr_filter ); $i ++) {
					$filter_item = $arr_filter [$i];
					if ($filter_item) {
						$arr_standart_filter [] = "'" . $filter_item . "'";
					}
				}
				$total_add_seo += count ( $arr_standart_filter );
				if (count ( $arr_standart_filter )) {
					$str_standart_filter = implode ( ",", $arr_standart_filter );
					
					$filter_from_db = $model->getFilterFromRequest ( $str_standart_filter,$cat -> tablename,1 );
//						print_r($filter_from_db);
//						die;
						$seo_title_filter = '';
						$seo_keyword_filter = '';
						$seo_description_filter = '';
						// 	get filter in table fs_products_filter follow request
						for($i = 0; $i < count ( $arr_filter ); $i ++) {
							 $filter_item = $arr_filter [$i];
							if ($filter_item) {
								if(!isset($filter_from_db[$filter_item]))
									continue;
								$filter_data = $filter_from_db[$filter_item];
								if($filter_data -> seo_title){
									//$tmpl -> addTitle($filter_data -> seo_title;);
									if($seo_title_filter){
										$seo_title_filter .= ' - ';
									}
									$seo_title_filter .= $filter_data -> seo_title;
								}
								if($filter_data -> seo_meta_key)									
								{
									if($seo_keyword_filter){
										$seo_keyword_filter .= ' - ';
									}
									$seo_keyword_filter .= $filter_data -> seo_meta_key;
								}
								if($filter_data -> seo_meta_des){
									if($seo_description_filter){
										$seo_description_filter .= ' - ';
									}
									$seo_description_filter .= $filter_data -> seo_meta_des;
								}
//								if($filter_data -> description){
//									$cat->description_filter = $filter_data -> description;
//								}
								
								if(@$filter_data->field_name == 'manufactory'){
									
//									$manufactory = $filter_data->filter_value;
//									$manufactory_name = $filter_data->filter_show;
//									$manufactory_alias = $filter_data->alias;
									if($str_manufactory_title)
										$str_manufactory_title .= ' - ';
									$str_manufactory_title .= $filter_data->filter_show;
									
								}
							}
							
						}
						if($str_manufactory_title)
							$title .= ' '.$str_manufactory_title;
							
						if($seo_title_filter)
							$cat -> seo_title_filter = $seo_title_filter;
						if($seo_keyword_filter)
							$cat -> seo_keyword_filter = $seo_keyword_filter;
						if($seo_description_filter)
							$cat -> seo_description_filter = $seo_description_filter;
						
					}
				}
			     
				// seo
				$tmpl -> set_data_seo($cat);
				
		// breadcrumbs
		$lis_cat_parent = $model->get_list_parent ( $cat->list_parents, $cat->id );
		$breadcrumbs = array ();
		for($i = count ( $lis_cat_parent ); $i > 0; $i --) {
			$item = $lis_cat_parent [$i - 1];
			$breadcrumbs [] = array (0 => $item->name, 1 => FSRoute::_ ( 'index.php?module=products&view=cat&ccode=' . $item->alias."&cid=".$item ->id . '&Itemid=10' ) );
		}
		$cat_root = isset($lis_cat_parent[count ( $lis_cat_parent ) - 1])?$lis_cat_parent[count ( $lis_cat_parent ) - 1]:$cat;
		$breadcrumbs [] = array (0 => $cat->name, 1 => FSRoute::_ ( 'index.php?module=products&view=cat&ccode=' . $cat->alias."&cid=".$cat ->id . '&Itemid=10' ) );
		
//		$manufactories_request = FSInput::get ( 'manu', '' );
//		if($manufactories_request){
//			$arr_manufactories_request = explode(',',$manufactories_request);
//			// chỉ đưa ra ngoài breadcrumb nếu chọn 1 bộ lọc hãng sản xuất
//			if(count($arr_manufactories_request) == 1){
//				$manu_alias = $arr_manufactories_request[0];
//				$manu = $model -> get_record('alias = "'.$manu_alias.'"','fs_manufactories');
//				if($manu){
//					$breadcrumbs [] = array (0 => $manu->name, 1 => FSRoute::_ ( 'index.php?module=products&view=manufactory&code=' . $manu->alias."&id=".$manu ->id . '&Itemid=10' ) );
//				}
//			}
//		}
		
		$tmpl->assign ( 'breadcrumbs', $breadcrumbs );
		$tmpl->assign ( 'tablename', $tablename );
		// seo
		$tmpl->set_data_seo ( $cat );
		$canonical = '';
		if($total_add_seo > 1){
			$canonical = FSRoute::_('index.php?module=products&view=cat&ccode=' . $cat->alias."&cid=".$cat ->id );
		}
		$this -> set_header(@$list[0]-> image ,  $canonical);
			// call views
			include 'modules/' . $this->module . '/views/' . $this->view.($amp?'_amp':'') . '/default.php';
		}
		/*
		 * Táº¡o ra cÃ¡c tham sá»‘ header ( cho fb)
		 */
		function set_header($image_first = '' , $canonical = ''){
			
			$str = '';
			$image =  URL_ROOT.str_replace('/original/','/resized/', $image_first); 
  				$str .= '<meta property="og:image"  content="'.$image.'" />
  				';
			$amp = FSInput::get('amp',0,'int');
			$str = '';
			if(!$amp){
				if($canonical){
					$str .= '<link rel="canonical" href="'.$canonical.'" />';
					$str .= '<meta name="robots" content="noindex,nofollow">';
				}else{
					$link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
					$str .= '<link rel="amphtml" href="'.str_replace('.html','.amp',$link).'">';	
				}				
			}else{
				if($canonical){
					// $link = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
					// $link =  str_replace('.amp','.html',$link);			
					$str .= '<meta name="robots" content="noindex,nofollow">';
			//		setRedirect($link);
					
				}
			}
  			global $tmpl;
  			$tmpl -> addHeader($str);
		}
	}
	
?>