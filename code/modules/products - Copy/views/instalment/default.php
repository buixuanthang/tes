<?php 
global $tmpl;
$tmpl -> addStylesheet("instalment","modules/products/assets/css");
$tmpl -> addStylesheet("jquery-ui","libraries/jquery/jquery.ui");
$tmpl -> addScript("jquery-ui","libraries/jquery/jquery.ui");
$tmpl -> addScript("instalment","modules/products/assets/js");
$id = FSInput::get('id');

?>
<div class="product_instalment">
	<h1>Mua trả góp <?php echo $data -> name; ?></h1>
	
	<form action="" name="eshopcart_info" method="post" id="eshopcart_info" >
	
		<div class="table_head">
			<label>Lựa chọn phương thức trả góp phù hợp:</label>
			<div class="method_instalment_wrapper cls">
				<div class="finance_method" id="finance_method">					
					<span>Công ty tài chính</span>
					<span>Home creadit</span>

				</div>
				<div class="alepay_method" id="alepay_method">
					<span>Thẻ tín dụng</span>
					<span>Visa, master, alepay</span>
				</div>
			</div>
			<input type="hidden" name="method_instalment" id="method_instalment" value="finance" />
		</div>

		<div class="table_t" style="display: none" id="table_main">

			<div class="table_body cls">
				<div class="table_body_l">
					<label class="mt10">Mua trả góp <?php echo $data -> name; ?></label>
					<div class="clearfix"></div>
					
					<div id="product-content">
						<img id="product-icon" src="<?php echo URL_ROOT.str_replace('/original/', '/resized/', $data -> image)?>"  alt="<?php echo $data -> name; ?>">

						
						<h3 class='price_modal'>
							  <?php echo format_money($price,'đ'); ?>
						   	</h3>

					</div>

					<?php include 'default_prices.php'; ?>
					<div class="clearfix"></div>
					<br/><br/>
					<input id="product_text"  placeholder="Nhập tên sản phẩm cần mua">
					
				</div>
				<?php include 'finance.php'; ?>
				<?php   include 'alepay.php'; ?>
				
				

				<div class="clearfix"></div>
			</div><!--  .table_body -->
			
			
		</div>
		<input type="hidden" name='id' value="<?php echo $data->id;?>" />
   		<input type="hidden" name='price' value="<?php echo $price;?>" />
   		<input type="hidden" name='price_old' value="<?php echo $data->price_old;?>" />
			<input type="hidden" name='module' value="products" class="alepay_not_submit" />
		<input type="hidden" name='view' value="cart"  class="alepay_not_submit"/>
		<input type="hidden" name='task' value="eshopcart2_save" id = 'task'  class="alepay_not_submit"/>
		
	</form>	
		



</div>

<?php include 'default_note.php' ?>

<?php 
if(isset($data) && $data ) 
		include 'default_remarketing.php';
?>
