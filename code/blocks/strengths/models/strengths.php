<?php 
	class StrengthsBModelsStrengths
	{
		function __construct()
		{
		}
	
		function get_list($category_id, $limit){
			
			global $db;
			$where = "";
			if($category_id){
				$where = ' AND category_id = '.$category_id;
			}
			$query = " SELECT *
						  FROM fs_strengths
						 WHERE  published = 1 ".$where."
						 ORDER BY  ordering ASC 
						 LIMIT ".$limit ." 
						 ";
			$sql = $db->query($query);
			$result = $db->getObjectList();
			return $result;
		}		
		
		
	}

?>