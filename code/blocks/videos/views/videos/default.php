 <?php
global $tmpl; 
$tmpl -> addStylesheet("one","blocks/videos/assets/css");
$tmpl -> addScript("videos","blocks/videos/assets/js");
?>
<?php 
echo"<pre>";
print_r($list);
echo"</pre>";
 ?>
<div class="videos_block_body block_body cls">
	<?php foreach($list as $item){?>
		<?php if(!$item -> file_flash) continue;?>
		<?php $video = str_replace('/watch?v=', '/embed/', $item -> file_flash);?>
		<div class="video_item">
			<div class="video_item_inner video_item_inner_has_img">
	    		<img  class="video lazy" data-src='<?php echo URL_ROOT.str_replace('/original/','/resized/', $item -> image); ?>' alt='<?php echo $item->title;?>' link-video="<?php echo $video;?>" />
	    		<div class="video-name">
		    		<div class="video-name-inner">
	    				<?php echo $item -> title; ?>
	    			</div>
	    		</div>
    		</div>
    	</div>
	<?php  } ?>
</div>
