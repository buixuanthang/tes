<?php 
global $tmpl;
$tmpl -> addStylesheet('phunutoday','blocks/mainmenu/assets/css');
?>
 <div class='mainmenu mainmenu-<?php echo $style; ?>'>

<?php 
$Itemid = FSInput::get('Itemid',0,'int');
?>
	<ul  class=" menus_level_0">
		<li class='item home_menu <?php echo $Itemid == 1? 'activated':''; ?>' >
			<a href='<?php echo URL_ROOT; ?>' class="a_home_menu" ><span>&nbsp;</span></a>  
		</li>
		<?php foreach($array_menu_root as $item):?>
			<?php if(!$item -> parent_id):?>
				<?php $link = FSRoute::_($item ->link);?>
				<li class='sepa' ><span>&nbsp;</span></li>	
				<li class='item  <?php echo $parent_active == $item -> id? 'activated':''; ?>' >
					<a href='<?php echo $link; ?>' ><span> <?php echo $item -> name; ?></span></a>
					<?php if(isset($array_menu_children[$item -> id]){?>
						<ul class=" menus_level_1 <?php echo $item -> id == $parent_active ? 'sub-activated':'sub-unactivated'?>" id='menu_child_of_<?php echo $item -> id; ?>'>
					  <?php foreach($array_menu_children[$item -> id] as $parent => $menu_children){?>
								
								<?php $i = 0;?>
								<?php foreach($array_menu_children[$item -> id] as $child):?>
										<?php $link_child = FSRoute::_($child ->link);?>
										<?php if($i):?>
											<li class='sepa' ><span>|</span></li>
										<?php endif;?>	
										<li class='item  <?php echo $id_active == $child -> id? 'activated':''; ?>' >
											<a href='<?php echo $link_child; ?>' ><span> <?php echo $child -> name; ?></span></a>  
										</li>
										<?php $i ++;?>
								<?php endforeach;?>
						    </ul>
						   <?php }?> 
					   <?php }?> 
				</li>
			<?php endif;?>
		<?php endforeach;?>
	</ul>
	<?php foreach($array_menu_children as $parent => $menu_children){?>
		<ul class=" menus_level_1 <?php echo $parent == $parent_active ? 'activated':'unactivated'?>" id='menu_child_of_<?php echo $parent; ?>'>	
			<?php $i = 0;?>
			<?php foreach($menu_children as $item):?>
					<?php $link = FSRoute::_($item ->link);?>
					<?php if($i):?>
						<li class='sepa' ><span>|</span></li>
					<?php endif;?>	
					<li class='item  <?php echo $id_active == $item -> id? 'activated':''; ?>' >
						<a href='<?php echo $link; ?>' ><span> <?php echo $item -> name; ?></span></a>  
					</li>
					<?php $i ++;?>
			<?php endforeach;?>
	    </ul>
	   <?php }?> 
	 <?php if(!$parent_active){?>
	 	<ul class=" menus_level_1_null">	
	 	</ul>
	 <?php } ?>
</div>