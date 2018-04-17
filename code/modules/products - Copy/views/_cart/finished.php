<?php 
$total = 0;
$quantity = 0;
if( count($order_detail) ){ 
	foreach ($order_detail as $item) {
		$i++;
		$total += $item -> total;
		$quantity += $item -> count;
?>
		<script>
		var product_id = '<?php echo $item ->product_id; ?>';
		var product_price = <?php echo $item -> price; ?>;
		var check_fb_purchase = 1;
		</script>
	<?php break; ?>
<?php 
	} 
}
?>

<?php 
global $tmpl;
$tmpl -> addTitle('Kết thúc đơn hàng');
$tmpl -> addStylesheet('cart','modules/products/assets/css');
$tmpl -> addScript('cart_finished','modules/products/assets/js');
$eid = FSInput::get('eid',0,'int');
$Itemid = FSInput::get('Itemid');
?>
<div class='product_cart mt20'>
	<div class="detail_inner">
		<!--	FIRST INFO				-->
		<table cellspacing="0" cellpadding="7" border="1" bordercolor="#EEE" width="100%" class="tab-info-oder mt10">
			<tbody> 
				<tr>
					<td width="173px" class="th_text"><b>T&#234;n ng&#432;&#7901;i &#273;&#7863;t h&#224;ng </b></td>
					<td>DH<?php echo str_pad($order -> id, 8 , "0", STR_PAD_LEFT);?></td>
				</tr>
				<tr>
					<td width="173px" class="th_text"><b>Nhật ký lịch sử</b></td>
					<td>Đơn hàng đã được gửi cho ban quản trị.Chúng tôi sẽ xử lý trong thời gian ngắn nhất</td>
				</tr>
			</tbody>
				
		</table>
		<!--	ORDER INFO				-->
		<table cellspacing="0" cellpadding="7" border="1" bordercolor="#EEE" width="100%" class="tabl-info-customer mt10">
			<tbody> 
			  <tr>
				<td colspan="2" class="th_text"><b class="send_info_label">Th&#244;ng tin ng&#432;&#7901;i &#273;&#7863;t h&#224;ng</b></td>
			  </tr>
			  <tr>
				<td width="173px"><b>T&#234;n ng&#432;&#7901;i &#273;&#7863;t h&#224;ng </b></td>
				<td><?php echo $order-> sender_name; ?></td>
			  </tr>
			 <!--  <tr>
				<td><b>Gi&#7899;i t&#237;nh </b></td>
				<td><?php //echo ($order->sender_sex == 'female')? "N&#7919;":"Nam"; ?>
				</td>
			  </tr> -->
			  <tr>
				<td><b>&#272;&#7883;a ch&#7881;  </b></td>
				<td><?php echo $order-> sender_address; ?></td>
			  </tr>
			  <tr>
				<td><b>Email </b></td>
				<td><?php echo $order-> sender_email; ?></td>
			  </tr>
			  <tr>
				<td><b>&#272;i&#7879;n tho&#7841;i </b></td>
				<td><?php echo $order-> sender_telephone; ?></td>
			  </tr>
			 </tbody>
		</table>
		<!--  end SENDER INFO -->
		<?php 

		?>		

		<!--	ORDER DETAIL				-->
			<table width="100%" cellpadding="4" cellpadding="7" border="1" bordercolor="#EEE" class="table-product-pack mt10">
				<thead>
				  <tr class="head-tr">
					<th class="th-column" width="">&nbsp;</th>
					<th class="th-column" width="30%">&nbsp;</th>
					<th class="th-column" width="20%">Giá</th>
					<th class="th-column" width="10%">Số lượng</th>
					<th class="th-column" width="18%">Thành tiền</th>
				  </tr>
				</thead>
				<tbody>
				
				<!--  Product list -->
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
						<td  align="center">
							
							<a href="<?php echo $link_detail_product; ?>" > 
								 <?php if($product -> image){ ?>
		                        	<?php $image_small = URL_ROOT.str_replace('/original/', '/resized/', $product->image); ?>
		                        	<img src="<?php echo $image_small; ?>" alt="<?php echo htmlspecialchars ($product -> name); ?>"  />
		                        <?php } else {?>
		                            <img   src="<?php echo URL_ROOT.'images/no-img.gif'; ?>" alt="<?php echo htmlspecialchars ($product -> name); ?>" />
		                        <?php }?>
							</a> 
						</td>
						<td align="center">
							<p><a class="name-product"  title='' href='<?php echo $link_detail_product; ?>' ><?php  echo @$product -> name;  ?></a></p>
							<?php 
								if (!empty($item->memory_id))
									echo '<div>Bộ nhớ:'.$item->memory_name.'<font color="red"> ('.format_money($item ->memory_price).')</font></div>';
								if (!empty($item->color_id) && !empty($item->color_name))
									echo '<div>Màu sắc : Màu '.$item->color_name.'<font color="red"> ('.format_money($item ->color_price).')</font></div>';
								if (!empty($item->warranty_id))
									echo '<div>Bảo hành :'.$item->warranty_name.'<font color="red"> ('.format_money($item ->warranty_price).')</font></div>';
								if (!empty($item->origin_id))
									echo '<div>Xuất xứ :'.$item->origin_name.'<font color="red"> ('.format_money($item ->origin_price).')</font></div>';
								if (!empty($item->species_id))
									echo '<div>RAM:'.$item->species_name.'<font color="red"> ('.format_money($item ->species_price).')</font></div>';
								if (!empty($item->usage_states_id))
									echo '<div>Bộ nhớ:'.$item->usage_states_name.'<font color="red"> ('.format_money($item ->usage_states_price).')</font></div>';
							?> 
							
						</td>
						<td class="price-product" align="center">
							<div class="price"><?php echo format_money($item -> price); ?></div>
						</td>
						<td class="warranty-product" align="center">
							<?php echo $item -> count; ?>
						</td>
						<td class="total-price" align="center">
							<div class="price"><?php echo format_money($item -> total); ?></div>
						</td>
				  </tr>
							  
				 <?php 
			  	}
			  	?>		  
			</table>
			<div class="total-price pull-right" align="right" >Thành tiền (VNĐ): <span><?php echo format_money($total);?></span></div>	
			<div class="clearfix"></div>	
			<!--	end PRODUCT LIST				-->
		<!--	end ORDER DETAIL				-->
	</div>
</div>

<?php include 'default_remarketing.php';?>