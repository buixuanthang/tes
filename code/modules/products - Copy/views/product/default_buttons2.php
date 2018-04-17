<div class='product_button2'>
	<figure>
	<img src="<?php echo URL_ROOT.str_replace('/original/', '/resized/', $data -> image); ?>" alt="<?php echo $data -> name; ?>" />
	</figure>
	<div class="product_button2_info">
		<h3><?php echo $data -> name; ?></h3>
		<div class='price_current' id="price_2" >
			<?php echo format_money($data -> price) ; ?>
		</div>
	</div>	
	
	<div class="button2_wrap">
	 <a  rel="nofollow"  id="buy-now-2"  href="javascript: void()" class="btn-buy fl"  onclick="add_fb_cart()">
		<span>Đặt hàng ngay</span>
		<font>(Giao hàng tận nơi miễn phí)</font>
	</a>
	<a   rel="nofollow"  href="<?php echo FSRoute::_('index.php?module=products&view=instalment&id='.$data -> id); ?>"  class="btn-tragop fr" data-toggle="modal">
		<span>Trả góp lãi suất 0%</span>
		<font>(Xét duyệt qua điện thoại)</font>
	</a>
	</div>
	<div class="clear"></div>
	
</div>