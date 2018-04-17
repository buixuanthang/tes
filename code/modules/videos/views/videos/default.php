<?php 
    global $tmpl;
	$tmpl -> addStylesheet("video","modules/libraries/assets/css");
	$tmpl -> addScript('video','modules/libraries/assets/js');
    $tmpl -> addScript('jwplayer','libraries/jquery/jwplayer_6.8');
    FSFactory::include_class('fsstring');
    $total = count($list);
?>
<?php 
    $i=1;
    foreach($list as $item){
       $i++; 
?>
<div class="content-video"> 
    <embed height="592px"; width="100%"; flashvars="skin=<?php echo $item->image; ?>&amp;file=<?php echo $item->file_flash; ?>&amp;image="" wmode="transparent" allowfullscreen="true" quality="high" name="playlist" id="playlist" style="undefined" src="/libraries/jquery/jwplayer/mediaplayer.swf" type="application/x-shockwave-flash">
    <div class="clear"></div>
    <span><?php echo $item->title;?></span>
</div>	
<div class="clear"></div>
<?php }?>
<div class="video_detail">
    <div class="wapper-content-page">
		<?php 
            $i=1;
            foreach($list as $item){
                $link =  FSRoute::_('index.php?module=libraries&view=video&task=default_detail&id='.$item->id.'&Itemid');
        ?>
    		<div class='cat-item <?php echo $class;?> <?php echo($i%3==0)?'row1':''?>'>
				<a class='item-img' href="#">
					<img src="<?php echo URL_ROOT.str_replace('/original/','/resized/', $item->image); ?>" alt="<?php echo htmlspecialchars(@$item->title); ?>" width="240" height="135"/>
				</a>
				<h2 class="cat_title"><a href="#" title="<?php echo htmlspecialchars(@$item->title); ?>"><?php echo htmlspecialchars(@$item->title); ?></a></h2>
				<p class="cat_datetime">Ngày đăng: <?php echo date('d/m/Y',strtotime($item -> created_time)); ?></p>
    		</div>
		<?php }?>
		<div class='clear'></div>
	</div>	
</div>  