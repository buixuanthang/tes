

<div class="item-pro-limit stt-<?php echo $j;?>">
	<div class="img">
		<?php $image_small = str_replace('/original/', '/resized/', $item->image); ?>
		<a href="<?php echo $link;?>" title='<?php echo htmlspecialchars($item->name);?>'  >
			<img itemprop="image" alt="<?php echo htmlspecialchars($item->name);?>" data-src="<?php echo URL_ROOT.$image_small;?>"  class="lazy"/>
		</a>
	</div>

	<div class="text">
		<h2><a href="<?php echo $link; ?>" title = "<?php echo htmlspecialchars($item -> name) ; ?>" class="name" >
			<?php echo FSString::getWord(15,$item -> name); ?>
		</a> 
		</h2>

		<div class="des"><?php echo strip_tags(get_word_by_length(150,$item -> description) ) ?></div>
	
		<div class='price_arae'>
			<span>Giá chỉ từ</span><br>
			<div class='price_current'><?php echo format_money($item -> price).''?></div>
		</div>

		<div class="cate">
			<a href="<?php echo $link_cat; ?>" title="<?php echo $catLimit->name;?>" class="_text_2">
				Xem tất cả <span><i class="fa fa-angle-right"></i></span>
			</a>	
		</div>
	</div>
</div>