<?php $this->load->view_part($this->_site_path."/main/breadcrumb");?>

<?php $this->load->view_part($this->_site_path."/admin_group_operations/search")?>

<form method="post" action="<?php echo base_url($this->_site_path."/admin_group_operations/delete_all");?>">

	<table class="table table-striped table-condensed table-bordered">
		<thead>
			<tr class="table-thbg">
				<th>选择</th>
                <?php foreach( $this->$modelname->list_array as $k=>$v ):?>
                <th><?php echo $v; ?></th>
                <?php endforeach; ?>
                <th>操作</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach( $admin_group_operations_data as $single ) { ?>
			<tr>
				<td>
					<input name="ids[]" value="<?php echo $single['']; ?>" type="checkbox" />
				</td>
				<?php foreach( $this->$modelname->list_array as $k=>$v ):?>
                <td><?php echo $single[$k]; ?></td>
                <?php endforeach;?>
				<td>
					<a href="<?php echo base_url($this->_site_path."/admin_group_operations/view/{$single['']}"); ?>">查看</a>
					<a href="<?php echo base_url($this->_site_path."/admin_group_operations/edit/{$single['']}"); ?>">修改</a>
					<a href="<?php echo base_url($this->_site_path."/admin_group_operations/delete/{$single['']}"); ?>" onclick="return confirmDelete()">删除</a>
				</td>
			</tr>
		<?php } ?>
	</tbody>
	</table>
	<div class="li-ttle floa-Left">
		<ul>
			<li><label><input name="checkAll" type="checkbox" onclick="checkAllfuck()"/>&nbsp;全选</label></li>
			<li><label><input name="checkInverse" type="checkbox" onclick="checkInversefuck()"/>&nbsp;反选</label></li>
			<li><button type="submit"  class=" btn" onclick="return confirmDelete()"><span  class="btn-Bulkdelete">批量删除</span></button></li>
		</ul>
	</div> 
	<?php echo $pagination; ?>
</form>
