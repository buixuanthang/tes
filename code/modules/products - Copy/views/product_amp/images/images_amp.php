<?php 
global $tmpl;
//$tmpl -> addStylesheet('jquery.ad-gallery','libraries/jquery/gallery/css');
//$tmpl -> addScript('jquery.ad-gallery','libraries/jquery/gallery/js');
// colox box

?>
<?php $img = $data -> image?>
<div class="img-carousel">
<amp-carousel id="carousel-with-preview"
    width="450"
    height="300"
    layout="responsive"
    type="slides">

	<?php $j = 0; ?>
	<?php if($img){?>
		 <amp-img src="<?php echo URL_ROOT.str_replace('/original/','/large/', $data->image); ?>"
	      width="450"
	      height="300"
	      layout="responsive"
	      alt="<?php echo htmlspecialchars ($data -> name); ?>"></amp-img>
    <?php }?>
    <?php if(count($product_images)){?>
    	<?php for($i = 0; $i < count($product_images); $i ++ ){?>
    		<?php $j ++; ?>
    		<?php $item = $product_images[$i];?>
    		<?php $image_small_other = str_replace('/original/', '/large/', $item->image); ?>
    		 <amp-img src="<?php echo URL_ROOT.str_replace('/original/','/large/', $item->image); ?>"
	      width="450"
	      height="300"
	      layout="responsive"
	      alt="<?php echo htmlspecialchars ($data -> name); ?>"></amp-img>
    	<?php } ?>
    <?php } ?>

  </amp-carousel>
  <div class="carousel-preview">
  	<?php $j = 0; ?>
  	<?php if($img){?>
	  	<button on="tap:carousel-with-preview.goToSlide(index=<?php echo $j; ?>)">
	      <amp-img src="<?php echo URL_ROOT.str_replace('/original/','/small/', $data->image); ?>"
	        width="60"
	        height="40"
	        alt="<?php echo htmlspecialchars ($data -> name); ?>"></amp-img>
	    </button>

		 
    <?php }?>
    <?php if(count($product_images)){?>
    	<?php for($i = 0; $i < count($product_images); $i ++ ){?>
    		<?php $j ++; ?>
    		<?php $item = $product_images[$i];?>
    		<?php $image_small_other = str_replace('/original/', '/large/', $item->image); ?>
    		<button on="tap:carousel-with-preview.goToSlide(index=<?php echo $j; ?>)">
		      <amp-img src="<?php echo URL_ROOT.str_replace('/original/','/small/', $item->image); ?>"
		        width="60"
		        height="40"
		        alt="<?php echo htmlspecialchars ($data -> name); ?>"></amp-img>
		    </button>

    	<?php } ?>
    <?php } ?>

  </div>
</div>
