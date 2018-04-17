<ul class="nav nav-tabs pull-left">
	

<?php

$filter_in_table_name = isset($arr_filter_by_field[$cat -> tablename])?$arr_filter_by_field[$cat -> tablename]:array();
if(count($filter_in_table_name)){
	$j = 0;
	
	foreach($filter_in_table_name as $field_name => $filters_in_field){
			
		
		foreach($filters_in_field as $filter){
			if($j > 5)
			break;

			
			$str_filter_id = $filter -> alias;
			$link = FSRoute::_('index.php?module=products&view=cat&cid='.$cat->id.'&ccode='.$cat->alias.'&filter='.$str_filter_id);
			// $link_cat = FSRoute::_('index.php?module=products&view=cat&cid='.$item->id.'&ccode='.$item->alias.'&Itemid='.$Itemid);
			
				echo '<li><a href="'.$link.'" title="'.$filter ->filter_show.'" >'.$filter ->filter_show.'</a></li>';
			$j++;

			
		}
		
	}
}
?>
	<li class="read_more"><a  href="<?php echo $link_cat; ?>">Xem đầy đủ</a></li>
</ul>