<?php
global $tmpl; 
	$tmpl -> addStylesheet('default','blocks/services/assets/css');
	FSFactory::include_class('fsstring');
	?>
<?php if(isset($list) && !empty($list)){?>
<?php if($summary){?>
<div class='block_service_summary block_summary'>
	<?php echo $summary; ?>
</div>
<?php }?>
<div class="product_star">
			<span class="line-thought"></span>
			<span class="star_small"><i class="fa fa-star"></i></span>
			<span class="star_large"><i class="fa fa-star"></i></span>
			<span class="star_small"><i class="fa fa-star"></i></span>
			<span class="line-thought"></span>
		</div>
<div class='services_block block_content'>	
        	<?php foreach($list as $item){?>
        		<?php $link = FSRoute::_("index.php?module=services&view=service&id=".$item->id."&code=".$item->alias."&ccode=".$item-> category_alias); ?>
            	<div  class='item'>
            		<div class='item_inner'>
            			<div>
		            		<a href="<?php  echo $link;?>" title="<?php echo $item -> title; ?>"  rel="nofollow" >
				            	<img src="<?php echo URL_ROOT.str_replace('/original/','/resized/',$item->image);?>"  alt="<?php $item->title;?> " />
				            </a>
			            </div>	
			            <div class="content_title_shadow">&nbsp;</div>
	                   	<a href="<?php  echo $link;?>" title="<?php echo $item -> title; ?>" class='name' ><span><?php echo  $item -> title ;?></span></a>
	                   	
	                   <div class='clear'></div>
					</div>
                  </div>
             <?php }?>	
            <div class='clear'></div>
 <?php }?>
 </div>
<?php if($show_readmore){?>
 	<?php $link = FSRoute::_("index.php?module=services&view=home"); ?>
	<div class='readmore'><a href="<?php echo $link;  ?>" title="Xem tất cả">Xem tất cả</a></div>
<?php } ?> 	

