<?php 
 global $tmpl;
 $cols = 2;
 $total = count($list);
 $i = 0;
 $first = $list[0];
 ?>
<div class="address_header fr">
	<div class="address_header_head">
		<label>Hệ thống cửa hàng</label>
		<div class="more_info"><?php echo $first -> address; ?></div>
	</div>
	<div class="add_full" style="display: none">
		<?php foreach ($list as $item) {?>
			<?php $link = FSRoute::_("index.php?module=contact&view=contact&id=".$item->id."&code=".$item->alias);	?>
			<ul >
				<li><a href="<?php echo $link; ?>"  title="<?php echo $item -> name; ?>" ><?php echo $item->name?></a></li>
				<li><?php echo ($item->phone)?' ĐT: <a href="tel:'.$item->phone.'" title="'.$item -> name.'">'.$item->phone.'</a>':''?></li>
			</ul>		
		<?php }//end: foreach ?>
	</div>
</div>