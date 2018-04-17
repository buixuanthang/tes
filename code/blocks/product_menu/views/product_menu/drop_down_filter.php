<!--
ÁP dụng cho vidic.com.vn
Có danh mục con + Filter
-->
<?php global $tmpl;
	$tmpl -> addStylesheet('drop_down','blocks/product_menu/assets/css');
	$tmpl -> addScript('drop_down','blocks/product_menu/assets/js');
?>
<?php
global $tmpl; 
$Itemid = FSInput::get('Itemid');
$max_filter_in_column = 7;
$total =count($level_0);
?>
	<div class='menu_label <?php echo ($Itemid=='1')?'product_menu_home active':'';?>' data-id="product_menu_ul">Danh mục sản phẩm</div>
	<ul id = 'product_menu_ul' class="menu <?php echo ($Itemid=='1')?'':'hiden';?>" >
		<?php $t = 0;?>
		<?php foreach($level_0 as $item){?>
			<?php
				if($total > 15)
					if($t >= 14)
					break;
			?>
			<?php $link = FSRoute::_('index.php?module=products&view=cat&cid='.$item->id.'&ccode='.$item->alias.'&Itemid='.$Itemid); ?>
			<?php $class = $item-> level ?'level_0 level_1_same_0' :'level_0';?>
			<!--	LEVEL 0			-->
			<li class="<?php echo $class; ?>">
				<a href="<?php echo $link; ?>" id="menu_item_<?php echo $item->id;?>" class="menu_item_a" title="<?php echo htmlspecialchars($item -> name);?>">
					<?php if($item -> image){?>
					<span class="img-menu"><img class="grayscale" src="<?php echo URL_ROOT.$item->image;?>" alt="<?php echo htmlspecialchars($item -> name);?>" /></span>
					<?php }?>
					<span class="text-menu"><?php echo $item -> name;?></span>
				</a>
				<!--	LEVEL 1			-->
				<?php // if(isset($children[$item -> id]) && count($children[$item -> id])  ){?>
					<div class='highlight layer_menu_<?php echo ceil(($t+1)/3); ?>' id='childs_of_<?php echo $item -> id; ?>'>
				<?php // }?>
				<?php if(isset($children[$item -> id]) && count($children[$item -> id])  ){?>
					<ul class='highlight1 '>
						<?php $j = 0;?>
						<li class="sub-menu sub-menu-level0 "><div class=""><a href="<?php echo $link; ?>" title="<?php echo htmlspecialchars($item -> name);?>"><?php echo $item -> name;?></a></div></li>
						<?php foreach($children[$item -> id] as $key=>$child){?>
							<?php $link = FSRoute::_('index.php?module=products&view=cat&cid='.$child->id.'&ccode='.$child->alias.'&Itemid='.$Itemid); ?>
							
							<li class='sub-menu sub-menu-level1 <?php if($arr_activated[$child->id]) $class .= ' activated ';?> '>
								<div class="images-sub-menu1">
									<a href="<?php echo $link; ?>" id="menu_item_<?php echo $child->id;?>" title="<?php echo htmlspecialchars($child -> name);?>">
										<?php echo $child -> name;?>
									</a>									
								</div>
							</li>
							<?php $j++;?>
					<?php }?>
					</ul><!--  end <ul class='highlight1'> -->
				<?php }?>
				
				<!--	end LEVEL 1			-->
				<!--	FILTER			-->
				<?php 
				$filter_in_table_name = isset($arr_filter_by_field[$item -> tablename])?$arr_filter_by_field[$item -> tablename]:array();
				if(count($filter_in_table_name)){
					$j = 0;
					$full_col = 1;// nếu full_col == 1: cột đã đầy
					foreach($filter_in_table_name as $field_name => $filters_in_field){
						$i = 0;
						if(count($filters_in_field) > $max_filter_in_column ){
							if($j && !$full_col)
								echo "</div> "; // end .menu_col
							$class = 'first_field';
							echo '<div class="menu_col" id="menu_col_'.$j.'">';
							$full_col = 1;
							$j ++;
						}else{
							$class = $full_col?'first_field':'second_field';
							if(!$j || $full_col){
								echo '<div class="menu_col" id="menu_col_'.$j.'">';
								$full_col = 0;
								$j ++;
							}else{
								$full_col = 1;
							}
						}
						echo '<div class="field_name normal '.$class.'" data-id="id_field_'.$field_name.'">';
						foreach($filters_in_field as $filter){
							if(!$i){
								echo '<div class="field_label" id="mn_id_field_'.$filter -> id.'">'.$filter-> field_show.'</div>';
							}
							$str_filter_id = isset($filter_request)?$filter_request.",".$filter -> alias:$filter -> alias;
							$link = FSRoute::_('index.php?module=products&view=cat&cid='.$item->id.'&ccode='.$item->alias.'&filter='.$str_filter_id.'&Itemid='.$Itemid);
							$link_cat = FSRoute::_('index.php?module=products&view=cat&cid='.$item->id.'&ccode='.$item->alias.'&Itemid='.$Itemid);
							if($i <10 )
								echo '<h3><a href="'.$link.'" title="'.$filter ->filter_show.'" >'.$filter ->filter_show.'</a></h3>';
							else
							{
								echo '<div class="read_more"><a  href="'.$link_cat.'">Xem đầy đủ</a></div>';
								break;
							}
							$i++;
						}
						echo '</div>';// .field_name normal
						if($full_col)
							echo '</div>';// .menu_col
						if($j > 3)
							break;
					}
				?>
					<?php 	
				}
				?>
				<!--	FILTER			-->
				</div> <!--  end .highlight -->
			</li>	
			<?php $t ++; ?>	
		<?php }//.foreach($level_0 as $item)?>
		<?php if($total > 15){?>
			<li class="level_0">
				<a href="" iclass="menu_item_a" >
							<span class="img-menu"><img class="grayscale" src="http://vidic.vn/images/products/cat/original/dieu-hoa_1397587298.png"></span>
							<span class="text-menu">Sản phẩm khác</span>
				</a>
				<div class="highlight layer_menu_5">
					<ul class="highlight1 ">
							<?php $k=0;?>										
							<?php foreach($level_0 as $item){?>
								<?php $k++;?>	
								<?php if($k < 15) continue;?>
								<?php $link_2 = FSRoute::_('index.php?module=products&view=cat&cid='.$item->id.'&ccode='.$item->alias.'&Itemid='.$Itemid); ?>
								<li class="sub-menu sub-menu-level1">
									<div class="images-sub-menu1">
										<a href="<?php echo $link_2; ?>" id="menu_item_<?php echo $item->id;?>" title="<?php echo htmlspecialchars($item -> name);?>">
											<?php echo $item -> name;?>
										</a>
									</div>
								</li>	
							
							<?php } ?>																	
						</ul><!--  end <ul class='highlight1'> -->
								
				<!--	end LEVEL 1			-->
				<!--	FILTER			-->
								<!--	FILTER			-->
				</div>
			</li>
		<?php }?>
		<!--	CHILDREN				-->
	</ul>
