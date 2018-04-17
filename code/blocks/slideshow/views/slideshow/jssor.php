<?php if(isset($data) && !empty($data)){?>
<?php

global $tmpl; 

// $tmpl -> addStylesheet('owl.carousel','libraries/jquery/jssor.slider/js');
$tmpl -> addScript('jssor.slider.min','libraries/jquery/jssor.slider/js');
$tmpl -> addScript('jssor','blocks/slideshow/assets/js');
$tmpl -> addStylesheet('jssor','blocks/slideshow/assets/css');
    
//$tmpl -> addStylesheet('slideshow','blocks/slideshow/assets/css');
//$tmpl -> addStylesheet('owl.carousel','libraries/jquery/owl.carousel');
//$tmpl -> addStylesheet('owl.theme','libraries/jquery/owl.carousel');
//$tmpl -> addScript('owl.carousel','libraries/jquery/owl.carousel');
//$tmpl -> addScript('progress_bar','libraries/jquery/owl.carousel');
//$tmpl -> addScript('slideshow','blocks/slideshow/assets/js');
?>  
<div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:<?php echo $cat -> width; ?>px;height:<?php echo $cat -> height; ?>px;overflow:hidden;visibility:hidden;">

     <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:<?php echo $cat -> width; ?>px;height:<?php echo $cat -> height; ?>px;overflow:hidden;">
        <?php $i = 0; ?>
        <?php foreach($data as $item){?>    
             <div>
                <a href="<?php echo $item->url; ?>" title="<?php echo htmlspecialchars($item->name); ?>">
                    
                    <?php if(!$i){ ?>
                <img data-u="image" src="<?php echo URL_ROOT.str_replace('/original/', '/original/', $item -> image); ?>" />
                    <?php }else{ ?>
                <img data-u="image" class="lazy" data-src="<?php echo URL_ROOT.str_replace('/original/', '/original/', $item -> image); ?>" />
                    <?php } ?>
            </a>
            </div>      
            <?php $i ++; ?>
        <?php }?>
    </div>

    <!-- Bullet Navigator -->
    <div data-u="navigator" class="jssorb053" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
        <div data-u="prototype" class="i" style="width:16px;height:16px;">
           
        </div>
    </div>
    <!-- Arrow Navigator -->
    <div data-u="arrowleft" class="jssora093" style="width:50px;height:50px;top:0px;left:30px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
        <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
            <circle class="c" cx="8000" cy="8000" r="5920"></circle>
            <polyline class="a" points="7777.8,6080 5857.8,8000 7777.8,9920 "></polyline>
            <line class="a" x1="10142.2" y1="8000" x2="5857.8" y2="8000"></line>
        </svg>
    </div>
    <div data-u="arrowright" class="jssora093" style="width:50px;height:50px;top:0px;right:30px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
        <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
            <circle class="c" cx="8000" cy="8000" r="5920"></circle>
            <polyline class="a" points="8222.2,6080 10142.2,8000 8222.2,9920 "></polyline>
            <line class="a" x1="5857.8" y1="8000" x2="10142.2" y2="8000"></line>
        </svg>
    </div>

</div>
<?php }?>
