<?php
	global $tmpl;
	$tmpl -> addStylesheet("menu_login","blocks/menu_login/assets/css");
?>
<?php $url_current = $_SERVER['REQUEST_URI'];?>
<?php $url_current = substr(URL_ROOT, 0, strlen(URL_ROOT)-1).$url_current; ?>
<div class='menu_login'>
	<?php foreach($list as $groups_name => $items_in_groups){?>
		<div class='menu_group'>
			
			<ul>
			<?php $i=0; foreach($items_in_groups as $name => $item){
			   $i++;
			   $link = $item['link'];
			   $icon = $item['icon'];
		       ?>
				<?php
					$activated = 0; 
					if($link == $url_current){
						$activated = 1;
					}	
				?>
				<li class='menu_item menu_item_0<?php echo $i;?> <?php echo $activated?"activated":""?>'>
					<a href="<?php echo $link; ?>" title="<?php echo $name?>"><i class="fa fa-<?php echo $icon; ?>" ></i><?php echo $name; ?></a>
				</li>
			<?php }?>
			</ul>
		</div>
	<?php }?>
</div>