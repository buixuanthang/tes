<?php if(isset($data) && !empty($data)){?>
<?php

global $tmpl; 

$tmpl -> addStylesheet('owl.carousel','libraries/jquery/owl.carousel.2/assets');
$tmpl -> addScript('owl.carousel.min','libraries/jquery/owl.carousel.2');
$tmpl -> addScript('owl_carousel','blocks/slideshow/assets/js');
$tmpl -> addStylesheet('owl_carousel','blocks/slideshow/assets/css');
	
//$tmpl -> addStylesheet('slideshow','blocks/slideshow/assets/css');
//$tmpl -> addStylesheet('owl.carousel','libraries/jquery/owl.carousel');
//$tmpl -> addStylesheet('owl.theme','libraries/jquery/owl.carousel');
//$tmpl -> addScript('owl.carousel','libraries/jquery/owl.carousel');
//$tmpl -> addScript('progress_bar','libraries/jquery/owl.carousel');
//$tmpl -> addScript('slideshow','blocks/slideshow/assets/js');
?>	

			<div id="pav-slideShow">
				<div id="fs-slider" class="owl-carousel">
					<?php foreach($data as $item){?>	
						<div class="item">	
	            			<a href="<?php echo $item->url; ?>" title="<?php echo htmlspecialchars($item->name); ?>">	
								<img class="owl-lazy"  data-src="<?php echo URL_ROOT.str_replace('/original/', '/original/', $item -> image); ?>" alt="<?php echo htmlspecialchars($item->name); ?>"  />
							</a>
							<h3><?php echo $item -> name; ?></h3>
						</div>
					<?php }?>
				</div>
			</div>

<?php }?>
