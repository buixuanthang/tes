<ul class="manufactories scroll_bar">

	<?php 

	$filter_in_table_name = isset($arr_filter_manufacrories[$cat -> tablename])?$arr_filter_manufacrories[$cat -> tablename]:array();


	if(count($filter_in_table_name)){
		$j = 0;
		
		foreach($filter_in_table_name as  $filter){
			if(!isset($manufactories[$filter -> filter_value]))
				continue;
			
			$str_filter_id = $filter -> alias;
			// echo $filter -> filter_value;
			$manf = $manufactories[$filter -> filter_value];
			$link = FSRoute::_('index.php?module=products&view=cat&cid='.$cat->id.'&ccode='.$cat->alias.'&filter='.$str_filter_id);

			if($j > 15)
				break;
?>
			<li class="manu" >
				<a title="<?php echo $manf -> name; ?>"  href="<?php echo $link; ?>"  >
					<img src="<?php echo str_replace('/original/', '/small/', $manf->image); ?>" />
				</a>
			</li>
<?php
			}
			
		
	}

	?>
		
</ul>