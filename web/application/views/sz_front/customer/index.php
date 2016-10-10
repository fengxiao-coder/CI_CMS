<?php $this->load->view_part($this->_site_path."/main/breadcrumb");?>

<?php $this->load->view_part($this->_site_path."/customer/search")?>

<form method="post" action="<?php echo base_url($this->_site_path."/customer/delete_all");?>">

	<table class="table table-striped table-condensed table-bordered">
		<thead>
			<tr class="table-thbg">
				<th><input name="checkAll" type="checkbox" onclick="checkAllfuck()"/></th>
                <?php foreach( $this->$modelname->list_array as $k=>$v ):?>
                <th><?php echo $v; ?></th>
                <?php endforeach; ?>
                <th>操作</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach( $customer_data as $single ) { ?>
			<tr>
				<td>
					<input name="ids[]" value="<?php echo $single['id']; ?>" type="checkbox" />
				</td>
				<?php foreach( $this->$modelname->list_array as $k=>$v ):?>
                <td><a href="<?php echo base_url($this->_site_path."/customer/view/{$single['id']}"); ?>"><?php echo $single[$k]; ?></a></td>
                <?php endforeach;?>
				<td>
					<a href="<?php echo base_url($this->_site_path."/customer/edit/{$single['id']}"); ?>">修改</a>
					<a href="<?php echo base_url($this->_site_path."/customer/delete/{$single['id']}"); ?>" onclick="return confirmDelete()">删除</a>
				</td>
			</tr>
		<?php } ?>
	</tbody>
	</table>
	<div class="li-ttle floa-Left">
		<ul>
			<li><button type="submit"  class=" btn" onclick="return confirmDelete()"><span  class="btn-Bulkdelete">批量删除</span></button></li>
		</ul>
	</div> 
	<?php echo $pagination; ?>
</form>
