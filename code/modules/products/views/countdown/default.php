	<?php 
	global $tmpl; 
//	$tmpl -> addScript('jquery.plugin','libraries/jquery/jquery.countdown.package-2.0.2/');
//	$tmpl -> addScript('jquery.countdown','libraries/jquery/jquery.countdown.package-2.0.2/');
	$tmpl -> addScript('jquery.countdown','libraries/jquery/jquery.countdown/');
	
	$tmpl -> addScript('form');
	$tmpl -> addScript('countdown_huy','modules/'.$this -> module.'/assets/js');
	$tmpl -> addStylesheet('countdown_huy','modules/'.$this -> module.'/assets/css');
	$tmpl -> addStylesheet('quick_order','modules/'.$this -> module.'/assets/css');
	?>
<!-- BREADCRUMBS-->
<div class='countdown'>
	<?php if(!$data){?>
		<h1 class='page_title'><span>Đấu giá ngược</span></h1>
		<br/>
		<br/>
		<div>Không có sản phẩm nào</div>
	<?php }else{?>
		<?php if($data -> quantity == 1){?>
		<h1 class='page_title'><span>Đấu giá ngược - chỉ còn duy nhất 1 sản phẩm</span></h1>
		<?php }else{?>
		<h1 class='page_title'><span>Đấu giá ngược - số lượng có hạn</span></h1>
		<?php }?>
	
	<div class='countdown_content'>
		<div class='countdown_content_l'>
			<img src="<?php echo URL_ROOT.str_replace('/original/', '/large/', $product->image); ?>" title="<?php echo $product->name; ?>" />
			<?php 
				if(!$data->quantity){ ?>
	  				<span class="sold-out"></span>
	  		<?php	} 
			 ?>
			 <div class='info'>
				<table width="100%" border="0" cellpadding="5px">
					<tr>
						<td width="30%">Hãng sản xuất:</td>
						<td><span ><?php echo $product -> manufactory_name;  ?></span></td>
					</tr>
					<tr>
						<td>Tình trạng:</td>
						<td><?php echo $data -> status;  ?></span></td>
					</tr>
					<tr>
						<td>Màu sắc:</td>
						<td><?php echo $color -> name;  ?></td>
					</tr>
					<?php if($product->accessory){?>
					<tr>
						<td>Phụ kiện:</td>
						<td><?php echo $product->accessory?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><?php $link = FSRoute::_('index.php?module=products&view=product&id='.$product -> id.'&code='.$product -> alias.'&ccode='.$product -> category_alias); ?>
							<a class="readmore" href="<?php echo $link; ?>" title="Chi tiết" target="_blank">Xem sản phẩm &raquo;</a>

						</td>
					</tr>
					<?php }?>
				</table>
			</div>
			<div class='summary_label'>Mô tả về sản phẩm</div>
			<div class='summary_content'>
				<?php echo nl2br($data -> description); ?>
			</div>
		</div>
		<div class='countdown_content_r'>
			<h2 class="name">
				<?php $link = FSRoute::_('index.php?module=products&view=product&id='.$product -> id.'&code='.$product -> alias.'&ccode='.$product -> category_alias); ?>
				<a href="<?php echo $link; ?>" title="<?php echo $product -> name; ?>" target="_blank"><?php echo $product -> name; ?></a>
			</h2>
				
				<?php if($tense == -1){	?>
				<div class='countdown_area'>
					<div class='price_current_area'>Phiên rớt giá đã kết thúc</div>
				</div>
				<?php }else{ ?>
					<?php 
					
					$price = $data -> price;
					$price_min = $data -> price_min;
					$step_price = $data -> step_price;
//					$started_time = $data -> started_time;
//					$finished_time = $data -> finished_time;
					$started_time_int = ($started_time);
					$finished_time_int = ($finished_time);
					if($tense == 1){ // tương lai
						$price_next = ($price - $step_price) > $price_min ? ($price - $step_price):$price_min;
						$price_current = $price;
						$expire_time = $started_time_int;
						$step = 0;
						$pos = 1;
						$now = time();
						$class = 'countdown_area_running2';
						if(($started_time_int - $now) > 86400){ // lớn hơn 1 ngày
							$class = 'countdown_area_future';
						}
					}elseif(!$tense){ // đang diễn ra
						$step = ceil(($price - $price_min) / $step_price );
						$interval = round(($finished_time_int - $started_time_int)/ $step);
						$now = time();
						$pos = ceil( ( $now - $started_time_int ) / $interval );
						
						$price_current = $price - ($pos * $step_price);
						$price_next = $price - ( ($pos + 1)* $step_price );
						$price_current = $price_current > $price_min ? $price_current:$price_min;
						$price_next = $price_current > $price_min ? $price_next:$price_min;
						
						$expire_time = $started_time_int + ($interval * $pos);
						
						
						$class =  $pos == $step? '':'countdown_area_running';
					}
//					$expire_time = $now + 7;
					?>
					
					<div class='countdown_area <?php echo $class; ?>' >
<!--					<div class='price_old_area'>Giá gốc: &nbsp;<span id='price_old'>&nbsp;<?php echo format_money($price,'đ','0');  ?></span></div>-->
					<div class='price_current_area'>Giá hiện tại: &nbsp;<span id='price_current'>&nbsp;<?php echo format_money($price_current,'đ','0');  ?></span></div>
					<div class='time_left'>Còn: <span  class="time-countdown" id="time-countdown"></span>
						<?php if($tense == 1){?>
							<strong>  sẽ bắt đầu phiên đấu giá</strong>
						<?php }?>
					</div>
					<input type="hidden" class='expire_time' id="expire_time" value="<?php echo date('m/d/Y H:i:s',$expire_time); ?>" >
					<input type="hidden" class='current_time' id="current_time" value="<?php echo date('m/d/Y H:i:s'); ?>" >
						<?php if($pos == $step){ ?>
							<div class='price_next_area'>Đây là mức giá cuối cùng</div>
						<?php }else{?>
							<div class='price_next_area'>Giá tiếp theo: <span  id='price_next'><?php echo format_money($price_next,'đ','0');  ?></span></div>
						<?php }?>
					</div>
				<?php } ?>

			<?php if(!$tense){	?>
				
				
					<?php include_once 'default_order.php'; ?>
				
			<?php }?>
			<!-- <div class='list_order'>
				<a  href="<?php echo FSRoute::_('index.php?module=products&view=bought'); ?>" title="Danh sách các khách hàng đã mua sản phẩm" >Danh sách các khách hàng đã mua sản phẩm &raquo;</a>
			</div> -->
		</div>
		<div class="clear"></div>
	</div>
	<?php }?>
</div>
