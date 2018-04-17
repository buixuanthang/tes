<table class='charactestic_table_detail' border="0"  cellpadding="8px" width="100%">
	<?php if(count($arr_ext_fileds_by_group)){?>
		<?php foreach($arr_ext_fileds_by_group as $group_id => $fileds_in_group){?>
			<?php $i = 0;?>
			<?php $group_field = $ext_group_fields[$group_id];?>
			<?php $tmp=0;?>
			<?php foreach($fileds_in_group as $item2){?>
			<?php $field_name = $item2 -> field_name;?>
				<?php if($extend->$field_name){
					 $tmp++;
				}?>
			<?php } ?>
			<?php foreach($fileds_in_group as $item){?>
				<?php 
				$field_name = $item -> field_name;
				$field_type = $item -> field_type;
				?>
				<?php if($extend->$field_name){?>
				<tr <?php if($i%2==0){?> class="tr-0" <?php }else{?> class="tr-1" <?php }?>>
					<?php if(!$i){?>
						<td class='group_field' rowspan="<?php echo $tmp; ?>" width="10%" bgcolor="#F1F1F1">
							<?php echo @$group_field -> name; ?>
						</td>
					<?php }?>
					<td class='title' width="30%" bgcolor="#F1F1F1">
						<?php echo $item->field_name_display ?$item->field_name_display: $item->field_name; ?>
					</td>
					<td class='content_charactestic' width="30%">
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
				<?php } ?>
				
			<?php } // end. foreach($fileds_in_group as $filed) ?>
		<?php }// end. foreach($arr_ext_fileds_by_group as $group_id => $fileds_in_group)?>
	<?php } // end .if(count($arr_ext_fileds_by_group))?>
</table>

