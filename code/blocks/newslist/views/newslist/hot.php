<?php
global $tmpl; 
$tmpl -> addStylesheet('newslist_hot','blocks/newslist/assets/css');
?>
	<div class='news_list_body'>
			<?php 
			$Itemid = 4;
			for($i = 0; $i < count($list); $i ++ ){
				$item = $list[$i];
				$link = FSRoute::_("index.php?module=news&view=news&id=".$item->id."&code=".$item->alias."&ccode=".$item-> category_alias."&Itemid=$Itemid");			
				?>
				<div class='news-hot'>
               <img onerror="javascript:this.src='<?php echo URL_ROOT?>images/Na90x64.png';" src='<?php echo URL_ROOT.str_replace('/original/','/small/',$item -> image)?>' alt="<?php echo $item -> title?>"/>
              	<div><a href='<?php echo $link;?>'><?php echo $item->title;?></a> </div>	
                <div class='clear'></div>
              </div>
              
				<?php }
			?>
	</div>
