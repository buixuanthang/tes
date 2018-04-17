<?php 
    global $config,$tmpl;
    $tmpl -> addStylesheet("social_popup","blocks/log/assets/css");
    $tmpl -> addScript("social_popup","blocks/log/assets/js");
    $module =  FSInput::get('module');
    $view =  FSInput::get('view');
?>
<div class='logs <?php echo isset($_COOKIE['full_name']) ? "logged": "unlogged"; ?>'> 
            <?php if(!isset($_COOKIE['full_name'])){?>
                                
		           	<a class='login user_item' href="javascript:void(0)" onclick="open_popup_log()" >Đăng nhập</a>
		           	<span class='sepa'> /</span>
		           	<a class=' register user_item'  href="<?php echo FSRoute::_('index.php?module=users&task=login&Itemid=39');?>"  >Đăng ký</a>
		           	<span class='sepa'></span>
              		<div class='form_log hide' id='form_log_popup'>
              			<?php if($module != 'users'){?>
	              			<?php include_once 'social_popup_log.php';?>
	              		<?php }?>
	              	</div>
            <?php } else {?>
                <a class="message_no <?php echo $no_messages?'message_1':'message_0'?>" href="<?php echo FSRoute::_('index.php?module=messages&view=messages&Itemid=45');?>" title="Tin nhắn" ><span><?php echo $no_messages; ?></span></a>
                <a class="download_no  <?php echo $no_downloads?'download_1':'download_0'?>" href="<?php echo FSRoute::_('index.php?module=estores&view=system_messages&Itemid=45');?>" title="File download" ><span><?php echo $no_downloads; ?></span></a>
                <a class="hsubs" href="<?php echo FSRoute::_('index.php?module=users&view=users&task=edit&Itemid=45');?>" title="Sửa thông tin cá nhân" >
                	<?php if($user -> image){?>
                		<img alt="<?php echo $_COOKIE['full_name']; ?>" src="<?php echo URL_ROOT.str_replace('/original/', '/resized/', $user -> image); ?>" width="36" height="36"/>
                	<?php }else{ ?>
                		<img alt="<?php echo $_COOKIE['full_name']; ?>" src="<?php echo URL_ROOT.'images/no-avatar.jpg'; ?>" width="36" height="36" />
                	<?php } ?>
                </a>
                
                <a href="javascript:void(0)" id='loged_popup_title' >&nbsp;</a>
                <div class='loged_popup_content' style="display: none">
                	<ul>
                		<li class='edit_info'>
                			<?php $url = FSRoute::_('index.php?module=users&view=users&task=edit&Itemid=45'); ?>
                			<a href="<?php echo $url; ?>" title="Sửa thông tin">Hồ sơ cá nhân</a>
                		</li>
                		<li class='manage_file'>
                			<?php $url = FSRoute::_('index.php?module=users&view=personalization&Itemid=45'); ?>
                			<a href="<?php echo $url; ?>" title="Quản lý file">Cá nhân hóa</a>
                		</li>
                		<li class='statistic'>
                			<?php $url = FSRoute::_('index.php?module=estores&view=products&Itemid=45'); ?>
                			<a href="<?php echo $url; ?>" title="Thống kê giao dịch">Danh sách sản phẩm</a>
                		</li>
                		<li class='statistic'>
                			<?php $url = FSRoute::_('index.php?module=estores&view=products&Itemid=45'); ?>
                			<a href="<?php echo $url; ?>" title="Thống kê giao dịch">Lịch sử đơn hàng</a>
                		</li>
                		
                		<li class='logout'>
                			<?php $url = FSRoute::_('index.php?module=users&view=users&task=logout&Itemid=45'); ?>
                			<a href="<?php echo $url; ?>" title="Đăng xuất">Đăng xuất</a>
                		</li>
                	</ul>
                </div>
                <a class="add_product"  href="<?php echo FSRoute::_('index.php?module=estores&view=product&task=add&Itemid=45');?>" title="Đăng sản phẩm" ><span>Đăng sản phẩm</span></a>
            <?php } ?> 
           
       </div> <!-- end logs -->	
