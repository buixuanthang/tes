<?php  	global $config,$tmpl;

$total_relative = count(@$relate_products_list);
$Itemid = 6;
$noWord = 80;

$tmpl -> addStylesheet('product','modules/products/assets/css');
$tmpl -> addScript('form');

$tmpl -> addScript('product','modules/products/assets/js');
?>
<script>
fbq('track', 'ViewContent', {
                content_ids: ['<?php echo $data -> id; ?>'],
                content_type: 'product',
                value: <?php echo $price; ?>,
                currency: 'VND'
            });
function add_fb_cart(){
	
	fbq('track', 'AddToCart', {
                content_ids: ['<?php echo $data -> id; ?>'],
                content_type: 'product',
                value: <?php echo $price; ?>,
                currency: 'VND'
            });
}
</script>

<!-- Tiep thi lai dong adword -->
<script type="text/javascript">
var google_tag_params = {
dynx_itemid: '<?php echo $data -> id; ?>',
dynx_itemid2: '<?php echo $data -> id; ?>',
dynx_pagetype: 'offerdetail',
dynx_totalvalue: <?php echo $price; ?>,

};
</script>
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 861314443;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>

<!-- end Tiep thi lai dong adword -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>



<script src="http://msmobile.com.vn/templates/default/js/owl.carousel.min.js"></script>


<script type="text/jscript">
 $(document).ready(function() {
    $('#carousel_lindo').owlCarousel({
     loop:true,
     margin:10,
    nav:true,
    responsive:{
        0:{
            items:2
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }

    }
}) });


$(document).ready(function() {
    $('#lindo_list_related').owlCarousel({
     loop:true,
     margin:10,
    nav:true,
    responsive:{
        0:{
            items:2
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }

    }
}) });



$(document).ready(function() {
    $('#progress_bar_plus_m').owlCarousel({
     loop:true,
     margin:0,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }

    }
}) });


</script>


<div class='product mt20' itemscope="" itemtype="http://schema.org/Product">
	<div class="_rowtop clearfix">
<div class="row">
<div class="col-md-5 col-xs-12">
<h1 class="pull-left"><span itemprop="name"><?php echo $data->name; ?></span></h1>
</div>
<div class="col-md-4 col-xs-12 hidden-xs">
<div class="mssbobile_chinhhang_main">
                                <div class="To_tooltip">
                                    <span class="To_tooltip_right">
                                    <strong>MSmobile</strong> là thương hiệu lâu năm phân phối sản phẩm <strong>Điện Thoại và Công Nghệ xách tay cũng như Chính Hãng</strong> uy tín hàng đầu Việt Nam. Với những chính sách bảo hành tốt nhất -<strong> Bảo Hành dài hơn cả Nhà Sản Xuất.</strong> <br>

Khác hẳn với các cửa hàng bán đồ nhỏ lẻ, không có thương hiệu, hàng trôi nổi, hàng không nguồn gốc xuất xứ... không đảm bảo, <strong>MSmobile cam kết</strong> sản phẩm luôn Chính Hãng của Nhà sản xuất đi với <strong>giá thành hợp lý</strong>. <strong>MSmobile khẳng định giá sản phẩm của chúng tôi luôn tốt nhất trên thị trường.</strong> <br>

Đặc biệt khách hàng mua sản phẩm Điện Thoại tại <strong>MSmobile</strong> còn có 1 đặc quyền là sẽ được giảm giá cho các sản phẩm mua những lần tiếp theo, chỉ <strong>Duy Nhất tại MSmobile Chúng tôi luôn phấn đấu đem lại Lợi ích lớn nhất cho khách hàng.</strong><br>

Hơn nữa, khách hàng sẽ được mua sản phẩm Chính hãng với giá cực sốc và hàng loạt những quà tặng cực kỳ hấp dẫn khi tham gia các chương trình <strong>khuyến mãi cũng như Khuyến mại hàng tuần, hàng tháng hoặc Xả Hàng Máy Khủng - Giờ Vàng Giá Sock...</strong><br>
​
                                    </span>
                                </div>
                            </div>
