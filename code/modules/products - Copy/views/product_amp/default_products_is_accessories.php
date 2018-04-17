<?php 
if(!empty($accessories)){
?>
<div class="accessories_incentives">
	<label>Phụ kiện ưu đãi</label>
	<div class="advantage_content">
				
		<ul class="clearfix">
				<?php 
					foreach($accessories as $item) {
						
						$link = FSRoute::_('index.php?module=products&view=product&code='.$item -> alias.'&id='.$item -> id.'&ccode='.$item -> category_alias);
						
						?>	
					
			            <li class="item cls">
							 <a rel="nofollow" href="<?php echo $link; ?>" title = "<?php echo $item -> name ; ?>" class="img_a" >
		                			<amp-img class="img-responsive" src="<?php echo URL_ROOT.str_replace('/original/', '/small/', $item->image); ?>" alt="<?php echo htmlspecialchars ($item -> name); ?>"  width="86" height="70" />
			                </a>
			                <h3><a rel="nofollow" href="<?php echo $link; ?>" title = "<?php echo $item -> name ; ?>" ><?php echo get_word_by_length(80,$item -> name); ?></a></h3>
	                		<span class="price"><?php echo format_money($item -> price,'đ')?></span>
			               
			             </li>  
	
						<?php 
					}
		?>
		</ul>
	</div>
</div>
<?php }?>
