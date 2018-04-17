<?php $Itemid = FSInput::get('Itemid',1,'int');
$link = $_SERVER['REQUEST_URI'];
$link = URL_ROOT.substr(str_replace('.amp','.html',$link),1);
$tmpl -> addStylesheet('amp');
?>
<div class="header container cls" id="header">
	
  
	<?php if($Itemid == 1){?><h1><?php }?>
		<a href="<?php echo URL_ROOT;?>" title="<?php echo $config['site_name']?>" class='logo' rel="home" >
			<amp-img src="<?php echo URL_ROOT.str_replace('.png', '_small.png', $config['logo']); ?>" width="161" height="40" ></amp-img>
		

		</a>
	<?php if($Itemid == 1){?></h1><?php }?>
	
	<div class="hotline fr">
		<div>
			<span><span>Hotline</span> (7h-22h)</span>
			<span>
				<a href="tel:<?php echo $config['hotline1'];?>" title="Hotline: <?php echo $config['hotline1'];?>"><?php echo $config['hotline1'];?></a> - 
				<a href="tel:<?php echo $config['hotline2'];?>" title="Hotline: <?php echo $config['hotline2'];?>"><?php echo $config['hotline2'];?></a>				
				
			</span>
		</div>		
	</div>
	<div id="search_amp" class="">
				<a href="<?php echo $link; ?>" title="<?php echo FSText::_('Tìm kiếm trên phiên bản đầy đủ'); ?>"><span><?php echo FSText::_('Tìm kiếm trên phiên bản đầy đủ'); ?></span></a>
	</div>

</div>
<div class="menu_navbar cls">
	<button on="tap:product_menu_sidebar.toggle"  class="amp_productmenu_navbar">
		<span>Danh mục sản phẩm	</span>  	
	</button>
	<button on="tap:mainmenu_sidebar.toggle"  class="amp_topmenu_navbar navbar-left">
	  	
	</button>
</div>
  

<?php if(($Itemid !=1)){?>
 	<div class='breadcrumbs container cls container'>
       				<?php  echo $tmpl -> load_direct_blocks('breadcrumbs',array('style'=>'amp')); ?>
	</div>
<?php }?>
<div class="main_content container">
<?php  echo $main_content; ?>
</div>
<footer class="container">
	<div class="footer_info">
		<?php echo $config['footer_info']; ?>
	</div>	
	
	
	<div class="navigation_sub">
		<?php $tmpl -> load_direct_blocks('mainmenu',array('style'=>'bottommenu_amp','group'=>'3'))?>  
	</div>

	<div class="clear"></div>
	<div class="footer_amp_note">Bạn đang xem phiên bản AMP</div>
	<div class="view_full">
		<a href="<?php echo $link; ?>" title="Xem phiên bản đầy đủ">Xem phiên bản đầy đủ</a>
	</div>
	<div class="copyright">Tư vấn SEO và Thiết kế website <a href="http://delectech.vn"  title="Thiết kế website Delectech">Delectech.vn</a></span></div>

	<div id='fixed-bar'>
	  <div id='bar-inner'>
	    <a class='go-top' href='#header' title='back to top'><i class="fa fa-angle-up"></i></a>	    
	  </div>
	</div>

</footer>
<?php echo $tmpl -> load_direct_blocks('mainmenu',array('style'=>'amp','group'=>'1')); ?>

 <?php  echo $tmpl -> load_direct_blocks('product_menu',array('style'=>'amp')); ?>
