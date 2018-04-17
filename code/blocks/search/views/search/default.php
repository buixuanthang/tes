<?php 
global $tmpl;
$tmpl -> addScript("jquery.autocomplete","blocks/search/assets/js");
$tmpl -> addStylesheet('search','blocks/search/assets/css');
$tmpl -> addScript("search","blocks/search/assets/js");
?>
<?php $text_default = FSText::_('Tìm kiếm sản phẩm')?>
<?php 
    $keyword = '';
    $module = FSInput::get('module');
    if($module == 'products'){
    	$key = FSInput::get('keyword');
    	if($key){
    		$keyword = $key;
    	}
    }
?>
<div id="search" class="search ">
	
<?php $link = FSRoute::_('index.php?module=products&view=search');?>
	    <form action="<?php echo $link; ?>" name="search_form" id="search_form" class="mypopup1" method="get" onsubmit="javascript: submit_form_search();return false;" >
<input type="text" value="<?php echo $keyword; ?>" placeholder="<?php echo FSText::_('Tìm kiếm sản phẩm'); ?>" id="keyword" name="keyword" class="keyword" /><button class="button-search" id='searchbt' class = 'searchbt'><i class="fa fa-search"></i></button>
            
		    	<input type='hidden'  name="module" value="products"/>
	    	<input type='hidden'  name="module" id='link_search' value="<?php echo FSRoute::_('index.php?module=products&view=search&keyword=keyword'); ?>" />
			<input type='hidden'  name="view" value="search"/>
			<input type='hidden'  name="Itemid" value="10"/>
		</form>
</div>
