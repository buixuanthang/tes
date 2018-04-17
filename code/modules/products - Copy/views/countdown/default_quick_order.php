<?php 
$sender_name = isset($user -> full_name) ? $user -> full_name :'';
$sender_telephone = isset($user -> mobilephone) ? $user -> mobilephone :'';
$sender_address = isset($user -> address) ? $user -> address :'';
$sender_email = isset($user -> email) ? $user -> email :'';
?>
<!-- Modal HTML -->
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
	               	 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><span>Đặt hàng ngay - thông tin đặt hàng</span></h4>
                </div>
                <div class="modal-body">
                	<form action="" name="eshopcart_info" method="post" id="eshopcart_info" onsubmit="javascript: return submit_quick_order();" >
	                	<div class="row">
		                   <div class=" col-modal-l col-lg-6 col-md-6 col-sm-6 col-xs-12">
		                   		<div class="clearfix">
		                   			<div class="inner-left pull-left" >
		                   				<p class="media-img">
											<img class="img-responsive " src="<?php echo URL_ROOT.str_replace('/original/','/resized/', $product -> image); ?>" alt="<?php echo $product->name;?>">
										</p>
									</div>
									<div class="media-body">
										<h2><?php echo $product->name;?></h2>
										<h3 class='price-modal'><?php echo format_money($price_current,' vnđ'); ?></h3>
										<?php 
										$quantity =0;
										if($data->quantity > 20 ){
											$quantity =20;
										}else{
											$quantity =$data->quantity;
										}
										?>
										<div class="select-box2 mt10">
											<select name=quantity>
												<option>Số lượng mua</option>
												<?php for($i=1;$i<=$quantity;$i++){?>
														<option <?php echo ($quantity == 1 )?'selected':'';?> value="<?php echo $i;?>"><?php echo $i;?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									
		                   		</div>
		                   		<?php global $config; ?>	
								<div class="mt10">Mọi thắc mắc xin vui lòng liên hệ theo số máy <strong style="color: #E31010;"> <?php echo $config['hotline1']?></strong> để biết thêm chi tiết.</div>
		                   </div>
		                   <div class=" col-modal-r col-lg-6 col-md-6 col-sm-6 col-xs-12">
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
	                	</div>
	                   
	                </form>
                </div>
            </div>
        </div>
