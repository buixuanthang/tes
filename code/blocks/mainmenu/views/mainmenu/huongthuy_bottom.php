	
<!----------------------------------------------- ĐÂY LÀ DẠNG MENU CHIA CỘT ---------------------------------------------->
<?php global $tmpl;
//$tmpl -> addStylesheet('huongthuy_bottom','blocks/mainmenu/assets/css');
$cols = 0;

 	$total = count($list); 
 	$count_children = 0;
 	$summner_children = 0;
 	$html = array();
 	$html_title = array();
 	foreach ( $list as $item ) {
 		if(!$item -> parent_id){
 			$cols ++;
 			$html_title[$item ->id] = '<li class = "title_col">'.$item -> name.'</li>'; 
 		} else {
 			$link = FSRoute::_($item ->link);
 			if(!isset($html[$item -> parent_id]))
 				$html[$item -> parent_id] = '';
 			$html[$item -> parent_id] .= '<li class = "menu-item"><a href="'.$link.'" >'.$item -> name.'</a></li>';	
 		} 
 	}
 	if(!$cols)
 		return;
?>
 <div class=' mainmenu-<?php echo $style; ?> menu-<?php echo $cols;?>-cols'>
 	<?php $i = 0;?>
 	<?php foreach($html_title as $key => $html_name){?>
 		<ul class='ul_col_<?php echo $i; ?>' >
 			<?php echo $html_name.$html[$key]; ?>
 		</ul>
 		<?php $i ++; ?>
 	<?php } ?>
</div>
