<?php 
	global $tmpl;
	$tmpl -> addStylesheet("users_login_register","modules/users/assets/css");
	$Itemid = FSInput::get('Itemid',1);
	$redirect = FSInput::get('redirect');
    $tmpl -> addScript('form');
    $tmpl -> addScript('users_register','modules/users/assets/js');
?>
<a href="javascript:void(0)" onclick="close_popup()" class="close_popup">
	<img src="<?php echo URL_ROOT?>modules/users/assets/images/close.png" />
</a>
<div class="login_register">
	<div id="register-form" class ="frame_large" >
		<div class="frame_large_head">
			<span><?php echo FSText::_('Đăng ký'); ?></span>
		</div>
      	<div class="frame_large_body">
           	<form action="<?php echo FSRoute::_("index.php?module=users") ?>" name="register_form" class="register_form" method="post" onsubmit="javascript: return checkFormsubmit();">
              	<div class="fieldset_item">
                	<div class="label">Tên đăng nhập<font>(*)</font></div>
                  	<div class="value"><input type="text" name="username" id="username" value="<?php echo FSInput::get('username');?>" class='txtinput'/></div>
                </div> 
                <div class="fieldset_item">
                	<div class="label">Mật khẩu<font> (*)</font></div>
                  	<div class="value"><input type="password" name="password" id="password"  class='txtinput' autocomplete="off" /></div>
                 </div>
                 <div class="fieldset_item">
                    <div class="label">Nhập lại mật khẩu <font>(*)</font></div>
                  	<div class="value"><input type="password" name="re-password" id="re-password" class='txtinput' autocomplete="off"  /></div>
                </div>
              	<div class="fieldset_item">
              	 <div class="label">Họ và tên </div>
                  		<div class="value"> <input type="text" name="full_name" id="full_name"  value="<?php echo FSInput::get('full_name');?>"  class='txtinput'/></div>
                  </div>
              	<div class="fieldset_item">
                	<div class="label">Email của bạn<font> (*)</font></div>
                  	<div class="value"><input type="text" name="email" id="email"  class='txtinput' value="<?php echo FSInput::get('email'); ?>"/></div>
                  	</div>
              	<div class="submit_form">
	              	<div class="label"><?php echo FSText::_("Nh&#7853;p m&atilde; hi&#7875;n th&#7883;"); ?><font> (*)</font></div>
					<div class="value">
	                	<input type="text"  id="txtCaptcha" value="" name="txtCaptcha"  maxlength="10" size="23" />
	                    <a href="javascript:changeCaptcha();"  title="Click here to change the captcha" class="code-view" >
	                        <img id="imgCaptcha" src="<?php echo URL_ROOT?>libraries/jquery/ajax_captcha/create_image.php" />
	                    </a>
	                </div>
					<div class='label_1'>( Trường thông tin có dấu <font>(*)</font> là bắt buộc. )</div><br/>
					<div class='button_area'>
		                <input type="submit" value="Đăng ký" name="submitbt" id="submitbt" class='button' />
						<input type="reset" value="Làm lại" name="reset" id="reset" class='button' />
					</div>
	          	</div>
                    <input type="hidden" name = "module" value = "users" />
                    <input type="hidden" name = "view" value = "users" />
                    <input type="hidden" name = "Itemid" value = "<?php echo $Itemid; ?>" />
                    <input type="hidden" name = "task" value = "register_save" />
       		</form>
	    </div> <!-- .frame_large_body -->
	</div> <!-- .frame_large -->
	<div id="login-form" class ="frame_large" >
	    <div class="frame_large_head">
			Đăng nhập
		</div>
	    <div class="frame_auto_body">
	           <!--  CONTENT IN FRAME      -->
	           <form action="<?php echo FSRoute::_("index.php?module=users") ?>" name="login_form" class="login_form" method="post">
	               <div cellpadding="5" >
	        				
	                        <div class="use_log"><label><?php echo FSText::_("Tên đăng nhập")?> :</label></div>
	                        <div> <input class="txtinput" type="text" name="username"    values="Name@mail.com"/></div> 
	                        
	                   
	                        <div class="use_log"> <label> <?php echo FSText::_("Mật khẩu ")?> :</label></div>
	                        <div> <input  class="txtinput" type="password" name="password"    /> 
	                        </div>
	                   
	                       
	                        <div > <input type="submit" class='submitbt button' name="submitbt" value = "<?php echo FSText::_("&#272;&#259;ng nh&#7853;p");?>"   class= /> </div>
	                   
	                      
	                        <div class="forget_s"> <a href="<?php echo FSRoute::_("index.php?module=users&task=forget&Itemid=156");?>" ><?php echo FSText::_("Qu&#234;n m&#7853;t kh&#7849;u")?> ?</a></div>
	                    	<br/>
	                    	<hr class="sepa" />
	                    	<br/>
	                        <a  class='facebook_login'  href="<?php echo FSRoute::_('index.php?module=users&view=face&task=face_login&Itemid=10');?>" class="" title="">
								<img src="<?php echo URL_ROOT ?>modules/users/assets/images/facebook_login.jpg" alt="" />
								<span>Đăng nhập bằng facebook</span>
								<div class='clear'></div>
							</a>
							<a href="#google_login" class='google_login' data-url="<?php echo URL_ROOT ?>index.php?module=users&view=google&raw=1&task=google_login&Itemid=10" data-width="800" data-height="500" data-id="google-login" onclick="openPopupWindow(this);">
								<img src="<?php echo URL_ROOT ?>modules/users/assets/images/google_login.jpg" alt="" />
                            	<span>Đăng nhập bằng google + &nbsp;</span>
                            	<div class='clear'></div>
                        	</a>
                        	
	                    <!--    <div > <a class="button2" href="<?php echo FSRoute::_("index.php?module=users&task=register&Itemid=39"); ?>">
	                                    <span><?php echo FSText::_("&#272;&#259;ng k&#253; th&#224;nh vi&#234;n"); ?> ?</span>
	                                </a>
	                        </div> -->
	                    
	                </div>
	                <input type="hidden" name = "module" value = "users" />
	                <input type="hidden" name = "view" value = "users" />
	                <input type="hidden" name = "task" value = "login_save" />
	                <input type="hidden" name = "Itemid" value = "<?php echo $Itemid;?>" />
	                <?php if($redirect)
	                    echo "<input type='hidden' name = 'redirect' value = '$redirect' />";  
	                ?>
	            </form> 
		            
		           <!--  end CONTENT IN FRAME      -->
		</div> 
	</div> 
</div><!-- .login_register -->		
		