</div>
<div class="col-md-3 col-xs-12">
<div class="pull-right">
			<?php
			//	include 'default_share_bottom.php';
			?>
		</div>
</div>
</div>
	</div>

	<section class="clearfix">
		<div class="_boxleft" id="myScrollspy">
	        <ul class="nav nav-tabs nav-stacked" data-spy="affix" data-offset-top="550">
	                <li><a href="#characteristic">Thông số</a></li>
	                <li><a href="#boxvideo">Video</a></li>
	                <li><a href="#boxrelate">Tương tự</a></li>
	                <li><a href="#boxdesc">Đánh giá</a></li>
	                <li><a href="#boxcomment">Bình luận</a></li>
	        </ul>
	    </div>
		<div class="_boxright">
			<aside class="_picture ">

    <section class="contentdetail visible-xs">
		<div class="_boxright" id="characteristic">
			<div class="_highlights ">

				<div class="label-content">
                <?php include 'progress_bar_images_m.php'; ?>
				</div>
			</div> 		</div>

	</section>


				<?php include_once 'images/carousel.php'; ?>
				<div class="_color">
					<?php if(count($price_by_color)){?>
			   			<label><b>Xem thêm màu: </b></label>
			   			<?php 	foreach ($price_by_color as $item){

		   				$price_color =0;
						if($item->price > 0){
							$price_color = '+'.format_money($item->price,'vnđ') ;
						}else if($item->price < 0){
							$price_color = format_money($item->price,'vnđ') ;
						}else{
							$price_color = '+0 vnđ';
						}
						?>
			   			<a  href="javascript:void(0)" class="Selector "  onclick="load_quick(this);" data-price="<?php echo $item -> price;?>" data-type="color"  data-id="<?php echo $item -> id;?>">
							<span  class="color_item" data-toggle="tooltip" data-original-title="<?php echo $price_color ;?>"  style="background-color: <?php  echo '#'.$item->color_code?>;"></span>
						</a>
						<?php 	 }	?>
					<?php }?>
				</div>

			</aside>
			<aside class="_extra">

                <div class="row">


                <div class="col-xs-6">

    <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

     		<span class='_price' itemprop="price" content="000.000">
      		<?php echo format_money($price,'đ'); ?>
      		</span>

      		<span itemprop="priceCurrency" content="VND"></span>

    </div>


                <?php /*?>	<span  class='_price '>
				   		<?php  echo format_money($price,'đ'); ?>
     <span property="price" content="<?php echo format_money($price,''); ?>"><?php echo format_money($price,''); ?></span>
              <span property="priceCurrency" content="vnd">đ</span>
				   	</span><?php */?>
				   	<?php if($data-> discount ){?>
				   		<span class="price_old">


				    	<?php  echo ($price_old)?format_money($price_old,'đ'):''; ?>
				    	 </span>
				    <?php  }?>

                </div>
                <div class="col-xs-6">
				<div class="quantity ">
				   	<?php if($data->quantity == 0){?>
			   			<span class="sold_out">Hết hàng</span>
			   		<?php }else {?>
			   			<span class="in_stock">Còn hàng</span>
			   		<?php } ?>
			   		<a href="javascript: favourite(<?php echo $data->id;?>)" class="btn-favourites">&nbsp;</a>
			   	</div>
                </div>
                 </div>
				<div class="start_seo_lindo">
					<?php include 'default_base_rating.php';	 ?>
				</div>

			   <div class="_attributes clearfix">
				    <?php if(count($price_by_memory)){?>
				   			<select  class="boxmemory" onchange="load_quick(this)">
				   				<option value="0" data-price="0" data-type="memory">Bộ nhớ sản phẩm</option>
								<?php 	foreach ($price_by_memory as $item){?>
									<option value="<?php echo $item->id ?>" data-price="<?php echo ($item -> price)?$item -> price:0;?>" data-type="memory"><?php echo $item -> memory_name;?></option>
								<?php }	?>
							</select>
					<?php }?>

					<?php if(count($price_by_warranty)){?>
				   			<select class="boxwarranty" onchange="load_quick(this);">
				   				<option value="0"  data-price="0" data-type="warranty">Chế độ bảo hành</option>
								<?php foreach ($price_by_warranty as $item){?>
									<option value="<?php echo $item->id ?>" data-price="<?php echo ($item -> price)?$item -> price:0;?>" data-type="warranty"  ><?php echo $item -> warranty_name?></option>
								<?php }	?>
							</select>
					<?php }?>
					<?php if(count($price_by_origin)){?>
				   			<select class="boxorigin" onchange="load_quick(this);">
				   				<option value="0"  data-price="0" data-type="origin" >Nguốn gốc</option>
								<?php foreach ($price_by_origin as $item){?>
									<option value="<?php echo $item->id ?>" data-price="<?php echo ($item -> price)?$item -> price:0;?>" data-type="origin"  ><?php echo $item -> origin_name?></option>
								<?php }	?>
							</select>
					<?php }?>
					<?php if(count($price_by_species)){?>
				   			<select class="boxsspecies" onchange="load_quick(this);">
				   				<option value="0"  data-price="0" data-type="species" >Ram</option>
								<?php foreach ($price_by_species as $item){?>
									<option value="<?php echo $item->id ?>" data-price="<?php echo ($item -> price)?$item -> price:0;?>" data-type="species"  ><?php echo $item -> species_name?></option>
								<?php }	?>
							</select>
					<?php }?>
				</div>
		   	    <?php if( $data->accessories){?>
					<label class="_infopromotion">
                    <img class="gif_is" src="http://msmobile.com.vn/images/gift.png" alt="qua tang"/>
                    <b>Quà khuyến mãi</b></label>
					<div class="_detailpromotion ">
						<?php echo $data->accessories;?>
					</div>
				<?php }?>

                <?php if( $data->promotion_info){?>
                <div class="_detailpromotion">
             		<?php echo $data->promotion_info;?>
                </div>
                <?php }?>
				 <a  rel="nofollow"  id="buy-now"  href="#modal_buy_now" class="btn-buy btn btn-lg btn-primary mt10" data-toggle="modal" onclick="add_fb_cart()">
					Đặt hàng ngay<br/>
					<span>(Tư vấn miễn phí, không mua không sao)</span>
				</a>
				<a   rel="nofollow"  href="javascript: instalment('<?php echo FSRoute::_('index.php?module=products&view=instalment'); ?>')" class="btn-tragop btn btn-lg btn-primary mt10" data-toggle="modal">
					Trả góp lãi suất 0%<br/>
					<span>(Xét duyệt qua điện thoại)</span>
				</a>
			</aside>
			<aside class="buycall hidden-xs">
				<?php echo $config['thoi_gian_lam_viec']?>
				<div class="onlinesupport mt20">
					<?php //echo $tmpl -> load_direct_blocks('onlinesupport',array('style'=>'default')); ?>
				</div>
				<div class="_infocomes">
					<?php  //echo $config['advice_description']?>
				</div>
			</aside>
		</div>
	</section>
	<section class="contentdetail " >
		<div class="_boxright" id="characteristic">
			<div class="_highlights  hidden-xs">
				<h3 >Đặc điểm nổi bật: <?php echo $data->name; ?></h3>
				<div class="label-content">
					<?php include_once 'progress_bar_images_plus.php'; ?>
				</div>
			</div>
			<?php if($cat->is_service != 1 && $cat->is_accessories != 1){?>
				<div class="_characteristic">
					<h3> Thông số kỹ thuật</h3>
 	 				<?php include_once 'default_characteristic.php'; ?>
				</div>
			<?php } ?>
		</div>
		<div id="boxvideo" class="_boxvideo hidden-md  clearfix">
			<h3 >Video về sản phẩm: <?php echo $data->name; ?></h3>
			<div class="_left">
				<?php echo $data -> video;?>
			</div>
			<div class="_right">
				<?php echo  $data -> video_second;?>

			</div>
		</div>

        
		<div class="boxdesc" id="boxdesc">
			<div id="box_conten_linfo">
			<?php echo $data->description?>
            </div>



			<?php include_once 'default_tags.php'; ?>
		</div>
		<div class="wrap_end " id="boxcomment">
			<aside class="left_comment col-sm-8">
				<?php include_once("comments/default.php");?>
			</aside>
            <aside class="right_splindo col-sm-4  hidden-sm hidden-xs">

