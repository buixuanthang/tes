<?php 
global $tmpl;
$tmpl -> addStylesheet('jellyfish','blocks/mainmenu/assets/css');
$tmpl -> addStylesheet('menu-header-socap','blocks/mainmenu/assets/css');
$tmpl -> addScript('jellyfish','blocks/mainmenu/assets/js','top');
?>

 <div id="myNavbar" class="mainmenu mainmenu-<?php echo $style; ?>  ">
<?php 
$date_class = FSFactory::getClass('fsdate');
$Itemid = FSInput::get('Itemid',0,'int');

?>
     
	<ul  class=" menus_level_0">
            <li class='item level0 home-menu first_item <?php echo $Itemid == 1? 'activated':''; ?>' ><a href='<?php echo URL_ROOT; ?>' ></a>  </li>
		<?php $k  = 1; ?>
		<?php foreach($array_menu_root as $item):?>
			<?php if(!$item -> parent_id):?>
				<?php $link = FSRoute::_($item ->link);?>

					<?php if(isset($array_menu_children[$item -> id])){?>
					<li class='item  <?php echo $parent_active == $item -> id? 'activated':''; ?> level0 <?php echo count(@$array_menu_children[$item -> id])?"has_children":"" ?> ' style='<?php echo (($k < 6) && isset($array_menu_children[$item -> id]))?"position: relative;":""; ?>'  >
						<a href='<?php echo $link; ?>' ><span> <?php echo $item -> name; ?></span></a>
					
						<?php if($k < 6){?>
						<div class=" menus_level_1 <?php echo $item -> id == $parent_active ? 'sub-activated':'sub-unactivated'?> <?php echo in_array($item -> id, $array_menu_have_child_level_3) ? 'has_child_level_3':'has_child_level_2'?>  sub_menu_order_<?php echo $k; ?>" id='menu_child_of_<?php echo $item -> id; ?>'  >
							<ul class='menu_ordering_<?php echo $k; ?>' >
						<?php }else{?>
						<div class=" menus_level_1 <?php echo $item -> id == $parent_active ? 'sub-activated':'sub-unactivated'?> sub_menu_order_<?php echo $k; ?>  <?php echo in_array($item -> id, $array_menu_have_child_level_3) ? 'has_child_level_3':'has_child_level_2'?>" id='menu_child_of_<?php echo $item -> id; ?>  ' >
							<ul  >
						<?php }?>
								<?php $i = 0;?>
								<?php foreach($array_menu_children[$item -> id] as $child):?>
										<?php $link_child = FSRoute::_($child ->link);?>
										
										<?php if(isset($array_menu_children[$child -> id] )){ // nếu có cấp con lập tức set ngang ?>
											<div class='unit_menus_level_1'>
										<?php }?>
										
										<li class='sub-item sub-item-level<?php echo $i; ?> <?php echo count(@$array_menu_children[$child -> id])?"sub-item-level1-has-children":"" ?>  <?php echo $id_active == $child -> id? 'activated':''; ?> ' >
											<a href='<?php echo $link_child; ?>' ><span> <?php echo $child -> name; ?></span></a>  
										</li>
											
											<!-- Menu cấp 3 -->
											<?php if(isset($array_menu_children[$child -> id] )){?>
												<?php foreach($array_menu_children[$child -> id] as $child2):?>
													<?php $link_child = FSRoute::_($child2 ->link);?>
													<li class='sub-item sub-item-level2   <?php echo $id_active == $child2 -> id? 'activated':''; ?> ' >
														<a href='<?php echo $link_child; ?>' ><span> <?php echo $child2 -> name; ?></span></a>  
													</li>
												<?php endforeach;?>	
											<?php }?>	
											<!-- end Menu cấp 3 -->
											
										<?php if(isset($array_menu_children[$child -> id] )){ // nếu có cấp con lập tức set ngang ?>
											</div>
										<?php }?>
										
										<?php $i ++;?>
								<?php endforeach;?>
						    </ul>
					    </div>
						   <?php } else { // những loại dị sẽ được bổ sung ở đây?>
						   <li class='item  <?php echo $parent_active == $item -> id? 'activated':''; ?> level0 <?php echo (strpos($item -> link, 'module=primary') !== false)?"has_children":"" ?> '  >
							<a href='<?php echo $link; ?>' ><span> <?php echo $item -> name; ?></span></a>
						
						   		<?php if(strpos($item -> link, 'module=primary') !== false){ // loại sơ cấp?>
						   		<div class=" menus_level_1 <?php echo $item -> id == $parent_active ? 'sub-activated':'sub-unactivated'?> sub_menu_order_<?php echo $k; ?>" id='menu_child_of_<?php echo $item -> id; ?> '   >
									<ul class='menu_ordering_<?php echo $k; ?>'>
							   		
						   			<?php if(strpos($item -> link, 'level=so-cap-b') !== false){ // loại sơ cấp B?>
						   				<?php $level = 2;?>
						   				<?php $level_alias = 'so-cap-b';?>
						   			<?php }else{// loại sơ cấp A?>
							   			<?php $level = 1;?>
							   			<?php $level_alias = 'so-cap-a';?>
						   			<?php }?>
						   				<?php $lessons = $model -> get_lessons($level); ?>
						   				<?php $lengh = 5; ?>
						   				<div class='menu-unit-top'>
						   					<div class='unit_menus_level_1'>
						   					<?php $ii = 1; ?>
						   					<?php 
						   						$module = FSInput::get('module');
						   						$type = 'tu-vung';
						   						if($module == 'primary'){
						   							$type_input = FSInput::get('type');
						   							if($type_input == 'tu-vung')
						   								$type = 'tu-vung';				
						   						}	
						   					?>
						   					<?php $module = FSInput::get('module');?>
							   				<?php foreach($lessons as $lesson){?>
							   					<?php if(($ii-1) % $lengh == 0 && $ii>3){?>
							   						</div> <!-- .unit_menus_level_1 -->
							   						<div class='unit_menus_level_1 '>
							   					<?php }?>
							   					
							   					<li class='sub-item sub-item-level1  <?php echo $id_active == 1? 'activated':''; ?> ' >
													<a href='<?php echo FSRoute::_('index.php?module=primary&view=lesson&type='.$type.'&id='.$lesson -> id.'&code='.$lesson -> alias); ?>' >
														<span> <?php echo $lesson -> name; ?></span>
													</a>  
												</li>
												<?php $ii++;?>
							   				<?php }?>
							   				</div><!-- .unit_menus_level_1 -->
							   			</div><!-- .menu-unit-top -->
							   			<div class='menu-unit-bottom'>
							   				<div class="wrapper-row">
                                                 <a href="<?php echo FSRoute::_('index.php?module=primary&view=home&level='.$level_alias.'&type=tu-vung'); ?>" title="Từ vựng" class="sub-row" id="grammar"><img src="<?php echo URL_ROOT.'blocks/mainmenu/assets/images/grammar.png'; ?>" alt="Từ vựng"><span class="text-subrow">Từ vựng</span></a>
                                                <a href="<?php echo FSRoute::_('index.php?module=primary&view=home&level='.$level_alias.'&type=ngu-phap'); ?>" title="Ngữ pháp" class=" sub-row" id="vacabulary"><img src="<?php echo URL_ROOT.'blocks/mainmenu/assets/images/vacabulary.png'; ?>" alt="Ngữ pháp"><span class="text-subrow">Ngữ pháp</span></a>
                                                <a href="<?php echo FSRoute::_('index.php?module=primary&view=home&level='.$level_alias.'&type=luyen-tap'); ?>" title="Luyện tập" class="sub-row" id="practice"><img src="<?php echo URL_ROOT.'blocks/mainmenu/assets/images/practice.png'; ?>" alt="Luyện tập"><span class="text-subrow">Luyện tập</span></a>
                                                <a href="<?php echo FSRoute::_('index.php?module=primary&view=home&level='.$level_alias.'&type=hoi-thoai'); ?>" title="Hội thoại" class="sub-row" id="conversation"><img src="<?php echo URL_ROOT.'blocks/mainmenu/assets/images/conversation.png'; ?>" alt="Hội thoại"><span class="text-subrow">Hội thoại</span></a>
                                            </div>
							   			</div><!-- .menu-unit-bottom -->
							   			
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