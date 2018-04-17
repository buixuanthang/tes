<?php 
global $tmpl;
$tmpl -> addStylesheet('products');
$tmpl -> addStylesheet('home','modules/home/assets/css');
$tmpl -> addScript('home','modules/home/assets/js');
$Itemid = 30;
$Itemid_detail = 31;
$cols = 4;
FSFactory::include_class('fsstring');

?>

<div class="wapper-content-page">
	<?php $i  = 0;?>
	<?php if($tmpl->count_block('home_pos_'.$i)) {?>
				<div class="home_pos_<?php echo $i; ?> home_pos">
        			<?php  echo $tmpl -> load_position('home_pos_'.$i,'XHTML2'); ?>
        		</div>
        <?php }?>
       <?php if($cat_special){?> 
	<?php include 'default_cat_special.php';?>
	<?php }?>
	<?php $i = 1;?>
	<?php if($tmpl->count_block('home_pos_'.$i)) {?>
				<div class="home_pos_<?php echo $i; ?> home_pos">
        			<?php  echo $tmpl -> load_position('home_pos_'.$i,'XHTML2'); ?>
        		</div>
        <?php }?>
        
	<?php 

	for($i = 0 ; $i < count( $array_cats) ; $i ++)
	{
		$cat = $array_cats[$i];
//		if(!count($array_products[$cat->id])){
//			continue;
//		}
		$Itemid_cat = 34;
		$link_cat = FSRoute::_("index.php?module=products&view=cat&ccode=".$cat -> alias."&cid=".$cat->id."&Itemid=".$Itemid_cat);
		$manufactories = $array_manf[$cat->id];
		?>
        
		<div class="cat_item_store" id="cat_item_store_<?php echo $cat -> id;?>">
			<div class='cat-title'>
				
				<h2  class='cat-title-main' id="cat-<?php echo $cat -> alias;?>">
					
					<a href="<?php echo $link_cat; ?>" title="<?php echo $cat->name;?>" class="_text_2"><?php echo $cat->name;?></a>
				</h2>
				
				<?php  include 'default_filter.php';?>
				
                <div class="clear"></div>
			</div>
			<div class="cat_slideshow_manu cls">
				<?php if($tmpl->count_block('home_inner_pos_l_'.($i+2))) {?>
					<div class="home_inner_pos_l_<?php echo ($i+2); ?> home_inner_pos_l">
	        			<?php  echo $tmpl -> load_position('home_inner_pos_l_'.($i+2),'XHTML2'); ?>
	        		</div>
	        	<?php }?>
	        	
				<div class="home_inner_pos_r_<?php echo ($i+2); ?> home_inner_pos_r">
	    			<?php include 'default_manufactories.php';?>
	    		</div>
	    	</div>
        	

			<div class="clear"></div>
			<ul class="tab_type">
					             
        		<?php 
        		$l = 0;
        		foreach($array_menu as $order) {
					$link = FSRoute::_('index.php?module=products&view=cat&ccode='.$cat -> alias.'&cid='.$cat->id.'&sort='.$order[0]);
				?>
				<li class="<?php echo $l?'':'activated'; ?>">
					<a  href="<?php echo $link;?>" title="<?php echo $order[1];?>"><?php echo $order[1];?></a>	
				</li>
				<?php $l ++; ?>
			
				<?php }?>	
             

			</ul>

			<?php include 'default_items.php';?>
            <div class="clear"></div>
		</div>
		<?php if($tmpl->count_block('home_pos_'.($i+2))) {?>
				<div class="home_pos_<?php echo ($i+2); ?> home_pos">
        			<?php  echo $tmpl -> load_position('home_pos_'.($i+2),'XHTML2'); ?>
        		</div>
        <?php }?>
	<?php 	
	} 

	?>
	<div class='clear'></div>
</div>



<?php // include 'default_remarketing.php';?>

 <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "url": "<?php echo URL_ROOT; ?>",
        "potentialAction": {
            "@type": "SearchAction",
            "target": "<?php echo URL_ROOT; ?>/tim-kiem/{search_term_string}.html",
            "query-input": "required name=search_term_string"
        }
    }
    </script>