<?php
		//print_r($new_products_right);

?>
<h6>Sản phẩm mới</h6>
<?php if($new_products_right && count($new_products_right)){?>
<ul class="relate_products  clearfix">
	<?php foreach($new_products_right as $item){ ?>
		<?php $link     = FSRoute::_('index.php?module=products&view=product&code='.$item -> alias.'&id='.$item -> id.'&ccode='.$item->category_alias);?>

			<li class="item">
				<div class="row _content">
					<div class="col-sm-4">
                     <a rel="nofollow" href="<?php echo $link; ?>" title = "<?php echo $item -> name ; ?>" >
                		<img class="img-responsive center-block" src="<?php echo URL_ROOT.str_replace('/original/', '/resized/', $item->image); ?>" alt="<?php echo htmlspecialchars ($item -> name); ?>"  />
                    </a>
                    </div>
                    <div class="col-sm-8">
                		<h4> <a rel="nofollow" href="<?php echo $link; ?>" title = "<?php echo $item -> name ; ?>" ><?php echo get_word_by_length(80,$item -> name); ?></a></h4>
                		<p class="_price"><strong><?php echo format_money($item ->price,'đ')?></strong></p>
	                </div>

				</div>

             </li>
	<?php }?>
</ul>
<?php } ?>

<h6>Sản phẩm bán chạy</h6>

