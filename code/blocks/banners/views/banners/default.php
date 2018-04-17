<?php global $tmpl;
	$tmpl -> addStylesheet('banners_wrapper','blocks/banners/assets/css');
?>
<div class='banners  banners-<?php echo $style; ?> block_inner block_banner<?php echo $suffix;?> cls'  >
	<?php $i = 0;?>
	<?php foreach($list as $item){?>
		<?php if($item -> type == 1){?>
			<?php if($item -> image){?>
				<a rel="nofollow" href="<?php echo $item -> link;?>" title='<?php echo $item -> name;?>'  id="banner_item_<?php echo $item ->id; ?>" class="banner_item">
					<?php if($item -> width && $item -> height){?>
					<img class="img-old img-responsive lazy"  alt="<?php echo $item -> name; ?>"  data-src="<?php echo URL_ROOT.$item -> image;?>" width="<?php echo $item -> width;?>" height="<?php echo $item -> height;?>" >
					<?php } else { ?>
					<img class="img-old img-responsive lazy" alt="<?php echo $item -> name; ?>" data-src="<?php echo URL_ROOT.$item -> image;?>" >
					<?php }?>
				</a>
			<?php }?>		
		<?php } else if($item -> type == 2){?>
			<?php if($item -> flash){?>
			<a rel="nofollow" href="<?php echo $item -> link;?>" title='<?php echo $item -> name;?>' id="banner_item_<?php echo $item ->id; ?>"  class="banner_item">
				<embed menu="true" loop="true" play="true" src="<?php echo URL_ROOT.$item->flash?>"  wmode="transparent"
				pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="<?php echo $item -> width;?>" height="<?php echo $item -> height;?>">
			</a>
			<?php }?>
		<?php } else {?>
			<div class='banner_item_<?php echo $i; ?> banner_item' <?php echo $item -> width?'style="width:'.$item -> width.'px"':'';?> id="banner_item_<?php echo $item ->id; ?>">
				<?php echo $item -> content; ?>
			</div>
		<?php }?>
		<?php $i ++; ?>
	<?php }?>   
		    	
</div>
	     	

 