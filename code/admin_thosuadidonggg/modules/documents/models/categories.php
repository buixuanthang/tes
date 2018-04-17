<?php 
	class DocumentsModelsCategories extends ModelsCategories
	{
		function __construct()
		{
			$this -> limit = 10;
			$this -> table_items = FSTable_ad::_ ('fs_documents');
			$this -> table_name = FSTable_ad::_ ('fs_documents_categories');
			$this -> check_alias = 1;
			$this -> call_update_sitemap = 0;
			parent::__construct();
		}
		
		
	}
	
?>