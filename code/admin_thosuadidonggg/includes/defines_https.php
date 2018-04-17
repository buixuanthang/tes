<?php
   
	$sort_path = $_SERVER['SCRIPT_NAME'];
//	$sort_path = str_replace('/index.php','', $sort_path);
	$sort_path =  (preg_replace('/\/[a-zA-Z0-9\_]+\.php/i', '', $sort_path));
	
	// lấy folder administrator
	$pos = strripos($sort_path,'/');
	$folder_admin = substr($sort_path,($pos+1));
						
	
	define('URL_ROOT', "https://" . $_SERVER['HTTP_HOST'] . str_replace($folder_admin, '', $sort_path));	
	define('URL_ROOT_REDUCE',str_replace($folder_admin, '', $sort_path));
	
	if (!defined('DS')) {
		define('DS', DIRECTORY_SEPARATOR);
	}
	$path = $_SERVER['SCRIPT_FILENAME'];
	$path = str_replace('index.php','', $path);
	$path = str_replace('index2.php','', $path);
	$path = str_replace('/',DS, $path);
	$path = str_replace('\\',DS, $path);
	$path = str_replace(DS.$folder_admin.DS,DS, $path);
	
	define('PATH_BASE', $path);
	define('IS_REWRITE', 1);
	define('WRITE_LOG_MYSQL',1);
	//$positions = array ('left' => 'Bên trái','right' => 'Bên phải', 'top' => 'Bên trên','pos1' => 'Dưới menu', 'pos2' =>'Phía trên nội dung', 'pos3'=>'Phía dưới nội dung','pos4' =>'Trên footer','out_left'=>'Trượt trái','out_right' => 'Trượt phải');
	$positions = array ('left' => 'Bên trái','right' => 'Bên phải', 'pos2' =>'Phía trên nội dung', 'pos3'=>'Phía dưới nội dung','pos4' =>'Trên footer','out_left'=>'Trượt trái','out_right' => 'Trượt phải','banner_home'=>'Banner Popup chính diện',
		'home_pos_0' => 'Home pos 0','home_pos_1' => 'Home pos 1','home_pos_2' => 'Home pos 2','home_pos_3' => 'Home pos 3','pos_mixed_left'=> 'Pos_mixed_left','pos_mixed_right'=> 'Pos_mixed_right','home_r'=>'home_r'
	);
?>
