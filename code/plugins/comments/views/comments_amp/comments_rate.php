<?php $point = $data -> rating_count ? round($data -> rating_sum /$data -> rating_count): 4 ; ?>
<?php
// check cookies
$disable_rating = 0;
$str_cookies_rating = isset($_COOKIE['rating_product'])?$_COOKIE['rating_product']:'';
if(strpos($str_cookies_rating,','.$data->id.',') !== false){
	$disable_rating = 1;
}
?>

<div class="rating_area cls">
	<form id="rating"
	  class="p2"
	  method="get"
	  action="/index.php?"
	  target="_blank">
	  <input type="hidden" value="comments" name='module' />
	<input type="hidden" value="comments" name='view' />
	<input type="hidden" value="<?php echo $module;?>" name='type' id="_cmt_type" />

	<input type="hidden" value="<?php echo $data -> id;?>" name='record_id' id="record_id" />
	<input type="hidden" value="<?php echo $module;?>" name='_cmt_module' id="_cmt_module" />
	<input type="hidden" value="<?php echo $view;?>" name='_cmt_view' id="_cmt_view" />
	<input type="hidden" value="save_rate_amp" name='task' />
	<input type="hidden" value="<?php echo $rid;?>" name='record_id' id="_cmt_record_id" />
	<?php 
	$link_r = $_SERVER['REQUEST_URI'];
	$link_r = URL_ROOT.substr(str_replace('.amp','.html',$link_r),1).'#comment_add_form';
	?>

	<input type="hidden" value="<?php echo 	base64_encode($link_r); ?>" name='return'  id="_cmt_return"  />

	  <fieldset class="rating">
	    <input name="rating"
	      type="radio"
	      id="rating5"
	      value="5"
	      on="change:rating.submit" />
	    <label for="rating5"
	      title="5 stars">☆</label>

	    <input name="rating"
	      type="radio"
	      id="rating4"
	      value="4"
	      on="change:rating.submit" />
	    <label for="rating4"
	      title="4 stars">☆</label>

	    <input name="rating"
	      type="radio"
	      id="rating3"
	      value="3"
	      on="change:rating.submit" />
	    <label for="rating3"
	      title="3 stars">☆</label>

	    <input name="rating"
	      type="radio"
	      id="rating2"
	      value="2"
	      on="change:rating.submit"
	      checked="checked" />
	    <label for="rating2"
	      title="2 stars">☆</label>

	    <input name="rating"
	      type="radio"
	      id="rating1"
	      value="1"
	      on="change:rating.submit" />
	    <label for="rating1"
	      title="1 stars">☆</label>
	  </fieldset>
	  <div submit-success>
	    <template type="amp-mustache">
	      <p>Thanks for rating {{rating}} star(s)!</p>
	    </template>
	  </div>
	  <div submit-error>
	    <template type="amp-mustache">
	      Looks like something went wrong. Please try to rate again. {{error}}
	    </template>
	  </div>
	</form>
	<span class='rating_note'>Nhấn vào đây để đánh giá</span>
</div>

			