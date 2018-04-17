<?php
	// models 
	class UsersControllersUsers   extends Controllers 
	{
		var $module;
		var $gid;
		function __construct()
		{
//			$module = 'users';
//			$this->module = $module ;
			parent::__construct(); 
			$this->gid = FSInput::get('gid');
		}
		function display()
		{
			$sort_field  = FSInput::get('sort_field');
			$sort_direct = FSInput::get('sort_direct');
			$sort_direct = $sort_direct?$sort_direct:'asc';
			
			if(@$sort_field)
			{
				$_SESSION['userlist_sort_field']  =  $sort_field  ;
				$_SESSION['userlist_sort_direct']  = $sort_direct ;
			}
			
			$keysearch = FSInput::get('keysearch');
			if(isset($_POST['keysearch']))
			{
				$_SESSION['ss_usr_keysearch']  =  $_POST['keysearch']  ;
			}
//			$select_cat = FSInput::get('select_cat');
			
			if(	isset($_POST['select_group']))
			{
				$_SESSION['ss_usr_group']  =  $_POST['select_group'] ;
			}
			
			// call models
			$model = new UsersModelsUsers();

	//		$all_groups = $model->getUserGroupsAll();
			
			$list = $model->getUserList();
			$pagination = $model->getPagination();
			

			// call views
			
			include 'modules/'.$this->module.'/views/users/list.php';
		}
		
		
		function add()
		{
			$model = new UsersModelsUsers();
	//		$groups_all = $model->getUserGroupsAll();
			include 'modules/'.$this->module.'/views/users/detail.php';
		}
		function edit()
		{
			$model = new UsersModelsUsers();
			$data = $model->getUserById();
	//		$groups_all = $model->getUserGroupsAll();
	//		$groups_contain_user = $model->getUserGroupsByUser();
			include 'modules/'.$this->module.'/views/users/detail.php';
		}
		function remove()
		{
			$model = new UsersModelsUsers();

			$rows = $model->remove();
			if($rows)
			{
				setRedirect('index.php?module=users&view=users',$rows.' '.FSText :: _('record was deleted'));	
			}
			else
			{
				setRedirect('index.php?module=users&view=users',FSText :: _('Not delete'),'error');	
			}
		}
		function published()
		{
			$model = new UsersModelsUsers();
			$rows = $model->published(1);
			if($rows)
			{
				setRedirect('index.php?module=users&view=users',$rows.' '.FSText :: _('record was published'));	
			}
			else
			{
				setRedirect('index.php?module=users&view=users',FSText :: _('Error when published record'),'error');	
			}
		}
		function unpublished()
		{
			$model = new UsersModelsUsers();
			$rows = $model->published(0);
			if($rows)
			{
				setRedirect('index.php?module=users&view=users',$rows.' '.FSText :: _('record was unpublished'));	
			}
			else
			{
				setRedirect('index.php?module=users&view=users',FSText :: _('Error when unpublished record'),'error');	
			}
		}
		function apply()
		{
			$model = new UsersModelsUsers();
			
			$id = FSInput::get('id');
			if(!$id){
				if($model->check_exits_email()){
					setRedirect('index.php?module=users&view=users',FSText :: _('Email này đã có người sử dụng'),'error');	
				}
				if($model->check_exits_username()){
					setRedirect('index.php?module=users&view=users',FSText :: _('Username này đã có người sử dụng'),'error');	
				}
			}
			// check password and repass
			$password = FSInput::get("password1");
			$repass = FSInput::get("re-password1");
			if(@$id)
			{
				$edit_pass = FSInput::get('edit_pass');
				if($edit_pass){
					if(!$password || ($password != $repass))
					{
						setRedirect('index.php?module=users&view=users',FSText :: _('You must enter a valid password'),'error');
					}
				}
			}
			else
			{
				if(!$password || ($password != $repass))
				{
					setRedirect('index.php?module=users&view=users',FSText :: _('You must enter a valid password'),'error');
				}	
			}
			// call Models to save
			$id = $model->save();
			
			if($id)
			{
				setRedirect("index.php?module=users&view=users&task=edit&id=$id",FSText :: _('Saved'));	
			}
			else
			{
				setRedirect('index.php?module=users&view=users',FSText :: _('Not save'),'error');	
			}
			
		}
		function save()
		{
			$model = new UsersModelsUsers();
			$id = FSInput::get('id');
			if(!$id){
				if($model->check_exits_email()){
					setRedirect('index.php?module=users&view=users',FSText :: _('Email này đã có người sử dụng'),'error');	
				}
				if($model->check_exits_username()){
					setRedirect('index.php?module=users&view=users',FSText :: _('Username này đã có người sử dụng'),'error');	
				}
			}
			// check password and repass
			$password = FSInput::get("password1");
			$repass = FSInput::get("re-password1");
			if(@$id)
			{
				$edit_pass = FSInput::get('edit_pass');
				if($edit_pass){
					if(!$password || ($password != $repass))
					{
						setRedirect('index.php?module=users&view=users',FSText :: _('You must enter a valid password'),'error');
					}
				}
			}
			else
			{
				if(!$password || ($password != $repass))
					setRedirect('index.php?module=users&view=users',FSText :: _('You must enter a valid password'),'error');	
			}
			
			// call Models to save
			$id = $model->save();
			
			if($id)
			{
				setRedirect('index.php?module=users&view=users&id='.$id,FSText :: _('Saved'));	
			}
			else
			{
				setRedirect('index.php?module=users&view=users',FSText :: _('Not save'),'error');	
			}
			
		}
		
		function cancel()
		{
			setRedirect('index.php?module=users&view=users');	
		}
		
		/*********************************** CREATE LINK *********************************/

		function linked()
		{
			$model = new UsersModelsUsers();
			$linked_list = $model->getCreateLink();
			$parent_list = $model->getParentLink();
			
			$id = FSInput::get('id');
			if($id)
			{
				$linked = $model -> getLinkedById($id);
			}
			include 'modules/'.$this->module.'/views/users/linked.php';
			
		}
		/*********************************** end CREATE LINK *********************************/

		
		/*********************************** PERMISSION *********************************/

	function permission_save() {
		$model = new UsersModelsUsers();

		$id = FSInput::get('id',0,'int');
		$link = "index.php?module=users&view=users&task=permission&id=".$id."" ;
		$rs = $model->permission_save ($id);
		
		// if not save
		if ($rs) {
			setRedirect ( $link, 'Đã lưu thành công' );
		} else {
			setRedirect ( $link, 'Bạn chưa lưu thành công', 'error' );
		}
	}
	function permission_apply() {
		$model = new UsersModelsUsers();

		$id = FSInput::get('id',0,'int');
		$link =  'index.php?module=users&view=users&task=permission&id='.$id ;
		$rs = $model->permission_save ($id);
		// if not save
		if ($rs) {
			setRedirect ( $link, 'Đã lưu thành công' );
		} else {
			setRedirect ( $link, 'Bạn chưa lưu thành công', 'error' );
		}
	}
	
	function permission(){
		$id = FSInput::get('id');
		if(!$id || $id == 1 || $id==9){
			echo "Không được quyền sửa user này";
			return;
		}
		$model = $this -> model;
		$list_task = $model -> get_records('published = 1','fs_permission_tasks','*','ordering ASC, id ASC');
		$arr_task = array();
		foreach($list_task as $item){
			if(!isset($arr_task[$item -> module][$item -> view]))
				$arr_task[$item -> module][$item -> view] = array();
			$arr_task[$item -> module][$item -> view] = $item;	
		}
		
		// other
		$news_categories = $model->get_news_categories ();
		$products_categories = $model->get_products_categories ();
		
		$data = $model -> get_record_by_id($id,'fs_users');
		$list_permission = $model -> get_records(' user_id = '.$data -> id,'fs_users_permission','*','','','task_id');
		include 'modules/' . $this->module . '/views/' . $this->view . '/permission.php';
	}
		
		/*********************************** end PERMISSION *********************************/		

	function show_permission($data){
		$link_permission = "index.php?module=users&view=users&task=permission&id=".$data->id;

		$str = '';
				
		$str =  '<a href="'.$link_permission.'" title="Phân quyền" class="">
									<img src="templates/default/images/user.png" alt="">
			</a>';			
		
		return $str;
	} 
}
	
?>