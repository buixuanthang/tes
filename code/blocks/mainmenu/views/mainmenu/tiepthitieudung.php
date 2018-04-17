<?php 
global $tmpl;
$tmpl -> addStylesheet('tiepthitieudung','blocks/mainmenu/assets/css');
$tmpl -> addScript('tiepthitieudung','blocks/mainmenu/assets/js');
?>


 <div class='mainmenu mainmenu-<?php echo $style; ?>'>
<?php 
$date_class = FSFactory::getClass('fsdate');
$Itemid = FSInput::get('Itemid',0,'int');
$module = FSInput::get('module');
$view = FSInput::get('view');
?>
	<ul  class=" menus_level_0">
		<?php if(isset($_COOKIE['user_id'])){?>
			<li class="item   level0 <?php echo ($module =='products' && $view == 'feed')?'activated':''?>" >
				<a href="<?php echo FSRoute::_('index.php?module=products&view=feed'); ?>"><span> New feed</span></a>
			</li>
		<?php }else{?>
			<li class="item   level0 <?php echo ($module =='products' && $view == 'feed')?'activated':''?>" >
				<a href="javascript:void(0)" onclick="javascript:call_popup_login();" ><span> New feed</span></a>
			</li>
		<?php }?>
		<?php $k  = 1; ?>
		<?php foreach($array_menu_root as $item):?>
			<?php if(!$item -> parent_id):?>
				<?php $link = FSRoute::_($item ->link);?>
				<?php
					$has_children  = 0;
					if(isset($array_menu_children[$item -> id])){
						$has_children = 1;
					}else{
						if(strpos($item -> link, 'module=products') !== false && strpos($item -> link, 'view=home') !== false){
							$has_children = 1;	
						}	
					}
				?>
				<li class='item  <?php echo $parent_active == $item -> id? 'activated':''; ?> level0 <?php echo $has_children?"has_children":"" ?>' >
					<a href='<?php echo $link; ?>' ><span> <?php echo $item -> name; ?></span></a>
					<?php if(isset($array_menu_children[$item -> id])){?>
						<?php if($k < 11){?>
						<div class=" menus_level_1 <?php echo $item -> id == $parent_active ? 'sub-activated':'sub-unactivated'?> sub_menu_order_<?php echo $k; ?>" id='menu_child_of_<?php echo $item -> id; ?>' >
							<ul class='menu_ordering_<?php echo $k; ?>'>
						<?php }else{?>
						<div class=" menus_level_1 <?php echo $item -> id == $parent_active ? 'sub-activated':'sub-unactivated'?> sub_menu_order_<?php echo $k; ?>" id='menu_child_of_<?php echo $item -> id; ?>' style="right: 0;left:auto">
							<ul  >
						<?php }?>
								<?php $i = 0;?>
								<?php foreach($array_menu_children[$item -> id] as $child):?>
										<?php $link_child = FSRoute::_($child ->link);?>
										<?php if($i):?>
											<li class='sepa' ><span></span></li>
										<?php endif;?>	
										<li class='sub-item  <?php echo $id_active == $child -> id? 'activated':''; ?> ' >
											<a href='<?php echo $link_child; ?>' ><span> <?php echo $child -> name; ?></span></a>  
										</li>
										<?php $i ++;?>
								<?php endforeach;?>
						    </ul>
					    </div>
						   <?php }else{?>
							   <?php if(strpos($item -> link, 'module=products') !== false && strpos($item -> link, 'view=home') !== false){ // loại sơ cấp ?>
							   		<div class=" menus_level_1 menu_products <?php echo $item -> id == $parent_active ? 'sub-activated':'sub-unactivated'?> sub_menu_order_<?php echo $k; ?>" id='menu_child_of_<?php echo $item -> id; ?>' >
										<ul class='menu_ordering_<?php echo $k; ?>'>
											<?php $kk = 0; ?>
									   		<?php   foreach($cats as $cat){ ?>
									   			<?php $link_child = FSRoute::_('index.php?module=products&view=cat&ccode='.$cat ->alias.'&cid='.$cat -> id);?>
												<?php if($kk):?>
													<li class='sepa' ><span></span></li>
												<?php endif;?>	
												<li class='sub-item  <?php echo $id_active == $cat -> id? 'activated':''; ?> ' >
													<a href='<?php echo $link_child; ?>' ><span> <?php echo $cat -> name; ?></span> <font><?php echo $cat -> count; ?></font></a>  
												</li>
									   			<?php $kk ++; ?>	
										   <?php }?> 
								   		</ul>
								   </div>
							   <?php }?> 
						   <?php }?> 
				</li>
			<?php endif;?>
			<?php $k ++; ?>
		<?php endforeach;?>
		<li class='sepa' ><span>&nbsp;</span></li>	
	</ul>
	 <?php if(!$parent_active){?>
	 	<ul class=" menus_level_1_null">	
	 	</ul>
	 <?php } ?>
</div>