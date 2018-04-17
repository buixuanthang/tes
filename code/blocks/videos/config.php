<?php 
	$params = array (
		'suffix' => array(
					'name' => 'Hậu tố',
					'type' => 'text',
					'default' => '_video_list'
					),
		'limit' => array(
					'name' => 'Giới hạn',
					'type' => 'text',
					'default' => '6'
					),		
		'type' => array(
					'name'=>'Lấy theo',
					'type' => 'select',
					'value' => array('ordering'=>'Thứ tự','new'=>'Mới nhất'),
			),	
		'groups' => array(
					'name'=>'Nhóm',
					'type' => 'select',
					'value' => array('1'=>'Nhóm Trang chủ','2'=>'Chi tiết Sản Phẩm'),
			),			
		'style' => array(
					'name'=>'Style',
					'type' => 'select',
					'value' => array('default' => 'Mặc định','one_large_and_list'=>'Một video lớn và list video dạng text','one'=>'1 Video','thosuadidong'=>'List Video','style_max_3'=>'3 video')
			),

	);
?>