<?php
/*
 * Huy write
 */
	// controller
	
	class CommentsControllersComments extends FSControllers
	{
		var $module;
		var $view;
		function display(){
			$model = $this->model;
			// $comments = $model->get_comments ( $id);
			
			$query_body = $model->set_query_body();
			$comments = $model->get_parents($query_body);
			$comments_children = $model->get_list($query_body);

			$total_comment = count ( $comments );
			if ($total_comment) {
				$list_parent = array ();
				$list_children = array ();
				foreach ( $comments as $item ) {
					if (! $item->parent_id) {

						$list_parent [] = $item;
//						$comments_children = $model->get_comments_child($item->id);
					} 
				}
				
				foreach ( $comments_children as $child ) {
					if (! isset ( $list_children [$child->parent_id] ))
						$list_children [$child->parent_id] = array ();
					$list_children [$child->parent_id] [] = $child;
				}
			}
		
			$total = $model -> getTotal($query_body);
	
			$pagination = $model->getPagination($total);

			$return = array();
	
			include 'modules/'.$this->module.'/views/'.$this->view.'/fetch_pages.php';
			// $return['content']= $html;
			
			// echo json_encode($return);
	}

	function save_comment() {
		$return = FSInput::get ( 'return' );
		$url = base64_decode ( $return );
		
		$model = $this->model;
		if (! $model->save_comment ()) {
		// 	$msg = 'Chưa lưu thành công comment!';
		// 	setRedirect ( $url, $msg, 'error' );
			echo 0;
		} else {
			// setRedirect ( $url, 'Cảm ơn bạn đã gửi comment' );
			echo 1;
		}
	}
	function save_comment_amp() {

		$return = FSInput::get ( 'return' );
		$url = base64_decode ( $return );
		
		$model = $this->model;
		if (! $model->save_comment ()) {
		// 	$msg = 'Chưa lưu thành công comment!';
			setRedirect ( $url, $msg, 'error' );
			// echo 0;
		} else {
			setRedirect ( $url, 'Cảm ơn bạn đã gửi comment' );
			// echo 1;
		}
	}

	function save_rate_amp() {

		$return = FSInput::get ( 'return' );
		$url = base64_decode ( $return );
		
		$model = $this->model;
		if (! $model->save_rate ()) {
		// 	$msg = 'Chưa lưu thành công comment!';
			setRedirect ( $url, $msg, 'error' );
			// echo 0;
		} else {
			setRedirect ( $url, 'Cảm ơn bạn đã gửi đánh giá' );
			// echo 1;
		}
	}

	/* Save comment reply*/
	function save_reply() {
		$return = FSInput::get ( 'return' );
		$url = base64_decode ( $return );
		
		$model = $this->model;
		if (! $model->save_comment ()) {
			// $msg = 'Chưa lưu thành công comment!';
			// setRedirect ( $url, $msg, 'error' );
			echo 0;

		} else {
			echo 1;
		}
	}

		

	}
	
?>