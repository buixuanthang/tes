<?php 
	$params = array (
		'suffix' => array(
					'name' => 'Hậu tố',
					'type' => 'text',
					'default' => '_services'
					),
		'limit' => array(
					'name' => 'Giới hạn',
					'type' => 'text',
					'default' => '10'
					),
//		'identity' => array(
//					'name' => 'Đánh dấu id ( cho slideshow)',
//					'type' => 'text',
//					'default' => ''
//					),
		'type' => array(
					'name'=>'Lấy theo',
					'type' => 'select',
					'value' => array('newest'=> 'Mới nhất','hotest'=>'Hot nhất','random' => 'Ngẫu nhiên','other_service'=>'Dịch vụ khác'),
//					'attr' => array('multiple' => 'multiple'),
			),	
		'show_readmore' => array(
				'name'=>'Hiện thị readmore',
				'type' => 'is_check',
		),		
		'style' => array(
					'name'=>'Style',
					'type' => 'select',
					'value' => array('default' => 'Default')
			),
		'summary' => array(
				'name' => 'Mô tả',
				'type' => 'textarea',
				'default' => ''
				),
	);
?>