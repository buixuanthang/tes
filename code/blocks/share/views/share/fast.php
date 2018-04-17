<?php global $tmpl,$config;?>
<?php $tmpl -> addStylesheet('fast','blocks/share/assets/css'); ?>

<?php global $tmpl,$config;?>
<div class="share_fast">
	<?php if(isset($config['facebook']) && !empty($config['facebook'])){?>
		<a class="facebook-icon" href="<?php echo $config['facebook']; ?>"  title="Link youtube" rel="nofollow" target="_blink">
			<i class="fa fa-facebook"></i>
		</a>	
	<?php }?>
	<?php if(isset($config['googleplus']) && !empty($config['googleplus'])){?>
		<a class="googleplus-icon" href="<?php echo $config['googleplus']; ?>"  title="Link googleplus" rel="nofollow" target="_blink">
			<i class="fa fa-google-plus"></i>
		</a>	
	<?php }?>
	<?php if(isset($config['twitter']) && !empty($config['twitter'])){?>
		<a class="twitter-icon" href="<?php echo $config['twitter']; ?>"  title="Link twitter" rel="nofollow" target="_blink">
			<i class="fa fa-twitter"></i>
		</a>
	<?php }?>
	<?php if(isset($config['youtube']) && !empty($config['youtube'])){?>
		<a class="youtube-icon" href="<?php echo $config['youtube']; ?>"  title="Link youtube" rel="nofollow" target="_blink">
			<i class="fa fa-youtube"></i>
		</a>	
	<?php }?>
	<div class="clear"></div>
</div>
			
