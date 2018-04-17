<?php
$link = FSRoute::_('index.php?module=products&view=product&code='.$item -> alias.'&id='.$item -> id.'&ccode='.$item->category_alias);
$link_buy = FSRoute::_("index.php?module=products&view=cart&task=buy&id=".$item->id."&Itemid=94");
				
			  		?>
<div  class="item" itemscope itemtype="http://schema.org/Product">					
		<div class="frame_inner">
			<link itemprop="url" href="<?php echo $link; ?>" />
			<figure class="product_image "  >
				<?php $image_small = str_replace('/original/', '/large/', $item->image); ?>
				<a href="<?php echo $link;?>" title='<?php echo $item->name;?>'  itemprop="url">
					<img itemprop="image" alt="<?php echo $item->name;?>" src="<?php echo URL_ROOT.$image_small;?>"  onerror="javascript:this.src='<?php echo URL_ROOT.'images/NA240x240.png';?>'"/>
				</a>
				<figcaption itemprop="name">
					<a href="<?php echo $link; ?>" title = "<?php echo $item -> name ; ?>" class="name" >
						<?php echo FSString::getWord(15,$item -> name); ?><?php echo $item -> code?'. MS: '.$item -> code:''; ?>
					</a> 
				</figcaption>	
			</figure>
			<div class="inner_hover">
				<div class="summary">
				
					<div class="summary_inner"  itemprop="description">
						<label>Ưu điểm</label>
						<?php $summary = trim($item->strength);?>
						<?php $summary = str_replace(array("<br>","<br/>","<br />"),'</p><p>', $summary); ?>
						<?php $summary = str_replace(array("<p>&nbsp;</p>\n","<p></p>","<p>&nbsp;</p>", "&nbsp;<br />\n"), array('', ''), $summary); ?>
						<?php echo $summary; ?>
					</div>
				</div>
				<div class="button_area">
					<a href="<?php echo $item -> link_demo; ?>" title="Demo" target="_blank" class="link_demo">
						Demo
					</a>
					<a href="<?php echo $link; ?>"  class="detail_button" title="Chi tiết <?php echo $item -> name; ?>">
						Chi tiết
					</a>
				</div>
			</div>
			        	<div class='price_arae' itemscope itemtype="http://schema.org/Offer">
					  		<div class='price_current' itemprop="price"><?php echo format_money($item -> price).''?></div>
				        
			            	<?php if( $item -> price_old && $item -> price_old > $item -> price){?>
			            		<div class='price_old'><span><?php echo format_money($item -> price_old).''?></span></div>
			            	<?php }?>
			            </div>
	</div> 
</div>	 