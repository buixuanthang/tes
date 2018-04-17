<div class="_color">
					<?php if(count($price_by_color)){?>
			   			<label>Chọn màu: </label>
			   			<?php 	foreach ($price_by_color as $item){

		   				$price_color =0;
						if($item->price > 0){
							$price_color = '+'.format_money($item->price,'₫') ;
						}else if($item->price < 0){
							$price_color = format_money($item->price,'₫') ;
						}else{
							$price_color = '+0₫';
						}
						?>
			   			<a  href="javascript:void(0)" class="Selector"  onclick="load_quick(this);" data-price="<?php echo $item -> price;?>" data-type="color"  data-id="<?php echo $item -> id;?>"   data-color="<?php echo $item -> color_id;?>">
							<span  class="color_item icon_v1" data-toggle="tooltip" data-original-title="<?php echo $price_color ;?>"  style="background-color: <?php  echo '#'.$item->color_code?>;">
								<font><?php echo $price_color ;?></font>
							</span>
						</a>
						<?php 	 }	?>
					<?php }?>
				</div>
				
	 <div class="_attributes clearfix cls">
	    <?php if(count($price_by_memory)){?>
	   			<select  class="boxmemory" onchange="load_quick(this)">
	   				<option value="0" data-price="0" data-type="memory">Bộ nhớ sản phẩm</option>
					<?php 	foreach ($price_by_memory as $item){?>
						<option value="<?php echo $item->id ?>" data-price="<?php echo ($item -> price)?$item -> price:0;?>" data-type="memory"><?php echo $item -> memory_name;?></option>
					<?php }	?>
				</select>
		<?php }?>
			    <?php if(count($price_by_usage_states)){?>
	   			<select  class="boxusage_states" onchange="load_quick(this)">
	   				<option value="0" data-price="0" data-type="usage_states">Trạng thái</option>
					<?php 	foreach ($price_by_usage_states as $item){?>
						<option value="<?php echo $item->id ?>" data-price="<?php echo ($item -> price)?$item -> price:0;?>" data-type="usage_states"><?php echo $item -> usage_states_name;?></option>
					<?php }	?>
				</select>
		<?php }?>

		<?php if(count($price_by_warranty)){?>
	   			<select class="boxwarranty" onchange="load_quick(this);">
	   				<option value="0"  data-price="0" data-type="warranty">Chế độ bảo hành</option>
					<?php foreach ($price_by_warranty as $item){?>
						<option value="<?php echo $item->id ?>" data-price="<?php echo ($item -> price)?$item -> price:0;?>" data-type="warranty"  ><?php echo $item -> warranty_name?></option>
					<?php }	?>
				</select>
				<div class="warranty_aq">
					<?php global $config;?>
					<font><i class="icon_v1 "></i></font>
					<span class="warranty_popup"><?php echo $config['warranty_aq']; ?></span>
				</div>
		<?php }?>
		<?php if(count($price_by_origin)){?>
	   			<select class="boxorigin" onchange="load_quick(this);">
	   				<option value="0"  data-price="0" data-type="origin" >Nguốn gốc</option>
					<?php foreach ($price_by_origin as $item){?>
						<option value="<?php echo $item->id ?>" data-price="<?php echo ($item -> price)?$item -> price:0;?>" data-type="origin"  ><?php echo $item -> origin_name?></option>
					<?php }	?>
				</select>
		<?php }?>
		<?php if(count($price_by_species)){?>
	   			<select class="boxsspecies" onchange="load_quick(this);">
	   				<option value="0"  data-price="0" data-type="species" >Ram</option>
					<?php foreach ($price_by_species as $item){?>
						<option value="<?php echo $item->id ?>" data-price="<?php echo ($item -> price)?$item -> price:0;?>" data-type="species"  ><?php echo $item -> species_name?></option>
					<?php }	?>
				</select>
		<?php }?>
	</div>
	
	
	<div class='price' itemprop="offers" itemscope="" itemtype="https://schema.org/Offer">
	<link itemprop="availability" href="https://schema.org/InStock">
	<div class='price_current' id="price" itemprop="price" content="<?php echo $data -> price; ?>">
		<?php echo format_money($data -> price) ; ?>
	</div>
	<meta itemprop="priceCurrency" content="VND">
	<?php if($data -> discount && $data -> price_old){?>
        		<div class='price_old'><?php echo format_money($data -> price_old)?></div>
   	<?php }?>

</div>