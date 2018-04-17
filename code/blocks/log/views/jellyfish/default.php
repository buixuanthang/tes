<?php 
    global $config,$tmpl;
    $tmpl -> addStylesheet("jellyfish_log","blocks/log/assets/css");
    $tmpl -> addScript("jellyfish_log","blocks/log/assets/js");
    $module = FSInput::get('module');
    $view = FSInput::get('view','users');
    $redirect = '';
    if($module != 'user'){
    	$redirect = base64_encode($_SERVER['REQUEST_URI']);
    }
?>
<div class='logs'> 
    <?php if(!isset($_COOKIE['user_id'])){?>
    	<?php if($module == 'users' && $view == 'users'){?>
    		<img class="img-login" src="<?php echo URL_ROOT.'blocks/log/assets/images/login_1.png'; ?>" alt="Đăng nhập"/>
		    <div class="link-login">
		   		<a class='login user_item'  href="<?php echo FSRoute::_('index.php?module=users&task=login&Itemid=39');?>" ><?php echo FSText::_('Đăng nhập'); ?></a>
		   		<span class="stick">|</span>
		   		<a class='register user_item' href="<?php echo FSRoute::_('index.php?module=users&task=register&Itemid=39');?>" ><?php echo FSText::_('Đăng ký'); ?></a>
		    </div> 
    	<?php }else{?>
    		<img class="img-login" src="<?php echo URL_ROOT.'blocks/log/assets/images/login_1.png'; ?>" alt="Đăng nhập"/>
		    <div class="link-login">
		   		<a class='login user_item' data-toggle="modal" data-target="#myModal" href="javascript:void(0) <?php //echo FSRoute::_('index.php?module=users&task=login&Itemid=39');?>" ><?php echo FSText::_('Đăng nhập'); ?></a>
		   		<span class="stick">|</span>
		   		<a class='register user_item' href="<?php echo FSRoute::_('index.php?module=users&task=register&Itemid=39');?>" ><?php echo FSText::_('Đăng ký'); ?></a>
		    </div>  
		    <div class="modal fade" id="myModal" role="dialog">
		    	<form action="<?php echo FSRoute::_("index.php?module=users") ?>" name="login_form" class="login_form" method="post" >
			        <div class="modal-dialog wrapper-lg">
			
			            <!-- Modal content-->
			            <div class="modal-content content-login">
			                <div class="modal-header header-login">
			                    <button type="button" class="close off" data-dismiss="modal"></button>
			                    <div class="tx-login">Đăng nhập tài khoản</div>
			                </div>
			                <div class="modal-body content-f">
			                    <div class="input-username">
			                        <input type="text" name="username" id="username" value="" class='txtinput uname'  placeholder="Tên đăng nhập"//>
			                    </div>
			                    <div class="input-pass">
			                        <input type="password" name="password" id="password"  class='txtinput pass' autocomplete="off"  placeholder="Mật khẩu" />
			                    </div>
			                    <div class="bt-login">
			                        <input type="submit" name="login" class="lg" value="đăng nhập"/>
			                        <div class="link-f">
			                        
			                        
			                            <a href="<?php echo FSRoute::_("index.php?module=users&task=forget&Itemid=156");?>" class="fgpass" title="quyên mật khẩu" >Bạn quyên mật khẩu</a>
			                            <a href="<?php echo FSRoute::_("index.php?module=users&task=register&Itemid=39");?>" class="regis" title="đăng kí tài khoản" >Đăng kí thành viên</a>
			                        </div>
			                    </div>
			                    	<a href="<?php echo FSRoute::_('index.php?module=users&view=face&task=face_login&Itemid=10');?>" class="lg-fb" title="Đăng nhập bằng facebook">
			                    		Đăng nhập bằng facebook
			                    	</a>
			                    	<a onclick="openPopupWindow(this);" class="lg-gg" data-id="google-login" data-height="500" data-width="800" data-url="<?php echo FSRoute::_(URL_ROOT.'index.php?module=users&view=google&raw=1&task=google_login&Itemid=10'); ?>" href="#google_login_button" title="Đăng nhập bằng google +">
			                    		Đăng nhập bằng Google +
			                    	</a>
			                </div>
			            </div>
			        </div>
			         <input type="hidden" name = "module" value = "users" />
		                <input type="hidden" name = "view" value = "users" />
		                <input type="hidden" name = "task" value = "login_save" />
		                <input type="hidden" name = "Itemid" value = "<?php echo $Itemid;?>" />
		                <?php if($redirect)
		                    echo "<input type='hidden' name = 'redirect' value = '$redirect' />";  
		                ?>
			                
				</form>
		    </div>     
    	<?php }?>
 <?php } else {?>
    <div class="info_user_logout">
   	 	<div class="info-user">  
	                    <ul id="sub-ul">
	                        <li class="name-user"><a href="<?php echo FSRoute::_('index.php?module=users&view=users&task=edit&Itemid=45');?>" class="name" title=""><?php echo isset($_COOKIE['username'])?$_COOKIE['username']:$_COOKIE['full_name']; ?></a>
<!--	                            <ul class="sub-list">
	                                <li><a href="<?php echo FSRoute::_('index.php?module=users&view=users&task=edit&Itemid=45');?>" title="">Thông tin</a></li>
	                                <li><a href="<?php echo FSRoute::_('index.php?module=users&task=logout');?>" class="exit">Đăng xuất</a></li>
	                            </ul>-->
	                        </li>
	                        <li><a href="<?php echo FSRoute::_('index.php?module=users&task=logout');?>" title="">Thoát</a></li>
	                    </ul>
	                </div><!--end div info-user -->
	                <div class="user">
	                    <span class="avatar">
		                    <?php if($user -> image){?>
            <img alt="<?php echo $_COOKIE['full_name']; ?>" src="<?php echo URL_ROOT.str_replace('/original/', '/resized/', $user -> image); ?>" width="36" height="36"  class="img-profile"/>
    <?php }else{ ?>
            <img alt="<?php echo $_COOKIE['full_name']; ?>" src="<?php echo URL_ROOT.'images/no-avatar.jpg'; ?>"  class="img-profile"/>
    <?php } ?>
	                    </span>
	                </div>
    	</ul>
    </div>
    <?php } ?>  
    
</div> <!-- end logs -->	