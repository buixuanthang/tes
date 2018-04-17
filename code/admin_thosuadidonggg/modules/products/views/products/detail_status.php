	<table border="1" class="tbl_form_contents" width="100%" cellspacing="4" cellpadding="4" bordercolor="#CCC">
		<thead>
			<tr>
				<th align="center" >
					<?php echo FSText::_('Tình trạng');?>	
				</th>
			
				<th align="center" >
					<?php echo FSText::_('Giá');?>	
				</th>
				<th align="center"  width="15" >
					<?php echo FSText::_('Chọn');?>	
				</th>
			</tr>
		</thead>
		<tbody>
		
		<?php
			if(isset($status) && !empty($status)){
				foreach ($status as $item) { 
					@$data_by_status = $array_data_by_status[$item->id];
		?>
			<?php if(@$data_by_status){?>
				<tr>
					<td>
						
						<?php echo $item -> name;?><br/>
					</td>
					<td>
						 <input type="text" size="20" id="status_price_exit_<?php echo $item->id;?>" onkeypress="nurZahlen(this)" name="status_price_exist_<?php echo $item->id;?>"  value="<?php echo @$data_by_status->price;?>">
					</td>
					<td>
						<input type="checkbox"  value="<?php echo $item->id; ?>"  name="other_status_exit[]" id="other_status_exit<?php echo $item->id; ?>" checked/>
						<input type="hidden" value="<?php echo @$data_by_status -> id; ?>" name="id_exist_<?php echo $item->id;?>">
						<input type="hidden" value="<?php echo $item->id; ?>" name="status_exist_total[]"  />
					</td>
				</tr>
				
			<?php }else{?>
				<tr>
					<td>
						
						<?php echo $item -> name;?><br/>
					</td>
					<td>
						 <input type="text" size="20" id="new_status_price_<?php echo $item->id;?>" onkeypress="nurZahlen(this)" name="new_status_price_<?php echo $item->id;?>" >
					</td>
					<td>
						<input type="checkbox"  value="<?php echo $item->id; ?>"  name="other_status[]" id="other_status<?php echo $item->id; ?>" />
					</td>
				</tr>
			<?php }?>
				<?php
				}
			}
			?>
	</tbody>		
	</table>