<?php if($hot_products_right && count($hot_products_right)){?>
<ul class="relate_products  clearfix">
	<?php foreach($hot_products_right as $item){ ?>
		<?php $link     = FSRoute::_('index.php?module=products&view=product&code='.$item -> alias.'&id='.$item -> id.'&ccode='.$item->category_alias);?>
	<li class="item">
				<div class="row _content">
					<div class="col-sm-4">
                     <a rel="nofollow" href="<?php echo $link; ?>" title = "<?php echo $item -> name ; ?>" >
                		<img class="img-responsive center-block" src="<?php echo URL_ROOT.str_replace('/original/', '/resized/', $item->image); ?>" alt="<?php echo htmlspecialchars ($item -> name); ?>"  />
                    </a>
                    </div>
                    <div class="col-sm-8">
                		<h4> <a rel="nofollow" href="<?php echo $link; ?>" title = "<?php echo $item -> name ; ?>" ><?php echo get_word_by_length(80,$item -> name); ?></a></h4>
                		<p class="_price"><strong><?php echo format_money($item ->price,'đ')?></strong></p>
	                </div>

				</div>

             </li>

	<?php }?>
</ul>
<?php } ?>
            </aside>
		</div>
	</section>
</div>


 <!-- Modal HTML -->
    <div id="modal_buy_now" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
	               	 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><span>Đặt hàng ngay - thông tin đặt hàng</span></h4>
                </div>
                <div class="modal-body">
                	<form action="" name="eshopcart_info" method="post" id="eshopcart_info" >
	                	<div class="row">
		                   <div class=" col-modal-l col-lg-6 col-md-6 col-sm-6 col-xs-12">
		                   		<div class="media-box">
		                   			<div class="pull-left">
			                   			<div class="media-img " >
											<img class="img-responsive " src="<?php echo URL_ROOT.str_replace('/original/','/resized/', $data -> image); ?>" alt="<?php echo $data->name;?>">
										</div>
										<span class='price_modal'>
										  <?php echo format_money($price,'đ'); ?>
									   	</span>
									</div>
									<div class="media-body">
										<span><?php echo $data->name;?></span>
										<?php if(count($price_by_memory)){?>
										   			<select class="boxmemory"   name="memory"  onchange="load_quick(this)">
										   				<option value="0"  data-price="0"  data-type="memory">Bộ nhớ sản phẩm</option>
														<?php 	foreach ($price_by_memory as $item){?>
															<option value="<?php echo $item->id ?>" data-price="<?php echo ($item -> price)?$item -> price:0;?>" data-type="memory"><?php echo $item -> memory_name;?></option>
														<?php }	?>
													</select>
										<?php }?>
										<?php if(count($price_by_color)){?>
	                                        <select class="boxcolor" name="color"  onchange="load_quick(this);">
	                                            <option value="0" data-price="0" data-type="color">Chọn màu khác </option>
	                                            <?php foreach ($price_by_color as $item){?>
	                                                <option value="<?php echo $item->id ?>"  data-price="<?php echo ($item -> price)?$item -> price:0;?>" data-type="color" ><?php echo $item -> color_name;?></option>
	                                            <?php }?>
	                                        </select>
	                                    <?php }?>
										<?php if(count($price_by_warranty)){?>
									   			<select class="boxwarranty" name="warranty" onchange="load_quick(this);">
									   				<option value="0"  data-price="0" data-type="warranty" >Chế độ bảo hành</option>
													<?php foreach ($price_by_warranty as $item){?>
														<option value="<?php echo $item->id ?>" data-price="<?php echo ($item -> price)?$item -> price:0;?>" data-type="warranty"  ><?php echo $item -> warranty_name?></option>
													<?php }	?>
												</select>
										<?php }?>
											<?php if(count($price_by_origin)){?>
									   			<select class="boxorigin" name="origin" onchange="load_quick(this);">
									   				<option value="0"  data-price="0" data-type="origin" >Nguốn gốc</option>
													<?php foreach ($price_by_origin as $item){?>
														<option value="<?php echo $item->id ?>" data-price="<?php echo ($item -> price)?$item -> price:0;?>" data-type="origin"  ><?php echo $item -> origin_name?></option>
													<?php }	?>
												</select>
										<?php }?>
										<?php if(count($price_by_species)){?>
									   			<select class="boxsspecies" name="species"  onchange="load_quick(this);">
									   				<option value="0"  data-price="0" data-type="species" >Ram</option>
													<?php foreach ($price_by_species as $item){?>
														<option value="<?php echo $item->id ?>" data-price="<?php echo ($item -> price)?$item -> price:0;?>" data-type="species"  ><?php echo $item -> species_name?></option>
													<?php }	?>
												</select>
										<?php }?>
										<div>
											<strong>Số lượng</strong>
											<input class="quantity_modal" type="text" name="quantity" value="1" id="quantity_modal">
										</div>

									</div>
									<div class="clear"></div>
		                   		</div>
		                   		<div class="check-square mt10">Nhận giao hàng trong <strong>60 phút</strong> tại <strong>TP.Hà Nội</strong> <?php $data ->warranty  ?></div>
								<div class="check-square mt10">Giao hàng <strong>tận nơi</strong>, hài lòng thanh toán</div>
								<div class="check-square mt10">Bảo hành <strong><?php $data ->warranty  ?></strong></div>
								<div class="mt10">Mọi thắc mắc xin vui lòng liên hệ theo số máy <strong style="color: #E31010;"> <?php echo $config['hotline']?></strong> để biết thêm chi tiết.</div>
		                   </div>
		                   <div class=" col-modal-r col-lg-6 col-md-6 col-sm-6 col-xs-12">
		                   		<table width="100%" border="0" cellpadding="5">
								  <tr>
									<td >
										<div class="body-td">
											<span> Họ và tên<font color="#FF0000"> (*)</font>: </span>
											<input type="text" name="sender_name" id="sender_name"  value="<?php echo $sender_name; ?>" class="input_text" />
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<div class="body-td">
											<span>Điện thoại <font color="#FF0000"> (*)</font></span>
											<input type="text" name="sender_telephone" id="sender_telephone"  value="<?php echo $sender_telephone; ?>" class="input_text" />
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<div class="body-td">
											<span>&#272;&#7883;a ch&#7881;<font color="#FF0000"> (*)</font>:</span>
											<input type="text" name="sender_address" id="sender_address"  value="<?php echo $sender_address; ?>" class="input_text" />
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<div class="body-td">
											<span> Email<font color="#FF0000"> (*)</font>: </span>
											<input type="text" name="sender_email"  id="sender_email"  value="<?php echo $sender_email; ?>" class="input_text" />
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<div class="body-td">
											<span>Thời gian nhận hàng  <font color="#FF0000"> (*)</font></span>
											<input type="text" name="received_time"  id="received_time"  value="" class="input_text"/>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<font color="#FF0000"> Lưu ý: (*) Thông tin bắt buộc phải điền</font>
									</td>
								  </tr>
								  <tr>
								  <tr>
									<td>
										<a rel="nofollow" class="btn btn-default" href="javascript: void(0)" id='submitbt'>
											<span><?php echo FSText::_('Đặt hàng'); ?></span>
										</a>
										<a  rel="nofollow" class="btn reset-default" href="javascript: void(0)" id='resetbt'>
											<span><?php echo FSText::_('Nhập lại'); ?></span>
										</a>
									</td>
								  </tr>
						   		</table>
						   		<input type="hidden" name='id' value="<?php echo $data->id;?>" />
						   		<input type="hidden" name='price' value="<?php echo $price;?>" />
						   		<input type="hidden" name='price_old' value="<?php echo $data->price_old;?>" />
					   			<input type="hidden" name='module' value="products" />
								<input type="hidden" name='view' value="cart" />
								<input type="hidden" name='task' value="eshopcart2_save" id = 'task'/>
		                   </div>
	                	</div>

	                </form>
                </div>
            </div>
        </div>
    </div>
