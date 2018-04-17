<?php  	global $tmpl;
	$tmpl -> addScript('form');
	$tmpl -> addStylesheet('default','plugins/comments/assets/css');
	$tmpl -> addScript('default','plugins/comments/assets/js');
	$url = $_SERVER['REQUEST_URI'];
	$module = FSInput::get ( 'module' );
	$view = FSInput::get ( 'view' );
	$rid = FSInput::get ( 'id' );

	$return = base64_encode($url);



?>

<div class="tab-title" id="comments_title"><span><?php echo FSText::_('Đánh giá - Bình luận'); ?></span></div>

<div class='comments'>		
	<?php if(isset($comments) && count($comments)){ ?>
		<div class='tab_label_child'><span><?php echo FSText::_('Nhận xét đánh giá'); ?></span> 
		<?php if($data -> comments_published){?>
			<span class="statistic"> (<?php echo FSText::_('có'); ?> <?php echo $data -> comments_published; ?> <?php echo FSText::_('bình luận và đánh giá'); ?>)</span>
		<?php } ?>
		</div>
	<?php } ?>
	<div id="_info_comment" class="cls">
		<?php include 'comments_tree.php'; ?>

	</div>
	<?php include 'comments_form.php'; ?>

		
</div>