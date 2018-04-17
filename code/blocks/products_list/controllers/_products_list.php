<?php
/*
 * Huy write
 */
	// models 
	include 'blocks/products_list/models/products_list.php';
	class Products_listBControllersProducts_list
	{
		function __construct()
		{
		}
		function display($parameters,$title)
		{
	        $ordering = $parameters->getParams('ordering'); 
	        $type  = $parameters->getParams('type'); 
			$limit = $parameters->getParams('limit');
			$limit = $limit ? $limit:3; 
			// call models
			$model = new Products_listBModelsProducts_list();
			$style = $parameters->getParams('style');
			$style = $style?$style:'default';
			
			if($style=="tabs"){
				$list_tabs =array();
				$list_tabs['new'] = $model -> get_list($ordering,$limit,'new');
				$list_tabs['selling'] = $model -> get_list($ordering,$limit,'selling');
				$list_tabs['old']  = $model -> get_list($ordering,$limit,'old');
				$html= array('new'=>'', 'selling'=>'', 'old'=>'');
				
				foreach ($list_tabs as $key=>$tabs){
					$link_fisrt = FSRoute::_('index.php?module=products&view=product&code='.@$tabs[0] -> alias.'&ccode='.@$tabs[0]->category_alias.'&id='.@$tabs[0]->id);
					$image_first = str_replace('/original/', '/resized/', @$tabs[0]->image);
					//Bắt đầu cột  đầu tiên
					$html[$key] .= '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">';
						//nội dung  sản phẩm
						$html[$key] .= '<div class="frame_inner">';
						  	$html[$key] .= '<div class="frame_image ">';
				  				$html[$key] .= '<a href="<?php echo $link_newst;?>" title="'.@$tabs[0]->name.'">';
									$html[$key] .= '<img  class="img-responsive" alt="'.@$tabs[0]->name.'" src="'.URL_ROOT.$image_first.'" />';
								$html[$key] .= '</a>';
				        	$html[$key] .= '</div>';
					        $html[$key] .= '<div class="frame_title">';
								$html[$key] .= '<h2>';
									$html[$key] .= '<a href="'.$link_fisrt.'" title = "'.@$tabs[0] -> name.'" class="name" >'.get_word_by_length(50,@$tabs[0] -> name).'</a>';
								$html[$key] .= '</h2>';
				        	$html[$key] .= '</div>';
			        		$html[$key] .= '<div class="frame_warranty">';
								 $html[$key] .= '<span>'.(@$tabs[0]->warranty)?'Bảo hành:'.@$tabs[0]->warranty:'&nbsp;'.'</span>';
                    		$html[$key] .= '</div>';
				        	$html[$key] .= '<div class="frame_price">';
	                           $html[$key] .= ' <div class="price  pull-left">';
	                           		if(isset($tabs[0] ->date_end) && $tabs[0] ->date_end !='' && @$tabs[0]->date_end >  date('Y-m-d H:i:s')  && isset($tabs[0] ->date_start) && $tabs[0] ->date_start !='' && $tabs[0]->date_start <  date('Y-m-d H:i:s') ){
	                           			$html[$key] .= '<span>'.format_money(@$tabs[0] -> price,'đ').'</span>';
	                           		}else{
	                           			$html[$key] .= '<span>'.(@$tabs[0] -> price_old)?format_money(@$tabs[0] -> price_old,'đ'):''.'</span>';
	                           		}
	                            $html[$key] .= '</div>';
	                            $html[$key] .= '<div class="old_price  pull-right"> ';
	                            if(isset($tabs[0] ->date_end) && $tabs[0] ->date_end !='' && $tabs[0]->date_end >  date('Y-m-d H:i:s')  && isset($tabs[0] ->date_start) && $tabs[0] ->date_start !='' && $tabs[0]->date_start <  date('Y-m-d H:i:s') ){
	                            		$html[$key] .= '<span>'.(@$tabs[0] -> price_old)?format_money(@$tabs[0] -> price_old,'đ'):''.'</span>';
	                            	}
	                            $html[$key] .= '</div>';
	                            $html[$key] .= '<div class="clearfix"></div> ';
                       		$html[$key] .= '</div>';		
						$html[$key] .= '</div>';
						// end nội dung  sản phẩm
					$html[$key] .= '</div>';
					//	Kết thúc cột  đầu tiên
					//	 Bắt đầu cột 2 bên trong có 3 cột nhỏ
					$html[$key] .= '<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">';
					$i =0;
					if(count($tabs)){
						foreach ($tabs as $item) {
							if($i > 0){
								$link = FSRoute::_('index.php?module=products&view=product&code='.$item -> alias.'&ccode='.$item->category_alias.'&id='.$item->id);
								$image = str_replace('/original/', '/resized/', $item->image);	
								$html[$key] .= '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">';
									//nội dung  sản phẩm
									$html[$key] .= '<div class="frame_inner">';
									  	$html[$key] .= '<div class="frame_image ">';
							  				$html[$key] .= '<a href="'.$link.'" title="'.$item->name.'">';
												$html[$key] .= '<img  class="img-responsive" alt="'.$item->name.'" src="'.URL_ROOT.$image.'" />';
											$html[$key] .= '</a>';
							        	$html[$key] .= '</div>';
								        $html[$key] .= '<div class="frame_title">';
											$html[$key] .= '<h2>';
												$html[$key] .= '<a href="'.$link.'" title = "'.$item -> name .'" class="name" >'. get_word_by_length(50,$item -> name).'</a>';
											$html[$key] .= '</h2>';
							        	$html[$key] .= '</div>';
							        	$html[$key] .= '<div class="frame_warranty">';
											 $html[$key] .= '<span>'.($item->warranty)?'Bảo hành:'.$item->warranty:'&nbsp;'.'</span>';
			                    		$html[$key] .= '</div>';
							        	$html[$key] .= '<div class="frame_price">';
				                            $html[$key] .= '<div class="price  pull-left">'; 
				                           		if(isset($item ->date_end) && $item ->date_end !='' && $item->date_end >  date('Y-m-d H:i:s')  && isset($item ->date_start) && $item ->date_start !='' && $item ->date_start <  date('Y-m-d H:i:s') ){
				                           			$html[$key] .= '<span>'.format_money($item -> price,'đ').'</span>';
				                            	}else{
				                           			$html[$key] .= '<span>'.($item -> price_old)?format_money($item -> price_old,'đ'):''.'</span>';
				                           		}
				                           $html[$key] .= ' </div>';
				                           $html[$key] .= '<div class="old_price  pull-right">'; 
				                          	 	if(isset($item ->date_end) && $item ->date_end !='' && $item->date_end >  date('Y-m-d H:i:s')  && isset($item ->date_start) && $item ->date_start !='' && $item ->date_start <  date('Y-m-d H:i:s') ){
				                            		$html[$key] .= '<span>';
				                            		$html[$key] .=($item -> price_old)?format_money($item -> price_old,'đ'):'';
				                            		$html[$key] .='</span>';
				                          	 	}
				                            $html[$key] .= '</div>';
				                            $html[$key] .= '<div class="clearfix"></div> ';
			                       		$html[$key] .= '</div>';		
									$html[$key] .= '</div>';
									//end nội dung  sản phẩm
								$html[$key] .= '</div>';
							}	
						$i++;
						}
					}
					$html[$key] .= '</div>';
					//	 Kết thúc cột 2 bên trong có 3 cột nhỏ
				}
			}else{
				$list = $model -> get_list($ordering,$limit,$type);
			}
		
			// call views
			include 'blocks/products_list/views/products_list/'.$style.'.php';
		}
	}
	
?>