<table class='charactestic_table' border="1" bordercolor="#EEE" cellpadding="7" width="100%">
			<?php $i = 0; $j=0;?>
			<?php foreach($ext_fields as $item){ $j++?>
				<?php /*?><?php if($item->is_main){?><?php */?>
                <?php  if($j<10) { ?>
					<?php 
					$field_name = $item -> field_name;
					$field_type = $item -> field_type;
					?>
					<?php if(isset($extend->$field_name) && $extend->$field_name){?>
						<tr <?php if($i%2==0){?> class="tr-0" <?php }else{?> class="tr-1" <?php }?>>
							<td class='title_charactestic' width="30%">
								<?php echo $item->field_name_display ?$item->field_name_display: $item->field_name; ?>
							</td>
							<td class='content_charactestic'>
								<?php if($field_type == 'image'){?>
									<?php if(@$item->$field_name){?>
										<img alt="<?php echo $data -> name?>" src="<?php echo URL_ROOT.@$extend->$field_name; ?>" />
									<?php }?>	
								<?php }elseif($field_type == 'foreign_one' || $field_type == 'foreign_multi'){?>
									<?php echo $this -> get_data_foreign($item -> foreign_tablename,$extend -> $field_name,$field_type); ?>
								<?php } else {?>
									<?php echo isset($extend->$field_name)?nl2br($extend->$field_name):'-'; ?>
								<?php }?>
							</td>
						</tr>
						<?php $i ++; ?>
					<?php }?>
				<?php }?>
			<?php } // end. foreach($fileds_in_group as $filed) ?>
			<tr>
				<td><span class="readmore" id="readmore_chareactestic"> Xem thêm &#187;</span></td>
				<td></td>
			</tr>
</table>
	<div id="charactestic_detail" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-full-screen"></div>
	    	<div class="modal-content">
	        	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                <h3 class="modal-title"><span><?php echo  FSText::_('Chi tiết tính  năng')?> <?php echo $data->name;?></span></h3>
	            </div>
		         <div class="content">
					<?php include_once 'default_characteristic_detail.php'; ?>
				</div>
			</div>	
		</div>		
	</div>
			
