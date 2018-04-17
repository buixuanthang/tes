<?php
	global $tmpl;
	$tmpl -> addStylesheet('partners','modules/partners/assets/css');
	$tmpl -> addScript('partners','modules/partners/assets/js');
	$page = FSInput::get('page');
	$total_partner_list = count($list);
    $Itemid = 7;
		
?>

<div class="partner_cat">
	<h1 class="img-title-cat page_title">
      <span><?php echo FSText::_('Partner'); ?></span>
    </h1>
    
	
		<?php 	if($total_partner_list){ ?>
		<div class="partners_body_wrapper">
			<div class="partners_body cls">
			<?php	for($i = 0; $i < $total_partner_list; $i ++){
					$item = $list[$i];
					$link = $item -> url;
					// $link = FSRoute::_("index.php?module=partners&view=partner&id=".$item->id."&code=".$item->alias);
			?>
			<div class='item'>
				<div class='item_inner'>
					<div class="item_inner_inner">
						<div class="item_inner_inner_inner">
							<a href="javascript:void(0)" title="<?php echo $item -> name; ?>" rel="nofollow" class="link_img">
							<img src="<?php echo URL_ROOT.str_replace('/original/','/resized/',$item->image);?>" alt="<?php $item->name;?>" /></a>
							<div class="readmore">
								<span></span>
							</div>
						</div>	
					</div>
					<div class="more_info">
						<div class="more_info_inner scroll_bar">
							
							<h2 class="title">
								<a href="<?php echo $link; ?>" title="<?php echo htmlspecialchars(@$item->name); ?>"><?php echo $item->name; ?></a>
							</h2>
							<div class="website">
								Website: <a href="<?php echo $link; ?>" title="<?php echo htmlspecialchars(@$item->title); ?>" target="_blank"><?php echo $item->url; ?></a>
							</div>
							<div class="sum">
									<?php echo $item->summary;?>
							</div>
							<div class="description">
									<?php echo $item->content;?>
							</div>
						</div>
						<div class="closed">X</div>
					</div>
				</div>	
			</div>
			<?php } ?>

			</div>
		</div>
		<?php
			if($pagination) echo $pagination->showPagination(3);
		} else {
			echo FSText::_('Không có bài viết nào trong chuyên mục')."<strong>".$cat->name."</strong>";
		 }
		?>
		
	
</div>
