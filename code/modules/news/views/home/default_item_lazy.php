<?php 
		$news = $array_news[$cat->id];
		for($j = 0 ; $j < count($news); $j ++)
		{
			$item = $news[$j];
  			$link = FSRoute::_("index.php?module=news&view=news&id=".$item->id."&code=".$item->alias."&ccode=".$item-> category_alias);

			if($j<1){
				
			

?>
<div class="left-news-cate">
	<figure class='frame_img1'>
	<?php if($item->image){?>				
		<a class='item-img' href="<?php echo $link; ?>">
			<img  class="lazy" data-src="<?php echo URL_ROOT.str_replace('/original/','/large/', $item->image); ?>" alt="<?php echo htmlspecialchars(@$item->title); ?>" />
		</a>				
	<?php } ?>
	</figure>
	<figure class='frame_title1'>
		<h2  class="title" ><a href="<?php echo $link; ?>" title="<?php echo htmlspecialchars(@$item->title); ?>"><?php echo htmlspecialchars(@$item->title); ?></a></h2>
	    		<p class="created-time"><span><i class="fa fa-clock-o"></i></span>&nbsp<?php echo (@$item->created_time); ?>&nbsp&nbsp&nbsp&nbsp<span><i class="fa fa-comment-o"></i></span>&nbsp<?php echo (@$item->comments_total); ?></p>
	    		<p class="summary"><?php echo getWord(25,$item->summary);?></p>
	</figure>
</div>

<div  class="right-news-cate" >
<?php }else{

?>
<div class="new-one">
	<span><i class="fa fa-circle "></i></span>&nbsp&nbsp <a href="<?php echo $link; ?>"><?php echo getWord(14,$item->title);?></a>
</div>




<?php } ?>

<?php 
if($j > 3)			
break; 
}
?>
</div>