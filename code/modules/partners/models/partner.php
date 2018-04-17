
<?php
class PartnersModelsPartner extends FSModels {
	function __construct() {
		$limit = 10;
		$page = FSInput::get ( 'page' );
		$this->limit = $limit;
		$this->page = $page;
		$fstable = FSFactory::getClass ( 'fstable' );
		$this->table_name = $fstable->_ ( 'fs_partners' );
		
	}
	
	
	/*
		 * get Article
		 */
	function get_data() {
		$id = FSInput::get ( 'id', 0, 'int' );
		if ($id) {
			$where = " AND id = '$id' ";
		} else {
			$code = FSInput::get ( 'code' );
			if (! $code)
				die ( 'Not exist this url' );
			$where = " AND alias = '$code' ";
		}
		
		$query = " SELECT *
						FROM " . $this->table_name  . " 
						WHERE published = 1  
						" . $where . " ";
		global $db;
		$sql = $db->query ( $query );
		$result = $db->getObject ();
		return $result;
	}
	
	
	function get_relates($id) {
		if (! $id)
			die ();
		$code = FSInput::get ( 'code' );
		$where = '';		
		$where .= " AND id <> '$id' ";
		
		
		global $db;
		$limit = 6;
		$fs_table = FSFactory::getClass ( 'fstable' );
		
		$query = " SELECT *
						FROM " . $this->table_name. "
						WHERE
							 published = 1
							" . $where . "
						ORDER BY  id DESC, ordering DESC
						LIMIT 0,$limit
						";
		$db->query ( $query );
		$result = $db->getObjectList ();
		
		return $result;
	}
	
	
}

?>