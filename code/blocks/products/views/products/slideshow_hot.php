<?php
global $tmpl; 
$tmpl -> addStylesheet('owl.carousel','libraries/jquery/owl.carousel.2/assets');
$tmpl -> addScript('owl.carousel.min','libraries/jquery/owl.carousel.2');
$tmpl -> addScript('slideshow_hot','blocks/products/assets/js');
$tmpl -> addStylesheet('slideshow_hot','blocks/products/assets/css');
FSFactory::include_class('fsstring');
?>
<?php if(isset($list) && !empty($list)){?>
	<div class="products_blocks_wrapper  block slideshow-hot">
		<h3 class="slideshow-hot-title"><span><?php echo $title; ?></span></h3>
		<div class="slideshow-hot-list products_blocks_slideshow_hot"  id="<?php echo "products_blocks_slideshow_hot_".$identity; ?>">
					<?php foreach($list as $item){?>
							<?php $link = FSRoute::_("index.php?module=products&view=product&id=".$item->id."&code=".$item->alias."&ccode=".$item-> category_alias.'&cid='.$item -> category_id); ?>
			        		<div class="slideshow-hot-item item" >
								<div class="product_image">
									<a href="<?php  echo $link;?>" title="<?php echo $item -> name; ?>"  rel="nofollow" >
						            	<img src="<?php echo URL_ROOT.str_replace('/original/','/resized/',$item->image);?>"  alt="<?php $item->name;?> " />
						            </a>
						            <div class="frame_price">
										<span class="price"><?php echo  format_money($item -> price); ?></span>
										<?php if($item -> price_old && $item -> price_old > $item -> price){?>
											<span class="old_price "><?php echo  format_money($item -> price_old); ?></span>
										<?php }else{?>
											<span class="old_price "></span>
										<?php }?>
										<div class="clear"></div> 
									</div>
									<?php if($item -> price_old && $item -> price_old > $item -> price){?>
					            		<div class='discount'>
					            			<?php echo '-<span>'.round((($item -> price_old - $item -> price)/$item -> price_old)*100).'</span><font>%</font>'?>
					            		</div>
					            	<?php }?>	
								</div>
								<div class="frame_title">
									<h2>	<a href="<?php  echo $link;?>" title="<?php echo $item -> name; ?>"  ><span><?php echo get_word_by_length( 50,$item -> name,'...');?></span></a></h2>
								</div>
								
							</div>
								
					<?php }?>
					
			</div>
	</div>		
 <?php }?>
