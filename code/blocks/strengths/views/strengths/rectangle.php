<?php
global $tmpl,$config; 
	$tmpl -> addStylesheet('retangle','blocks/strengths/assets/css');
	FSFactory::include_class('fsstring');
	?>
<div class='strengths_retangle_block cls'>

<?php foreach($list as $item){ ?>
	<div class="item _bg_opacity _bg1_hover">
		<div class="item-inner">
			<div class="item-l _bg">
				<i class="fa fa-<?php echo trim($item -> icon); ?>"></i>
			</div>
			<div class="item-r">
				<strong class="name">
					<?php echo $item -> title; ?>
				</strong>
				<span class="sumamry">
					<?php echo $item -> summary; ?>
				</span>
			</div>
		</div>
	</div>
	<div class="item_break"></div>
<?php } ?>
       
 </div>

