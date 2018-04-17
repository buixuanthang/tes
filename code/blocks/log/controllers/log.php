<?php
/*
 * Huy write
 */
		
	class LogBControllersLog
	{
		function __construct()
		{
		}
		function display($parameters,$title)
		{
			if(isset($_COOKIE['user_id'])){
				include 'blocks/log/models/log.php';
				$model = new LogBModelsLog();
				$user = $model -> get_user();
//				$no_downloads = $model -> get_count_message_download($user -> id); 
//				$no_messages = $model -> get_count_message($user -> id); 
			}
			$style = $parameters->getParams('style');
			$style = $style?$style:'default';
			// call views
			include 'blocks/log/views/'.$style.'/default.php';
		}
	}
	
?>