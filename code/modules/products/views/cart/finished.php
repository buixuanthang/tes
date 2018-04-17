<?php 
global $tmpl;
$tmpl -> addTitle('Kết thúc đơn hàng');
$tmpl -> addStylesheet('cart','modules/products/assets/css');
$eid = FSInput::get('eid',0,'int');
$Itemid = FSInput::get('Itemid');
FSFactory::include_class ( 'json' );
	$jSon = new Services_JSON();
?>
<div id="products-cart">
		<h1 class="page_title"><span>Chi tiết đơn hàng</span></h1>
		
		<div class="tab-info-oder">
			<span>Mã đơn hàng : </span>DH<?php echo str_pad($order -> id, 8 , "0", STR_PAD_LEFT);?>
		</div>
		
		<div class="frame-large-body">
		    <table width="100%">
		        <tr>
		            <th width="4.3%" height="35">STT</th>
					<th width="56.7%">Tên sản phẩm</th>
					<th width="13.2%">Giá sản phẩm</th>
					<th width="8%">Số lượng</th>
		            <th width="13.2%">Tổng</th>
				</tr>	
				 <?php
				  $i = 0; 
				  $total = 0;
				  $quantity = 0;
				  $total_discount = 0;
			  		foreach ($order_detail as $item) {
				  		$i++;
				  		$total += $item -> total;
				  		$quantity += $item -> count;
				  		$product = @$products[$item -> product_id];
				  		$link_detail_product =FSRoute::_('index.php?module=products&view=product&code='.$product->alias.'&id='.$product -> id.'&ccode='.$product -> category_alias.'&Itemid=6');
					  	 
				?>	
								  
				<tr>
                    <td style="text-align: center;"><?php echo $i ?></td>
    				<td style="text-align: left;">
    					<div class="title-img">
    						<a href="<?php echo $link_detail_product; ?>" > 
								 <?php if($product -> image){ ?>
		                        	<?php $image_small = URL_ROOT.str_replace('/original/', '/resized/', $product->image); ?>
		                        	<img width="80" height="100" src="<?php echo $image_small; ?>" alt="<?php echo htmlspecialchars ($product -> name); ?>"  />
		                        <?php } else {?>
		                            <img  width="80" height="100" src="<?php echo URL_ROOT.'images/no-img.gif'; ?>" alt="<?php echo htmlspecialchars ($product -> name); ?>" />
		                        <?php }?>
							</a> 
    					</div>
    					<div class="title-name">
    						<h2 class="name"><a class="name-product"  title='' href='<?php echo $link_detail_product; ?>' ><?php  echo @$product -> name;  ?></a></h2>
    						<p>Mã sản phẩm: <span><?php echo $product->code; ?></span><p>
    					</div>
    				</td>
    				<td style="text-align: center;">
    					<div class="price"><?php echo format_money($item -> price,'VNĐ'); ?></div>
		            </td>
    				<td style="text-align: center;"><?php echo $item -> count; ?></td>
                    <td style="text-align: center;"><div class="price"><?php echo format_money($item -> total,'VNĐ'); ?></div></td>
                    <?php }?>
                    
			</table>
			<div class="frame-large-body-mobile">
				<?php include_once 'finished_mobile.php'; ?>
			</div>
	        <div class="bottom">
            	<p>Tổng tiền: <span><?php echo format_money($total,'VNĐ'); ?></span></p>
            	<div class="clear"></div>
            </div>
			<div class='clear'></div>
		</div>
				
				
		<div class='clear'></div>
		<div class="products-cart-info">
			<h3 class="title">Thông tin đặt hàng</h3>
			<div class='shopping_buyer_saller'>
				<table class="info-customer-gh" width="100%">
					<div class="form-item form-item-customer">
						<h4 class="title-steps">I.Thông tin khách hàng</h4>
						<div class="tabl-info-customer">
							<div class="customer-item">
								<div class='lable'><span>T&#234;n ng&#432;&#7901;i &#273;&#7863;t h&#224;ng</span></div>
								<div class='value'><?php echo $order-> sender_name; ?></div>
								<div class="clear"></div>
							</div>
							<div class="customer-item">
								<div class='lable'><span>Gi&#7899;i t&#237;nh</span></div>
								<div class='value'><?php echo ($order->sender_sex == 'female')? "N&#7919;":"Nam"; ?></div>
								<div class="clear"></div>
							</div>
							<div class="customer-item">
								<div class='lable'><span>&#272;&#7883;a ch&#7881;</span></div>
								<div class='value'><?php echo $order-> sender_address; ?></div>
								<div class="clear"></div>
							</div>
							<div class="customer-item">
								<div class='lable'><span>Email</span></div>
								<div class='value'><?php echo $order-> sender_email; ?></div>
								<div class="clear"></div>
							</div>
							<div class="customer-item">
								<div class='lable'><span>&#272;i&#7879;n tho&#7841;i</span></div>
								<div class='value'><?php echo $order-> sender_telephone; ?></div>
								<div class="clear"></div>
							</div>
						</div>
						<div class="clear"></div>
					</div>
					<div class="form-item form-item-pay">
						<h4 class="title-steps">II.Hình thức thanh toán</h4>
						<div class="item-pay">
							<?php $arr_payment = array(1=>'Trả bằng tiền mặt khi nhận hàng',2=>'Trả bằng thẻ ATM, Visa, Master khi nhận hàng',3=>'Thanh toán trực tuyến (ATM, Visa, Master)'); ?>
							<?php echo @$arr_payment[@$order -> payment_method]; ?>
						</div>
					</div>
					
					<div class="form-item form-item-order">
						<h4 class="title-steps">II.Hình thức nhận</h4>
						<div class="item-pay">
							<?php $arr_received = array(1=>'Tại nhà',2=>'Tại cửa hàng'); ?>
							<?php echo @$arr_received[@$order -> received_method]; ?>
						</div>
					</div>
				</table>
			</div>
			<div class="clear"></div>
		</div>
	<div class="clear"></div>
</div>

