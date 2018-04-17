<?php  	global $tmpl,$config;

$total_relative = count(@$relate_products_list);
$Itemid = 6;
$noWord = 80;
FSFactory::include_class('fsstring');
$tmpl -> addStylesheet('product_amp','modules/products/assets/css');
$tmpl -> addStylesheet('default_amp','plugins/comments/assets/css');

?>
<div class='product' id="product_page" itemscope="" itemtype="https://schema.org/Product">
		<meta itemprop="url" content="<?php echo URL_ROOT.substr($_SERVER['REQUEST_URI'],1); ?>">

		<h1 itemprop="name"><?php echo $data -> name; ?></h1>
		<?php include_once 'images/images_amp.php'; ?>
		<?php  include_once 'default_base.php'; ?>

		<?php if($data -> promotion_info){?>
		<div class='promotion_info'>
			<div class='promotion_info_label'>Khuyến mãi:</div>
			<div class='promotion_info_content'>
				<?php echo $data -> promotion_info?>
			</div>
		</div>
		<?php }?>
	
			

		<div class='frame_right'>
			<?php   include 'default_products_is_accessories.php'; ?>
			
		</div>
		
			
		<!--	Phụ kiện khuyến mại	-->
		<?php //  include_once 'default_accessories_incentives.php'; ?> 
		
	
		
		<div class='product_tabs'>
			<?php  include_once 'default_tabs_horizontal.php'; ?> 
		</div>
		<div class='clear'></div>

	    <input type="hidden" value="<?php echo $data->id; ?>" name='product_id' id='product_id'  />
</div>

