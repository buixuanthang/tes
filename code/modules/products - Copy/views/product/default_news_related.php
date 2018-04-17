<div class="tab-title">
		
		<span><?php echo $title_relate;  ?></span>

</div>
<div class="default_news tab_content_right_bg">
	<div class="default_news_inner cls">
		<?php $i = 0; ?>
		<?php if($relate_news){ ?>
		 	<?php foreach ($relate_news as $item){?>
		 		<?php if($i > 4) break; ?>
			        	<?php $link = FSRoute::_("index.php?module=news&view=news&id=".$item->id."&code=".$item->alias."&ccode=".$item-> category_alias);?>
			            <?php $image = URL_ROOT.str_replace('/original/', '/resized/',$item -> image);?>
							  <div class="item-related">
	                                <a class="img_a" href="<?php echo $link; ?>" title="<?php echo $item -> title; ?>">
	                                	<img class="lazy" data-src="<?php echo URL_ROOT.str_replace('/original/','/resized/',$item -> image); ?>" alt="<?php echo $item -> title; ?>" />
	                                </a>
	                                <div class="title-item-related"><a href="<?php echo $link; ?>" title="<?php echo $item -> title; ?>"><?php echo $item -> title; ?></a></div>
	                            </div>
				        <?php $i++?>
					<?php } ?>
		<?php } ?>
		
	</div>
</div>