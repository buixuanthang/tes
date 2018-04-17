<?php $tmpl -> addStylesheet('products'); ?>
<?php if($list_related && count($list_related)){?>

<div class="products-list-related">
    <h3 class="relate_title tab-title"><span><?php echo $title_relate; ?></span></h3>
    <div class='product_grid'>
    	<div class='product_grid_inner'>
	    <?php $tmp = 0; ?>
		<?php foreach($list_related as $item){ ?>
	        <?php $tmp++; ?>
				<?php $link = FSRoute::_("index.php?module=products&view=product&id=".$item->id."&code=".$item->alias."&ccode=".$item-> category_alias.'&cid='.$item -> category_id); ?>
        		<div class=" item" >
                            <div class="frame_inner">
					        	<figure class="product_image ">
					        		<?php $image_small = str_replace('/original/', '/resized/', $item->image); ?>
		  				<a href="<?php echo $link;?>" title="<?php echo htmlspecialchars($item->name);?>"  itemprop="url">
							<amp-img itemprop="image" alt="<?php echo htmlspecialchars($item->name);?>" src="<?php echo URL_ROOT.$image_small;?>"  width="216" height="202" layout="responsive"/>
							</a>
							<a href="<?php echo $link;?>" title='<?php echo $item->name;?>'>
								<div class="summary">
								
									<div class="summary_inner">
										<?php echo $this -> standart_content_amp($item -> summary); ?>										
					            		
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
					<a class="button-detail" href="<?php echo $link;?>"><span >Mua hàng</span></a>
						<div class="clear"></div> 
                      </div>   <!-- end .frame_inner -->
	                            
                           			
				<div class="clear"></div> 
			</div>
		<?php } ?>
</div><!--end: .vertical-->
</div>
</div>
<?php } ?>
