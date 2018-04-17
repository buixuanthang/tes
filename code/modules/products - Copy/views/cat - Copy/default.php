	<?php 
	global $tmpl; 
	$tmpl -> addStylesheet('cat','modules/'.$this -> module.'/assets/css');
	$tmpl -> addScript('cat','modules/'.$this -> module.'/assets/js');
	?>
<!-- BREADCRUMBS-->
<div class='product_cat mt20'>
	<div class="row">
		 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			 <div class="block_products_filter  block">
				 <?php echo $tmpl -> load_direct_blocks('products_filter',array('style'=>'default')); ?>
			 </div>
		 </div>
	 </div>
	 <?php include_once 'default_vertical.php';?>
</div>
