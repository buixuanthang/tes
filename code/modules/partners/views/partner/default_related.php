<!--	RELATE CONTENT		-->
<?php
	
		if($relates){
		?>
		<div class="related cf">
			<div class="relate_title"><span><?php echo FSText::_('Đối tác khác'); ?></span></div>
			<div class="related_content cls">
				<?php
				$i = 0;
				foreach($relates as $item){
					$i ++;
					if($i>=5){
						break;
					}
					
					$link = FSRoute::_("index.php?module=partners&view=partner&code=".$item->alias."&id=".$item->id);
	        	?>                    
                            <div class="item-related">
                                <a class="img_a" href="<?php echo $link; ?>" title="<?php echo htmlspecialchars($item -> name); ?>">
                                	<img class="lazy" data-src="<?php echo URL_ROOT.str_replace('/original/','/resized/',$item -> image); ?>" alt="<?php echo htmlspecialchars($item -> name); ?>" />
                                </a>
                                <h2 class="title-item-related"><a href="<?php echo $link; ?>" title="<?php echo htmlspecialchars($item -> name); ?>"><?php echo $item -> name; ?></a></h2>
                            </div>
	          	<?php } ?> 
			</div>
		</div>	
		<?php 			
		}
	
?>
<!--	end RELATE CONTENT		-->
