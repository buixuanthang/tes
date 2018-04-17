<div class="row product_grid_wrapper">
	<div class="row_inner product_grid"  id="box_product_<?php echo $cat->id ?>">
		<!--	EACH PRODUCT				-->
		<?php 
		$products = $array_products[$cat->id];
		for($j = 0 ; $j < count($products); $j ++)
		{
			if($j > 4)
				break;
			$item = $products[$j];
			$link_buy = FSRoute::_("index.php?module=products&view=cart&task=buy&id=".$item->id."&Itemid=94");
			$Itemid = 35;
  			$link = FSRoute::_('index.php?module=products&view=product&code='.$item -> alias.'&ccode='.$item->category_alias.'&id='.$item->id.'&cid='.$item->category_id.'&Itemid='.$Itemid);
  			// global $insights;
  			// if($insights)
				include 'default_item_lazy.php';
			// else              
			// 	include 'default_item.php';
		}
		?>		
		<!--	end EACH PRODUCT				-->
        <div class="clear"></div> 
	</div>
</div>