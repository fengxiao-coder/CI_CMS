<?php 
$button = array("添加"=>array("c_model"=>'add','url'=> base_url("sz_admin/store/add")));
$this->common->show_title_breadcrumb("store",$button);
?>
<!--  详情-->
<div class="box  box-radius">
	<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="details_tab">	
	<tr>
		<td width="12%"><strong>店铺名称</strong></td>
		<td width="88%" colspan="5"><?php echo $store_data['sName']; ?></td>
	</tr>
	<tr>
		<td width="12%"><strong>省份</strong></td>
		<td width="21%"><?php echo $this->user_province_model->get_value_by_pk($store_data['province'],"province_name"); ?></td>
		<td width="12%"><strong>城市</strong></td>
		<td width="21%"><?php echo $this->user_city_model->get_value_by_pk($store_data['city'],"city_name"); ?></td>
		<td width="12%"><strong>区域</strong></td>
		<td width="22%"><?php echo $this->user_area_model->get_value_by_pk($store_data['area'],"area_name"); ?></td>
	</tr>
	<tr>
		<td width="12%"><strong>店铺二维码</strong></td>
		<td width="88%" colspan="5"><img  src="<?php echo base_url().$store_data['prephoto']; ?>"></td>
	</tr>
	<tr>
		<td width="12%"><strong>地址</strong></td>
		<td width="88%" colspan="5"><?php echo $store_data['sAddr']; ?></td>
	</tr>
	<tr>
		<td width="12%"><strong>电话</strong></td>
		<td width="88%" colspan="5"><?php echo $store_data['sPhone']; ?></td>
	</tr>
	<tr>
		<td width="12%"><strong>联系人</strong></td>
		<td width="88%" colspan="5"><?php echo $store_data['sUser']; ?></td>
	</tr>
   	</table>
</div>