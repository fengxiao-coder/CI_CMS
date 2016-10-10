<?php $this->load->view_part($this->_site_path."/main/breadcrumb");?>

<div class="box box-headtitle box-radius">
	<h4 class="title">地区信息管理详细</h4>
	<table class="table table-bordered table-condensed table-striped">

	<?php foreach( $this->$modelname->form_array as $k=>$v ):?>
	<tr>
		<td width="12%"><strong><?php echo $v;?></strong></td><td><?php echo $area_data[$k]; ?></td>
	</tr>
    <?php endforeach;?>
		
	</table>
</div>