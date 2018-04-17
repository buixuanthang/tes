<?php if($data -> file_flash) { ?>
	<?php $video = str_replace('/watch?v=', '/embed/', $data -> file_flash);?>
		<div class="video_item" id="one_video_play_area">
			<div class="video_item_inner video_item_inner_has_img">
	    		<img  class="video" src='<?php echo URL_ROOT.str_replace('/original/','/large/', $data -> image); ?>' alt='<?php echo $data->title;?>' link-video="<?php echo $video;?>"  />
	    		<div class="video-name">
		    		<div class="video-name-inner">
	    				<?php echo $data -> title; ?>
	    			</div>
	    		</div>
    		</div>
    	</div>


<?php }?>