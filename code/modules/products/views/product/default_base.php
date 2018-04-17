<div class='product_base'>
	

	<?php // include 'default_prices.php';?>
	
	<?php if(!$is_mobile){ ?>

		<div class="product_name">
			<h1 itemprop="name"><?php echo $data -> name; ?> </h1>
			<ul>
				<li>Khoảng giá:<span  class="price"><?php echo format_money($data -> price).' '.'-'; echo format_money($data -> maxprice) ; ?></span>
					<span class="status"> <i class="fa fa-check-circle"></i><?php echo $data -> quantity?  FSText::_('Còn hàng'):FSText::_('Hết hàng'); ?></span>
				</li> 
				<li>Thời gian sửa chữa: <?php echo $data -> fix_time; ?></li>
				<li>Thời gian bảo hành: <?php echo $data -> warranty; ?></li>
			</ul>
			
		</div>

		<div class="solution">
			<span><i class="fa fa-cogs"></i>Giải pháp<hr></span>
			<div class="text"><?php echo $data -> solution; ?></div>
				
		</div>

		<div class="solution">
			<span><i class="fa fa-gift"></i>Khuyến mại<hr></span>
			<div class="text"><?php echo $data -> accessories; ?></div>		
		</div>


	<?php } ?>


	<div class="contact">
		<div class="phone position">

			<span><i class="fa fa-phone"></i>Gọi nhân viên</span>
			<p>Miễn phí:<?php echo $config['hotline_detail_product'];?></p>
	
		</div>
		<div class="mesage position">
			<a href=""><span><i class="fa fa-comment-o"></i>Chát hỏi ngay</span>
			<p>Tư vấn bởi kĩ thuật viên</p>
			</a>
		</div>
	</div>
	
<div class="clear"></div>

	<div class='detail_button product_detail_bt'>	

		<div class="buy_fast">
			<form action="" name="buy_fast_form" id="buy_fast_form" method="post" onsubmit="javascript: return submit_form_buy_fast();" >


				<div class="cls buy_fast_body">
					<input type="text" value="" placeholder="Nhập số điện thoại" id="telephone_buy_fast" name="telephone_buy_fast" class="keyword input-text" />
					<button type="submit" class="button-buy-fast button"><?php echo $is_mobile?'Gọi lại cho bạn ngay':'Gọi lại cho tôi';?> <button>

					</div>


					<?php 
					$url = $_SERVER['REQUEST_URI'];
					$return = base64_encode($url);					
					?>
					
					<input type='hidden'  name="module" value="products"/>		    	
					<input type='hidden'  name="view" value="cart"/>
					<input type='hidden'  name="task" value="buy_fast_save"/>
					<input type='hidden'  name="id" value="<?php echo $data -> id; ?>"/>
					<input type='hidden'  name="Itemid" value="10"/>
					<input type="hidden" value="<?php echo $return; ?>" name="return"  />
					
					

				</form>

			</div>
			
			<div class="info-bootom">
				<div class="info-detail">
					<span>
						<i class="fa fa-map-marker">
						
						</i>
					</span>&nbsp Trung tâm sửa chữa: <p style="color:#00a810; font-family: RobotoBold; "><?php echo $config['address'];?></p></div>
				<div class="info-detail">
					<span>
						<i class="fa fa-clock-o">
						
						</i>
					</span>&nbsp Giờ làm việc: <p><?php echo $config['thoi_gian_lam_viec'];?></p></div>
				<div class="info-detail">
					<span>
						<i class="fa fa-calendar-o">
						
						</i>
					</span>&nbsp Danh mục: <p><?php echo $data -> category_name; ?></p></div>
				<div class="info-detail">
					<span>
						<i class="fa fa-tags">
						
						</i>
					</span>&nbsp Tag: <p><?php echo $data -> tags; ?></p></div>
			</div>
			

	</div>

		<!--	TAGS		-->

		<input type="hidden" name='record_alias' id='record_alias' value='<?php echo $data -> alias; ?>'>
		<input type="hidden" name='record_id' id='record_id' value='<?php echo $data -> id; ?>'>
		<input type="hidden" name='table_name'  id ='table_name' value='<?php echo str_replace('fs_products_','', $data -> tablename); ?>'>


	</div>