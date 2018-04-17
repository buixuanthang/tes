<div class='logs'> 

<?php if(!isset($_COOKIE['user_id'])){?>
           <a class='login user_item' href="<?php echo FSRoute::_('index.php?module=users&task=login&Itemid=39');?>" > Đăng nhập</a>
           <span>|</span>
           <a class=' register user_item' href="<?php echo FSRoute::_('index.php?module=users&task=register&Itemid=40');?>">Đăng ký</a>
            <?php } else {?>
				<font>Chào:</font> <a class="hsubs" href="<?php echo FSRoute::_('index.php?module=users&view=users&task=edit&Itemid=45');?>"><?php echo isset($_COOKIE['username'])?$_COOKIE['username']:$_COOKIE['full_name']; ?>
				 <span>|</span>
				 <a href="<?php echo FSRoute::_('index.php?module=users&task=logout');?>" class="exit">Thoát</a>

            <?php } ?>   
</div> <!-- end logs -->	