<?php  	global $tmpl;
	// $tmpl -> addScript('form');
	$tmpl -> addStylesheet('default_amp','plugins/comments/assets/css');

	// $tmpl -> addScript('default','plugins/comments/assets/js');
	$url = $_SERVER['REQUEST_URI'];
	$module = FSInput::get ( 'module' );
	$view = FSInput::get ( 'view' );
	$rid = FSInput::get ( 'id' );

	$return = base64_encode($url);
	
	$link_r = $_SERVER['REQUEST_URI'];
	$link_r = URL_ROOT.substr(str_replace('.amp','.html',$link_r),1).'#comment_add_form';


?>
<div class="tab-title cls">
	<div class="cat-title-main" id="tab-title-label">
		<i class="fa fa-commenting"></i>
		<span>Đánh giá - Bình luận</span>
	</div>
</div>

<div class='comments'>		
	<?php if(isset($comments) && count($comments)){ ?>
		<div class='tab_label_child'><span>Nhận xét đánh giá</span> 
		<?php if($data -> comments_published){?>
			<span class="statistic"> (có <?php echo $data -> comments_published; ?> bình luận và đánh giá)</span>
		<?php } ?>
		</div>
	<?php } ?>
	<div id="_info_comment" class="cls">
		<?php include 'comments_tree.php'; ?>

	</div>
	<?php 
	$link_r = $_SERVER['REQUEST_URI'];
	$link_r = URL_ROOT.substr(str_replace('.amp','.html',$link_r),1).'#comment_add_form';
	?>
	<div class="to-noamp"><a href="<?php echo $link_r; ?>">Bấm vào đây để Bình luận - Đánh giá</a></div>

		
</div>