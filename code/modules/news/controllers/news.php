<?php
/*
 * Huy write
 */
// controller


class NewsControllersNews extends FSControllers {
	var $module;
	var $view;
	function display() {
		// call models

		$model = $this->model;
		
		$data = $model->getNews ();

		// check xem id co dung ko
		// Ok da hieu :d
		$id = FSInput::get ( 'id', 0, 'int' );
		$amp = FSInput::get ( 'amp', 0, 'int' );



		
		if (! $data) {
			setRedirect ( FSRoute::_ ( 'index.php?module=notfound&view=notfound' ), FSText::_('Link này không tồn tại') );
		}
		$code = FSInput::get('code');//alias title bài viếi

		$ccode = FSInput::get('ccode'); //alias title danh mục bài viết
		
		$category_id = $data -> category_id;

		
		$category = $model -> get_category_by_id($category_id);// lấy ra thông tin cate 
		

		if(!$category){
			setRedirect ( FSRoute::_ ( 'index.php?module=notfound&view=notfound' ), FSText::_('Danh mục không tồn tại') );
		}

		if ($code != $data->alias || $id != $data->id || $ccode != $data -> category_alias) {
			$link = FSRoute::_ ( "index.php?module=news&view=news&code=" . trim ( $data->alias ) . "&id=" . $data->id . "&ccode=" . trim ( $data->category_alias )."&amp=".$amp );
			setRedirect ( $link );
		}
		//http://audiocaocap.local/tin-cong-nghe/dien-thoai-android-hay-iphone-gap-loi-nhieu-hon-n270.html
		//khi người dùng sửa lại tin-cong-nghe hoặc dien-thoai-android-hay-iphone-gap-loi-nhieu-hon thì tự động set lại đúng link vì còn trường id đúng.


		// relate
		$relate_news_list = $model->getRelateNewsList ( $category_id );
		
		// tin liên quan theo tags
		$relate_news_list_by_tags = $model->get_relate_by_tags ( $data->tags, $data->id, $category_id );
		$total_content_relate = count ( $relate_news_list ); // tính tổng số tin liên quan theo seokeyword
//		$content_category_alias = $model->get_content_category_ids ( $str_ids );
//		// comments
//		$comments = $model->get_comments ( $data->id );
//		$total_comment = count ( $comments );
//		if ($total_comment) {
//			$list_parent = array ();
//			$list_children = array ();
//			foreach ( $comments as $item ) {
//				if (! $item->parent_id) {
//					$list_parent [] = $item;
//				} else {
//					if (! isset ( $list_children [$item->parent_id] ))
//						$list_children [$item->parent_id] = array ();
//					$list_children [$item->parent_id] [] = $item;
//				}
//			}
//		}
		
		// old relate and newest relate
		//			$newer_news_list = $model->getNewerNewsList($category->id,$data->created_time);
		//			$older_news_list = $model->getOlderNewsList($category->id,$data->created_time);
		

		// chèn keyword  vào trong nội dung
		
		// sản phẩm gợi ý ( lấy từ database)
		// $relate_products = $model->get_products_related ( $data->products_related);
		// if(!$relate_products){
		// 	//	lấy  danh sách  tin tức liên quan theo tag
		// 	$relate_products = $model->get_products_relate_tags ( $data->tags);
		// 	$limit_products_center = 4;
		// 	$total_relate_products = count($relate_products);
		// 	if($total_relate_products < $limit_products_center){
		// 		$str_prds_id = '';
		// 		if(count($relate_products)){
		// 			foreach($relate_products as $item){
		// 				if($str_prds_id)
		// 					$str_prds_id .= ',';
		// 				$str_prds_id .= $item -> id;
		// 			}
		// 		}
		// 		$hot_products = $model->get_products_hot ( $str_prds_id ,($limit_products_center - $total_relate_products ) );
		// 		$relate_products = count($relate_products)?array_merge($relate_products,$hot_products):$hot_products;
		// 	}
		// }
		// $products_new = $model->get_products_new (4 );
		
		// //products_types
		// $types = $model->get_types ();
		
		$description = $this->insert_link_keyword ( $data->content );//nội dung bài viết
		
		
		$breadcrumbs = array ();

		$breadcrumbs [] = array (0 => FSText::_('Tin tức'), 1 => FSRoute::_ ( 'index.php?module=news&view=home&Itemid=2' ) );
		$breadcrumbs [] = array (0 => $category->name, 1 => FSRoute::_ ( 'index.php?module=news&view=cat&id=' . $data->category_id . '&ccode=' . $data->category_alias ) );
		//			$breadcrumbs[] = array(0=>$data->title, 1 => '');	
		global $tmpl, $module_config;
		$tmpl->assign ( 'breadcrumbs', $breadcrumbs );
		$tmpl->assign ( 'title', $data->title );
		$tmpl->assign ( 'tags_news', $data->tags );
		$tmpl->assign ( 'products_related', $data->products_related );
		$tmpl->assign ( 'news_related', $data->news_related );
//		$tmpl->assign ( 'og_image', URL_ROOT . $data->image );
		// seo
		$this->set_header ( $data );
		$tmpl->set_data_seo ( $data );
		
		// call views			
		include 'modules/' . $this->module . '/views/' . $this->view.($amp?'_amp':'') . '/default.php';
	}
	
