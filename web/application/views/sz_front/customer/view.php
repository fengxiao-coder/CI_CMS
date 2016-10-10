<?php $this->load->view_part($this->_site_path."/main/breadcrumb");?>

<div class="box box-headtitle box-radius">
	<table class="table table-bordered table-condensed table-striped">

	<?php foreach( $this->$modelname->form_array as $k=>$v ):?>
	<tr>
		<td width="20%"><strong><?php echo $v;?></strong></td><td><?php echo $customer_data[$k]; ?></td>
	</tr>
    <?php endforeach;?>
		
	</table>
</div>