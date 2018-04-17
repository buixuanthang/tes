<?php
global $tmpl; 
$tmpl -> addStylesheet('thosuadidong','blocks/newslist/assets/css');
?>
<?php $link_cate = FSRoute::_('index.php?module=news&view=home'); ?>
<div class="news-top-block">
	<span class="text"><i class="fa fa-file-text news-icon"></i>Thông tin hữu ích</span>
	<a href="<?php echo $link_cate ?>">Xem tất cả <span><i class="fa fa-angle-right"></i></span></a>
</div>

<?php 		
$Itemid = 4;
    for($i = 0; $i < count($list1); $i++ ){
	$item = $list[$i];
	$link = FSRoute::_("index.php?module=news&view=news&id=".$item->id."&code=".$item->alias."&ccode=".$item-> category_alias."&Itemid=$Itemid");			
?>
<div class="body-list-news ">
	<div class="left">
		<div class="img">
			<a href=""><img src='<?php echo URL_ROOT.$item -> image?>' alt="<?php echo $item -> title?>" width="370" height="208"></a>
		</div>
		<div class="content">
			<h3 class="title"><?php echo $item->title;?></h3>
			<i class="fa fa-clock-o"></i> <span><?php echo $item->created_time;?></span><br><br>
			<p><?php echo get_word_by_length(100,$item->summary);?></p>
			<button type="">XEM THÊM ></button>
		</div>
	</div>
<?php } ?> 



	<div class="right">
		<ul>
			<?php 		
			$Itemid = 4;
			    for($i = 0; $i < count($list); $i++ ){
				$item = $list[$i];
				$link = FSRoute::_("index.php?module=news&view=news&id=".$item->id."&code=".$item->alias."&ccode=".$item-> category_alias."&Itemid=$Itemid");			
			?>
			<li><?php echo get_word_by_length(50,$item->summary);?></li>
			<?php } ?> 

		</ul>
	</div>


</div>
