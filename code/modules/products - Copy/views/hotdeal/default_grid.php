<?php
FSFactory::include_class('fsstring');
?>
<div class='product_grid'>
    <?php $tmp = 0; ?>
    <?php if(count($list)){?>
		<?php foreach($list as $item){?>
			<?php include 'default_item_lazy.php';?>               
	    <?php }?>
    <?php }?>
    <div class="clear"></div>
</div><!--end: .vertical-->

