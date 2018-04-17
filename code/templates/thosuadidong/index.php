<?php $Itemid = FSInput::get('Itemid',1,'int');?>
<?php global $config,$tmpl; ?>
<?php global $is_mobile; ?>
<?php   $lang = isset($_SESSION['lang'])?$_SESSION['lang']:'vi'; ?>


<div class="wrapper_top">
	<div class='container'>
		<a class="bt-res" href="javascript:void(0)">
        	<span class="line-bt-res"></span>
            <span class="line-bt-res"></span>
            <span class="line-bt-res"></span>
    	</a>

			<a class="logo" href="<?php echo URL_ROOT;?>" title="<?php echo $config['site_name']?>">
				
				<img class="logo_img" src="<?php echo URL_ROOT.$config['logo']?>" alt="<?php echo $config['site_name']?>" />
				<img class="logo_img_small" src="<?php echo URL_ROOT.str_replace('.png', '_small.png', $config['logo']); ?>" alt="<?php echo $config['site_name']?>" />
				
			</a>

		<div class='wrapper_top_c'>
			<?php  $tmpl -> load_direct_blocks('strengths', array('style'=>'thosuadidong'));?>	
		</div>
		<div class='clear'></div>
	</div>
</div>

<!-- end	 -->
<div class="navigation_main_wrapper _bg1">
	<div class="navigation_main container">
		<div class='top_menu'>

		 	<?php echo $tmpl -> load_direct_blocks('mainmenu',array('style'=>'multilevel','group'=>'1')); ?>
	
		</div> 
		<div class='clear'></div>
	</div>
</div>

<!-- end	 -->

<!-- breadcrumbs -->
<?php if(($Itemid !=1)):?>
	<?php  echo $tmpl -> load_direct_blocks('breadcrumbs',array('style'=>'simple')); ?>
<?php endif;?>
<!-- end	 -->

<div class='clear'></div>

<!-- slideshow-->
<?php if($Itemid ==1){?>
<div class=" slideshow_head cls _bg slider-home">
	<?php echo $tmpl -> load_direct_blocks('slideshow',array('style'=>'jssor','category_id'=>'45')); ?>
</div>
<?php }?>
<!-- end slideshow	 -->
<div class='clear'></div>

<!-- product -->

	
<div class="main_wrapper <?php echo $Itemid == 1?'main_wrapper_home':'main_wrapper_normal'; ?>">
	<div id="main_wrapper_content" class="container">
			
	        <?php 
			$class_center = '-1col';
			if($tmpl->count_block('left')){
				if($tmpl->count_block('right')){
					$class_center = '-3col'; 
				} else {
					$class_center = '-2col-left'; 
				} 
			} else {
				if($tmpl->count_block('right')){
					$class_center = '-2col-right'; 
				}
			}
			?>
			
	        <div class="center<?php echo $class_center; ?>">
	        	
	             
        		<?php  echo $main_content; ?>
        		
        		<?php if($tmpl->count_block('main_bottom')) {?>
			      <div class='main_bottom' id="main_bottom">
			      		<div class="main_bottom ">
			        		<?php  echo $tmpl -> load_position('main_bottom', 'XHTML'); ?>
			        	</div>
			      </div>
			     <?php }?>
				
	        </div><!--end: .center-col-->
	        
	         <?php if($tmpl->count_block('left')) {?>
	        <div class="left-col">
	            <?php  echo $tmpl->load_position( 'left', 'XHTML'); ?>
	        </div><!--end: .left-col-->
	        <?php }?>
	  
	        <?php if($tmpl->count_block('right')) {?>
	        <div class="right-col">
	            <?php  echo $tmpl->load_position('right','XHTML'); ?>
	        </div><!--end: .right-col-->
	        <?php }?>
	        
	        <div class="clear"></div>
	    </div><!--end: #wrapper-->
		    
</div>

<!-- video -->
<?php if($tmpl->count_block('pos2')) {?>
	 	<div class="pos2 video">
	 		<div class="container">
        		<?php  echo $tmpl -> load_position('pos2', 'XHTML'); ?>
        	</div>
        </div>
 <?php }?>
<!-- end	 -->
<div class='clear'></div>

<!-- thong tin huu ich -->
<?php if($tmpl->count_block('pos3')) {?>
	 	<div class="pos3 news">
	 		<div class="container">
        		<?php  echo $tmpl -> load_position('pos3', 'XHTML'); ?>
        	</div>
        </div>
 <?php }?>
<!-- end	 -->
<div class='clear'></div>

<!-- cam nhan khach hang -->

<?php if($tmpl->count_block('pos4')) {?>
	 	<div class="pos4 testimonials">
	 		<div class="container">
        		<?php  echo $tmpl -> load_position('pos4', 'XHTML'); ?>
        	</div>
        </div>
 <?php }?>

<!-- end	 -->

<div class='clear'></div>

<!-- Hotline -->
<?php if($Itemid ==1){?>
<div class="box-hotline">
	<div class="container bg-hl">
		<div class="box-hotline-left">
			<img src="<?php echo URL_ROOT?>/images/logo_hl.png" alt="logo_hl">
		</div>
		<div class="box-hotline-midd">
			<h2>Điện thoại của bạn đang bị hỏng?</h2>
			<p>Đừng ngần ngại, hãy gọi ngay cho Thợ Sửa Di Động  để chúng tôi tư vấn miễn phí cho bạn</p>
			<p class="phone"><i class="fa fa-phone"></i>Tổng đài hỗ trợ: <b>0982 246 215</b></p>
		</div>
		<div class="box-hotline-right"><img src="<?php echo URL_ROOT?>/images/cogai.png" alt="tong-dai-vien"></div>
	</div>
</div>
<?php }?>
<!-- end	 -->

<div class='clear'></div>
<!-- NUMBER Footer -->
<div class="number _bg">
	<div class="number_inner container">
		<div class="number-left boder">
			<div class="number_plus" id="number1">5000</div>
			<p>THIẾT BỊ ĐƯỢC SỬA CHỮA</p>
			<div class="plus">+</div>

		</div>
		<div class="number-midd boder">
			<div class="number_plus" id="number2">6000</div>
			<p>LỖI KỸ THUẬT ĐƯỢC KHẮC PHỤC</p>
			<div class="plus">+</div>

		</div>
		<div class="number-right boder">
			
			<div class="number_plus" id="number3">500</div>
			<p>KỸ THUẬT VIÊN VÀ HỌC VIÊN</p>
			<div class="plus">+</div>

		</div>
	</div>
</div>
<!-- end	 -->



<!-- Footer -->
<footer class="footer _bg">
	<div class="footer_inner container">
		<div class="left">
			<?php echo $config['footer_info']; ?>
		</div>
		<div class="center fl">
			<div class="navigation_sub">

				<?php $tmpl -> load_direct_blocks('mainmenu',array('style'=>'bottommenu','group'=>'3'))?>  
			</div>
		</div>
		<div class="footer_r">
			<?php echo $tmpl -> load_position('footer_r','XHTML'); ?>


		  	<?php // $tmpl -> load_direct_blocks('share',array('style'=>'column'))?>  
		</div>
		<div class='clear'></div>
		
		<?php $tmpl -> load_direct_blocks('tags',array('style'=>'default_label'))?>
	
	</div>
</footer>

<div id='fixed-bar'>
	  <div id='bar-inner'>
	    <a class='go-top' href='#page-wrapper' title='back to top'><i class="fa fa-angle-up"></i></a>	    
	  </div>
</div>


