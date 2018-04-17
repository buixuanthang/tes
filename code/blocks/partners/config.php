<?php 
	$params = array (
		'suffix' => array(
					'name' => 'Hậu tố',
					'type' => 'text',
					'default' => '_partner'
					),
		'style' => array(
					'name'=>'Style',
					'type' => 'select',
					'value' => array('default' => 'Mặc định','slideshow' => 'Slide')
			),
		'ordering' => array(
					'name'=>'Lấy theo',
					'type' => 'select',
					'value' => array('alphabet'=>'A->Z','manual'=>'Thủ công'),
			),	
		'timeout' => array(
				'name' => 'Thời gian <i>(s)</i><br><span style="color:red;">Tối thiểu 2s<span>',
				'type' => 'text',
				'default' => '3' 
				),	
		'is_auto' => array(
			'name'=>'Tự động',
			'type' => 'is_check',
		),
		'summary' => array(
				'name' => 'Mô tả',
				'type' => 'textarea',
				'default' => ''
				),		
	);
?>