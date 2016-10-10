<?php $this->load->view_part($this->_site_path."/main/breadcrumb_noadd");?>
<!--  详情-->
<div class="box box-headtitle box-radius">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="details_tab">

	<?php foreach( $this->$modelname->form_array as $k=>$v ):?>
	<tr>
		<td width="20%"><strong><?php echo $v;?></strong></td><td><?php echo $suggest_data[$k]; ?></td>
	</tr>
    <?php endforeach;?>
		
	</table>
</div>