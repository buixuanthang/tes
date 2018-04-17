<?php 
	$params = array (
		'suffix' => array(
					'name' => 'Hậu tố',
					'type' => 'text',
					'default' => '_products'
					),
		'limit' => array(
					'name' => 'Giới hạn',
					'type' => 'text',
					'default' => '10'
					),
		'identity' => array(
					'name' => 'Đánh dấu id ( cho slideshow)',
					'type' => 'text',
					'default' => ''
					),
		'type' => array(
					'name'=>'Lấy theo',
					'type' => 'select',
					'value' => array('newest'=> 'Mới nhất','hotest'=>'Hot nhất','sale'=>'Bán nhiều nhất','random' => 'Ngẫu nhiên','in_cat'=>'Cùng danh mục','same_author'=>'Cùng người đăng','discount'=>"Khuyến mại"),
//					'attr' => array('multiple' => 'multiple'),
			),	
		'filter_category_auto' => array(
				'name'=>'Lọc tự động theo category</i>',
				'type' => 'is_check',
		),		
		'style' => array(
					'name'=>'Style',
					'type' => 'select',
//					'value' => array('default' => 'Mặc định','horizontal'=>'Hàng ngang','vertical'=>'Hàng dọc','vertical_img_large'=>'Hàng dọc ảnh lớn')
					'value' => array('default' => 'Mặc định (slideshow)','vertical_img_large'=>'Hàng dọc ảnh lớn')
			)
	);
?>