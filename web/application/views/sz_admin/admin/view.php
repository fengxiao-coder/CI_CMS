<?php //$this->load->view_part($this->_site_path."/main/breadcrumb");?>
<?php 
$button = array("添加"=>array("c_model"=>'add','url'=> base_url("sz_admin/admin/add")));
$this->common->show_title_breadcrumb("admin",$button);
?>
<!--  详情-->
<div class="box box-headtitle box-radius">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="details_tab">

		<tr>
			<td width="12%" class="details_title"><strong>角色</strong></td>
            <td width="88%"><?php echo $this->admin_group_model->get_value_by_pk( $admin_data['group_id'], 'group_name' ); ?></td>
		</tr>
		
		<tr>
			<td width="12%" class="details_title"><strong>姓名</strong></td>
            <td width="88%"><?php echo $admin_data['user_name']; ?></td>
		</tr>
		<tr>
			<td width="12%" class="details_title"><strong>真实姓名</strong></td>
            <td width="88%"><?php echo $admin_data['real_name']; ?></td>
		</tr>

		<tr>
			<td width="12%" class="details_title"><strong>邮箱</strong></td>
            <td width="88%" ><?php echo $admin_data['email']; ?></td>
		</tr>

	
            <tr>
			<td width="12%" class="details_title"><strong>创建时间</strong></td>
            <td width="88%"><?php echo init_date($admin_data['last_login_time']); ?></td>
		</tr>

		<tr>
			<td width="12%" class="details_title"><strong>上次登陆时间</strong></td>
            <td width="88%"><?php echo init_date($admin_data['last_login_time']); ?></td>
		</tr>
<tr>
			<td width="12%" class="details_title"><strong>登录次数</strong></td>
            <td width="88%"><?php echo init_date($admin_data['login_count']); ?></td>
		</tr>
		<tr>
			<td width="12%" class="details_title"><strong>上次登陆IP</strong></td>
            <td width="88%"><?php echo $admin_data['last_login_ip']; ?></td>
		</tr>
		
	

		<tr>
			<td width="12%" class="details_title"><strong>是否启用</strong></td>
            <td width="88%">
				<?php if( $admin_data['status'] == 1 ) { ?>
				是
				<?php } else if( $admin_data['status'] == 0 ) { ?>
				否
				<?php } ?></td>
		</tr>

	</table>
</div>
</div>