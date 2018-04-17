	  
    <div class='product_tab_content' id="tabs">
   		<div id="prodetails_tab1" class="prodetails_tab">
	   		  <div class='tab_label'><?php echo FSText::_('Đặc điểm nổi bật'); ?></div>
        	<div class='tab_content_right tab_content_right_bg'>
             <p>Đặc điểm nổi bật của <strong><?php echo $data -> name; ?></strong></p> 
        		
        		<div class='description'>
                <?php 
                $description = $this -> standart_content_amp( $description);

                echo $description;

                ?>
              
				</div>
				<?php if($data -> summary){?>
        			<?php 	include 'default_tags.php'; ?>
        		<?php }?>
			</div>
   		</div>
		<div id="prodetails_tab2" class="prodetails_tab" >
			<div class='tab-title' id='spect_title'><span><?php echo FSText::_('Thông số kỹ thuật'); ?></span></div>
        	<div class='tab_content_right tab_content_right_bg'>
        		<div class='characteristic description'>
               <p><?php echo FSText::_('Thông số kĩ thuật của'); ?> <strong><?php echo $data -> name; ?></strong></p> 
            <?php 	//include 'default_characteristic.php'; ?>
            	
              <?php if($data -> specs_copy){ ?>
              <?php echo  $this -> standart_content_amp( $data -> specs_copy); ?>

              <?php } ?>
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
   		<div id="prodetails_tab5" class="prodetails_tab">
	   		<?php 	
  			$title_relate =  FSText::_('Sản phẩm khác');
  			$relate_type = 3;
        if($relate_products_list){
          $list_related = $relate_products_list;
        }else{
          $list_related = $products_in_cat;  
        }
  			
  			include 'related/default_related.php';
			?>
   		</div>

		<?php if($relate_news){?>
   		<div id="prodetails_tab50" class="prodetails_tab">
	   		<?php 	
			$title_relate =  FSText::_('Tin tức liên quan');
			$relate_type = 3;
			$list_related = $products_same_price;
			include 'default_news_related.php';
			?>
   		</div>
   		<?php }?>
		   		
   		
	</div>
	
