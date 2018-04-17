<?php global $config,$tmpl;
    $tmpl -> addStylesheet('manufactories','modules/products/assets/css');
   $i = 0;$j = 0;
?> 
<div class="home-menu">
	<h1 class="img-title-cat page_title">
      <span><?php echo FSText::_('Thương hiệu'); ?></span>
    </h1>

	<div class="hot-wapper-page clearfix">
		<?php foreach ($list as $item){?>
			<?php  $link = FSRoute::_('index.php?module=products&view=manufactory&code='.$item->alias.'&id='.$item->id);?>
			<div class='item'>
				<figure>
					<a class='img' href="<?php echo $link; ?>">
						<img class="img-responsive" src="<?php echo URL_ROOT.str_replace('/original/','/resized/', $item->image); ?>" onerror="javascript:this.src='<?php echo URL_ROOT.'images/NA170x170.jpg'?>';"/>
					</a>	
				</figure>
				<h2  class="fsh fosb" >
					<a class="blue" href="<?php echo $link; ?>" title="<?php echo $item->name; ?>"><?php echo $item->name; ?></a>
				</h2>
			</div>
		<?php } ?>
	</div>
	
</div>


