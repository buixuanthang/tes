<?php
global $tmpl,$config; 
//$tmpl -> addScript('jquery.hoverIntent.minified','libraries/jquery/mega_menu/js');
//$tmpl -> addScript('jquery.dcmegamenu.1.3','libraries/jquery/mega_menu/js');
//$tmpl -> addStylesheet('menu','libraries/jquery/mega_menu');
global $is_mobile; 
if($is_mobile){ 
//	$tmpl -> addScript('megamenu','blocks/mainmenu/assets/js');
}

$tmpl -> addStylesheet('megamenu','blocks/mainmenu/assets/css');
$Itemid = FSInput::get('Itemid');
?>

<div class="dcjq-mega-menu" id="wrap_mainmenu_mege">
	<div class="sb-toggle-left navbar-left navbar-toggle">
		<div class="navicon-line"></div>
		<div class="navicon-line"></div>
		<div class="navicon-line"></div>
	</div>
	<ul id = 'megamenu' class="menu mypopup">
		<li class="level_0 sort home <?php echo ($Itemid=='1')?'activated':'';?>"><a  class="menu_item_a"  href="<?php $url = URL_ROOT; echo $url;?>" title="<?php echo $config['site_name']?>" rel="home" ></a> </li>

		<?php $i = 0;?>
		<?php foreach($level_0 as $item):?>
			<?php $link = FSRoute::_($item -> link); ?>
			<?php $class = 'level_0';?>
			<?php $class .= $item -> description ? ' long ': ' sort' ?>
			<?php if($arr_activated[$item->id]) $class .= ' activated ';?>
			
			<?php if($i):?><li class='menu-sepa'>&nbsp;</li><?php endif;?>
			<li class="<?php echo $class; ?>">
				<a href="<?php echo $link; ?>" id="menu_item_<?php echo $item->id;?>" class="menu_item_a _text" title="<?php echo htmlspecialchars($item -> name);?>" <?php echo $item->nofollow?'rel="nofollow"':''; ?>>
					<?php if($item -> icon){ ?>
						<span class="icon _bg2  _text_reverse <?php echo $item -> icon; ?>"></span>
					<?php } ?>
					<?php echo $item -> name;?>
				</a>
				
				<!--	LEVEL 1			-->
				<?php if(isset($children[$item -> id]) && count($children[$item -> id])  ){?>
					<span class="drop_down"></span>
					<div class='highlight'>
						<ul class='highlight1'>
				<?php }?>
				<?php if(isset($children[$item -> id]) && count($children[$item -> id])  ){?>
					<?php $j = 0;?>
					<?php foreach($children[$item -> id] as $key=>$child){?>
						<?php $link = FSRoute::_($child -> link); ?>
						
						<li class='sub-menu sub-menu-level1 <?php if($arr_activated[$child->id]) $class .= ' activated ';?> '>
							<div class="images-sub-menu1">
								<a href="<?php echo $link; ?>" class="<?php echo $class?> sub-menu-item" id="menu_item_<?php echo $child->id;?>" title="<?php echo htmlspecialchars($child -> name);?>"  <?php echo $child->nofollow?'rel="nofollow"':''; ?>>

									<?php echo $child -> name;?>
								</a>
								
							</div>
							<!--	LEVEL 2			-->
							<?php if(isset($children[$child -> id]) && count($children[$child -> id])  ){?>
								<ul class='highlight_level2'>
							<?php }?>
							<?php if(isset($children[$child -> id]) && count($children[$child -> id])  ){?>
									<?php foreach($children[$child -> id] as $child2){?>
										<?php $link = FSRoute::_($child2 -> link); ?>
										<li class='sub-menu2 <?php if($arr_activated[$child2->id]) $class .= ' activated ';?> '  <?php echo $child2->nofollow?'rel="nofollow"':''; ?>>
											<a href="<?php echo $link; ?>" class="<?php echo $class?> sub-menu-item" id="menu_item_<?php echo $child2->id;?>" title="<?php echo htmlspecialchars($child2 -> name);?>">
												<?php echo $child2 -> name;?>
											</a>
										</li>
										<div class="clear"></div>
									<?php }?>
							<?php }?>
							<?php if(isset($children[$child -> id]) && count($children[$child -> id])  ){?>
									<div class='clear'></div>
								</ul>
							<?php }?>
							<!--	end LEVEL 2			-->
							
						</li>
						<?php $j++;?>
					<?php }?>
				<?php }?>
				<?php if(isset($children[$item -> id]) && count($children[$item -> id])  ){?>
						</ul>
						<div class='menu_desc'><?php echo $item -> description; ?></div>
					</div>
				<?php }?>
				<!--	end LEVEL 1			-->
				
			</li>	
			<?php $i ++; ?>	
		<?php endforeach;?>
		<!--	CHILDREN				-->
	</ul>
</div>
<div class="clear"></div>