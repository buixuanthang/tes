<?php
global $tmpl,$config; 
$tmpl -> addStylesheet('default','blocks/products_list/assets/css');
$tmpl -> addStylesheet('countdown','modules/products/assets/css');
 $tmpl -> addStylesheet('jquery.countdown','libraries/jquery/jquery.countdown.package-1.6.3');
 $tmpl -> addScript('jquery.countdown','libraries/jquery/jquery.countdown.package-1.6.3');
 $tmpl -> addScript('jquery.countdown-vi','libraries/jquery/jquery.countdown.package-1.6.3');
 $tmpl -> addScript('countdown','blocks/products_list/assets/js');
?>


<?php if(isset($list) && !empty($list)){ ?>
    <div class="block_content">
	      <?php foreach($list as $item){
		      	if($item -> is_hotdeal){
					if($item -> date_end >  date('Y-m-d H:i:s') && $item->date_start <  date('Y-m-d H:i:s')){
						$price = $item->price;
						$price_old = $item->price_old;
					}else{
						$price = $item->price_old;
						$price_old = '';
					}
				}else{
					$price= $item->price;
					$price_old = $item->price_old;
				}
		  		$Itemid = $item -> is_accessories ? 37: 35;
		  		$link = FSRoute::_('index.php?module=products&view=product&code='.$item -> alias.'&id='.$item -> id.'&ccode='.$item->category_alias);
		  		$link_buy = FSRoute::_("index.php?module=products&view=cart&task=buy&id=".$item->id);
		  		?>
		  				<?php if($item -> is_hotdeal){
							if($item -> date_end >  date('Y-m-d H:i:s') && $item->date_start <  date('Y-m-d H:i:s')){
						?>
			  				<span id='countdown_here'></span>
							<input type="hidden" id='deal_time' value="<?php echo date('Y m d H:i:s',strtotime($item->date_end)); ?>">
							<?php 
							}
						}
						?>
                        <div class="frame_img_cat ">
                            <a href="<?php echo $link; ?>" title = "<?php echo $item -> name ; ?>" >
                                <img width="135" height="130" class="img-responsive" src="<?php echo URL_ROOT.str_replace('/original/', '/resized/', $item->image); ?>" alt="<?php echo htmlspecialchars ($item -> name); ?>"  />
                            </a>
                        </div>
                        <div class="frame_view">
                            <h2><a href="<?php echo $link; ?>" title = "<?php echo $item -> name ; ?>" class="name" ><?php echo get_word_by_length(60,$item -> name); ?></a> </h2>	
                            <span>Bảo hành: <?php echo $item->warranty;?></span>
                            <div class="price"> 
                                	<span class="price"> <?php echo format_money($price); ?></span>
                            </div>
                            <div class="old_price"> 
                            	<?php if($item-> discount ){?>
                            		<span> <?php echo format_money($price_old); ?></span>
                            	<?php }?>	
                            </div>
                   		</div> 
                <?php } ?>
	    <div class="clearfix"></div>
    </div>
<?php } ?>
	