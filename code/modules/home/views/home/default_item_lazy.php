<?php 
$link_buy = FSRoute::_("index.php?module=products&view=cart&task=buy&id=".$item->id."&Itemid=94");
$Itemid = 35;
$link = FSRoute::_('index.php?module=products&view=product&code='.$item -> alias.'&ccode='.$item->category_alias.'&id='.$item->id.'&cid='.$item->category_id.'&Itemid='.$Itemid);
?>





<div class="item-pro">
	<div class="top-pro">

		<?php $image_small = str_replace('/original/', '/resized/', $item->image); ?>
		<a href="<?php echo $link;?>" title='<?php echo htmlspecialchars($item->name);?>'  >
			<img itemprop="image" alt="<?php echo htmlspecialchars($item->name);?>" data-src="<?php echo URL_ROOT.$image_small;?>"  class="lazy"/>
		</a>


		<h2><a href="<?php echo $link; ?>" title = "<?php echo htmlspecialchars($item -> name) ; ?>" class="name" >
			<?php echo FSString::getWord(15,$item -> name); ?>
		</a> 
		</h2>

		<div class='price_arae'>
			<div class='price_current'><?php echo format_money($item -> price).''?></div>

			<?php if( $item -> price_old && $item -> price_old > $item -> price){?>
			<div class='price_old'><span><?php echo format_money($item -> price_old).''?></span></div>
			<?php }?>
		</div>

	</div>	
	<div class="poduct-cate">
		<a href="<?php echo $link_cat; ?>" title="<?php echo $cat->name;?>" class="_text_2"><?php echo $cat->name;?><span> <i class="fa fa-angle-right"></i></span>	
		</a>	
	</div>
	
</div>






