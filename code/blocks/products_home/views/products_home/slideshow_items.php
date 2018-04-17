<div class="row ">
<div class="row_inner">
	<div class="products_home_slideshow"  id="<?php echo "products_home_slideshow_".$cat -> id; ?>">
		<!--	EACH PRODUCT				-->
		<?php 
		$products = $array_products[$cat->id];
		for($j = 0 ; $j < count($products); $j ++)
		{
			$item = $products[$j];
			$link_buy = FSRoute::_("index.php?module=products&view=cart&task=buy&id=".$item->id."&Itemid=94");
			$Itemid = 35;
  			$link = FSRoute::_('index.php?module=products&view=product&code='.$item -> alias.'&ccode='.$item->category_alias.'&id='.$item->id.'&cid='.$item->category_id.'&Itemid='.$Itemid);
		?>
            <div  class="item ">					
                <div class="frame_inner">
		        	<figure class="product_image ">
		        		<?php $image_small = str_replace('/original/', '/resized/', $item->image); ?>
		  				<a href="<?php echo $link;?>" title='<?php echo $item->name;?>'>
							<img alt="<?php echo $item->name;?>" src="<?php echo URL_ROOT.$image_small;?>"  onerror="javascript:this.src='<?php echo URL_ROOT.'images/NA240x240.png';?>'"/>
						</a>
						<a href="<?php echo $link;?>" title='<?php echo $item->name;?>'>
							<div class="summary">
							
								<div class="summary_inner">
				            		<?php $summary = trim($item->summary);?>
				            		<?php $summary = str_replace(array("<br>","<br/>","<br />"),'</p><p>', $summary); ?>
				            		<?php $summary = str_replace(array("<p>&nbsp;</p>\n","<p></p>","<p>&nbsp;</p>", "&nbsp;<br />\n"), array('', ''), $summary); ?>
				            		<?php echo nl2br($summary); ?>
			            		</div>
	            			</div>
	            		</a>
		        	</figure>
	        	 	<?php if(@$item -> is_new){ ?>
						<div class="new_icon"></div>
					<?php }?>
					<?php if(@$item -> is_hot){ ?>
						<div class="hot_icon"></div>
					<?php }?>
					<?php if(@$item -> is_sale){ ?>
						<div class="sale_icon"></div>
					<?php }?>
					<h2><a href="<?php echo $link; ?>" title = "<?php echo $item -> name ; ?>" class="name" >
		  				<?php echo FSString::getWord(15,$item -> name); ?>
		        	</a> </h2>	
		        	<div class='price_arae'>
				  		<div class='price_current'><?php echo format_money($item -> price).''?></div>
			        
		            	<?php if( $item -> price_old && $item -> price_old > $item -> price){?>
		            		<div class='price_old'><span><?php echo format_money($item -> price_old).''?></span></div>
		            	<?php }?>
            		</div>
					<a class="button-detail" href="<?php echo $link;?>"><span ><?php echo FSText::_('Mua hàng'); ?></span></a>
					<div class="clear"></div> 
				  	<!--<?php if(count($types)){?>

						<?php foreach($types as $type){?>

							<?php if(strpos($item -> types,','.$type->id.',') !== false || $item -> types == $type->id){?>

								<div class='product_type product_type_<?php echo $type -> alias; ?>'><img src="<?php echo URL_ROOT.$type->image; ?>" alt="<?php echo $type -> name; ?>" /></div>

								<?php break;?>		

							<?php }?>

						<?php }?>
				
					<?php }?>  									
					-->
                </div>   <!-- end .frame_inner -->	                                                   
			</div> 	 
               
		<?php 
		}
		?>		
		<!--	end EACH PRODUCT				-->
        
		</div>
	</div>
</div>