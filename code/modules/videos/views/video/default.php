<?php  	global $tmpl;
$tmpl -> addStylesheet('videos','modules/videos/assets/css');
$tmpl -> addStylesheet('video','modules/videos/assets/css');
$tmpl -> addScript('normal','modules/videos/assets/js');

// $tmpl -> addScript('jwplayer','libraries/jquery/jwplayer-7.4.3','top');
// $tmpl -> addScript('video','modules/videos/assets/js','top');

//$tmpl -> addScript('form');
//$tmpl -> addScript('main');
//$tmpl -> addScript('news_detail','modules/videos/assets/js');

$print = FSInput::get('print',0);
?>
<div class="video_detail">	
	<h1 class='content_title'>
		<?php	echo $data -> title; ?>
	</h1>
	
    <?php include_once 'default_video.php'; ?>
    <div class="description">
    	<?php	echo $data -> summary; ?>
    </div>
    
<?php include  'default_share.php'; ?>
	<?php include_once 'default_related.php'; ?>
			
	
	
</div>