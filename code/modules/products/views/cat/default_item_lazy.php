<?php 
$link_buy = FSRoute::_("index.php?module=products&view=cart&task=buy&id=".$item->id."&Itemid=94");
$Itemid = 35;
$link = FSRoute::_('index.php?module=products&view=product&code='.$item -> alias.'&ccode='.$item->category_alias.'&id='.$item->id.'&cid='.$item->category_id.'&Itemid='.$Itemid);
?>
<div  class="item" >					
            <div class="frame_inner">
                            	
		        	<figure class="product_image "  >
		        		<?php $image_small = str_replace('/original/', '/resized/', $item->image); ?>
		  				<a href="<?php echo $link;?>" title='<?php echo htmlspecialchars($item->name);?>'  itemprop="url">
							<img itemprop="image" alt="<?php echo htmlspecialchars($item->name);?>" data-src="<?php echo URL_ROOT.$image_small;?>"  class="lazy"/>
						</a>
						<div class="button_area">
		            		<a href="<?php echo $link_buy; ?>"  class="add_cart">
		            			<i ></i>
		            		</a>
		            		<a href="<?php echo $link; ?>"  class="detail_button" title="Chi tiết sản phẩm">
		            			<i ></i>
		            		</a>
		            	</div>
					<div class="summary">
					
						<div class="summary_inner" >
							<a href="<?php echo $link; ?>"  class="detail_button" title="Chi tiết sản phẩm">
		            			<?php echo  $item -> accessories;?>
			            		</a>
			            		</div>
            			</div>
	        	</figure>
				<h2><a href="<?php echo $link; ?>" title = "<?php echo htmlspecialchars($item -> name) ; ?>" class="name" >
  				<?php echo FSString::getWord(15,$item -> name); ?>
        	</a> </h2>	
        	<div class='price_arae' >
		  		<div class='price_current'><?php echo format_money($item -> price).''?></div>
	        
            	<?php if( $item -> price_old && $item -> price_old > $item -> price){?>
            		<div class='price_old'><span><?php echo format_money($item -> price_old).''?></span></div>
            	<?php }?>
            	</div>
            	<?php if( $item -> price_old && $item -> price_old > $item -> price){?>
            		<div class='discount'><span><?php echo '-'.round((($item -> price_old - $item -> price) /$item -> price_old) * 100).'%'; ?></span></div>
            	<?php }?>
					<div class="buttons cls">
						<a class="button-detail" href="<?php echo $link;?>"><span ><?php echo FSText::_('Mua hàng'); ?></span></a>
						<?php  $link_compare = FSRoute::_('index.php?module=products&view=compare&ids='.$item -> id.'&codes='.$item -> alias); ?>
						<a class="compare_bt" href="<?php echo $link_compare; ?>" title="So sánh sản phẩm"><span ></span></a>
						<a class="favourite_bt" href="javascript:favourite(<?php echo $item -> id; ?>)"><span ></span></a>
						
					</div>
			<div class="clear"></div> 
			  <?php if(count($types)){?>
		<?php $k  = 0;?>
		<?php foreach($types as $type){?>
			<?php if(strpos($item -> types,','.$type->id.',') !== false || $item -> types == $type->id){?>
				<div class='product_type product_type_<?php echo $type -> alias; ?> product_type_order_<?php echo $k; ?>'><?php echo $type -> name; ?></div>
				<?php $k ++; ?>
			<?php }?>
			
		<?php }?>
	<?php }?>  									
</div>   <!-- end .frame_inner -->
	                            
                            			
<div class="clear"></div> 
</div> 	 
<div class="item_break"></div>
