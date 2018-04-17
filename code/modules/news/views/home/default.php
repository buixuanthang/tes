<?php
	global $tmpl;
	$tmpl -> addStylesheet('home','modules/news/assets/css');
//	$tmpl -> addScript('cat','modules/news/assets/js');	
	$total_news_list = count($list);
    $Itemid = 7;
	FSFactory::include_class('fsstring');	
?>	
<div class="news_home news_page page_main">
	<h1 class="img-title-cat page_title">
      <span><?php echo FSText::_('Tin tức'); ?></span>
    </h1>

<div class="bg_white">

      <?php if($total_news_list){?>
        	<?php include 'default_header.php'; ?>

          <?php include 'default_list_cate.php'; ?>


          <?php if($tmpl->count_block('bootom-cat-news')) {?>
     
              <?php  echo $tmpl -> load_position('bootom-cat-news', 'XHTML'); ?>

          <?php }?>



       <?php }else{?>
       	<div><?php echo FSText::_('Không có bài viết nào'); ?></div>
       <?php }?>
</div>
