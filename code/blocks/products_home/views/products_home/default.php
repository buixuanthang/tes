<?php 
global $tmpl;
$tmpl -> addStylesheet('products');
$tmpl -> addStylesheet('default','blocks/products_home/assets/css');
//$tmpl -> addScript('products_home','blocks/products_home/assets/js');
$Itemid = 30;
$Itemid_detail = 31;
$cols = 4;
FSFactory::include_class('fsstring');
?>
<div class="wapper-content-page">
	<?php 
	for($i = 0 ; $i < count( $array_cats) ; $i ++)
	{
		$cat = $array_cats[$i];
		if(!count($array_products[$cat->id])){
			continue;
		}
		$Itemid_cat = 34;
		$link_cat = FSRoute::_("index.php?module=products&view=cat&ccode=".$cat -> alias."&cid=".$cat->id."&Itemid=".$Itemid_cat);
		?>
		
		<div class="cat_item_store">
			<div class='cat-title'>
				<?php  if($cat->image)  {?>
					<img alt="<?php echo $cat->name?>" src="<?php echo URL_ROOT.$cat->image; ?>" />
				<?php  }?>
				<h2  class='cat-title-main'><a href="<?php echo $link_cat; ?>" title="<?php echo $cat->name;?>"><?php echo $cat->name;?></a></h2>
				
				<?php if(isset($array_cats_child[$item -> id]) && $array_cats_child[$item -> id]){ ?>
				<div class='cat_sub_links'>
					<?php 
					$c = 0;
					foreach($array_cats_child[$item -> id] as $sub){
						$link_sub = FSRoute::_("index.php?module=products&view=cat&ccode=".$sub -> alias."&cid=".$sub->id);
						if($c)
							echo '<span class="sepa">|</span>';
						echo '<a href="'.$link_sub.'" title="'.$sub->name.'">'.$sub->name.'</a>'; 	
						$c ++;	
					}
					?>
				</div>
				<?php }?>
                <div class="clear"></div>
			</div>
			<?php include 'default_items.php';?>
            <div class="clear"></div>
		</div>
	<?php 	
	} 
	?>
	<div class='clear'></div>
</div><div class="wapper-content-page-bottom">&nbsp;</div>