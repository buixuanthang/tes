<?php 
	class VideosModelsVideos extends FSModels
	{
		var $limit;
		var $prefix ;
		function __construct()
		{
			$this -> limit = 20;
			$this -> view = 'videos';
			// $this -> table_name = 'fs_videos';
			$this -> table_name = FSTable_ad::_ ('fs_videos');
			$this -> arr_img_paths = array(array('resized',370,240,'cut_image'),array('small',180,132,'cut_image'),array('large',580,370,'cut_image'));
			$this -> img_folder = 'images/videos';
			$this -> field_img = 'image';
//			$this -> image_watermark = array('path_image_watermark'=>'images/mask/icon-videos-big.png','position'=>0); //Đóng dấu nên ảnh
			parent::__construct();
		}
		
		function setQuery(){
			
			// ordering
			$ordering = "";
			$where = "  ";
			if(isset($_SESSION[$this -> prefix.'sort_field']))
			{
				$sort_field = $_SESSION[$this -> prefix.'sort_field'];
				$sort_direct = $_SESSION[$this -> prefix.'sort_direct'];
				$sort_direct = $sort_direct?$sort_direct:'asc';
				$ordering = '';
				if($sort_field)
					$ordering .= " ORDER BY $sort_field $sort_direct, created_time DESC, id DESC ";
			}
			
			if(!$ordering)
				$ordering .= " ORDER BY created_time DESC , id DESC ";
			
			if(isset($_SESSION[$this -> prefix.'keysearch'] ))
			{
				if($_SESSION[$this -> prefix.'keysearch'] )
				{
					$keysearch = $_SESSION[$this -> prefix.'keysearch'];
					$where .= " AND a.title LIKE '%".$keysearch."%' ";
				}
			}
			
			$query = " SELECT a.*
						  FROM 
						  	".$this -> table_name." AS a
						  	WHERE 1=1 ".
						 $where.
						 $ordering. " ";
			return $query;
		}

		function hot($value)
		{
			$ids = FSInput::get('id',array(),'array');
			
			if(count($ids))
			{
				global $db;
				$str_ids = implode(',',$ids);
				$sql = " UPDATE ".$this -> table_name."
							SET is_hot = $value
						WHERE id IN ( $str_ids ) " ;
				$db->query($sql);
				$rows = $db->affected_rows();
				return $rows;
			}
			return 0;
			
		}

	}
	
?>