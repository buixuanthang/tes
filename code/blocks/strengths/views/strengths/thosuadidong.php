<?php
global $tmpl,$config; 
	$tmpl -> addStylesheet('thosuadidong','blocks/strengths/assets/css');
	FSFactory::include_class('fsstring');
	?>


<ul id="main_strengths">
	<?php foreach($list as $item){ ?>
	<li>
		<i class="fa fa-<?php echo trim($item -> icon); ?>"></i>
		<p class="text-icon"><?php echo $item -> title; ?></p>
	</li>
	<?php } ?>
	<li>
		<i class="fa fa-phone"></i>
		<p class="text-icon">Tổng đài hỗ trợ</p>
		<p class="text-icon" style="font-family: RobotoBold" ><?php echo $config['hotline1'];?></p>
	</li>
</ul>
