<?php 
global $tmpl;

$tmpl -> addScript('jquery.jcarousel.min','libraries/jquery/jcarousel/js');
$tmpl -> addScript('jcarousel.vert','modules/products/assets/js');
$tmpl -> addStylesheet('jcarousel.vert','modules/products/assets/css');

$tmpl -> addStylesheet('magiczoomplus','libraries/jquery/magiczoomplus');
$tmpl -> addScript('magiczoomplus','libraries/jquery/magiczoomplus');
// $tmpl -> addStylesheet('magiczoomplus','modules/products/assets/css');

$array1 = array("0" => $data);
$result = array_merge($array1, $product_images);
$total =count($result);
?>
<?php if($total){ ?>
<div class="product-item-image">
					
					<aside style="width:70px;float:left;z-index:950;min-height:1px;margin-right: 30px;">
						<div class="jcarousel-wrapper">
							<?php if($total > 4){?>
			<a class="jcarousel-control-prev" href="#" data-jcarouselcontrol="true">
										<img width="24px" height="14px" src="<?php echo URL_ROOT.'modules/products/assets/images/arrow-l.png';?>">
									</a>
								<?php } ?>
							<div class="jcarousel" data-jcarousel="true">
								
									<ul>
									   <?php foreach($result as $item){	?>
									   		<li>
										        <a href="<?php echo URL_ROOT.str_replace('/original/','/original/', $item -> image); ?>" class="Selector"  rel="zoom-id:Zoomer" rev="<?php echo URL_ROOT.str_replace('/original/','/large/', $item -> image); ?>">
										       	 	<img src="<?php echo URL_ROOT.str_replace('/original/','/small/', $item -> image); ?>" >
										        </a>
												<?php } ?>
											</li> 
										<?php }?>
									</ul>
							</div>
							<?php if($total> 4){?>
				<a class="jcarousel-control-next" href="#" data-jcarouselcontrol="true">
					<img width="24px" height="14px" src="<?php echo URL_ROOT.'modules/products/assets/images/arrow_r.png';?>">
				</a>
			<?php } ?>
						</div>
					</aside>
					<div style="position:relative;float:left; left:0px;">
						<a id="Zoomer" href="<?php echo URL_ROOT.str_replace('/original/','/original/', $data -> image); ?>" class="MagicZoomPlus" data-options="expand: off; hint: always; textHoverZoomHint: <?php echo FSText::_('roll over image to zoom in');?>; zoomOn: hover" title="" >
							<img src="<?php echo URL_ROOT.str_replace('/original/','/large/', $data -> image); ?>" >
						</a>
					</div>
					<div class="clear"></div>
				</div>
