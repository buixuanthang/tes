<?php 
$class = '';
$total =count($relate_news);
if($total){
	echo '<h3 class="titleld">Bài viết liên quan:</h3>
	<div id="carousel_lindo" class="relate_contentss boxrelate ">';
	?>
					<?php 	foreach ($relate_news as $new){?>
        			<?php $class = '';?>
	                		<?php $link = FSRoute::_("index.php?module=news&view=news&id=".$new->id."&code=".$new->alias."&ccode=".$new-> category_alias);?>
	                		<?php $w140h105 = URL_ROOT.str_replace('/original/', '/small/',$new -> image);?>
	                			<div class="media-box clearfix">
		                			<a rel="nofollow" href="<?php echo $link; ?>"><img  alt="<?php echo $new->title?>" src="<?php echo $w140h105; ?>"  /></a>
								  	<div class="media-body">
										<h4 class="media-heading">
											<a rel="nofollow" href="<?php echo $link; ?>" title="<?php echo $new->title?>"><?php echo get_word_by_length(60,$new->title);?></a>
										</h4>
                                        <!--
										<p><?php // echo get_word_by_length(60,$new->summary);?></p>
                                        -->
									</div>
								</div>
            	<?php }?>
	   <?php echo '</div>
	  
	 
	   
	   ';?>             	
<?php } ?>