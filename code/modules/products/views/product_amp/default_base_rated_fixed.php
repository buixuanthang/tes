<div class='rate' itemprop="aggregateRating"   itemscope itemtype="http://schema.org/AggregateRating" >
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
	<?php 
	$link_r = $_SERVER['REQUEST_URI'];
	$link_r = URL_ROOT.substr(str_replace('.amp','.html',$link_r),1).'#comment_add_form';
	?>
	<a href="<?php echo $link_r; ?>" title="Tổng người đánh giá" class='rate_count' >  (<span  itemprop="ratingCount"><?php echo $data -> rating_count?$data -> rating_count:1; ?></span> đánh giá)</a>
	
</div>
