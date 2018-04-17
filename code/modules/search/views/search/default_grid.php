<?php
FSFactory::include_class('fsstring');
?>
<div class='product_grid'>
    <?php $tmp = 0; ?>
    <?php if(count($list)){?>
		<?php foreach($list as $item){?>
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
					            		<?php echo $summary; ?>
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
						<a class="button-detail" href="<?php echo $link;?>"><span >+</span></a>
						<div class="clear"></div> 
                      </div>   <!-- end .frame_inner -->
	                            
                           			
				<div class="clear"></div> 
	        </div> 	 
	    <?php }?>
    <?php }?>
    <div class="clear"></div>
</div><!--end: .vertical-->

