<?php 
global $tmpl;
// $tmpl -> addStylesheet('products');
$tmpl -> addStylesheet('thosuadidong','modules/home/assets/css');
// $tmpl -> addScript('home','modules/home/assets/js');
$Itemid = 30;
$Itemid_detail = 31;
$cols = 4;
FSFactory::include_class('fsstring');

?>
<div class="list-pro">
	<div class="title">
		<span><i class="fa fal fa-cog"></i>Dịch vụ nổi bật</span>
	</div>


<?php 

	$catLimit= $array_cats[0];
	$Itemid_cat = 34;
	$link_cat = FSRoute::_("index.php?module=products&view=cat&ccode=".$catLimit -> alias."&cid=".$catLimit->id."&Itemid=".$Itemid_cat);


	$proLimit = $array_products[$catLimit->id];
	for($j = 0 ; $j < count($proLimit); $j ++)
	{
		if($j > 1)
			break;
		$item = $proLimit[$j];
		$link_buy = FSRoute::_("index.php?module=products&view=cart&task=buy&id=".$item->id."&Itemid=94");
		$Itemid = 35;
		$link = FSRoute::_('index.php?module=products&view=product&code='.$item -> alias.'&ccode='.$item->category_alias.'&id='.$item->id.'&cid='.$item->category_id.'&Itemid='.$Itemid);
		$manufactories = $array_manf[$catLimit->id];
		?>

		<?php include 'default_items_limit.php';?>

	<?php } ?>

<div class="clear"></div>


<?php $i  = 0;?> 
<?php

for($i = 0 ; $i < count( $array_cats) ; $i ++)
{
	$cat = $array_cats[$i];
	$Itemid_cat = 34;
	$link_cat = FSRoute::_("index.php?module=products&view=cat&ccode=".$cat -> alias."&cid=".$cat->id."&Itemid=".$Itemid_cat);
	$manufactories = $array_manf[$cat->id];
	?>
	<?php include 'default_items.php';?>

<?php 	} ?>


</div>