	/* Save comment */
	function save_comment() {
		$return = FSInput::get ( 'return' );
		$url = base64_decode ( $return );
		
		if (! $this->check_captcha ()) {
			$msg = 'Mã hiển thị không đúng';
			setRedirect ( $url, $msg, 'error' );
		}
		$model = $this->model;
		if (! $model->save_comment ()) {
			$msg = 'Chưa lưu thành công comment!';
			setRedirect ( $url, $msg, 'error' );
		} else {
			setRedirect ( $url, 'Cảm ơn bạn đã gửi comment' );
		}
	}
	/* Save comment reply*/
	function save_reply() {
		$return = FSInput::get ( 'return' );
		$url = base64_decode ( $return );
		
		$model = $this->model;
		if (! $model->save_comment ()) {
			$msg = 'Chưa lưu thành công comment!';
			setRedirect ( $url, $msg, 'error' );
		} else {
			setRedirect ( $url, 'Cảm ơn bạn đã gửi comment' );
		}
	}
	
	// check captcha
	function check_captcha() {
		$captcha = FSInput::get ( 'txtCaptcha' );
		
		if ($captcha == $_SESSION ["security_code"]) {
			return true;
		} else {
		}
		return false;
	}
	
	function rating() {
		$model = $this->model;
		if (! $model->save_rating ()) {
			echo '0';
			return;
		} else {
			echo '1';
			return;
		}
	}
	function count_views() {
		$model = $this->model;
		if (! $model->count_views ()) {
			echo 'hello';
			return;
		} else {
			echo '1';
			return;
		}
	}
	// update hits
	function update_hits() {
		$model = new NewsModelsNews ();
		$news_id = FSInput::get ( 'id' );
		$id = $model->update_hits ( $news_id );
		if ($id) {
			echo 1;
		} else {
			echo 0;
		}
		return;
	}
	/*
		 * Tạo ra các tham số header ( cho fb)
		 */
	function set_header($data, $image_first = '') {
		global $config;
		$link = FSRoute::_ ( "index.php?module=news&view=news&id=" . $data->id . "&code=" . $data->alias . "&ccode=" . $data->category_alias );
		$str = '<meta property="og:title"  content="' . htmlspecialchars ( $data->title ) . '" />
					<meta property="og:type"   content="website" />
					';
		$image = URL_ROOT . str_replace ( '/original/', '/large/', $data->image );
		$str .= '<meta property="og:image"  content="' . $image . '" />
				<meta property="og:image:width" content="600 "/>
				<meta property="og:image:height" content="315"/>
			';
		$amp = FSInput::get('amp',0,'int');
		$lang = isset($_SESSION['lang'])?$_SESSION['lang']:'vi';
		if(!$amp ){
			$str .= '<link rel="amphtml" href="'.str_replace('.html','.amp',$link).'">';
		}
		$str .= '<meta property="og:description"  content="' . htmlspecialchars ( $data->summary ) . '" />';
		$str .= '
	<script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "NewsArticle",
      "mainEntityOfPage": "'.$link.'",
      "description": "' . htmlspecialchars ( $data->summary ) . '",
      "headline": "' . htmlspecialchars ( $data->title ) . '",
      "image": {
        "@type": "ImageObject",
        "url": "' . $image . '",
        "width": 1200,
        "height": 618      },
      "datePublished": "'.date('d/m/Y',strtotime($data -> created_time)).'",
      "dateModified": "'.date('d/m/Y',strtotime($data -> created_time)).'",
      "publisher": {
        "@type": "Organization",
        "name": "'.URL_ROOT.'",
        "logo": {
            "@type": "ImageObject",
            "url": "'.URL_ROOT.$config['logo'].'",
            "width": 60,
            "height": 60        }
      },
      "author": {
            "@type": "Person",
            "name": "'.URL_ROOT.'"
      }
    }
    </script>';
		
		global $tmpl;
		$tmpl->addHeader ( $str );
	}

	function amp_add_size_into_img($content){
		preg_match_all('#<img(.*?)>#is',$content,$images);
		$arr_images = array();
		if(!count($images[0]))
			return $content;
		$i = 0;
		foreach($images[0] as $item){			
						
			unset($height);
			preg_match('#height([\s]*)=([\s]*)[\'|\"](.*?)[\'|\"]#is',$item,$height);
			
			if(!isset($height[3])){
				$item_new = str_replace('<img','<img height="400" ', $item);
				// $content = str_replace($item,$item_new, $content);
			}elseif(!$height[3]){
				$item_new = preg_replace('%height([\s]*)=([\s]*)[\'|\"](.*?)[\'|\"]%i', 'height="402"', $item);

				// $content = str_replace($item,$item_new, $content);
			}else{
				$item_new = $item;
				// $content = str_replace($item,$item_new, $content);
			}
			
			unset($width);
			preg_match('#width([\s]*)=([\s]*)[\'|\"](.*?)[\'|\"]#is',$item_new,$width);
			if(!isset($width[3])){
				$item_new_2 = str_replace('<img','<img width="600" ', $item_new);
				// $content = str_replace($item_new,$item_new_2, $content);
			}elseif(!$width[3]){
				$item_new_2 = preg_replace('%width([\s]*)=([\s]*)[\'|\"](.*?)[\'|\"]%i', 'width="602"', $item_new);
				// $content = str_replace($item_new,$item_new_2, $content);
			}else{
				$item_new_2 = preg_replace('%width([\s]*)=([\s]*)[\'|\"](.*?)[\'|\"]%i', 'width="601"', $item_new);
				// $content = str_replace($item_new,$item_new_2, $content);
			}
			
			if($item != $item_new_2){
				$content = str_replace($item,$item_new_2, $content);
			}
			
			
		}

		return $content;	
	}
}

?>