<?php
global $tmpl; 
$tmpl -> addStylesheet('owl.carousel','libraries/jquery/owl.carousel.2/assets');
//$tmpl -> addStylesheet('owl.theme','libraries/jquery/owl.carousel');

$tmpl -> addScript('owl.carousel.min','libraries/jquery/owl.carousel.2');
//$tmpl -> addScript('progress_bar','libraries/jquery/owl.carousel');
//$tmpl -> addScript('progress_bar','libraries/jquery/owl.carousel');
//$tmpl -> addScript('slideshow','blocks/slideshow/assets/js');
	$tmpl -> addScript('slideshow','blocks/products/assets/js');
	$tmpl -> addStylesheet('slideshow','blocks/products/assets/css');
	FSFactory::include_class('fsstring');
?>
<?php if(isset($list) && !empty($list)){?>
	<div class="products_blocks_wrapper hide1 block slideshow-home">
		<h3 class="slideshow-home-title"><span><?php echo $title; ?></span></h3>
		<div class="product_star">
			<span class="line-thought"></span>
			<span class="star_small"><i class="fa fa-star"></i></span>
			<span class="star_large"><i class="fa fa-star"></i></span>
			<span class="star_small"><i class="fa fa-star"></i></span>
			<span class="line-thought"></span>
		</div>
		<div class="slideshow-home-list products_blocks_slideshow"  id="<?php echo "products_blocks_slideshow_".$identity; ?>">
					<?php foreach($list as $item){?>
							<?php $link = FSRoute::_("index.php?module=products&view=product&id=".$item->id."&code=".$item->alias."&ccode=".$item-> category_alias.'&cid='.$item -> category_id); ?>
			        		<div class="slideshow-home-item item" >
								<div class="product_image">
									<a href="<?php  echo $link;?>" title="<?php echo $item -> name; ?>"  rel="nofollow" >
						            	<img src="<?php echo URL_ROOT.str_replace('/original/','/resized/',$item->image);?>"  alt="<?php $item->name;?> " />
						            </a>	
								</div>
								<div class="frame_title">
									<h2>	<a href="<?php  echo $link;?>" title="<?php echo $item -> name; ?>"  ><span><?php echo get_word_by_length( 50,$item -> name,'...');?></span></a></h2>
								</div>
								
							</div>
								
					<?php }?>
					
			</div>
	</div>		
 <?php }?>
