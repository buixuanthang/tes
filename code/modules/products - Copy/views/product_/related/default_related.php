<?php $tmpl -> addStylesheet('related','modules/'.$this -> module.'/assets/css');?>
<?php
$i = 0;$cols=4;
$total_relate = count($list_related);
$class = '';
?>
<?php if($list_related && count($list_related)){?>
<ul id="lindo_list_related" class="relate_products  clearfix">
	<?php foreach($list_related as $item){ ?>
		<?php $link     = FSRoute::_('index.php?module=products&view=product&code='.$item -> alias.'&id='.$item -> id.'&ccode='.$item->category_alias);?>
	
			<li class="item">
				<div class="_content">
					 <a rel="nofollow" href="<?php echo $link; ?>" title = "<?php echo $item -> name ; ?>" >
                		<img class="img-responsive" src="<?php echo URL_ROOT.str_replace('/original/', '/resized/', $item->image); ?>" alt="<?php echo htmlspecialchars ($item -> name); ?>"  />
                		<h4><?php echo get_word_by_length(80,$item -> name); ?></h4>
                		<strong><?php echo format_money($item ->price,'đ')?></strong>
	                </a>
	      		<a rel="nofollow" href="<?php echo $link; ?>" class="viewdetail">Xem chi tiết</a>
				</div>
               
             </li>  
        
		    <?php $i++?>
	<?php }//end: foreach($list as $item) ?>
</ul>
<?php } ?>
