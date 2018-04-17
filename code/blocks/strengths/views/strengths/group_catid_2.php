<?php
global $tmpl,$config; 
$tmpl -> addStylesheet('group_catid_2','blocks/strengths/assets/css');
FSFactory::include_class('fsstring');
?>

<div class="strengths-product">
	<div class="title"><span><i class="icon fa fa-bookmark"></i></span>CAM KẾT CỦA CHÚNG TÔI</div>
	<div class="list">
		<ul>
			<?php foreach($list as $item){ ?>
			<li>
				<span><i class="icon fa fa-<?php echo trim($item -> icon); ?>"></i></span><span class="txt1"><?php echo $item -> title; ?></span>
			</li>
			<?php } ?>
		</ul>
	</div>
</div>