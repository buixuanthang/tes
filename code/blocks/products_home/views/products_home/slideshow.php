<?php 
global $tmpl;


$tmpl -> addStylesheet('owl.carousel','libraries/jquery/owl.carousel.2/assets');
$tmpl -> addScript('owl.carousel.min','libraries/jquery/owl.carousel.2');


$tmpl -> addStylesheet('products');
$tmpl -> addStylesheet('slideshow','blocks/products_home/assets/css');
$tmpl -> addScript('slideshow','blocks/products_home/assets/js');
$lang = isset($_SESSION['lang'])?$_SESSION['lang']:'vi'; 
$cols = 4;
FSFactory::include_class('fsstring');
?>
<div class="wapper-content-page product_home_content">
	<?php 
	for($i = 0 ; $i < count( $array_cats) ; $i ++)
	{
		$cat = $array_cats[$i];
		if(!count($array_products[$cat->id])){
			continue;
		}
		$Itemid_cat = 34;
		$link_cat = FSRoute::_("index.php?module=products&view=cat&ccode=".$cat -> alias."&cid=".$cat->id);
		?>
		
		<div class="cat_item_store">
			<div class='cat-title'>
				<?php  if($cat->image)  {?>
					<img alt="<?php echo $cat->name?>" src="<?php echo URL_ROOT.$cat->image; ?>" />
				<?php  }?>
				<h2  class='cat-title-main'><a href="<?php echo $link_cat; ?>" title="<?php echo $cat->name;?>"><?php echo $cat->name;?></a></h2>
				
				<?php if(isset($array_cats_child[$item -> id]) && $array_cats_child[$item -> id]){ ?>
				<div class='cat_sub_links'>
					<div class='cat_sub_links_inner'>
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
					<span class="icon">
					</span>
				</div>
				<?php }elseif(!empty($filters)){?>
				<div class='cat_sub_links'>		
					<div class='cat_sub_links_inner'>
						<?php 

						if($lang == 'vi'){
							$arr_filter_config =  array('2 chiều inverter' => array('57','55'),'1 chiều inverter'=>array('58','55'),'2 chiều non-inverter'=>array('57','56'),'1 chiều non-inverter'=>array('58','56') )	; 
						}else{
							$arr_filter_config =  array('2 way inverter' => array('57','55'),'1 way inverter'=>array('58','55'),'2 way non-inverter'=>array('57','56'),'1 way non-inverter'=>array('58','56') )	; 
						}
						?>
							<?php $c = 0; ?>
						<?php foreach($arr_filter_config as $key => $filter_ids){
							$str_filter = '';
							
							foreach($filters as $filter){
								if(in_array($filter -> filter_value,$filter_ids)){
									if($str_filter)
										$str_filter .= ',';
									$str_filter .= $filter -> alias;	
								}						
								
							}	
							$link_sub = FSRoute::_("index.php?module=products&view=cat&ccode=".$cat -> alias."&cid=".$cat->id.'&filter='.$str_filter);
							?>
							<?php 
							if($c)
								echo '<span class="sepa">|</span>';
							echo '<a href="'.$link_sub.'" title="'.$key.'">'.$key.'</a>'; 	
							?>
							<?php 
							$c ++;	
						}?>
					</div>
					<span class="icon">
					</span>	
				</div>	
				<?php } ?>
                <div class="clear"></div>
			</div>
			<?php include 'slideshow_items.php';?>
            <div class="clear"></div>
		</div>
	<?php 	
	} 
	?>
	<div class='clear'></div>
</div><div class="wapper-content-page-bottom">&nbsp;</div>