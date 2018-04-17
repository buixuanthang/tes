 <!-- Modal HTML -->
    <div id="modal_buy_now" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
	               	 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <div class="modal-title"><span>Đặt hàng ngay - thông tin đặt hàng</span></div>
                </div>
                <div class="modal-body">
                	<form action="" name="eshopcart_info" method="post" id="eshopcart_info" >
	                	<div class="row cls">
		                   <div class=" col-modal-l">
		                   		<div class="media-box">
		                   			<div class="pull-left">
			                   			<div class="media-img " >
											<img class="img-responsive " src="<?php echo URL_ROOT.str_replace('/original/','/resized/', $data -> image); ?>" alt="<?php echo $data->name;?>">
										</div>
									</div>
									<div class="media-body">
										<h2><?php echo $data->name;?></h2>
										<?php if(count($price_by_memory)){?>
										   			<select class="boxmemory"   name="memory"  onchange="load_quick(this)">
										   				<option value="0"  data-price="0"  data-type="memory">Bộ nhớ sản phẩm</option>
														<?php 	foreach ($price_by_memory as $item){?>
															<option value="<?php echo $item->id ?>" data-price="<?php echo ($item -> price)?$item -> price:0;?>" data-type="memory"><?php echo $item -> memory_name;?></option>
														<?php }	?>
													</select>
										<?php }?>
										<?php if(count($price_by_usage_states)){?>
										   			<select class="boxusage_states"   name="usage_states"  onchange="load_quick(this)">
										   				<option value="0"  data-price="0"  data-type="usage_states">Trạng thái</option>
														<?php 	foreach ($price_by_usage_states as $item){?>
															<option value="<?php echo $item->id ?>" data-price="<?php echo ($item -> price)?$item -> price:0;?>" data-type="usage_states"><?php echo $item -> usage_states_name;?></option>
														<?php }	?>
													</select>
										<?php }?>
										<?php if(count($price_by_color)){?>
	                                        <select class="boxcolor" name="color"  onchange="load_quick(this);">
	                                            <option value="0" data-price="0" data-type="color">Chọn màu khác </option>
	                                            <?php foreach ($price_by_color as $item){?>
	                                                <option value="<?php echo $item->id ?>"  data-price="<?php echo ($item -> price)?$item -> price:0;?>" data-type="color" ><?php echo $item -> color_name;?></option>
	                                            <?php }?>
	                                        </select>
	                                    <?php }?>
										<?php if(count($price_by_warranty)){?>
									   			<select class="boxwarranty" name="warranty" onchange="load_quick(this);">
									   				<option value="0"  data-price="0" data-type="warranty" >Chế độ bảo hành</option>
													<?php foreach ($price_by_warranty as $item){?>
														<option value="<?php echo $item->id ?>" data-price="<?php echo ($item -> price)?$item -> price:0;?>" data-type="warranty"  ><?php echo $item -> warranty_name?></option>
													<?php }	?>
												</select>
										<?php }?>
											<?php if(count($price_by_origin)){?>
									   			<select class="boxorigin" name="origin" onchange="load_quick(this);">
									   				<option value="0"  data-price="0" data-type="origin" >Nguốn gốc</option>
													<?php foreach ($price_by_origin as $item){?>
														<option value="<?php echo $item->id ?>" data-price="<?php echo ($item -> price)?$item -> price:0;?>" data-type="origin"  ><?php echo $item -> origin_name?></option>
													<?php }	?>
												</select>
										<?php }?>
										<?php if(count($price_by_species)){?>
									   			<select class="boxsspecies" name="species"  onchange="load_quick(this);">
									   				<option value="0"  data-price="0" data-type="species" >Ram</option>
													<?php foreach ($price_by_species as $item){?>
														<option value="<?php echo $item->id ?>" data-price="<?php echo ($item -> price)?$item -> price:0;?>" data-type="species"  ><?php echo $item -> species_name?></option>
													<?php }	?>
												</select>
										<?php }?>
										<div>
											<strong>Số lượng</strong>
											<input class="quantity_modal" type="text" name="quantity" value="1" id="quantity_modal">
										</div>
										<div class='price_modal'>
										  <?php echo format_money($price,'đ'); ?>
									   	</div>
									</div>
									<div class="clear"></div>
		                   		</div>
		                   </div>
		                   <div class=" col-modal-r">
		                   		<div class="input_text_wrap">
		                   			<input type="text" name="sender_name" id="sender_name" placeholder="Họ và tên"  value="<?php echo $sender_name; ?>" class="input_text" />
		                   		</div>
		                   		<div class="input_text_wrap">
		                   			<input type="text" name="sender_telephone" id="sender_telephone"  placeholder="Điện thoại"  value="<?php echo $sender_telephone; ?>" class="input_text" />
		                   		</div>
		                   		<div class="input_text_wrap">
									<input type="text" name="sender_address" id="sender_address" placeholder="Địa chỉ" value="<?php echo $sender_address; ?>" class="input_text" />
								</div>
<!--								<input type="text" name="sender_email"  id="sender_email"  value="<?php echo $sender_email; ?>" class="input_text" />-->
								<div class="btn_area">
										<a rel="nofollow" class="btn btn-default" href="javascript: void(0)" id='submitbt'>
											<span><?php echo FSText::_('Đặt hàng'); ?></span>
										</a>
										<a  rel="nofollow" class="btn reset-default" href="javascript: void(0)" id='resetbt'>
											<span><?php echo FSText::_('Nhập lại'); ?></span>
										</a>
									</div>

						   		<input type="hidden" name='id' value="<?php echo $data->id;?>" />
						   		<input type="hidden" name='price' value="<?php echo $price;?>" />
						   		<input type="hidden" name='price_old' value="<?php echo $data->price_old;?>" />
					   			<input type="hidden" name='module' value="products" />
								<input type="hidden" name='view' value="cart" />
								<input type="hidden" name='task' value="eshopcart2_save" id = 'task'/>
		                   </div>
		                   <div class="clear"></div>
		                   <div class="other_info">
										<div class="check-square mt10">Nhận giao hàng trong <strong>60 phút</strong> tại <strong>TP.Hà Nội</strong> <?php $data ->warranty  ?></div>
										<div class="check-square mt10">Giao hàng <strong>tận nơi</strong>, hài lòng thanh toán</div>
										<div class="check-square mt10">Bảo hành <strong><?php $data ->warranty  ?></strong></div>
										<div class="mt10">Mọi thắc mắc xin vui lòng liên hệ theo số máy <strong style="color: #E31010;"> <?php echo $config['hotline']?></strong> để biết thêm chi tiết.</div>
									</div>
	                	</div>

	                </form>
                </div>
            </div>
        </div>
    </div>
<input type="hidden" value="0" id='memory_curent'  />
<input type="hidden" value="0" id='usage_states_curent'  />
<input type="hidden" value="0" id='color_curent'  />
<input type="hidden" value="0" id='warranty_curent'  />
<input type="hidden" value="0" id='origin_curent'  />
<input type="hidden" value="0" id='species_curent'  />
<input type="hidden" value="<?php echo $price;  ?>" id='basic_price'  />
<input type="hidden" value="<?php echo $data->id; ?>" name='product_id' id='product_id'  />