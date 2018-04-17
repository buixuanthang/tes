<?php 
	class PartnersBModelsPartners
	{
		function __construct()
		{
		}
		
		function get_data($limit){

				$fs_table = FSFactory::getClass ( 'fstable' );
		
			$where=" ";
			$query = "  SELECT id,name,image,url
					FROM " . $fs_table->getTable ( 'fs_partners' )."
					WHERE published =1 ".$where."
					 ORDER BY RAND()
					 LIMIT $limit  
					 ";
			global $db;
			$db->query($query);
			$result = $db->getObjectList();
			return $result;
		}
	}
	
?>