<input type="hidden" value="0" id='memory_curent'  />
<input type="hidden" value="0" id='color_curent'  />
<input type="hidden" value="0" id='warranty_curent'  />
<input type="hidden" value="0" id='origin_curent'  />
<input type="hidden" value="0" id='species_curent'  />
<input type="hidden" value="<?php echo $price;  ?>" id='basic_price'  />
<input type="hidden" value="<?php echo $data->id; ?>" name='product_id' id='product_id'  />


<script src="http://msmobile.com.vn/templates/default/js/readmore.min.js"></script>



<script type="text/jscript">
$('#box_conten_linfo').readmore({
  speed: 75,
  moreLink: '<p class="xem_linfo"><a class="xvgfdkhg" href="#">Xem thêm chi tiết <?php echo $data->name; ?> <i class="fa fa-chevron-down" aria-hidden="true"></i></a></p>',
  lessLink: '<p class="xem_linfo"><a class="dbfhdgf" href="#">Thu gọn đánh giá chi tiết <i class="fa fa-chevron-up" aria-hidden="true"></i></a></p>',
  collapsedHeight: 800,
});

$('#commem_lindo').readmore({
  speed: 75,
  moreLink: '<p class="xem_linfo"><a class="xvgfdkhg" href="#">Xem thêm bình luận <i class="fa fa-chevron-down" aria-hidden="true"></i></a></p>',
  lessLink: '<p class="xem_linfo"><a class="dbfhdgf" href="#">Thu gọn bình luận <i class="fa fa-chevron-up" aria-hidden="true"></i></a></p>',
  collapsedHeight: 640,
});


</script>
