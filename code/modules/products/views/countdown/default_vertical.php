<?php 
$tmpl -> addScript('masonry.pkgd.min','libraries/jquery/masonry/js');
$filter = FSInput::get('filter');
$order = FSInput::get ('order');
?>
		
				<div class="products_item_list clearfix">
					<?php 
						include 'fetch_pages.php';
						echo $html;
					?>
				</div>
		    <?php echo $load_more->showLoadmore();?>

<input type="hidden" value="<?php echo $filter; ?>" id="filter" name="filter">
<input type="hidden" value="<?php echo $order; ?>" id="order" name="order">
<input type="hidden" value="<?php echo $cat->id?>" id="category_id" name="category_id">
	