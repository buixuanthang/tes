<?php 
    global $config,$tmpl;
    $tmpl -> addStylesheet("log","blocks/log/assets/css");
?>
<div class='logs'> 
        <?php if(!isset($_COOKIE['full_name'])){?>
	           	<a class='login user_item' href="<?php echo FSRoute::_('index.php?module=users&task=login&Itemid=39');?>" >Đăng nhập</a>
	           	<span class='sepa'></span>
	           	<a class=' register user_item' href="<?php echo FSRoute::_('index.php?module=users&task=register&Itemid=40');?>">Đăng ký</a>
	           	<span class='sepa'></span>
        		<a href="<?php echo FSRoute::_('index.php?module=users&view=face&task=face_login&Itemid=10');?>" class="" title="">
        			<img src="<?php echo URL_ROOT ?>templates/default/images/facebook-icon.png" alt="" />
        		</a>
        		<span class='sepa'></span>
          		<a onclick="openPopupWindow(this);" data-id="google-login" data-height="500" data-width="800" data-url="<?php echo FSRoute::_(URL_ROOT.'index.php?module=users&view=google&raw=1&task=google_login&Itemid=10'); ?>" href="#google_login_button">
                    <img src="<?php echo URL_ROOT ?>templates/default/images/google-icon.png" alt="Đăng nhập với Googleplus" />
              	</a>  
          
        <?php } else {?>

            <a class="hsubs" href="<?php echo FSRoute::_('index.php?module=users&view=users&task=edit&Itemid=45');?>"><?php echo $_COOKIE['full_name']; ?></a>
            <span class='sepa'></span>
            <a href="<?php echo FSRoute::_('index.php?module=users&task=logout');?>" class="exit">Thoát</a>
        <?php } ?> 
       
   </div> <!-- end logs -->	