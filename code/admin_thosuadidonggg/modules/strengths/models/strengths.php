<?php 
	class StrengthsModelsStrengths extends FSModels
	{
		var $limit;
		var $prefix ;
		function __construct()
		{
			$this -> limit = 10;
			$this -> view = 'strengths';
			
			$this -> table_name = 'fs_strengths';
			// config for save
			$this -> arr_img_paths = array(array('resized',120,120,'cut_image'),array('large',320,320,'cut_image'));
			$this -> img_folder = 'images/strengths';
			$this -> check_alias = 0;
			$this -> field_img = 'image';
			parent::__construct();
		}
		
		function get_data()
		{
			global $db;
			$query = $this->setQuery();
			if(!$query)
				return array();
				
			$sql = $db->query_limit($query,$this->limit,$this->page);
			$result = $db->getObjectList();
			
			return $result;
		}
		
		
	}
	
?>