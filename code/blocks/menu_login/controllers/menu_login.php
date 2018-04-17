<?php
/*
 * Huy write
 */
	// models 
	include 'blocks/menu_login/models/menu_login.php';
	
	class Menu_loginBControllersMenu_login
	{
		function __construct()
		{
		}
		function display($parameters,$title)
		{
			$group = $parameters->getParams('group');
			$style = $parameters->getParams('style');
			
			$style = $style?$style:'default';
			// call models
			$model = new Menu_loginBModelsMenu_login();
					
				$list = array(
					
					'Thông tin cá nhân' =>	array(
						'Thông tin cá nhân' => array('link' => FSRoute::_('index.php?module=users&view=users&task=edit&Itemid=45'),'icon' => 'user-circle-o' ),
						'Đổi mật khẩu' => array('link' => FSRoute::_('index.php?module=users&view=users&task=changepass&Itemid=45'),'icon' => 'keyboard-o' ),
		        // 'Lịch sử giao dịch' => array('link' => FSRoute::_('index.php?module=users&view=exchange&type=1&Itemid=45'),'icon' => 'history' ),
		        'Sản phẩm yêu thích' => array('link' => FSRoute::_('index.php?module=products&view=favourites&type=1&Itemid=45'),'icon' => 'heart-o' ),						
		         'Đăng xuất' => array('link' => FSRoute::_('index.php?module=users&view=users&task=logout&Itemid=45'),'icon' => 'bell-o' ),			
					)
				);
			include 'blocks/menu_login/views/menu_login/'.$style.'.php';
		}
	}
	
?>