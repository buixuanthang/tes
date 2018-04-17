<div class="frame-large-body">
		    <table width="100%">
		        <tr>
		            <th width="4.3%" height="35">STT</th>
					<th width="56.7%"><?php echo FSText::_('Tên sản phẩm'); ?></th>
					<th width="13.2%"><?php echo FSText::_('Đơn giá'); ?>(VNĐ)</th>
					<th width="8%"><?php echo FSText::_('Số lượng'); ?></th>
		            <th width="13.2%"><?php echo FSText::_('Tổng'); ?></th>
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
    						<p><?php echo FSText::_('Mã sản phẩm'); ?>: <span><?php echo $product->code; ?></span><p>
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
				<?php // include_once 'finished_mobile.php'; ?>
			</div>
	        <div class="bottom">
            	<p><?php echo FSText::_('Thành tiền'); ?>: <span><?php echo format_money($total,'VNĐ'); ?></span></p>
            	<div class="clear"></div>
            </div>
			<div class='clear'></div>
		</div>