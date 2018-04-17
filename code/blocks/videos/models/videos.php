<?php
class VideosBModelsVideos {
	function __construct() {
	}
	
	function get_list($ordering, $limit) {
		global $db;
		$where = '';
		$order = '';
		global $tmpl;
		switch ($ordering) {
			case 'new' :
				$order .= ' id DESC ';
				break;
			case 'selling' :
				$order .= ' ordering DESC ';
				break;
			default :
				$order = " id DESC ";
		}
		$fs_table = FSFactory::getClass ( 'fstable' );
		$query = ' SELECT id, title, image,file_flash,summary,avatar
					FROM ' . $fs_table->getTable ( 'fs_videos' ).'
					WHERE published  = 1 
					' . $where . '
					ORDER BY ' . $order .' LIMIT '.$limit;
		
		$db->query ( $query );
		$list = $db->getObjectList();
		return $list;
	}
}
?>