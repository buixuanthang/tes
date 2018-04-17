<div class='compare_box'>
	<label>Tìm và so sánh với <span><?php echo $data -> name; ?></span></label>
	<input type="text" name="compare_name" id="compare_name" placeholder="Gõ tên sản phẩm cần so sánh" />
	<input type="hidden" id="table_name" value="<?php echo str_replace('fs_products_','',$data -> tablename); ?>" />
</div>