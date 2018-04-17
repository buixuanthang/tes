<?php 
$link_buy = FSRoute::_("index.php?module=products&view=cart&task=buy&id=".$item->id."&Itemid=94");
$Itemid = 35;
$link = FSRoute::_('index.php?module=products&view=product&code='.$item -> alias.'&ccode='.$item->category_alias.'&id='.$item->id.'&cid='.$item->category_id.'&Itemid='.$Itemid);
?>

<div class="product-inner">
	<div class="title">
		<p><span><i class="fa fa-cog icon"></i></span>Dịch vụ nổi bật</p>	
	</div>
	<div class="list-product">
		<div class="product">
			<div class="image"><img itemprop="image" alt="<?php echo htmlspecialchars($item->name);?>" data-src="<?php echo URL_ROOT.$image_small;?>"  class="lazy"/></div>
			<div class="name"><a href="">Spham</a></div>
			<div class="price">13456700000</div>
			<div class="category">rgergsg</div>
		</div>
	</div>


</div>
