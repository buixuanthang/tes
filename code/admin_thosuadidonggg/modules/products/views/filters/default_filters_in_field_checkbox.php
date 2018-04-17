<?php $alias_table = str_replace('fs_products', '', $tablename); ?>
<?php $alias_table = str_replace('_', '-', $alias_table); ?>
<!--	FIELD	-->
		<fieldset>
			<legend>Bộ lọc trong trường</legend>
			<div id="tabs">
		        <table cellpadding="5"  cellspacing="0" class="field_tbl" width="100%" border="1" bordercolor="#CCC">
		        	<tr>
		        		<td> T&#234;n hi&#7875;n th&#7883;</td>
		        		<td> T&#234;n hiệu
		        			<br/><span>(duy nhất)</span></td>
		        		<td width="22%"> SEO </td>
		        		<td> Thứ tự </td>
		        		<td> Trang chủ </td>
		        		<td> Published </td>
		        	</tr>
		        	<?php if(count($foreign)) { ?>
		        		<?php foreach ($foreign as $item) { ?>
		        			<?php $i = $item -> id; ?>
		        			<?php $field = null;?>
			        		<?php if(count($filters)) { ?>
			        			<?php 
			        			foreach ($filters as $f) {
			        				if($f -> filter_value == $item -> id){
			        					$field = $f;
			        					break;
			        				}
			        			}	
			        			?>
		        			<?php }?>
			        			<?php if($field){?>
				        			<tr id="filter_exist_<?php echo $i; ?>">
										<td>
											<input type="text" name='filter_show_<?php echo $i;?>' value="<?php echo $field->filter_show; ?>" />
										</td>
										<td>
											<input type="text" name='alias_<?php echo $i;?>' value="<?php echo $field->alias; ?>" />
										</td>
										<td>
											<span class='seo_label'>Title:&nbsp;&nbsp;&nbsp;</span><input type="text" name='seo_title_<?php echo $i;?>' value="<?php echo $field->seo_title; ?>" />
											<br/>
											<span class='seo_label'>Meta key:</span><input type="text" name='seo_meta_key_<?php echo $i;?>' value="<?php echo $field->seo_meta_key; ?>" />
											<br/>
											<span class='seo_label'>Meta des:</span><input type="text" name='seo_meta_des_<?php echo $i;?>' value="<?php echo $field->seo_meta_des; ?>" />
											<br/>
										</td>
										<td>
											<input type="text" name='ordering_<?php echo $i;?>' value="<?php echo $field->ordering; ?>" size="4"/>
										</td>
										<td>
											<input type="checkbox" name='is_home_<?php echo $i;?>' <?php echo $field->is_home?"checked='checked'":""; ?> value="1" />
										</td>
										<td>
											<input type="checkbox" name='published_<?php echo $i;?>' <?php echo $field->published?"checked='checked'":""; ?> value="1" />
										</td>
									</tr>
			        			<?php }else{?>
			        				<tr id="filter_<?php echo $i; ?>">
										<td>
											<input type="text" name='filter_show_<?php echo $i;?>' value="<?php echo $item->name; ?>" />
										</td>
										<td>
											<input type="text" name='alias_<?php echo $i;?>' value="<?php echo $alias_table.'-'.$item->alias; ?>" />
										</td>
										
										<td>
											<span class='seo_label'>Title:&nbsp;&nbsp;&nbsp;</span><input type="text" name='seo_title_<?php echo $i;?>' value="<?php echo $item->seo_title; ?>" />
											<br/>
											<span class='seo_label'>Meta key:</span><input type="text" name='seo_meta_key_<?php echo $i;?>' value="<?php echo $item->seo_keyword; ?>" />
											<br/>
											<span class='seo_label'>Meta des:</span><input type="text" name='seo_meta_des_<?php echo $i;?>' value="<?php echo $item->seo_description; ?>" />
											<br/>
										</td>
										<td>
											<input type="text" name='ordering_<?php echo $i;?>' value="<?php echo $i; ?>" size="4"/>
										</td>
										<td>
											<input type="checkbox" name='published_<?php echo $i;?>'   value="1" />
										</td>
										<td>
											<input type="checkbox" name='is_home_<?php echo $i;?>'   value="1" />
										</td>
									</tr>
			        			<?php }?>
		        		<?php }?>
	        		<?php }?>
	        		
				</table>
			</div>
		</fieldset>
<style>
.seo_label{
	display: inline-flex;
    width: 60px;		
}
</style>