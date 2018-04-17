<link type="text/css" rel="stylesheet" media="all" href="../libraries/jquery/jquery.ui/jquery-ui.css" />
<script type="text/javascript" src="../libraries/jquery/jquery.ui/jquery-ui.js"></script>

<link type="text/css" rel="stylesheet" media="all" href="../libraries/jquery/colorpicker/css/colorpicker.css" />
<script type="text/javascript" src="../libraries/jquery/colorpicker/js/colorpicker.js"></script>
<script type="text/javascript" src="../libraries/jquery/colorpicker/js/eye.js"></script>

<!-- FOR TAB -->	
 <script>
  $(document).ready(function() {
    $("#tabs").tabs();
  });
  </script>
	<?php
	$title = @$data ? FSText :: _('Edit'): FSText :: _('Add'); 
	global $toolbar;
	$toolbar->setTitle($title);
	$toolbar->addButton('save_add',FSText :: _('Save and new'),'','save_add.png'); 
	$toolbar->addButton('apply',FSText :: _('Apply'),'','apply.png'); 
	$toolbar->addButton('Save',FSText :: _('Save'),'','save.png'); 
	$toolbar->addButton('back',FSText :: _('Cancel'),'','back.png');   
	
	$this -> dt_form_begin(0);
	?>
		<div id="tabs">
		    <ul>
		        <li><a href="#fragment-1"><span><?php echo FSText::_("Tr&#432;&#7901;ng c&#417; b&#7843;n"); ?></span></a></li>
		        <?php if(isset($data)){?>
		        <li><a href="#fragment-2"><span><?php echo FSText::_("Thêm sản phẩm"); ?></span></a></li>
		    	<?php } ?>
		    </ul>
			
			<!--	BASE FIELDS    -->
		    <div id="fragment-1">
				<?php include_once 'detail_base.php';?>
			</div>
		    <!--	END BASE FIELDS    -->
		    <?php if(isset($data)){?>
			    <!--	PROMOTION_PRODUCTS   -->
			    <div id="fragment-2">
			    	<?php include_once 'detail_product.php';?>
			    </div>
		    <?php } ?>
	    </div>
<?php 
$this -> dt_form_end(@$data,0);
?>