<?php
global $tmpl; 
$tmpl -> addStylesheet('owl.carousel','libraries/jquery/owl.carousel.2/assets');
$tmpl -> addScript('owl.carousel.min','libraries/jquery/owl.carousel.2');
$tmpl -> addStylesheet('default','blocks/partners/assets/css');
$tmpl -> addScript('partners','blocks/partners/assets/js');
FSFactory::include_class('fsstring');
$i = 1;

$total = count($list)
?>	

<div class="content-partners">	
<?php foreach($list as $item){ ?>
	<?php $image = URL_ROOT.str_replace('/original/', '/resized/',$item -> image);?>
	<?php $link = $item -> url;?>
	<?php $class = '';?>
	<?php if($i == 1)$class .= ' first-item';?> 
	<?php if($i == $total )$class .= ' last-item';?> 
									
						
		<div class="box-partners item <?php echo $class;?>">
    		<a href="<?php  echo $link;?>" title="<?php echo $item -> name; ?>"  rel="nofollow" target="_blink">
    			<img class="img-responsive" src="<?php echo $image;?>" alt="<?php $item->name;?>" />
    		</a>
		</div>
		<?php $i ++; ?>
<?php }?>			
</div>


