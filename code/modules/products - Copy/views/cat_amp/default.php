	<?php 
	global $tmpl;
	$tmpl -> addStylesheet('products_amp');
	$tmpl -> addStylesheet('cat_amp','modules/'.$this -> module.'/assets/css');
//	$tmpl -> addScript('cat','modules/'.$this -> module.'/assets/js');
//	$tmpl -> addScript('shopcart','modules/products/assets/js');
//	$tmpl -> addScript('follow');

	?>
<div class="products-cat">
	<div class="field_title">
		<div  class="title-name">
			
			<h1  ><span><?php echo $cat -> name; ?></span></h1>
		</div>
			<select class="order-select" name="order-select">
			<option value="">Sắp xếp theo</option>			             
                		<?php 
                		foreach($array_menu as $item) {
							$link = FSRoute::addParameters('sort',$item[0]);	
						?>
			<option <?php echo $sort == $item[0] ? 'selected="selected"':''; ?> value="<?php echo $link; ?>"><?php echo $item[1]?></option>
		<?php }?>	
             </select>

             <div class="icon-filter">
				<span></span>
				<div class="filter_inner mypopup">
					<div class="block_products_filter" >
						
						<?php  echo $tmpl -> load_direct_blocks('products_filter',array('style'=>'no_cal_multiselect')); ?>

					</div>
				</div>
			</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	
	<section class='products-cat-frame'> 
		<div class='products-cat-frame-inner'>
		<?php if($cat -> description){?>
		<article class='cat_summary'>
			<?php echo $cat -> description; ?>
		</article>
		<?php }?>
		<?php include_once 'default_grid.php';?>
		</div>
	</section>
	
	<?php if($pagination) echo $pagination->showPagination(3); ?>
</div>

