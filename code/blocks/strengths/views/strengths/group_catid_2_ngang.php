<?php
global $tmpl,$config; 
$tmpl -> addStylesheet('group_catid_2_ngang','blocks/strengths/assets/css');
FSFactory::include_class('fsstring');
?>

<div class="strengths-product">
	<div class="title">CAM KẾT CỦA THỢ SỬA DI ĐỘNG</div>
	<div class="list">
		<ul>
			<?php foreach($list as $item){ ?>
			<li>
				<div class="icons"><i class="icon fa fa-<?php echo trim($item -> icon); ?>"></i></div>
				<div class="content">
					<p class="title_str"><?php echo $item -> title; ?></p>
					<p class="summary_str"><?php echo getWord(20,$item -> summary); ?></p>
				</div>
				
			</li>
			<?php } ?>
		</ul>
	</div>
</div>