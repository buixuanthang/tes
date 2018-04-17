<?php 
?>
<!-- HEAD -->
	<?php 
	
	$title = @$data ? FSText :: _('S&#7917;a th&#244;ng tin v&#7873; H&#227;ng s&#7843;n xu&#7845;t'): FSText :: _('Th&#234;m m&#7899;i h&#227;ng s&#7843;n xu&#7845;t'); 
	global $toolbar;
	$toolbar->setTitle($title);
	$toolbar->addButton('save_add',FSText :: _('Save and new'),'','save_add.png'); 
	$toolbar->addButton('apply',FSText::_('Apply'),'','apply.png'); 
	$toolbar->addButton('save',FSText::_('Save'),'','save.png'); 
	$toolbar->addButton('cancel',FSText::_('Cancel'),'','cancel.png');   
	$this -> dt_form_begin();
	TemplateHelper::dt_edit_text(FSText :: _('Name'),'name',@$data -> name);
	TemplateHelper::dt_edit_text(FSText :: _('Alias'),'alias',@$data -> alias,'',60,1,0,FSText::_("Can auto generate"));
	TemplateHelper::dt_checkbox(FSText::_('Published'),'published',@$data -> published,1);
	TemplateHelper::dt_edit_text(FSText :: _('Ordering'),'ordering',@$data -> ordering,@$maxOrdering,'20');
	
	$this -> dt_form_end(@$data);
	?>
<!-- END HEAD-->
