<?php $Itemid = FSInput::get('Itemid',1,'int');?>
<?php global $config,$tmpl;
// echo "<pre>";
// print_r($tmpl);
// echo "<>";
?>
<?php global $is_mobile; ?>
<?php   $lang = isset($_SESSION['lang'])?$_SESSION['lang']:'vi'; ?>

<div class="wrapper_top _bg">
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
			<?php  $tmpl -> load_direct_blocks('shopcart', array('style'=>'style1'));?>
			<div class="hotline fr">
				<div>
					
					<span>
						<a href="tel:<?php echo $config['hotline1'];?>" title="Hotline: <?php echo $config['hotline1'];?>"><?php echo $config['hotline1'];?></a>				
						
					</span>
					<span><font>Tư vấn bán hàng</font></span>
				</div>
				
			</div>
			

			<?php echo $tmpl -> load_direct_blocks('search',array('style'=>'default')); ?>
		</div>

		<div class='clear'></div>
	</div>
</div>

<div class="navigation_main_wrapper _bg">
	<div class="navigation_main container">
			<?php  echo $tmpl -> load_direct_blocks('product_menu',array('style'=>'drop_down')); ?>
		
		<div class='top_menu'>
		 	<?php echo $tmpl -> load_direct_blocks('mainmenu',array('style'=>'megamenu','group'=>'1')); ?>
		</div> 
		<div class='clear'></div>
	</div>
</div>

<?php if($Itemid == 1){?>
<div class="container slideshow_head cls">
	<div class="slideshow fl">
		<?php echo $tmpl -> load_direct_blocks('slideshow',array('style'=>'jssor','category_id'=>'45')); ?>
	</div>
	<div class="home_top_r">
		
		<?php if($tmpl->count_block('home_top_r')) {?>
        		<?php  echo $tmpl -> load_position('home_top_r','XHTML2'); ?>
    	<?php }?>		        	
		
	</div>
</div>
<?php }?>


<?php if($tmpl->count_block('pos0')) {?>
	 	<div class="pos0">
	 		<div class="container">
        		<?php  echo $tmpl -> load_position('pos0', 'XHTML'); ?>
        	</div>
        </div>
<?php }?>

<?php if($tmpl->count_block('pos1')) {?>
	 	<div class="pos1">
	 		<div class="container">
        		<?php  echo $tmpl -> load_position('pos1', 'XHTML'); ?>
        	</div>
        </div>
<?php }?>


<div class='clear'></div>

<?php if($tmpl->count_block('pos2')) {?>
      <div class='pos2'>
      		<div class="container">
        		<?php  echo $tmpl -> load_position('pos2', 'XHTML'); ?>
        	</div>
      </div>
<?php }?>

<?php if($tmpl->count_block('main_home_left') || $tmpl->count_block('main_home_right') ) {?>
	 <div class="why_login">
		<div class="container cls">
			<div class="main_home_left">
				<?php  echo $tmpl -> load_position('main_home_left', 'XHTML'); ?>
			</div>
			
		</div>
	</div>
<?php }?>	

    
<div class='clear'></div>


      <?php if($tmpl->count_block('pos3')) {?>
      <div class='pos3'>
      		<div class="container">
        		<?php  echo $tmpl -> load_position('pos3', 'XHTML'); ?>
        	</div>
      </div>
     <?php }?>


     <?php if($tmpl->count_block('pos4')) {?>
		<div class="pos4">
			
			<div class="post-title"><span><a href="<?php echo FSRoute::_('index.php?module=news&view=home'); ?>" title="<?php echo FSText::_('Tin tức'); ?>"><?php echo FSText::_('Tin tức'); ?></a> - <a href="<?php echo FSRoute::_('index.php?module=videos&view=home'); ?>" title="<?php echo FSText::_('Video'); ?>"><?php echo FSText::_('Video'); ?></span></div>	

			<div class="container">
							
				<div class="pos4_inner cls">
					<?php  echo $tmpl -> load_position('pos4','XHTML'); ?>
				</div>
			</div>
		</div>
	<?php }?>

<?php if(($Itemid !=1)):?>
	<?php  echo $tmpl -> load_direct_blocks('breadcrumbs',array('style'=>'simple')); ?>
<?php endif;?>    
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

	        <?php if($tmpl->count_block('pos5')) {?>
		      <div class='pos5' id="pos5">
		      		<div class="pos5_inner container ">
		        		<?php  echo $tmpl -> load_position('pos5', 'XHTML'); ?>
		        	</div>
		      </div>
		     <?php }?>
			<?php if($tmpl->count_block('pos6')) {?>
		      <div class='pos6' id="pos6">
		      		<div class="container">
		        		<?php  echo $tmpl -> load_position('pos6', 'XHTML'); ?>
		        	</div>
		      </div>
		     <?php }?>
		     <?php if($tmpl->count_block('pos7')) {?>
		      <div class='pos7' id="pos7">
		      		<div class="pos7_inner">
		        		<?php  echo $tmpl -> load_position('pos7', 'XHTML'); ?>
		        	</div>
		      </div>
		     <?php }?>
		      <?php if($tmpl->count_block('pos8')) {?>
		      <div class='pos8'>
		      		<div class="container">
		        		<?php  echo $tmpl -> load_position('pos8', 'XHTML'); ?>
		        	</div>
		      </div>
		     <?php }?>
<?php if($tmpl->count_block('pos9')) {?>
      <div class='pos9'>
      		<div class="container">
        		<?php  echo $tmpl -> load_position('pos9', 'XHTML'); ?>
        	</div>
      </div>
     <?php }?>
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

			<?php  $tmpl -> load_direct_blocks('share',array('style'=>'fast'))?>  
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