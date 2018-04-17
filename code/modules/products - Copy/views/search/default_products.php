	<?php 
	global $tmpl; 
	$tmpl -> addStylesheet('products');
//	$tmpl -> addStylesheet('cat','modules/'.$this -> module.'/assets/css');
//	$tmpl -> addScript('cat','modules/'.$this -> module.'/assets/js');
//	$tmpl -> addScript('shopcart','modules/products/assets/js');
//	$tmpl -> addScript('follow');

	?>
<div class="products-cat">
	<div class="field_title">
		<div  class="title-name">
			<div class="cat-title">
				<div class="cat-title-main" >
					<div class="title_icon">
						<i class="icon_v1"></i>
						<h1><span>Có <strong ><?php echo $total?></strong> sản phẩm với từ khóa: <strong ><?php echo $keyword;?></strong></span></h1>	
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

