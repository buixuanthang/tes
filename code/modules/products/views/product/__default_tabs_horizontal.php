	<div class="product-tab" id="smartTab">
        	<ul class='product_tabs_ul cf clearfix cls'>
        		<?php $i = 1; ?>
	        	<li class='scroll-nav__item active'>
	        		<a class="scroll-nav__link" href="#prodetails_tab<?php echo $i++; ?>"><span>Thông tin sản phẩm</span></a>
	        	</li>
           		<li class='scroll-nav__item'>
           			<a class="scroll-nav__link" href="#prodetails_tab<?php echo $i++; ?>"><span>Thông số kỹ thuật</span></a>
           		</li>
           		<li class='scroll-nav__item'>
           			<a class="scroll-nav__link" href="#prodetails_tab<?php echo $i++; ?>"><span><?php echo FSText::_('Nhận xét'); ?></span></a>
           		</li>
			<?php if($products_same_price){ ?>
           		<li class='scroll-nav__item'>
           			<a class="scroll-nav__link" href="#prodetails_tab<?php echo $i++; ?>"><span><?php echo FSText::_('Cùng khoảng giá'); ?></span></a>
           		</li>

           		<?php }?>
            </ul>
            <div class="clearfix"></div>
    </div>    
    <?php $ii = 1; ?>
    <div class='product_tab_content' id="tabs">
   		<div id="prodetails_tab<?php echo $ii++; ?>" class="prodetails_tab">
	   		  <div class='tab_label'><?php echo FSText::_('Thông tin sản phẩm'); ?></div>
        	<div class='tab_content_right'>
        		<div class='description boxdesc'  id="boxdesc">
        			<div id="box_conten_linfo">
	        			<div class="box_conten_linfo_inner">
							<?php echo $description;?>
						</div>
					</div>
					<div class="readmore " id="readmore_desc"><span class="closed"><font class="closed_content">Xem thêm thông tin sản phẩm</font><font class="opened_content">Thu gọn thông tin sản phẩm</font></span></div>
					<?php include_once 'default_tags.php'; ?>
				</div>
			</div>
   		

      <?php // include 'default_buttons2.php'; ?>
      <?php if($is_mobile){ ?>

   		<div id="prodeails_tab50" class="prodetails_tab1 1">
	   		<?php 	
			$title_relate =  'Sản phẩm liên quan';
			$relate_type = 3;
			$list_related = isset($relate_products_list)?$relate_products_list:$products_in_cat;
			include 'related/default_related.php';
			?>

      <?php } ?>
   		</div>
		<div id="prodetails_tab2" class="prodetails_tab">
			<div class='tab-title' id='spect_title'><span><?php echo FSText::_('Thông số kỹ thuật'); ?></span></div>
        	<div class='tab_content_right tab_content_right_bg fw_wrap'>
        		<div class='characteristic description'>
               <p><?php echo FSText::_('Thông số kĩ thuật của'); ?> <strong><?php echo $data -> name; ?></strong></p> 
            <?php //	include 'default_characteristic.php'; ?>
            	<?php echo $data -> characteristic; ?>
            	</div>
          </div>
   		</div>
   		
   	
   		<div id="prodetails_tab3" class="prodetails_tab">
        	<div class='tab_content_right'>
        		<?php 	include 'plugins/comments/controllers/comments.php'; ?>
        		<?php $pcomment = new CommentsPControllersComments(); ?>
				<?php		$pcomment->display($data); ?>
        		<?php 	include 'default_comments_fb.php'; ?>
        	</div>
   		</div>
   		<div id="prodetails_tab4" class="prodetails_tab">
	   		<?php 	
			$title_relate =  FSText::_('Sản phẩm cùng khoảng giá');
			$relate_type = 3;
			$list_related = $products_same_price;
			include 'related/default_related.php';
			?>
   		</div>
   		
   		<?php if($relate_news){?>
   		<div id="prodetails_tab50" class="prodetails_tab">
	   		<?php 	
			$title_relate =  'Tin tức liên quan';
			$relate_type = 3;
			$list_related = $products_same_price;
			include 'default_news_related.php';
			?>
   		</div>
   		<?php }?>
   		
   		<div id="prodetails_tab7" class="prodetails_tab">
   		</div>
	</div>
	<? //include_once("comment_facebook.php");?>
