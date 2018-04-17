	<?php global $config;
	?>
				<!--	Product list and price			-->
				<div class='shopcart_product'>
					<form action="#" method="post" name="shopcart" >
						<table width="100%" border="1" class="table-product-pack mt20" bordercolor="#DCDCDC" cellpadding="6">
							<thead>
							  <tr class="head-tr">
								<th class="th-column" width="6%">STT</th>
								<th class="th-column" width="25%">Tên sảm phẩm</th>
								<th class="th-column" width="">Thêm</th>
								<th class="th-column" width="6%">S&#7889; l&#432;&#7907;ng</th>
								<th class="th-column" width="15%">Đơn giá(VNĐ)</th>
								<th class="th-column" width="15%">T&#7893;ng gi&#225;</th>
								<th class="th-column" width="5%">Xóa</th>
							  </tr>
							</thead>
							<tbody>
							
							<!--  Product list -->
							  <?php
							  $i = 0; 
							  $id_last = 0;
							  $total = 0;
							  $quantity = 0;
							  $cat_id_last = 0;
		
							  if($product_list) {
							  	foreach ($product_list as $prd) {
							  		$i++;
							  		$product = $this -> getProductById($prd[0]);
							  		$prd_name = $product -> name;
							  		
							  		$id_last = $prd[0];
							  		$cat_id_last = $product -> category_id;
							  		
							  		$memorys = $this -> get_memory_by_id_prd ($prd[0]);
							  		$memory  =  $this -> get_memory_by_id($prd[4] );

							  		$usage_statess = $this -> get_usage_states_by_id_prd ($prd[0]);
							  		$usage_states  =  $this -> get_usage_states_by_id($prd[8] );

									$colors = $this -> get_color_by_id_prd ($prd[0]);
									$color  =  $this -> get_color_by_id($prd[3] );
									
									$price_warranty = $config['price_warranty'];
									if($prd[5] == 3){
										$warranty_price = 300000;
										if($prd[1]  < $price_warranty  ){
											$warranty_price = 200000;
										}else{
											$warranty_price =  300000;
										}
									}else{
										$warranty_price = 0;
									}
							  		$price =$prd[1];
									$total_item =  ($price* $prd[2]) + @$color->price + @$memory -> price + $warranty_price + @$usage_states -> price;
									$total += $total_item ;



							  		$link_del_prd =FSRoute::_('index.php?module=products&view=cart&task=edel&id='.$prd[0].'&Itemid=65');
							  		$link_detail_prd =FSRoute::_('index.php?module=products&view=product&code='.$product->alias.'&ccode='.$product -> category_alias.'&Itemid=6');
										  		
							  ?>	
							   <tr>
									<td class="center-column" align="center"><?php echo $i; ?></td>
							
									<td class="name-product" align="center">
										<a href="<?php echo $link_detail_prd; ?>" > <?php  echo $prd_name;  ?> </a> <br/>		
										<a href="<?php echo $link_detail_prd; ?>" > 
											 <?php if($product -> image){ ?>
						                        	<?php $image_small = URL_ROOT.str_replace('/original/', '/resized/', $product->image); ?>
						                        	<img  src="<?php echo $image_small; ?>" alt="<?php echo htmlspecialchars ($product -> name); ?>"  />
					                        <?php } else {?>
					                            <img  width="80" height="100" src="<?php echo URL_ROOT.'images/no-img.gif'; ?>" alt="<?php echo htmlspecialchars ($product -> name); ?>" />
					                        <?php }?>	 
										</a> 
										
										
									</td>
									<td align="center">				
										<?php if(count($memorys)){?>											
											<div class=" select-box select-box-2 mt10">
												<select name='memory_<?php echo $prd[0];?>' id='memory_<?php echo $prd[0];?>' onchange="this.form.submit()">
													<option value="0" >Chọn bộ nhớ</option>
													<?php 	foreach ($memorys as $item){	?>
														<option value="<?php echo $item->id ?>" <?php echo (@$prd[4] == $item->id )?'selected':'';?> ><?php echo $item->memory_name?></option>
													<?php 	 }	?>
												</select>
											</div>	
										<?php } ?>
										<?php if(count($usage_statess)){?>											
											<div class=" select-box select-box-2 mt10">
												<select name='usage_states_<?php echo $prd[0];?>' id='usage_states_<?php echo $prd[0];?>' onchange="this.form.submit()">
													<option value="0" >Chọn bộ nhớ</option>
													<?php 	foreach ($usage_statess as $item){	?>
														<option value="<?php echo $item->id ?>" <?php echo (@$prd[4] == $item->id )?'selected':'';?> ><?php echo $item->usage_states_name?></option>
													<?php 	 }	?>
												</select>
											</div>	
										<?php } ?>
										
										<?php if(count($colors)){?>
											<div class=" select-box select-box-2 mt10">
												<select name='color_<?php echo $prd[0];?>' id='color_<?php echo $prd[0];?>' onchange="this.form.submit()">
													<option value="0" >Chọn màu</option>
													<?php 	foreach ($colors as $item){	?>
														<option value="<?php echo $item->id ?>" <?php echo (@$prd[3] == $item->id )?'selected':'';?> ><?php echo $item->color_name?></option>
													<?php 	 }	?>
												</select>
											</div>	
										<?php } ?>	
										<div class=" select-box select-box-2 mt10">
											<select name='warranty_<?php echo $prd[0];?>' id='warranty_<?php echo $prd[0];?>' onchange="this.form.submit()">
												<option value="0" <?php echo (@$prd[5] == 0 )?'selected':'';?> >Bảo hành mặc định</option>
												<option value="3" <?php echo (@$prd[5] == 3 )?'selected':'';?> >Bảo hành vàng</option>
											</select>
										</div>		
									</td>
									<td align="center">
										<input class="numbers-pro" type="text"  value="<?php echo $prd[2]?>"  name="<?php echo 'quantity_'.$prd[0]; ?>" size="8px"/>
									</td>
									<td class="price-product" align="center">
										<div class="price"><?php  echo format_money($price) ; ?></div>
										<div class="price_old"><?php  echo format_money($product -> price_old); ?></div>
									</td>
									<td class="total-price" align="center">
										<div class="price">
											<?php echo format_money($total_item,' VNĐ');?>
										</div>
									</td>
									<td class="center-column"  align="center">
										<a href="<?php echo $link_del_prd; ?>" title="">
											<img src="<?php echo  URL_ROOT.'modules/products/assets/images/del-product-cart.png';?>" alt="" />
											
										</a>
									</td>
									
							  </tr>
										  
							 <?php 
							  	}	
						  	}
						  	$cat_last = $this -> getProductCategoryById($cat_id_last);
						  	if($cat_last)
						  		$link_continue_buy = FSRoute::_('index.php?module=products&view=cat&ccode='.$cat_last->alias.'&Itemid=4');
						  	$link_del_all =FSRoute::_('index.php?module=products&view=cart&task=del_all&Itemid=65');
						  	$link_order = '#';
						  	?>		  
						</tbody>
						</table>
						<div class="all-button-cart pull-left">
							<?php if($cat_last){?>
							<input class="button-cart" type="button" name="next_step" id="sub-next-buy" onclick="javascript:window.location = '<?php echo $link_continue_buy; ?>'" value="&#9668; Ti&#7871;p t&#7909;c mua h&#224;ng"/>
							<?php }?>
							<input class="button-cart" type="submit" name="re_calculate" id="sub-re-cal" value="T&#237;nh l&#7841;i" />
							<input class="button-cart" type="button" name="remove"  value="X&#243;a h&#7871;t" onclick="javascript:window.location = '<?php echo $link_del_all; ?>'"/>
							<input class="button-cart" type="button" name="order" id="sub-pro-liquidate" value="Thanh to&#225;n &#9658;" onclick="javascript:window.location = '<?php echo $link_order; ?>'" />
						</div>	
						<div class="total-price pull-right" align="right" >Thành tiền (VNĐ): <span><?php echo format_money($total,' VNĐ');?></span></div>		
						<div class="clearfix"></div>			
						<input type="hidden" name='Itemid' value="<?php echo $Itemid; ?>" />
						<input type="hidden" name='module' value="products" />
						<input type="hidden" name='view' value="cart" />
						<input type="hidden" name='task' value="ere_cal2" id = 'task'/>
					</form>	
				</div>
				