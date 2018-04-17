<?php 

	for($i = 0 ; $i < count( $array_cats) ; $i ++)
	{
		$cat = $array_cats[$i];
		$link_cat = FSRoute::_("index.php?module=news&view=cat&ccode=".$cat -> alias."&cid=".$cat->id);
	
	?>
	<div class="box-cate-news">
		<div class="name-cate"><?php echo $cat->name ?><span><a href="<?php echo $link_cat ?>">Xem tất cả <i class="fa fa-angle-right"></i></a></span></div>
		<?php include 'default_item_lazy.php'; ?>
		
	</div>



<?php } ?>