	<?php 
	global $tmpl; 
	$tmpl -> addStylesheet('products');
	$tmpl -> addStylesheet('projects','modules/projects/assets/css');
	$tmpl -> addStylesheet('search','modules/'.$this -> module.'/assets/css');
	
//	$tmpl -> addScript('follow');

	?>
<div class="products-cat">
	<div class="field_title">
		<div  class="title-name">
			
			<h1 class="page_title"><span>Tìm kiếm với từ khóa: <font >"<?php echo $keyword;?>"</font></span>
</h1>
		</div>
			
		<div class="clear"></div>
	</div>
	<?php // if(!count($products) && !count($news_list) && !count($projects)){?>
	<?php if(!count($products) && !count($news_list)){?>
		<h2>Không tìm thấy kết quả theo từ khóa tìm kiếm</h2>
	<?php  }else{  ?>

	<div class="clear"></div>
	<?php include_once 'products.php';?>		
	<div class="clear"></div>
	<?php include_once 'projects.php';?>	
	<div class="clear"></div>
	<?php include_once 'news.php';?>		
	
	<?php } ?>
	
</div>

