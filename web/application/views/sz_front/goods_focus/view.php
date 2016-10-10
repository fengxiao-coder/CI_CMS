<?php $this->load->view_part($this->_site_path."/main/breadcrumb");?>

<div class="box box-headtitle box-radius">
	<h4 class="title">添加收藏表详细</h4>
	<table class="table table-bordered table-condensed table-striped">

	<?php foreach( $this->$modelname->form_array as $k=>$v ):?>
	<tr>
		<td width="20%"><strong><?php echo $v;?></strong></td><td><?php echo $goods_focus_data[$k]; ?></td>
	</tr>
    <?php endforeach;?>
		
	</table>
</div>