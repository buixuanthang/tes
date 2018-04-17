<?php global $config,$tmpl; ?>
<amp-sidebar id="mainmenu_sidebar"  layout="nodisplay"  side="right" >
  
 
  	<div class="close-nav-wrapper"><div role="button" tabindex="0" on="tap:mainmenu_sidebar.close" class="close-nav">X</div></div>
    <ul class="mainmanu">
    		<li><a href="<?php echo URL_ROOT;?>" class="navbar-brand visible-xs visible-sm  visible-md">
             	<span>Trang chủ</span>
             </a>
             </li>
			    		<?php $url = $_SERVER['REQUEST_URI'];?>
			    		<?php $url = substr($url,strlen(URL_ROOT_REDUCE));?>
			    		<?php $url = URL_ROOT.$url; ?>
			    		<?php if(isset($list) && !empty($list)){?>
			    			<?php foreach($list as $item){?>
			    				<?php // if($item -> level) continue;?>
				    			<?php $link = FSRoute::_($item->link);?>
				    			<?php $class= '';?>
				    			<?php $image = URL_ROOT.str_replace('/original/', '/small/',$item -> image);?>
				    			<?php if($url == $link) $class = 'active';?>
						               	 <li class="level_<?php echo $item -> level; ?> <?php echo $class;?> "  id="menu-<?php echo $item -> alias;?>">
						                	<a  href="<?php echo $link;?>"  title="<?php echo $item->name;?>">					                		
	               		                        <span><?php echo $item->name;?></span>
	                                        </a>
						                </li>	
					            <?php } // end foreach($list as $item)?>
			            <?php }  // end if(isset($list) && !empty($list))?>
			        </ul>
  </ul>
</amp-sidebar>

