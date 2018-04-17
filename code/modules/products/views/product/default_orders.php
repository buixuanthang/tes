<?php if($orders){ ?>
<div class="products_orders" >
  	<label><span>Khách hàng đặt mua</span></label>                       


<ul id="products_orders">
<?php foreach($orders as $item){ ?>
	<li class="item item-<?php echo $item -> id;?>">
		Khách hàng <span class="name"><?php echo $item -> sender_name; ?></span> - <span class="phone">(<?php echo substr($item -> sender_telephone, 0, -3).'xxx'; ?>)</span> đã mua <?php echo time_elapsed_string(strtotime($item -> created_time)); ?> (<?php echo date('d/m/Y',strtotime($item->created_time)); ?>) 
		<i class="icon_v1"></i>
	</li>
<?php } ?>
</ul>

</div>
<?php } ?>