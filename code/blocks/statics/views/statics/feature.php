<?php 
    global $config, $tmpl;
    $tmpl -> addStylesheet("feature","blocks/statics/assets/css");
?>

<div class="block_content">
  <div class="block_content_inner">
  		<div class="img  animate scale come-in">
  			<img alt="" src="<?php echo URL_ROOT.'images/config/logo_white.png' ?>" >
  		</div>
  		<div class="text"><?php echo FSText::_('Orfarm sở hữu chuỗi cung ứng khép kín, ứng dụng công nghệ khoa học tiên tiến, tiêu chuẩn Nhật Bản');?></div>
  		<div >
  			<a class="btn" href="<?php echo $config['link_chung_chi'] ?>" ><?php echo FSText::_('GIẤY CHỨNG NHẬN');?></a>
  		</div>
  </div>
</div>