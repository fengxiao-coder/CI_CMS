<?php //$this->load->view_part($this->_site_path . "/main/breadcrumb"); ?>
<?php 
$button = array("添加"=>array("c_model"=>'add','url'=> base_url("sz_admin/shipping/add")));
$this->common->show_title_breadcrumb("shipping",$button);
?>
<!--  详情-->

<div class="box box-radius">
	<table  width="100%" border="0" cellspacing="0" cellpadding="0" class="details_tab">	
	<tr>
		<td width="12%"><strong>配送方式</strong></td>
		<td><?php echo $shipping_data['shipping_name']; ?></td>
	</tr>
	<tr>
		<td width="12%"><strong>描述</strong></td>
		<td><?php echo $shipping_data['shipping_desc']; ?></td>
	</tr>
   	</table>
</div>