<?php  	global $tmpl;
$tmpl -> addStylesheet('detail_amp','modules/news/assets/css');
FSFactory::include_class('fsstring');

$print = FSInput::get('print',0);
?>
<div class="news_detail" itemscope itemtype="http://schema.org/NewsArticle">
	<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="https://google.com/article"/>
	
	<!-- NEWS NAME-->	
	<h1 class='title' itemprop="headline">
		<?php	echo $data -> title; ?>
	</h1>
	
	
	<?php //include_once 'default_share.php'; ?>
	<!-- end NEWS NAME-->
			
	<!-- DATETIME -->
	<div class="time_rate cls">
		 <?php  include 'default_base_rated_fixed.php'; ?>
		<span class='news_time'  itemprop="datePublished"><?php echo date('d/m/Y',strtotime($data -> created_time)); ?> </span>
		<span>-</span>
		<span class="new_category" itemprop="articleSection"><?php	echo $category->name; ?></span>
		 <meta itemprop="dateModified" content="<?php echo date('d/m/Y',strtotime($data -> created_time)); ?>"/>
	</div>
	
								
		<!-- SUMMARY -->
	<?php if($category -> display_summary){?>
		<div class="summary"  itemprop="description"><?php echo $data -> summary; ?></div>
	<?php }?>
	<?php if(count($relate_news_list_by_tags)){?>
	<div class='relate_t'>
		<?php $i = 0;?>
		<?php foreach($relate_news_list_by_tags as $item){?>
			<?php $link_news = FSRoute::_("index.php?module=news&view=news&code=".$item->alias."&id=".$item -> id."&ccode=".$item -> category_alias); ?>
			<h2 class="relate_item">
				<a href="<?php echo $link_news; ?>" title="<?php echo htmlspecialchars($item -> title); ?>"><?php echo $item -> title; ?></a>
			</h2>
			<?php $i++;?>
			<?php if($i > 2) break;?>
		<?php }?>
			
	</div>
	<?php }?>
	<div class='description' itemprop="articleBody">
		<?php 
		$description = preg_replace ( '#style\=\"(.*?)\"#is', '', $description );
		$description = preg_replace ( '#style\=\'(.*?)\'#is', '', $description );
		$description = preg_replace ( '#<style>(.*?)</style>#is', '', $description );
		$description = preg_replace ( '#layout\=\"(.*?)\"#is', '', $description );
		$description = preg_replace ( '# h\=\"(.*?)\"#is', '', $description );
		$description = preg_replace ( '# w\=\"(.*?)\"#is', '', $description );
		$description = preg_replace ( '#photoid\=\"(.*?)\"#is', '', $description );
		$description = preg_replace ( '#rel\=\"(.*?)\"#is', '', $description );
		$description = preg_replace ( '#type\=\"(.*?)\"#is', '', $description );
		
		
	
		$description = preg_replace ( '#onclick\=\"(.*?)\"#is', '', $description );
		$description = preg_replace ( '#onclick\=\'(.*?)\'#is', '', $description );
		$description = preg_replace ( '#onmouseover\=\"(.*?)\"#is', '', $description );
		$description = preg_replace ( '#onmouseover\=\'(.*?)\'#is', '', $description );
		
		$description = str_replace('<font','<span',$description);
		$description = str_replace('</font','</span',$description);

		$description = $this -> amp_add_size_into_img($description);
		$description = str_replace('<img','<amp-img  layout="responsive"',$description);
		$description = str_replace('</img','</amp-img',$description);
		
		$description = str_replace('<iframe','<amp-iframe layout="responsive" sandbox="allow-scripts allow-same-origin allow-popups" ',$description);
		$description = str_replace('</iframe','</amp-iframe',$description);


		?>
		<?php   echo $description; ?>
	</div>
	<div itemprop="author" itemscope itemtype="https://schema.org/Person" class="hiden">
    	By <span itemprop="name"><?php echo URL_ROOT; ?></span>
	  </div>
	  <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization" class="hiden">
	  	<?php global $config; ?>
	    <div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
	      <amp-img src="<?php echo URL_ROOT.$config['logo']?>" title="<?php echo URL_ROOT; ?>" width="134" height="84" />
	      <meta itemprop="url" content="<?php echo URL_ROOT.$config['logo']?>">
	      <meta itemprop="width" content="209">
	      <meta itemprop="height" content="61">
	    </div>
	    <meta itemprop="name" content="<?php echo URL_ROOT; ?>">
     </div>			
	                	
	<br />
	
	<!--	SHARE BOTTOM-->
		<?php // include_once 'default_share_bottom.php'; ?>
	
	<!--	TAGS	-->
		<?php include_once 'default_tags.php'; ?>

	<!--	RELATED	-->
	<?php include_once 'default_related.php'; ?>
	<input type="hidden" value="<?php echo $data->id; ?>" name='news_id' id='news_id'  />
			
	<!-- COMMENT	-->
	<?php
//		if($category -> display_comment){
//				include 'comments/comments_tree.php'; 
//		}
	?>
	
</div>