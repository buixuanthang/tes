<?php
global $tmpl; 
$tmpl -> addStylesheet('img_right','blocks/newslist/assets/css');
?>
	<div class='news_list_body_img_right'>
			<?php 
			$Itemid = 4;
			for($i = 0; $i < count($list); $i ++ ){
				$item = $list[$i];
				$link = FSRoute::_("index.php?module=news&view=news&id=".$item->id."&code=".$item->alias."&ccode=".$item-> category_alias."&Itemid=$Itemid");			
				?>
				<div class='news-item'>
          <div class='news-item-inner cls'> 
              <figure>
                <a href='<?php echo $link;?>' title="<?php echo $item->title;?>">
                  <img src='<?php echo URL_ROOT.str_replace('/original/','/large/',$item -> image)?>' alt="<?php echo $item -> title?>"/>
                </a>
              </figure>
              	<div class="title"><a href='<?php echo $link;?>' title="<?php echo $item->title;?>"><?php echo get_word_by_length(150,$item->title);?></a> </div>	
                
                <div class="summary"><?php echo get_word_by_length(90,$item->summary);?></div>
                <div class='clear'></div>
          </div>
         </div>   
			<?php }	?>
	</div>
