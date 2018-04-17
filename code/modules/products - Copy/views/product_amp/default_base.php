<div class='product_base'>
	
	<?php  include_once 'default_base_rated_fixed.php'; ?>
	
	
	<ul class="more">
   		 <li>
		    <?php if($data -> warranty_time ){?>
	           	<?php echo FSText::_('Bảo hành'); ?>: <span><?php echo $data->warranty_time;?></span>
	        <?php }else{ ?>
	           	<?php echo FSText::_('Bảo hành'); ?>: <span><?php echo FSText::_('Không'); ?></span>
	        <?php }?>
	     </li>
	     <li>
         	<?php echo FSText::_('Tình trạng'); ?> :  <span><?php echo $data -> quantity?  FSText::_('Còn hàng'):FSText::_('hết hàng'); ?></span>
		</li>		
		<?php if($data -> origin_id){?>
		<li>
			Xuất xứ :  <span><?php echo $data -> origin_name; ?></span>
		</li>		           
		<?php }?>
    </ul>
             
   
    <?php if($data->summary){ ?>
    <div class="summary">
	<?php $summary = $this -> standart_content_amp( $data -> summary); ?>
    	<?php echo $this -> breakline_summary($data -> summary); ?>
		
	</div>
	<?php } ?>
    <div class='price'>
		<?php if($data -> discount && $data -> price_old){?>
	        		<h3 class='price_old'><?php echo format_money($data -> price_old)?></h3>
	   	<?php }?>
		<h3 class='price_current'><?php echo format_money($data -> price) ; ?></h3>

	</div>
    <div class='detail_button product_detail_bt cls'>
		<div class="buy_area">
	    	 <a  rel="nofollow"  id="buy-now"  href="<?php echo FSRoute::_('index.php?module=products&view=cart&task=buy_multi&id='.$data -> id); ?>" class="btn-buy fl"  >
				<span><?php echo FSText::_('Đặt hàng ngay'); ?></span>
				
			</a>
			
		</div>	
		<div class="clear"></div>
		
		
	</div>
	<div class="hotline_detail">
		<i class="icon_v1"></i>
		<?php echo $config['hotline_detail_product'];?>
	</div>
	<!--	TAGS		-->
	
	<input type="hidden" name='record_id' id='record_id' value='<?php echo $data -> id; ?>'>
	<input type="hidden" name='table_name'  id ='table_name' value='<?php echo str_replace('fs_products_','', $data -> tablename); ?>'>

	<?php // include 'default_orders.php';?>
</div>