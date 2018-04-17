<?php  	global $tmpl,$config;

$total_relative = count(@$relate_products_list);
$Itemid = 6;
$noWord = 80;
FSFactory::include_class('fsstring');
$tmpl -> addStylesheet('product','modules/products/assets/css');
$tmpl -> addStylesheet('plugin_animate.min','libraries/jquery/owl.carousel.2/assets');

// tab
$tmpl -> addStylesheet('tab','modules/products/assets/css');
$tmpl -> addScript('tab','modules/products/assets/js');

// rating
//$tmpl -> addScript('jquery-ui','libraries/jquery/jquery.ui');
//$tmpl -> addScript('jquery.ui.stars','libraries/jquery/jquery.ui.stars/js');
//$tmpl -> addStylesheet('jquery.ui.stars','libraries/jquery/jquery.ui.stars/css');


$tmpl -> addScript('main');
$tmpl -> addScript('form');

// magiczoom
$tmpl -> addStylesheet('owl.carousel','libraries/jquery/owl.carousel.2/assets');
$tmpl -> addScript('owl.carousel.min','libraries/jquery/owl.carousel.2');
$tmpl -> addStylesheet('magiczoomplus','libraries/jquery/magiczoomplus');
$tmpl -> addScript('magiczoomplus','libraries/jquery/magiczoomplus');
$tmpl -> addScript('product_images_magiczoom','modules/products/assets/js');
$tmpl -> addStylesheet('product_images_magiczoom','modules/products/assets/css');

//$tmpl -> addScript('shopcart','modules/products/assets/js');
$tmpl -> addScript("jquery.autocomplete","blocks/search/assets/js");
$tmpl -> addScript("jquery.lazy.iframe.min","libraries/jquery/jquery.lazy/plugins");
$tmpl -> addScript('product','modules/products/assets/js');
//$tmpl -> addScript3('https://apis.google.com/js/platform.js');
global $is_mobile;

?>
<div class='product cls' id="product_page" itemscope="" itemtype="https://schema.org/Product">
	<meta itemprop="url" content="<?php echo URL_ROOT.substr($_SERVER['REQUEST_URI'],1); ?>">


	<div class='frame_left'>
		<div class='frame_left_inner'>
			<?php include_once 'images/magiczoom.php'; ?>
			<?php //include_once 'default_nav_tab.php'; ?>
			<?php if( $data->promotion_info){?>
			<div class="frame_dt promotion_info">
				<?php echo $data->promotion_info;?>
			</div>
			<?php }?>

			<?php  include 'default_share.php';?>
		</div>
	</div>
	<div class='frame_center'>
		<?php  include_once 'default_base.php'; ?>
	</div>


	<!--	Phụ kiện khuyến mại	-->
	<?php //  include_once 'default_accessories_incentives.php'; ?> 



	<div class='product_tabs'>
		<?php  include_once 'default_tabs_horizontal.php'; ?> 
		<?php  /*include_once 'default_quick_order.php';*/ ?> 
	</div>


	

	<div class='clear'></div>
	<input type="hidden" value="<?php echo $data->id; ?>" name='product_id' id='product_id'  />


	<?php 


//	if(count($products_in_cat)){
//		$title_relate =  'Sản phẩm cùng danh mục';
//		$relate_type = 1;
//		$list_related = $products_in_cat;
//	
//		include 'related/rps_default_related.php';	
//	}
//	if(count($relate_products_list)){
//		$title_relate =  'Có thể bạn có cấu hình tương đương';
//		$relate_type = 2;
//		$list_related = $relate_products_list;
//		include 'related/rps_default_related.php';	
//	}
//	if(count($products_same_price)){
//		$title_relate =  'Sản phẩm có mức giá tương đương';
//		$relate_type = 3;
//		$list_related = $products_same_price;
//		include 'related/rps_default_related.php';	
//	}


	?>
	<div class='clear'></div>
	<input type="hidden" value="<?php echo $data->id; ?>" name='product_id' id='product_id'  />
</div>

