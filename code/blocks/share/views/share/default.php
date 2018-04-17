<?php
global $tmpl,$config; 
?>	
<div class="share_icon">
	<?php if(isset($config['facebook']) && !empty($config['facebook'])){?>
		<a href="<?php echo $config['facebook']; ?>"  title="Link facebook" rel="nofollow" target="_blink"><img alt="link facebook" src="<?=URL_ROOT;?>/blocks/share/assets/images/facebook_icon2.png" /></a>	
	<?php }?>
	<?php if(isset($config['googleplus']) && !empty($config['googleplus'])){?>
		<a href="<?php echo $config['googleplus']; ?>"  title="Link googleplus" rel="nofollow" target="_blink"><img alt="link googleplus" src="<?=URL_ROOT;?>/blocks/share/assets/images/googleplus_icon2.png" /></a>	
	<?php }?>
	<?php if(isset($config['twitter']) && !empty($config['twitter'])){?>
		<a href="<?php echo $config['twitter']; ?>"  title="Link twitter" rel="nofollow" target="_blink"><img alt="link twitter" src="<?=URL_ROOT;?>/blocks/share/assets/images/twitter_icon2.png" /></a>	
	<?php }?>
	<div class='clear'></div>
</div>
