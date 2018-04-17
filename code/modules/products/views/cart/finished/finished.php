<?php 
global $tmpl;
$tmpl -> addTitle(FSText::_('Kết thúc đơn hàng'));
$tmpl -> addStylesheet('cart','modules/products/assets/css');
$eid = FSInput::get('eid',0,'int');
$Itemid = FSInput::get('Itemid');
//FSFactory::include_class ( 'json' );
//	$jSon = new Services_JSON();
?>
<h1 class="page_title"><span><?php echo FSText::_('Chi tiết đơn hàng'); ?></span></h1>
<div id="products-cart">
		
		
		<div class="tab-info-oder">
			<span><?php echo FSText::_('Mã đơn hàng'); ?> : </span>DH<?php echo str_pad($order -> id, 8 , "0", STR_PAD_LEFT);?>
		</div>
		
		<?php 	include_once 'items.php'; ?>
		<?php include_once 'buyer_info.php'; ?>
				
				
		
	<div class="clear"></div>
</div>

