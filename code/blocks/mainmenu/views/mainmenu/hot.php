 <div class='mainmenu mainmenu-<?php echo $style; ?>'>
 	
 	<?php 
 	$Itemid  = FSInput::get('Itemid'); 
 	$total = count($list); 
 	$i = 0;
 	foreach ( $list as $item ) { 
 		$class =  $item -> id ==  $Itemid ? 'active':'';
 		if($i == ($total -1))
 			  $class .= ' last-item';
 		if(strpos($item -> link ,'forum') !== false){	  
 			$link   = FSRoute::_($item -> link);
 		} else {
 			$link   = FSRoute::_($item -> link ."&Itemid=$item->id");
 		}
 		echo "<a href='".$link."'  class='item $class ' ><span> ".$item -> name."</span></a>  </li>";
 		// sepa
 		$i ++;
 	}
 	?>
 </div>
