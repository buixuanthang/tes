<?php
global $tmpl; 
$tmpl -> addStylesheet('owl.carousel','libraries/jquery/owl.carousel.2/assets');
$tmpl -> addStylesheet('owl','blocks/slideshow/assets/css');
$tmpl -> addScript('owl.carousel.min','libraries/jquery/owl.carousel.2');
$tmpl -> addScript('products_tabs','blocks/products_tabs/assets/js');
$tmpl -> addStylesheet('products_tabs','blocks/products_tabs/assets/css');
FSFactory::include_class('fsstring');
?>
	<div class="products_tabs products_tabs_blocks_wrapper  block">
		<ul class='tab_title' >
		<?php $i = 0;?>
		<?php	foreach($arr_type as $type => $name){ ?>
			<li class='<?php echo $i ? '':'activated first-item'; ?> ' id='tab_<?php echo $type; ?>'><span><?php echo $name; ?></span></li>
			<?php $i ++; ?>		
		<?php } ?>
			
		</ul>
		<div class="clear"></div>
		<div class='tab_content'>
		<?php $i = 0;?>
		<?php	foreach($arr_type as $type => $name){ ?>
			<?php $rs = $list[$type];?>
			<?php include 'default_items.php'; ?>
			<?php $i ++; ?>		
		<?php } ?>
		</div>
		
	</div>		
