<?php 
	class LogBModelsLog
	{
		function __construct()
		{
		}
		
		function get_user(){
			global $db ;
			if(!isset($_COOKIE['user_id']))
				return;
			$sql = " SELECT *
					FROM fs_members
					WHERE published  = 1
						AND id = ".$_COOKIE['user_id']." 
					";
			$db->query($sql);
			return   $db->getObject();
				
		}
		/*
		 * Thấy các thông báo download chưa đọc
		 */
		function get_count_message_download($user_id){
			global $db ;
			if(!$user_id)
				return;
			$sql = " SELECT count(*)
					FROM fs_system_messages
					WHERE  recipient_id = ".$user_id." 
						AND is_read = 0
					";
			$db->query($sql);
			return   $db->getResult();
				
		}
		/*
		 * Thấy các thông báo chưa đọc
		 */
		function get_count_message($user_id){
			global $db ;
			if(!$user_id)
				return;
			$sql = " SELECT count(*)
					FROM fs_messages
					WHERE ( recipients_id LIKE '%\'".$user_id."\'%' OR recipients_username = 'all') 
						AND ( readers_id NOT LIKE '%\'".$user_id."\'%' OR readers_id is NULL) 
						AND ( deleters_id NOT LIKE '%\'".$user_id."\'%'  OR deleters_id is NULL) 
					";
			$db->query($sql);
			return   $db->getResult();
				
		}
	}
?>