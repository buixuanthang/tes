<?php 
global $tmpl;
$tmpl -> addTitle(FSText::_('Thanh toán đơn hàng'));
$tmpl -> addStylesheet('cart','modules/products/assets/css');
$tmpl -> addScript('form');
$tmpl -> addScript('eshopcart2_simple','modules/products/assets/js');
$Itemid = FSInput::get('Itemid');

?>
<div class="product_cart mt20">
	<h1 class="page_title"><span><?php echo FSText::_('Đơn hàng'); ?></span></h1>
	<div class="detail_inner">
		<?php
		if(isset($_SESSION['cart'])) {
			$product_list = $_SESSION['cart'];
			if(count($product_list)){
				include_once 'items.php';
		?>
				<form action="#" name="eshopcart_info" method="post" id="eshopcart_info" >
		<?php 			
//							include_once 'discount.php';
//							include_once 'payments.php';
							include_once 'buyer_info.php';
					}	
				?>
				</form>
		<?php 	
		} else {
			echo '<p>'.FSText::_('Giỏ hàng đang chưa có sản phẩm nào').'</p>';
			//echo '<a href="'.FSRoute::_('index.php?module=products&view=home').'">'.FSText::_('Hãy click').' <strong>'.FSText::_('vào đây').'</strong> '.FSText::_('để lựa chọn sản phẩm').'</a><br/><br/>';
			echo '<a href="'.URL_ROOT.'">'.FSText::_('Hãy click').' <strong>'.FSText::_('vào đây').'</strong> '.FSText::_('để quay lại trang chủ').'</a><br/><br/>';
		}
			?>
		<!--	Product list and price			-->
	</div>
</div>