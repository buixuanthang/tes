<?php 
	$params = array (
		'suffix' => array(
					'name' => 'Hậu tố',
					'type' => 'text',
					'default' => '_news_list'
					),
		'limit' => array(
					'name' => 'Giới hạn',
					'type' => 'text',
					'default' => '6'
					),
		'ordering' => array(
					'name'=>'Lấy theo',
					'type' => 'select',
					'value' => array('newest'=> 'Mới nhất','ramdom'=>'Ngẫu nhiên','hit_most'=>'Tin hot','hits'=>'Đọc nghiều nhất'),
//					'attr' => array('multiple' => 'multiple'),
			),			
		'style' => array(
					'name'=>'Style',
					'type' => 'select',
					'value' => array('default' => 'Mặc định','grid' => 'Ảnh','img_right' => 'Ảnh bên phải','list_slideshow'=>'List slideshow','column'=>'Dạng cột có ảnh lớn','thosuadidong'=>'Hai Cột')
					
			),
			'catid' => array(
//					'name'=>'Chọn danh mục<br/><i>(Không dùng cho lọc danh mục tự động)</i>',
					'name'=>'Chọn danh mục',
					'type' => 'select',
					'value' => get_categories(),
//					'attr' => array('multiple' => 'multiple'),
			),
	);
	function get_categories(){
		global $db;
			$query = " SELECT name, id,parent_id
						FROM fs_news_categories
						";
			$db->query($query);
			$list = $db->getObjectList();
			$arr_group = array(''=>'Chọn danh mục');
			if(!$list)
			     return;
			$tree  = FSFactory::getClass('tree','tree/');
			$list = $tree -> indentRows2($list);
			
            foreach($list as $item){
            	$arr_group[$item -> id] = $item -> treename;
            }
			return $arr_group;
	}
?>