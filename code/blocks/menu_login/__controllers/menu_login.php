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
			$list_user = array(
				'Thông tin cá nhân' => FSRoute::_('index.php?module=users&view=users&task=edit&Itemid=45'),
				'Đổi mật khẩu' => FSRoute::_('index.php?module=users&view=users&task=changepass&Itemid=45'),
//				'Lịch sử giao dịch' => FSRoute::_('index.php?module=estores&view=order&Itemid=45'),
//				'Đăng tin đi xe chung' => FSRoute::_('index.php?module=estores&view=schedule&task=add&Itemid=45'),
//				'Tin đã đăng' => FSRoute::_('index.php?module=estores&view=schedules&Itemid=45')
			);
			$list_estore = array(
				'Tạo album' => FSRoute::_('index.php?module=estores&view=albums&task=add&Itemid=45'),
				'Danh sách album' => FSRoute::_('index.php?module=estores&view=albums&Itemid=45'),
				'Album của tôi' => FSRoute::_('index.php?module=estores&view=images&Itemid=45'),
				'Upload ảnh' => FSRoute::_('index.php?module=estores&view=images&task=add&Itemid=45'),
//				'Lịch trình (Calendar)' => FSRoute::_('index.php?module=estores&view=booking&Itemid=45')
			);
			include 'blocks/menu_login/views/menu_login/'.$style.'.php';
		}
	}
	
?>