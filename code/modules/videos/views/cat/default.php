	<?php 
	global $tmpl; 
	$tmpl -> addStylesheet('home','modules/'.$this -> module.'/assets/css');
	// $tmpl -> addScript('cat','modules/'.$this -> module.'/assets/js');
	?>
<div class='videos-grid'>
	<h1 class="page_title"><?php echo $cat -> name; ?></h1>
	<?php include_once 'default_list.php';?>
</div>

