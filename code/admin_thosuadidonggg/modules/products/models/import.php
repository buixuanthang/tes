<?php 
	class ProductsModelsImport extends FSModels
	{
		function __construct() {
			
			$this->type = 'products';
			$this->table_name = 'fs_products';
			$this->use_table_extend = 1;
			$this->table_category = 'fs_' . $this->type . '_categories';
			$this->table_types = 'fs_' . $this->type . '_types';;
			
			$this->calculate_filters = 1;
			
			parent::__construct ();
			$this->load_params ();
		}
		
		// Cập nhật thông tin  sản phẩm
		function import_film_info($excel,$path){
			$fsstring = FSFactory::getClass('FSString','','../');	
			$file_path = $path.$excel;
			require_once("../libraries/excel/phpExcelReader/Excel/reader.php");
			$data = new Spreadsheet_Excel_Reader();
			$data->setOutputEncoding('UTF-8');
			$data->read($file_path);
			unset($total_product);			
			$total_product =count($data->sheets[0]['cells']);
			$info_import_product =array();
			unset($j);
					
			//Lấy  tên trong bang exel
			$arr_field_name = $data->sheets['0']['cells']['1'];
			$total_field_name =count($arr_field_name);
			//end Lấy  tên trong bang exel
			
			$rs = 0;
			for($j=2;$j<=$total_product;$j++){
				$info_import_product['id'] = preg_replace('/[^0-9]+/i','',$this->get_cell_content_by_name($data,0,$j,'Id',$arr_field_name));
				$info_import_product['name'] = $this->get_cell_content_by_name($data,0,$j,'Name',$arr_field_name);
				$info_import_product['price'] =  preg_replace('/[^0-9]+/i','',$this->get_cell_content_by_name($data,0,$j,'Price',$arr_field_name));
				$info_import_product['quantity'] =  preg_replace('/[^0-9]+/i','',$this->get_cell_content_by_name($data,0,$j,'Quantity',$arr_field_name));
				if(!$info_import_product['price'])
					continue;

				$row = array();
				$row['name']          = $info_import_product['name'];
				$row ['price_old']    = $info_import_product['price'];
				$row ['quantity']     = $info_import_product['quantity'];

				$product_exist =$this -> get_record('id="'.$info_import_product['id'].'"','fs_products','id,alias,name,tablename,discount_unit,discount');
				
				if($product_exist){
					//price
					$discount_unit = $product_exist->discount_unit;
					$discount = $product_exist->discount;
					$price_old = $row ['price_old'];
					if ($discount_unit == 'percent') {
						if ($discount > 100 || $discount < 0) {
							$row ['price_old'] = $price_old;
							$row ['price'] = $price_old;
							$row ['discount'] = 0;
							
						} else {
							$row ['price_old'] = $price_old;
							$row ['discount'] = $discount;
							$row ['price'] = $price_old * (100 - $discount) / 100;			
						}
					
					} else {
						if ($discount > $price_old || $discount < 0) {
							$row ['price_old'] = $price_old;
							$row ['price'] = $price_old;
							$row ['discount'] = 0;
						} else {
							$row ['price_old'] = $price_old;
							$row ['discount'] = $discount;
							$row ['price'] = $price_old - $discount;
						}
					}
					$table_name = isset($product_exist->tablename)?$product_exist->tablename:'';
					$result = $this -> _update($row,'fs_products','  id = "'.$product_exist -> id.'"',1);
					if($result){
						$ext_id = $this->save_extend_from_specs_in_excel($info_import_product['specs'], $product_exist -> id,0,'',$table_name,$row,0 );
						$rs++;
					}
				}
			}
			return $rs;
		}
		
		/*
		 * Lưu lại trường mở rộng trong trường SPECS từ EXCEL
		 * Chú ý cấu trúc SPECS: Mỗi trường mở rộng một dòng
		 * 
		 */
		function save_extend_from_specs_in_excel($specs, $product_id,$add = 1,$products_tables_all,$table_name,$row,$edit_specs = 0){
			if(!$table_name || !$product_id)
				return;
			$row2 = $row;
			unset($row2['id']);
			$this -> _update($row2, $table_name,'record_id = '.$product_id,1);
		}
		
		function get_cell_content_by_name($data,$sheet_index,$row_index,$field_name,$arr_field_name){
			$dem=1;
			foreach ($arr_field_name as $key=>$item) {
				if($field_name == $item){
					if($dem > 1){
						Errors::_ ( 'File bạn vừa nhập có '.$dem.' : '.$field_name);
						return false;
					}
					else
						$content = isset($data->sheets[$sheet_index]['cells'][$row_index][$key])?$data->sheets[$sheet_index]['cells'][$row_index][$key]:'';
					$dem++;
				}
			} 
			return $content;
		}
		  
	  function seems_utf8($str) {
	        for ($i=0; $i<strlen($str); $i++) {
	            if (ord($str[$i]) < 0x80) continue; # 0bbbbbbb
	            elseif ((ord($str[$i]) & 0xE0) == 0xC0) $n=1; # 110bbbbb
	            elseif ((ord($str[$i]) & 0xF0) == 0xE0) $n=2; # 1110bbbb
	            elseif ((ord($str[$i]) & 0xF8) == 0xF0) $n=3; # 11110bbb
	            elseif ((ord($str[$i]) & 0xFC) == 0xF8) $n=4; # 111110bb
	            elseif ((ord($str[$i]) & 0xFE) == 0xFC) $n=5; # 1111110b
	            else return false; # Does not match any model
	            for ($j=0; $j<$n; $j++) { # n bytes matching 10bbbbbb follow ?
	                if ((++$i == strlen($str)) || ((ord($str[$i]) & 0xC0) != 0x80))
	                    return false;
	            }
	        }
	        return true;
	    }
	}
	
?>