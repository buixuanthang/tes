<?php 
 global $tmpl;
 $tmpl -> addStylesheet('discount','blocks/discount/assets/css');
 ?>
<div class='block_content discount_content'>
	<div class='discount_title'><?php echo FSText::_('Đăng ký nhận bản tin');?></div>
	<form id="discount_form" method="post" name="newletter_form" action="<?php echo FSRoute::_('index.php?module=discount&task=save'); ?>" onsubmit="javascript: return check_discount_form();" >
	    <input type="text" name="email" id="dc_email" placeholder="Nhập email..." class="txt-input"  />
	    <input type="submit" name="submit" value="<?php echo FSText::_('Đăng ký')?>" class="button-sub button" />
	    <input type="hidden" name='return' value="<?php echo base64_encode($_SERVER['REQUEST_URI']);?>"  />
	</form>
</div>