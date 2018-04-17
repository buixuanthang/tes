<div class="tab">
  <button class="tablinks tab-boder" onclick="openCity(event, 'London')" id="defaultOpen"><span><i class="fa fas fa-list icon"></i></span><span class="text">MÔ TẢ</span></button>
  <button class="tablinks tab-boder" onclick="openCity(event, 'Paris')"><span><i class="fa fa-shield icon"></i></span><span class="text">CHÍNH SÁCH BẢO HÀNH</span></button>
  <button class="tablinks" onclick="openCity(event, 'Tokyo')"><span><i class="fa fa-gift icon"></i></span><span class="text">KHUYẾN MÃI</span></button>
</div>

<div id="London" class="tabcontent">
  <?php echo $description;?>
</div>

<div id="Paris" class="tabcontent">
  	<?php echo $config['warranty'] ?>
</div>

<div id="Tokyo" class="tabcontent">
  <?php echo $config['promotion_content'] ?>
</div>

<br>
<div id="prodetails_tab3" class="prodetails_tab">
	<div class='tab_content_right'>
		<?php 	include 'plugins/comments/controllers/comments.php'; ?>
		<?php $pcomment = new CommentsPControllersComments(); ?>
		<?php		$pcomment->display($data); ?>
		<?php 	include 'default_comments_fb.php'; ?>
	</div>
</div>
<br>
<div id="prodetails_tab4" class="prodetails_tab">
	<?php 	
	$title_relate =  FSText::_('Dịch vụ tương tự');
	$relate_type = 3;
	$list_related = $products_same_price;
	include 'related/default_related.php';
	?>
</div>
<br>
<?php if($relate_news){?>
<div id="prodetails_tab50" class="prodetails_tab">
	<?php 	
	$title_relate =  'Bài viết liên quan';
	$relate_type = 3;
	$list_related = $products_same_price;
	include 'default_news_related.php';
	?>
</div>
<?php }?>