<?php
	global $tmpl;
	$tmpl -> addStylesheet('default_cat','modules/news/assets/css');
//	$tmpl -> addScript('cat','modules/news/assets/js');	
	$total_news_list = count($list);
    $Itemid = 7;
	FSFactory::include_class('fsstring');	
?>	
<div class="news_home news_cat news_page">
	<h1 class="img-title-cat page_title">
      <span><?php echo $cat -> name; ?></span>
    </h1>
    
    <div class="bg_white">
          <?php if($total_news_list){?>
              <?php include 'default_header.php'; ?>
          <?php }else{?>
            <div>Không có bài viết nào</div>
          <?php }?>
          <?php 
            if($pagination) echo $pagination->showPagination(3);
          ?>
     </div>
</div>

