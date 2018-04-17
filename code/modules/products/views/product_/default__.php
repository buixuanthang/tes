<?php  	global $config,$tmpl;

$total_relative = count(@$relate_products_list);
$Itemid = 6;
$noWord = 80;

$tmpl -> addStylesheet('product','modules/products/assets/css');
$tmpl -> addScript('main');
$tmpl -> addScript('form');
$tmpl -> addScript('jquery.sticky','modules/products/assets/js');
$tmpl -> addScript('product','modules/products/assets/js');

?>
<div class='product mt20'>
		<div class="row product_detail">
			    <div class="col-lg-l col-lg-7 col-md-7 col-sm-6 col-xs-12">
					<div class="tab-content">
						<div id="section_image" class="tab-pane fade in active">
							<?php include_once 'images/carousel.php'; ?>
						</div>
						<div id="section_video" class="tab-pane fade">
						<?php  if($data->video){ ?>
						<div class='item' >
					 		<div id="TVC_ADMICRO">
				 				<?php if(strpos($data -> video, 'http:') !== false || strpos($data -> video, 'https:') !== false){?>
				 					<embed   width="780" height="388" flashvars="skin=/libraries/jquery/jwplayer/glow/glow.xml&amp;file=<?php echo $data -> video; ?>&amp;image=<?php echo URL_ROOT.str_replace('/original/','/large/', $data -> image); ?>&amp;displayheight=388&amp;width=780&amp;height=388&amp;backcolor=0x00000 0&amp;frontcolor=0xCCCC CC&amp;lightcolor=0x5577 22&amp;shuffle=false&amp;repeat=list&amp;autostart=false" wmode="transparent" allowfullscreen="true" quality="high" name="playlist" id="playlist" style="undefined" src="/libraries/jquery/jwplayer/mediaplayer.swf" type="application/x-shockwave-flash">
			 					<?php }?>
			 	 			</div>	
					 	</div>
						<?php } ?>
						</div>
					</div>
			
					<ul class="nav nav-tabs gallery mt20">
						<li class="tabs-picture active">
							<a data-toggle="tab" href="#section_image"></a>
						</li>
						<?php  if($data->video){ ?>
							<li class="tabs-video">
								<a data-toggle="tab" href="#section_video">Video</a>
							</li>
						<?php } ?>
						<li class="tabs-share">
							<?php include_once 'default_share_bottom.php'; ?>
						</li>
					</ul>
					<ul class="nav nav-tabs tab-description">

						<li class="active">
							<a data-toggle="tab" href="#section_description">Tổng quan</a>
						</li>
						<?php if($cat->is_service != 1 && $cat->is_accessories != 1){?>
						<li>
							<a data-toggle="tab" href="#section_characteristic">Thông số kỹ thuật</a>
						</li>
						<?php } ?>
					</ul>
					
						<div class="tab-content">
							<div id="section_description" class="tab-pane fade in active">
								<?php if($tmpl->count_block('pos2')){?>
									<?php  echo $tmpl -> load_position('pos2','XHTML2'); ?>
								<?php }?>
								<?php echo $data->description?>
								<?php if($tmpl->count_block('pos3')){?>
									<?php  echo $tmpl -> load_position('pos3','XHTML2'); ?>
								<?php }?>
							</div>
							<?php if($cat->is_service != 1 && $cat->is_accessories != 1){?>
								<div id="section_characteristic" class="tab-pane fade">
				 	 				<?php include_once 'default_characteristic.php'; ?>
								</div>
							<?php } ?>
						</div>
				
					<div class="title-content">Bình luận đã chia sẻ</div>
					<div class="frame-content">
						<?php include_once("comment_facebook.php");?>
					</div>
				</div>
				<div class="col-lg-r col-lg-5 col-md-5 col-sm-6 col-xs-12">
					<?php include_once 'default_base.php'; ?>
				</div>
        </div>
</div>	
<input type="hidden" value="<?php echo $data->id; ?>" name='product_id' id='product_id'  />
