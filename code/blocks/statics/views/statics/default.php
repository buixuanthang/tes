<?php 
    global $config, $tmpl;
    $tmpl -> addStylesheet("default","blocks/statics/assets/css");
?>

<ul class="block_content">
	<li class="clearfix">
		<div class="img">
			<img alt="" src="/upload_images/images/01_Home_V1.png" >
		</div>
		<div class="ct">
			<b><?php echo FSText::_('100% Organic Foods');?></b>
			<span><?php echo FSText::_('All of our products are organic foods that are good for the health of consumers.');?></span>
		</div>
	</li>
	<li class="clearfix">
		<div class="img">
			<img alt="" src="/upload_images/images/cup.png" >
		</div>
		<div class="ct">
			<b><?php echo FSText::_('Certified Farmers');?></b>
			<span><?php echo FSText::_('All products are certified by competent authorities in the field of food safety.');?></span>
		</div>
	</li>
	<li class="clearfix">
		<div class="img">
			<img alt="" src="/upload_images/images/thich.png">
		</div>
		<div class="ct">
			<b><?php echo FSText::_('Serve enthusiastic service');?></b>
			<span><?php echo FSText::_('All of our products are healthy organic food for good health.');?></span>
		</div>
	</li>
	<li class="clearfix">
		<div class="img">
			<img alt="" src="/upload_images/images/cuoi.png">
		</div>
		<div class="ct">
			<b><?php echo FSText::_('Greater privileiting programs');?></b>
			<span><?php echo FSText::_('We regularly have large incentive programs for patrons, many incentives for longtime members.');?></span>
		</div>
	</li>
</ul>