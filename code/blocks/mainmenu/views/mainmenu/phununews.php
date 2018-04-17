<?php 
global $tmpl;
$tmpl -> addStylesheet('phununews','blocks/mainmenu/assets/css');
$tmpl -> addScript('phununews','blocks/mainmenu/assets/js','top');
?>


 <div class='mainmenu mainmenu-<?php echo $style; ?>'>
<?php 
$date_class = FSFactory::getClass('fsdate');
$Itemid = FSInput::get('Itemid',0,'int');
?>
	<ul  class=" menus_level_0">
		<li class='item home_menu <?php echo $Itemid == 1? 'activated':''; ?> level0' >
			<a href='<?php echo URL_ROOT; ?>' class="a_home_menu" ><span>Trang chủ</span></a>
		</li>
		<?php $k  = 1; ?>
		<?php foreach($array_menu_root as $item):?>
			<?php if(!$item -> parent_id):?>
				<?php $link = FSRoute::_($item ->link);?>
				<li class='sepa' ><span>&nbsp;</span></li>	
				<li class='item  <?php echo $parent_active == $item -> id? 'activated':''; ?> level0' >
					<a href='<?php echo $link; ?>' ><span> <?php echo $item -> name; ?></span></a>
					<?php if(isset($array_menu_children[$item -> id])){?>
						<?php if($k < 7){?>
						<div class=" menus_level_1 <?php echo $item -> id == $parent_active ? 'sub-activated':'sub-unactivated'?> sub_menu_order_<?php echo $k; ?>" id='menu_child_of_<?php echo $item -> id; ?>' >
							<ul class='menu_ordering_<?php echo $k; ?>'>
						<?php }else{?>
						<div class=" menus_level_1 <?php echo $item -> id == $parent_active ? 'sub-activated':'sub-unactivated'?> sub_menu_order_<?php echo $k; ?>" id='menu_child_of_<?php echo $item -> id; ?>' style="right: 0;left:auto">
							<ul  style="float: right;">
						<?php }?>
								<?php $i = 0;?>
								<?php foreach($array_menu_children[$item -> id] as $child):?>
										<?php $link_child = FSRoute::_($child ->link);?>
										<?php if($i):?>
											<li class='sepa' ><span>|</span></li>
										<?php endif;?>	
										<li class='sub-item  <?php echo $id_active == $child -> id? 'activated':''; ?> ' >
											<a href='<?php echo $link_child; ?>' ><span> <?php echo $child -> name; ?></span></a>  
										</li>
										<?php $i ++;?>
								<?php endforeach;?>
						    </ul>
					    </div>
						   <?php }?> 
				</li>
			<?php endif;?>
			<?php $k ++; ?>
		<?php endforeach;?>
	</ul>
	 <?php if(!$parent_active){?>
	 	<ul class=" menus_level_1_null">	
	 	</ul>
	 <?php } ?>
</div>