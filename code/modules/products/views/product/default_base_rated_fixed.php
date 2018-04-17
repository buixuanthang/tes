<span class='rate_head' itemprop="aggregateRating"   itemscope itemtype="http://schema.org/AggregateRating" >
		<?php $point = $data -> rating_count ? round($data -> rating_sum /$data -> rating_count): 4 ; ?>
	<?php for($i = 0; $i < 5;$i ++){?>
		<?php if($point > $i){?>
			<i class="fa fa-star"></i>
		<?php }else{?>
			<i class="fa fa-star-o"></i>
		<?php }?>
	<?php }?>
	<span itemprop="ratingValue" class="hide"><?php echo $point; ?></span>
	<span itemprop="bestRating" class="hide">5</span>
	<a href="javascript:void(0)" title="<?php echo FSText::_('Đánh giá sản phẩm này'); ?>" class='rate_count' onclick="$('html, body').animate({ scrollTop: $('#prodetails_tab3').offset().top }, 500);">  (<span  itemprop="ratingCount"><?php echo $data -> rating_count?$data -> rating_count:1; ?></span> <?php echo FSText::_('đánh giá'); ?>)</a>
	
	
</span>
