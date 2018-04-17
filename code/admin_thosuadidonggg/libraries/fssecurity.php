<?php
class FSSecurity
{
	function __construct(){
		
	}
	static function check_permission($module,$view='',$task=''){
	
		if(!$module)
			$module = FSInput::get('module');
			
		if(!$view)
			$view =  FSInput::get('view',$module);
		if(!$task)
			$task = 'display';
		$module = strtolower($module);
		$view = strtolower($view);
		$task = strtolower($task);
		if($module == 'users' && $view == 'log' && $task == 'logout' )
			return true;
			
		if(!isset($_SESSION['ad_userid']))
			return false;

		global $db;
		// get task_id
	
		$sql = 'SELECT id,`trigger` FROM fs_permission_tasks WHERE module = "'.$module.'" AND `view` = "'.$view.'"' ;
		$task_db = $db->getObject($sql);
		if(!$task_db)
			return true;

			// trigger	
			
		
		$user_id = $_SESSION['ad_userid'];
        
        $sql_permission_user = ' SELECT user_id FROM fs_users_permission WHERE user_id = "'.$user_id.'" ' ;
        $permission_user = $db->getObjectList($sql_permission_user);
        if(!count($permission_user))
			return true;
		
		$sql_permission = ' SELECT permission FROM fs_users_permission WHERE user_id = "'.$user_id.'" AND task_id IN ('.$task_db -> id.') ' ;
		$permission = $db->getResult($sql_permission);

		// not set: return true
		if(!$permission)
			return false;


		// view	
			if(($task == 'display' || $task =='detail' || $task == 'edit'  || $task == 'permission' ) && $permission < 3)
				return false;
			if(($task == 'save' || $task =='add'  || $task== 'apply' || $task =='hot' || $task == 'unhot'  ||  $task =='home' || $task == 'unhome'|| $task== 'save_new' || $task== 'duplicate' ||  $task== 'save_all' || $task== 'permission_save'|| $task== 'permission_apply' ) && $permission < 5){
				return false;
			}
			if(($task == 'remove' || $task =='delete' || $task == 'del' ) && $permission < 7)
				return false;
			return true;
	}

	static function save_history($module,$view='',$task=''){
	
		if(!$module)
			$module = FSInput::get('module');
			
		if(!$view)
			$view =  FSInput::get('view',$module);
		if(!$task)
			$task = 'display';
		$module = strtolower($module);
		$view = strtolower($view);
		$task = strtolower($task);
		if($module == 'users' && $view == 'log' && $task == 'logout' )
			return true;

		if($task == 'display' || $task=='edit' || $task == 'add' || $task== 'cancel' || $task == 'select_categories'){
			return;
		}

		if(!isset($_SESSION['ad_userid']))
			return false;

		$row = array();

		$ids = FSInput::get('id',array(),'array');
		// if(empty($ids)){
		// 	$ids = FSInput::get('cid',array(),'array');
		// }
		
		if(count($ids)){
			$row['ids_action']  = implode(',',$ids);				
		}
		
	
		$row['module'] = $module;
		$row['view'] = $view;
		$row['task'] = $task;
		$row['module'] = $module;

		$row['user_id'] = $_SESSION['ad_userid'];
		$row['username'] = $_SESSION['ad_username'];
		$row['ipaddress'] = $_SERVER['REMOTE_ADDR'];
		
		$time = date('Y-m-d H:i:s');	
		$row['created_time'] = $time;
		
		
		FSSecurity :: _add($row,'fs_admin_history');
	}


	function _add($row,$table_name,$use_mysql_real_escape_string = 0){
			if(!$table_name)
				return false;
			global $db;	
			$str_fields = array();
			$str_values = array();
			
			if(!count($row))
				return;
			foreach($row as $field => $value){
				if($use_mysql_real_escape_string){
					$value = $db -> escape_string($value);	
				
				}
				$str_fields[] =   "`".$field."`";
				$str_values[]  =   "'".$value."'";
			}
			
			$str_fields = implode(',',$str_fields);
			$str_values = implode(',',$str_values);
			
			global $db;
			
			$sql = ' INSERT INTO  '.$table_name ;
			$sql .=  '('.$str_fields.') ';
			$sql .=  'VALUES ('.$str_values.') ';
			
			$id = $db->insert($sql);
			return $id;
		}
		
	

}