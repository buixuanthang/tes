<?php 
	class DocumentsModelsDocuments extends FSModels
	{
		var $limit;
		var $prefix ;
		function __construct()
		{
			$this -> limit = 20;
			$this -> view = 'documents';
			$this -> table_name = FSTable_ad::_ ('fs_documents');
			$this -> table_category_name = FSTable_ad::_ ('fs_documents_categories');
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
			if(isset($_SESSION[$this -> prefix.'filter0'])){
				$filter = $_SESSION[$this -> prefix.'filter0'];
				if($filter){
					$where .= ' AND category_id  =    '.$filter.' ';
				}
			}
			if(!$ordering)
				$ordering .= " ORDER BY ordering DESC , id DESC ";
			
			
			if(isset($_SESSION[$this -> prefix.'keysearch'] ))
			{
				if($_SESSION[$this -> prefix.'keysearch'] )
				{
					$keysearch = $_SESSION[$this -> prefix.'keysearch'];
					$where .= " AND ( a.name LIKE '%".$keysearch."%' )";
				}
			}
			$query = " SELECT a.*,c.name as category_name, a.alias as ccode
						  FROM 
						  ".$this -> table_name." AS a
							LEFT JOIN ".$this -> table_category_name." AS c ON a.category_id  = c.id
						  	WHERE 1=1".
						 $where.
						 $ordering. " ";
						
			return $query;
		}
		
		/*
		 * select in category
		 */
		function get_categories_tree()
		{
			global $db ;
			$sql = " SELECT id, name, parent_id AS parent_id 
				FROM ".$this -> table_category_name." ";
			$db->query($sql);
			$categories =  $db->getObjectList();
			$tree  = FSFactory::getClass('tree','tree/');
			$rs = $tree -> indentRows($categories,1); 
			return $rs;
		}
		function save(){
			$name = FSInput::get('name');

			if(!$name){
				Errors::_('You must entere name');
				return false;
			}
//			if(!$code){
//				Errors::_(FSText::_('You must entere').' '.FSText::_('Code'));
//				return false;
//			}

			$id = FSInput::get('id',0,'int');
			$alias= FSInput::get('alias');
			$fsstring = FSFactory::getClass('FSString','','../');
			if(!$alias){
				$row['alias'] = $fsstring -> stringStandart($name);
			} else {
				$row['alias'] = $fsstring -> stringStandart($alias);
			}
			
			// category and category_id_wrapper
			$category_id = FSInput::get('category_id',0,'int');
			if(!$category_id)
				return false;
			$cat =  $this->get_record_by_id($category_id,$this -> table_category_name);
			$row['category_id_wrapper'] = $cat -> list_parents;
//			$row['category_root_alias'] = $cat -> root_alias;
			$row['category_alias_wrapper'] = $cat -> alias_wrapper;
			$row['category_name'] = $cat -> name;
			$row['category_alias'] = $cat -> alias;

//				Errors::_('Name must unique');
//				return false;
//			}

			
			$file_upload = $_FILES["file_upload"]["name"];
			if($file_upload){
				$path_original = '../images/upload_file/';
				// remove old if exists record and img
				if($id){
					$img_paths = array();
					$img_paths[] = $path_original;
					// special not remove when update
//					$this -> remove_file($id,$img_paths,'file_upload');
				}
				$fsFile = FSFactory::getClass('FsFiles');
				// upload
				$file_upload_name = $fsFile -> upload_file("file_upload", $path_original ,10000000, '_'.time());
				if($file_upload_name){
					$row['file_upload'] = 'images/upload_file/'.$file_upload_name;	
				}
				// 	return false;
				
			}
		
			$id =  parent::save($row);
			return $id;
		}

	}
	
?>