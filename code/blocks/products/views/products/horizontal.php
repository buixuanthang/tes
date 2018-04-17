<?php
global $tmpl; 
$tmpl -> addStylesheet('products','modules/products/assets/css');
$tmpl -> addStylesheet('horizontal','blocks/products/assets/css');
FSFactory::include_class('fsstring');

?>	
    <?php if(isset($list) && !empty($list)){ ?>
	<div class="products_blocks_wrapper hide1 block products_horizoltal_content ">
		<div class="links_other">
		<?php $link = FSRoute::_('index.php?module=products&view=home');	?>
		<a href="<?php echo $link; ?>"	title="Mẫu website theo phong thủy">Mẫu webite theo phong thủy</a>,
		<a href="<?php echo $link; ?>"	title="Mẫu website theo năm sinh">Mẫu webite theo năm sinh</a>,
		<a href="<?php echo $link; ?>"	title="Xem thêm mẫu website đẹp">Mẫu website đẹp</a>,
		<a href="<?php echo $link; ?>"	title="Xem thêm mẫu website thẩm mỹ">Mẫu website thẩm mỹ</a>,
		<a href="<?php echo $link; ?>"	title="Xem thêm mẫu website nội thất">Mẫu website nội thất</a>
		</div>
		<div class="product_star">
			<span class="line-thought"></span>
			<span class="star_small"><i class="fa fa-star"></i></span>
			<span class="star_large"><i class="fa fa-star"></i></span>
			<span class="star_small"><i class="fa fa-star"></i></span>
			<span class="line-thought"></span>
		</div>
		<div class="products_grid cls">
			<?php 	foreach($list as $item){ ?>
				<?php include 'item_simple.php'; ?>  										
	        <?php } ?>
	                            
		</div>	                          
       
        <div class="note">
        	<span>Lưu ý:</span>	
        	Hiện nay rất  nhiều đơn vị đang dùng trái phép giao diện của chúng tôi. Tuy nhiên chất lượng code sẽ có sự khác biệt lớn. 
        </div>
         <div class='readmore'>
        	<?php $link = FSRoute::_('index.php?module=products&view=home'); ?>	
        	<a href="<?php echo $link; ?>"	title="Xem thêm mẫu website đẹp">Xem thêm</a>
        </div>
		<div class="clear"></div> 
	</div>
                
    <?php } ?>
	