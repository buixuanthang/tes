<?php 
$sender_name = isset($user -> full_name) ? $user -> full_name :'';
$sender_telephone = isset($user -> mobilephone) ? $user -> mobilephone :'';
$sender_address = isset($user -> address) ? $user -> address :'';
$sender_email = isset($user -> email) ? $user -> email :'';
?>
<!-- Modal HTML -->
      				<label>Mua ngay kẻo lỡ</label>
                	<form action="" name="eshopcart_info" method="post" id="eshopcart_info" onsubmit="javascript: return submit_quick_order();" >
	                	
		                  
		                   <div class="form_content">
		                   		<h3 class='price-modal'><?php echo format_money($price_current); ?></h3>
		                   		<p>
									<?php 
										$quantity =0;
										if($data->quantity > 20 ){
											$quantity =20;
										}else{
											$quantity =$data->quantity;
										}
										?>
									
										<select name=quantity>
											<option>Số lượng mua</option>
											<?php for($i=1;$i<=$quantity;$i++){?>
													<option <?php echo ($quantity == 1 )?'selected':'';?> value="<?php echo $i;?>"><?php echo $i;?></option>
											<?php } ?>
										</select>
									
								</p>
								<p>
									<input  type="text" name="sender_name" id="sender_name"  value="<?php echo $sender_name; ?>" class="input_text"  placeholder="Họ và tên" />
								</p>
								<p>
									<input type="text" name="sender_telephone" id="sender_telephone"  value="<?php echo $sender_telephone; ?>" class="input_text"   placeholder="Số di động" />
								</p>
								<p>
									<input type="text" name="sender_address" id="sender_address"  value="<?php echo $sender_address; ?>" class="input_text" placeholder="Địa chỉ giao hàng"  />
								</p>
								<p>
									<input type="text" name="sender_email"  id="sender_email"  value="<?php echo $sender_email; ?>" class="input_text"  placeholder="Email của bạn"  />
								</p>
								<p>
									<button type="submit" class="btn-cart"  id='submitbt' value="<?php echo FSText::_('Hoàn thành đặt hàng'); ?>" ><?php echo FSText::_('Hoàn thành đặt hàng'); ?></button>
								</p>					   		
								<input type="hidden" name='product_id' value="<?php echo $product->id;?>" />
								<input type="hidden" name='id' value="<?php echo $data->id;?>" />
								<input type="hidden" name='color_id' value="<?php echo $data->color_id;?>" />
								<input type="hidden" name='price' value="<?php echo $price_current; ?>" />
					   			<input type="hidden" name='module' value="products" />
								<input type="hidden" name='view' value="cart" />
								<input type="hidden" name='task' value="eshopcart2_countdown_save" id = 'task'/>
		                   </div>
	                	<?php global $config; ?>
	                   <div class="hotline_detail">Hotline hỗ trợ: <strong style="color: #E31010;"> <?php echo $config['hotline1']?></strong></div>
	                </form>
              