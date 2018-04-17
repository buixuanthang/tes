<?php 	global $config,$tmpl;?>
<div class="detailInfo">
	<h1><span><?php echo $data->name;?></span></h1>
	<div class="mt20">
			<?php include 'default_base_rating.php';	 ?>	
	</div>

	
	<div class="quantity pull-left">
	   	<?php if($data->quantity == 0){?>
   			<span class="sold_out">Hết hàng</span>
   		<?php }else {?>
   			<span class="in_stock">Còn hàng</span>	
   		<?php } ?>
   		<a href="javascript: favourite(<?php echo $data->id;?>)" class="btn-favourites">&nbsp;</a>
   	</div>
   	<div class="clearfix"></div>
   	<span class='price mt10 basic_price'>
	   		<?php echo format_money($price,'đ'); ?>
   	</span>
   	<input type="hidden" id="basic_price" value="<?php echo $price; ?>" >
   	<span class="price_old">
   	<?php if($data-> discount ){?>
    	<?php echo ($price_old)?format_money($price_old,'đ'):''; ?>
    <?php }?>	
    </span>

   	<table cellpadding="6" style="margin: 0 -6px 10px; 1">
		<?php if($data->manufactory_name){?>
	   		<tr>
	   			<td><b>Hãng sản xuất</b></td>
		   		<td>&nbsp;:&nbsp;</td>
		   		<td><?php echo $data->manufactory_name?></td>
	   		</tr>
   		<?php } ?>
   		
	   		<!-- <tr>
				<td><b>Giá bán tại</b></td>
				<td>&nbsp;:&nbsp;</td>
				<td>			   							   			
			   		<select onchange="load_quick(this.value,'status')" >
						<option value="">Chọn khu vực</option>
				   		<option value="sl_hn">Hà Nội</option>
				   		<option value="sl_hcm">Tp.Hồ Chí Minh</option>
				   		<option value="sl_dn">Đà Nẵng</option>
				   	</select>	   									   					
				</td>
			</tr> -->
		
		<?php if(count($price_by_memory)){?>
	   		<tr>
				<td><b>Bộ nhớ</b></td>
				<td>&nbsp;:&nbsp;</td>
				<td>			   							   			
			   		<select id='memory' name="memory"  onchange="load_quick(this.value,'memory')">
						<option value="0" >Chọn bộ nhớ</option>
							<?php 	foreach ($price_by_memory as $item){	?>
								<option value="<?php echo ($item->price)?$item->price:0; ?>_<?php echo $item->id ?>_<?php echo $item->memory_id ?>"><?php echo $item->memory_name?></option>
							<?php 	 }	?>
					</select>				   									   					
				</td>
			</tr>
			
		<?php } ?>
		<input type="hidden" id="memory_curent" value="0" >
		<?php if(count($price_by_color)){?>
	   		<tr>
	   			<td><b>Màu sắc</b></td>
		   		<td>&nbsp;:&nbsp;</td>
		   		<td>
		   			<?php 	foreach ($price_by_color as $item){	?>
		   			<?php 
					 $price_f = substr($item->price,0,1);    // returns "f"
					 $price_l =substr($item->price,1)+ $price['price'] ;
					 if(substr($item->price,1) == 0 ){
					 	$price_color = '' ;
					 }else{
					 	 $price_color= ': '.$price_f.format_money($item->price,'vnđ');
					 }
						?>
							<span onclick="load_quick('<?php echo ($item->price)?$item->price:0;?>_<?php echo $item->id ?>_<?php echo $item->color_id ?>','color')" class="color_item" style="background-color: <?php  echo '#'.$item->color_code?>;"  data-toggle="tooltip" data-original-title="<?php echo 'Màu '.$item->color_name.$price_color?>" ></span>
					<?php 	 }	?>
		   		</td>
	   		</tr>
		<?php }?>
		<input type="hidden" id="color_curent" value="0" >
		<input type="hidden" id="color_id" value="0" >
		<tr>
			<td  colspan="3">
				<?php echo $config['warranty_title']?>
			</td>
		</tr>
   		<tr>
   			<td><b>Bảo hành</b></td>
	   		<td colspan="2">
	   			<?php $price_warranty = $config['price_warranty'];?>
	   			<select id='warranty' name="warranty"  onchange="load_quick(this.value,'warranty')">
					<option value="0_0">Bảo hành mặc định</option>
					<?php if($price  < $price_warranty ){?>
						<option value="200000_3" >Bảo hành vàng</option>
					<?php }else{?>
						<option value="300000_3" >Bảo hành vàng</option>
					<?php }?>
				</select>
	   		</td>
   		</tr>
   		<input type="hidden" id="warranty_curent" value="0" >
   		<tr>
			<td  colspan="3">
				<a class="warranty_description" data-toggle="modal" href="#warranty_description">(Xem chi tiết bảo hành)</a>
				<div id="warranty_description" class="modal fade" style="display: none;" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button class="close" aria-hidden="true" data-dismiss="modal" type="button">×</button>
								<h4 class="modal-title"><span>Xem chi tiết chế độ bảo hành</span></h4>
							</div>
							<div class="modal-body">
								<?php echo $config['warranty_description']?>
							</div>
						</div>
					</div>
				</div>
			</td>
		</tr>
   	</table>	
    <?php if( $data->accessories){?>
		<div class="accessories mt20">
			<label><?php echo  FSText::_('Quà khuyến mãi')?>:</label><br />
			<?php echo $data->accessories;?>
		</div>
	<?php }?>
 

	<?php  if($data -> is_hotdeal && $data -> date_end >  date('Y-m-d H:i:s') && $data->date_start <  date('Y-m-d H:i:s')){?>
		<div class="promotion_frame">
	  		<div class="promotion_time"><span>Khuyến mại</span> (Từ <b><i><?php echo date('d/m/Y',strtotime($data -> date_start));?></i></b> Đến <b><i><?php echo date('d/m/Y',strtotime($data -> date_end));?>)</i></b></div>
	  		<div class="promotion_info"><?php echo  nl2br($data->promotion_info)?></div>
  		</div>
	<?php }?>
  	<?php
  	$warranty ='';
  	if(isset($_SESSION['cart'])) {
  	 $product_list = $_SESSION['cart'];
  	 	for ($j = 0; $j < count($product_list); $j ++) {
					$prd = $product_list[$j];
					if($prd[0] == $data->id) {
						$warranty = $product_list[$j][4] ;
					} 
				}
  	}
  	?>
	<?php include_once 'default_buy.php'; ?>
	<?php echo $config['thoi_gian_lam_viec']?>
	<div class="onlinesupport mt20">
		<?php echo $tmpl -> load_direct_blocks('onlinesupport',array('style'=>'default')); ?>
	</div>
	<?php echo $config['advice_description']?>
</div>
<div class="relate_news hidden-xs">
	<?php 	include 'default_news_related.php'; ?>
</div>
 <div id="pav-banner" class="hidden-md hidden-sm hidden-xs">
	<?php echo $tmpl -> load_direct_blocks('banners',array('style'=>'default','category_id'=>36)); ?>
</div>  
<div class="relate_products hidden-xs" id="sticker">
	<?php 
	$arr_relate =  array();
	if(count($relate_products_list)){
		$list_related = $relate_products_list;
		include 'related/default_related.php';	
	}
	?>
</div>