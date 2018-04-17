	<?php 
	global $tmpl; 
	$tmpl -> addStylesheet('products');
	$tmpl -> addStylesheet('cat','modules/'.$this -> module.'/assets/css');
	$tmpl -> addScript('cat','modules/'.$this -> module.'/assets/js');
	?>
<div class="products-cat">
	<div class="field_title">
		<div  class="title-name">
			<div class="cat-title">
				<div class="cat-title-main">
					<div class="title_icon">
						
						<h1><?php echo $title; ?></h1>	
					</div>
				</div>
                <div class="clear"></div>
			</div>
			
			
		</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	
	<section class='products-cat-frame'> 
		<div class='products-cat-frame-inner'>
		<?php include_once 'default_grid.php';?>
		</div>
	</section>
	
	<?php if($pagination) echo $pagination->showPagination(3); ?>
</div>
