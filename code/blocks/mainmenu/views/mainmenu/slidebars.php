<?php
global $tmpl,$config; 
$tmpl -> addStylesheet('slidebars','libraries/responsive/slidebars/css');
$tmpl -> addStylesheet('slidebars-theme','libraries/responsive/slidebars/css');
$tmpl -> addScript('slidebars','libraries/responsive/slidebars/js','top');

$tmpl -> addStylesheet('slidebars','blocks/mainmenu/assets/css');
$tmpl -> addScript('slidebars','blocks/mainmenu/assets/js','top');
$Itemid = FSInput::get('Itemid');
?>
<?php
$arr_root = array();
$arr_children = array();
$current_root = 0;
foreach($list as $item){
	if($item -> level == 0){
		$arr_root[] = $item;
		$current_root = $item -> id;
	}else if($item -> level == 1){ 
		if(!isset($arr_children[$item-> parent_id]))	
			$arr_children[$item-> parent_id] = array();
		$arr_children[$item-> parent_id][] = $item;
	}else{
		$arr_children[$current_root][] = $item;
	}
}
?>
<!-- Navbar -->
<nav style="transform: translate(0px);" class="navbar navbar-default navbar-fixed-top sb-slide" role="navigation">
	
	<!-- Right Control -->
	<div class="sb-toggle-right navbar-right">
		<div class="navicon-line"></div>
		<div class="navicon-line"></div>
		<div class="navicon-line"></div>
	</div><!-- /.sb-control-right -->
	
	<div class="container">
	</div>
</nav>
		
<div class="sb-slidebar sb-right">
	<nav>
		<ul class="sb-menu">
			<li class='item home_menu_mobile <?php echo $Itemid == 1? 'activated':''; ?>' >
				<a href='<?php echo URL_ROOT; ?>' class="a_home_menu" ><span>Trang chủ</span></a>
			</li>
		
		<?php $url = $_SERVER['REQUEST_URI'];?>
    		<?php $url = substr($url,strlen(URL_ROOT_REDUCE));?>
    		<?php $url = URL_ROOT.$url; ?>
    		<?php if(isset($list) && !empty($list)){?>
		
				<?php foreach($arr_root as $item){
				$sb_caret = "";
				$class='';
				if($item->children > 0){
					$link = '#'; 
	    				$sb_caret .= '<span class="sb-caret"></span>';
					$class='sb-toggle-submenu';
				}else{ 
					$link = FSRoute::_($item->link);
				 } ?>
	    			<?php if($url == $link) $class .= 'activated';?>
			        	<li>
			                <a class="<?php echo $class;?>" href="<?php echo $link;?>"  title="<?php echo $item->name;?>"><?php echo $item->name;?><?php echo $sb_caret;?></a>
			         		   <ul class='sb-submenu' >
				                		<?php foreach($arr_children[$item -> id] as $child){?>
				                			<li>
				                				<?php $link_child = FSRoute::_($child->link);?>
				                				<a href="<?php echo $link_child;?>" title="<?php echo $child->name;?>"><?php echo $child->treename;?></a>
				                			</li>
				                		<?php }?>
				                </ul>
			            </li>
			     <?php } // end foreach($list as $item)?>
		     <?php }  // end if(isset($list) && !empty($list))?>
		</ul>
	</nav>
</div><!-- /.sb-left -->
