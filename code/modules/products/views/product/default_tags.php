<!--	RELATE TAGS		-->
<?php 
echo '<div class="product_tags">';
if($data -> tags){
	$arr_tags = explode(',',$data -> tags);
	$total_tags = count($arr_tags);
	if($total_tags){
		echo '<font>Tags: </font>';
		echo '<span>';
		for($i = 0; $i < $total_tags; $i ++){
			$item = trim($arr_tags[$i]);
			if($item){
//				$link = FSRoute::_("index.php?&module=products&view=search&keyword=".$item."&Itemid=9");
				$item_e = str_replace(' ', '+', $item);
			//	$item_e = urlencode($item_e);
				$link = FSRoute::_("index.php?&module=products&view=search&keyword=".$item_e."&Itemid=9");
//				$link = URL_ROOT.'tim-kiem/tat-ca/'.$item_e.'.html';
				if($i > 0)
				echo ', <a href="'.$link.'" title="'.$item .'">'.$item.'</a>';
				else{
				echo '<a href="'.$link.'" title="'.$item .'">'.$item.'</a>';
				}
			}
		}
		echo '</span>';
		echo '<div class="clear"></div>';
		
	}
}
echo '</div>';
?>