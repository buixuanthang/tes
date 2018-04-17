<?php 
global $tmpl;
$tmpl -> addStylesheet('sharedata','blocks/search/assets/css');
$tmpl -> addScript("sharedata","blocks/search/assets/js");
?>
<?php $text_default = FSText::_('Tìm kiếm...')?>
<?php 
    $keyword = $text_default;
    $module = FSInput::get('module');
    $view = FSInput::get('view');
    $cat_value  = 'tat-ca';
    $search_name = 'Tất cả';
    if($module == 'products' && $view == 'search'){
    	$key = FSInput::get('keyword');
    	$cat_value = FSInput::get('ccode','tat-ca');
    	if($key){
    		$keyword = $key;
    	}
	     if($cat_value != 'tat-ca'){
	     	foreach($categories as $item){
			  	if($cat_value == $item -> alias){
				  	$search_name = $item -> name;
				  	break;
			  	}   		
	     	}
	     }
    }
?>
<div class='search'>
<?php $link = FSRoute::_('index.php?module=products&view=search');?>
	    <form action="<?php echo $link; ?>" name="search_form" id="search_form" method="get" onsubmit="javascript: submit_form_search();return false;" >
	    		<p><?php echo FSText::_('Bắt đầu từ những điều bạn muốn'); ?></p>
	    		
	    		<input type="text" onblur="if(this.value=='') this.value='<?php echo $text_default; ?>'" onfocus="if(this.value=='<?php echo $text_default; ?>') this.value=''" value="<?php echo $keyword; ?>" id="keyword" name="keyword" class="keyword" size="39"/>
				<input type="submit" id='searchbt' class = 'searchbt' value="" />	    		
		    	<div class='search_cat'>
		    		<input type='hidden'  name="cat_value" id="cat_value" value="<?php echo $cat_value; ?>"/>
		    		<ul>
		    			<li ><a id='tat-ca' <?php echo $cat_value == 'tat-ca'?'class=\'selected\'':''?> href='javascript:void(0)' >Tất cả</a></li>
		    			<?php if(count($categories)){?>
		    				<?php foreach($categories as $item){?>
		    					<li ><a id='<?php echo $item -> alias; ?>' <?php echo $cat_value == $item ->alias?'class=\'selected\'':''?>  href='javascript:void(0)' ><?php echo $item -> treename; ?></a></li>	
		    				<?php }?>
		    			<?php }?>
		    		</ul>
		    		<div class='clear'></div>
		    	</div>
		    	<div class='redirect_upload_form'>
		    		<?php $link = FSRoute::_('index.php?module=estores&view=product&task=add&Itemid=45'); ?>
		    		<div class='redirect_upload_form_t'>
		    			<a href="<?php echo $link; ?>" title="Upload"><?php echo FSText::_('Nhấp vào đây để'); ?></a>
		    		</div>
		    		<div class='redirect_upload_form_b'>
		    			<a href="<?php echo $link; ?>" title="Upload"><?php echo FSText::_('Tải lên'); ?> <img src='<?php echo URL_ROOT.'blocks/search/assets/images/upload.png'; ?>' alt="Upload" /></a>
		    		</div>
		    	</div>
		    	<input type='hidden'  name="module" value="products"/>
		    	<input type='hidden'  name="module" id='link_search' value="<?php echo FSRoute::_('index.php?module=products&view=search'); ?>" />
				<input type='hidden'  name="view" value="search"/>
				<input type='hidden'  name="Itemid" value="10"/>
		</form>
</div>
