<?php 
 global $tmpl;
 $tmpl -> addStylesheet('default','blocks/address/assets/css');
 $cols = 2;
 $total = count($list);
 $i = 0;
 ?>
<div class='block_content address_content'>
	
	<?php foreach ($list as $item) {?>
		<?php $link = FSRoute::_("index.php?module=contact&view=contact&id=".$item->id."&code=".$item->alias);	?>
		<ul>
			<li><i class="fa fa-location-arrow"></i> <strong><?php echo $item->name?></strong> <?php echo ($item->phone)?'- ĐT: '.$item->phone.'':''?></li>
			<li><a href="<?php echo $link;?>">Bản đồ đường đi</a></li>
		</ul>		
	<?php }//end: foreach ?>
	
</div>