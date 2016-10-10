<?php $this->load->view_part($this->_site_path."/main/breadcrumb");?>

<div class="box box-radius">
	<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="details_tab">

	<?php foreach( $this->$modelname->form_array as $k=>$v ):?>
	<tr>
		<td width="12%"><strong><?php echo $v;?></strong></td>
        <td width="88%" ><?php echo $supplier_data[$k]; ?></td>
	</tr>
    <?php endforeach;?>
		
	</table>
</div>