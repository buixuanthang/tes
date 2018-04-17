<?php  	global $tmpl;
$tmpl -> addStylesheet('detail','modules/contents/assets/css');
//$tmpl -> addScript('detail','modules/contents/assets/js');
FSFactory::include_class('fsstring');

$print = FSInput::get('print',0);
?>
<div class="content_detail wapper-page wapper-page-detail">
		<h1 class='content_title'>
			<span><?php	echo $data -> title; ?></span>
		</h1>
		<!-- end CONTENT NAME-->
		<!-- SUMMARY -->
			<div class="summary"><?php echo $data -> summary; ?></div>
		<div class='description'>
			<?php   echo $data -> content; ?>
		</div>

</div>