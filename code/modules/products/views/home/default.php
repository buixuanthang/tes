<?php 
global $tmpl;
// $tmpl -> addScript('jquery.ezpz_tooltip','libraries/jquery/tip/EZPZ');
// $tmpl -> addScript('home','modules/products/assets/js');
// $tmpl -> addStylesheet('ezpz_tooltip','libraries/jquery/tip/EZPZ');
// $tmpl -> addStylesheet("home","modules/products/assets/css");
$tmpl -> addStylesheet("product","modules/products/assets/css");

$Itemid = 30;
$Itemid_detail = 31;
$cols = 5;
FSFactory::include_class('fsstring');
?>


<div class="wapper-content-page">
	<?php if($tmpl->count_block('top-home-product')) {?>
     
        	<?php  echo $tmpl -> load_position('top-home-product', 'XHTML'); ?>

    <?php }?>


    



	<div class='clear'></div>
</div><div class="wapper-content-page-bottom">&nbsp;</div>