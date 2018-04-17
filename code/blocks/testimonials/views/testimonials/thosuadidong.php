<?php
global $tmpl; 
$tmpl -> addStylesheet('owl.carousel','libraries/jquery/owl.carousel.2/assets');
$tmpl -> addScript('owl.carousel.min','libraries/jquery/owl.carousel.2');
$tmpl -> addStylesheet('thosuadidong','blocks/testimonials/assets/css');
$tmpl -> addScript('thosuadidong','blocks/testimonials/assets/js');
$page =2;
FSFactory::include_class('fsstring');
?>
<?php $link = FSRoute::_('index.php?module=testimonials&view=home'); ?>
<div class="terminal-top-block">
	<span class="text"><i class="fa fa-commenting testerminal-icon"></i>Cảm nhận của khách hàng</span>
	<a href="<?php echo $link ?>">Xem tất cả <span><i class="fa fa-angle-right"></i></span></a>
</div>	
<div class="block_body">
 	<div id="block-tesimonials" class="owl-carousel owl-theme ">
 		<?php  $j=0; foreach($list as $item){?>
 			
 			
 		<div class="item" id="id_item_<?php echo $j; ?>">
 			<div class="item_inner cls">
 			
			 <div class="customer ">
			 	<div class="customer_inner cls">
			         <div class="image ">
			         	<a href="<?php echo $link; ?>" title="<?php echo $item -> title; ?>">			         	
				         	<?php if($item -> image){?>
								 <img  width="330" height="188" src="<?php echo URL_ROOT.str_replace('/original/','/large/', $item->image); ?>" alt='<?php echo $item -> name; ?>' />
							<?php }else{?>
								<img  width="330" height="188"  src="<?php echo URL_ROOT.'images/avatar.jpg'?>" alt='<?php echo $item -> name; ?>' />
							<?php }?>
						</a>
			         </div>
			         <div class="summary">
			         		<div class="sum">
			         			<?php echo $item->summary; ?>
			         		</div>
			                 
			                <div class="description">
			                 	<a href="<?php echo $link; ?>" title="<?php echo $item -> title; ?>"  class="readmore"><?php echo get_word_by_length(150,$item->description);?>&#8221;</a>
			                 </div>
			                 
			         </div>
			        

					</div>

			 </div>
			
			 		</div> <!-- .item_inner -->
			 		 <div class="info-user">
			         	<div class="info-left">
			         		<p><b><?php echo $item->name; ?></b></p>
			         		<p><?php echo $item->more_info; ?></p>
			         	</div>
			         	<div class="info-right">
			         		<div class="start">
			         			<img src="<?php echo URL_ROOT?>/images/testerminal/start_03.png" alt="">
			         		</div>
			         	</div>
			         </div>
			                 	
			                 
 				</div> <!-- .item -->

 			
              <?php $j++;?>

        <?php }?>
    </div>	
   </div> 				

