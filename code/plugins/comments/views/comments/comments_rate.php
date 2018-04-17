<div class="rating_area cls">
			<span id="ratings" class="cls">
				<?php $point = $data -> rating_count ? round($data -> rating_sum /$data -> rating_count): 4 ; ?>
				<?php
				// check cookies
				$disable_rating = 0;
				$str_cookies_rating = isset($_COOKIE['rating_product'])?$_COOKIE['rating_product']:'';
				if(strpos($str_cookies_rating,','.$data->id.',') !== false){
					$disable_rating = 1;
				}
				?>
				<?php for($i = 0; $i < 5;$i ++){?>
					<?php if($point > $i){?>
						<i class="fa fa-star" id ="rate_<?php echo ($i+1); ?>" value="<?php echo ($i+1); ?>"></i>
					<?php }else{?>
						<i class="fa fa-star-o"  id ="rate_<?php echo ($i+1); ?>" value="<?php echo ($i+1); ?>"></i>
					<?php }?>
				<?php }?>
				
				<input type="hidden" name='rating_disable' id='rating_disable' value='<?php echo $disable_rating;?>'>	
				<input type="hidden" name='rating_value' id='rating_value' value=''>	
				<!-- end RATING	-->
			</span>
			<span class='rating_note'><?php echo FSText::_('Nhấn vào đây để đánh giá'); ?></span>
		</div>