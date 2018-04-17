<?php 
$html ='';
	foreach($list as $item){
		$price = calculator_price($item->price,$item->price_old,$item->is_hotdeal,$item->date_start,$item->date_end);
		$link = FSRoute::_('index.php?module=products&view=product&code='.$item->alias.'&id='.$item -> id.'&cid='.$item->category_id.'&ccode='.$item->category_alias.'&Itemid=5');
		$iconhotdeal =  URL_ROOT.'images/iconhotdeal.png';
		
			$html .='<a class="proditem" href="'.$link.'" title = "'.$item -> name .'" >';
				$html .='<figure>';	
					$html .='<div class="frame_inner">';
							if(count($types)){
								foreach($types as $type){
									if(strpos($item -> types,','.$type->id.',') !== false || $item -> types == $type->id){
											$html .='<img  class="product_type" src="'.URL_ROOT.str_replace('/original/', '/original/', $type->image).'" alt="'.$type -> name.'" />';
									break;	
									}
								}
							}
							if(@$price['percent']){	
								$html .='<span class="percent">'.'-'.$price['percent'].'%'.'</span>';
							}
							if(@$price['is_deal']){	
								$html .='<img  class="product_hotdeal" src="'.$iconhotdeal.'" />';
							 } 
					       	$html .='<img class="img-responsive" src="'.URL_ROOT.str_replace('/original/', '/resized/', $item->image).'" alt="'.htmlspecialchars ($item -> name).'"  />';
							if(!$item->quantity){
				  				$html .='<span class="sold-out"></span>';
				  			} 
					       	$html .='<h3 >'.$item -> name.'</h3>';	
					       	$html .='<div class="clearfix">';
								$html .='<h4>'.format_money($price['price']).'</h4>';	
								if(@$price['percent']){
									$html .='<h5>'.format_money($price['price_old']).'</h5>';
								} 
							$html .='</div>';
			       			$html .='<p>';
								$html .='<span class="button-cart">Giỏ hàng</span><font>|</font><span class="button-detail">Chi tiết</span>';
							$html .='</p>';
				    $html .='</div>';    
				$html .='</figure>';        
			$html .='</a>';
	}
?>