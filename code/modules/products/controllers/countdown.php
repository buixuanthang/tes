<?php
/*
 * Huy write
 */
	// controller
	
	class ProductsControllersCountdown  extends FSControllers
	{
		var $module;
		var $view;
		function __construct()
		{
			parent::__construct ();
		}
		function display()
		{
			// call models
			$model = $this->model;
			
			$tense = 0;// hiện tại
			$data = null;
			// lấy sản phẩm ko chạy continuity
			$data_no_continuity = $model -> get_datas_current(0);
			$data_buffer_last = null;
			if($data_no_continuity){
				$data = $data_no_continuity;
				$started_time = strtotime($data ->started_time);
				$finished_time = strtotime($data ->finished_time);
			}else{
				// lấy sản phẩm chạy continuity
				$datas = $model -> get_datas_current(1);
				$continuity_last_time = null;
				if(count($datas)){
					$i = 0;
					foreach($datas as $item){
							$i ++;
							// chưa tới giờ
							if($i == 1 && $item -> started_time > time() )
								break;
							// đang chạy cái đầu tiên
							if($i == 1 && strtotime($item -> started_time) <= time()  && strtotime($item -> finished_time) >= time() && $item -> sales < $item -> quantity ){
								
								$data = $item;
								$started_time = strtotime($item -> started_time);
								$finished_time = strtotime( $item ->  finished_time) ;
								break;
								
								// đánh dấu
//								if(!$item -> continuity_started_time || !$item -> continuity_finished_time || ($item -> continuity_started_time ) || !$item -> continuity_finished_time)
//								
							}
							
							if($i == 1 && strtotime($item -> started_time) <= time()  &&strtotime( $item -> finished_time) >= time() && $item -> sales >= $item -> quantity ){
							
//								$data = $item;
//								$started_time = strtotime($item -> started_time);
//								$finished_time = strtotime( $item ->  finished_time) ;
								$continuity_last_time = time();
								// đánh dấu nếu chưa có
								if(!$item -> continuity_started_time || !$item -> continuity_finished_time){
									$model -> update_finish_continuity($item,strtotime($item -> started_time),$continuity_last_time);
								}
								continue;
							}
							// đã kết thúc lượt coundown trước
//							if($item -> finished_time < time() ){
								$c  = 0;
//								if(!$item -> continuity_started_time || !$item -> continuity_finished_time){
									$started_new_time = $continuity_last_time?$continuity_last_time:strtotime($item -> started_time);
									$finished_new_time = $continuity_last_time?$continuity_last_time + abs(strtotime( $item ->  finished_time) - strtotime( $item ->  started_time)): strtotime($item ->  finished_time);
									
									// trường hợp bị đẩy lùi time xuống
									if($started_new_time <= time() && $finished_new_time >= time ()  && $item -> sales < $item -> quantity ){
										$data = $item;
										$started_time = $started_new_time;
										$finished_time = $finished_new_time ;
										$model -> update_finish_continuity($item,$started_new_time,$finished_new_time);
										$tense = 0;
										break;
									}
									if($finished_new_time < time() || $item -> sales >= $item -> quantity){
										$model -> update_finish_continuity($item,$started_new_time,$finished_new_time);
									}
									$c = 1;
									$continuity_last_time = $finished_new_time;
//								}
								$data_buffer_last = $item;
								$continuity_last_time = $c ? $continuity_last_time : strtotime($item -> continuity_finished_time);
								continue;
//							}

							// các trường hợp còn lại
							
//							if( $item -> started_time > time() ){
//								
//								$started_new_time = $continuity_last_time;
//								$finished_new_time = strtotime( $item ->  finished_time) ;
//							}
//							
//							
//							
//							if( $item -> sales  >= $item -> quantity ){
//								$data_buffer_last = $item;
//								$continuity_last_time = strtotime($item -> continuity_finished_time);
//								continue;
//							}
//							if(  $item -> continuity_finished_time  && strtotime($item ->  continuity_finished_time) < time() ){
//								$data_buffer_last = $item;
//								$continuity_last_time = strtotime($item -> continuity_finished_time);
//								continue;
//							}
//							if(!$item -> continuity_started_time){
//								$continuity_started_time = $continuity_last_time?($continuity_last_time):strtotime($item -> started_time);
//	//							echo $data_buffer_last -> id.'++';
//	//							echo "**".date('Y-m-m H:i:s',$continuity_started_time)."--<br/>";			
//								
//								
//								
//	//							$model -> update_continuity($item,$continuity_started_time);
//								
//								$started_time = strtotime($continuity_started_time);
//								$finished_time = $started_time + ( $item ->  continuity_total_time * 60) ;
//								$continuity_last_time = $finished_time;
//								
//	//							echo "**".date('Y-m-m H:i:s',$continuity_started_time)."--<br/>";
//	//							echo "**".date('Y-m-m H:i:s',$continuity_last_time)."-----<br/><br/>";	
//								
//								$model -> update_continuity($item,$continuity_started_time,$finished_time);
//								
//								if(  $finished_time < time() ){
//									$data_buffer_last = $item;
//									continue;
//								}
//								
//								$data = $item;
//								break;
//							}else{
//								$continuity_started_time = $item -> continuity_started_time;
//								$data = $item;
//								
//								$started_time = strtotime($continuity_started_time);
//								$finished_time = $started_time + ( $item ->  continuity_total_time * 60) ;
//								break;
//							}
					}
				}
			}
			if(!$data || ($data && ($data -> sales >= $data -> quantity) )){
				$data = $model -> get_data_next();
				$tense = 1;
				$started_time = strtotime(@$data -> started_time);
				$finished_time = strtotime(@$data -> finished_time);
				
				if(!$data || ($data && ($data -> sales >= $data -> quantity) )){
					if($data_buffer_last)
						$data = $data_buffer_last;
					else
						$data = $model -> get_data_last();
//					$total_boughts =  $model -> get_boughts(@$data -> id);
					$tense = -1;
				}
			}
			
			
			if($data){
				$product = $model -> get_record_by_id($data -> product_id,'fs_products');
				$color =  $model -> get_record_by_id($data -> color_id,'fs_products_colors');
//				$total_boughts =  $model -> get_boughts($data -> id);
//				if($total_boughts >= $data -> quantity){
//					$tense = -1;
//				}
			}
			
			$user = $model -> get_user();
			
			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>'Đấu giá ngược', 1 => '');
			global $tmpl,$module_config;
			
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			$tmpl -> set_seo_special();
			
			// call views			
			include 'modules/'.$this->module.'/views/'.$this->view.'/default.php';
		}
	}
?>