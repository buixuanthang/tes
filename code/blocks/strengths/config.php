<?php 
	$params = array (
		'suffix' => array(
					'name' => 'Hậu tố',
					'type' => 'text',
					'default' => '_strengths'
					),
		'limit' => array(
					'name' => 'Giới hạn',
					'type' => 'text',
					'default' => '4'
					),
//		'identity' => array(
//					'name' => 'Đánh dấu id ( cho slideshow)',
//					'type' => 'text',
//					'default' => ''
//		
		'show_readmore' => array(
				'name'=>'Hiện thị readmore',
				'type' => 'is_check',
		),
		'catid'=>array(
					'name'=> 'cat_id',
					'type' => 'text',
					'default' => '2'
				),

		'style' => array(

					'name'=>'Style',
					'type' => 'select',
					'value' => array('group_catid_2' => 'group_catid_2','group_catid_2_ngang'=>'group_catid_2_ngang',
				)
		),

		'summary' => array(
				'name' => 'Mô tả',
				'type' => 'textarea',
				'default' => ''
				),
	);
?>