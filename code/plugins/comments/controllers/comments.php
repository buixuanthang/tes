<?php
/*
 * Huy write
 */
	// controller
	include 'plugins/comments/models/comments.php';
	
	class CommentsPControllersComments
	{
		var $module;
		var $view;
		function display($data){
			$model = new CommentsPModelsComments();
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
	
			$pagination = $model->getPagination($total,$data);

		

	
			$amp = FSInput::get('amp',0,'int');
			

			include 'plugins/comments/views/comments'.($amp?'_amp':'').'/default.php';
			// $return['content']= $html;
			
			// echo json_encode($return);
		}

	}
	
?>