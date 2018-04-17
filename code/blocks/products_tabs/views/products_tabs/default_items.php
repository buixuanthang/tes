<div class=" products_tab_wrapper <?php echo $i?'hide':''; ?>"  id="<?php echo "products_tab_wrapper_".$type; ?>">
	<div class="slideshow-home-list products_tab product_grid"  id="<?php echo "products_tab_".$type; ?>">
		<?php foreach($rs as $item){?>
				<?php $link = FSRoute::_("index.php?module=products&view=product&id=".$item->id."&code=".$item->alias."&ccode=".$item-> category_alias.'&cid='.$item -> category_id); ?>
        		<div class=" item" >
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
	                            
                            <?php if($item -> promotion_info & 1==0 ):?>
                            	<div id="tool-tip-prd-<?php echo $item -> id; ?>" class="tooltip-content">
                            		<div class="tool-top-title"><?php echo $item -> name; ?></div>
                            		<div class="tool-top-content">
                            			<div class="promotion_info"><strong class="promotion_label">Khuyến mãi: </strong><?php echo $item -> promotion_info; ?></div>
	                            		</div>
	                            	</div>
        						<?php endif;?>				
			<div class="clear"></div> 
        </div> 	 
		<?php }?>
	</div>
</div>