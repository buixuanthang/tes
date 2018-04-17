<div class="cate">
  <h2><img src="<?php echo URL_ROOT . '/images/config/logo_black.png';?>" alt="log_black">Danh mục tin tức</h2>
  <?php 
  for($i = 0 ; $i < count( $array_cats) ; $i ++)
    {
      $cat = $array_cats[$i];
      $link_cat = FSRoute::_("index.php?module=news&view=cat&ccode=".$cat -> alias."&cid=".$cat->id);
    ?>
  <div class="list">
    <ul>
      <li><span><i class="fa fa-angle-right"></i></span>&nbsp<a href="<?php echo $link_cat ?>"><?php echo $cat->name ?></a></li>
    </ul>
  </div>

  <?php } ?>
</div>