<?php
/*
 * Huy write
 */
// controller


class PartnersControllersPartner extends FSControllers {
	var $module;
	var $view;
	function display() {
		// call models
		$model = $this->model;
		
		$data = $model->get_data ();
		// check xem id co dung ko
		// Ok da hieu :d
		$id = FSInput::get ( 'id', 0, 'int' );
		$amp = FSInput::get ( 'amp', 0, 'int' );
		
		if (! $data) {
			setRedirect ( FSRoute::_ ( 'index.php?module=notfound&view=notfound' ), 'Link này không tồn tại' );
		}
		$code = FSInput::get('code');
		
		if ($code != $data->alias || $id != $data->id ) {
			$link = FSRoute::_ ( "index.php?module=partners&view=partner&code=" . trim ( $data->alias ) . "&id=" . $data->id  );
			setRedirect ( $link );
		}
		
		// relate
		$relates = $model->get_relates ( $data -> id );
		
		
		$breadcrumbs = array ();
		$breadcrumbs [] = array (0 => FSText::_('Đối tác'), 1 => FSRoute::_ ( 'index.php?module=partners&view=home&Itemid=2' ) );
		$breadcrumbs [] = array (0 => $data->name, 1 => '' );
		//			$breadcrumbs[] = array(0=>$data->title, 1 => '');	
		global $tmpl, $module_config;
		$tmpl->assign ( 'breadcrumbs', $breadcrumbs );
		
//		$tmpl->assign ( 'og_image', URL_ROOT . $data->image );
		// seo
		$this->set_header ( $data );
		$tmpl->set_data_seo ( $data );
		
		// call views			
		include 'modules/' . $this->module . '/views/' . $this->view.($amp?'_amp':'') . '/default.php';
	}
	
	
	/*
		 * Tạo ra các tham số header ( cho fb)
		 */
	function set_header($data, $image_first = '') {
		global $config;
		$link = FSRoute::_ ( "index.php?module=partners&view=partner&id=" . $data->id . "&code=" . $data->alias  );
		$str = '<meta property="og:title"  content="' . htmlspecialchars ( $data->name ) . '" />
					<meta property="og:type"   content="website" />
					';
		$image = URL_ROOT . str_replace ( '/original/', '/large/', $data->image );
		$str .= '<meta property="og:image"  content="' . $image . '" />
				<meta property="og:image:width" content="600 "/>
				<meta property="og:image:height" content="315"/>
			';
		$amp = FSInput::get('amp',0,'int');
		if(!$amp){
			$str .= '<link rel="amphtml" href="'.str_replace('.html','.amp',$link).'">';
		}
		$str .= '<meta property="og:description"  content="' . htmlspecialchars ( $data->summary ) . '" />';
		$str .= '
	<script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "PartnerArticle",
      "mainEntityOfPage": "'.$link.'",
      "description": "' . htmlspecialchars ( $data->summary ) . '",
      "headline": "' . htmlspecialchars ( $data->name ) . '",
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
}

?>