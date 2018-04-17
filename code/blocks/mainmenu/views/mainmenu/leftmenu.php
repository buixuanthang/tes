
<?php if(!isset($_COOKIE['username'])){?>
<div class='topmenu_wrapper_sale'>
	    	<a href="<?php echo FSRoute::_('index.php?module=users&task=register&Itemid=39');?>" title="sale">Đăng ký</a>
</div>
<div class='topmenu_wrapper_login'> 
	    	<a href="<?php echo FSRoute::_('index.php?module=users&task=login&Itemid=157');?>">Đăng nhập</a>
</div>
	    	<?php } else {?>
	    	<div class='topmenu_wrapper_logged'>
	    		<div class="topmenu_wrapper_logged_left"></div>
	    		<div class="topmenu_wrapper_logged_inner">
	    			Xin chào <a href="<?php echo FSRoute::_('index.php?module=users&view=users&task=logged&Itemid=40');?>"><?php echo $_COOKIE['username']; ?></a>
	    		</div>
	    		<div class="topmenu_wrapper_logged_right"></div>
	    	</div>
	    	<div class='topmenu_wrapper_logout'>
	    		<a href="<?php echo FSRoute::_('index.php?module=users&task=logout&Itemid=40');?>">Thoát</a>
	    	</div>
	    	<?php } ?>