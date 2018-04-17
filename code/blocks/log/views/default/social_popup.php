<?php 
    global $config,$tmpl;
    $tmpl -> addStylesheet("social_popup","blocks/log/assets/css");
    $tmpl -> addScript("social_popup","blocks/log/assets/js");
    $module =  FSInput::get('module');
    $view =  FSInput::get('view');
?>
<div class='logs'> 
            <?php if(!isset($_COOKIE['full_name'])){?>
		           	<a class='login user_item' href="javascript:void(0)" onclick="open_popup_log()" >Đăng nhập</a>
		           	<span class='sepa'></span>
		           	<a class=' register user_item'  href="javascript:void(0)" onclick="open_popup_log()" >Đăng ký</a>
		           	<span class='sepa'></span>
            		<a href="<?php echo FSRoute::_('index.php?module=users&view=face&task=face_login&Itemid=10');?>" class="" title="">
            			<img src="<?php echo URL_ROOT ?>templates/default/images/facebook-icon.png" alt="" />
            		</a>
            		<span class='sepa'></span>
              		<a onclick="openPopupWindow(this);" data-id="google-login" data-height="500" data-width="800" data-url="<?php echo FSRoute::_(URL_ROOT.'index.php?module=users&view=google&raw=1&task=google_login&Itemid=10'); ?>" href="#google_login_button">
	                    <img src="<?php echo URL_ROOT ?>templates/default/images/google-icon.png" alt="Đăng nhập với Googleplus" />
	              	</a>  
              		<div class='form_log hide' id='form_log_popup'>
              			<?php if($module != 'users'){?>
	              			<?php include_once 'social_popup_log.php';?>
	              		<?php }?>
	              	</div>
            <?php } else {?>
                <a class="hsubs" href="<?php echo FSRoute::_('index.php?module=users&view=users&task=edit&Itemid=45');?>"><?php echo $_COOKIE['full_name']; ?> <span>(<?php echo $user -> point; ?> xu)</span></a>
                <span class='sepa'></span>
                <a class="message_no <?php echo $no_messages?'message_1':'message_0'?>" href="<?php echo FSRoute::_('index.php?module=messages&view=messages&Itemid=45');?>" title="Tin nhắn" ><span><?php echo $no_messages; ?></span></a>
                <a class="download_no  <?php echo $no_downloads?'download_1':'download_0'?>" href="<?php echo FSRoute::_('index.php?module=estores&view=system_messages&Itemid=45');?>" title="File download" ><span><?php echo $no_downloads; ?></span></a>
                <a href="javascript:void(0)" id='loged_popup_title' >&nbsp;</a>
                <div class='loged_popup_content' style="display: none">
                	<ul>
                		<li class='manage_file'>
                			<?php $url = FSRoute::_('index.php?module=estores&view=products&Itemid=45'); ?>
                			<a href="<?php echo $url; ?>" title="Quản lý file">Quản lý file</a>
                		</li>
                		<li class='deposit'>
                			<?php $url = FSRoute::_('index.php?module=estores&view=products&Itemid=45'); ?>
                			<a href="<?php echo $url; ?>" title="Nạp tiền">Nạp tiền</a>
                		</li>
                		<li class='statistic'>
                			<?php $url = FSRoute::_('index.php?module=estores&view=products&Itemid=45'); ?>
                			<a href="<?php echo $url; ?>" title="Thống kê giao dịch">Thống kê giao dịch</a>
                		</li>
                		<li class='edit_info'>
                			<?php $url = FSRoute::_('index.php?module=users&view=users&task=edit&Itemid=45'); ?>
                			<a href="<?php echo $url; ?>" title="Sửa thông tin">Sửa thông tin</a>
                		</li>
                		<li class='logout'>
                			<?php $url = FSRoute::_('index.php?module=users&view=users&task=logout&Itemid=45'); ?>
                			<a href="<?php echo $url; ?>" title="Đăng xuất">Đăng xuất</a>
                		</li>
                		<li class='help'>
                			<?php $url = FSRoute::_('index.php?module=estores&view=products&Itemid=45'); ?>
                			<a href="<?php echo $url; ?>" title="Trợ giúp">Trợ giúp</a>
                		</li>
                		<li class=incident>
                			<?php $url = FSRoute::_('index.php?module=incident&view=incident&Itemid=45'); ?>
                			<a href="<?php echo $url; ?>" title="Báo cáo sự cố">Báo cáo sự cố</a>
                		</li>
                	</ul>
                </div>
            <?php } ?> 
           
       </div> <!-- end logs -->	
