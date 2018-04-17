<div class="tab-title cls">
	<div class="cat-title-main" id="characteristic-label">
		
		<span>Tin tức liên quan</span>
	</div>
</div>
<div class="default_news">
	<div class="default_news_inner cls">
		<?php $i = 0; ?>
		<?php if($relate_news){ ?>
		 	<?php foreach ($relate_news as $item){?>
		 		<?php if($i > 4) break; ?>
			        	<?php $link = FSRoute::_("index.php?module=news&view=news&id=".$item->id."&code=".$item->alias."&ccode=".$item-> category_alias);?>
			            <?php $image = URL_ROOT.str_replace('/original/', '/resized/',$item -> image);?>
							  <div class="item-related">
	                                <a class="img_a" href="<?php echo $link; ?>" title="<?php echo $item -> title; ?>">
	                                	<amp-img   src="<?php echo URL_ROOT.str_replace('/original/','/resized/',$item -> image); ?>" alt="<?php echo $item -> title; ?>" width="270" height="180"  />
	                                </a>
	                                <div class="title-item-related"><a href="<?php echo $link; ?>" title="<?php echo $item -> title; ?>"><?php echo $item -> title; ?></a></div>
	                            </div>
				        <?php $i++?>
					<?php } ?>
		<?php } ?>
		
	</div>
</div>