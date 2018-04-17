<?php  	global $tmpl;
$tmpl -> addStylesheet('detail','modules/news/assets/css');
// $tmpl -> addScript('form');
// $tmpl -> addScript('main');
// $tmpl -> addScript('detail','modules/news/assets/js');
FSFactory::include_class('fsstring');

$print = FSInput::get('print',0);
?>
<div class="news_detail" itemscope itemtype="http://schema.org/NewsArticle">
	<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="https://google.com/article"/>
	
	<!-- NEWS NAME-->	
	<h1 class='title' itemprop="headline">
		<?php	echo $data -> name; ?>
	</h1>
	
	
	<?php //include_once 'default_share.php'; ?>
	<!-- end NEWS NAME-->
			
	<!-- DATETIME -->
	<div class="time_rate cls">
		
		<span class='news_time'  itemprop="datePublished"><?php echo date('d/m/Y',strtotime($data -> created_time)); ?> </span>
		<font>-</font>
		
		 <meta itemprop="dateModified" content="<?php echo date('d/m/Y',strtotime($data -> created_time)); ?>"/>
	</div>
	
	<!-- end DATETIME-->
	<figure  class="image hide"  itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
		<img src="<?php echo URL_ROOT.str_replace('/original/','/large/', $data->image); ?>" alt="<?php echo htmlspecialchars(@$data->name); ?>"  itemprop="image" />
		<meta itemprop="url" content="<?php echo URL_ROOT.str_replace('/original/','/large/', $data->image); ?>">
		<meta itemprop="width" content="480">
    	<meta itemprop="height" content="200">
		</a>
	</figure>
								
		<!-- SUMMARY -->
	
		<div class="summary"  itemprop="description"><?php echo $data -> summary; ?></div>
	
	
	
	<div class='description' itemprop="articleBody">
	
		<?php 
			// insert quảng cáo
			
				echo $data -> content;
			
		?>
	</div>
	<div itemprop="author" itemscope itemtype="https://schema.org/Person" class="hiden">
    	By <span itemprop="name"><?php echo URL_ROOT; ?></span>
	  </div>
	  <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization" class="hiden">
	  	<?php global $config; ?>
	    <div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
	      <img src="<?php echo URL_ROOT.$config['logo']?>" title="<?php echo URL_ROOT; ?>"/>
	      <meta itemprop="url" content="<?php echo URL_ROOT.$config['logo']?>">
	      <meta itemprop="width" content="209">
	      <meta itemprop="height" content="61">
	    </div>
	    <meta itemprop="name" content="<?php echo URL_ROOT; ?>">
     </div>			
	                	
	<br />
	
	
	
		
	<?php include_once 'default_related.php'; ?>
	
			
	<!-- COMMENT	-->
	<?php
//		if($category -> display_comment){
//				include 'comments/comments_tree.php'; 
//		}
	?>
	
</div>