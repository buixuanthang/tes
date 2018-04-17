<?php 
global $tmpl;
$tmpl -> addStylesheet("bought","modules/products/assets/css");
?>
<div class="orders-list">
                <h1>Danh sách khách hàng đã mua sản phẩm</h1>
                <table border="1" bordercolor="#CCC" width="100%" cellpadding="10" >
<!--                    <tr>-->
<!--                        <th class="stt_0" width="5%" height="30">STT</th>-->
<!--                        <th width="24%">Số đơn hàng</th>-->
<!--                        <th width="27%">Giá trị</th>-->
<!--                        <th width="28%">Thời gian</th>-->
<!--                        <th width="16%">Thông tin</th>-->
<!--                    </tr>   -->
                    <?php for($i = 0 ; $i < count($data); $i ++ ){?>
					<?php
					
						 $item = $data[$i];
						 $product = isset($products[$item -> products_id])?$products[$item -> products_id] : null;
						 if(!$product)
						 	continue;
						 $link_view =FSRoute::_('index.php?module=products&view=order&id='.$item->id.'&task=detail&Itemid=45');
						 $link = FSRoute::_('index.php?module=products&view=product&code='.$product -> alias.'&id='.$product -> id.'&ccode='.$product->alias);
					?>
                    <tr class='row-<?php echo $i %2; ?>'>
                        <td class="stt_0" ><?php echo ($i + 1)?></td>
                        <td align="center">
                        	<a href="<?php echo $link; ?>" title="<?php echo $product -> name; ?>">
                    			<img src="<?php echo URL_ROOT.str_replace('/original/', '/resized/', $product -> image); ?>"  width="70"  />	
							</a>
                        </td>
                        <td>
                        	<h2 class='name'>
                        		<a href="<?php echo $link; ?>" title="<?php echo $product -> name; ?>"><?php echo $product -> name; ?></a>
                        	</h2>
                        	<div class='price'>Giá: <strong><?php  echo format_money($item -> total_after_discount).' '; ?></strong></div>
                        	<div class='other'>
                        		<?php if($item -> status_id && isset($status[$item -> status_id])){?>
                        			<?php $state = $status[$item -> status_id]; ?>
                        			Tình trạng: <strong><?php  echo $state -> name; ?></strong> | 
                        		<?php }?> 
                        		<?php if($item -> color_id && isset($colors[$item -> color_id])){?>
                        			<?php $color = $colors[$item -> color_id]; ?>
                        			Màu sắc: <strong class='color'><a href="javascript: void(0)" title="<?php  echo $color -> name; ?>" style="background-color: <?php echo '#'.$color -> code; ?>">&nbsp;</a></strong>
                        		<?php }?> 
                        		| Ngày mua: <strong><?php echo date('d/m/Y',strtotime($item->created_time));?></strong>
                        		
                        	</div>
                        </td>
                        <td><?php  echo $item -> sender_name; ?></td>
                        <td><?php  echo  substr($item -> sender_telephone,0, -3).'xxx'; ?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
