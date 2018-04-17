<span class='rate' itemprop="aggregateRating"   itemscope itemtype="http://schema.org/AggregateRating" >
	<?php $point = ($data -> id % 5) ; ?>
	<?php $point < 2 ? 3: $point; ?>
	<?php $ratingCount = round(($data -> id)/5) ; ?>
	<?php $reviewCount = $data -> id ; ?>
	<meta name="ratingValue"  itemprop="ratingValue" content="<?php echo $point; ?>" />
	<meta name="bestRating"  itemprop="bestRating"  content="5" />
	<meta name="ratingCount"  itemprop="ratingCount"  content="<?php echo $ratingCount; ?>" />
	<meta name="reviewCount"  itemprop="reviewCount"  content="<?php echo $reviewCount; ?>" />
	<?php for($i = 0; $i < 5;$i ++){?>
		<?php if($point > $i){?>
			<i class="fa fa-star"></i>
		<?php }else{?>
			<i class="fa fa-star-o"></i>
		<?php }?>
	<?php }?>
</span>
