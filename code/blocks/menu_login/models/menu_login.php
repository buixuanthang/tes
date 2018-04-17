<?php 
	class Menu_loginBModelsMenu_login
	{
		function __construct()
		{
		}
		
		function get_guides(){
			$cat = 162;
			$query = ' SELECT * FROM fs_contents WHERE category_id = '.$cat.' AND published = 1 ORDER BY ordering ASC LIMIT 6 ';
			global $db;
			$sql = $db->query($query);
			$result = $db->getObjectList();
			return $result;
		}
	}
?>