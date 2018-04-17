
			<table border="1" class="tbl_form_contents" width="100%" cellpadding="10" bordercolor="#cccccc">
				<thead>
					<tr>
						<th class="title" width="15%" rowspan="2">
							<?php echo FSText :: _('Module'); ?>
						</th>
						<th class="title" width="15%"  rowspan="2">
							<?php echo FSText :: _('Nhóm task vụ'); ?>
						</th>
						<th class="title" width="20%" rowspan="2" >
							<?php  echo FSText :: _('Task vụ'); ?>
						</th>
						<th class="title" width="" colspan="3" align="center">
							<?php  echo FSText :: _('Chức năng'); ?>
						</th>
					</tr>
					<tr>
						<th><?php echo FSText :: _('View'); ?> </th>
						<th><?php echo FSText :: _('Edit'); ?> </th>
						<th><?php echo FSText :: _('Remove'); ?> </th>
					</tr>
				
				</thead>
				<tbody>
					<?php foreach($arr_task as $module_name => $module):?>
						<tr class="row">
							<td align="left" rowspan="<?php echo (count($module));?>">
								<strong><?php echo FSText::_(ucfirst($module_name));?></strong>
							</td>
						<?php $k = 0;?>	
						<?php foreach($module as $view_name => $view):?>
							<?php $perm = @$list_permission[$view -> id] -> permission?@$list_permission[$view -> id] -> permission : 0; ?>
							<?php 
							$name_box = "per_";
							$name_box .= $view -> id ?  ($view -> id): "0";
							$id_box = $name_box;
							$name_box .= "[]";
							?>
								
							<?php if($k){?>
							<tr class="row">
							<?php }?>
								<td><?php echo $view -> description ?FSText::_($view -> description) : FSText::_(ucfirst($view_name));?></td>
									<td>
										<input  type="checkbox" value="3"  name="<?php echo $name_box; ?>" <?php echo @$perm >= 3 ?"checked=\"checked\"":""; ?> id="<?php echo $id_box."_v"; ?>"/>
									</td>
									<td>
										<input type="checkbox" value="5"  name="<?php echo $name_box; ?>" <?php echo @$perm >= 5 ?"checked=\"checked\"":""; ?> id="<?php echo $id_box."_v"; ?>" />
									</td>
									<td>
										<input type="checkbox" value="7"  name="<?php echo $name_box; ?>" <?php echo @$perm >= 7 ?"checked=\"checked\"":""; ?> id="<?php echo $id_box."_v"; ?>" />	
									</td>
							</tr>
							<?php $k ++;?>
						<?php endforeach;?>
					<?php endforeach;?>
				</tbody>
			</table>

<style>
table td, table th{
	padding: 5px 10px;
}
thead{
	background: #EEE;
}
</style>