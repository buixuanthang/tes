 <?php
global $tmpl; 
$tmpl -> addStylesheet("thosuadidong","blocks/videos/assets/css");
$tmpl -> addScript("videos","blocks/videos/assets/js");
?>
<?php $link_cate = FSRoute::_('index.php?module=videos&view=home'); ?>
<div class="video-top-block">
	
	<span class="text"><i class="fa fa-youtube-play videos-icon"></i>THỢ SỬA DI ĐỘNG đang hot</span>
	<a href="<?php echo $link_cate ?>">Xem tất cả <span><i class="fa fa-angle-right"></i></span></a>
</div>
<div class="videos_block_body block_body cls pd">
	<?php $i=0; ?>
	<?php foreach($list as $item){?>
		<?php $i=$i+1; ?>
		<?php if(!$item -> file_flash) continue;?>
		<?php $video = str_replace('/watch?v=', '/embed/', $item -> file_flash);?>
		
		<div class="video-item" id="id_<?php echo $i;?>">
			<a href="<?php echo $video;?>">
			<i class="fa fa-play-circle-o"></i>
			<img width="266" height="158" class="thumb" src='<?php echo URL_ROOT.str_replace('/original/','/resized/', $item -> image); ?>' alt='<?php echo $item->title;?>' link-video="<?php echo $video;?>" /></a>
			<div class="info">
				<div class="img_info"><img src="<?php echo URL_ROOT.str_replace('/original/','/resized/', $item -> avatar)?>" alt="" width="50" height="58"></div>
				<div class="text-info">
					<p class="name"><?php echo $item->summary; ?></p>
					<p class="level">Kỹ thuật viên</p>
				</div>
			</div>
		</div>
		
	<?php  } ?>
</div>
