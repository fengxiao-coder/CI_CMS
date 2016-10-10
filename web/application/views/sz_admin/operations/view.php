<?php $this->load->view_part($this->_site_path."/main/breadcrumb");?>
<!--  详情-->
<div class="box box-headtitle box-radius">
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="details_tab">
			
		<tr>
			<td width="12%"><strong>权限名称</strong></td><td><?php echo $operations_data['operation_name']; ?></td>
		</tr>
			
		<tr>
			<td width="12%"><strong>模块</strong></td><td><?php echo $operations_data['module']; ?></td>
		</tr>
			
		<tr>
			<td width="12%"><strong>动作</strong></td><td><?php echo $operations_data['action']; ?></td>
		</tr>

		<tr>
			<td width="12%"><strong>权限类别</strong></td><td><?php echo $this->operations_type_model->get_value_by_pk($operations_data['operations_type_id'],'type_name'); ?></td>
		</tr>
			
		<tr>
			<td width="12%"><strong>备注</strong></td><td><?php echo $operations_data['remark']; ?></td>
		</tr>
			
	</table>
</div>
</div>